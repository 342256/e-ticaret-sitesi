<?php  
error_reporting(E_ALL);  
ini_set('display_errors', 1);  
session_start();  
  
$conn = new mysqli("localhost", "root", "", "hay_sev");  
if ($conn->connect_error) {  
    die("Bağlantı başarısız: " . $conn->connect_error);  
}  

  
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name']) && isset($_POST['product_price'])) {  
    $urun = [  
        'isim' => $_POST['product_name'],  
        'fiyat' => $_POST['product_price'],  
    ];  

     
    $_SESSION['sepet'][] = $urun;  

     
    header('Location: sepet.php');  
    exit;   
}  
 
$cart = isset($_SESSION['sepet']) ? $_SESSION['sepet'] : [];  

?>  

<!DOCTYPE html>  
<html lang="tr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Sepet</title>  
    <link rel="stylesheet" type="text/css" href="css/style2.css">  
</head>  
<body>  
    <div class="container">  
        <div class="logo">  
            <img src="resimler/barınak logo.jpg" alt="Barınak Logo" class="logo-img">  
        </div>  

        <h3 style="color:black; text-align: center;">Sepetiniz</h3>  
        <ul>  
            <?php if (empty($cart)): ?>  
                <li>Sepetinizde ürün bulunmamaktadır.</li>  
            <?php else: ?>  
                <?php foreach ($cart as $item): ?>  
                    <li>  
                        <?php echo htmlspecialchars($item['isim'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars($item['fiyat'], ENT_QUOTES, 'UTF-8'); ?>  
                    </li>  
                <?php endforeach; ?>  
            <?php endif; ?>  
        </ul>    

        <button onclick="window.location.href='../index2.html'">Ürünlere Dön</button>  
        <button onclick="window.location.href='addproduct.php'">Sipariş Ver</button>
    </div>  
</body>  
</html>