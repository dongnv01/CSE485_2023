<?php

include 'connect.php';
include("auth.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tieude = $_POST["tieude"];
    $ten_bhat = $_POST["ten_bhat"];
    $ma_tloai = $_POST["ma_tloai"];
    $tomtat = $_POST["tomtat"];
    $noidung = $_POST["noidung"];
    $ma_tgia = $_POST["ma_tgia"];
    $ngayviet = $_POST["ngayviet"];


    $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet) VALUES (?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet]);
        header("Location: article.php");
    } catch (\PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


//$pdo = null;
?>
