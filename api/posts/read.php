<?php

include '../../config/Server.php';
include '../../models/posts/Posts.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

new Server();
$posts = new Posts(Database::$connection);

$post = $posts->read();
$count = $post->rowCount();

if ($count > 0) {
  $post_arr = array();
  $post_arr['data'] = array();
  
  while ($row = $post->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $post_token = array(
     'id' => $id,
    'categoryId' => $category_id,
     'title' => $title,
     'author' => $author,
     'date' => $date,
     'tags' => $tags,
     'commentCount' => $comment_count,
     'status' => $status,
     'content' => $content,
     'image' => $image,
    );

    array_push($post_arr['data'], $post_token);
  }

  Server::end();

  echo json_encode($post_arr['data']);

} else {
    Server::end();

    json_encode(
      array('message' => 'Error: something went wrong!')
    );
}

Server::end();

?>