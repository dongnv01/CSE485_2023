<?php
$host = '127.0.0.1';
$db = 'BTTH01_CSE485_EX';
$user = 'root';
$pass = '1234';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false,
];
try {
 $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo $e->getMessage();
}
if(!empty($_POST["name"]) && !empty($_POST["comment"])){

    $sql = "INSERT into comment (parent_id, comment, sender) VALUES(:parent_id,:comment,:sender)";
    $parent_id = $_POST["commentId"];
    $comment = $_POST["comment"];
    $sender = $_POST["name"];
    $stm = $pdo->prepare($sql);
    $stm->execute([":parent_id"=>$parent_id,":comment"=>$comment,":sender"=>$sender]);
	$message = '<label class="text-success">Comment posted Successfully.</label>';
	$status = array(
		'error'  => 0,
		'message' => $message
	);	
} else {
	$message = '<label class="text-danger">Error: Comment not posted.</label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);	
}
?>
<script>
    $(document).ready(function(){ 
        function showComments() {
	$.ajax({
		url:"show_comments.php", 
        method:"POST",
		success:function(response) {
			$('#showComments').html(response);
		}
	})
}
});
</script>