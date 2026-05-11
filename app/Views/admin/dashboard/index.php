<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Admin | VitalFit</title>
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

        .sidebar-menu-item {
            @apply flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:bg-primary/10 hover:text-primary transition-colors cursor-pointer;
        }

        .sidebar-menu-item.active {
            @apply bg-primary-container text-on-primary-container;
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-surface border-r-2 border-outline-variant/30 p-md flex flex-col overflow-y-auto">
            <!-- Logo/Header -->
            <div class="mb-lg pb-md border-b-2 border-outline-variant/30">
                <h2 class="font-display-md text-display-md text-primary">VitalFit</h2>
                <p class="font-body-md text-on-surface-variant text-sm">Administration</p>
            </div>

            <!-- Menu Items -->
            <nav class="flex-1 space-y-sm">
                <!-- Dashboard -->
                <div class="sidebar-menu-item active">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </div>

                <!-- Divider -->
                <div class="my-md border-t border-outline-variant/30"></div>

                <!-- Gestion Utilisateurs -->
                <div class="font-label-caps text-label-caps text-on-surface-variant/60 px-md mb-xs">
                    UTILISATEURS
                </div>
                <a href="#" class="sidebar-menu-item">
                    <span class="material-symbols-outlined">people</span>
                    <span>Utilisateurs</span>
                </a>

                <!-- Divider -->
                <div class="my-md border-t border-outline-variant/30"></div>

                <!-- Gestion Contenu -->
                <div class="font-label-caps text-label-caps text-on-surface-variant/60 px-md mb-xs">
                    CONTENU
                </div>
                <a href="#" class="sidebar-menu-item">
                    <span class="material-symbols-outlined">restaurant</span>
                    <span>Régimes</span>
                </a>
                <a href="#" class="sidebar-menu-item">
                    <span class="material-symbols-outlined">fitness_center</span>
                    <span>Activités</span>
                </a>

                <!-- Divider -->
                <div class="my-md border-t border-outline-variant/30"></div>

                <!-- Gestion Commerce -->
                <div class="font-label-caps text-label-caps text-on-surface-variant/60 px-md mb-xs">
                    COMMERCE
                </div>
                <a href="#" class="sidebar-menu-item">
                    <span class="material-symbols-outlined">discount</span>
                    <span>Codes Recharge</span>
                </a>
                <a href="#" class="sidebar-menu-item">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Paramètres</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="border-t border-outline-variant/30 pt-md">
                <a href="/admin/logout" class="sidebar-menu-item text-error hover:bg-error/10">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Déconnexion</span>
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-hidden bg-background">
            <!-- TOP BAR -->
            <header class="bg-surface border-b-2 border-outline-variant/30 px-lg py-md flex items-center justify-between">
                <div>
                    <h1 class="font-display-md text-display-md text-on-surface">Dashboard</h1>
                    <p class="font-body-md text-on-surface-variant text-sm">Bienvenue <?= htmlspecialchars($admin_name ?? 'Admin') ?></p>
                </div>
                <div class="flex items-center gap-md">
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">
                        <?= strtoupper(substr($admin_name ?? 'A', 0, 1)) ?>
                    </div>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <div class="flex-1 overflow-y-auto p-lg">
                <!-- STATISTICS CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-md mb-lg">
                    <!-- Total Users Card -->
                    <div class="bg-surface rounded-xl p-md border-2 border-primary/30 hover:shadow-lg transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Utilisateurs</p>
                                <h3 class="font-metric-xl text-metric-xl text-primary"><?= number_format($total_users) ?></h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary" style="font-size: 28px;">people</span>
                            </div>
                        </div>
                        <p class="font-body-md text-on-surface-variant text-sm mt-md">Utilisateurs actifs</p>
                    </div>

                    <!-- Total Revenue Card -->
                    <div class="bg-surface rounded-xl p-md border-2 border-secondary-container/30 hover:shadow-lg transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Revenu</p>
                                <h3 class="font-metric-xl text-metric-xl text-secondary-container"><?= number_format($total_revenue, 0) ?> Ar</h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-secondary-container/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-secondary-container" style="font-size: 28px;">attach_money</span>
                            </div>
                        </div>
                        <p class="font-body-md text-on-surface-variant text-sm mt-md">Revenu total</p>
                    </div>

                    <!-- Gold Users Card -->
                    <div class="bg-surface rounded-xl p-md border-2 border-tertiary/30 hover:shadow-lg transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Membres Gold</p>
                                <h3 class="font-metric-xl text-metric-xl text-tertiary"><?= number_format($total_gold_users) ?></h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-tertiary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-tertiary" style="font-size: 28px;">star</span>
                            </div>
                        </div>
                        <p class="font-body-md text-on-surface-variant text-sm mt-md">Utilisateurs premium</p>
                    </div>

                    <!-- Conversion Rate Card -->
                    <div class="bg-surface rounded-xl p-md border-2 border-error/30 hover:shadow-lg transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Taux Conv.</p>
                                <h3 class="font-metric-xl text-metric-xl text-error">
                                    <?php
                                        $conversion = $total_users > 0 ? round(($total_gold_users / $total_users) * 100, 1) : 0;
                                        echo $conversion . '%';
                                    ?>
                                </h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-error/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-error" style="font-size: 28px;">trending_up</span>
                            </div>
                        </div>
                        <p class="font-body-md text-on-surface-variant text-sm mt-md">Utilisateurs Gold / Total</p>
                    </div>
                </div>

                <!-- TOP REGIMES TABLE -->
                <div class="bg-surface rounded-xl p-md border-2 border-outline-variant/30">
                    <div class="mb-md">
                        <h2 class="font-headline-sm text-headline-sm text-on-surface">Régimes Populaires</h2>
                        <p class="font-body-md text-on-surface-variant text-sm">Top 3 régimes les plus vendus</p>
                    </div>

                    <?php if (!empty($top_regimes)): ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-outline-variant/30">
                                        <th class="text-left px-md py-sm font-label-caps text-label-caps text-on-surface-variant">Régime</th>
                                        <th class="text-left px-md py-sm font-label-caps text-label-caps text-on-surface-variant">Prix</th>
                                        <th class="text-left px-md py-sm font-label-caps text-label-caps text-on-surface-variant">Ventes</th>
                                        <th class="text-left px-md py-sm font-label-caps text-label-caps text-on-surface-variant">Revenu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($top_regimes as $index => $regime): ?>
                                        <tr class="border-b border-outline-variant/20 hover:bg-surface-container-low transition-colors">
                                            <td class="px-md py-md font-body-md text-on-surface">
                                                <div class="flex items-center gap-md">
                                                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center font-label-caps">
                                                        #<?= $index + 1 ?>
                                                    </div>
                                                    <?= htmlspecialchars($regime['nom_regime']) ?>
                                                </div>
                                            </td>
                                            <td class="px-md py-md font-body-md text-on-surface">
                                                <?= number_format($regime['prix'], 0) ?> Ar
                                            </td>
                                            <td class="px-md py-md">
                                                <span class="inline-flex items-center gap-xs px-md py-xs rounded-full bg-primary/10 text-primary font-label-caps">
                                                    <span class="material-symbols-outlined text-sm">shopping_bag</span>
                                                    <?= $regime['ventes'] ?>
                                                </span>
                                            </td>
                                            <td class="px-md py-md font-headline-sm text-headline-sm text-primary font-bold">
                                                <?= number_format($regime['prix'] * $regime['ventes'], 0) ?> Ar
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-lg">
                            <span class="material-symbols-outlined text-on-surface-variant/50" style="font-size: 48px; display: block;">info</span>
                            <p class="font-body-md text-on-surface-variant mt-md">Pas de régimes vendus pour le moment</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
