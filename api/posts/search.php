<?php

  include '../../config/Server.php';
  include '../../models/posts/Posts.php';

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  $server = new Server();
  $posts = new Posts(Database::$connection);

  $posts->searchTag = isset($_GET['tag']) ? $_GET['tag'] : die();

  $post = $posts->search();
  $count = $post->rowCount();

  if ($count > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $post->fetch(PDO::FETCH_ASSOC)) {

      $post_token = array(
          'id' => $row['id'],
          'type' => $row['type'],
          'categoryId' => $row['category_id'],
          'title' => $row['title'],
          'author' => $row['author'],
          'date' => $row['date'],
          'tags' => $row['tags'],
          'commentCount' => $row['comment_count'],
          'status' => $row['status'],
          'content' => $row['content'],
          'image' => $row['image'],
      );

      array_push($post_arr['data'], $post_token);
    }

    $server->end();

    echo json_encode($post_arr['data']);

  } else {
    $server->end();

    json_encode(
        array('message' => 'Error: something went wrong!')
    );
  }

  $server->end();