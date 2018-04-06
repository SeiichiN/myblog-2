<?php // updateBlog.php  ?>
<?php
require_once('mylib.php');

$okcount = 0;
if (!empty($_POST['id'])) { $id = (int)$_POST['id']; $okcount++; }
if (!empty($_POST['title'])) { $title = $_POST['title']; $okcount++; }
if (!empty($_POST['body'])) { $body = $_POST['body']; $okcount++; }
if (!empty($_POST['date'])) { $date = $_POST['date']; $okcount++; }
if (!empty($_POST['category'])) { $category = $_POST['category']; $okcount++; }
if (!empty($_POST['tag'])) {	$tag = $_POST['tag']; $okcount++; }

if ($okcount === 6) {
	$db = getDB();
	$query = "update " . TABLENAME
		. " set title = :title, body = :body, date = :date, category = :category, tag = :tag where id = :id";
	$stmt = $db->prepare($query);
	$stmt->bindValue(':title', $title, SQLITE3_TEXT);
	$stmt->bindValue(':body', $body, SQLITE3_TEXT);
	$stmt->bindValue(':date', $date, SQLITE3_TEXT);
	$stmt->bindValue(':category', $category, SQLITE3_TEXT);
	$stmt->bindValue(':tag', $tag, SQLITE3_TEXT);
	$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
	$stmt->execute();
	$msg = "更新しました。";
	$db->close();
} else {
	$msg = "未入力の項目があったので、更新しませんでした。";
}

header("Location: showBlog.php?id={$id}");

?>
