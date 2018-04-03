<?php
// findBlog.php

?>
<div class="findBlog">
	<form action="manageBlog.php" method="post" class="clearfix">
	    <div class="findword">
	        <select name="findOf" id="findOf">
                <option value="title">タイトル</option>
                <option value="body">本文</option>
                <option value="category">カテゴリ</option>
                <option value="tag">タグ</option>
            </select>
        </div>
        <div class="findword">
            <input type="text" name="word">
        </div>
        <div class="findword">
            <input type="submit" value="検索">
        </div>
    </form>
</div>
