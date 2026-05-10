<?php
/**
 * Vue du portefeuille utilisateur
 * Affiche le solde actuel et l'historique des transactions
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon portefeuille - Régime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .solde-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .solde-amount {
            font-size: 3rem;
            font-weight: bold;
            margin: 20px 0;
        }
        .solde-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .transaction-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .badge-recharge {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-achat {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-gold {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-remboursement {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .stats-container {
            margin-top: 30px;
        }
        .stat-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            border-left: 4px solid #667eea;
        }
        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
        }
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="h2">💰 Mon portefeuille</h1>
            <p class="text-muted">Gérez votre solde et consultez vos transactions</p>
        </div>

        <!-- Affichage des messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>✓ Succès:</strong> <?php echo session()->getFlashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>✗ Erreur:</strong> <?php echo session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Card Solde Principal -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="solde-card">
                    <div class="solde-label">Solde disponible</div>
                    <div class="solde-amount">
                        <?php echo number_format($user['solde'], 2); ?> €
                    </div>
                    <a href="<?php echo base_url('/portefeuille/recharger'); ?>" class="btn btn-light btn-lg mt-3">
                        <i class="bi bi-plus-circle"></i> Recharger mon portefeuille
                    </a>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="col-md-4">
                <div class="stats-container">
                    <div class="stat-card mb-3">
                        <div class="stat-value"><?php echo $stats['Recharge']['count']; ?></div>
                        <div class="stat-label">Recharges</div>
                    </div>
                    <div class="stat-card mb-3">
                        <div class="stat-value"><?php echo $stats['Achat']['count']; ?></div>
                        <div class="stat-label">Achats</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" style="color: #ffc107;">
                            <?php echo $stats['Gold']['count']; ?>
                        </div>
                        <div class="stat-label">Gold</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historique des transactions -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">📋 Historique des transactions</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($transactions)): ?>
                            <div class="p-4 text-center text-muted">
                                <p>Aucune transaction pour le moment.</p>
                                <a href="<?php echo base_url('/portefeuille/recharger'); ?>" class="btn btn-primary btn-sm">
                                    Recharger maintenant
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="20%">Date</th>
                                            <th width="20%">Type</th>
                                            <th width="30%">Description</th>
                                            <th width="15%">Montant</th>
                                            <th width="15%">Solde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $transaction): ?>
                                            <tr>
                                                <td>
                                                    <small class="text-muted">
                                                        <?php echo date('d/m/Y H:i', strtotime($transaction['date_transaction'])); ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <?php
                                                    $badgeClass = 'badge-recharge';
                                                    $icon = '➕';
                                                    
                                                    if ($transaction['type'] === 'Achat') {
                                                        $badgeClass = 'badge-achat';
                                                        $icon = '🛒';
                                                    } elseif ($transaction['type'] === 'Gold') {
                                                        $badgeClass = 'badge-gold';
                                                        $icon = '👑';
                                                    } elseif ($transaction['type'] === 'Remboursement') {
                                                        $badgeClass = 'badge-remboursement';
                                                        $icon = '🔄';
                                                    }
                                                    ?>
                                                    <span class="transaction-badge <?php echo $badgeClass; ?>">
                                                        <?php echo $icon . ' ' . $transaction['type']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <small>
                                                        <?php echo $transaction['description'] ?? '-'; ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <strong>
                                                        <?php
                                                        $montantDisplay = number_format($transaction['montant'], 2);
                                                        if (in_array($transaction['type'], ['Achat', 'Gold', 'Remboursement'])) {
                                                            echo '<span style="color: #dc3545;">-' . $montantDisplay . ' €</span>';
                                                        } else {
                                                            echo '<span style="color: #28a745;">+' . $montantDisplay . ' €</span>';
                                                        }
                                                        ?>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <small class="text-muted">N/A</small>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Résumé -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">📊 Dépenses totales</h6>
                        <p class="card-text">
                            <strong style="color: #dc3545;">
                                -<?php echo number_format($stats['Achat']['total'] + $stats['Gold']['total'], 2); ?> €
                            </strong>
                        </p>
                        <small class="text-muted">
                            Achats: <?php echo number_format($stats['Achat']['total'], 2); ?> €<br>
                            Gold: <?php echo number_format($stats['Gold']['total'], 2); ?> €
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">💵 Recharges totales</h6>
                        <p class="card-text">
                            <strong style="color: #28a745;">
                                +<?php echo number_format($stats['Recharge']['total'], 2); ?> €
                            </strong>
                        </p>
                        <small class="text-muted">
                            <?php echo $stats['Recharge']['count']; ?> recharge(s) effectuée(s)
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Retour -->
        <div class="mt-4 text-center">
            <a href="<?php echo base_url('/'); ?>" class="btn btn-outline-secondary">
                ← Retour à l'accueil
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
