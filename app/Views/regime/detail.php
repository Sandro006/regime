<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?php echo isset($regime) ? htmlspecialchars($regime['nom_regime']) : 'Détails Régime'; ?> - VitalFit</title>
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
                        "display-md": ["Montserrat"],
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
    <header class="bg-surface shadow-sm flex justify-between items-center w-full px-6 py-4 fixed top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display-md text-display-md font-bold text-primary">VitalFit</span>
        </div>
        <div class="hidden md:flex gap-6">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/">Tableau de bord</a>
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="/regime/list">Régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/achat/mesRegimes">Mes régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/activite/list">Activités</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/portefeuille">Portefeuille</a>
            <?php if (session()->get('estConnecte')) { ?>
                <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/profile">Profil</a>
            <?php } ?>
            <div class="flex items-center gap-4">
                <?php if (!session()->get('estConnecte')) { ?>
                    <a href="/login" class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">login</span>
                        <span class="text-sm font-medium hidden sm:inline">Se connecter</span>
                    </a>
                    <a href="/register" class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">app_registration</span>
                        <span class="text-sm font-medium hidden sm:inline">S'inscrire</span>
                    </a>
                <?php } else { ?>
                    <button class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <a href="/logout" class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                <?php } ?>
                <a href="/profile" class="w-10 h-10 rounded-full overflow-hidden bg-surface-container-highest border-2 border-primary-container hover:shadow-lg transition-shadow">
                    <img alt="User profile avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?background=2ecc71&color=fff&bold=true&name=User" />
                </a>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-container-margin py-xl pb-32">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-xs mb-xl">
            <a href="/" class="text-primary hover:underline">Dashboard</a>
            <span class="text-on-surface-variant">/</span>
            <a href="/regime" class="text-primary hover:underline">Régimes</a>
            <span class="text-on-surface-variant">/</span>
            <span class="text-on-surface"><?php echo isset($regime) ? htmlspecialchars($regime['nom_regime']) : 'Détails'; ?></span>
        </div>

        <!-- Messages Flash -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-error/10 border-l-4 border-error text-error p-md rounded-lg flex items-start gap-md mb-xl">
                <span class="material-symbols-outlined">error</span>
                <div>
                    <p class="font-semibold"><?php echo session()->getFlashdata('error'); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($regime)): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-xl">
                <!-- Colonne Principale -->
                <div class="lg:col-span-2 space-y-lg">
                    <!-- Card Principale -->
                    <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant/20">
                        <div class="space-y-lg">
                            <!-- Titre et Description -->
                            <div class="border-b border-outline-variant/20 pb-lg">
                                <h1 class="font-display-md text-display-md text-on-surface mb-md"><?php echo htmlspecialchars($regime['nom_regime']); ?></h1>
                                <p class="text-body-lg text-on-surface-variant leading-relaxed"><?php echo htmlspecialchars($regime['description']); ?></p>
                            </div>

                            <!-- Infos Principales -->
                            <div class="grid grid-cols-3 gap-md">
                                <div class="bg-primary-container/10 rounded-lg p-md">
                                    <p class="text-on-surface-variant text-body-md mb-xs">Durée</p>
                                    <p class="text-2xl font-bold text-primary"><?php echo $regime['duree']; ?></p>
                                    <p class="text-on-surface-variant text-xs">jours</p>
                                </div>
                                <div class="bg-primary-container/10 rounded-lg p-md">
                                    <p class="text-on-surface-variant text-body-md mb-xs">Variation poids</p>
                                    <p class="text-2xl font-bold <?php echo $regime['variation_poids'] < 0 ? 'text-error' : 'text-primary'; ?>">
                                        <?php echo ($regime['variation_poids'] > 0 ? '+' : '') . $regime['variation_poids']; ?>
                                    </p>
                                    <p class="text-on-surface-variant text-xs">kg</p>
                                </div>
                                <div class="bg-primary-container/10 rounded-lg p-md">
                                    <p class="text-on-surface-variant text-body-md mb-xs">Prix</p>
                                    <p class="text-2xl font-bold text-primary"><?php echo number_format($regime['prix'], 0); ?></p>
                                    <p class="text-on-surface-variant text-xs">Ar</p>
                                </div>
                            </div>

                            <!-- Composition -->
                            <div class="border-t border-outline-variant/20 pt-lg">
                                <h2 class="font-headline-sm text-headline-sm text-on-surface mb-md">Composition</h2>
                                <div class="space-y-md">
                                    <div>
                                        <div class="flex justify-between items-center mb-xs">
                                            <span class="text-on-surface-variant">Viande</span>
                                            <span class="font-bold text-primary"><?php echo $regime['pourcentage_viande']; ?>%</span>
                                        </div>
                                        <div class="h-2 bg-surface-container rounded-full overflow-hidden">
                                            <div class="h-full bg-primary" style="width: <?php echo $regime['pourcentage_viande']; ?>%;"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between items-center mb-xs">
                                            <span class="text-on-surface-variant">Poisson</span>
                                            <span class="font-bold text-primary"><?php echo $regime['pourcentage_poisson']; ?>%</span>
                                        </div>
                                        <div class="h-2 bg-surface-container rounded-full overflow-hidden">
                                            <div class="h-full bg-primary" style="width: <?php echo $regime['pourcentage_poisson']; ?>%;"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between items-center mb-xs">
                                            <span class="text-on-surface-variant">Volaille</span>
                                            <span class="font-bold text-primary"><?php echo $regime['pourcentage_volaille']; ?>%</span>
                                        </div>
                                        <div class="h-2 bg-surface-container rounded-full overflow-hidden">
                                            <div class="h-full bg-primary" style="width: <?php echo $regime['pourcentage_volaille']; ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Achat -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant/20 sticky top-20">
                        <div class="space-y-md">
                            <!-- Prix Total -->
                            <div class="bg-primary-container/20 rounded-lg p-md text-center border border-primary">
                                <p class="text-on-surface-variant text-body-md mb-xs">Prix total</p>
                                <p class="text-3xl font-bold text-primary"><?php echo number_format($regime['prix'], 0); ?> Ar</p>
                            </div>

                            <!-- Infos Achat -->
                            <div class="space-y-xs text-body-md">
                                <div class="flex items-center gap-xs text-on-surface">
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                    <span>Accès illimité pendant <?php echo $regime['duree']; ?> jours</span>
                                </div>
                                <div class="flex items-center gap-xs text-on-surface">
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                    <span>Plan nutritionnel complet</span>
                                </div>
                                <div class="flex items-center gap-xs text-on-surface">
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                    <span>Support client 24/7</span>
                                </div>
                            </div>

                            <!-- Bouton Achat -->
                            <?php if (session()->get('estConnecte')): ?>
                                <form action="/achat/acheterRegime/<?php echo $regime['id']; ?>" method="POST">
                                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-md rounded-lg transition-all flex items-center justify-center gap-xs active:scale-95">
                                        <span class="material-symbols-outlined">shopping_cart</span>
                                        Acheter maintenant
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="/login" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-md rounded-lg transition-all flex items-center justify-center gap-xs active:scale-95">
                                    <span class="material-symbols-outlined">login</span>
                                    Se connecter pour acheter
                                </a>
                            <?php endif; ?>

                            <!-- Retour -->
                            <a href="/regime" class="w-full border-2 border-primary text-primary hover:bg-primary-container/10 font-bold py-md rounded-lg transition-all text-center flex items-center justify-center gap-xs">
                                <span class="material-symbols-outlined">arrow_back</span>
                                Retour aux régimes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl p-xl text-center">
                <p class="text-on-surface-variant text-body-lg mb-lg">Régime non trouvé</p>
                <a href="/regime" class="bg-primary hover:bg-primary/90 text-white font-bold px-lg py-md rounded-lg inline-flex items-center gap-xs">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Retour aux régimes
                </a>
            </div>
        <?php endif; ?>
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
