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
  <a class="navbar-brand" href="#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <li class="nav-link">
            <a href="<?php echo base_url('index.php'); ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-link">
            <a href="<?php echo base_url('index.php/login/logout'); ?>" class="nav-link">Выйти</a>
        </li>
    </ul>
  </div>
</nav>

<main role="main" class="container">
    <h1>Manage menu</h1>

    <?php function show_menu($menu) { ?>
        <ul class="menu-list">
            <?php foreach ($menu as $menu_item) : ?>
                <li class="menu-list-item">
                    <div class="menu-item" data-id="<?php echo $menu_item['id']; ?>">
                        <span class="menu-label"><?php echo $menu_item['label']; ?></span>
                        <a class="menu-link" href="<?php echo $menu_item['link']; ?>"><?php echo $menu_item['link']; ?></a>
                        <a href="<?php echo base_url('index.php/admin/change_menu_item/' . $menu_item['id']); ?>" class="menu-edit">i</a>
                        <a href="#" class="menu-up">^</a>
                        <a href="#" class="menu-down">v</a>
                        <a href="<?php echo base_url('index.php/admin/add_menu_item/' . $menu_item['id']); ?>" class="menu-add">+</a>
                        <a href="<?php echo base_url('index.php/admin/delete_menu_item/' . $menu_item['id']); ?>" class="menu-delete">x</a>
                    </div>
                </li>
                <?php
                if ( ! empty( $menu_item['childrens'] ) ) { 
                    show_menu( $menu_item['childrens'] );
                }
                ?>
            <?php endforeach; ?>
        </ul>
    <?php } ?>

    <?php show_menu($menu); ?>

    <?php echo form_open('admin', array('class' => 'hidden menuDataForm')); ?>
        <input type="hidden" class="menuData" name="menu" value="<?php echo html_escape(json_encode($menu)); ?>">
    </form>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?php echo base_url() . 'static/js/admin.js'; ?>"></script>

</body>
</html>
