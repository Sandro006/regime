        // ============================================
        // CONFIG
        // ============================================
        const form = document.getElementById('registrationForm');
        const step1Content = document.getElementById('step1Content');
        const step2Content = document.getElementById('step2Content');
        const nextStep2Btn = document.getElementById('nextStep2Btn');
        const backToStep1Btn = document.getElementById('backToStep1Btn');
        const imageStep1 = document.getElementById('imageStep1');
        const imageStep2 = document.getElementById('imageStep2');
        const formTitle = document.getElementById('formTitle');
        const formSubtitle = document.getElementById('formSubtitle');
        const step1Footer = document.getElementById('step1Footer');
        const step1Social = document.getElementById('step1Social');
        const step1SocialButtons = document.getElementById('step1SocialButtons');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        const weightInput = document.getElementById('weight');
        const heightInput = document.getElementById('height');
        const bmiValue = document.getElementById('bmiValue');
        const bmiCategory = document.getElementById('bmiCategory');

        let currentStep = 1;

        // ============================================
        // VALIDATION
        // ============================================

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function isValidPassword(password) {
            return password.length >= 8;
        }

        function validateField(field) {
            const fieldName = field.name;
            const value = field.value.trim();
            const errorElement = document.querySelector(`.error-message[data-field="${fieldName}"]`);
            let isValid = true;
            let errorText = '';

            if (field.hasAttribute('required') && !value) {
                isValid = false;
                errorText = 'Ce champ est requis';
            } else if (isValid && value) {
                switch (fieldName) {
                    case 'full_name':
                        if (value.length < 2) {
                            isValid = false;
                            errorText = 'Minimum 2 caractères requis';
                        }
                        break;
                    case 'email':
                        if (!isValidEmail(value)) {
                            isValid = false;
                            errorText = 'Adresse email invalide';
                        }
                        break;
                    case 'password':
                        if (!isValidPassword(value)) {
                            isValid = false;
                            errorText = 'Minimum 8 caractères requis';
                        }
                        break;
                    case 'weight':
                    case 'height':
                        if (parseFloat(value) <= 0) {
                            isValid = false;
                            errorText = 'Doit être un nombre positif';
                        }
                        break;
                }
            }

            // Mise à jour visuelle
            if (isValid && value) {
                field.classList.remove('border-red-500', 'bg-red-50');
                field.classList.add('border-green-500', 'bg-green-50');
                if (errorElement) errorElement.classList.add('hidden');
            } else if (!isValid) {
                field.classList.remove('border-green-500', 'bg-green-50');
                field.classList.add('border-red-500', 'bg-red-50');
                if (errorElement) {
                    errorElement.textContent = errorText;
                    errorElement.classList.remove('hidden');
                }
            } else {
                field.classList.remove('border-red-500', 'border-green-500', 'bg-red-50', 'bg-green-50');
                if (errorElement) errorElement.classList.add('hidden');
            }

            return isValid;
        }

        // ============================================
        // GESTION DES MESSAGES
        // ============================================

        function getErrorMessage(serverMessage) {
            const errorMap = {
                'email': appMessages?.error?.email_exists,
                'invalides': appMessages?.error?.invalid_data,
                'l\'enregistrement': appMessages?.error?.insert_failed
            };

            for (const [key, customMsg] of Object.entries(errorMap)) {
                if (serverMessage.includes(key)) return customMsg || serverMessage;
            }
            return serverMessage;
        }

        function showError(message) {
            document.getElementById('errorText').textContent = message;
            errorMessage.classList.remove('hidden');
        }

        function showSuccess(serverMsg) {
            const successMsg = appMessages?.success || {
                title: 'Bienvenue sur VitalFit! 🎉',
                message: 'Inscription réussie! Votre compte a été créé avec succès.'
            };
            
            document.getElementById('successTitle').textContent = successMsg.title;
            document.getElementById('successText').textContent = serverMsg || successMsg.message;
            successMessage.classList.remove('hidden');
        }

        function resetForm() {
            form.reset();
            document.querySelectorAll('input, select').forEach(input => {
                input.classList.remove('border-red-500', 'border-green-500', 'bg-red-50', 'bg-green-50');
            });
            document.querySelectorAll('.error-message').forEach(msg => {
                msg.classList.add('hidden');
            });
            bmiValue.textContent = '--';
            bmiCategory.textContent = 'Entrez poids et taille pour calculer';
            bmiCategory.className = 'font-label-sm text-label-sm text-on-surface-variant';
            successMessage.classList.add('hidden');
            transitionToStep1();
        }

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

            imageStep1.style.opacity = '0';
            imageStep2.style.opacity = '1';

            setTimeout(() => {
                formTitle.textContent = 'Complétez votre profil de santé';
                formSubtitle.textContent = 'Dites-nous vos métriques de santé actuelles et vos objectifs.';
                step1Footer.classList.add('hidden');
                step1Social.classList.add('hidden');
                step1SocialButtons.classList.add('hidden');
            }, 100);
        }

        function transitionToStep1() {
            currentStep = 1;
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

            imageStep1.style.opacity = '1';
            imageStep2.style.opacity = '0';

            setTimeout(() => {
                formTitle.textContent = 'Créer votre profil';
                formSubtitle.textContent = 'Entrez vos informations personnelles pour commencer votre expérience de santé personnalisée.';
                step1Footer.classList.remove('hidden');
                step1Social.classList.remove('hidden');
                step1SocialButtons.classList.remove('hidden');
            }, 100);
        }

        // ============================================
        // ÉVÉNEMENTS
        // ============================================

        const inputs = form.querySelectorAll('input, select');
        
        // Validation en temps réel
        inputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('change', () => validateField(input));
        });

        // Afficher/masquer mot de passe
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const input = document.getElementById(btn.dataset.target);
                const icon = btn.querySelector('.material-symbols-outlined');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                }
            });
        });

        // Navigation étapes
        nextStep2Btn.addEventListener('click', (e) => {
            e.preventDefault();
            let isValid = true;
            ['full_name', 'gender', 'email', 'password'].forEach(name => {
                if (!validateField(form.elements[name])) isValid = false;
            });
            if (isValid) transitionToStep2();
        });

        backToStep1Btn.addEventListener('click', (e) => {
            e.preventDefault();
            transitionToStep1();
        });

        // Calcul IMC en temps réel
        [weightInput, heightInput].forEach(input => {
            input.addEventListener('input', calculateBMI);
        });

        // Fermer les modals
        successMessage.addEventListener('click', (e) => {
            if (e.target === successMessage) successMessage.classList.add('hidden');
        });

        document.getElementById('closeErrorBtn').addEventListener('click', () => {
            errorMessage.classList.add('hidden');
        });

        errorMessage.addEventListener('click', (e) => {
            if (e.target === errorMessage) errorMessage.classList.add('hidden');
        });

        // Soumission du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (currentStep === 2) {
                let isFormValid = true;
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    if (!validateField(input)) isFormValid = false;
                });

                if (!isFormValid) return;

                fetch('/register', {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        console.log('✅ Inscription réussie!', data);
                        showSuccess(data.message);
                        setTimeout(() => {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                resetForm();
                            }
                        }, 3000);
                    } else {
                        showError(getErrorMessage(data.message));
                    }
                })
                .catch(err => {
                    console.error('❌ Erreur réseau:', err);
                    showError(appMessages?.error?.network_error || 'Erreur réseau: ' + err.message);
                });
            }
        });
