<?php

function controller($matchedUri, $params)
{
  [$controller, $method] = explode('@', array_values($matchedUri)[0]);
  $controllerWithNamespace = CONTROLLER_PATH . $controller;

  if (!class_exists($controllerWithNamespace)) {
    throw new Exception("Controller {$controller} does not exist!");
  }

  $controllerInstance = new $controllerWithNamespace;

  if (!method_exists($controllerInstance, $method)) {
    throw new Exception("This method  {$method} does not exist in {$controller}");
  }

  $controllerInstance->$method($params);
}
