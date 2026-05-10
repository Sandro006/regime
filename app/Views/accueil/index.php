<!DOCTYPE html>

<html class="light" lang="en">

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
                <div class="font-metric-xl text-metric-xl text-on-surface"><?php echo isset($user) ? $user['poids'] : '75'; ?><span class="text-body-lg ml-1 text-on-surface-variant">kg</span></div>
                <div class="mt-xs flex items-center gap-1 text-on-surface-variant font-body-md italic">
                    <span class="material-symbols-outlined text-[16px]">trending_down</span> -0.5kg cette semaine
                </div>
            </div>
            <!-- Goal Card -->
            <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container transition-all hover:-translate-y-1">
                <div class="flex justify-between items-start mb-sm">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">OBJECTIF SÉLECTIONNÉ</span>
                    <span class="text-tertiary material-symbols-outlined">flag</span>
                </div>
                <div class="font-headline-sm text-headline-sm text-on-surface mb-xs">Perdre du poids</div>
                <div class="w-full bg-surface-container rounded-full h-2 mt-md">
                    <div class="bg-primary-container h-2 rounded-full" style="width: 65%"></div>
                </div>
                <div class="mt-xs text-right font-label-caps text-[10px] text-on-surface-variant">65% DE L'OBJECTIF</div>
            </div>
            <!-- Portefeuille Card -->
            <div class="bg-primary text-on-primary p-lg rounded-xl shadow-[0_12px_20px_rgba(0,109,55,0.15)] transition-all hover:-translate-y-1">
                <div class="flex justify-between items-start mb-sm">
                    <span class="font-label-caps text-label-caps opacity-80">SOLDE DU PORTEFEUILLE</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                </div>
                <div class="font-metric-xl text-metric-xl"><?php echo isset($user) ? number_format($user['solde'], 2) : '50.00'; ?>€</div>
                <button class="mt-md w-full py-base bg-white/20 hover:bg-white/30 rounded-lg font-label-caps transition-colors">AJOUTER DES FONDS</button>
            </div>
        </section>
        <!-- Active Régimes Section (Bento Layout) -->
        <section class="space-y-md">
            <div class="flex justify-between items-end">
                <h2 class="font-display-md text-display-md text-on-surface">Active Régimes</h2>
                <a class="text-primary font-label-caps hover:underline" href="#">VOIR TOUS LES PLANS</a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
                <!-- Plan Keto Card (Wide) -->
                <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_20px_rgba(0,0,0,0.04)] border border-surface-container flex flex-col md:flex-row">
                    <div class="md:w-1/2 h-48 md:h-full relative">
                        <img alt="Healthy keto meal" class="absolute inset-0 w-full h-full object-cover" data-alt="A beautifully plated ketogenic meal featuring a grilled salmon fillet, fresh sliced avocado, sautéed green asparagus, and a side of mixed greens. The lighting is bright and airy, highlighting the textures of the fresh ingredients. The image has a clean, minimalist food photography style with subtle shadows on a soft gray surface to match the VitalFit design system." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3I_fEknSqoISZTyXKTlpmiH0-1Qc0jq4Z0WQcdp2FGCeka_7oK6txeP5ILXwTM0eTUjik7AZWvGIhkFiO1oUOsON2WZXFDTtgwPfUpyjDfowrAdV9lLqgVCgAtQ1DH7zOFWvfYglIXrGsI8L4jt9rp7cK4Wqmech1asfUD_x4LMw_aVVbjmYgDDyoG-6kyHdpHfMJ2JCmvd6NQCwtcvetubBM0VfH0o8QN1ufT_yU-fO7hGKGvnL9YvwClJxiykmPXY9D5Uo6EhMh" />
                        <div class="absolute top-md left-md bg-primary-container text-on-primary-container font-label-caps px-sm py-base rounded-lg text-[10px] shadow-sm">PLAN ACTIF</div>
                    </div>
                    <div class="md:w-1/2 p-lg flex flex-col justify-between">
                        <div>
                            <h3 class="font-display-md text-display-md text-on-surface mb-xs">Plan Keto</h3>
                            <p class="text-on-surface-variant font-body-md mb-lg leading-relaxed">High-fat, adequate-protein, low-carbohydrate diet designed to burn fats rather than carbohydrates.</p>
                            <div class="space-y-sm">
                                <div class="flex justify-between font-label-caps text-[10px] text-on-surface-variant">
                                    <span>PROGRESSION</span>
                                    <span>SEMAINE 3 SUR 12</span>
                                </div>
                                <div class="w-full bg-surface-container rounded-full h-3">
                                    <div class="bg-primary-container h-3 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-xl grid grid-cols-2 gap-md pt-lg border-t border-surface-container">
                            <div>
                                <div class="font-label-caps text-[10px] text-on-surface-variant uppercase">Date de début</div>
                                <div class="font-body-lg text-on-surface">Oct 12, 2023</div>
                            </div>
                            <div>
                                <div class="font-label-caps text-[10px] text-on-surface-variant uppercase">Variation</div>
                                <div class="font-body-lg text-primary font-bold">-3.2kg</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Daily Summary/Prochain repas -->
                <div class="bg-surface-container-high p-lg rounded-xl flex flex-col justify-between border border-outline-variant/30">
                    <div>
                        <div class="flex items-center gap-sm mb-lg">
                            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">restaurant_menu</span>
                            <span class="font-headline-sm text-headline-sm">Prochain repas</span>
                        </div>
                        <div class="space-y-md">
                            <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-container">
                                <div class="font-label-caps text-secondary mb-base">DÉJEUNER • 13:00</div>
                                <div class="font-display-md text-on-surface text-lg">Zucchini Noodles with Pesto</div>
                                <div class="mt-sm flex gap-md font-label-caps text-[10px] text-on-surface-variant">
                                    <span>420 KCAL</span>
                                    <span>12G CARBS</span>
                                </div>
                            </div>
                            <button class="w-full py-md border-2 border-dashed border-outline text-outline font-label-caps rounded-xl hover:bg-surface-container-highest transition-colors">
                                + + AJOUTER UNE COLLATION
                            </button>
                        </div>
                    </div>
                    <button class="w-full py-md bg-secondary text-on-secondary rounded-xl font-label-caps shadow-md active:scale-95 transition-all mt-xl">
                        VOIR LE PLAN REPAS
                    </button>
                </div>
            </div>
        </section>
        <!-- Recommended Activités Section -->
        <section class="space-y-md">
            <div class="flex justify-between items-end">
                <h2 class="font-display-md text-display-md text-on-surface">Recommended Activités</h2>
                <div class="flex gap-sm">
                    <span class="bg-surface-container px-sm py-base rounded-full font-label-caps text-[10px] text-on-surface-variant">OBJECTIF : PERTE DE POIDS</span>
                </div>
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
    <!-- BottomNavBar (Mobile) -->
    <nav class="md:hidden fixed bottom-0 w-full z-50 rounded-t-xl bg-surface-container dark:bg-surface-container-highest shadow-[0_-4px_20px_rgba(0,0,0,0.08)] flex justify-around items-center px-4 py-3">
        <?php if (!session()->get('estConnecte')) { ?>
            <!-- Navigation mobile - Utilisateur non connecté -->
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/">
                <span class="material-symbols-outlined" data-icon="home">home</span>
                <span class="font-label-caps text-label-caps mt-1">Accueil</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/login">
                <span class="material-symbols-outlined" data-icon="login">login</span>
                <span class="font-label-caps text-label-caps mt-1">Connexion</span>
            </a>
            <a class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-lg px-3 py-1 active:scale-90 duration-150" href="/register">
                <span class="material-symbols-outlined" data-icon="app_registration">app_registration</span>
                <span class="font-label-caps text-label-caps mt-1">S'inscrire</span>
            </a>
        <?php } else { ?>
            <!-- Navigation mobile - Utilisateur connecté -->
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="#">
                <span class="material-symbols-outlined" data-icon="restaurant">restaurant</span>
                <span class="font-label-caps text-label-caps mt-1">Régimes</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="#">
                <span class="material-symbols-outlined" data-icon="fitness_center">fitness_center</span>
                <span class="font-label-caps text-label-caps mt-1">Activités</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="#">
                <span class="material-symbols-outlined" data-icon="account_balance_wallet">account_balance_wallet</span>
                <span class="font-label-caps text-label-caps mt-1">Portefeuille</span>
            </a>
            <a class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-lg px-3 py-1 active:scale-90 duration-150" href="/profile">
                <span class="material-symbols-outlined" data-icon="person" style="font-variation-settings: 'FILL' 1;">person</span>
                <span class="font-label-caps text-label-caps mt-1">Profil</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/logout">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-label-caps text-label-caps mt-1">Déconnexion</span>
            </a>
        <?php } ?>
    </nav>
    <!-- FAB (Contextual for Tableau de bord) -->
    <button class="fixed right-lg bottom-28 md:bottom-lg w-14 h-14 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center active:scale-90 transition-transform hover:bg-primary-container hover:text-on-primary-container group z-40">
        <span class="material-symbols-outlined text-[28px] group-hover:rotate-90 transition-transform duration-300">add</span>
    </button>
</body>

</html>