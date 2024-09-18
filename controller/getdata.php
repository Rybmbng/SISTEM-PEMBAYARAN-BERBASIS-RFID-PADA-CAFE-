<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT value FROM notif LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $value = $row['value'];
        echo $value;
    } else {
        echo "Data tidak ditemukan";
    }
}
$conn->close();
?>
