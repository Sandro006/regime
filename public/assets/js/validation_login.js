// ============================================
// CONFIG
// ============================================
const form = document.getElementById('loginForm');
const errorMessage = document.getElementById('errorMessage');
const errorText = document.getElementById('errorText');
const successMessage = document.getElementById('successMessage');
const successText = document.getElementById('successText');

// ============================================
// VALIDATION
// ============================================

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validateField(field) {
    const fieldName = field.name;
    const value = field.value.trim();
    const errorElement = document.querySelector(`.error-message[data-field="${fieldName}"]`);
    let isValid = true;
    let errorMsg = '';

    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMsg = 'Ce champ est requis';
    } else if (isValid && value) {
        switch (fieldName) {
            case 'email':
                if (!isValidEmail(value)) {
                    isValid = false;
                    errorMsg = 'Adresse email invalide';
                }
                break;
            case 'password':
                if (value.length < 8) {
                    isValid = false;
                    errorMsg = 'Minimum 8 caractères requis';
                }
                break;
        }
    }

    // Mise à jour visuelle des inputs
    if (isValid && value) {
        field.classList.remove('border-red-500', 'bg-red-50');
        field.classList.add('border-green-500', 'bg-green-50');
        if (errorElement) errorElement.classList.add('hidden');
    } else if (!isValid) {
        field.classList.remove('border-green-500', 'bg-green-50');
        field.classList.add('border-red-500', 'bg-red-50');
        if (errorElement) {
            errorElement.textContent = errorMsg;
            errorElement.classList.remove('hidden');
        }
    } else {
        field.classList.remove('border-red-500', 'border-green-500', 'bg-red-50', 'bg-green-50');
        if (errorElement) errorElement.classList.add('hidden');
    }

    return isValid;
}

// ============================================
// NOTIFICATIONS
// ============================================

function showError(message) {
    errorText.textContent = message;
    errorMessage.classList.remove('hidden');
    successMessage.classList.add('hidden');
}

function showSuccess(message) {
    successText.textContent = message;
    successMessage.classList.remove('hidden');
    errorMessage.classList.add('hidden');
}

// ============================================
// ÉVÉNEMENTS
// ============================================

const inputs = form.querySelectorAll('input');

// Validation en temps réel (blur & change)
inputs.forEach(input => {
    input.addEventListener('blur', () => validateField(input));
    input.addEventListener('change', () => validateField(input));
});

// Afficher / masquer le mot de passe
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

// Fermeture des boîtes d'alerte
document.getElementById('closeErrorBtn').addEventListener('click', () => {
    errorMessage.classList.add('hidden');
});

// Soumission du formulaire en AJAX
form.addEventListener('submit', function(e) {
    e.preventDefault();

    let isFormValid = true;
    inputs.forEach(input => {
        // Ne pas valider la case "Remember me" comme requise
        if (input.type !== 'checkbox') {
            if (!validateField(input)) isFormValid = false;
        }
    });

    if (!isFormValid) return;

    // Récupérer l'URL d'action du formulaire (par ex. /login)
    const actionUrl = form.getAttribute('action') || '/login';

    fetch(actionUrl, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => {
        if (!response.ok) {
            // Permet de catcher proprement les codes HTTP 400, 401, 403, etc.
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
            // Redirection vers l'URL fournie par le serveur après 1.5 seconde
            setTimeout(() => {
                window.location.href = data.redirect || '/';
            }, 1500);
        } else {
            showError(data.message || 'Identifiants incorrects');
        }
    })
    .catch(err => {
        console.error('❌ Erreur:', err);
        showError(err.message || 'Une erreur réseau est survenue. Veuillez réessayer.');
    });
});