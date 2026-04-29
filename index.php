<?php
session_start();
include 'db.php'; 

// كود إضافة للسلعة (معدل باش يشد البيانات من الـ Select)
if(isset($_GET['add_to_cart'])) {
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    
    // كنفرقو السمية والثمن اللي جاو من الـ Select
    $item_data = explode('|', $_GET['item_info']);
    $item_name = $item_data[0];
    $item_price = $item_data[1];
    $category = $_GET['cat'];

    $_SESSION['cart'][] = ["name" => $category . " " . $item_name, "price" => $item_price];
    header("Location: commande.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kafood - Home & Menu</title>
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="hero.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="chef.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-brand" onclick="window.location='index.php'">
        <div class="logo-box">LOGO</div>
        <span class="brand-name">Kafood</span>
    </div>

    <div style="display: flex; align-items: center; gap: 20px;">
        <ul class="nav-menu" id="navMenu">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="services.php">Services</a></li>
            <div class="auth-btns">
                <?php if(isset($_SESSION['username'])): ?>
                    <span style="color: #aaa;">👤 <?php echo $_SESSION['username']; ?></span>
                    <a href="logout.php" class="btn btn-logout">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="signup.php" class= "btn btn-signup">Sign Up</a>
                <?php endif; ?>
            </div>
        </ul>
        <div class="burger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>
    </div>
</nav>


   <section class="hero">
      <div class="hero-container">
         <div class="hero-content">
            <span class="hero-subtitle">FOOD</span>
            <h1 class="hero-title">THE BEST RESTAURANT IN THE WORLD</h1>
            <p class="hero-description">
               Handcrafted dishes made with the finest ingredients and authentic flavors.
               Freshly prepared meals, bold spices, and a chef-driven menu you will love.
               Enjoy a warm atmosphere and fast friendly service for dine-in or takeaway.
               Seasonal specials and curated recommendations to delight your taste buds.
            </p>
            <a href="menu-title" class="btn-commander">COMMANDER</a>
         </div>

         <div class="hero-image-container">
            <img src="imagehero.png" alt="SA FOOD signature dish" class="hero-image" onerror="this.src='https://via.placeholder.com/400x300?text=Hero+Image'">
         </div>
      </div>
   </section>




<main>
    <h1 class="menu-title">Explore Our Menua </h1>
    <div class="menu-grid">
        <?php
        $menu = [
            "Pizza" => ["Margarita" => 15, "Viande Hachée" => 25, "Poulet" => 25, "Chicken" => 30],
            "Tacos" => ["Mixte" => 35, "Poulet" => 30, "Shawarma" => 30, "Viande Hachée" => 30, "Chicken" => 30],
            "Shawarma" => ["Normal" => 25, "double" => 35],
            "Salade" => ["Marocaine" => 15, "César" => 25, "Mixte" => 20],
            "Pasticio" => ["Poulet" => 35, "Mixte" => 40, "Viande Hachée" => 35, "Chicken" => 40],
            "M9ila" => ["Crevettes" => 40, "calamar" => 35, "Mixte" => 45],
        ];

        $images = [
            "Pizza" => "Pizza.jpg",
            "Tacos" => "tacos.jpg",
            "Shawarma" => "Shawarma.jpg",
            "Salade" => "salade.jpg",
            "Pasticio" => "Pasticcio.jpg",
            "M9ila" => "m9ila.jpg",
        ];

        foreach($menu as $cat => $items):
            $image_src = isset($images[$cat]) ? $images[$cat] : 'https://via.placeholder.com/400x180?text=No+Image';
        ?>
        <div class="card">
            <img src="<?php echo $image_src; ?>" alt="<?php echo $cat; ?>" onerror="this.src='https://via.placeholder.com/400x180?text=No+Image'">
            
            <div class="card-body">
                <h2><?php echo $cat; ?></h2>
                
                <form action="index.php" method="GET">
                    <!-- كنصيفطو الكاتيغوري مخبية -->
                    <input type="hidden" name="cat" value="<?php echo $cat; ?>">
                    
                    <label style="font-size: 12px; color: #777;">Khtar l-nou3:</label>
                    <select name="item_info" class="custom-select">
                        <?php foreach($items as $name => $price): ?>
                            <option value="<?php echo $name . '|' . $price; ?>">
                                <?php echo $name; ?> - <?php echo $price; ?> DH
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" name="add_to_cart" class="submit-btn">
                        Ajouter +
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>




<section class="chefs-section">
  <h2 class="section-title">OUR CHEFS</h2>
  <div class="chefs-slider">
    <button class="prev" type="button">&lt;</button>
    <div class="chefs-container">
      <div class="chef-item">
        <img src="CHEFKHADIJA.png" alt="Khadija Quistas">
        <div class="chef-name">khadija Quistas</div>
        <div class="chef-specialty">Manager</div>
      </div>
      <div class="chef-item">
        <img src="chef1.png" alt="Ayman Mouradi">
        <div class="chef-name">Ayman Mouradi</div>
        <div class="chef-specialty">Professional Chef</div>
      </div>
      <div class="chef-item">
        <img src="téléchargement (1).jpg" alt="Mohamed">
        <div class="chef-name">ziad</div>
        <div class="chef-specialty">Grill Specialist</div>
      </div>
      <div class="chef-item">
        <img src="téléchargement.jpg" alt="Sara">
        <div class="chef-name">uchina</div>
        <div class="chef-specialty">Sushi Master</div>
      </div>
    </div>
    <button class="next" type="button">&gt;</button>
  </div>
</section>



<footer class="footer" id="contact">
  <div class="footer-content">
    <div class="footer-column">
      <h3>KA FOOD</h3>
      <p>Le meilleur restaurant du monde. On vous sert avec amour.</p>
    </div>
    <div class="footer-column">
      <h3>Contact</h3>
      <p>📞 +212 612-345-678</p>
      <p>✉️ contact@Kafood.com</p>
      <p>📍 Boulevard 2 Mars, Casablanca</p>
      <p>🕑 10h - 23h / 7j</p>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" rel="noopener">📘</a>
        <a href="https://wa.me/212612345678" target="_blank" rel="noopener">🟢</a>
        <a href="https://instagram.com" target="_blank" rel="noopener">📸</a>
      </div>
    </div>
    <div class="footer-column">
      <h3>Où nous trouver</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2276.7433727036305!2d-7.609172445406036!3d33.563449578820006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda632aadb28ed6d%3A0xdd97028e9f0a6513!2sMosqu%C3%A9e%20Sonna!5e0!3m2!1sfr!2sma!4v1749894977685!5m2!1sfr!2sma" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Carte"></iframe>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 KA FOOD. All rights reserved.</p>
  </div>
</footer>



<script>
    function toggleMenu() {
        const navMenu = document.getElementById('navMenu');
        const burger = document.querySelector('.burger');
        
        if (navMenu && burger) {
            navMenu.classList.toggle('active');
            burger.classList.toggle('active');
        }
    }
</script>
 <script src="navbar.js"></script>
 <script src="index.js"></script>
 <script src="chef.js"></script>
 <script src="menu.js"></script>

</body>
</html>
