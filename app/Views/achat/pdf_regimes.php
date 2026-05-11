<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Régimes - VitalPath</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            color: #161d17;
            line-height: 1.6;
        }
        
        .container {
            margin: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #006d37;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #006d37;
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #3d4a3e;
            font-size: 12px;
        }
        
        .user-info {
            background-color: #f3fcf1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 12px;
        }
        
        .user-info p {
            margin: 5px 0;
        }
        
        .stats-container {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        
        .stat-box {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            border: 1px solid #bbcbbb;
            text-align: center;
        }
        
        .stat-box h3 {
            color: #006d37;
            font-size: 24px;
            margin: 10px 0;
        }
        
        .stat-box p {
            color: #3d4a3e;
            font-size: 11px;
        }
        
        h2 {
            color: #006d37;
            font-size: 16px;
            margin: 25px 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #006d37;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background-color: #e8f0e5;
        }
        
        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            color: #161d17;
            font-size: 11px;
            border: 1px solid #bbcbbb;
        }
        
        table td {
            padding: 10px 12px;
            border: 1px solid #bbcbbb;
            font-size: 10px;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f3fcf1;
        }
        
        .status-active {
            color: #006d37;
            font-weight: bold;
        }
        
        .status-expired {
            color: #ba1a1a;
            font-weight: bold;
        }
        
        .empty-message {
            text-align: center;
            padding: 20px;
            color: #3d4a3e;
            font-size: 12px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #bbcbbb;
            color: #3d4a3e;
            font-size: 10px;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <h1>VitalFit</h1>
            <p>Rapport de vos régimes actifs</p>
        </div>
        
        <!-- Informations utilisateur -->
        <div class="user-info">
            <p><strong>Utilisateur:</strong> <?php echo htmlspecialchars($user['username'] ?? 'N/A'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></p>
            <p><strong>Date du rapport:</strong> <?php echo date('d/m/Y à H:i'); ?></p>
        </div>
        
        <!-- Statistiques -->
        <div class="stats-container">
            <div class="stat-box">
                <p>Total de régimes</p>
                <h3><?php echo isset($stats) ? $stats['total_regimes'] ?? 0 : 0; ?></h3>
            </div>
            <div class="stat-box">
                <p>Régimes actifs</p>
                <h3><?php echo isset($stats) ? $stats['regimes_actifs'] ?? 0 : 0; ?></h3>
            </div>
            <div class="stat-box">
                <p>Régimes terminés</p>
                <h3><?php echo isset($stats) ? $stats['regimes_termines'] ?? 0 : 0; ?></h3>
            </div>
        </div>
        
        <!-- Tableau des régimes -->
        <h2>Détail de vos régimes</h2>
        
        <?php if (isset($regimes) && !empty($regimes)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Régime</th>
                        <th>Activité</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Durée</th>
                        <th>Prix</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($regimes as $regime): ?>
                        <?php 
                        $now = new DateTime();
                        $fin = new DateTime($regime['date_fin']);
                        $statut = $fin < $now ? 'Expiré' : 'Actif';
                        $statusClass = $fin < $now ? 'status-expired' : 'status-active';
                        ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($regime['nom_regime']); ?></strong></td>
                            <td><?php echo htmlspecialchars($regime['nom_activite'] ?? 'N/A'); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($regime['date_debut'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($regime['date_fin'])); ?></td>
                            <td><?php echo htmlspecialchars($regime['duree']); ?> jours</td>
                            <td><?php echo number_format($regime['prix'], 2, ',', ' '); ?> €</td>
                            <td class="<?php echo $statusClass; ?>"><?php echo $statut; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-message">
                <p>Vous n'avez pas encore acheté de régime.</p>
            </div>
        <?php endif; ?>
        
        <!-- Pied de page -->
        <div class="footer">
            <p>Ce document a été généré automatiquement par VitalFit le <?php echo date('d/m/Y à H:i'); ?></p>
            <p>© 2026 VitalFit - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
