<?php
function addAuthor($ten_tgia) {

    global $pdo;
    $sql = "INSERT INTO tacgia (ten_tgia) VALUES (:ten_tgia)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ten_tgia', $ten_tgia, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}

require_once 'connect.php';
include("auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_tgia = $_POST["ten_tgia"];


    if (addAuthor($ten_tgia)) {
        header("Location: author.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới tác giả.";
    }
}

?>