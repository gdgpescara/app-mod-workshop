<?php
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image_id = $_POST['image_id'];
    $stmt = $pdo->prepare("UPDATE images SET inappropriate = 1 WHERE id = ?");
    $stmt->execute([$image_id]);
    echo "Immagine segnalata come inappropriata.";
    header("Location: index.php");
}
?>
