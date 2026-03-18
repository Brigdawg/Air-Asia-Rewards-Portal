<?php
// Include database connection
include 'db-connect.php';

// Get card ID from URL
$cardId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to get specific gift card
$sql = "SELECT * FROM GIFTCARD WHERE cardId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cardId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $card = $result->fetch_assoc();
} else {
    echo "Gift card not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($card['cardName']); ?> - AirAsia Rewards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #d71920;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .nav-links {
            background-color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .nav-links a {
            color: #d71920;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .card-details {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card-image-large {
            width: 100%;
            height: 300px;
            background-color: #e0e0e0;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            font-size: 120px;
        }
        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
            color: #333;
        }
        .detail-value {
            color: #666;
            flex: 1;
        }
        .points-highlight {
            color: #d71920;
            font-size: 24px;
            font-weight: bold;
        }
        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }
        .btn-update {
            background-color: #4CAF50;
            color: white;
        }
        .btn-update:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
        }
        .btn-back {
            background-color: #666;
            color: white;
        }
        .btn-back:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Gift Card Details</h1>
    </div>

    <div class="nav-links">
        <a href="card-list.php">View Gift Cards</a>
        <a href="card-add.php">Add New Gift Card</a>
    </div>

    <div class="card-details">
        <?php
        // Icon based on card type
        $icon = "🎁";
        if (strpos($card["cardType"], "Food") !== false) {
            $icon = "🍔";
        } elseif (strpos($card["cardType"], "Shopping") !== false) {
            $icon = "🛍️";
        } elseif (strpos($card["cardType"], "Entertainment") !== false) {
            $icon = "🎬";
        } elseif (strpos($card["cardType"], "Travel") !== false) {
            $icon = "✈️";
        }
        ?>
        
        <div class="card-image-large"><?php echo $icon; ?></div>
        
        <div class="detail-row">
            <div class="detail-label">Card ID:</div>
            <div class="detail-value"><?php echo htmlspecialchars($card['cardId']); ?></div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Card Name:</div>
            <div class="detail-value"><?php echo htmlspecialchars($card['cardName']); ?></div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Card Type:</div>
            <div class="detail-value"><?php echo htmlspecialchars($card['cardType']); ?></div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Card Value:</div>
            <div class="detail-value">$<?php echo number_format($card['cardValue'], 2); ?></div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Points Required:</div>
            <div class="detail-value points-highlight"><?php echo number_format($card['points']); ?> Points</div>
        </div>
        
        <div class="action-buttons">
            <a href="card-update.php?id=<?php echo $card['cardId']; ?>" class="btn btn-update">Update Card</a>
            <form method="POST" action="card-delete.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this gift card?');">
                <input type="hidden" name="id" value="<?php echo $card['cardId']; ?>">
                <button type="submit" class="btn btn-delete">Delete Card</button>
            </form>
            <a href="card-list.php" class="btn btn-back">Back to List</a>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
