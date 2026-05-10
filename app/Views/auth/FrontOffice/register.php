<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>VitalFit - Create Your Account</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700&amp;family=Manrope:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-fixed": "#dae2fd",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#6ffbbe",
                        "outline-variant": "#bbcabf",
                        "surface-tint": "#006c49",
                        "surface": "#f7f9fb",
                        "on-secondary-container": "#5c647a",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#131b2e",
                        "surface-variant": "#e0e3e5",
                        "primary-container": "#10b981",
                        "surface-bright": "#f7f9fb",
                        "secondary": "#565e74",
                        "on-primary-container": "#00422b",
                        "primary": "#006c49",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#eff1f3",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#d5e6df",
                        "on-secondary-fixed-variant": "#3f465c",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-container": "#eceef0",
                        "on-surface": "#191c1e",
                        "primary-fixed-dim": "#4edea3",
                        "background": "#f7f9fb",
                        "inverse-surface": "#2d3133",
                        "secondary-fixed-dim": "#bec6e0",
                        "inverse-primary": "#4edea3",
                        "on-tertiary-fixed": "#101e1a",
                        "on-tertiary-container": "#2d3c37",
                        "on-surface-variant": "#3c4a42",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#dae2fd",
                        "outline": "#6c7a71",
                        "on-background": "#191c1e",
                        "surface-container-highest": "#e0e3e5",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-fixed-variant": "#3b4a44",
                        "surface-container-high": "#e6e8ea",
                        "on-primary-fixed": "#002113",
                        "surface-dim": "#d8dadc",
                        "tertiary-container": "#96a69f",
                        "on-primary-fixed-variant": "#005236",
                        "tertiary-fixed-dim": "#bacac3",
                        "tertiary": "#52625c",
                        "on-error": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "12px",
                        "gutter": "16px",
                        "base": "8px",
                        "md": "24px",
                        "xl": "64px",
                        "xs": "4px",
                        "lg": "40px",
                        "container-margin": "24px"
                    },
                    "fontFamily": {
                        "label-sm": ["Manrope"],
                        "body-md": ["Manrope"],
                        "headline-xl": ["Lexend"],
                        "headline-md": ["Lexend"],
                        "body-lg": ["Manrope"],
                        "label-bold": ["Manrope"],
                        "headline-lg": ["Lexend"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", {
                            "lineHeight": "1.4",
                            "fontWeight": "500"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "headline-xl": ["40px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "label-bold": ["14px", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.02em",
                            "fontWeight": "700"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "1.25",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
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

        .step-active {
            box-shadow: 0 0 0 4px rgba(0, 108, 73, 0.1);
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col">
    <main class="flex-grow flex flex-col md:flex-row h-screen overflow-hidden">
        <section class="hidden lg:flex lg:w-1/2 relative bg-primary-container items-center justify-center p-xl overflow-hidden">
            <div class="absolute inset-0 z-0 transition-opacity duration-500" id="imageStep1">
                <img alt="VitalFit Welcome" class="w-full h-full object-cover opacity-80 mix-blend-multiply"  src="<?= base_url('assets/images/register.png') ?>"></img></div>
            <div class="absolute inset-0 z-0 opacity-0 transition-opacity duration-500" id="imageStep2">
                <img alt="VitalFit Health Goals" class="w-full h-full object-cover opacity-80 mix-blend-multiply" src="<?= base_url('assets/images/register2.jpg') ?>" />
            </div>
            <div class="relative z-10 max-w-md text-on-primary" id="sidebarContent">
                <h1 class="font-headline-xl text-headline-xl mb-md">Votre parcours de santé commence par la précision.</h1>
                <p class="font-body-lg text-body-lg opacity-90">Le véritable régime est celui qui nourrit le corps et l'esprit durablement, loin de la privation.</p>
                <div class="mt-lg grid grid-cols-2 gap-md">
                    <div class="bg-white/10 backdrop-blur-md p-gutter rounded-xl border border-white/20">
                        <span class="material-symbols-outlined text-primary-fixed mb-xs" data-icon="clinical_notes">clinical_notes</span>
                        <p class="font-label-bold text-label-bold">Plans fondés sur les données</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-gutter rounded-xl border border-white/20">
                        <span class="material-symbols-outlined text-primary-fixed mb-xs" data-icon="monitor_heart">monitor_heart</span>
                        <p class="font-label-bold text-label-bold">Suivi en temps réel</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full lg:w-1/2 flex items-center justify-center p-gutter md:p-xl overflow-y-auto bg-surface">
            <div class="w-full max-w-md">
                <div class="mb-lg flex justify-between items-center">
                    <div>
                        <span class="text-primary font-headline-md text-headline-md font-bold tracking-tight">VitalFit</span>
                    </div>
                </div>
                <div class="mb-lg">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs transition-all duration-300" id="formTitle">Créer votre profil</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant transition-all duration-300" id="formSubtitle">Entrez vos informations personnelles pour commencer votre expérience de santé personnalisée.</p>
                </div>
                <form class="space-y-md" id="registrationForm">
                    <?= csrf_field() ?>

                    <!-- ÉTAPE 1: Profil Personnel -->
                    <div id="step1Content" class="space-y-md transition-all duration-300 ease-in-out">

                        <!-- SECTION: Informations Personnelles -->
                        <fieldset class="border-b-2 border-outline-variant pb-md">
                            <legend class="font-label-bold text-label-bold text-primary mb-md text-lg">Informations personnelles</legend>

                            <div class="space-y-xs">
                                <label class="font-label-bold text-label-bold text-on-surface" for="full_name">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-[20px]" data-icon="person">person</span>
                                    </div>
                                    <input class="block w-full pl-lg pr-md py-sm bg-surface-container-lowest border-2 border-outline-variant rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="full_name" name="full_name" placeholder="Jean Dupont" type="text" required />
                                    <span class="error-message text-red-500 text-label-sm hidden" data-field="full_name"></span>
                                </div>
                            </div>

                            <div class="space-y-xs">
                                <label class="font-label-bold text-label-bold text-on-surface" for="gender">
                                    Genre <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <select class="block w-full pl-md pr-md py-sm bg-surface-container-lowest border-2 border-outline-variant rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="gender" name="gender" required>
                                        <option value="">Sélectionner votre genre</option>
                                        <option value="male">Homme</option>
                                        <option value="female">Femme</option>
                                    </select>
                                    <span class="error-message text-red-500 text-label-sm hidden" data-field="gender"></span>
                                </div>
                            </div>

                        </fieldset>

                        <!-- SECTION: Sécurité -->
                        <fieldset class="border-b-2 border-outline-variant pb-md">
                            <legend class="font-label-bold text-label-bold text-primary mb-md text-lg">Identifiants de sécurité</legend>

                            <div class="space-y-xs">
                                <label class="font-label-bold text-label-bold text-on-surface" for="email">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-[20px]" data-icon="mail">mail</span>
                                    </div>
                                    <input class="block w-full pl-lg pr-md py-sm bg-surface-container-lowest border-2 border-outline-variant rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="email" name="email" placeholder="jean@example.com" type="email" required />
                                    <span class="error-message text-red-500 text-label-sm hidden" data-field="email"></span>
                                </div>
                            </div>

                            <div class="space-y-xs mt-md">
                                <label class="font-label-bold text-label-bold text-on-surface" for="password">
                                    Mot de passe <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-[20px]" data-icon="lock">lock</span>
                                    </div>
                                    <input class="block w-full pl-lg pr-md py-sm bg-surface-container-lowest border-2 border-outline-variant rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="password" name="password" placeholder="••••••••" type="password" required />
                                    <button class="absolute inset-y-0 right-0 pr-sm flex items-center text-on-surface-variant hover:text-on-surface transition-colors toggle-password" data-target="password" type="button">
                                        <span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
                                    </button>
                                    <span class="error-message text-red-500 text-label-sm hidden" data-field="password"></span>
                                </div>
                                <p class="font-label-sm text-label-sm text-on-surface-variant mt-xs">Minimum 8 caractères requis.</p>
                            </div>

                        </fieldset>

                        <div class="pt-base">
                            <button class="w-full bg-primary text-on-primary font-label-bold text-label-bold py-sm px-md rounded-lg shadow-sm hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-xs" type="button" id="nextStep2Btn">
                                Continuer vers les objectifs santé
                                <span class="material-symbols-outlined text-[18px]" data-icon="arrow_forward">arrow_forward</span>
                            </button>
                        </div>
                    </div>

                    <!-- ÉTAPE 2: Métriques de Santé et Objectifs -->
                    <div id="step2Content" class="space-y-md opacity-0 invisible transition-all duration-300 ease-in-out" style="position: absolute; pointer-events: none;">

                        <!-- SECTION: Métriques de Santé -->
                        <fieldset class="border-b-2 border-outline-variant pb-md">
                            <legend class="font-label-bold text-label-bold text-primary mb-md text-lg">Vos métriques de santé</legend>

                            <div class="grid grid-cols-2 gap-md">
                                <div class="space-y-xs">
                                    <label class="font-label-bold text-label-bold text-on-surface" for="weight">
                                        Poids (kg) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-[20px]" data-icon="scale">scale</span>
                                        </div>
                                        <input class="block w-full pl-lg pr-md py-sm bg-surface-container-lowest border-2 border-outline-variant rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="weight" name="weight" placeholder="75" type="number" step="0.1" required />
                                        <span class="error-message text-red-500 text-label-sm hidden" data-field="weight"></span>
                                    </div>
                                </div>

                                <div class="space-y-xs">
                                    <label class="font-label-bold text-label-bold text-on-surface" for="height">
                                        Taille (cm) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-[20px]" data-icon="height">rule</span>
                                        </div>
                                        <input class="block w-full pl-lg pr-md py-sm bg-surface-container-lowest border-2 border-outline-variant rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="height" name="height" placeholder="175" type="number" step="0.1" required />
                                        <span class="error-message text-red-500 text-label-sm hidden" data-field="height"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Indicateur IMC -->
                            <div class="bg-surface-container-low p-md rounded-xl border-2 border-primary/30 mt-md">
                                <p class="font-label-bold text-label-bold text-on-surface mb-sm flex items-center gap-xs">
                                    <span class="material-symbols-outlined text-primary">info</span>
                                    Votre IMC actuel
                                </p>
                                <div class="flex items-baseline gap-xs">
                                    <p class="font-headline-md text-headline-md text-primary" id="bmiValue">--</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant" id="bmiCategory">Entrez poids et taille pour calculer</p>
                                </div>
                                <p class="font-label-sm text-label-sm text-on-surface-variant mt-sm">
                                    <span class="block">IMC &lt; 18.5 : Poids insuffisant</span>
                                    <span class="block">IMC 18.5-25 : Poids normal</span>
                                    <span class="block">IMC 25-30 : Surpoids</span>
                                    <span class="block">IMC ≥ 30 : Obésité</span>
                                </p>
                            </div>

                        </fieldset>

                        <!-- SECTION: Objectifs de Santé -->
                        <fieldset class="border-b-2 border-outline-variant pb-md">
                            <legend class="font-label-bold text-label-bold text-primary mb-md text-lg">Votre objectif de santé</legend>

                            <div class="space-y-sm">
                                <label class="flex items-center p-sm border-2 border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-lowest transition-all" data-goal="increase">
                                    <input class="w-4 h-4 accent-primary cursor-pointer" name="goal" type="radio" value="increase" required />
                                    <span class="ml-sm flex-1">
                                        <span class="font-label-bold text-label-bold text-on-surface block">Augmenter mon IMC</span>
                                        <span class="font-label-sm text-label-sm text-on-surface-variant">Gagner du muscle et renforcer ma force</span>
                                    </span>
                                    <span class="material-symbols-outlined text-primary text-[24px]" data-icon="trending_up">trending_up</span>
                                </label>

                                <label class="flex items-center p-sm border-2 border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-lowest transition-all" data-goal="reduce">
                                    <input class="w-4 h-4 accent-primary cursor-pointer" name="goal" type="radio" value="reduce" required />
                                    <span class="ml-sm flex-1">
                                        <span class="font-label-bold text-label-bold text-on-surface block">Réduire mon IMC</span>
                                        <span class="font-label-sm text-label-sm text-on-surface-variant">Perdre du poids et améliorer ma santé</span>
                                    </span>
                                    <span class="material-symbols-outlined text-primary text-[24px]" data-icon="trending_down">trending_down</span>
                                </label>

                                <label class="flex items-center p-sm border-2 border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-lowest transition-all" data-goal="maintain">
                                    <input class="w-4 h-4 accent-primary cursor-pointer" name="goal" type="radio" value="maintain" required />
                                    <span class="ml-sm flex-1">
                                        <span class="font-label-bold text-label-bold text-on-surface block">Maintenir mon IMC</span>
                                        <span class="font-label-sm text-label-sm text-on-surface-variant">Atteindre et maintenir un poids idéal</span>
                                    </span>
                                    <span class="material-symbols-outlined text-primary text-[24px]" data-icon="favorite">favorite</span>
                                </label>
                            </div>

                        </fieldset>

                        <div class="pt-base flex gap-md">
                            <button class="flex-1 text-primary font-label-bold text-label-bold py-sm px-md rounded-lg border-2 border-primary hover:bg-surface-container-lowest active:scale-[0.98] transition-all" type="button" id="backToStep1Btn">
                                Retour
                            </button>
                            <button class="flex-1 bg-primary text-on-primary font-label-bold text-label-bold py-sm px-md rounded-lg shadow-sm hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-xs" type="submit">
                                Créer un compte
                                <span class="material-symbols-outlined text-[18px]" data-icon="check_circle">check_circle</span>
                            </button>
                        </div>
                    </div>
                </form>

                <div id="successMessage" class="hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                    <div class="bg-surface p-lg rounded-xl text-center max-w-sm">
                        <span class="material-symbols-outlined text-[48px] text-primary mb-md block">check_circle</span>
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-xs" id="successTitle">Welcome to VitalFit!</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant" id="successText">Your account has been created successfully.</p>
                    </div>
                </div>

                <div id="errorMessage" class="hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                    <div class="bg-surface p-lg rounded-xl text-center max-w-sm">
                        <span class="material-symbols-outlined text-[48px] text-error mb-md block">error</span>
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Erreur</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-md" id="errorText">Une erreur est survenue</p>
                        <button class="w-full bg-error text-white font-label-bold text-label-bold py-sm px-md rounded-lg" id="closeErrorBtn">Fermer</button>
                    </div>
                </div>

                <div class="mt-lg pt-lg border-t border-surface-container" id="step1Footer">
                    <p class="text-center text-on-surface-variant font-body-md text-body-md">
                        Already have an account?
                        <a class="text-primary font-label-bold hover:underline" href="/login">Log in</a>
                    </p>
                </div>

                <div class="mt-lg grid grid-cols-3 gap-gutter items-center hidden" id="step1Social">
                    <div class="h-[1px] bg-outline-variant"></div>
                    <span class="text-center font-label-sm text-label-sm text-on-surface-variant whitespace-nowrap uppercase tracking-tighter">Or join with</span>
                    <div class="h-[1px] bg-outline-variant"></div>
                </div>
                <div class="mt-md flex gap-md hidden" id="step1SocialButtons">
                    <button class="flex-1 flex items-center justify-center gap-xs py-sm border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors font-label-bold text-label-bold" type="button">
                        <img alt="Google Logo" class="w-5 h-5" data-alt="Official colorful Google G logo icon for third-party authentication purposes." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfH8d4AJjZBRsKfvD0K2P4ONqonusddxTooDNMxrea2lOxj6fEdS_xLGy8tBxdQmpDsWZApvVFGHnn2nVtTUJPGIqieCaxkay6wR6i_tcZN0XOQNCgxhn38RQUsnSgJRtOM3O9GjSn5XKqXA6-zXZN6HjdFEgKOmEy2IK7vldMfJo6bOWmV3IirbXNLc2LA07QZosPhYV14Qx4ahpOTlJuKCOMYkQUfoabi_7eZg7r6OlRPzD5dHbGCkPlVUGRrbp-NNqwu-kOE6M" />
                        Google
                    </button>
                    <button class="flex-1 flex items-center justify-center gap-xs py-sm border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors font-label-bold text-label-bold" type="button">
                        <span class="material-symbols-outlined text-[20px] text-[#000]" data-icon="apple">ios</span>
                        Apple
                    </button>
                </div>

                <footer class="mt-xl text-center">
                    <p class="font-label-sm text-label-sm text-on-surface-variant max-w-[280px] mx-auto">
                        By signing up, you agree to VitalFit's
                        <a class="underline" href="#">Terms of Service</a> and
                        <a class="underline" href="#">Privacy Policy</a>.
                    </p>
                </footer>
            </div>
        </section>
    </main>
    <script>
        // Messages personnalisés chargés depuis le serveur
        const appMessages = <?= $messages ?? '{}' ?>;
    </script>
    <script src="<?= base_url('/assets/js/validation_form.js') ?>" defer></script>
                       

</body>

</html>