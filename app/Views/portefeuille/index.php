<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Recharge Portefeuille - VitalPath</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&amp;family=Lexend:wght@400;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-tint": "#006d37",
                        "surface-container-low": "#eef6eb",
                        "inverse-surface": "#2b322b",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#fc8f34",
                        "secondary": "#944a00",
                        "on-secondary-container": "#663100",
                        "primary": "#006d37",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#005228",
                        "tertiary-fixed-dim": "#ffb59d",
                        "on-surface": "#161d17",
                        "surface-bright": "#f3fcf1",
                        "tertiary-fixed": "#ffdbd0",
                        "on-surface-variant": "#3d4a3e",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#301400",
                        "on-tertiary-container": "#772e14",
                        "primary-container": "#2ecc71",
                        "error-container": "#ffdad6",
                        "tertiary-container": "#ff9875",
                        "on-secondary-fixed-variant": "#713700",
                        "secondary-fixed-dim": "#ffb783",
                        "background": "#f3fcf1",
                        "tertiary": "#98472a",
                        "surface-container-highest": "#dce5da",
                        "on-primary-container": "#005027",
                        "surface-container": "#e8f0e5",
                        "secondary-fixed": "#ffdcc5",
                        "surface-dim": "#d4dcd2",
                        "outline-variant": "#bbcbbb",
                        "on-secondary": "#ffffff",
                        "primary-fixed-dim": "#4ae183",
                        "on-tertiary-fixed": "#390c00",
                        "surface-container-high": "#e2ebe0",
                        "surface": "#f3fcf1",
                        "on-primary-fixed": "#00210c",
                        "primary-fixed": "#6bfe9c",
                        "inverse-on-surface": "#ebf3e8",
                        "on-tertiary-fixed-variant": "#793015",
                        "on-error-container": "#93000a",
                        "outline": "#6c7b6d",
                        "on-background": "#161d17",
                        "error": "#ba1a1a",
                        "surface-variant": "#dce5da",
                        "inverse-primary": "#4ae183"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "16px",
                        "xs": "8px",
                        "gutter": "16px",
                        "lg": "24px",
                        "container-margin": "20px",
                        "xl": "40px",
                        "sm": "12px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "display-md": ["Montserrat"],
                        "display-lg": ["Montserrat"],
                        "label-caps": ["Lexend"],
                        "headline-sm": ["Montserrat"],
                        "metric-xl": ["Lexend"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
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
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "metric-xl": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "700"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
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

        .bg-glass {
            backdrop-filter: blur(12px);
        }

        body {
            background-color: #f3fcf1;
        }
    </style>
</head>

<body class="font-body-md text-on-surface selection:bg-primary-container selection:text-on-primary-container">
    <!-- TopAppBar -->
    <header class="bg-surface/90 dark:bg-inverse-surface/90 font-display-md text-display-md font-bold text-primary dark:text-primary-fixed docked full-width top-0 sticky z-50 backdrop-blur-md shadow-sm dark:shadow-none border-b border-outline-variant/30">
        <div class="flex justify-between items-center w-full px-container-margin py-sm max-w-7xl mx-auto">
            <div class="flex items-center gap-xs">
                <span class="font-display-md text-display-md font-bold text-primary">VitalFit</span>
            </div>
            <nav class="hidden md:flex items-center gap-lg">
                <a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="/">Dashboard</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="/regime">Régimes</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="/activite">Activités</a>
                <a class="text-primary font-bold border-b-2 border-primary font-body-md text-body-md" href="/portefeuille">Portefeuille</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="/profile">Profile</a>
            </nav>
            <div class="flex items-center gap-md">
                <button class="material-symbols-outlined text-on-surface-variant hover:bg-surface-container-high rounded-lg p-2 transition-all active:scale-95" data-icon="notifications">notifications</button>
                <button class="material-symbols-outlined text-on-surface-variant hover:bg-surface-container-high rounded-lg p-2 transition-all active:scale-95" data-icon="settings">settings</button>
                <div class="flex items-center gap-xs">
                    <div class="text-right hidden sm:block">
                        <p class="font-semibold text-on-surface text-body-md"><?php echo isset($user) ? htmlspecialchars($user['username']) : 'Utilisateur'; ?></p>
                        <p class="text-on-surface-variant text-[12px]">VitalFit</p>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-surface-container-highest overflow-hidden border border-outline-variant flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">account_circle</span>
                    </div>
                </div>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/logout" title="Déconnexion">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-container-margin py-xl space-y-xl pb-32">
        <!-- Header Section -->
        <div class="flex flex-col gap-xs">
            <h1 class="font-display-lg text-display-lg text-on-surface">Recharge Portefeuille</h1>
            <div class="flex items-center gap-xs">
                <span class="font-headline-sm text-headline-sm text-on-surface-variant">Solde actuel : <?php echo isset($user) ? number_format($user['solde'] ?? 0, 2) : '0,00'; ?>rAr</span>
            </div>
        </div>
        <div class="mt-xl pt-md border-t border-outline-variant/30">
            <div class="flex items-center gap-xs text-primary font-body-md font-semibold">
                <span class="material-symbols-outlined" data-icon="trending_up">trending_up</span>
                <span><?php echo isset($stats) && isset($stats['total_recharges']) ? '+' . number_format($stats['total_recharges'], 2) . ' Ar' : '+0,00 Ar'; ?> Recharges Totales</span>
            </div>
            <div class="mt-xl pt-md border-t border-outline-variant/30">
                <div class="flex items-center gap-xs text-primary font-body-md font-semibold">
                    <span class="material-symbols-outlined" data-icon="trending_up">trending_up</span>
                    <span><?php echo isset($stats) && isset($stats['monthly_recharges']) ? '+' . number_format($stats['monthly_recharges'], 2) . ' Ar' : '+0,00 Ar'; ?> Ce mois-ci</span>
                </div>
            </div>
        </div>
        <!-- Recharge Action Card -->
        <div class="lg:col-span-8 bg-white rounded-xl p-lg shadow-[0_8px_24px_rgba(0,0,0,0.04)] border border-outline-variant/20">
            <div class="max-w-2xl">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-primary-container/20 border-l-4 border-primary text-on-primary-container p-md rounded-lg mb-md flex items-start gap-md">
                        <span class="material-symbols-outlined text-primary mt-1">check_circle</span>
                        <div>
                            <p class="font-semibold"><?php echo session()->getFlashdata('success'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-error/10 border-l-4 border-error text-error p-md rounded-lg mb-md flex items-start gap-md">
                        <span class="material-symbols-outlined text-error mt-1">error</span>
                        <div>
                            <p class="font-semibold"><?php echo session()->getFlashdata('error'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <h2 class="font-headline-sm text-headline-sm text-on-surface mb-md">Saisir un code de recharge</h2>
                <form action="/portefeuille/validerCode" method="POST" class="flex flex-col md:flex-row gap-md">
                    <div class="flex-grow">
                        <label class="sr-only" for="recharge-code">Code de recharge</label>
                        <input class="w-full bg-surface-container-low border-none rounded-lg px-md py-4 text-display-md font-mono placeholder:text-outline focus:ring-2 focus:ring-primary transition-all uppercase" id="recharge-code" name="code" placeholder="VITAL-XXXX-XXXX" type="text" required />
                    </div>
                    <button type="submit" class="bg-primary hover:bg-surface-tint text-white font-bold px-lg py-4 rounded-lg active:scale-95 transition-all flex items-center justify-center gap-xs">
                        <span class="material-symbols-outlined" data-icon="confirmation_number">confirmation_number</span>
                        Valider le code
                    </button>
                </form>
                <p class="mt-md text-body-md text-on-surface-variant flex items-center gap-xs">
                    <span class="material-symbols-outlined text-primary text-[18px]" data-icon="verified_user">verified_user</span>
                    Transaction sécurisée et crédit instantané.
                </p>
            </div>
        </div>
        <!-- How it Works Section -->
        <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-3 gap-lg">
            <div class="bg-surface-container-low/50 rounded-xl p-lg border border-outline-variant/20">
                <div class="w-12 h-12 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined" data-icon="storefront">storefront</span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-xs">Partenaires</h3>
                <p class="font-body-md text-on-surface-variant">Achetez vos codes auprès de nos pharmacies et centres de fitness partenaires agréés.</p>
            </div>
            <div class="bg-surface-container-low/50 rounded-xl p-lg border border-outline-variant/20">
                <div class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined" data-icon="vpn_key">vpn_key</span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-xs">Code Unique</h3>
                <p class="font-body-md text-on-surface-variant">Chaque code est unique et protégé par un grattage de sécurité pour garantir votre solde.</p>
            </div>
            <div class="bg-surface-container-low/50 rounded-xl p-lg border border-outline-variant/20">
                <div class="w-12 h-12 bg-tertiary-container text-on-tertiary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined" data-icon="bolt">bolt</span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-xs">Instantané</h3>
                <p class="font-body-md text-on-surface-variant">Dès la validation, votre portefeuille est crédité et prêt à être utilisé sur la plateforme.</p>
            </div>
        </div>
        <!-- Transaction History -->
        <div class="lg:col-span-12 bg-white rounded-xl shadow-[0_8px_24px_rgba(0,0,0,0.04)] border border-outline-variant/20 overflow-hidden">
            <div class="px-lg py-md border-b border-outline-variant/20 flex justify-between items-center">
                <h2 class="font-headline-sm text-headline-sm text-on-surface">Historique récent</h2>
                <button class="text-primary font-semibold hover:underline flex items-center gap-xs">
                    Tout voir
                    <span class="material-symbols-outlined text-[18px]" data-icon="chevron_right">chevron_right</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/30">
                            <th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant">Date</th>
                            <th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant">Code</th>
                            <th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant text-right">Montant</th>
                            <th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant text-center">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        <?php if (isset($transactions) && !empty($transactions)): ?>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr class="hover:bg-surface-container-lowest transition-colors">
                                    <td class="px-lg py-md text-body-md"><?php echo date('d M Y, H:i', strtotime($transaction['date_transaction'])); ?></td>
                                    <td class="px-lg py-md text-body-md font-mono"><?php echo htmlspecialchars($transaction['type']); ?></td>
                                    <td class="px-lg py-md text-body-md font-semibold text-right">
                                        <span class="<?php echo $transaction['type'] === 'Recharge' ? 'text-primary' : 'text-error'; ?>"><?php echo ($transaction['type'] === 'Recharge' ? '+ ' : '- ') . number_format($transaction['montant'], 2) . ' Ar'; ?></span>
                                    </td>
                                    <td class="px-lg py-md text-center">
                                        <span class="bg-primary-container/20 text-on-primary-container px-xs py-1 rounded-full text-[12px] font-bold">Complété</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-lg py-md text-center text-on-surface-variant">Aucune transaction pour le moment</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </main>
    <!-- BottomNavBar -->
    <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-safe-offset-4 pt-2 bg-surface/95 dark:bg-inverse-surface/95 backdrop-blur-xl shadow-[0_-8px_24px_rgba(0,0,0,0.06)] md:hidden">
        <a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-surface-variant px-4 py-2 hover:bg-surface-container-low dark:hover:bg-surface-variant/10 rounded-xl transition-all active:scale-90 duration-150 ease-in-out" href="/">
            <span class="material-symbols-outlined" data-icon="home">home</span>
            <span class="font-label-caps text-label-caps mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center bg-primary-container dark:bg-primary-fixed-dim/20 text-on-primary-container dark:text-primary-fixed rounded-xl px-4 py-2 transition-all active:scale-90 duration-150 ease-in-out" href="/portefeuille">
            <span class="material-symbols-outlined" data-icon="account_balance_wallet" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
            <span class="font-label-caps text-label-caps mt-1">Wallet</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-surface-variant px-4 py-2 hover:bg-surface-container-low dark:hover:bg-surface-variant/10 rounded-xl transition-all active:scale-90 duration-150 ease-in-out" href="/activite">
            <span class="material-symbols-outlined" data-icon="monitoring">monitoring</span>
            <span class="font-label-caps text-label-caps mt-1">Activités</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-surface-variant px-4 py-2 hover:bg-surface-container-low dark:hover:bg-surface-variant/10 rounded-xl transition-all active:scale-90 duration-150 ease-in-out" href="/profile">
            <span class="material-symbols-outlined" data-icon="person">person</span>
            <span class="font-label-caps text-label-caps mt-1">Profile</span>
        </a>
    </nav>
</body>

</html>