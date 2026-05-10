<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Lexend:wght@600;700&amp;family=Montserrat:wght@600;700;800&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#bbcbbb",
                        "secondary-fixed": "#ffdcc5",
                        "primary": "#006d37",
                        "on-surface-variant": "#3d4a3e",
                        "on-secondary": "#ffffff",
                        "tertiary-container": "#ff9875",
                        "outline": "#6c7b6d",
                        "inverse-on-surface": "#ebf3e8",
                        "on-primary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-primary-fixed": "#00210c",
                        "tertiary-fixed-dim": "#ffb59d",
                        "on-secondary-fixed-variant": "#713700",
                        "surface-variant": "#dce5da",
                        "inverse-primary": "#4ae183",
                        "on-tertiary-fixed-variant": "#793015",
                        "surface-container-low": "#eef6eb",
                        "on-primary-container": "#005027",
                        "secondary-fixed-dim": "#ffb783",
                        "secondary": "#944a00",
                        "on-primary-fixed-variant": "#005228",
                        "on-secondary-fixed": "#301400",
                        "surface-tint": "#006d37",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e2ebe0",
                        "secondary-container": "#fc8f34",
                        "on-background": "#161d17",
                        "primary-fixed-dim": "#4ae183",
                        "on-surface": "#161d17",
                        "primary-fixed": "#6bfe9c",
                        "tertiary": "#98472a",
                        "inverse-surface": "#2b322b",
                        "surface": "#f3fcf1",
                        "error": "#ba1a1a",
                        "surface-container": "#e8f0e5",
                        "surface-bright": "#f3fcf1",
                        "on-tertiary-container": "#772e14",
                        "on-secondary-container": "#663100",
                        "background": "#f3fcf1",
                        "on-tertiary-fixed": "#390c00",
                        "primary-container": "#2ecc71",
                        "surface-dim": "#d4dcd2",
                        "surface-container-highest": "#dce5da",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#ffdbd0"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "8px",
                        "sm": "12px",
                        "md": "16px",
                        "base": "4px",
                        "gutter": "16px",
                        "container-margin": "20px",
                        "xl": "40px",
                        "lg": "24px"
                    },
                    "fontFamily": {
                        "label-caps": ["Lexend"],
                        "body-md": ["Inter"],
                        "display-md": ["Montserrat"],
                        "headline-sm": ["Montserrat"],
                        "display-lg": ["Montserrat"],
                        "metric-xl": ["Lexend"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "display-md": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "display-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "metric-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.03em", "fontWeight": "700"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
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
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-body-md text-on-surface">
    <!-- TopAppBar -->
    <header class="bg-surface dark:bg-surface-dim shadow-sm flex justify-between items-center w-full px-container-margin py-md sticky top-0 z-50">
        <div class="flex items-center gap-md">
            <h1 class="font-display-md text-display-md font-bold text-primary dark:text-primary-fixed-dim">VitalFit</h1>
        </div>
        <div class="flex items-center gap-md">
            <a href="/profile" class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps">Retour</a>
            <a href="/logout" class="text-on-surface-variant hover:text-primary transition-colors duration-200">
                <span class="material-symbols-outlined">logout</span>
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-container-margin py-xl pb-32">
        <!-- Formulaire d'édition -->
        <section class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-surface-variant/20">
            <div class="mb-xl">
                <h2 class="font-display-md text-display-md text-on-surface mb-sm">Edit Profile</h2>
                <p class="text-on-surface-variant font-body-md">Mettez à jour vos informations personnelles</p>
            </div>

            <!-- Messages d'erreur/succès -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-lg p-md bg-primary-container/20 border border-primary-container rounded-lg">
                    <p class="text-primary font-body-md"><?php echo session()->getFlashdata('success'); ?></p>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-lg p-md bg-error-container border border-error rounded-lg">
                    <p class="text-error font-body-md"><?php echo session()->getFlashdata('error'); ?></p>
                </div>
            <?php endif; ?>

            <form action="/profile/doEdit" method="POST" class="space-y-lg">
                <?php csrf_field(); ?>

                <!-- Full Name -->
                <div>
                    <label for="username" class="font-label-caps text-label-caps text-on-surface-variant mb-sm block">Full Name</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?php echo isset($user) ? htmlspecialchars($user['username']) : ''; ?>" 
                        placeholder="Votre nom complet"
                        class="w-full px-md py-sm border border-surface-variant rounded-lg font-body-md text-on-surface placeholder-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                        required
                    />
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="font-label-caps text-label-caps text-on-surface-variant mb-sm block">Gender</label>
                    <select 
                        id="gender" 
                        name="gender"
                        class="w-full px-md py-sm border border-surface-variant rounded-lg font-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                        required
                    >
                        <option value="">Sélectionnez votre genre</option>
                        <option value="male" <?php echo (isset($user) && $user['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo (isset($user) && $user['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>

                <!-- Height and Weight -->
                <div class="grid grid-cols-2 gap-md">
                    <div>
                        <label for="taille" class="font-label-caps text-label-caps text-on-surface-variant mb-sm block">Height (cm)</label>
                        <input 
                            type="number" 
                            id="taille" 
                            name="taille" 
                            value="<?php echo isset($user) ? round($user['taille'] * 100) : ''; ?>" 
                            placeholder="170"
                            step="0.1"
                            min="100"
                            max="250"
                            class="w-full px-md py-sm border border-surface-variant rounded-lg font-body-md text-on-surface placeholder-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                            required
                        />
                    </div>
                    <div>
                        <label for="poids" class="font-label-caps text-label-caps text-on-surface-variant mb-sm block">Weight (kg)</label>
                        <input 
                            type="number" 
                            id="poids" 
                            name="poids" 
                            value="<?php echo isset($user) ? $user['poids'] : ''; ?>" 
                            placeholder="75"
                            step="0.1"
                            min="30"
                            max="300"
                            class="w-full px-md py-sm border border-surface-variant rounded-lg font-body-md text-on-surface placeholder-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                            required
                        />
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-md pt-lg border-t border-surface-variant">
                    <button 
                        type="submit" 
                        class="flex-1 py-md bg-primary text-on-primary rounded-lg font-label-caps text-label-caps hover:shadow-lg active:scale-95 transition-all"
                    >
                        <span class="material-symbols-outlined inline mr-1" style="font-size: 18px;">check_circle</span>
                        Save Changes
                    </button>
                    <a 
                        href="/profile" 
                        class="flex-1 py-md border-2 border-primary text-primary rounded-lg font-label-caps text-label-caps hover:bg-primary/5 active:scale-95 transition-all flex items-center justify-center gap-1"
                    >
                        <span class="material-symbols-outlined">cancel</span>
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>

    <!-- BottomNavBar -->
    <nav class="fixed bottom-0 w-full z-50 rounded-t-xl bg-surface-container dark:bg-surface-container-highest shadow-[0_-4px_20px_rgba(0,0,0,0.08)] md:hidden">
        <div class="flex justify-around items-center px-4 py-3 w-full">
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/">
                <span class="material-symbols-outlined">home</span>
                <span class="font-label-caps text-label-caps mt-1">Home</span>
            </a>
            <a class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-lg px-3 py-1 active:scale-90 duration-150" href="/profile">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person</span>
                <span class="font-label-caps text-label-caps mt-1">Profile</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/logout">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-caps text-label-caps mt-1">Logout</span>
            </a>
        </div>
    </nav>
</body>

</html>
