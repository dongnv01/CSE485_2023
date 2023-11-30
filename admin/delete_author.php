<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $ma_tgia = $_GET["id"];


    require_once 'connect.php'; 
    include("auth.php");


    $pdo->beginTransaction();

    try {

        $stmt_delete_baiviet = $pdo->prepare("DELETE FROM baiviet WHERE ma_tgia = :ma_tgia");
        $stmt_delete_baiviet->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
        $stmt_delete_baiviet->execute();


        $stmt_delete_tacgia = $pdo->prepare("DELETE FROM tacgia WHERE ma_tgia = :ma_tgia");
        $stmt_delete_tacgia->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
        $stmt_delete_tacgia->execute();


        $pdo->commit();


        header("Location: author.php");
        exit();
    } catch (Exception $e) {

        $pdo->rollBack();
        echo "Lỗi khi xóa tác giả: " . $e->getMessage();
    }
}
?>
