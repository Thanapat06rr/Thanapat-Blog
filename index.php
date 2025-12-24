    <?php

    require_once './class/router.php';
    $router = new Router();

    $router->add("GET", '/', './views/login.php');
    $router->add("GET", '/blog', './views/blog/index.php');
    $page = $_GET['page'] ?? '/';
    $router->dispatch($page);
    ?>