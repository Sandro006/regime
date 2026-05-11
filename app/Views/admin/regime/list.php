<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Régimes Admin | VitalFit</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Montserrat:wght@600;700&family=Lexend:wght@600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
    </style>
</head>

<body class="bg-background font-body-lg text-on-background min-h-screen pb-24 md:pb-0">
    <!-- TopAppBar -->
    <header class="bg-surface shadow-sm flex justify-between items-center w-full px-6 py-4 fixed top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display-md text-display-md font-bold text-primary">VitalFit Admin</span>
        </div>
        <div class="hidden md:flex gap-6 items-center">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/admin/dashboard">Dashboard</a>
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="/admin/regime/list">Régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/admin/utilisateur/list">Utilisateurs</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="#">Codes</a>
            <div class="flex items-center gap-3 pl-6 border-l border-outline-variant">
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">
                    <?= strtoupper(substr($admin_name ?? 'A', 0, 1)) ?>
                </div>
                <div class="flex flex-col">
                    <span class="text-body-md font-bold text-on-surface"><?= htmlspecialchars($admin_name ?? 'Admin') ?></span>
                    <a href="/admin/logout" class="text-label-caps text-error hover:font-bold transition-all">Déconnexion</a>
                </div>
            </div>
        </div>
        <div class="md:hidden flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-sm">
                <?= strtoupper(substr($admin_name ?? 'A', 0, 1)) ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20 px-container-margin md:px-6 pb-6">
        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="font-display-lg text-display-lg text-on-surface mb-2">Gestion des Régimes</h1>
                <p class="text-body-lg text-on-surface-variant">Créer, modifier et supprimer les régimes</p>
            </div>
            <a href="/admin/regime/create" class="bg-primary text-on-primary px-6 py-3 rounded-lg font-bold hover:bg-primary/90 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined">add</span>
                Créer Régime
            </a>
        </div>

        <!-- Messages -->
        <?php if (session()->has('success')): ?>
            <div class="bg-primary/10 border-l-4 border-primary text-primary p-4 rounded-lg mb-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->has('errors')): ?>
            <div class="bg-error/10 border-l-4 border-error text-error p-4 rounded-lg mb-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    <span><?= session()->getFlashdata('errors') ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Régimes Table -->
        <div class="bg-surface rounded-xl p-6 shadow-sm">
            <?php if (!empty($regimes)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-outline-variant text-left">
                                <th class="px-4 py-3 text-label-caps text-on-surface-variant">Nom</th>
                                <th class="px-4 py-3 text-label-caps text-on-surface-variant">Prix</th>
                                <th class="px-4 py-3 text-label-caps text-on-surface-variant">Durée (j)</th>
                                <th class="px-4 py-3 text-label-caps text-on-surface-variant">Variation</th>
                                <th class="px-4 py-3 text-label-caps text-on-surface-variant">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($regimes as $regime): ?>
                                <tr class="border-b border-outline-variant/20 hover:bg-surface-container-low transition-colors">
                                    <td class="px-4 py-4 text-body-md text-on-surface font-semibold">
                                        <?= htmlspecialchars($regime['nom_regime']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-body-md text-on-surface">
                                        <?= number_format($regime['prix'], 0) ?> Ar
                                    </td>
                                    <td class="px-4 py-4 text-body-md text-on-surface">
                                        <?= $regime['duree'] ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-3 py-1 bg-primary/10 text-primary rounded-full text-label-caps font-bold">
                                            <?php
                                                $variation = $regime['variation_poids'];
                                                if ($variation > 0) {
                                                    echo '+' . $variation . ' kg';
                                                } else {
                                                    echo $variation . ' kg';
                                                }
                                            ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="/admin/regime/edit/<?= $regime['id'] ?>" class="inline-flex items-center gap-1 px-3 py-2 bg-secondary-container/10 text-secondary-container rounded-lg hover:bg-secondary-container/20 transition-colors text-label-caps font-bold">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                                Modifier
                                            </a>
                                            <form method="POST" action="/admin/regime/delete/<?= $regime['id'] ?>" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce régime?');">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-error/10 text-error rounded-lg hover:bg-error/20 transition-colors text-label-caps font-bold">
                                                    <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-on-surface-variant/50 block mb-4" style="font-size: 48px;">restaurant</span>
                    <p class="text-body-lg text-on-surface-variant mb-4">Aucun régime créé pour le moment</p>
                    <a href="/admin/regime/create" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-lg font-bold hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined">add</span>
                        Créer le premier régime
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>
