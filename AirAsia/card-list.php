<?php
// Include database connection
include 'db-connect.php';

// Query to get all gift cards
$sql = "SELECT * FROM GIFTCARD ORDER BY cardName";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Cards - AirAsia Rewards</title>
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
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .card-image {
            width: 100%;
            height: 150px;
            background-color: #e0e0e0;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 48px;
        }
        .card-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .card-name a {
            color: #333;
            text-decoration: none;
        }
        .card-name a:hover {
            color: #d71920;
        }
        .card-info {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .card-points {
            color: #d71920;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AirAsia Rewards - Gift Cards</h1>
    </div>

    <div class="nav-links">
        <a href="card-list.php">View Gift Cards</a>
        <a href="card-add.php">Add New Gift Card</a>
    </div>

    <div class="card-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Icon based on card type
                $icon = "🎁";
                if (strpos($row["cardType"], "Food") !== false) {
                    $icon = "🍔";
                } elseif (strpos($row["cardType"], "Shopping") !== false) {
                    $icon = "🛍️";
                } elseif (strpos($row["cardType"], "Entertainment") !== false) {
                    $icon = "🎬";
                } elseif (strpos($row["cardType"], "Travel") !== false) {
                    $icon = "✈️";
                }
                
                echo "<div class='card'>";
                echo "<div class='card-image'>" . $icon . "</div>";
                echo "<div class='card-name'><a href='card-details.php?id=" . $row["cardId"] . "'>" . htmlspecialchars($row["cardName"]) . "</a></div>";
                echo "<div class='card-info'>Type: " . htmlspecialchars($row["cardType"]) . "</div>";
                echo "<div class='card-info'>Value: $" . number_format($row["cardValue"], 2) . "</div>";
                echo "<div class='card-points'>" . number_format($row["points"]) . " Points</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No gift cards available.</p>";
        }
        ?>
    </div>

</body>
</html>

<?php
$conn->close();
?>
