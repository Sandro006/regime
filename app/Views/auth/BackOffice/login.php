<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700&amp;family=Manrope:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container-low": "#f2f4f6",
                    "secondary": "#565e74",
                    "primary": "#006c49",
                    "secondary-fixed-dim": "#bec6e0",
                    "on-secondary": "#ffffff",
                    "surface-container-lowest": "#ffffff",
                    "on-primary": "#ffffff",
                    "on-primary-fixed": "#002113",
                    "tertiary-fixed-dim": "#bacac3",
                    "on-primary-container": "#00422b",
                    "on-tertiary-container": "#2d3c37",
                    "primary-fixed": "#6ffbbe",
                    "surface-container-highest": "#e0e3e5",
                    "inverse-surface": "#2d3133",
                    "inverse-on-surface": "#eff1f3",
                    "surface-tint": "#006c49",
                    "on-primary-fixed-variant": "#005236",
                    "surface-variant": "#e0e3e5",
                    "on-surface-variant": "#3c4a42",
                    "on-tertiary": "#ffffff",
                    "surface-container": "#eceef0",
                    "on-error-container": "#93000a",
                    "on-secondary-fixed-variant": "#3f465c",
                    "tertiary-fixed": "#d5e6df",
                    "on-secondary-fixed": "#131b2e",
                    "secondary-fixed": "#dae2fd",
                    "primary-fixed-dim": "#4edea3",
                    "tertiary": "#52625c",
                    "background": "#f7f9fb",
                    "error-container": "#ffdad6",
                    "tertiary-container": "#96a69f",
                    "surface-dim": "#d8dadc",
                    "secondary-container": "#dae2fd",
                    "outline-variant": "#bbcabf",
                    "on-surface": "#191c1e",
                    "on-error": "#ffffff",
                    "inverse-primary": "#4edea3",
                    "on-background": "#191c1e",
                    "surface-bright": "#f7f9fb",
                    "surface": "#f7f9fb",
                    "on-tertiary-fixed": "#101e1a",
                    "surface-container-high": "#e6e8ea",
                    "on-secondary-container": "#5c647a",
                    "primary-container": "#10b981",
                    "error": "#ba1a1a",
                    "outline": "#6c7a71",
                    "on-tertiary-fixed-variant": "#3b4a44"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "md": "24px",
                    "lg": "40px",
                    "container-margin": "24px",
                    "xs": "4px",
                    "gutter": "16px",
                    "base": "8px",
                    "xl": "64px",
                    "sm": "12px"
            },
            "fontFamily": {
                    "label-sm": ["Manrope"],
                    "headline-md": ["Lexend"],
                    "body-md": ["Manrope"],
                    "body-lg": ["Manrope"],
                    "headline-xl": ["Lexend"],
                    "label-bold": ["Manrope"],
                    "headline-lg": ["Lexend"]
            },
            "fontSize": {
                    "label-sm": ["12px", {"lineHeight": "1.4", "fontWeight": "500"}],
                    "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-xl": ["40px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "label-bold": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.02em", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "1.25", "letterSpacing": "-0.01em", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body {
            background-color: #f7f9fb;
            color: #191c1e;
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden font-body-md">
<!-- Login Container -->
<main class="flex min-h-screen">
<!-- Left Column: Branding and Form -->
<div class="flex-1 flex flex-col justify-center items-center px-container-margin lg:px-xl py-lg bg-surface">
<div class="w-full max-w-md">
<!-- Brand Logo -->
<header class="mb-lg">
<div class="flex items-center gap-xs">
<span class="material-symbols-outlined text-primary text-headline-lg" style="font-variation-settings: 'FILL' 1;">health_and_safety</span>
<h1 class="font-headline-md text-headline-md font-bold text-primary">VitalFit</h1>
</div>
</header>
<!-- Headline -->
<section class="mb-lg">
<h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Welcome back</h2>
<p class="font-body-md text-on-surface-variant">Enter your credentials to access your wellness dashboard.</p>
</section>
<!-- Login Form -->
<form class="space-y-md" id="loginForm">
<?= csrf_field() ?>
<div>
<label class="block font-label-bold text-label-bold text-on-surface mb-base" for="email">Email Address</label>
<input class="w-full px-md py-sm bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md placeholder:text-on-surface-variant/50" id="email" name="email" placeholder="name@example.com" type="email" required/>
<span class="error-message text-red-500 text-label-sm hidden" data-field="email"></span>
</div>
<div>
<div class="flex justify-between items-center mb-base">
<label class="block font-label-bold text-label-bold text-on-surface" for="password">Password</label>
<a class="text-label-bold font-label-bold text-primary hover:underline" href="#">Forgot password?</a>
</div>
<input class="w-full px-md py-sm bg-surface-container-low border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md placeholder:text-on-surface-variant/50" id="password" name="password" placeholder="••••••••" type="password" required/>
<span class="error-message text-red-500 text-label-sm hidden" data-field="password"></span>
</div>
<div class="flex items-center">
<input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary bg-surface-container-low" id="remember" type="checkbox"/>
<label class="ml-sm font-body-md text-on-surface-variant" for="remember">Remember me for 30 days</label>
</div>
<button class="w-full py-md bg-primary text-on-primary font-headline-md rounded-xl shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" type="button" id="loginBtn">
                        Log In
                    </button>
</form>
<!-- Divider -->
<div class="relative my-lg">
<div class="absolute inset-0 flex items-center">
<span class="w-full border-t border-outline-variant"></span>
</div>
<div class="relative flex justify-center text-label-sm font-label-sm">
<span class="px-md bg-surface text-on-surface-variant">Or continue with</span>
</div>
</div>
<!-- Social Logins -->
<div class="grid grid-cols-2 gap-md mb-lg">
<button class="flex items-center justify-center gap-sm py-sm border border-outline-variant rounded-xl bg-surface-container-lowest hover:bg-surface-container-low transition-colors font-label-bold text-on-surface">
<img alt="Google" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC-SG7CgIMRwBilyGjgvMjM9avhkvNG-unCEDRGYbdOK3AFRCAzwLzUozLmo683wA6o-g-MmB52g8axrk89KWqEKBji6zi9Eb7qoVVfUZ4ThWnSx1XwXAhfGBEEpOoAx6mZEVVtzQ0tKKr_kKymzUlE1SjAASZRbr9oqhnFRyRZY2wxX3dr5k6LIOjVYYzaoxA92BvIVkGWfgk2TuTodxRVtyyQ4NgbrPGqa-_F-liFTUSE6v_TGIMXeLWRAhsAODa6cJCxkBBmV7E"/>
                        Google
                    </button>
<button class="flex items-center justify-center gap-sm py-sm border border-outline-variant rounded-xl bg-surface-container-lowest hover:bg-surface-container-low transition-colors font-label-bold text-on-surface">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">ios</span>
                        Apple
                    </button>
</div>
<!-- Footer Link -->
<p class="text-center font-body-md text-on-surface-variant">
                    Don't have an account? 
                    <a class="font-label-bold text-primary hover:underline" href="/register">Create an account</a>
</p>
</div>
</div>
<!-- Right Column: Visual Inspiration -->
<div class="hidden lg:flex flex-1 relative overflow-hidden bg-primary-container">
<div class="absolute inset-0 z-10 bg-gradient-to-t from-primary/60 to-transparent"></div>
<img alt="Healthy lifestyle morning routine" class="absolute inset-0 w-full h-full object-cover" data-alt="A serene and healthy lifestyle photograph of a professional woman doing a morning yoga stretch in a bright, modern, airy apartment. The scene is filled with natural sunlight coming through floor-to-ceiling windows, highlighting a minimalist decor with lush green plants. The color palette is composed of fresh greens, crisp whites, and soft morning grays, perfectly embodying the clean and professional clinical-yet-vital brand identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAir8QXQOmHkjwVUG3-A0N8I7dAU2v5r4CYwrj0J3kN3KRkerM_tqszncj4t0n7Gbz26QhQ7De3rsJvJdx06_MuO2cFJIa9DkF96MCpTcDwGhYA7PSGLZndjMmV2ZYLbhxIdAXDx9tzK3RTkz-QP35SLgyY6qDmd4eMFinWca4XRWxqVJAlKxkU6Qig057saGIXFMoWK8G6SLwCvUUVMjVijQ_jKnCQyw1CyWEkJ3rmrRh9oRDsQBLP62FbkpKP_Rag5OkRlYjGHN0"/>
<div class="relative z-20 flex flex-col justify-end p-xl h-full text-on-primary">
<div class="max-w-md">
<div class="bg-tertiary-container/30 backdrop-blur-md rounded-xl p-md border border-white/20 shadow-lg">
<span class="material-symbols-outlined text-headline-lg mb-sm">format_quote</span>
<p class="font-headline-md text-headline-md italic mb-md leading-relaxed">
                            "VitalFit transformed how I track my health. Precise data meets elegant design."
                        </p>
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-secondary-fixed"></div>
<div>
<p class="font-label-bold text-label-bold">Dr. Elena Rodriguez</p>
<p class="text-label-sm font-label-sm opacity-80">Wellness Consultant</p>
</div>
</div>
</div>
</div>
</div>
<!-- Floating Stat Cards for Visual Interest (Modern Bento Style) -->
<div class="absolute top-12 right-12 z-20 space-y-md w-64">
<div class="bg-surface-container-lowest/90 backdrop-blur-sm p-md rounded-xl shadow-lg border border-white/30 transform hover:-translate-y-1 transition-transform">
<div class="flex items-center gap-sm mb-xs">
<div class="w-8 h-8 rounded-full bg-tertiary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-[18px]">favorite</span>
</div>
<span class="text-label-bold font-label-bold text-on-surface">Heart Rate</span>
</div>
<div class="text-headline-md font-headline-md text-primary">72 BPM</div>
</div>
<div class="bg-surface-container-lowest/90 backdrop-blur-sm p-md rounded-xl shadow-lg border border-white/30 transform hover:-translate-y-1 transition-transform ml-8">
<div class="flex items-center gap-sm mb-xs">
<div class="w-8 h-8 rounded-full bg-tertiary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-[18px]">bolt</span>
</div>
<span class="text-label-bold font-label-bold text-on-surface">Daily Progress</span>
</div>
<div class="w-full bg-surface-variant rounded-full h-2 mt-sm overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 85%;"></div>
</div>
<div class="mt-xs text-right font-label-bold text-label-sm text-primary">85%</div>
</div>
</div>
</div>
</main>
<!-- Simple Footer for Legal -->
<footer class="fixed bottom-0 left-0 w-full lg:w-1/2 flex justify-between items-center px-container-margin py-md bg-transparent pointer-events-none">
<div class="flex gap-md pointer-events-auto">
<a class="text-label-sm font-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="text-label-sm font-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
</div>
<div class="text-label-sm font-label-sm text-on-surface-variant opacity-50">
            © 2024 VitalFit Platform
        </div>
</footer>
<script>
document.getElementById('loginBtn').addEventListener('click', async (e) => {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email || !password) {
        alert('Veuillez remplir tous les champs');
        return;
    }
    
    // Récupérer le token CSRF
    const csrfToken = document.querySelector('input[name="csrf_test_name"]').value;
    
    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ 
                email, 
                password,
                csrf_test_name: csrfToken
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Rediriger vers la page d'accueil
            window.location.href = data.redirect;
        } else {
            alert(data.message || 'Une erreur est survenue');
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors de la connexion');
    }
});
</script>
</body></html>