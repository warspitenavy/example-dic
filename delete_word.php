<?php
require_once('./db.php');
$DB = new DB();

$id = $_POST['id'];

if (empty($id)) {
  header('Location: ./');
  exit;
}

$pdo = $DB->get_db();
$stmt = $pdo->prepare('DELETE FROM dic WHERE id = :id');
$stmt->execute(array('id' => $id));

header('Location: ./');
exit;
