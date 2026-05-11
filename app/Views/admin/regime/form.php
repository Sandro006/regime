<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?= $mode === 'edit' ? 'Modifier Régime' : 'Créer Régime' ?> | VitalFit</title>
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

        input, textarea, select {
            border: 2px solid rgba(107, 123, 109, 0.3);
            border-radius: 8px;
            padding: 12px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #161d17;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #006d37;
            box-shadow: 0 0 0 3px rgba(0, 109, 55, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #161d17;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .error-message {
            color: #ba1a1a;
            font-size: 12px;
            margin-top: 4px;
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
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200" href="#">Utilisateurs</a>
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
            <a href="/admin/regime/list" class="text-primary hover:text-primary/80 transition-colors flex items-center gap-1 mb-4">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour à la liste
            </a>
            <h1 class="font-display-lg text-display-lg text-on-surface mb-2">
                <?= $mode === 'edit' ? 'Modifier le régime' : 'Créer un nouveau régime' ?>
            </h1>
            <p class="text-body-lg text-on-surface-variant">
                <?= $mode === 'edit' ? 'Modifiez les informations du régime' : 'Remplissez le formulaire pour créer un régime' ?>
            </p>
        </div>

        <!-- Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-surface rounded-xl p-8 shadow-sm">
                    <form method="POST" action="<?= $mode === 'edit' ? '/admin/regime/update/' . $regime['id'] : '/admin/regime/store' ?>">
                        <?= csrf_field() ?>

                        <!-- Informations Générales -->
                        <div class="mb-8">
                            <h2 class="text-headline-sm text-on-surface mb-6">Informations Générales</h2>

                            <!-- Nom -->
                            <div class="form-group">
                                <label for="nom_regime">Nom du Régime <span class="text-error">*</span></label>
                                <input type="text" id="nom_regime" name="nom_regime" 
                                    value="<?= old('nom_regime', $regime['nom_regime'] ?? '') ?>"
                                    required placeholder="ex: Régime Keto">
                                <?php if ($errors = session()->getFlashdata('errors') && isset($errors['nom_regime'])): ?>
                                    <div class="error-message"><?= $errors['nom_regime'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description <span class="text-error">*</span></label>
                                <textarea id="description" name="description" rows="4"
                                    required placeholder="Décrivez le régime..."><?= old('description', $regime['description'] ?? '') ?></textarea>
                                <?php if ($errors = session()->getFlashdata('errors') && isset($errors['description'])): ?>
                                    <div class="error-message"><?= $errors['description'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Détails Financiers -->
                        <div class="mb-8">
                            <h2 class="text-headline-sm text-on-surface mb-6">Détails Financiers</h2>

                            <div class="grid grid-cols-2 gap-4">
                                <!-- Prix -->
                                <div class="form-group">
                                    <label for="prix">Prix (Ar) <span class="text-error">*</span></label>
                                    <input type="number" id="prix" name="prix" step="0.01" min="0"
                                        value="<?= old('prix', $regime['prix'] ?? '') ?>"
                                        required placeholder="0.00">
                                    <?php if ($errors = session()->getFlashdata('errors') && isset($errors['prix'])): ?>
                                        <div class="error-message"><?= $errors['prix'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Durée -->
                                <div class="form-group">
                                    <label for="duree">Durée (jours) <span class="text-error">*</span></label>
                                    <input type="number" id="duree" name="duree" min="1"
                                        value="<?= old('duree', $regime['duree'] ?? '') ?>"
                                        required placeholder="30">
                                    <?php if ($errors = session()->getFlashdata('errors') && isset($errors['duree'])): ?>
                                        <div class="error-message"><?= $errors['duree'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Détails Physiques -->
                        <div class="mb-8">
                            <h2 class="text-headline-sm text-on-surface mb-6">Détails Physiques</h2>

                            <!-- Variation Poids -->
                            <div class="form-group">
                                <label for="variation_poids">Variation de Poids (kg) <span class="text-error">*</span></label>
                                <input type="number" id="variation_poids" name="variation_poids"
                                    value="<?= old('variation_poids', $regime['variation_poids'] ?? '') ?>"
                                    required placeholder="ex: -5 ou +3">
                                <p class="text-body-md text-on-surface-variant mt-2">Valeur négative = perte, positive = gain</p>
                            </div>
                        </div>

                        <!-- Composition Nutritionnelle -->
                        <div class="mb-8">
                            <h2 class="text-headline-sm text-on-surface mb-6">Composition Nutritionnelle</h2>
                            <p class="text-body-md text-on-surface-variant mb-6">La somme des pourcentages doit égaler 100%</p>

                            <div class="grid grid-cols-3 gap-4">
                                <!-- % Viande -->
                                <div class="form-group">
                                    <label for="pourcentage_viande">% Viande <span class="text-error">*</span></label>
                                    <input type="number" id="pourcentage_viande" name="pourcentage_viande" 
                                        step="0.01" min="0" max="100"
                                        value="<?= old('pourcentage_viande', $regime['pourcentage_viande'] ?? '') ?>"
                                        required placeholder="0" onchange="updateTotal()">
                                </div>

                                <!-- % Poisson -->
                                <div class="form-group">
                                    <label for="pourcentage_poisson">% Poisson <span class="text-error">*</span></label>
                                    <input type="number" id="pourcentage_poisson" name="pourcentage_poisson" 
                                        step="0.01" min="0" max="100"
                                        value="<?= old('pourcentage_poisson', $regime['pourcentage_poisson'] ?? '') ?>"
                                        required placeholder="0" onchange="updateTotal()">
                                </div>

                                <!-- % Volaille -->
                                <div class="form-group">
                                    <label for="pourcentage_volaille">% Volaille <span class="text-error">*</span></label>
                                    <input type="number" id="pourcentage_volaille" name="pourcentage_volaille" 
                                        step="0.01" min="0" max="100"
                                        value="<?= old('pourcentage_volaille', $regime['pourcentage_volaille'] ?? '') ?>"
                                        required placeholder="0" onchange="updateTotal()">
                                </div>
                            </div>

                            <!-- Total Indicator -->
                            <div class="mt-6 p-4 bg-surface-container-low rounded-lg">
                                <p class="text-body-md text-on-surface-variant">
                                    Total: <span id="total-percentage" class="font-bold text-primary">0</span>%
                                </p>
                                <p id="total-message" class="text-body-md text-primary mt-2 hidden">✓ Total correct!</p>
                                <p id="total-error" class="text-body-md text-error mt-2 hidden">✗ Total doit égaler 100%</p>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 mt-8">
                            <button type="submit" class="flex-1 bg-primary text-on-primary px-6 py-3 rounded-lg font-bold hover:bg-primary/90 transition-colors">
                                <?= $mode === 'edit' ? 'Mettre à jour' : 'Créer le régime' ?>
                            </button>
                            <a href="/admin/regime/list" class="flex-1 bg-surface-container text-on-surface px-6 py-3 rounded-lg font-bold hover:bg-surface-container-high transition-colors text-center">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div>
                <div class="bg-surface rounded-xl p-6 shadow-sm">
                    <h3 class="text-headline-sm text-on-surface mb-4">Conseils</h3>
                    <ul class="space-y-4 text-body-md text-on-surface-variant">
                        <li class="flex gap-2">
                            <span class="material-symbols-outlined text-primary flex-shrink-0">info</span>
                            <span>Le nom doit être court et descriptif</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="material-symbols-outlined text-primary flex-shrink-0">info</span>
                            <span>La durée est en jours (30, 60, 90, etc.)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="material-symbols-outlined text-primary flex-shrink-0">info</span>
                            <span>Les pourcentages DOIVENT totaliser 100%</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="material-symbols-outlined text-primary flex-shrink-0">info</span>
                            <span>La variation de poids est l'objectif du régime</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        function updateTotal() {
            const viande = parseFloat(document.getElementById('pourcentage_viande').value) || 0;
            const poisson = parseFloat(document.getElementById('pourcentage_poisson').value) || 0;
            const volaille = parseFloat(document.getElementById('pourcentage_volaille').value) || 0;
            const total = viande + poisson + volaille;

            document.getElementById('total-percentage').textContent = total.toFixed(2);

            const messageEl = document.getElementById('total-message');
            const errorEl = document.getElementById('total-error');

            if (Math.abs(total - 100) < 0.01) {
                messageEl.classList.remove('hidden');
                errorEl.classList.add('hidden');
            } else {
                messageEl.classList.add('hidden');
                errorEl.classList.remove('hidden');
            }
        }

        // Initial calculation on page load
        document.addEventListener('DOMContentLoaded', updateTotal);
    </script>
</body>

</html>
