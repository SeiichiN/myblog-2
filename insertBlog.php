<?php // insertBlog.php
require_once('mylib.php');

if (!empty($_POST['title'])) { $title = $_POST['title']; }
if (!empty($_POST['body'])) { $body = $_POST['body']; }
if (!empty($_POST['category'])) { $category = $_POST['category']; }
if (!empty($_POST['tag'])) { $tag = $_POST['tag']; }
if (!empty($_POST['date'])) { $date = $_POST['date']; }
