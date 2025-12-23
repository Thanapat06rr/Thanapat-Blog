    <?php

    require_once './class/router.php';
    $router = new Router();

    $router->add("GET", '/', './views/login.php');
    $page = $_GET['page'] ?? '/';
    $router->dispatch($page);
    ?>