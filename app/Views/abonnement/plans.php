<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Nos Plans | VitalFit</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&amp;family=Montserrat:wght@600;700&amp;family=Lexend:wght@600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#ff9875",
                        "on-tertiary-fixed": "#390c00",
                        "on-background": "#161d17",
                        "on-primary": "#ffffff",
                        "outline-variant": "#bbcbbb",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#663100",
                        "on-tertiary-container": "#772e14",
                        "primary-container": "#2ecc71",
                        "on-secondary-fixed-variant": "#713700",
                        "tertiary-fixed-dim": "#ffb59d",
                        "outline": "#6c7b6d",
                        "surface-tint": "#006d37",
                        "primary": "#006d37",
                        "surface-dim": "#d4dcd2",
                        "inverse-primary": "#4ae183",
                        "tertiary-fixed": "#ffdbd0",
                        "on-primary-fixed": "#00210c",
                        "surface-container": "#e8f0e5",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#dce5da",
                        "on-primary-container": "#005027",
                        "inverse-surface": "#2b322b",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-surface": "#161d17",
                        "on-error-container": "#93000a",
                        "surface-variant": "#dce5da",
                        "surface-container-low": "#eef6eb",
                        "surface": "#f3fcf1",
                        "primary-fixed-dim": "#4ae183",
                        "on-tertiary-fixed-variant": "#793015",
                        "error": "#ba1a1a",
                        "surface-container-high": "#e2ebe0",
                        "secondary-container": "#fc8f34",
                        "inverse-on-surface": "#ebf3e8",
                        "on-secondary-fixed": "#301400",
                        "surface-bright": "#f3fcf1",
                        "background": "#f3fcf1",
                        "tertiary": "#98472a",
                        "on-primary-fixed-variant": "#005228",
                        "on-surface-variant": "#3d4a3e",
                        "primary-fixed": "#6bfe9c",
                        "secondary-fixed-dim": "#ffb783",
                        "secondary": "#944a00",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#ffdcc5"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-margin": "20px",
                        "xs": "8px",
                        "base": "4px",
                        "md": "16px",
                        "sm": "12px",
                        "lg": "24px",
                        "gutter": "16px",
                        "xl": "40px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "display-lg": ["Montserrat"],
                        "metric-xl": ["Lexend"],
                        "display-md": ["Montserrat"],
                        "headline-sm": ["Montserrat"],
                        "label-caps": ["Lexend"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "display-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "metric-xl": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "700"
                        }],
                        "display-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
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

        body {
            background-color: #F8F9FA;
            color: #161d17;
        }

        .plan-card {
            transition: all 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .plan-card.featured {
            border: 3px solid #006d37;
            background: linear-gradient(135deg, #f3fcf1 0%, #e8f0e5 100%);
        }

        .badge-featured {
            background: linear-gradient(135deg, #006d37, #2ecc71);
            color: white;
        }
    </style>
</head>

<body class="bg-background font-body-lg text-on-background min-h-screen pb-24 md:pb-0">
    <!-- TopAppBar -->
    <header class="bg-surface shadow-sm flex justify-between items-center w-full px-6 py-4 fixed top-0 z-50">
        <div class="flex items-center gap-2">
            <a href="/" class="font-display-md text-display-md font-bold text-primary">VitalFit</a>
        </div>
        <div class="hidden md:flex gap-6">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/">Tableau de bord</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/regime/list">Régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/activite/list">Activités</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/portefeuille">Portefeuille</a>
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="/abonnement/plans">Plans</a>
            <?php if (session()->get('estConnecte')) { ?>
                <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/profile">Profil</a>
            <?php } ?>
            <div class="flex items-center gap-4">
                <?php if (!session()->get('estConnecte')) { ?>
                    <a href="/login" class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">login</span>
                        <span class="text-sm font-medium hidden sm:inline">Se connecter</span>
                    </a>
                <?php } else { ?>
                    <a href="/logout" class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                <?php } ?>
                <?php if (session()->get('estConnecte')) { ?>
                    <a href="/profile" class="w-10 h-10 rounded-full overflow-hidden bg-surface-container-highest border-2 border-primary-container hover:shadow-lg transition-shadow">
                        <img alt="User profile avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?background=2ecc71&color=fff&bold=true&name=User" />
                    </a>
                <?php } ?>
            </div>
        </div>
    </header>

    <main class="pt-24 px-container-margin max-w-7xl mx-auto space-y-xl pb-12">
        <!-- Hero Section -->
        <section class="text-center py-12 space-y-md">
            <h1 class="font-display-lg text-display-lg text-primary">Débloquez Votre Potentiel</h1>
            <p class="text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                Choisissez le plan qui vous convient et accédez à des régimes personnalisés,
                des conseils d'experts, et bien plus encore pour transformer votre santé.
            </p>
        </section>

        <!-- Messages Flash -->
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="bg-primary-container/30 border-l-4 border-primary p-lg rounded-lg flex items-center gap-md">
                <span class="material-symbols-outlined text-primary text-2xl">check_circle</span>
                <span class="text-on-surface"><?php echo session()->getFlashdata('success'); ?></span>
            </div>
        <?php } ?>

        <?php if (session()->getFlashdata('error')) { ?>
            <div class="bg-error-container/30 border-l-4 border-error p-lg rounded-lg flex items-center gap-md">
                <span class="material-symbols-outlined text-error text-2xl">error</span>
                <span class="text-on-surface"><?php echo session()->getFlashdata('error'); ?></span>
            </div>
        <?php } ?>

        <!-- Plans Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-lg py-12">
            <!-- Plan Gold -->
            <div class="plan-card bg-surface-container-lowest rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container overflow-hidden">
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-lg text-white">
                    <h2 class="text-headline-sm font-bold mb-xs">Gold</h2>
                    <p class="text-sm opacity-90">Débutant</p>
                </div>
                <div class="p-lg space-y-lg">
                    <!-- Price -->
                    <div class="space-y-xs">
                        <div class="flex items-baseline gap-sm">
                            <span class="text-metric-xl font-bold text-primary">10 000</span>
                            <span class="text-on-surface-variant">Ar</span>
                        </div>
                        <p class="text-on-surface-variant text-body-md">Accès illimité, achat unique</p>
                    </div>

                    <!-- Features -->
                    <div class="space-y-sm border-y border-surface-container py-lg">
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">5 régimes personnalisés</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">Suivi des objectifs</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">Remise 15% sur achats</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-on-surface-variant text-xl">close</span>
                            <span class="text-body-md text-on-surface-variant">Conseil premium</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-on-surface-variant text-xl">close</span>
                            <span class="text-body-md text-on-surface-variant">API avancée</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button onclick="acheterPlan('gold')" class="w-full bg-primary text-on-primary py-sm rounded-lg font-semibold hover:opacity-90 transition-opacity active:scale-95">
                        Débloquer ce plan
                    </button>
                </div>
            </div>

            <!-- Plan Premium -->
            <div class="plan-card featured bg-surface-container-lowest rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] overflow-hidden relative">
                <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                    <span class="badge-featured px-md py-xs rounded-full text-label-caps font-bold text-xs">
                        ⭐ PLUS POPULAIRE
                    </span>
                </div>
                <div class="bg-gradient-to-br from-orange-400 to-orange-500 p-lg text-white">
                    <h2 class="text-headline-sm font-bold mb-xs">Premium</h2>
                    <p class="text-sm opacity-90">Professionnel</p>
                </div>
                <div class="p-lg space-y-lg">
                    <!-- Price -->
                    <div class="space-y-xs">
                        <div class="flex items-baseline gap-sm">
                            <span class="text-metric-xl font-bold text-primary">25 000</span>
                            <span class="text-on-surface-variant">Ar</span>
                        </div>
                        <p class="text-on-surface-variant text-body-md">Accès illimité, achat unique</p>
                    </div>

                    <!-- Features -->
                    <div class="space-y-sm border-y border-surface-container py-lg">
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md font-semibold">15 régimes personnalisés</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md font-semibold">Suivi avancé</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md font-semibold">Remise 20% sur achats</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md font-semibold">Conseil premium</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-on-surface-variant text-xl">close</span>
                            <span class="text-body-md text-on-surface-variant">API avancée</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button onclick="acheterPlan('premium')" class="w-full bg-primary text-on-primary py-sm rounded-lg font-semibold hover:opacity-90 transition-opacity active:scale-95">
                        Débloquer ce plan
                    </button>
                </div>
            </div>

            <!-- Plan Platinium -->
            <div class="plan-card bg-surface-container-lowest rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container overflow-hidden">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-lg text-white">
                    <h2 class="text-headline-sm font-bold mb-xs">Platinium</h2>
                    <p class="text-sm opacity-90">Ultime</p>
                </div>
                <div class="p-lg space-y-lg">
                    <!-- Price -->
                    <div class="space-y-xs">
                        <div class="flex items-baseline gap-sm">
                            <span class="text-metric-xl font-bold text-primary">80 000</span>
                            <span class="text-on-surface-variant">Ar</span>
                        </div>
                        <p class="text-on-surface-variant text-body-md">Accès illimité, achat unique</p>
                    </div>

                    <!-- Features -->
                    <div class="space-y-sm border-y border-surface-container py-lg">
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">Régimes illimités</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">Suivi en temps réel</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">Remise 30% sur achats</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">Conseil premium prioritaire</span>
                        </div>
                        <div class="flex items-center gap-sm">
                            <span class="material-symbols-outlined text-primary text-xl">check</span>
                            <span class="text-body-md">API avancée illimitée</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button onclick="acheterPlan('platinium')" class="w-full bg-primary text-on-primary py-sm rounded-lg font-semibold hover:opacity-90 transition-opacity active:scale-95">
                        Débloquer ce plan
                    </button>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-12 space-y-lg">
            <h2 class="text-display-md text-center mb-lg">Questions Fréquentes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="bg-surface-container-lowest p-lg rounded-xl border border-surface-container">
                    <h3 class="text-headline-sm font-bold mb-sm text-primary">Puis-je changer de plan ?</h3>
                    <p class="text-body-md text-on-surface-variant">
                        Bien sûr ! Vous pouvez passer à un plan supérieur à tout moment.
                        La différence de prix sera ajustée au prorata.
                    </p>
                </div>
                <div class="bg-surface-container-lowest p-lg rounded-xl border border-surface-container">
                    <h3 class="text-headline-sm font-bold mb-sm text-primary">Y a-t-il une garantie ?</h3>
                    <p class="text-body-md text-on-surface-variant">
                        Pas satisfait ? Remboursement complet dans les 30 jours,
                        aucune question posée.
                    </p>
                </div>
                <div class="bg-surface-container-lowest p-lg rounded-xl border border-surface-container">
                    <h3 class="text-headline-sm font-bold mb-sm text-primary">Puis-je annuler ?</h3>
                    <p class="text-body-md text-on-surface-variant">
                        Vous pouvez annuler votre abonnement à tout moment.
                        L'accès continue jusqu'à la fin de la période payée.
                    </p>
                </div>
                <div class="bg-surface-container-lowest p-lg rounded-xl border border-surface-container">
                    <h3 class="text-headline-sm font-bold mb-sm text-primary">Comment fonctionnent les remises ?</h3>
                    <p class="text-body-md text-on-surface-variant">
                        Les remises s'appliquent automatiquement à tous vos achats
                        pendant la durée de votre abonnement.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script>
        function acheterPlan(plan) {
            <?php if (!session()->get('estConnecte')) { ?>
                alert('Veuillez vous connecter pour acheter un plan');
                window.location.href = '/login';
                return;
            <?php } ?>
            
            window.location.href = `/abonnement/acheter?plan=${plan}`;
        }
    </script>
</body>

</html>
