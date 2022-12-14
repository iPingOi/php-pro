<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./assets/css/styles.css" />
</head>

<body>
  <div id="header">
    <?php require 'partials/header.php'; ?>
  </div>
  <div class="container">
    <?php require VIEWS . $view; ?>
  </div>
</body>

</html>