<?php
//Initialisation
$stats = $daoMatch->getGlobalStats();
$total = $stats['total'] > 0 ? $stats['total'] : 1;
$pourcentageV = round(($stats['victoires'] / $total) * 100, 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistique</title>

    <h1>Statistique de la saison</h1>

    <div  class="stats-grid">
        <div class="stats-card">
            <span class="stat-number"><?php echo $stats['total']; ?></span>
            <span class="stat-label">Match Joues</span>
        </div>
        
    </div>
</head>
<body>
    
</body>
</html>