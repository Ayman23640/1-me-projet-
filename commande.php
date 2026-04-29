<?php
session_start();
include 'db.php';

// 1. حذف منتج من السلة
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    unset($_SESSION['cart'][$id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // إعادة ترتيب المصفوفة
    header("Location: commande.php");
    exit();
}

// 2. تأكيد الطلب وإرساله لقاعدة البيانات
if (isset($_POST['confirm'])) {
    if (!empty($_SESSION['cart'])) {
        $username = $_SESSION['username'];
        $items = "";
        $total = 0;

        foreach ($_SESSION['cart'] as $product) {
            $items .= $product['name'] . " (" . $product['price'] . "DH), ";
            $total += $product['price'];
        }

        $query = "INSERT INTO orders (username, items, total_price) VALUES ('$username', '$items', '$total')";
        if (mysqli_query($conn, $query)) {
            unset($_SESSION['cart']); // مسح السلة بعد التأكيد
            echo "<script>
                alert('Votre commande est envoyée au responsable !');
                window.location.href = 'admin.php';
            </script>";
        }
    } else {
        echo "<script>alert('Votre panier est vide !');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Commande - Kafood</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 50px; }
        .container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #ff5722; color: white; }
        .btn-add { background: #333; color: white; padding: 10px; text-decoration: none; border-radius: 5px; }
        .btn-confirm { background: #ff5722; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-del { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🛒 Votre Commande</h2>
        <table>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>
            <?php 
            $total_price = 0;
            if (!empty($_SESSION['cart'])): 
                foreach ($_SESSION['cart'] as $key => $item): 
                    $total_price += $item['price'];
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?> DH</td>
                <td><a href="commande.php?del=<?php echo $key; ?>" class="btn-del">Supprimer</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="3">Votre panier est vide.</td></tr>
            <?php endif; ?>
        </table>
        
        <h3>Total: <?php echo $total_price; ?> DH</h3>
        
        <div style="margin-top: 20px;">
            <a href="index.php" class="btn-add">+ Ajouter d'autres</a>
            <?php if (!empty($_SESSION['cart'])): ?>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="confirm" class="btn-confirm">Confirmer la Commande</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
