<?php  
error_reporting(E_ALL);  
ini_set('display_errors', 1);  
session_start();  

$cart = isset($_SESSION['sepet']) ? $_SESSION['sepet'] : []; 
  
$conn = new mysqli("localhost", "root", "", "hay_sev");  

if ($conn->connect_error) {  
    die("Bağlantı başarısız: " . $conn->connect_error);  
} 

if (!empty($cart)) {
    
    foreach ($cart as $item) {
        
        $stmt = $conn->prepare("INSERT INTO sepet (product_name, product_price) VALUES (?, ?)");
        $stmt->bind_param("sd", $item['isim'], $item['fiyat']); 

        if ($stmt->execute()) {
            echo "Ürün başarıyla kaydedildi: " . $item['isim'] . "<br>";
        } else {
            echo "Ürün kaydedilirken hata oluştu: " . $item['isim'] . "<br>";
        }
        
        $stmt->close(); 
    }

   
    unset($_SESSION['sepet']); 
    echo "Sepet başarıyla kaydedildi ve temizlendi.";
} else {
    echo "Sepet boş.";
}

$conn->close(); 
?>
