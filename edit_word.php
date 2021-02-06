<?php
require_once('./db.php');
$DB = new DB();

require_once('util.php');
$Util = new Util();

$id = $_POST['id'];
$japanese = $_POST['japanese'];
$english = $_POST['english'] ?? null;
$deutsch = $_POST['deutsch'] ?? null;
$russian = $_POST['russian'] ?? null;

if (empty($id) || empty($japanese)) {
  header('Location: ./');
  exit;
}

$pdo = $DB->get_db();
$stmt = $pdo->prepare('UPDATE dic SET japanese = :japanese, english = :english, deutsch = :deutsch, russian = :russian WHERE id = :id;');
$stmt->execute(array('japanese' => $japanese, 'english' => $english, 'deutsch' => $deutsch, 'russian' => $russian, 'id' => $id));

session_start();
$_SESSION['id'] = $id;

header('Location: ./');
exit;
