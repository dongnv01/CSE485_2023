<?php
function addCategory($ten_tloai) {

    global $pdo;
    $sql = "INSERT INTO theloai (ten_tloai) VALUES (:ten_tloai)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ten_tloai', $ten_tloai, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}

require_once 'connect.php';
include("auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_tloai = $_POST["ten_tloai"];


    if (addCategory($ten_tloai)) {
        header("Location: category.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới thể loại.";
    }
}

?>