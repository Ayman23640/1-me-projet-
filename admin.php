<?php
include 'db.php';
$query = "SELECT * FROM orders ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Commandes Clients</title>
    <style>
        body { font-family: sans-serif; background: #222; color: white; padding: 50px; }
        table { width: 100%; border-collapse: collapse; background: #fff; color: #333; }
        th, td { padding: 12px; border: 1px solid #ddd; }
        th { background: #ff5722; color: white; }
    </style>
</head>
<body>
    <h1>👨‍🍳 Tableau des Commandes (Admin)</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Détails</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['items']; ?></td>
            <td><?php echo $row['total_price']; ?> DH</td>
            <td><?php echo $row['order_date']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php" style="color: #ff5722;">Retour à l'accueil</a>
</body>
</html>
