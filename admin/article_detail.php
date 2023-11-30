<?php
require_once 'connect.php';
include("auth.php");

$ma_bviet = $_GET["id"];


$stmt_get_article = $pdo->prepare("SELECT * FROM baiviet WHERE ma_bviet = :ma_bviet");
$stmt_get_article->bindParam(':ma_bviet', $ma_bviet, PDO::PARAM_INT);
$stmt_get_article->execute();
$article = $stmt_get_article->fetch(PDO::FETCH_ASSOC);


$ma_tloai = $article['ma_tloai'];
$ma_tgia = $article['ma_tgia'];


$stmt_get_category_name = $pdo->prepare("SELECT ten_tloai FROM theloai WHERE ma_tloai = :ma_tloai");
$stmt_get_category_name->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
$stmt_get_category_name->execute();
$category_name = $stmt_get_category_name->fetchColumn();


$stmt_get_author_name = $pdo->prepare("SELECT ten_tgia FROM tacgia WHERE ma_tgia = :ma_tgia");
$stmt_get_author_name->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
$stmt_get_author_name->execute();
$author_name = $stmt_get_author_name->fetchColumn();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="article.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">Tác Giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center text-uppercase fw-bold mb-4">Thông tin bài viết</h3>

                    <form action="process_edit_article.php" method="post" enctype="multipart/form-data">

                        <?php
                        function renderFormGroup($label, $name, $value, $readonly = true)
                        {
                            echo '
                            <div class="mb-3">
                                <label class="form-label">' . $label . '</label>
                                <input type="text" class="form-control" name="' . $name . '" readonly value="' . $value . '">
                            </div>';
                        }

                        function renderTextareaGroup($label, $name, $value, $readonly = true)
                        {
                            echo '
                            <div class="mb-3">
                                <label class="form-label">' . $label . '</label>
                                <textarea class="form-control" name="' . $name . '" readonly style="word-wrap: break-word;">' . $value . '</textarea>
                            </div>';
                        }

                        renderFormGroup('Mã Bài Viết', 'ma_bviet', $article['ma_bviet']);
                        renderFormGroup('Tiêu Đề', 'tieude', $article['tieude']);
                        renderFormGroup('Tên Bài Hát', 'ten_bhat', $article['ten_bhat']);
                        renderFormGroup('Thể Loại', 'ten_tloai', htmlspecialchars($category_name));
                        renderTextareaGroup('Tóm Tắt', 'tomtat', $article['tomtat']);
                        renderTextareaGroup('Nội Dung', 'noidung', $article['noidung']);
                        renderFormGroup('Tác Giả', 'ten_tgia', htmlspecialchars($author_name));
                        renderFormGroup('Ngày Viết', 'ngayviet', $article['ngayviet']);
                        renderFormGroup('Hình Ảnh', 'hinhanh', $article['hinhanh']);
                        ?>

                        <div class="text-end">
                            <a href="article.php" class="btn btn-warning">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2"
        style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>