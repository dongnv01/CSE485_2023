<?php
require_once 'connect.php';
// Trong auth.php
function getNumberOfUsers($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM user");
    return $stmt->fetchColumn();
}

function getNumberOfCategories($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM theloai");
    return $stmt->fetchColumn();
}

function getNumberOfAuthors($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM tacgia");
    return $stmt->fetchColumn();
}

function getNumberOfArticles($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM baiviet");
    return $stmt->fetchColumn();
}

?>