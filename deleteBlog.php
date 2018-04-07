<?php // deleteBlog.php
require_once('mylib.php');

if (!empty($_POST['id'])) {
    $id = (int)$_POST['id'];
    $db = getDB();
    $query = "delete from " . TABLENAME . " where id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $db->close();
    $msg = "削除しました。";
}
else {
    $msg = "削除できませんでした。";
}

header("Location: manageBlog.php?msg=$msg");
exit();
