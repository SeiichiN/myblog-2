<?php // showBlog.php ?>
<?php
require_once('mylib.php');

if (!empty($_GET['id'])) {
	$id = (int)$_GET['id'];
	$db = getDB();
	$query = "select * from " . TABLENAME . " where id = :id";
	$stmt = $db->prepare($query);
	$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
	$result = $stmt->execute();
	if ($row = $result->fetchArray()) {
		$id = $row['id'];
		$title = $row['title'];
		$body = $row['body'];
		$date = $row['date'];
		$category = $row['category'];
		$tag = $row['tag'];
	}
	$db->close();
}
// $msg = "更新しました。";

require_once('header.php');
?>

<div class="single-page">
	<div class="editThis">
        <a href="newBlog.php?id=<?php echo $id; ?>">
        	<img src="img/pencil.png" alt="EDIT"></a></div>
    <div class="id">id:<?php echo $id; ?></div>
    <h1 class="title"><?php echo h($title); ?></h1>
    <div class="body"><?php echo h($body); ?></div>
    <div class="date">作成：<?php echo h($date); ?></div>
    <div class="category">カテゴリ：<?php echo h($category); ?></div>
    <div class="tag">タグ：<?php echo h($tag); ?></div>
</div><!-- .single-page -->

<?php require_once('footer.php'); ?>
