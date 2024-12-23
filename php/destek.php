<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "hay_sev");

if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $konu = $_POST['konu'];
    $mesaj = $_POST['mesaj'];

    $stmt = $conn->prepare("INSERT INTO iletisim (ad, soyad, email, konu, mesaj) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $ad, $soyad, $email, $konu, $mesaj);

    if ($stmt->execute()) {
        echo "Mesajınız başarıyla gönderildi!";
        header("Refresh: 3; URL=../index5.html"); 
    } else {
        echo "Mesaj kaydedilirken hata oluştu: " . $stmt->error;
    }

    $stmt->close(); 
}

$conn->close();
?>
