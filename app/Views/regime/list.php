<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Nos Régimes - VitalFit</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&amp;family=Lexend:wght@400;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#006d37",
                        "on-surface": "#161d17",
                        "on-surface-variant": "#3d4a3e",
                        "surface": "#f3fcf1",
                        "surface-container": "#e8f0e5",
                        "surface-container-low": "#eef6eb",
                        "surface-container-highest": "#dce5da",
                        "outline-variant": "#bbcbbb",
                        "error": "#ba1a1a",
                        "primary-container": "#2ecc71"
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
                        "lg": "24px",
                        "xl": "40px",
                        "container-margin": "20px"
                    },
                    "fontFamily": {
                        "display-lg": ["Montserrat"],
                        "headline-sm": ["Montserrat"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"]
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f3fcf1;
        }
    </style>
</head>

<body class="font-body-md text-on-surface">
    <!-- TopAppBar -->
    <header class="bg-surface/90 sticky top-0 z-50 border-b border-outline-variant/30">
        <div class="flex justify-between items-center w-full px-container-margin py-sm max-w-7xl mx-auto">
            <div class="flex items-center gap-xs">
                <span class="font-display-lg font-bold text-primary">VitalFit</span>
            </div>
            <nav class="hidden md:flex items-center gap-lg">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/">Dashboard</a>
                <a class="text-primary font-bold border-b-2 border-primary" href="/regime">Régimes</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/achat/mesRegimes">Mes régimes</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/activite/list">Activités</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/portefeuille">Portefeuille</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/profile">Profile</a>
            </nav>
            <div class="flex items-center gap-md">
                <div class="flex items-center gap-xs">
                    <div class="text-right hidden sm:block">
                        <p class="font-semibold text-on-surface"><?php echo isset($user) ? htmlspecialchars($user['username']) : 'Utilisateur'; ?></p>
                    </div>
                </div>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="/logout">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-container-margin py-xl space-y-xl pb-32">
        <!-- Header Section -->
        <div class="flex flex-col gap-xs">
            <h1 class="font-display-lg text-display-lg text-on-surface">Nos Régimes</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Découvrez nos régimes personnalisés adaptés à vos objectifs</p>
        </div>

        <!-- Messages Flash -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-error/10 border-l-4 border-error text-error p-md rounded-lg flex items-start gap-md">
                <span class="material-symbols-outlined">error</span>
                <div>
                    <p class="font-semibold"><?php echo session()->getFlashdata('error'); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Grille Régimes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
            <?php if (isset($regimes) && !empty($regimes)): ?>
                <?php foreach ($regimes as $regime): ?>
                    <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant/20 hover:shadow-md transition-shadow flex flex-col">
                        <!-- Header Card -->
                        <div class="mb-md pb-md border-b border-outline-variant/20">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface mb-xs"><?php echo htmlspecialchars($regime['nom_regime']); ?></h2>
                            <p class="text-body-md text-on-surface-variant"><?php echo htmlspecialchars(substr($regime['description'] ?? '', 0, 60)) . '...'; ?></p>
                        </div>

                        <!-- Info Cards -->
                        <div class="space-y-xs mb-md">
                            <div class="flex items-center justify-between">
                                <span class="text-on-surface-variant text-body-md">Durée</span>
                                <span class="font-semibold text-primary"><?php echo $regime['duree']; ?> jours</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-on-surface-variant text-body-md">Variation poids</span>
                                <span class="font-semibold <?php echo $regime['variation_poids'] < 0 ? 'text-error' : 'text-primary'; ?>">
                                    <?php echo ($regime['variation_poids'] > 0 ? '+' : '') . $regime['variation_poids']; ?> kg
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-on-surface-variant text-body-md">Prix</span>
                                <span class="font-semibold text-primary"><?php echo number_format($regime['prix'], 2); ?> Ar</span>
                            </div>
                        </div>

                        <!-- Composition -->
                        <div class="space-y-xs mb-md pb-md border-b border-outline-variant/20">
                            <p class="text-on-surface-variant text-body-md font-semibold">Composition</p>
                            <div class="grid grid-cols-3 gap-xs text-center text-xs">
                                <div>
                                    <span class="text-primary font-semibold"><?php echo $regime['pourcentage_viande']; ?>%</span>
                                    <p class="text-on-surface-variant">Viande</p>
                                </div>
                                <div>
                                    <span class="text-primary font-semibold"><?php echo $regime['pourcentage_poisson']; ?>%</span>
                                    <p class="text-on-surface-variant">Poisson</p>
                                </div>
                                <div>
                                    <span class="text-primary font-semibold"><?php echo $regime['pourcentage_volaille']; ?>%</span>
                                    <p class="text-on-surface-variant">Volaille</p>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <a href="/regime/detail/<?php echo $regime['id']; ?>" class="mt-auto w-full bg-primary hover:bg-primary/90 text-white font-bold py-md rounded-lg text-center transition-all flex items-center justify-center gap-xs">
                            <span class="material-symbols-outlined">info</span>
                            Voir détails
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-xl">
                    <p class="text-on-surface-variant text-body-lg">Aucun régime disponible pour le moment</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- BottomNavBar -->
    <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-2 bg-surface/95 backdrop-blur-xl md:hidden">
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-2 hover:bg-surface-container-low rounded-xl transition-all" href="/">
            <span class="material-symbols-outlined">home</span>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center bg-primary-container text-primary px-4 py-2 rounded-xl" href="/regime">
            <span class="material-symbols-outlined">restaurant</span>
            <span class="text-xs mt-1">Régimes</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-2 hover:bg-surface-container-low rounded-xl transition-all" href="/achat/mesRegimes">
            <span class="material-symbols-outlined">favorite</span>
            <span class="text-xs mt-1">Mes régimes</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-2 hover:bg-surface-container-low rounded-xl transition-all" href="/portefeuille">
            <span class="material-symbols-outlined">wallet</span>
            <span class="text-xs mt-1">Wallet</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-2 hover:bg-surface-container-low rounded-xl transition-all" href="/profile">
            <span class="material-symbols-outlined">person</span>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </nav>
</body>

</html>
