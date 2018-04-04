<?php
// header.php
?>
<!doctype html
<html lang="ja">
	<head>
        <meta charset="utf-8">
        <title>MyBlog</title>
        <link rel="stylesheet" href="myblog.css">
	    <script src="myfunc.js"></script>
    </head>
    <body>
        <div id="wrap">
            <header>
                <h1><a href="manageBlog.php">MyBlog</a></h1>
                <div class="newBlog"><a href="newBlog.php">[ NEW ]</a></div>
	            <?php // require_once('findBlog.php'); ?>
            </header>
            <article>
