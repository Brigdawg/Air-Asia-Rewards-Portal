<?php
// Include database connection
include 'db-connect.php';

$successMessage = "";
$errorMessage = "";

$allowed_types = ['Food & Beverage', 'Shopping', 'Entertainment', 'Electronics',
                  'Transportation', 'Beauty', 'Home Improvement', 'Sports', 'Gaming', 'Books', 'Travel'];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardName = trim($_POST['cardName'] ?? '');
    $cardType = trim($_POST['cardType'] ?? '');
    $cardValue = floatval($_POST['cardValue'] ?? 0);
    $points = intval($_POST['points'] ?? 0);

    // Server-side validation
    if (empty($cardName)) {
        $errorMessage = "Card name cannot be empty.";
    } elseif (!in_array($cardType, $allowed_types)) {
        $errorMessage = "Invalid card type selected.";
    } elseif ($cardValue <= 0) {
        $errorMessage = "Card value must be greater than zero.";
    } elseif ($points <= 0) {
        $errorMessage = "Points required must be greater than zero.";
    } else {
        $sql = "INSERT INTO GIFTCARD (cardName, cardType, cardValue, points) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $cardName, $cardType, $cardValue, $points);

        if ($stmt->execute()) {
            $successMessage = "Gift card added successfully!";
            header("refresh:2;url=card-list.php");
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gift Card - AirAsia Rewards</title>
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
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #d71920;
            outline: none;
        }
        .btn-submit {
            background-color: #d71920;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-right: 10px;
        }
        .btn-submit:hover {
            background-color: #b81419;
        }
        .btn-cancel {
            background-color: #666;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-cancel:hover {
            background-color: #555;
        }
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .error-message {
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Add New Gift Card</h1>
    </div>

    <div class="nav-links">
        <a href="card-list.php">View Gift Cards</a>
        <a href="card-add.php">Add New Gift Card</a>
    </div>

    <div class="form-container">
        <?php
        if ($successMessage) {
            echo "<div class='success-message'>$successMessage<br>Redirecting to gift card list...</div>";
        }
        if ($errorMessage) {
            echo "<div class='error-message'>$errorMessage</div>";
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="cardName">Card Name:</label>
                <input type="text" id="cardName" name="cardName" required>
            </div>
            
            <div class="form-group">
                <label for="cardType">Card Type:</label>
                <select id="cardType" name="cardType" required>
                    <option value="">-- Select Type --</option>
                    <option value="Food & Beverage">Food & Beverage</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Transportation">Transportation</option>
                    <option value="Beauty">Beauty</option>
                    <option value="Home Improvement">Home Improvement</option>
                    <option value="Sports">Sports</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Books">Books</option>
                    <option value="Travel">Travel</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="cardValue">Card Value ($):</label>
                <input type="number" id="cardValue" name="cardValue" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="points">Points Required:</label>
                <input type="number" id="points" name="points" min="0" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn-submit">Add Gift Card</button>
                <a href="card-list.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>

<?php
$conn->close();
?>
