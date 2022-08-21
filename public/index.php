<?php

require 'bootstrap.php';

try {
  $data = router();

  if (!isset($data['data'])) {
    throw new Exception("The data index is missing!");
  }

  if (!isset($data['data']['title'])) {
    throw new Exception("The title index is missing!");
  }
  
  if (!isset($data['view'])) {
    throw new Exception("The view index is missing!");
  }
  
  if (!file_exists(VIEWS . $data['view'])) {
    throw new Exception("This view {$data['view']} does not exist!");
  }
  
  extract($data['data']);

  $view = $data['view'];

  require VIEWS . 'index.php';
} catch (Exception $e) {
  var_dump($e->getMessage());
}
