<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $ma_bviet = $_GET["id"];


    require_once 'connect.php'; 
    include("auth.php");


    $pdo->beginTransaction();

    try {

        $stmt_delete_baiviet = $pdo->prepare("DELETE FROM baiviet WHERE ma_bviet = :ma_bviet");
        $stmt_delete_baiviet->bindParam(':ma_bviet', $ma_bviet, PDO::PARAM_INT);
        $stmt_delete_baiviet->execute();



        $pdo->commit();


        header("Location: article.php");
        exit();
    } catch (Exception $e) {

        $pdo->rollBack();
        echo "Lỗi khi xóa tác giả: " . $e->getMessage();
    }
}
?>
