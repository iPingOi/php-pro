<?php

function routes()
{
  return require 'routes.php';
}

function exactMatchUriInArrayRoutes($uri, $routes)
{
  if(array_key_exists($uri, $routes)) {
    return [$uri => $routes[$uri]];
  }

  return [];
}

function regularExpressionMatchArrayRoutes($uri, $routes)
{
  return array_filter(
    $routes,
    function ($value) use ($uri) {
      $regex = str_replace('/', '\/', ltrim($value, '/'));
      return preg_match("/^$regex$/", ltrim($uri, '/'));
    },
    ARRAY_FILTER_USE_KEY
  );
}

function params($uri, $matchedUri)
{
  if(!empty($matchedUri)) {
    $matchToGetParams = array_keys($matchedUri)[0];
    return array_diff(
      $uri,
      explode('/', ltrim($matchToGetParams, '/'))
    );
  }
  return [];
}

function paramsFormat($uri, $params)
{
  $paramsData = [];
  foreach ($params as $index => $param) {
    $paramsData[$uri[$index - 1]] = $param;
  }

  return $paramsData;
}

function router()
{
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

  $routes = routes();

  $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);

  $params = [];
  if(empty($matchedUri)) {
    $matchedUri = regularExpressionMatchArrayRoutes($uri, $routes);
    $uri = explode('/', ltrim($uri, '/'));
    $params = params($uri, $matchedUri);
    $params = paramsFormat($uri, $params);
  }

  if(!empty($matchedUri)) {
    return controller($matchedUri, $params);
  }

  throw new Exception("Something went wrong!");
}
