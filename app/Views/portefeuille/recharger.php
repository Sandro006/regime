<?php
/**
 * Vue de recharge du portefeuille
 * Affiche un formulaire pour saisir un code de recharge
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recharger mon portefeuille - Régime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- En-tête -->
                <div class="mb-4">
                    <h1 class="h2 mb-2">💰 Recharger mon portefeuille</h1>
                    <p class="text-muted">Solde actuel: <strong><?php echo number_format($user['solde'], 2); ?> €</strong></p>
                </div>

                <!-- Affichage des messages d'erreur/succès -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur:</strong> <?php echo session()->getFlashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Succès:</strong> <?php echo session()->getFlashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Formulaire de recharge -->
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="<?php echo base_url('/portefeuille/validerCode'); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label for="code" class="form-label">Code de recharge</label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-lg" 
                                    id="code" 
                                    name="code" 
                                    placeholder="Saisir votre code ici" 
                                    required 
                                    autocomplete="off"
                                    maxlength="50"
                                >
                                <small class="form-text text-muted">Saisissez le code fourni avec votre carte cadeau ou bon d'achat</small>
                            </div>

                            <!-- Boutons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle"></i> Valider le code
                                </button>
                                <a href="<?php echo base_url('/portefeuille'); ?>" class="btn btn-outline-secondary btn-lg">
                                    Retour
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Informations utiles -->
                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="mb-3">📌 Conseils:</h6>
                    <ul class="small mb-0">
                        <li>Les codes sont sensibles à la casse</li>
                        <li>Chaque code ne peut être utilisé qu'une seule fois</li>
                        <li>Vérifiez que votre code n'a pas déjà été utilisé</li>
                        <li>Le solde sera crédité immédiatement après validation</li>
                    </ul>
                </div>

                <!-- Lien vers l'historique -->
                <div class="mt-3 text-center">
                    <a href="<?php echo base_url('/portefeuille'); ?>" class="text-decoration-none">
                        ← Voir mon historique de transactions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
