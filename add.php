<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'));
$amount = filter_var($input->amount,FILTER_SANITIZE_STRING);
$description = filter_var($input->description,FILTER_UNSAFE_RAW);

try {
  $db=openDb();
  $query = $db->prepare('insert into item(description,amount) values (:description,:amount)');
  $query->bindValue(':description', $description,PDO::PARAM_STR);
  $query->bindValue(':amount', $amount,PDO::PARAM_INT);
  $query->execute();
  header('HTTP/1.1 200 OK');
  $data = array('id' => $db->lastInsertId(),'description' => $description,'amount' => $amount);
  print json_encode($data);

} catch (PDOException $pdoex) {
  returnError($pdoex);
  }