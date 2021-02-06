<?php
const DB_FILE = './database.db';
class DB
{
  function __construct()
  {
    if (file_exists(DB_FILE)) {
      return;
    }
    $pdo = new PDO('sqlite:' . DB_FILE);
    $pdo->exec('CREATE TABLE dic (
      id integer primary key autoincrement,
      japanese text not null,
      english text default null,
      deutsch text default null,
      russian text default null
      )');
  }
  function get_db(): PDO
  {
    return new PDO('sqlite:' . DB_FILE);
  }
  function get_dic(): array
  {
    $pdo = $this->get_db();
    $stmt = $pdo->prepare('SELECT * FROM dic;');
    $stmt->execute();
    $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $stmt;
  }
  function get_word(string $id): array
  {
    $pdo= $this->get_db();
    $stmt = $pdo->prepare('SELECT * FROM dic WHERE id = :id');
    $stmt->execute(array('id' => $id));
    $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt;
  }
};
