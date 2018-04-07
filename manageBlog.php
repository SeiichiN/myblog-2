<?php
// manageBlog.php
require_once('mylib.php');

$db = getDB();          // blog.dbに接続
$query = "select * from " . TABLENAME;          // テーブルblogからすべてのデータを読みだすクエリ文
$result = $db->query($query);          // クエリ文を実行。$resultに読み込む。

// findBlogから検索ワードを受け取ったら
if (!empty($_POST['findOf']) && !empty($_POST['word'])) {
	$result = NULL;
	$findOf = $_POST['findOf'];
	$word = '%' . $_POST['word'] . '%';

	$query = "select * from " . TABLENAME . " where $findOf like :word";
	$stmt = $db->prepare($query);
	$stmt->bindValue(':word', $word, SQLITE3_TEXT);
	$result = $stmt->execute();
}

if (!empty($_GET['msg'])) { $msg = $_GET['msg']; }

require_once('header.php');
?>
<?php
      // $resultを1レコードずつ連想配列に読み込む
      while ($blog = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = $blog['id'];          // idを取り出し、$idに格納
      ?>
        <section class="manageBlog clearfix">
          <div class="id">id:<?php echo $id; ?></div>
		  <div class="trash">
              <form action="deleteBlog.php" method="post" onSubmit="return kakunin()">
                  <button type="submit" name="id" value="<?php echo $id; ?>">
                      <img src="img/trash.png" alt="削除"></button>
              </form>
          </div>
          <h1 class="title">
              <a href="showBlog.php?id=<?php echo $id; ?>">
                  <?php echo h($blog['title']); ?></a></h1> <!-- titleを表示 -->
		  <div class="body"><?php echo h($blog['body']); ?></div>
          <div class="date">作成：<time><?php echo h($blog['date']); ?></time></div>
          <div class="category">カテゴリ： <?php echo h($blog['category']); ?></div>
          <div class="tag">タグ：<?php echo h($blog['tag']); ?></div>
        </section>
      <?php
      }
      require_once('footer.php');

$db->close();          // データベースとの接続を解除する。
?>
