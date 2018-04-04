<?php // newBlog.php
require_once('mylib.php');

require_once('header.php');
?>
<h1 class="newBlog-h1">新規作成</h1>
<form action="insertBlog.php" method="post">
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

    <input type="submit" value="作成" id="form-submit">
    <a href="manageBlog.php" id="form-cancel">
        <button type="button">取消</button></a>
</form>

<?php require_once('footer.php'); ?>
