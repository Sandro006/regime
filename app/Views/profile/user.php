<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Lexend:wght@600;700&amp;family=Montserrat:wght@600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
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
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
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

        body {
            background-color: #F8F9FA;
            scroll-behavior: smooth;
        }

        .bento-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="font-body-md text-on-surface">
    <!-- TopAppBar -->
    <header class="bg-surface dark:bg-surface-dim shadow-sm flex justify-between items-center w-full px-container-margin py-md sticky top-0 z-50">
        <div class="flex items-center gap-md">
            <h1 class="font-display-md text-display-md font-bold text-primary dark:text-primary-fixed-dim">VitalFit</h1>
        </div>
        <div class="hidden md:flex gap-lg">
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/">Dashboard</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/regime">Diets</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/achat/mesRegimes">Mes régimes</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/activite/list">Activities</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-caps text-label-caps" href="/portefeuille">Portefeuille</a>
            <a class="text-primary font-bold border-b-2 border-primary font-label-caps text-label-caps" href="#">Profile</a>
        </div>
        <div class="flex items-center gap-md">
            <button class="active:scale-95 transition-transform">
                <span class="material-symbols-outlined text-primary">notifications</span>
            </button>
            <button class="active:scale-95 transition-transform">
                <span class="material-symbols-outlined text-primary">settings</span>
            </button>
            <a class="flex flex-col items-center justify-center text-on-surface-variant py-1 hover:bg-surface-variant/50 transition-all active:scale-90 duration-150" href="/logout">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
            </a>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-container-margin py-xl pb-32">
        <!-- Profile Hero Section -->
        <section class="flex flex-col md:flex-row items-center md:items-end gap-lg mb-xl">
            <div class="text-center md:text-left flex-1">
                <div class="flex items-center justify-center md:justify-start gap-sm mb-xs">
                    <h2 class="font-display-lg text-display-lg"><?php echo isset($user) ? htmlspecialchars($user['username']) : 'Alex Richardson'; ?></h2>
                    <span class="bg-secondary-container text-on-secondary-container font-label-caps text-[10px] px-2 py-0.5 rounded-full flex items-center gap-1 uppercase tracking-wider">
                        <span class="material-symbols-outlined text-[12px]" style="font-variation-settings: 'FILL' 1;">stars</span>
                        <?php echo (isset($user) && $user['gold']) ? 'Gold Member' : 'Regular Member'; ?>
                    </span>
                </div>
                <p class="text-on-surface-variant font-body-lg text-body-lg">Joined VitalFit in <?php echo date('F Y'); ?></p>
                <div class="mt-md flex flex-wrap justify-center md:justify-start gap-sm">
                    <a href="/profile/edit" class="px-lg py-sm bg-primary text-on-primary rounded-lg font-label-caps text-label-caps hover:shadow-lg active:scale-95 transition-all inline-flex items-center gap-1">
                        <span class="material-symbols-outlined">edit</span>
                        Edit Profile
                    </a>
                    <a href="/profile/editObjectif" class="px-lg py-sm border-2 border-primary text-primary rounded-lg font-label-caps text-label-caps hover:bg-primary/5 active:scale-95 transition-all inline-flex items-center gap-1">
                        <span class="material-symbols-outlined">flag</span>
                        Changer d'objectif
                    </a>
                </div>
            </div>
        </section>
        <!-- Bento Grid Content -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-lg">
            <!-- Quick Update Form -->
            <div class="md:col-span-4 bento-card bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-surface-variant/20">
                <h3 class="font-headline-sm text-headline-sm mb-lg flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">update</span>
                    Quick Update
                </h3>
                <form id="quickUpdateForm" class="space-y-md">
                    <div>
                        <label class="font-label-caps text-label-caps text-on-surface-variant mb-xs block">Weight (kg)</label>
                        <div class="flex gap-sm">
                            <input type="number" id="poids" name="poids" step="0.1" value="<?php echo isset($user) ? $user['poids'] : '74'; ?>" class="flex-1 px-md py-sm border border-outline rounded-lg focus:outline-none focus:border-primary">
                            <button type="button" onclick="updateMetric('poids')" class="px-md py-sm bg-primary text-on-primary rounded-lg font-label-caps text-label-caps hover:opacity-90">Save</button>
                        </div>
                    </div>
                    <div>
                        <label class="font-label-caps text-label-caps text-on-surface-variant mb-xs block">Height (cm)</label>
                        <div class="flex gap-sm">
                            <input type="number" id="taille" name="taille" step="0.5" value="<?php echo isset($user) ? $user['taille'] * 100 : '182'; ?>" class="flex-1 px-md py-sm border border-outline rounded-lg focus:outline-none focus:border-primary">
                            <button type="button" onclick="updateMetric('taille')" class="px-md py-sm bg-primary text-on-primary rounded-lg font-label-caps text-label-caps hover:opacity-90">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Wallet Card -->
            <div class="md:col-span-4 bento-card bg-primary text-on-primary p-lg rounded-xl shadow-lg relative overflow-hidden">
                <!-- Background decoration -->
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-primary-fixed-dim/10 rounded-full"></div>
                <div class="absolute -left-4 -bottom-4 w-24 h-24 bg-primary-fixed-dim/10 rounded-full"></div>
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-md">
                            <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                            <span class="font-label-caps text-label-caps opacity-80">VitalFit Wallet</span>
                        </div>
                        <p class="font-label-caps text-label-caps uppercase tracking-widest opacity-80 mb-base">Current Balance</p>
                        <h3 class="font-metric-xl text-metric-xl mb-lg"><?php echo isset($user) ? number_format($user['solde'], 2) : '50.00'; ?>€</h3>
                    </div>
                    <a href="/portefeuille" class="w-full py-md bg-white text-primary rounded-lg font-label-caps text-label-caps font-bold hover:bg-primary-fixed-dim transition-colors flex items-center justify-center gap-sm">
                        <span class="material-symbols-outlined">add_circle</span>
                        Recharge Balance
                    </a>
                </div>
            </div>
            <!-- Personal Information Card -->
            <div class="md:col-span-7 bento-card bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-surface-variant/20">
                <h3 class="font-headline-sm text-headline-sm mb-lg flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">person</span>
                    Personal Information
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-lg gap-x-xl">
                    <div class="border-b border-surface-variant pb-sm">
                        <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Full Name</p>
                        <p class=\"font-body-lg text-body-lg font-semibold\"><?php echo isset($user) ? htmlspecialchars($user['username']) : 'Alex Richardson'; ?></p>
                    </div>
                    <div class="border-b border-surface-variant pb-sm">
                        <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Email Address</p>
                        <p class="font-body-lg text-body-lg font-semibold"><?php echo isset($user) ? htmlspecialchars($user['email']) : 'alex.richardson@VitalFit.com'; ?></p>
                    </div>
                    <div class="border-b border-surface-variant pb-sm">
                        <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Gender</p>
                        <p class="font-body-lg text-body-lg font-semibold"><?php echo isset($user) ? ucfirst($user['gender']) : 'Male'; ?></p>
                    </div>
                    <div class="border-b border-surface-variant pb-sm">
                        <div class="flex gap-xl">
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Height</p>
                                <p class="font-body-lg text-body-lg font-semibold"><?php echo isset($user) ? number_format($user['taille'], 2) : '1.82'; ?> m</p>
                            </div>
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-xs">Weight</p>
                                <p class="font-body-lg text-body-lg font-semibold"><?php echo isset($user) ? $user['poids'] : '74'; ?> kg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side Quick Actions/Goals -->
            <div class="md:col-span-5 bento-card bg-surface-container p-lg rounded-xl shadow-sm">
                <h3 class="font-headline-sm text-headline-sm mb-md flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">checklist</span>
                    Account Health
                </h3>
                <ul class="space-y-md">
                    <li class="flex items-center gap-md">
                        <div class="bg-primary/10 p-sm rounded-lg">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                        </div>
                        <div>
                            <p class="font-body-md text-body-md font-semibold">Compte vérifié</p>
                            <p class="text-[12px] text-on-surface-variant">Votre e-mail et votre identité sont confirmés.</p>
                        </div>
                    </li>

                    <li class="flex items-center gap-md">
                        <div class="bg-tertiary-container/10 p-sm rounded-lg">
                            <span class="material-symbols-outlined text-tertiary">lock_reset</span>
                        </div>
                        <div>
                            <p class="font-body-md text-body-md font-semibold">Mise à jour de sécurité</p>
                            <p class="text-[12px] text-on-surface-variant">Dernier changement de mot de passe : il y a 4 mois.</p>
                        </div>
                    </li>

                    <li class="flex items-center gap-md">
                        <div class="bg-secondary-container/10 p-sm rounded-lg">
                            <span class="material-symbols-outlined text-secondary">payments</span>
                        </div>
                        <div>
                            <p class="font-body-md text-body-md font-semibold">Recharge automatique</p>
                            <p class="text-[12px] text-on-surface-variant">Activée pour les montants inférieurs à 10 €.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- History Calendar & Chart -->
            <div class="md:col-span-12 bento-card bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-surface-variant/20">
                <h3 class="font-headline-sm text-headline-sm mb-lg flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">calendar_month</span>
                    Weight & BMI History
                </h3>

                <!-- Chart -->
                <div class="mb-xl">
                    <canvas id="metricsChart" class="w-full h-64"></canvas>
                </div>

                <!-- Calendar -->
                <div id="historyCalendar" class="mt-lg"></div>
            </div>

                    <script>
                        // Récupérer l'historique
                        let historyData = [];

                            fetch('<?= base_url("profile/getHistory") ?>')
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    historyData = data.history;

                                    // Initialiser le graphique
                                    initChart(historyData);

                                    // Initialiser le calendrier
                                    initCalendar(historyData);
                                }
                            });

                        function initChart(history) {
                            const ctx = document.getElementById('metricsChart').getContext('2d');
                            const dates = history.map(h => h.date);
                            const weights = history.map(h => h.poids);
                            const bmis = history.map(h => h.bmi);

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: dates,
                                    datasets: [{
                                            label: 'Weight (kg)',
                                            data: weights,
                                            borderColor: '#006d37',
                                            backgroundColor: 'rgba(0, 109, 55, 0.1)',
                                            tension: 0.3,
                                            yAxisID: 'y'
                                        },
                                        {
                                            label: 'BMI',
                                            data: bmis,
                                            borderColor: '#fc8f34',
                                            backgroundColor: 'rgba(252, 143, 52, 0.1)',
                                            tension: 0.3,
                                            yAxisID: 'y1'
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    interaction: {
                                        mode: 'index',
                                        intersect: false
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: (ctx) => `${ctx.dataset.label}: ${ctx.raw}`
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Weight (kg)'
                                            },
                                            beginAtZero: false
                                        },
                                        y1: {
                                            position: 'right',
                                            title: {
                                                display: true,
                                                text: 'BMI'
                                            },
                                            beginAtZero: false,
                                            grid: {
                                                drawOnChartArea: false
                                            }
                                        }
                                    }
                                }
                            });
                        }

                        function initCalendar(history) {
                            const events = history.map(h => ({
                                title: `Weight: ${h.poids} kg | BMI: ${h.bmi}`,
                                start: h.date,
                                allDay: true,
                                backgroundColor: '#006d37',
                                borderColor: '#006d37'
                            }));

                            const calendarEl = document.getElementById('historyCalendar');
                            const calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                height: 'auto',
                                headerToolbar: {
                                    left: 'prev,next',
                                    center: 'title',
                                    right: 'dayGridMonth,dayGridWeek'
                                },
                                events: events,
                                eventDidMount: function(info) {
                                    info.el.style.fontSize = '10px';
                                    info.el.style.whiteSpace = 'normal';
                                    info.el.style.lineHeight = '1.2';
                                }
                            });
                            calendar.render();
                        }

                        function updateMetric(type) {
                            const value = document.getElementById(type).value;

                            fetch('<?= base_url("profile/updateMetrics") ?>', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: `type=${type}&value=${value}`
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message);
                                        location.reload();
                                    } else {
                                        alert('Error: ' + (data.message || 'Unknown error'));
                                    }
                                })
                                .catch(err => alert('Error updating: ' + err));
                        }
                    </script>
        </div>

    </main>
</body>

</html>