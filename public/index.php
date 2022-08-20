<?php

require 'bootstrap.php';

try {
  $data = router();

  extract($data['data']);

  if(!isset($data['view'])) {
    throw new Exception("The view index is missing!");
  }

  if(!file_exists(VIEWS.$data['view'])) {
    throw new Exception("This view {$data['view']} does not exist!");
  }

  $view = $data['view'];

  require VIEWS.'index.php';
} catch (Exception $e) {
  var_dump($e->getMessage());
}
