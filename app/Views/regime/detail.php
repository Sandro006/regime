<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Details regime</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
</head>

<body>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (empty($regime)) : ?>
                    <div class="alert alert-warning" role="alert">
                        Regime introuvable.
                    </div>
                <?php else : ?>
                    <?php
                    $id = $regime['id'] ?? null;
                    $nom = $regime['nom'] ?? $regime['nom_regime'] ?? 'Regime';
                    $description = $regime['description'] ?? '';
                    $prix = $regime['prix'] ?? 'n/a';
                    $duree = $regime['duree'] ?? 'n/a';
                    $variation = $regime['variation_poids'] ?? 'n/a';
                    $viande = $regime['pourcentage_viande'] ?? 'n/a';
                    $poisson = $regime['pourcentage_poisson'] ?? 'n/a';
                    $volaille = $regime['pourcentage_volaille'] ?? 'n/a';
                    ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h1 class="h3 mb-1"><?= esc($nom) ?></h1>
                                    <p class="text-muted mb-0">Details du regime</p>
                                </div>
                                <?php if (!empty($id)) : ?>
                                    <span class="badge text-bg-primary">#<?= esc($id) ?></span>
                                <?php endif; ?>
                            </div>

                            <p class="text-muted">
                                <?= $description !== '' ? esc($description) : 'Aucune description.' ?>
                            </p>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 h-100">
                                        <div class="text-muted text-uppercase small">Prix</div>
                                        <div class="fs-5 fw-semibold"><?= esc($prix) ?><?= $prix !== 'n/a' ? ' €' : '' ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 h-100">
                                        <div class="text-muted text-uppercase small">Duree</div>
                                        <div class="fs-5 fw-semibold"><?= esc($duree) ?><?= $duree !== 'n/a' ? ' jours' : '' ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 h-100">
                                        <div class="text-muted text-uppercase small">Variation poids</div>
                                        <div class="fs-5 fw-semibold"><?= esc($variation) ?><?= $variation !== 'n/a' ? ' kg' : '' ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 h-100">
                                        <div class="text-muted text-uppercase small">Repartition viandes</div>
                                        <div class="fs-6">Viande: <?= esc($viande) ?>%</div>
                                        <div class="fs-6">Poisson: <?= esc($poisson) ?>%</div>
                                        <div class="fs-6">Volaille: <?= esc($volaille) ?>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between gap-2">
                            <a class="btn btn-outline-secondary" href="/regime/list">Retour</a>
                            <button class="btn btn-primary" type="button">Acheter</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
