<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ma_tloai = $_POST["ma_tloai"];
    $ten_tloai = $_POST["ten_tloai"];


    require_once 'connect.php';
    include("auth.php");

    $stmt_update_category = $pdo->prepare("UPDATE theloai SET ten_tloai = :ten_tloai WHERE ma_tloai = :ma_tloai");
    $stmt_update_category->bindParam(':ten_tloai', $ten_tloai, PDO::PARAM_STR);
    $stmt_update_category->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);

    if ($stmt_update_category->execute()) {

        header("Location: category.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin thể loại.";
    }
}
?>
