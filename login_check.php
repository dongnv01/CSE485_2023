<?php require "connect.php"; ?>
<?php
    function checklg($username,$password){
        global $pdo;
        $sql = "select * from Users where TK = :u and Pw = :p";
        $stm = $pdo->prepare($sql);
        $stm->execute([":u"=>$username,":p"=>$password]);
        if($stm->rowCount()!==0){
            header("Location: admin\index.php");
            exit();
        }else{
            echo "Tên đăng nhập hoặc mật khẩu sai";
        }

    }
     if ($_SERVER["REQUEST_METHOD"] === "POST"&&isset($_POST["lg"])) {
        if(isset($_POST["us"])&&isset($_POST["pw"])) {
             $us = $_POST['us'];
             $pw = $_POST["pw"];
             checklg($us,$pw);
             }
    }
?>