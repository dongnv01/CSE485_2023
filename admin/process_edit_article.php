<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ma_bviet = $_POST["ma_bviet"];
    $tieude = $_POST["tieude"];
    $ten_bhat = $_POST["ten_bhat"];
    $ma_tloai = $_POST["ma_tloai"];
    $tomtat = $_POST["tomtat"];
    $noidung = $_POST["noidung"];
    $ma_tgia = $_POST["ma_tgia"];
    $ngayviet = $_POST["ngayviet"];

    require_once 'connect.php';
    include("auth.php");

    $stmt_update_article = $pdo->prepare("UPDATE baiviet SET tieude = :tieude, ten_bhat = :ten_bhat, ma_tloai = :ma_tloai, tomtat = :tomtat, noidung = :noidung, ma_tgia = :ma_tgia, ngayviet = :ngayviet WHERE ma_bviet = :ma_bviet");
    $stmt_update_article->bindParam(':tieude', $tieude, PDO::PARAM_STR);
    $stmt_update_article->bindParam(':ten_bhat', $ten_bhat, PDO::PARAM_STR);
    $stmt_update_article->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
    $stmt_update_article->bindParam(':tomtat', $tomtat, PDO::PARAM_STR);
    $stmt_update_article->bindParam(':noidung', $noidung, PDO::PARAM_STR);
    $stmt_update_article->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
    $stmt_update_article->bindParam(':ngayviet', $ngayviet, PDO::PARAM_STR);
    $stmt_update_article->bindParam(':ma_bviet', $ma_bviet, PDO::PARAM_INT);

    if ($stmt_update_article->execute()) {
        header("Location: article.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin thể loại.";
    }
}
?>
