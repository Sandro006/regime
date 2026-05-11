<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Détails Utilisateur | VitalFit</title>
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
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/admin/regime/list">Régimes</a>
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="/admin/utilisateur/list">Utilisateurs</a>
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
        <div class="mb-8">
            <a href="/admin/utilisateur/list" class="text-primary hover:text-primary/80 transition-colors flex items-center gap-1 mb-4">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour à la liste
            </a>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-2xl">
                    <?= strtoupper(substr($user['username'] ?? 'U', 0, 1)) ?>
                </div>
                <div>
                    <h1 class="font-display-lg text-display-lg text-on-surface"><?= htmlspecialchars($user['username'] ?? '') ?></h1>
                    <p class="text-body-lg text-on-surface-variant"><?= htmlspecialchars($user['email'] ?? '') ?></p>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Solde -->
            <div class="bg-surface rounded-xl p-6 shadow-sm border-l-4 border-primary">
                <p class="text-label-caps text-on-surface-variant mb-2">Solde Portefeuille</p>
                <h3 class="text-metric-xl text-primary"><?= number_format($user['solde'], 0) ?> Ar</h3>
            </div>

            <!-- Genre -->
            <div class="bg-surface rounded-xl p-6 shadow-sm border-l-4 border-secondary-container">
                <p class="text-label-caps text-on-surface-variant mb-2">Genre</p>
                <p class="text-headline-sm text-secondary-container">
                    <?= isset($user['gender']) && $user['gender'] === 'male' ? '👨 Masculin' : '👩 Féminin' ?>
                </p>
            </div>

            <!-- Taille/Poids -->
            <div class="bg-surface rounded-xl p-6 shadow-sm border-l-4 border-tertiary">
                <p class="text-label-caps text-on-surface-variant mb-2">Taille / Poids</p>
                <p class="text-headline-sm text-tertiary"><?= $user['taille'] ?? '?' ?>m / <?= $user['poids'] ?? '?' ?>kg</p>
            </div>

            <!-- Statut Gold -->
            <div class="bg-surface rounded-xl p-6 shadow-sm border-l-4 border-tertiary">
                <p class="text-label-caps text-on-surface-variant mb-2">Statut</p>
                <?php if ($user['gold']): ?>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-tertiary/10 text-tertiary rounded-full text-label-caps font-bold">
                        <span class="material-symbols-outlined" style="font-size: 16px;">star</span>
                        Gold
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center px-3 py-1 bg-on-surface-variant/10 text-on-surface-variant rounded-full text-label-caps font-bold">
                        Standard
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Objectif Section -->
                <div class="bg-surface rounded-xl p-6 shadow-sm">
                    <h2 class="text-headline-sm text-on-surface mb-4">Objectif Choisi</h2>
                    <?php if ($objectif): ?>
                        <div class="p-4 bg-primary/10 rounded-lg">
                            <h3 class="text-body-lg font-bold text-primary mb-2"><?= htmlspecialchars($objectif['nom']) ?></h3>
                            <p class="text-body-md text-on-surface-variant"><?= htmlspecialchars($objectif['description']) ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-body-md text-on-surface-variant">Aucun objectif défini</p>
                    <?php endif; ?>
                </div>

                <!-- Régimes Actifs Section -->
                <div class="bg-surface rounded-xl p-6 shadow-sm">
                    <h2 class="text-headline-sm text-on-surface mb-4">Régimes Achetés</h2>
                    <?php if (!empty($regimes)): ?>
                        <div class="space-y-3">
                            <?php foreach ($regimes as $regime): ?>
                                <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-primary">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-body-lg font-bold text-on-surface"><?= htmlspecialchars($regime['nom_regime'] ?? 'Régime') ?></h3>
                                    </div>
                                    <p class="text-body-md text-on-surface-variant mb-2">
                                        Durée: <?= $regime['duree'] ?? '?' ?> jours | Prix: <?= number_format($regime['prix'] ?? 0, 0) ?> Ar
                                    </p>
                                    <p class="text-body-md text-on-surface-variant">
                                        Du <?= isset($regime['date_debut']) ? date('d/m/Y', strtotime($regime['date_debut'])) : '?' ?> au <?= isset($regime['date_fin']) ? date('d/m/Y', strtotime($regime['date_fin'])) : '?' ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-body-md text-on-surface-variant">Aucun régime acheté</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div>
                <div class="bg-surface rounded-xl p-6 shadow-sm sticky top-24">
                    <h3 class="text-headline-sm text-on-surface mb-4">Actions</h3>
                    <form method="POST" action="/admin/utilisateur/toggleGold/<?= $user['id'] ?>">
                        <?= csrf_field() ?>
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-tertiary text-on-tertiary rounded-lg font-bold hover:bg-tertiary/90 transition-colors mb-3">
                            <span class="material-symbols-outlined">star</span>
                            <?= $user['gold'] ? 'Retirer Gold' : 'Activer Gold' ?>
                        </button>
                    </form>
                    <a href="/admin/utilisateur/list" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-surface-container text-on-surface rounded-lg font-bold hover:bg-surface-container-high transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
