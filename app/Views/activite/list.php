<?php
// Fichier: app/Views/activite/list.php
?>
<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>VitalFit - Activités Sportives</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&amp;family=Montserrat:wght@600;700&amp;family=Lexend:wght@600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #F8F9FA;
            color: #161d17;
        }
        .activity-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .activity-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .filter-btn.active {
            background-color: #2ecc71;
            color: white;
        }
    </style>
</head>

<body class="bg-background font-body-lg text-on-background min-h-screen">
    <!-- Header -->
    <header class="bg-surface shadow-sm flex justify-between items-center w-full px-6 py-4 fixed top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display-md text-display-md font-bold text-primary">VitalFit</span>
        </div>
        <div class="hidden md:flex gap-6">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/">Tableau de bord</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/regime/list">Régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="/achat/mesRegimes">Mes régimes</a>
            <a class="text-primary font-bold border-b-2 border-primary transition-colors duration-200" href="/activite/list">Activités</a>
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

    <main class="pt-28 px-6 max-w-7xl mx-auto pb-12">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div>
                    <h1 class="font-display-lg text-display-lg text-on-surface mb-2">
                        Activités Sportives
                    </h1>
                    <p class="text-on-surface-variant">
                        Découvrez nos activités adaptées à vos objectifs
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="/activite/list" 
                       class="px-4 py-2 rounded-xl font-label-caps transition-all <?= !isset($objectif) ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-highest' ?>">
                        Toutes
                    </a>
                    <a href="/activite/recommended" 
                       class="px-4 py-2 rounded-xl font-label-caps transition-all <?= isset($objectif) ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-highest' ?>">
                        Recommandées
                    </a>
                </div>
            </div>
            
            <?php if (isset($info)): ?>
                <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl text-blue-700">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined">info</span>
                        <span><?= htmlspecialchars($info) ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($objectif)): ?>
                <div class="mt-4 p-4 bg-primary/10 border-l-4 border-primary rounded-r-xl">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">star</span>
                        <span>Activités recommandées basées sur votre objectif : 
                            <strong class="text-primary"><?= htmlspecialchars(ucfirst($objectif)) ?></strong>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Filter Section -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-2">
                <button class="filter-btn px-4 py-2 rounded-full bg-surface-container text-on-surface-variant hover:bg-surface-container-highest transition-all" data-filter="all">
                    Tous
                </button>
                <button class="filter-btn px-4 py-2 rounded-full bg-surface-container text-on-surface-variant hover:bg-surface-container-highest transition-all" data-filter="facile">
                    🟢 Facile
                </button>
                <button class="filter-btn px-4 py-2 rounded-full bg-surface-container text-on-surface-variant hover:bg-surface-container-highest transition-all" data-filter="moyen">
                    🟡 Modéré
                </button>
                <button class="filter-btn px-4 py-2 rounded-full bg-surface-container text-on-surface-variant hover:bg-surface-container-highest transition-all" data-filter="difficile">
                    🔴 Intense
                </button>
            </div>
        </div>

        <!-- Activities Grid -->
        <?php if (!empty($activites)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="activitiesGrid">
                <?php 
                $images = [
                    'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?w=500&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=500&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1599058917765-a780eda07a3e?w=500&h=300&fit=crop',
                ];
                
                $niveaux = [
                    'facile' => ['label' => 'FACILE', 'color' => 'bg-green-500', 'icon' => 'sentiment_satisfied'],
                    'moyen' => ['label' => 'MODÉRÉ', 'color' => 'bg-yellow-500', 'icon' => 'bolt'],
                    'difficile' => ['label' => 'INTENSE', 'color' => 'bg-red-500', 'icon' => 'whatshot']
                ];
                ?>
                
                <?php foreach ($activites as $index => $activite): ?>
                    <?php $niveau = $activite['niveau_difficulte'] ?? 'moyen'; ?>
                    <div class="activity-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-md border border-surface-container group" data-difficulty="<?= $niveau ?>">
                        <div class="h-48 overflow-hidden relative">
                            <img alt="<?= htmlspecialchars($activite['nom_activite']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 src="<?= $images[$index % count($images)] ?>" />
                            <div class="absolute top-4 left-4 <?= $niveaux[$niveau]['color'] ?> text-white font-label-caps px-3 py-1 rounded-lg text-xs shadow-lg flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm"><?= $niveaux[$niveau]['icon'] ?></span>
                                <span><?= $niveaux[$niveau]['label'] ?></span>
                            </div>
                            <?php if (isset($objectif)): ?>
                                <div class="absolute top-4 right-4 bg-primary text-on-primary px-2 py-1 rounded-lg text-xs shadow-lg flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">recommend</span>
                                    <span>Recommandé</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">
                                <?= htmlspecialchars($activite['nom_activite']) ?>
                            </h3>
                            <p class="text-on-surface-variant font-body-md text-sm mb-4 line-clamp-2">
                                <?= htmlspecialchars($activite['description'] ?? 'Une activité sportive pour atteindre vos objectifs.') ?>
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary">local_fire_department</span>
                                    <span class="font-label-caps text-on-surface">
                                        <?= number_format($activite['calories_brulees'] ?? rand(200, 800)) ?> kcal
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary">schedule</span>
                                    <span class="font-label-caps text-on-surface">
                                        <?= rand(15, 60) ?> min
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-surface-container">
                                <div class="flex items-center gap-1 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm">fitness_center</span>
                                    <span class="text-xs"><?= rand(3, 5) ?> exercices</span>
                                </div>
                                <button class="px-4 py-2 bg-primary/10 text-primary rounded-lg font-label-caps text-sm hover:bg-primary hover:text-on-primary transition-all flex items-center gap-1">
                                    <span>Commencer</span>
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16 bg-surface-container-lowest rounded-xl border border-surface-variant">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">fitness_center</span>
                <h3 class="font-headline-sm text-on-surface mb-2">Aucune activité disponible</h3>
                <p class="text-on-surface-variant">Aucune activité n'est disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </main>

    <footer class="bg-surface text-on-surface-variant text-center py-6 mt-8">
        &copy; <?= date('Y') ?> VitalFit. Tous droits réservés.
    </footer>

    <script>
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const activityCards = document.querySelectorAll('.activity-card');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active', 'bg-primary', 'text-on-primary'));
                btn.classList.add('active', 'bg-primary', 'text-on-primary');
                
                const filter = btn.dataset.filter;
                
                activityCards.forEach(card => {
                    if (filter === 'all' || card.dataset.difficulty === filter) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Animate cards on load
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.activity-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>

</html>