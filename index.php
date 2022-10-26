<?php
header('Acess-Control-Allow-Origin:*');
header('Content-Type: application/json');

try{
    $db=openDb();                        
    $sql="select * from item";
    $query = $db->query($sql);                          
    $results = $query->fetchAll(PDO::FETCH_ASSOC);         
    header('HTTP/1.1 200 OK');                         
    print json_encode($results);  

    } catch (PDOException $pdoex) {
    returnError($pdoex);
    }