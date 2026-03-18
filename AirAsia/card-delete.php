<?php
include 'db-connect.php';

// Only allow deletion via POST to prevent accidental/malicious GET-triggered deletes
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: card-list.php");
    exit;
}

$cardId = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($cardId > 0) {
    $sql = "DELETE FROM GIFTCARD WHERE cardId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cardId);
    $stmt->execute();
    $conn->close();
}

header("Location: card-list.php");
exit;
?>
