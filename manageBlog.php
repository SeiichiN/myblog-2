<?php
// manageBlog.php
require_once('mylib.php');

$db = getDB();          // blog.dbに接続
$query = "select * from " . TABLENAME;          // テーブルblogからすべてのデータを読みだすクエリ文
$result = $db->query($query);          // クエリ文を実行。$resultに読み込む。
?>
<?php
require_once('header.php');
?>
<?php
      // $resultを1レコードずつ連想配列に読み込む
      while ($blog = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = $blog['id'];          // idを取り出し、$idに格納
      ?>
        <section class="manageBlog clearfix">
          <div class="id">id:<?php echo $id; ?></div>
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
      ?>
      <?php
      require_once('footer.php');
      ?>

      <?php
$db->close();          // データベースとの接続を解除する。
?>
