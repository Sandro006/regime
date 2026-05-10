<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login | VitalFit</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&amp;family=Inter:wght@400;600&amp;family=Lexend:wght@600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#bbcbbb",
                        "on-surface": "#161d17",
                        "secondary-container": "#fc8f34",
                        "on-secondary-fixed": "#301400",
                        "inverse-primary": "#4ae183",
                        "on-background": "#161d17",
                        "secondary": "#944a00",
                        "inverse-on-surface": "#ebf3e8",
                        "surface-bright": "#f3fcf1",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed": "#ffdbd0",
                        "on-secondary": "#ffffff",
                        "error": "#ba1a1a",
                        "secondary-fixed-dim": "#ffb783",
                        "primary-container": "#2ecc71",
                        "secondary-fixed": "#ffdcc5",
                        "on-primary-fixed": "#00210c",
                        "surface-tint": "#006d37",
                        "on-error": "#ffffff",
                        "primary": "#006d37",
                        "tertiary-fixed-dim": "#ffb59d",
                        "on-tertiary-fixed": "#390c00",
                        "inverse-surface": "#2b322b",
                        "outline": "#6c7b6d",
                        "surface-container-low": "#eef6eb",
                        "surface-container-high": "#e2ebe0",
                        "on-secondary-fixed-variant": "#713700",
                        "on-primary-fixed-variant": "#005228",
                        "on-error-container": "#93000a",
                        "surface-container-highest": "#dce5da",
                        "on-secondary-container": "#663100",
                        "primary-fixed-dim": "#4ae183",
                        "on-tertiary-container": "#772e14",
                        "on-surface-variant": "#3d4a3e",
                        "surface-dim": "#d4dcd2",
                        "surface-variant": "#dce5da",
                        "tertiary-container": "#ff9875",
                        "tertiary": "#98472a",
                        "on-tertiary-fixed-variant": "#793015",
                        "primary-fixed": "#6bfe9c",
                        "surface-container": "#e8f0e5",
                        "surface": "#f3fcf1",
                        "on-primary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#005027",
                        "error-container": "#ffdad6",
                        "background": "#f3fcf1"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "40px",
                        "md": "16px",
                        "container-margin": "20px",
                        "gutter": "16px",
                        "xs": "8px",
                        "sm": "12px",
                        "lg": "24px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "metric-xl": ["Lexend"],
                        "headline-sm": ["Montserrat"],
                        "body-md": ["Inter"],
                        "display-md": ["Montserrat"],
                        "display-lg": ["Montserrat"],
                        "label-caps": ["Lexend"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "metric-xl": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "700"
                        }],
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "display-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "display-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
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
    </style>
</head>

<body class="bg-background text-on-background font-body-md min-h-screen flex items-center justify-center overflow-x-hidden">
    <!-- Main Layout Container -->
    <main class="w-full min-h-screen flex items-stretch">
        <!-- Left Column: Branding & Form -->
        <section class="flex-1 flex flex-col justify-center items-center px-container-margin py-xl lg:px-xl bg-surface relative z-10">
            <div class="w-full max-w-md">
                <!-- Brand Anchor -->
                <div class="mb-xl text-center lg:text-left">
                    <h1 class="font-display-lg text-display-lg text-primary tracking-tight">VitalFit</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mt-xs">Welcome back. Your wellness journey continues.</p>
                </div>
                <!-- Login Form Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-lg p-lg border border-outline-variant/10">

                    <div id="errorMessage" class="hidden mb-md p-sm bg-red-50 border border-red-500/30 text-red-500 rounded-lg text-body-md flex items-center justify-between">
                        <span id="errorText"></span>
                        <button id="closeErrorBtn" class="material-symbols-outlined text-red-500 hover:scale-110">close</button>
                    </div>
                    <div id="successMessage" class="hidden mb-md p-sm bg-green-50 border border-green-500/30 text-green-500 rounded-lg text-body-md">
                        <span id="successText"></span>
                    </div>

                    <form id="loginForm" action="/login" method="POST" class="space-y-md">
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-xs ml-1" for="email">Email Address</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">mail</span>
                                <input class="w-full pl-xl pr-md py-sm bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary-container transition-all placeholder:text-outline-variant font-body-md" id="email" name="email" placeholder="name@example.com" type="email" required />
                            </div>
                            <span class="error-message text-red-500 text-xs mt-1 ml-1 hidden" data-field="email"></span>
                        </div>

                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-xs ml-1" for="password">Password</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">lock</span>
                                <input class="w-full pl-xl pr-xl py-sm bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary-container transition-all placeholder:text-outline-variant font-body-md" id="password" name="password" placeholder="••••••••" type="password" required />
                                <button type="button" class="toggle-password absolute right-md top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors" data-target="password">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                            </div>
                            <span class="error-message text-red-500 text-xs mt-1 ml-1 hidden" data-field="password"></span>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer group">
                                <input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary-container" type="checkbox" name="remember" />
                                <span class="ml-xs font-body-md text-on-surface-variant group-hover:text-primary transition-colors">Remember me</span>
                            </label>
                            <a class="font-body-md text-primary font-semibold hover:underline decoration-primary-container underline-offset-4" href="#">Forgot password?</a>
                        </div>

                        <button class="w-full bg-primary-container text-on-primary-container font-headline-sm text-headline-sm py-sm rounded-lg shadow-md hover:scale-[1.02] active:scale-95 transition-all duration-150 mt-md" type="submit">
                            Log In
                        </button>
                    </form>

                </div>
                <!-- Footer Link -->
                <p class="mt-lg text-center font-body-md text-on-surface-variant">
                    Don't have an account?
                    <a class="text-secondary font-bold hover:text-secondary-fixed-dim transition-colors" href="#">Sign up</a>
                </p>
            </div>
        </section>
        <!-- Right Column: Inspiring Imagery (Desktop Only) -->
        <section class="hidden lg:flex flex-1 relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover" data-alt="A top-down vibrant flat lay of a healthy Mediterranean meal featuring fresh kale, sliced avocados, colorful radishes, and grilled chicken on a clean white ceramic plate. The lighting is soft and natural morning sunlight, casting gentle shadows that emphasize the fresh texture of the vegetables. The color palette is dominated by energetic greens and soft earthy tones, creating a mood of vitality and clean living consistent with a modern corporate health aesthetic." src="<?= base_url('/assets/images/login_back.png') ?> " />
            </div>
            <!-- Overlay Gradient for Text Readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent z-10"></div>
            <!-- Inspirational Quote Overlay -->
            <div class="relative z-20 w-full flex flex-col justify-end p-xl text-white">
                <div class="max-w-md bg-white/10 backdrop-blur-md p-lg rounded-xl border border-white/20">
                    <span class="material-symbols-outlined text-primary-fixed text-[48px] mb-md" style="font-variation-settings: 'FILL' 1;">format_quote</span>
                    <p class="font-display-md text-display-md leading-tight mb-md">"Wellness is a connection of paths: exercise, nutrition, and mindfulness."</p>
                    <div class="flex items-center gap-md">
                        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">VF</div>
                        <div>
                            <p class="font-label-caps text-label-caps">Daily Inspiration</p>
                            <p class="font-body-md text-white/80">VitalFit Community</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Support Help FAB (Optional placement for Login page) -->
    <button class="fixed bottom-lg right-lg w-14 h-14 bg-secondary-container text-on-secondary-container rounded-full shadow-lg flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group">
        <span class="material-symbols-outlined">help_outline</span>
        <span class="absolute right-full mr-md bg-inverse-surface text-inverse-on-surface px-sm py-xs rounded font-label-caps text-label-caps opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">Support</span>
    </button>
    <script src="<?= base_url('/assets/js/validation_login.js') ?>"></script> 
</body>

</html>