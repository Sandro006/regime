<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Connexion Admin | VitalFit</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Inter:wght@400;600&family=Lexend:wght@600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        outline-variant: "#bbcbbb",
                        "on-surface": "#161d17",
                        "on-surface-variant": "#3d4a3e",
                        "surface-bright": "#f3fcf1",
                        "surface": "#f3fcf1",
                        "background": "#f3fcf1",
                        "outline": "#6c7b6d",
                        primary: "#006d37",
                        "primary-container": "#2ecc71",
                        "on-primary-container": "#00210c",
                        error: "#ba1a1a",
                    },
                    fontFamily: {
                        "headline-sm": ["Montserrat"],
                        "body-md": ["Inter"],
                        "label-caps": ["Lexend"],
                    },
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body-md min-h-screen flex items-center justify-center overflow-x-hidden">

<main class="w-full min-h-screen flex items-stretch">

    <section class="flex-1 flex flex-col justify-center items-center px-6 py-10">
        <div class="w-full max-w-md">

            <div class="mb-6 text-center">
                <h1 class="text-display-lg font-headline-sm" style="font-family: Montserrat; font-weight:700; color:#006d37;">VitalFit</h1>
                <p class="mt-2 text-on-surface-variant">Connexion administrateur</p>
            </div>

            <div class="rounded-xl border border-outline-variant/40 bg-white/70 p-5 shadow-sm">

                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="mb-4 rounded-lg bg-red-50 border border-red-500/30 text-red-600 p-3 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-600">error</span>
                            <span><?= esc(session()->getFlashdata('error')) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="mb-4 rounded-lg bg-green-50 border border-green-500/30 text-green-700 p-3 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-700">check_circle</span>
                            <span><?= esc(session()->getFlashdata('success')) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/admin/authenticate" class="space-y-4">
                    <div>
                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-1" for="email">Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input
                                class="w-full pl-10 pr-3 py-2 bg-white border border-outline-variant/50 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-container"
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                placeholder="admin@exemple.com"
                                required
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-1" for="motdepasse">Mot de passe</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input
                                class="w-full pl-10 pr-3 py-2 bg-white border border-outline-variant/50 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-container"
                                id="motdepasse"
                                name="motdepasse"
                                type="password"
                                autocomplete="current-password"
                                placeholder="••••••••"
                                required
                            />
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-primary-container text-on-primary-container font-headline-sm py-2.5 rounded-lg shadow-md hover:scale-[1.01] active:scale-95 transition-all duration-150"
                    >
                        Se connecter
                    </button>

                    <div class="text-center text-sm text-on-surface-variant">
                        <a href="/login" class="text-primary font-semibold hover:underline">Retour au site</a>
                    </div>
                </form>
            </div>

        </div>
    </section>

</main>

</body>
</html>

