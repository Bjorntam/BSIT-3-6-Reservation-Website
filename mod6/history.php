<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment";

// Connect to Database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get All Bookings
$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="historystyle.css">
</head>
<body>
    <div class="container history-container">
        <h1>Booking History</h1>

        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Payment Mode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo ucfirst($row['payment_mode']); ?></td>
                            <td>
                                <a href="summary.php?id=<?php echo $row['id']; ?>" class="btn">View Summary</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No bookings found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="payment.php" class="btn">Back to Home</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
