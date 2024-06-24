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
    $id = $_POST['id'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $expired_date = $_POST['expired_date'];
    $note = $_POST['note'];

    $sql = "UPDATE item_sale SET item_code='$item_code', item_name='$item_name', quantity='$quantity', expired_date='$expired_date', note='$note' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM item_sale WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Item not found";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Item</h1>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Item Code:</label>
        <input type="text" name="item_code" value="<?php echo $row['item_code']; ?>" required>
        <br>
        <label>Item Name:</label>
        <input type="text" name="item_name" value="<?php echo $row['item_name']; ?>" required>
        <br>
        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" step="0.01" required>
        <br>
        <label>Expired Date:</label>
        <input type="date" name="expired_date" value="<?php echo $row['expired_date']; ?>" required>
        <br>
        <label>Note:</label>
        <input type="text" name="note" value="<?php echo $row['note']; ?>">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
