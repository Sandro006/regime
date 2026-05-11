<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mes Régimes - VitalPath</title>
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
    <header class="bg-surface shadow-sm flex justify-between items-center w-full px-6 py-4 fixed top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display-md text-display-md font-bold text-primary">VitalFit</span>
        </div>
        <div class="hidden md:flex gap-6">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/">Tableau de bord</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/regime/list">Régimes</a>
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="/achat/mesRegimes">Mes régimes</a>
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
    <main class="max-w-7xl mx-auto px-container-margin py-xl space-y-xl pb-32">
        <!-- Header Section -->
        <div class="flex flex-col gap-xs">
            <h1 class="font-display-lg text-display-lg text-on-surface">Mes Régimes Actifs</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Suivez vos régimes en cours et vos objectifs</p>
        </div>

        <!-- Messages Flash -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-primary-container/20 border-l-4 border-primary text-primary p-md rounded-lg flex items-start gap-md">
                <span class="material-symbols-outlined">check_circle</span>
                <div>
                    <p class="font-semibold"><?php echo session()->getFlashdata('success'); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-error/10 border-l-4 border-error text-error p-md rounded-lg flex items-start gap-md">
                <span class="material-symbols-outlined">error</span>
                <div>
                    <p class="font-semibold"><?php echo session()->getFlashdata('error'); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-on-surface-variant text-body-md">Total de régimes</p>
                        <p class="text-3xl font-bold text-primary"><?php echo isset($stats) ? $stats['total_regimes'] ?? 0 : 0; ?></p>
                    </div>
                    <span class="material-symbols-outlined text-primary text-5xl opacity-20">restaurant</span>
                </div>
            </div>

            <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-on-surface-variant text-body-md">Régimes actifs</p>
                        <p class="text-3xl font-bold text-primary"><?php echo isset($stats) ? $stats['regimes_actifs'] ?? 0 : 0; ?></p>
                    </div>
                    <span class="material-symbols-outlined text-primary text-5xl opacity-20">play_circle</span>
                </div>
            </div>

            <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-on-surface-variant text-body-md">Régimes terminés</p>
                        <p class="text-3xl font-bold text-primary"><?php echo isset($stats) ? $stats['regimes_termines'] ?? 0 : 0; ?></p>
                    </div>
                    <span class="material-symbols-outlined text-primary text-5xl opacity-20">check_circle</span>
                </div>
            </div>
        </div>

        <!-- Tableau Régimes -->
        <div class="bg-white rounded-xl shadow-sm border border-outline-variant/20 overflow-hidden">
            <div class="px-lg py-md border-b border-outline-variant/20">
                <h2 class="font-headline-sm text-headline-sm text-on-surface">Régimes en cours</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/30">
                            <th class="px-lg py-md text-body-md font-semibold text-on-surface-variant">Régime</th>
                            <th class="px-lg py-md text-body-md font-semibold text-on-surface-variant">Activité</th>
                            <th class="px-lg py-md text-body-md font-semibold text-on-surface-variant">Début</th>
                            <th class="px-lg py-md text-body-md font-semibold text-on-surface-variant">Fin</th>
                            <th class="px-lg py-md text-body-md font-semibold text-on-surface-variant">Statut</th>
                            <th class="px-lg py-md text-body-md font-semibold text-on-surface-variant text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        <?php if (isset($regimes) && !empty($regimes)): ?>
                            <?php foreach ($regimes as $regime): ?>
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="px-lg py-md text-body-md font-semibold"><?php echo htmlspecialchars($regime['nom_regime']); ?></td>
                                    <td class="px-lg py-md text-body-md"><?php echo htmlspecialchars($regime['nom_activite'] ?? 'N/A'); ?></td>
                                    <td class="px-lg py-md text-body-md"><?php echo date('d M Y', strtotime($regime['date_debut'])); ?></td>
                                    <td class="px-lg py-md text-body-md"><?php echo date('d M Y', strtotime($regime['date_fin'])); ?></td>
                                    <td class="px-lg py-md">
                                        <?php 
                                        $now = new DateTime();
                                        $fin = new DateTime($regime['date_fin']);
                                        $statut = $fin < $now ? 'Expiré' : 'Actif';
                                        $couleur = $fin < $now ? 'text-error' : 'text-primary';
                                        ?>
                                        <span class="<?php echo $couleur; ?> font-semibold"><?php echo $statut; ?></span>
                                    </td>
                                    <td class="px-lg py-md text-right">
                                        <?php if ($fin >= $now): ?>
                                            <form action="/achat/completerRegime/<?php echo $regime['utilisateur_regime_id']; ?>" method="POST" style="display:inline;">
                                                <button type="submit" class="text-primary font-semibold hover:underline">Compléter</button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-on-surface-variant text-body-md">Terminé</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-lg py-md text-center text-on-surface-variant">
                                    Vous n'avez pas encore acheté de régime.
                                    <a href="/regime/list" class="text-primary font-semibold hover:underline">Découvrir les régimes</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bouton Découvrir -->
        <div class="text-center">
            <a href="/regime/list" class="bg-primary hover:bg-primary/90 text-white font-bold px-lg py-md rounded-lg inline-flex items-center gap-xs transition-all">
                <span class="material-symbols-outlined">add_circle</span>
                Découvrir les régimes
            </a>
        </div>
    </main>

    <!-- BottomNavBar -->
    <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-2 bg-surface/95 backdrop-blur-xl md:hidden">
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-2 hover:bg-surface-container-low rounded-xl transition-all" href="/">
            <span class="material-symbols-outlined">home</span>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center bg-primary-container text-primary px-4 py-2 rounded-xl" href="/achat/mesRegimes">
            <span class="material-symbols-outlined">restaurant</span>
            <span class="text-xs mt-1">Régimes</span>
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
