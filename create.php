<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "v_store";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $expired_date = $_POST['expired_date'];
    $note = $_POST['note'];

    $sql = "INSERT INTO item_sale (item_code, item_name, quantity, expired_date, note)
            VALUES ('$item_code', '$item_name', '$quantity', '$expired_date', '$note')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Item</h1>
    <form method="POST" action="create.php">
        <label>Item Code:</label>
        <input type="text" name="item_code" required>
        <br>
        <label>Item Name:</label>
        <input type="text" name="item_name" required>
        <br>
        <label>Quantity:</label>
        <input type="number" name="quantity" step="0.01" required>
        <br>
        <label>Expired Date:</label>
        <input type="date" name="expired_date" required>
        <br>
        <label>Note:</label>
        <input type="text" name="note">
        <br>
        <button type="submit">Add</button>
    </form>
</body>
</html>

