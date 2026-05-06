        // ============================================
        // CONFIG
        // ============================================
        const form = document.getElementById('registrationForm');
        const step1Content = document.getElementById('step1Content');
        const step2Content = document.getElementById('step2Content');
        const nextStep2Btn = document.getElementById('nextStep2Btn');
        const backToStep1Btn = document.getElementById('backToStep1Btn');
        const stepIndicator = document.getElementById('stepIndicator');
        const step1Indicator = document.getElementById('step1Indicator');
        const step2Indicator = document.getElementById('step2Indicator');
        const imageStep1 = document.getElementById('imageStep1');
        const imageStep2 = document.getElementById('imageStep2');
        const formTitle = document.getElementById('formTitle');
        const formSubtitle = document.getElementById('formSubtitle');
        const step1Footer = document.getElementById('step1Footer');
        const step1Social = document.getElementById('step1Social');
        const step1SocialButtons = document.getElementById('step1SocialButtons');
        const successMessage = document.getElementById('successMessage');
        const weightInput = document.getElementById('weight');
        const heightInput = document.getElementById('height');
        const bmiValue = document.getElementById('bmiValue');
        const bmiCategory = document.getElementById('bmiCategory');

        let currentStep = 1;

        // ============================================
        // VALIDATION
        // ============================================

        // Fonctions de validation utilitaires
        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function isValidPassword(password) {
            return password.length >= 8;
        }

        // Validation d'un champ
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
                    case 'full_name':
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

                    case 'password':
                        if (!isValidPassword(value)) {
                            isValid = false;
                            errorMessage = 'Minimum 8 caractères requis';
                        }
                        break;

                    case 'weight':
                    case 'height':
                        if (parseFloat(value) <= 0) {
                            isValid = false;
                            errorMessage = 'Doit être un nombre positif';
                        }
                        break;
                }
            }

            // Mise à jour visuelle
            const inputElement = field;
            if (isValid && value) {
                inputElement.classList.remove('border-red-500', 'bg-red-50');
                inputElement.classList.add('border-green-500', 'bg-green-50');
                if (errorElement) {
                    errorElement.classList.add('hidden');
                }
            } else if (!isValid) {
                inputElement.classList.remove('border-green-500', 'bg-green-50');
                inputElement.classList.add('border-red-500', 'bg-red-50');
                if (errorElement) {
                    errorElement.textContent = errorMessage;
                    errorElement.classList.remove('hidden');
                }
            } else {
                inputElement.classList.remove('border-red-500', 'border-green-500', 'bg-red-50', 'bg-green-50');
                if (errorElement) {
                    errorElement.classList.add('hidden');
                }
            }

            return isValid;
        }

        // ============================================
        // IMC CALCULATION
        // ============================================

        function calculateBMI() {
            const weight = parseFloat(weightInput.value);
            const height = parseFloat(heightInput.value);

            if (weight > 0 && height > 0) {
                const heightInMeters = height / 100;
                const bmi = weight / (heightInMeters * heightInMeters);
                bmiValue.textContent = bmi.toFixed(1);

                let category = '';
                let categoryClass = '';

                if (bmi < 18.5) {
                    category = 'Poids insuffisant';
                    categoryClass = 'text-blue-500';
                } else if (bmi < 25) {
                    category = 'Poids normal';
                    categoryClass = 'text-green-500';
                } else if (bmi < 30) {
                    category = 'Surpoids';
                    categoryClass = 'text-yellow-600';
                } else {
                    category = 'Obésité';
                    categoryClass = 'text-red-500';
                }

                bmiCategory.textContent = category;
                bmiCategory.className = `font-label-sm text-label-sm ${categoryClass}`;
            } else {
                bmiValue.textContent = '--';
                bmiCategory.textContent = 'Entrez poids et taille pour calculer';
                bmiCategory.className = 'font-label-sm text-label-sm text-on-surface-variant';
            }
        }

        // ============================================
        // TRANSITIONS FLUIDES
        // ============================================

        function transitionToStep2() {
            currentStep = 2;

            // Transition du contenu avec glissement
            step1Content.style.opacity = '0';
            step1Content.style.transform = 'translateX(-30px)';
            step1Content.style.pointerEvents = 'none';

            setTimeout(() => {
                step1Content.style.position = 'absolute';
                step2Content.style.position = 'relative';
                step2Content.style.opacity = '1';
                step2Content.style.visibility = 'visible';
                step2Content.style.transform = 'translateX(0)';
                step2Content.style.pointerEvents = 'auto';
            }, 150);

            // Transition de l'image
            imageStep1.style.opacity = '0';
            imageStep2.style.opacity = '1';

            // Transition des textes
            setTimeout(() => {
                formTitle.textContent = 'Complétez votre profil de santé';
                formSubtitle.textContent = 'Dites-nous vos métriques de santé actuelles et vos objectifs.';
                stepIndicator.textContent = 'Étape 2 de 2';
                step2Indicator.classList.remove('bg-surface-container-highest');
                step2Indicator.classList.add('bg-primary');

                step1Footer.classList.add('hidden');
                step1Social.classList.add('hidden');
                step1SocialButtons.classList.add('hidden');
            }, 100);
        }

        function transitionToStep1() {
            currentStep = 1;

            // Transition du contenu avec glissement
            step2Content.style.opacity = '0';
            step2Content.style.transform = 'translateX(30px)';
            step2Content.style.pointerEvents = 'none';

            setTimeout(() => {
                step2Content.style.position = 'absolute';
                step1Content.style.position = 'relative';
                step1Content.style.opacity = '1';
                step1Content.style.visibility = 'visible';
                step1Content.style.transform = 'translateX(0)';
                step1Content.style.pointerEvents = 'auto';
            }, 150);

            // Transition de l'image
            imageStep1.style.opacity = '1';
            imageStep2.style.opacity = '0';

            // Transition des textes
            setTimeout(() => {
                formTitle.textContent = 'Créer votre profil';
                formSubtitle.textContent = 'Entrez vos informations personnelles pour commencer votre expérience de santé personnalisée.';
                stepIndicator.textContent = 'Étape 1 de 2';
                step1Indicator.classList.add('bg-primary');
                step2Indicator.classList.remove('bg-primary');
                step2Indicator.classList.add('bg-surface-container-highest');

                step1Footer.classList.remove('hidden');
                step1Social.classList.remove('hidden');
                step1SocialButtons.classList.remove('hidden');
            }, 100);
        }

        // ============================================
        // ÉVÉNEMENTS
        // ============================================

        // Validation en temps réel
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('change', () => validateField(input));
        });

        // Afficher/masquer mot de passe
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    input.type = 'text';
                    this.querySelector('.material-symbols-outlined').textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    this.querySelector('.material-symbols-outlined').textContent = 'visibility';
                }
            });
        });

        // Bouton Continuer vers Étape 2
        nextStep2Btn.addEventListener('click', function(e) {
            e.preventDefault();

            const fullNameInput = document.getElementById('full_name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            let isValid = true;
            if (!validateField(fullNameInput)) isValid = false;
            if (!validateField(emailInput)) isValid = false;
            if (!validateField(passwordInput)) isValid = false;

            if (isValid) {
                transitionToStep2();
            }
        });

        // Bouton Retour
        backToStep1Btn.addEventListener('click', function(e) {
            e.preventDefault();
            transitionToStep1();
        });

        // Calcul IMC en temps réel
        weightInput.addEventListener('input', calculateBMI);
        heightInput.addEventListener('input', calculateBMI);

        // Soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (currentStep === 2) {
                let isFormValid = true;
                inputs.forEach(input => {
                    if (!validateField(input)) {
                        isFormValid = false;
                    }
                });

                if (isFormValid) {
                    successMessage.classList.remove('hidden');

                    console.log('✅ Formulaire valide! Données:');
                    const formData = new FormData(form);
                    for (let [key, value] of formData) {
                        console.log(`${key}: ${value}`);
                    }

                    setTimeout(() => {
                        form.reset();
                        inputs.forEach(input => {
                            input.classList.remove('border-red-500', 'border-green-500', 'bg-red-50', 'bg-green-50');
                        });
                        document.querySelectorAll('.error-message').forEach(msg => {
                            msg.classList.add('hidden');
                        });
                        successMessage.classList.add('hidden');
                        bmiValue.textContent = '--';
                        bmiCategory.textContent = 'Entrez poids et taille pour calculer';
                        bmiCategory.className = 'font-label-sm text-label-sm text-on-surface-variant';

                        transitionToStep1();
                    }, 2000);
                }
            }
        });

        // Fermer le message de succès au clic
        successMessage.addEventListener('click', function(e) {
            if (e.target === successMessage) {
                successMessage.classList.add('hidden');
            }
        });

        // Sélection des objectifs
        document.querySelectorAll('label[data-goal]').forEach(label => {
            label.addEventListener('change', function() {
                const goal = this.getAttribute('data-goal');
                console.log('📊 Objectif sélectionné:', goal);
            });
        });
        
