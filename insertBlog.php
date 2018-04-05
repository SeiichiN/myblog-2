<?php // insertBlog.php
require_once('mylib.php');

$okcount = 0;
if (!empty($_POST['title'])) { $title = $_POST['title']; $okcount++; }
if (!empty($_POST['body'])) { $body = $_POST['body']; $okcount++; }
if (!empty($_POST['category'])) { $category = $_POST['category']; $okcount++; }
if (!empty($_POST['tag'])) { $tag = $_POST['tag']; $okcount++; }
if (!empty($_POST['date'])) { $date = $_POST['date']; $okcount++; }

// okcountが5ということは、すべての変数がセットできたということ。
if ($okcount === 5) {
	// データベースに接続
	$db = getDB();
	// prepareという方法でデータをセット。セイキュリティと正確さのため。推奨
	$query = "insert into " . TABLENAME . " (title, body, date, category, tag) values (?, ?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bindValue(1, $title, SQLITE3_TEXT);
	$stmt->bindValue(2, $body, SQLITE3_TEXT);
	$stmt->bindValue(3, $date, SQLITE3_TEXT);
	$stmt->bindValue(4, $category, SQLITE3_TEXT);
	$stmt->bindValue(5, $tag, SQLITE3_TEXT);
	$stmt->execute();
	$msg = "登録しました。";
//	$query = "select id from " . TABLENAME . " where id = (select max(id) from " . TABLENAME . ")";
	// $query = "select max(id) from " . TABLENAME ;
	$query = "select id from " . TABLENAME . " where rowid = last_insert_rowid()";
    $result = $db->query($query);
	if ($row = $result->fetchArray()) {
		$id = $row['id'];
	}
	$db->close();
} else {
	$msg = "未入力の項目があったので、データベースには登録しませんでした。";
}
header("Location: showBlog.php?id={$id}");


?>
