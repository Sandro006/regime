<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Connexion Admin | VitalFit</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Inter:wght@400;600&family=Lexend:wght@600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#bbcbbb",
                        "on-surface": "#161d17",
                        "secondary-container": "#fc8f34",
                        "on-secondary-fixed": "#301400",
                        "inverse-primary": "#4ae183",
                        "on-background": "#161d17",
                        "secondary": "#944a00",
                        "inverse-on-surface": "#ebf3e8",
                        "surface-bright": "#f3fcf1",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed": "#ffdbd0",
                        "on-secondary": "#ffffff",
                        "error": "#ba1a1a",
                        "secondary-fixed-dim": "#ffb783",
                        "primary-container": "#2ecc71",
                        "secondary-fixed": "#ffdcc5",
                        "on-primary-fixed": "#00210c",
                        "surface-tint": "#006d37",
                        "on-error": "#ffffff",
                        "primary": "#006d37",
                        "tertiary-fixed-dim": "#ffb59d",
                        "on-tertiary-fixed": "#390c00",
                        "inverse-surface": "#2b322b",
                        "outline": "#6c7b6d",
                        "surface-container-low": "#eef6eb",
                        "surface-container-high": "#e2ebe0",
                        "on-secondary-fixed-variant": "#713700",
                        "on-primary-fixed-variant": "#005228",
                        "on-error-container": "#93000a",
                        "surface-container-highest": "#dce5da",
                        "on-secondary-container": "#663100",
                        "primary-fixed-dim": "#4ae183",
                        "on-tertiary-container": "#772e14",
                        "on-surface-variant": "#3d4a3e",
                        "surface-dim": "#d4dcd2",
                        "surface-variant": "#dce5da",
                        "tertiary-container": "#ff9875",
                        "tertiary": "#98472a",
                        "on-tertiary-fixed-variant": "#793015",
                        "primary-fixed": "#6bfe9c",
                        "surface-container": "#e8f0e5",
                        "surface": "#f3fcf1",
                        "on-primary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#005027",
                        "error-container": "#ffdad6",
                        "background": "#f3fcf1"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "40px",
                        "md": "16px",
                        "container-margin": "20px",
                        "gutter": "16px",
                        "xs": "8px",
                        "sm": "12px",
                        "lg": "24px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "metric-xl": ["Lexend"],
                        "headline-sm": ["Montserrat"],
                        "body-md": ["Inter"],
                        "display-md": ["Montserrat"],
                        "display-lg": ["Montserrat"],
                        "label-caps": ["Lexend"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "metric-xl": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "700"
                        }],
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "display-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "display-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md min-h-screen flex items-center justify-center overflow-x-hidden">
    <!-- Main Layout Container -->
    <main class="w-full min-h-screen flex items-stretch">
        <!-- Left Column: Branding & Form -->
        <section class="flex-1 flex flex-col justify-center items-center px-container-margin py-xl lg:px-xl bg-surface relative z-10">
            <div class="w-full max-w-md">
                <!-- Back to Home Link -->
                <div class="mb-lg">
                    <a href="/" class="inline-flex items-center gap-sm text-primary hover:text-primary/80 transition-colors font-body-md">
                        <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back</span>
                        Retour à l'accueil
                    </a>
                </div>

                <!-- Brand Header -->
                <div class="mb-xl text-center lg:text-left">
                    <h1 class="font-display-lg text-display-lg text-primary tracking-tight">VitalFit Admin</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mt-xs">Gestion de l'administration</p>
                </div>

                <!-- Login Form -->
                <form id="loginForm" class="bg-surface-container-low p-md rounded-xl border-2 border-primary/30 mt-md">
                    <!-- Email Field -->
                    <div class="mb-md">
                        <label for="email" class="block font-label-caps text-label-caps text-on-surface mb-xs">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required 
                            class="w-full px-md py-sm rounded-lg border-2 border-outline-variant focus:border-primary focus:outline-none font-body-md text-body-md transition-colors"
                            placeholder="Votre email administrateur"
                        />
                    </div>

                    <!-- Password Field -->
                    <div class="mb-lg">
                        <label for="password" class="block font-label-caps text-label-caps text-on-surface mb-xs">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="w-full px-md py-sm rounded-lg border-2 border-outline-variant focus:border-primary focus:outline-none font-body-md text-body-md transition-colors"
                            placeholder="Votre mot de passe"
                        />
                    </div>

                    <!-- Error Message -->
                    <?php if (session()->has('error')): ?>
                        <div class="mb-md p-md bg-error/10 rounded-lg border-l-4 border-error">
                            <p class="text-error font-body-md"><?= session()->getFlashdata('error') ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Success Message -->
                    <?php if (session()->has('success')): ?>
                        <div class="mb-md p-md bg-primary/10 rounded-lg border-l-4 border-primary">
                            <p class="text-primary font-body-md"><?= session()->getFlashdata('success') ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-sm rounded-lg bg-primary text-on-primary font-headline-sm text-headline-sm hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Connexion
                    </button>
                </form>

                <!-- Test Credentials Info -->
                <div class="bg-surface-container-low p-md rounded-xl mt-md border-2 border-secondary-container/50">
                    <p class="font-label-caps text-label-caps text-on-surface-variant mb-sm">Identifiants de test:</p>
                    <ul class="list-disc list-inside text-on-surface-variant text-body-md space-y-xs">
                        <li><span>Email: <strong>admin@test.com</strong></span></li>
                        <li><span>Mot de passe: <strong>admin123</strong></span></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Right Column: Decoration -->
        <section class="hidden lg:flex flex-1 bg-gradient-to-br from-primary to-secondary items-center justify-center p-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/20 rounded-full blur-3xl"></div>
            <div class="relative z-10 text-center">
                <h2 class="font-display-lg text-display-lg text-on-primary mb-md">Bienvenue Admin</h2>
                <p class="font-body-lg text-body-lg text-on-primary/90 max-w-sm">Accès au tableau de bord de gestion administrateur</p>
            </div>
        </section>
    </main>

    <script>
        // Gestion du formulaire de login
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Connexion en cours...';

            try {
                const response = await fetch('<?= base_url('/admin/auth/authenticate') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message || 'Erreur d\'authentification');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Connexion';
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Connexion';
            }
        });
    </script>
</body>

</html>
