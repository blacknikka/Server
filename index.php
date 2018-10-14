<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>sample</title>
<style>
.table1 {
  border: 1px solid gray;
}
.table1 th, .table1 td {
  border: 1px solid gray;
}</style>
</head>
<body>
<div>
<?php

# user name
$username = 'user';
# password
$password = 'password001';

# db
$dsn = 'mysql:host=localhost:8889;dbname=testdb;charset=utf8';

try {
  echo '<pre>';
  echo 'connection'.PHP_EOL;
  $pdo = new PDO($dsn,$username,$password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  var_dump($pdo);

  $sql = 'SELECT * FROM MEMBER';
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);

  echo '<table class = "table1">';
  echo '<thead><tr>';
  echo '<th>', 'ID', '</th>';
  echo '<th>', 'name', '</th>';
  echo '<th>', 'age', '</th>';
  echo '</tr></thead>';
  echo '<tbody>';
  foreach($result as $row)
  {
    // 各行実行
    echo '<tr>';
    echo '<td>', $row['id'], '</td>';
    echo '<td>', $row['name'], '</td>';
    echo '<td>', $row['age'], '</td>';
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';

  $pdo = NULL;


  print('connection end');
  echo '</pre>';
} catch (PDOException $e) {
  print('Error:'.$e->getMessage());

  die();
}

function CheckPostJson($key) {
  if (is_string($key)) {
    return json_decode($_POST[$key]);
  }
  return null;
}

?>
</div>
</body>
<h1>hello</h1>
</html>


