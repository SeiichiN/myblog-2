<?php

define (DBNAME, 'blog.db');
define (TABLENAME, 'blog');

function h ($str) {
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

/**
 * 関数名 -- getDB
 * はたらき -- データベースへの接続をこの関数に一本化する。
 *           そのことにより、ほかのデータベースに変更したり、
 *           データベースへの接続を変更したりすることに対応する。
 * 戻り値 -- $db（データベース・オブジェクト）
 */
function getDB() {
	$db = new SQLite3(DBNAME);
	return $db;
}



/*
 * 関数名   -- getResult
 * はたらき -- idにより1件分のデータを検索し、そのデータを返す。
 * 引数     -- $id （GETにより受け取る）
 * 戻り値   -- $result （ id, title, body, date, category, tag のデータが入っている。)
 */

/* function getResult ($id) {
 *     $id = (int)$_GET['id'];
 *  	$db = new SQLite3(DBNAME);
 *  	$query = "select * from " . TABLENAME . " where id = :id";
 *  	$stmt = $db->prepare($query);
 *  	$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
 *  	$result = $stmt->execute();
 *  	$db->close();
 *     return $result;
 * }*/

