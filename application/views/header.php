<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url() . 'static/css/main.css'; ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand main-nav-txt" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto main-nav-txt">
      <?php foreach ($menu as $menu_item): ?>
        <?php if (empty($menu_item['childrens'])): ?>
          <?php $active_class = current_url() === base_url($menu_item['link']) ? 'active' : ''; ?>
          <li class="nav-item <?php echo $active_class; ?>">
            <a class="nav-link" href="<?php echo $menu_item['link']; ?>"><?php echo $menu_item['label']; ?></a>
          </li>
        <?php else: ?>
          <li class="nav-item dropdown">
            <?php $id = 'dropdown' . $menu_item['id']; ?>
            <a class="nav-link dropdown-toggle" href="<?php echo $menu_item['link']; ?>" id="<?php echo $id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $menu_item['label']; ?></a>
            <div class="dropdown-menu" aria-labelledby="<?php echo $id; ?>">
              <?php foreach ($menu_item['childrens'] as $child): ?>
                <a class="dropdown-item" href="<?php echo $child['link']; ?>"><?php echo $child['label']; ?></a>
              <?php endforeach; ?>
            </div>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>

<main role="main" class="container">
