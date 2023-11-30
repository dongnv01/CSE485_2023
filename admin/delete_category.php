<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $ma_tloai = $_GET["id"];


    require_once 'connect.php';
    include("auth.php");


    $pdo->beginTransaction();

    try {

        $stmt_delete_baiviet = $pdo->prepare("DELETE FROM baiviet WHERE ma_tloai = :ma_tloai");
        $stmt_delete_baiviet->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
        $stmt_delete_baiviet->execute();


        $stmt_delete_theloai = $pdo->prepare("DELETE FROM theloai WHERE ma_tloai = :ma_tloai");
        $stmt_delete_theloai->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
        $stmt_delete_theloai->execute();


        $pdo->commit();


        header("Location: category.php");
        exit();
    } catch (Exception $e) {

        $pdo->rollBack();
        echo "Lỗi khi xóa thể loại: " . $e->getMessage();
    }
}
?>
