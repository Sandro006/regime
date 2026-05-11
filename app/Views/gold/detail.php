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

        .subscription-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .subscription-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
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
            <a href="/profile" class="inline-flex items-center gap-sm text-primary font-label-caps hover:underline mb-md">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour au profil
            </a>
            <h1 class="font-display-lg text-display-lg mb-md">Mon Abonnement</h1>
            <p class="text-on-surface-variant font-body-lg text-body-lg">Gérez votre abonnement et consultez vos avantages</p>
        </section>

        <!-- Active Subscription -->
        <?php if ($abonnement): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-xl">
            <!-- Main Subscription Card -->
            <div class="md:col-span-2 subscription-card bg-gradient-to-br from-primary-fixed-dim to-primary text-on-primary p-lg rounded-xl shadow-lg">
                <div class="flex justify-between items-start mb-lg">
                    <div>
                        <span class="material-symbols-outlined text-4xl mb-md" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <h2 class="font-headline-sm text-headline-sm">Abonnement Actif</h2>
                    </div>
                    <span class="bg-white/20 px-md py-sm rounded-lg font-label-caps text-label-caps uppercase tracking-widest">Actif</span>
                </div>

                <div class="space-y-lg mb-lg pb-lg border-b border-white/20">
                    <div>
                        <p class="font-label-caps text-label-caps opacity-80 mb-xs">Date d'Activation</p>
                        <p class="font-body-lg text-body-lg"><?php echo date('d F Y', strtotime($abonnement['date_activation'])); ?></p>
                    </div>

                    <div>
                        <p class="font-label-caps text-label-caps opacity-80 mb-xs">Date d'Expiration</p>
                        <?php if ($abonnement['date_expiration']): ?>
                        <p class="font-body-lg text-body-lg"><?php echo date('d F Y', strtotime($abonnement['date_expiration'])); ?></p>
                        <p class="text-[12px] opacity-80">
                            <?php 
                                $now = new DateTime();
                                $expiration = new DateTime($abonnement['date_expiration']);
                                $days = $expiration->diff($now)->days;
                                echo "Plus que " . $days . " jours";
                            ?>
                        </p>
                        <?php else: ?>
                        <p class="font-body-lg text-body-lg">Illimitée ∞</p>
                        <p class="text-[12px] opacity-80">Pas d'expiration</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <p class="font-label-caps text-label-caps opacity-80 mb-xs">Prix Payé</p>
                    <h3 class="font-metric-xl text-metric-xl"><?php echo number_format($abonnement['prix'], 2); ?>Ar</h3>
                </div>
            </div>

            <!-- Benefits Card -->
            <div class="subscription-card bg-surface-container-lowest p-lg rounded-xl shadow-md border border-surface-variant/20">
                <h3 class="font-headline-sm text-headline-sm mb-lg flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">card_membership</span>
                    Vos Avantages
                </h3>

                <ul class="space-y-md">
                    <li class="flex items-start gap-md">
                        <span class="material-symbols-outlined text-secondary flex-shrink-0 mt-1" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <div>
                            <p class="font-body-md font-semibold">Réductions exclusives</p>
                            <p class="text-[12px] text-on-surface-variant">Jusqu'à 15-20% sur les régimes</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-md">
                        <span class="material-symbols-outlined text-secondary flex-shrink-0 mt-1" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <div>
                            <p class="font-body-md font-semibold">Accès prioritaire</p>
                            <p class="text-[12px] text-on-surface-variant">Aux nouveaux régimes et plans</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-md">
                        <span class="material-symbols-outlined text-secondary flex-shrink-0 mt-1" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <div>
                            <p class="font-body-md font-semibold">Support prioritaire</p>
                            <p class="text-[12px] text-on-surface-variant">Assistance client 24/7</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Subscription History -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-md border border-surface-variant/20">
            <h3 class="font-headline-sm text-headline-sm mb-lg flex items-center gap-sm">
                <span class="material-symbols-outlined text-primary">history</span>
                Historique d'Abonnement
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-surface-variant">
                            <th class="text-left py-md px-md font-label-caps text-label-caps text-on-surface-variant">Activation</th>
                            <th class="text-left py-md px-md font-label-caps text-label-caps text-on-surface-variant">Expiration</th>
                            <th class="text-right py-md px-md font-label-caps text-label-caps text-on-surface-variant">Montant</th>
                            <th class="text-center py-md px-md font-label-caps text-label-caps text-on-surface-variant">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tousAbonnements as $sub): ?>
                        <tr class="border-b border-surface-variant last:border-0 hover:bg-surface-variant/10 transition-colors">
                            <td class="py-md px-md font-body-md"><?php echo date('d/m/Y', strtotime($sub['date_activation'])); ?></td>
                            <td class="py-md px-md font-body-md">
                                <?php echo $sub['date_expiration'] ? date('d/m/Y', strtotime($sub['date_expiration'])) : '∞'; ?>
                            </td>
                            <td class="py-md px-md font-body-md text-right text-secondary"><?php echo number_format($sub['prix'], 2); ?>Ar</td>
                            <td class="py-md px-md text-center">
                                <?php 
                                    $now = new DateTime();
                                    $expiration = new DateTime($sub['date_expiration'] ?? 'now');
                                    $isActive = !$sub['date_expiration'] || $expiration > $now;
                                ?>
                                <?php if ($isActive): ?>
                                <span class="inline-flex items-center gap-xs bg-primary-container/30 text-primary px-md py-xs rounded-full font-label-caps text-[10px]">
                                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    Actif
                                </span>
                                <?php else: ?>
                                <span class="inline-flex items-center gap-xs bg-outline/30 text-on-surface-variant px-md py-xs rounded-full font-label-caps text-[10px]">
                                    <span class="material-symbols-outlined text-[12px]">check_circle</span>
                                    Expiré
                                </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php else: ?>
        <!-- No Subscription -->
        <div class="text-center py-xl">
            <div class="flex justify-center mb-lg">
                <div class="bg-secondary-container/20 p-lg rounded-full">
                    <span class="material-symbols-outlined text-5xl text-secondary">card_membership</span>
                </div>
            </div>
            <h2 class="font-headline-sm text-headline-sm mb-md">Pas d'abonnement actif</h2>
            <p class="text-on-surface-variant font-body-lg text-body-lg mb-lg max-w-md mx-auto">Activez un abonnement pour profiter de réductions exclusives et d'avantages premium.</p>
            <a href="/abonnement/acheter" class="inline-flex items-center gap-sm px-lg py-md bg-secondary text-on-secondary rounded-lg font-label-caps text-label-caps font-bold hover:shadow-lg active:scale-95 transition-all">
                <span class="material-symbols-outlined">shopping_cart</span>
                Découvrir les plans
            </a>
        </div>
        <?php endif; ?>
    </main>
</body>

</html>
