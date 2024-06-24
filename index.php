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

$sql = "SELECT * FROM item_sale";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sale Items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Sale Items</h1>
    <a href="create.php">Add New</a>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Expired Date</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["item_code"] . "</td>
                        <td>" . $row["item_name"] . "</td>
                        <td>" . $row["quantity"] . "</td>
                        <td>" . $row["expired_date"] . "</td>
                        <td>" . $row["note"] . "</td>
                        <td>
                            <a href='edit.php?id=" . $row["id"] . "'>Edit</a> | 
                            <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No items found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
