<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ma_tgia = $_POST["ma_tgia"];
    $ten_tgia = $_POST["ten_tgia"];


    require_once 'connect.php';
    include("auth.php");

    $stmt_update_author = $pdo->prepare("UPDATE tacgia SET ten_tgia = :ten_tgia WHERE ma_tgia = :ma_tgia");
    $stmt_update_author->bindParam(':ten_tgia', $ten_tgia, PDO::PARAM_STR);
    $stmt_update_author->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);

    if ($stmt_update_author->execute()) {

        header("Location: author.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin thể loại.";
    }
}
?>
