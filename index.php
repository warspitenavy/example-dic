<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>dictionary</title>
</head>

<?php
require_once('db.php');
require_once('util.php');
$DB = new DB();
$Util = new Util();
session_start();
?>

<body>
  <div id="wrapper">
    <div id="key">
      <form action="./" method="POST">
        <select name="id" size="10" onchange="submit(this.form)">
          <?php
          foreach ($DB->get_dic() as $v) {
            echo "<option value=\"{$Util->h($v['id'])}\">{$Util->h($v['japanese'])}</option>";
          }
          ?>
        </select>
      </form>
    </div>
    <div id="add">
      <form action="add_word.php" method="POST">
        <label for="japanese">日本語</label>
        <input name="japanese" type="text" require>
        <label for="english">英語</label>
        <input name="english" type="text">
        <label for="deutsch">ドイツ語</label>
        <input name="deutsch" type="text">
        <label for="russian">ロシア語</label>
        <input name="russian" type="text">
        <input type="submit" value="追加">
      </form>
    </div>
    <?php
    $id = (!empty($_POST['id'])) ? $_POST['id'] : $_SESSION['id'];
    unset($_SESSION['id']);
    $word = (!empty($id)) ? $DB->get_word($id) : '';
    ?>
    <div id="wordViewer">
      <form action="edit_word.php" method="POST">
        <div id="words">
          <div class="word" id="english">
            <span class="key">英語</span>
            <input type="text" name="english" class="value" value="<?= $Util->h($word['english']); ?>"></span>
          </div>
          <div class="word" id="deutsch">
            <span class="key">ドイツ語</span>
            <input type="text" name="deutsch" class="value" value="<?= $Util->h($word['deutsch']); ?>"></span>
          </div>
          <div class="word" id="russian">
            <span class="key">ロシア語</span>
            <input type="text" name="russian" class="value" value="<?= $Util->h($word['russian']); ?>"></span>
          </div>
        </div>
        <input type="text" name="japanese" class="value" value="<?= $Util->h($word['japanese']); ?>">
        <input type="text" name="id" hidden value="<?= $word['id']; ?>">
        <input type="submit" value="更新">
      </form>
      <form action="delete_word.php" method="POST">
        <input type="text" name="id" hidden value="<?= $word['id']; ?>">
        <input type="submit" value="削除">
      </form>
    </div>
  </div>
</body>

</html>