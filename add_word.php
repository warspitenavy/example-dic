<?php
require_once('./db.php');
$DB = new DB();

$japanese = $_POST['japanese'];
$english = $_POST['english'] ?? '';
$deutsch = $_POST['deutsch'] ?? '';
$russian = $_POST['russian'] ?? '';

if (empty($japanese)) {
  header('Location: ./');
  exit;
}

$pdo = $DB->get_db();
$stmt = $pdo->prepare('INSERT INTO dic (japanese, english, deutsch, russian) VALUES (:japanese, :english, :deutsch, :russian);');
$stmt->execute(array('japanese' => $japanese, 'english' => $english, 'deutsch' => $deutsch, 'russian' => $russian));

header('Location: ./');
exit;
