<?php
// Test simple de connexion MySQL

echo "🔍 TEST DE CONNEXION MySQL\n";
echo "============================\n\n";

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'Regime';

try {
    $conn = new mysqli($host, $user, $password, $database);
    
    if ($conn->connect_error) {
        die("❌ Erreur de connexion: " . $conn->connect_error);
    }
    
    echo "✅ Connexion établie!\n";
    echo "Serveur: $host\n";
    echo "Base: $database\n\n";
    
    // Vérifier la table users
    echo "📋 Structure de la table 'users':\n";
    $result = $conn->query("DESCRIBE users");
    
    while ($row = $result->fetch_assoc()) {
        echo "  - {$row['Field']}: {$row['Type']}\n";
    }
    
    echo "\n📊 Nombre d'utilisateurs: ";
    $count = $conn->query("SELECT COUNT(*) as total FROM users");
    $row = $count->fetch_assoc();
    echo $row['total'] . "\n\n";
    
    echo "✅ Tout fonctionne correctement!\n";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
}
?>
