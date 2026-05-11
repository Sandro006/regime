<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Lexend:wght@600;700&amp;family=Montserrat:wght@600;700;800&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#bbcbbb",
                        "secondary-fixed": "#ffdcc5",
                        "primary": "#006d37",
                        "on-surface-variant": "#3d4a3e",
                        "on-secondary": "#ffffff",
                        "tertiary-container": "#ff9875",
                        "outline": "#6c7b6d",
                        "inverse-on-surface": "#ebf3e8",
                        "on-primary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-primary-fixed": "#00210c",
                        "tertiary-fixed-dim": "#ffb59d",
                        "on-secondary-fixed-variant": "#713700",
                        "surface-variant": "#dce5da",
                        "inverse-primary": "#4ae183",
                        "on-tertiary-fixed-variant": "#793015",
                        "surface-container-low": "#eef6eb",
                        "on-primary-container": "#005027",
                        "secondary-fixed-dim": "#ffb783",
                        "secondary": "#944a00",
                        "on-primary-fixed-variant": "#005228",
                        "on-secondary-fixed": "#301400",
                        "surface-tint": "#006d37",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e2ebe0",
                        "secondary-container": "#fc8f34",
                        "on-background": "#161d17",
                        "primary-fixed-dim": "#4ae183",
                        "on-surface": "#161d17",
                        "primary-fixed": "#6bfe9c",
                        "tertiary": "#98472a",
                        "inverse-surface": "#2b322b",
                        "surface": "#f3fcf1",
                        "error": "#ba1a1a",
                        "surface-container": "#e8f0e5",
                        "surface-bright": "#f3fcf1",
                        "on-tertiary-container": "#772e14",
                        "on-secondary-container": "#663100",
                        "background": "#f3fcf1",
                        "on-tertiary-fixed": "#390c00",
                        "primary-container": "#2ecc71",
                        "surface-dim": "#d4dcd2",
                        "surface-container-highest": "#dce5da",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#ffdbd0"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "8px",
                        "sm": "12px",
                        "md": "16px",
                        "base": "4px",
                        "gutter": "16px",
                        "container-margin": "20px",
                        "xl": "40px",
                        "lg": "24px"
                    },
                    "fontFamily": {
                        "label-caps": ["Lexend"],
                        "body-md": ["Inter"],
                        "display-md": ["Montserrat"],
                        "headline-sm": ["Montserrat"],
                        "display-lg": ["Montserrat"],
                        "metric-xl": ["Lexend"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
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
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
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

        body {
            background-color: #F8F9FA;
            scroll-behavior: smooth;
        }

        .plan-card {
            transition: all 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .plan-card.selected {
            border-color: #006d37;
            box-shadow: 0 0 0 3px rgba(0, 109, 55, 0.1);
        }
    </style>
</head>

<body class="font-body-md text-on-surface">
    <!-- TopAppBar -->
    <header class="bg-surface dark:bg-surface-dim shadow-sm flex justify-between items-center w-full px-container-margin py-md sticky top-0 z-50">
        <div class="flex items-center gap-md">
            <a href="/" class="font-display-md text-display-md font-bold text-primary dark:text-primary-fixed-dim hover:opacity-80 transition-opacity">VitalFit</a>
        </div>
        <div class="hidden md:flex gap-lg">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/profile">Profile</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/portefeuille">Portefeuille</a>
        </div>
        <div class="flex items-center gap-md">
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/logout">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-container-margin py-xl pb-32">
        <!-- Page Header -->
        <section class="mb-xl">
            <h1 class="font-display-lg text-display-lg mb-md">Abonnements Premium</h1>
            <p class="text-on-surface-variant font-body-lg text-body-lg max-w-2xl">Accédez à des réductions exclusives et des avantages premium en choisissant le plan qui vous convient.</p>
        </section>

        <!-- Messages d'alerte -->
        <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-lg p-lg bg-error-container text-on-error-container rounded-xl border border-error flex items-start gap-md">
            <span class="material-symbols-outlined flex-shrink-0" style="font-variation-settings: 'FILL' 1;">error</span>
            <p class="font-body-lg text-body-lg"><?php echo session()->getFlashdata('error'); ?></p>
        </div>
        <?php endif; ?>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-xl mb-xl">
            <?php foreach ($abonnementOptions as $plan_id => $plan): ?>
            <div class="plan-card bg-surface-container-lowest p-lg rounded-xl shadow-md border-2 border-surface-variant <?php echo $plan === $selectedPlan ? 'selected' : ''; ?>">
                <!-- Plan Badge -->
                <?php if ($plan_id === 'platine'): ?>
                <div class="mb-md">
                    <span class="inline-block bg-tertiary-container text-on-tertiary-container font-label-caps text-[10px] px-md py-xs rounded-full uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        Most Popular
                    </span>
                </div>
                <?php endif; ?>

                <!-- Plan Header -->
                <div class="mb-lg pb-lg border-b border-surface-variant">
                    <h2 class="font-headline-sm text-headline-sm mb-md"><?php echo $plan['nom']; ?></h2>
                    <div class="flex items-baseline gap-base mb-md">
                        <span class="font-metric-xl text-metric-xl text-secondary"><?php echo number_format($plan['prix'], 2); ?>Ar</span>
                        <span class="text-on-surface-variant font-body-md">/ <?php echo $plan['duree']; ?> days</span>
                    </div>
                    <p class="text-on-surface-variant font-body-md">Réduction de <span class="font-bold text-secondary"><?php echo $plan['remise']; ?>%</span> sur les régimes</p>
                </div>

                <!-- Benefits List -->
                <ul class="mb-lg space-y-md">
                    <?php foreach ($plan['benefits'] as $benefit): ?>
                    <li class="flex items-start gap-md">
                        <span class="material-symbols-outlined text-primary flex-shrink-0 mt-1" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <span class="font-body-md text-body-md"><?php echo $benefit; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Form -->
                <form method="POST" action="/abonnement/confirmer" style="display: block;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="plan" value="<?php echo $plan_id; ?>" />
                    <button type="submit" style="width: 100%; padding: 16px; background-color: #944a00; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                        🛒 S'abonner à <?php echo $plan['nom']; ?>
                    </button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Wallet & Balance Info -->
        <div class="bg-surface-container p-lg rounded-xl border border-surface-variant/20">
            <h3 class="font-headline-sm text-headline-sm mb-md flex items-center gap-sm">
                <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                Votre Portefeuille
            </h3>
            <div class="grid grid-cols-2 gap-lg">
                <div>
                    <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Solde Actuel</p>
                    <h3 class="font-metric-xl text-metric-xl text-primary"><?php echo number_format($user['solde'], 2); ?>Ar</h3>
                </div>
                <div>
                    <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Prix de l'Abonnement</p>
                    <h3 class="font-metric-xl text-metric-xl text-secondary"><?php echo number_format($selectedPlan['prix'], 2); ?>Ar</h3>
                </div>
            </div>

            <?php if ($user['solde'] < $selectedPlan['prix']): ?>
            <div class="mt-lg p-md bg-error-container/20 border border-error-container rounded-lg">
                <p class="text-error font-body-md mb-md flex items-center gap-sm">
                    <span class="material-symbols-outlined">warning</span>
                    Solde insuffisant pour l'abonnement sélectionné
                </p>
                <a href="/portefeuille" class="inline-flex items-center gap-sm text-secondary font-label-caps hover:underline">
                    <span class="material-symbols-outlined">add_circle</span>
                    Recharger votre portefeuille
                </a>
            </div>
            <?php else: ?>
            <div class="mt-lg p-md bg-primary-container/20 border border-primary-container rounded-lg">
                <p class="text-primary font-body-md flex items-center gap-sm">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    Vous avez suffisamment de solde pour l'abonnement
                </p>
            </div>
            <?php endif; ?>
        </div>

        <!-- FAQ Section -->
        <div class="mt-xl">
            <h3 class="font-headline-sm text-headline-sm mb-lg flex items-center gap-sm">
                <span class="material-symbols-outlined text-primary">help</span>
                Questions Fréquentes
            </h3>

            <div class="space-y-md">
                <details class="group bg-surface-container p-lg rounded-lg border border-surface-variant/20 cursor-pointer">
                    <summary class="font-headline-sm text-headline-sm flex justify-between items-center select-none">
                        Puis-je annuler mon abonnement?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-md text-on-surface-variant font-body-md">Vous pouvez annuler votre abonnement à tout moment. Les remboursements ne sont pas disponibles pour les périodes restantes, mais votre accès continuera jusqu'à la date d'expiration.</p>
                </details>

                <details class="group bg-surface-container p-lg rounded-lg border border-surface-variant/20 cursor-pointer">
                    <summary class="font-headline-sm text-headline-sm flex justify-between items-center select-none">
                        Y a-t-il une différence entre Gold et Platine?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-md text-on-surface-variant font-body-md">Oui! Le plan Platine offre une réduction plus importante (20% vs 15%), l'accès aux régimes premium, et un support client 24/7 prioritaire. Gold offre les réductions de base et l'accès prioritaire aux nouveaux régimes.</p>
                </details>

                <details class="group bg-surface-container p-lg rounded-lg border border-surface-variant/20 cursor-pointer">
                    <summary class="font-headline-sm text-headline-sm flex justify-between items-center select-none">
                        Puis-je passer à un plan supérieur?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-md text-on-surface-variant font-body-md">Oui! Vous pouvez passer à un plan supérieur à tout moment. Les frais seront ajustés au prorata de votre abonnement actuel.</p>
                </details>
            </div>
        </div>
    </main>
</body>

</html>
