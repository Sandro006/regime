        const form = document.getElementById('registrationForm');
        const successMessage = document.getElementById('successMessage');

        // Événements des boutons afficher/masquer mot de passe
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                
                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = 'U_U';
                } else {
                    input.type = 'password';
                    this.textContent = '👁️';
                }
            });
        });

        // Validation en temps réel
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('change', () => validateField(input));
        });

        function validateField(field) {
            const fieldName = field.name;
            const value = field.value.trim();
            const errorElement = document.querySelector(`.error-message[data-field="${fieldName}"]`);
            let isValid = true;
            let errorMessage = '';

            // Validation commune: champs requis
            if (field.hasAttribute('required') && !value) {
                isValid = false;
                errorMessage = 'Ce champ est requis';
            }

            // Validations spécifiques
            if (isValid && value) {
                switch (fieldName) {
                    case 'nom':
                    case 'prenom':
                        if (value.length < 2) {
                            isValid = false;
                            errorMessage = 'Minimum 2 caractères requis';
                        }
                        break;

                    case 'email':
                        if (!isValidEmail(value)) {
                            isValid = false;
                            errorMessage = 'Adresse email invalide';
                        }
                        break;

                    case 'confirmerEmail': {
                        const email = document.getElementById('email').value;
                        if (value && value !== email) {
                            isValid = false;
                            errorMessage = 'Les emails ne correspondent pas';
                        }
                        break;
                    }

                    case 'telephone':
                        if (value && !isValidPhone(value)) {
                            isValid = false;
                            errorMessage = 'Numéro de téléphone invalide';
                        }
                        break;

                    case 'dateNaissance': {
                        const age = calculateAge(new Date(value));
                        if (age < 13) {
                            isValid = false;
                            errorMessage = 'Vous devez avoir au moins 13 ans';
                        } else if (age > 120) {
                            isValid = false;
                            errorMessage = 'Date de naissance invalide';
                        }
                        break;
                    }

                    case 'password':
                        if (!isValidPassword(value)) {
                            isValid = false;
                            errorMessage = 'Le mot de passe ne respecte pas les critères';
                        }
                        break;

                    case 'confirmerPassword': {
                        const password = document.getElementById('password').value;
                        if (value && value !== password) {
                            isValid = false;
                            errorMessage = 'Les mots de passe ne correspondent pas';
                        }
                        break;
                    }
                }
            }

            // Mise à jour visuelle
            if (isValid && value) {
                field.classList.remove('error');
                field.classList.add('success');
                errorElement.classList.remove('show');
            } else if (!isValid) {
                field.classList.remove('success');
                field.classList.add('error');
                errorElement.textContent = errorMessage;
                errorElement.classList.add('show');
            } else {
                field.classList.remove('error', 'success');
                errorElement.classList.remove('show');
            }

            return isValid;
        }

        // Fonctions de validation utilitaires
        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function isValidPhone(phone) {
            const regex = /^[\d\s\-\+\.()]{9,}$/;
            return regex.test(phone);
        }

        function isValidPassword(password) {
            // Minimum 8 caractères
            if (password.length < 8) return false;
            // Au moins une majuscule
            // if (!/[A-Z]/.test(password)) return false;
            // Au moins un chiffre
            // if (!/\d/.test(password)) return false;
            // Au moins un caractère spécial
            // if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) return false;
            return true;
        }

        function calculateAge(birthDate) {
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return age;
        }

        // Soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Valider tous les champs
            let isFormValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Afficher le message de succès
                successMessage.classList.add('show');
                
                // Afficher les données (pour démonstration)
                console.log('Formulaire valide! Données:');
                const formData = new FormData(form);
                for (let [key, value] of formData) {
                    console.log(`${key}: ${value}`);
                }
                
                // Réinitialiser après 2 secondes
                setTimeout(() => {
                    form.reset();
                    inputs.forEach(input => {
                        input.classList.remove('error', 'success');
                    });
                    document.querySelectorAll('.error-message').forEach(msg => {
                        msg.classList.remove('show');
                    });
                    successMessage.classList.remove('show');
                }, 2000);
            } else {
                console.log('Veuillez corriger les erreurs');
            }
        });

        