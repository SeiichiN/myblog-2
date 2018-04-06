<?php // newBlog.php
require_once('mylib.php');

if (!empty($_GET['id'])) {
	$mode = 'edit';
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
else {
	$mode = 'new';
}

if ($mode === 'new') {
	$wordTitle = '新規作成';
	$wordAction = 'insertBlog.php';
	$wordSubmit = '作成';
}
elseif ($mode === 'edit') {
	$wordTitle = '編集';
	$wordAction = 'updateBlog.php';
	$wordSubmit = '更新';
}

require_once('header.php');
?>
<h1 class="newBlog-h1"><?php echo $wordTitle; ?></h1>
<form action="<?php echo $wordAction; ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	
    <label for="form-title">タイトル:</label><br>
    <input type="text" name="title" id="form-title" require value="<?php echo h($title); ?>"><br>

    <label for="form-body">内容:</label><br>
    <textarea name="body" id="form-body" require><?php echo h($body); ?></textarea><br>

    <label for="formcategory">カテゴリ:</label><br>
    <input type="text" name="category" id="form-category" required value="<?php echo h($category); ?>"><br>

    <label for="form-tag">タグ:</label><br>
    <input type="text" name="tag" id="form-tag" required value="<?php echo h($tag); ?>"><br>

    作成:<input type="text" name="date" id="form-date"
                value="<?php echo date("Y-m-d H:i"); ?>"><br>

    <input type="submit" value="<?php echo $wordSubmit; ?>" id="form-submit">
    <a href="manageBlog.php" id="form-cancel">
        <button type="button">取消</button></a>
</form>

<?php require_once('footer.php'); ?>
