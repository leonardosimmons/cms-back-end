<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

include '../../config/Server.php';
include '../../models/categories/Categories.php';

new Server();
$categories = new Categories(Database::$connection);

$category = $categories->read();
$count = $category->rowCount();

if (count > 0)
{
  $c_arr = array();
  $c_arr['data'] = array();

  while ($row = $category->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $c_token = array(
      'id' => $id,
      'title' => $title
    );

    array_push($c_arr['data'], $c_token);
  }

  Server::end();

  echo json_encode($c_arr['data']);

} else {
    Server::end();

    echo json_encode (
      array('message' => 'Error unable to retrieve \'categories\'.')
    );
}

?>