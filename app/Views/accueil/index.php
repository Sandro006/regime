<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>VitalFit Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&amp;family=Montserrat:wght@600;700&amp;family=Lexend:wght@600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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
    <header class="bg-surface dark:bg-surface-dim shadow-sm flex justify-between items-center w-full px-container-margin py-md fixed top-0 z-50">
        <div class="flex items-center gap-xs">
            <span class="font-display-md text-display-md font-bold text-primary dark:text-primary-fixed-dim">VitalFit</span>
        </div>
        <div class="hidden md:flex gap-lg">
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="#">Tableau de bord</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="#">Régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/achat/mesRegimes">Mes régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/activite/list">Activités</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/portefeuille">Portefeuille</a>

            <?php if (session()->get('estConnecte')) { ?>
                <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/profile">Profil</a>
            <?php } ?>
            <div class="flex items-center gap-md">
                <?php if (!session()->get('estConnecte')) { ?>
                    <!-- Boutons pour utilisateur non connecté -->
                    <a href="/login"
                        class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">login</span>
                        <span class="text-sm font-medium hidden sm:inline">Se connecter</span>
                    </a>
                    <a href="/register"
                        class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">app_registration</span>
                        <span class="text-sm font-medium hidden sm:inline">S'inscrire</span>
                    </a>
                <?php } else { ?>
                    <!-- Boutons pour utilisateur connecté -->
                    <button class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <a href="/logout"
                        class="active:scale-95 transition-transform text-on-surface-variant hover:text-primary flex items-center gap-1">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                <?php } ?>

                <a href="/profile" class="w-10 h-10 rounded-full overflow-hidden bg-surface-container-highest border-2 border-primary-container hover:shadow-lg transition-shadow" title="My Profil">
                    <img alt="User profile avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzUdFX6Wry1yhOmHFnavxcNs8Czveflefzzn2IxipOguOzlQ4ok0DQOC_2oSdrrdxJ1CWqvqbhsNbN8_mjBxz3N8PmDOMTIeWNP-xQ0JrKLH3_Ovv1Fl3lV-L-UhQLi3y1bTki-izPUuT-63hQMS5XAtj6AeAYRjPZrigI0qCb2E1B9heMgwXPRB_4lgDojrcnnpN-S4ANyklQTCUA64togdAtNZo-dnGPmEsIYhnOHu_zIn91o4LcKuBPvTtDimtslLys0K8eQEpi" class="w-full h-full object-cover" />
                </a>
            </div>
        </div>
    </header>
    <main class="pt-24 px-container-margin max-w-7xl mx-auto space-y-xl pb-12">
        <!-- Hero Health Metrics Section -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <!-- BMI Card -->
            <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container transition-all hover:-translate-y-1">
                <div class="flex justify-between items-start mb-sm">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">IMC ACTUEL</span>
                    <span class="text-primary material-symbols-outlined">speed</span>
                </div>
                <div class="font-metric-xl text-metric-xl text-primary"><?php echo isset($user) ? $user['bmi'] : '22.4'; ?></div>
                <div class="mt-xs inline-flex px-sm py-base rounded-full bg-primary-container/20 text-on-primary-container font-label-caps text-[10px]">NORMAL</div>
            </div>
            <!-- Weight Card -->
            <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container transition-all hover:-translate-y-1">
                <div class="flex justify-between items-start mb-sm">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">POIDS ACTUEL</span>
                    <span class="text-secondary material-symbols-outlined">monitor_weight</span>
                </div>
                <div class="font-metric-xl text-metric-xl text-on-surface">
                    <?php echo isset($user) && isset($user['poids']) ? $user['poids'] : '75'; ?>
                    <span class="text-body-lg ml-1 text-on-surface-variant">kg</span>
                </div>
                
                <?php if (isset($variationTexte) && $variationTexte): ?>
                <div class="mt-xs flex items-center gap-1 <?= $tendanceCouleur ?? 'text-on-surface-variant' ?> font-body-md italic">
                    <span class="material-symbols-outlined text-[16px]"><?= $tendanceIcone ?? 'trending_flat' ?></span>
                    <?= htmlspecialchars($variationTexte) ?>
                </div>
                <?php else: ?>
                <div class="mt-xs flex items-center gap-1 text-on-surface-variant font-body-md italic">
                    <span class="material-symbols-outlined text-[16px]">info</span>
                    Aucune donnée d'historique
                </div>
                <?php endif; ?>
            </div>
            <!-- Goal Card -->
            <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container transition-all hover:-translate-y-1">
                <div class="flex justify-between items-start mb-sm">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">OBJECTIF SÉLECTIONNÉ</span>
                    <span class="text-tertiary material-symbols-outlined">flag</span>
                </div>
                <div class="font-headline-sm text-headline-sm text-on-surface mb-xs">
                    <?php 
                    if (isset($userObjectif) && $userObjectif) {
                        echo htmlspecialchars($userObjectif['objectif']);
                    } elseif (isset($user) && !isset($userObjectif)) {
                        echo '<a href="/profile/editObjectif" class="text-primary hover:underline">Définir objectif →</a>';
                    } else {
                        echo 'Perdre du poids';
                    }
                    ?>
                </div>
                <?php if (isset($userObjectif) && $userObjectif): ?>
                <div class="w-full bg-surface-container rounded-full h-2 mt-md">
                    <div class="bg-primary-container h-2 rounded-full" style="width: 65%"></div>
                </div>
                <div class="mt-xs text-right font-label-caps text-[10px] text-on-surface-variant">65% DE L'OBJECTIF</div>
                <?php endif; ?>
            </div>
            <!-- Portefeuille Card -->
            <div class="bg-primary text-on-primary p-lg rounded-xl shadow-[0_12px_20px_rgba(0,109,55,0.15)] transition-all hover:-translate-y-1">
                <div class="flex justify-between items-start mb-sm">
                    <span class="font-label-caps text-label-caps opacity-80">SOLDE DU PORTEFEUILLE</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                </div>
                <div class="font-metric-xl text-metric-xl"><?php echo isset($user) ? number_format($user['solde'], 2) : '50.00'; ?>€</div>
                <a href="<?php echo session()->get('estConnecte') ? '/portefeuille' : '/login'; ?>"
                    class="block mt-md w-full py-base bg-white/20 hover:bg-white/30 rounded-lg font-label-caps transition-colors text-center">
                    AJOUTER DES FONDS
                </a>
        </section>
        
         <!-- Section: Tous les régimes -->
        <section class="space-y-md">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="font-display-md text-display-md text-on-surface">Tous nos régimes</h2>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">Découvrez l'ensemble de nos programmes</p>
                </div>
                <a class="text-primary font-label-caps hover:underline" href="/regime/list">VOIR TOUS LES PLANS</a>
            </div>

            <?php if (isset($allRegimes) && !empty($allRegimes)): ?>
                <div class="relative">
                    <div class="overflow-hidden rounded-xl">
                        <div id="allRegimesCarousel" class="flex transition-transform duration-500 ease-out">
                            <?php foreach ($allRegimes as $index => $regime): ?>
                                <div class="min-w-full lg:min-w-[calc(50%-8px)] flex-shrink-0 lg:mr-4 last:lg:mr-0">
                                    <!-- Contenu de la carte régime (identique à votre carte existante) -->
                                    <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container flex flex-col md:flex-row h-full">
                                        <div class="md:w-1/2 h-48 md:h-full relative bg-gradient-to-br from-primary/10 to-primary/5">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <img src="<?= base_url('assets/images/' . htmlspecialchars($regime['nom_regime']) . '.png') ?>" alt="" class="absolute inset-0 w-full h-full object-cover z-0">
                                            </div>
                                            <div class="absolute top-md left-md bg-primary-container text-on-primary-container font-label-caps px-sm py-base rounded-lg text-[10px] shadow-sm">RÉGIME</div>
                                            <div class="absolute bottom-md left-md bg-secondary text-on-secondary font-label-caps px-md py-base rounded-lg text-[12px] font-bold"><?php echo number_format($regime['prix'], 0); ?> Ar</div>
                                        </div>
                                        <div class="md:w-1/2 p-lg flex flex-col justify-between">
                                            <div>
                                                <h3 class="font-display-md text-display-md text-on-surface mb-xs"><?php echo htmlspecialchars($regime['nom_regime']); ?></h3>
                                                <p class="text-on-surface-variant font-body-md mb-lg leading-relaxed line-clamp-2"><?php echo htmlspecialchars($regime['description']); ?></p>
                                                <div class="space-y-sm">
                                                    <div class="flex justify-between font-label-caps text-[10px] text-on-surface-variant">
                                                        <span>DURÉE</span>
                                                        <span><?php echo $regime['duree']; ?> JOURS</span>
                                                    </div>
                                                    <div class="w-full bg-surface-container rounded-full h-2">
                                                        <div class="bg-primary-container h-2 rounded-full" style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-xl grid grid-cols-3 gap-md pt-lg border-t border-surface-container">
                                                <div>
                                                    <div class="font-label-caps text-[10px] text-on-surface-variant">VARIATION</div>
                                                    <div class="font-body-lg <?php echo $regime['variation_poids'] < 0 ? 'text-tertiary' : ($regime['variation_poids'] > 0 ? 'text-primary' : 'text-on-surface'); ?> font-bold">
                                                        <?php echo ($regime['variation_poids'] > 0 ? '+' : ''); ?><?php echo $regime['variation_poids']; ?>kg
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-label-caps text-[10px] text-on-surface-variant">VIANDE</div>
                                                    <div class="font-body-lg text-on-surface font-bold"><?php echo $regime['pourcentage_viande']; ?>%</div>
                                                </div>
                                                <div>
                                                    <div class="font-label-caps text-[10px] text-on-surface-variant">POISSON</div>
                                                    <div class="font-body-lg text-on-surface font-bold"><?php echo $regime['pourcentage_poisson']; ?>%</div>
                                                </div>
                                            </div>
                                            <a href="/regime/detail/<?php echo $regime['id']; ?>" class="mt-md w-full py-md bg-primary text-on-primary rounded-xl font-label-caps shadow-md active:scale-95 transition-all hover:shadow-lg text-center">
                                                VOIR DÉTAILS
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if (count($allRegimes) > 1): ?>
                    <button id="allPrevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-6 md:translate-x-0 md:left-2 z-10 w-12 h-12 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:shadow-xl active:scale-95 transition-all">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button id="allNextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-6 md:translate-x-0 md:right-2 z-10 w-12 h-12 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:shadow-xl active:scale-95 transition-all">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                    <?php endif; ?>

                    <?php if (count($allRegimes) > 1): ?>
                    <div id="allCarouselIndicators" class="flex justify-center gap-2 mt-lg">
                        <?php foreach ($allRegimes as $i => $regime): ?>
                            <button class="all-carousel-indicator w-2 h-2 rounded-full transition-all <?php echo $i === 0 ? 'bg-primary w-8' : 'bg-surface-variant'; ?>" data-index="<?php echo $i; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-lg text-on-surface-variant bg-surface-container-lowest rounded-xl border border-surface-variant">
                    Aucun régime disponible pour le moment.
                </div>
            <?php endif; ?>
        </section>
        
        <!-- Section: Régimes recommandés -->
        <?php if (isset($userObjectif) && $userObjectif && !empty($recommendedRegimes)): ?>
        <section class="space-y-md mt-xl">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="font-display-md text-display-md text-on-surface">🍽️ Recommandés pour vous</h2>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">
                        Basés sur votre objectif : <strong class="text-primary"><?php echo htmlspecialchars($userObjectif['objectif']); ?></strong>
                    </p>
                </div>
                <a class="text-primary font-label-caps hover:underline" href="/regime/recommended">VOIR TOUS LES RECOMMANDÉS</a>
            </div>

            <div class="relative">
                <div class="overflow-hidden rounded-xl">
                    <div id="recommendedRegimesCarousel" class="flex transition-transform duration-500 ease-out">
                        <?php foreach ($recommendedRegimes as $index => $regime): ?>
                            <div class="min-w-full lg:min-w-[calc(50%-8px)] flex-shrink-0 lg:mr-4 last:lg:mr-0">
                                <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_20px_rgba(0,0,0,0.04)] border-2 border-primary/30 flex flex-col md:flex-row h-full">
                                    <div class="md:w-1/2 h-48 md:h-full relative bg-gradient-to-br from-primary/10 to-primary/5">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <img src="<?= base_url('assets/images/' . htmlspecialchars($regime['nom_regime']) . '.png') ?>" alt="" class="absolute inset-0 w-full h-full object-cover z-0">
                                        </div>
                                        <div class="absolute top-md left-md bg-primary text-on-primary font-label-caps px-sm py-base rounded-lg text-[10px] shadow-sm">⭐ RECOMMANDÉ</div>
                                        <div class="absolute bottom-md left-md bg-secondary text-on-secondary font-label-caps px-md py-base rounded-lg text-[12px] font-bold"><?php echo number_format($regime['prix'], 0); ?> Ar</div>
                                    </div>
                                    <div class="md:w-1/2 p-lg flex flex-col justify-between">
                                        <div>
                                            <h3 class="font-display-md text-display-md text-on-surface mb-xs"><?php echo htmlspecialchars($regime['nom_regime']); ?></h3>
                                            <p class="text-on-surface-variant font-body-md mb-lg leading-relaxed line-clamp-2"><?php echo htmlspecialchars($regime['description']); ?></p>
                                            <div class="space-y-sm">
                                                <div class="flex justify-between font-label-caps text-[10px] text-on-surface-variant">
                                                    <span>DURÉE</span>
                                                    <span><?php echo $regime['duree']; ?> JOURS</span>
                                                </div>
                                                <div class="w-full bg-surface-container rounded-full h-2">
                                                    <div class="bg-primary-container h-2 rounded-full" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-xl grid grid-cols-3 gap-md pt-lg border-t border-surface-container">
                                            <div>
                                                <div class="font-label-caps text-[10px] text-on-surface-variant">VARIATION</div>
                                                <div class="font-body-lg <?php echo $regime['variation_poids'] < 0 ? 'text-tertiary' : ($regime['variation_poids'] > 0 ? 'text-primary' : 'text-on-surface'); ?> font-bold">
                                                    <?php echo ($regime['variation_poids'] > 0 ? '+' : ''); ?><?php echo $regime['variation_poids']; ?>kg
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-label-caps text-[10px] text-on-surface-variant">VIANDE</div>
                                                <div class="font-body-lg text-on-surface font-bold"><?php echo $regime['pourcentage_viande']; ?>%</div>
                                            </div>
                                            <div>
                                                <div class="font-label-caps text-[10px] text-on-surface-variant">POISSON</div>
                                                <div class="font-body-lg text-on-surface font-bold"><?php echo $regime['pourcentage_poisson']; ?>%</div>
                                            </div>
                                        </div>
                                        <a href="/regime/detail/<?php echo $regime['id']; ?>" class="mt-md w-full py-md bg-primary text-on-primary rounded-xl font-label-caps shadow-md active:scale-95 transition-all hover:shadow-lg text-center">
                                            VOIR DÉTAILS
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (count($recommendedRegimes) > 1): ?>
                <button id="recPrevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-6 md:translate-x-0 md:left-2 z-10 w-12 h-12 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:shadow-xl active:scale-95 transition-all">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button id="recNextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-6 md:translate-x-0 md:right-2 z-10 w-12 h-12 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:shadow-xl active:scale-95 transition-all">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
                <?php endif; ?>

                <?php if (count($recommendedRegimes) > 1): ?>
                <div id="recCarouselIndicators" class="flex justify-center gap-2 mt-lg">
                    <?php foreach ($recommendedRegimes as $i => $regime): ?>
                        <button class="rec-carousel-indicator w-2 h-2 rounded-full transition-all <?php echo $i === 0 ? 'bg-primary w-8' : 'bg-surface-variant'; ?>" data-index="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- Recommended Activités Section -->
        <section class="space-y-md">
            <div class="flex justify-between items-end">
                <h2 class="font-display-md text-display-md text-on-surface">Activités recommandées</h2>
                <?php if (isset($userObjectif) && $userObjectif): ?>
                <div class="flex gap-sm">
                    <span class="bg-surface-container px-sm py-base rounded-full font-label-caps text-[10px] text-on-surface-variant">
                        OBJECTIF : <?php echo strtoupper(htmlspecialchars($userObjectif['objectif'])); ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                <?php if (isset($activites) && !empty($activites)): ?>
                    <?php
                    $images = [
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuBrO5g4Ks84vcAZ2PetS4BEYYjU__DoLdJQeNjdC1vtnwtXDznAYjmhRs0S8hInlv5VD8F231t6cMYS7BmigyPWQmmQymWv8ABI9Ak99zlNte0UmLBTd44bUWAggZiN05rn1q7d2xSXnksseRlbxocr6mhVe9c-IkGidE1uuu9OgvQgAdGE3Z4at06uBOLAMoGOS5jeCe6Vop6nQsT-RX_Whm_SLQ_qF_lkGXdJCXsLyspS_zMW9XSL_fAwT_1-qFItpdlhL4fZSqTV',
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuAWUpm1Zjv0SuSPzps7RW8oztqkWmc0P3pnvzC-zJQDzaN8NLDUyHIrBRDNDz4dtvWchZttqLe32C-kZhIcy1Vee5xKWNTYutGweM6knia1neaHkHLytVUC8PdKC3WWPtB8C0_5XVoCcD0ey9jZkdvNwjr3H_61SH57K4iRv4oK0nRC09de_KXyxxCjf_wH2LlePa5Knolb7KR5CDkfYll6hsn8DjsyKc3nXPPERvEcaTDVPvshpRr_-stLY9DcTJ1624b_pwv-aAlL',
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuApsfa1nxamzqeH9o2-lHw4yKeAp0QtL8RKKp8p35mhMmbx2_nP0TwbOtV1GpZUmkMQ336HBS0iS9lP2G8Xre4KstCyp_cc0Hw9hbuRJ3CYBqRIOpPIxwKVr1RpwM4YLxQdCbxFqLZOhxHuB2yrhThE59YEItFTA-4G2rEvKwmdV4BL8TUflCGjt3ZgcALaUmHe4Kxdvm8srn_7e6wSMYHwj2qceSZnrNy8LqCF71Xq67wpCLwZT94TI27-y8F5PyPyzKdLxg-MAMUu'
                    ];
                    $niveaux = ['facile' => 'FACILE', 'moyen' => 'MODÉRÉ', 'difficile' => 'INTENSE'];
                    ?>
                    <?php foreach ($activites as $index => $activite): ?>
                        <!-- Activity Card -->
                        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container group cursor-pointer transition-all hover:shadow-lg">
                            <div class="h-40 overflow-hidden relative">
                                <img alt="<?php echo htmlspecialchars($activite['nom_activite']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo $images[$index % count($images)]; ?>" />
                                <div class="absolute bottom-sm right-sm bg-black/50 backdrop-blur-md text-white font-label-caps px-sm py-base rounded text-[10px]"><?php echo $niveaux[$activite['niveau_difficulte']] ?? strtoupper($activite['niveau_difficulte']); ?></div>
                            </div>
                            <div class="p-md">
                                <h4 class="font-headline-sm text-on-surface"><?php echo htmlspecialchars($activite['nom_activite']); ?></h4>
                                <p class="text-on-surface-variant font-body-md text-xs mt-base"><?php echo htmlspecialchars($activite['description']); ?></p>
                                <div class="mt-md flex items-center justify-between">
                                    <div class="flex items-center gap-xs">
                                        <span class="material-symbols-outlined text-secondary text-[20px]">local_fire_department</span>
                                        <span class="font-label-caps text-label-caps text-on-surface"><?php echo $activite['calories_brulees']; ?> cal</span>
                                    </div>
                                    <span class="material-symbols-outlined text-on-surface-variant">chevron_right</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-lg text-on-surface-variant">
                        Aucune activité disponible pour le moment.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer class="bg-surface dark:bg-surface-dim text-on-surface-variant text-center py-md mt-auto">
        &copy; <?php echo date('Y'); ?> VitalFit. Tous droits réservés.
    </footer>
    <script>
        // ========== CARROUSEL 1 : TOUS LES RÉGIMES ==========
        let allCurrentIndex = 0;
        const allCarousel = document.getElementById('allRegimesCarousel');
        const allIndicators = document.querySelectorAll('.all-carousel-indicator');
        const allTotalItems = <?php echo count($allRegimes); ?>;
        let allItemsPerView = 1;
        let allAutoplayInterval;

        function allUpdateItemsPerView() {
            allItemsPerView = window.innerWidth >= 1024 ? 2 : 1;
            allUpdateCarousel();
        }

        function allUpdateCarousel() {
            if (!allCarousel) return;
            const maxIndex = Math.max(0, allTotalItems - allItemsPerView);
            if (allCurrentIndex > maxIndex) allCurrentIndex = maxIndex;
            const offset = -allCurrentIndex * (100 / allItemsPerView);
            allCarousel.style.transform = `translateX(${offset}%)`;
            
            if (allIndicators && allIndicators.length) {
                allIndicators.forEach((indicator, index) => {
                    if (index === allCurrentIndex) {
                        indicator.classList.add('bg-primary', 'w-8');
                        indicator.classList.remove('bg-surface-variant');
                    } else {
                        indicator.classList.remove('bg-primary', 'w-8');
                        indicator.classList.add('bg-surface-variant');
                    }
                });
            }
        }

        function allNextSlide() {
            const maxIndex = Math.max(0, allTotalItems - allItemsPerView);
            allCurrentIndex = allCurrentIndex < maxIndex ? allCurrentIndex + 1 : 0;
            allUpdateCarousel();
            allResetAutoplay();
        }

        function allPrevSlide() {
            const maxIndex = Math.max(0, allTotalItems - allItemsPerView);
            allCurrentIndex = allCurrentIndex > 0 ? allCurrentIndex - 1 : maxIndex;
            allUpdateCarousel();
            allResetAutoplay();
        }

        function allAutoplay() {
            if (allAutoplayInterval) clearInterval(allAutoplayInterval);
            allAutoplayInterval = setInterval(allNextSlide, 5000);
        }

        function allResetAutoplay() {
            clearInterval(allAutoplayInterval);
            if (allTotalItems > allItemsPerView) allAutoplay();
        }

        if (allCarousel) {
            const nextBtn = document.getElementById('allNextBtn');
            const prevBtn = document.getElementById('allPrevBtn');
            if (nextBtn) nextBtn.addEventListener('click', allNextSlide);
            if (prevBtn) prevBtn.addEventListener('click', allPrevSlide);
            
            if (allIndicators && allIndicators.length) {
                allIndicators.forEach(indicator => {
                    indicator.addEventListener('click', (e) => {
                        allCurrentIndex = parseInt(e.target.dataset.index);
                        allUpdateCarousel();
                        allResetAutoplay();
                    });
                });
            }
            
            window.addEventListener('resize', () => allUpdateItemsPerView());
            allUpdateItemsPerView();
            if (allTotalItems > allItemsPerView) allAutoplay();
        }

        // ========== CARROUSEL 2 : RÉGIMES RECOMMANDÉS ==========
        <?php if (isset($userObjectif) && $userObjectif && !empty($recommendedRegimes)): ?>
        let recCurrentIndex = 0;
        const recCarousel = document.getElementById('recommendedRegimesCarousel');
        const recIndicators = document.querySelectorAll('.rec-carousel-indicator');
        const recTotalItems = <?php echo count($recommendedRegimes); ?>;
        let recItemsPerView = 1;
        let recAutoplayInterval;

        function recUpdateItemsPerView() {
            recItemsPerView = window.innerWidth >= 1024 ? 2 : 1;
            recUpdateCarousel();
        }

        function recUpdateCarousel() {
            if (!recCarousel) return;
            const maxIndex = Math.max(0, recTotalItems - recItemsPerView);
            if (recCurrentIndex > maxIndex) recCurrentIndex = maxIndex;
            const offset = -recCurrentIndex * (100 / recItemsPerView);
            recCarousel.style.transform = `translateX(${offset}%)`;
            
            if (recIndicators && recIndicators.length) {
                recIndicators.forEach((indicator, index) => {
                    if (index === recCurrentIndex) {
                        indicator.classList.add('bg-primary', 'w-8');
                        indicator.classList.remove('bg-surface-variant');
                    } else {
                        indicator.classList.remove('bg-primary', 'w-8');
                        indicator.classList.add('bg-surface-variant');
                    }
                });
            }
        }

        function recNextSlide() {
            const maxIndex = Math.max(0, recTotalItems - recItemsPerView);
            recCurrentIndex = recCurrentIndex < maxIndex ? recCurrentIndex + 1 : 0;
            recUpdateCarousel();
            recResetAutoplay();
        }

        function recPrevSlide() {
            const maxIndex = Math.max(0, recTotalItems - recItemsPerView);
            recCurrentIndex = recCurrentIndex > 0 ? recCurrentIndex - 1 : maxIndex;
            recUpdateCarousel();
            recResetAutoplay();
        }

        function recAutoplay() {
            if (recAutoplayInterval) clearInterval(recAutoplayInterval);
            recAutoplayInterval = setInterval(recNextSlide, 5000);
        }

        function recResetAutoplay() {
            clearInterval(recAutoplayInterval);
            if (recTotalItems > recItemsPerView) recAutoplay();
        }

        if (recCarousel) {
            const nextBtn = document.getElementById('recNextBtn');
            const prevBtn = document.getElementById('recPrevBtn');
            if (nextBtn) nextBtn.addEventListener('click', recNextSlide);
            if (prevBtn) prevBtn.addEventListener('click', recPrevSlide);
            
            if (recIndicators && recIndicators.length) {
                recIndicators.forEach(indicator => {
                    indicator.addEventListener('click', (e) => {
                        recCurrentIndex = parseInt(e.target.dataset.index);
                        recUpdateCarousel();
                        recResetAutoplay();
                    });
                });
            }
            
            window.addEventListener('resize', () => recUpdateItemsPerView());
            recUpdateItemsPerView();
            if (recTotalItems > recItemsPerView) recAutoplay();
        }
        <?php endif; ?>
    </script>
</body>

</html>