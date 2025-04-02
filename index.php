<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de nómina de empleado</title>
</head>

<body id="body-all">


    <?php include './partials/header.php'; ?>

    <main>
        <?php
        require_once 'config/Database.php';
        require_once 'models/Empleado.php';
        require_once 'controllers/EmpleadoController.php';

        $action = $_GET['action'] ?? 'index';
        $id = $_GET['id'] ?? null;

        $controller = new EmpleadoController();

        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'search':
                $controller->search();
                break;
            case 'show':
                $controller->show($id);
                break;
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit($id);
                break;
            case 'store':
                $controller->store();
                break;
            case 'destroy':
                $controller->destroy($id);
                break;
            default:
                header("HTTP/1.0 404 Not Found");
                echo "Página no encontrada";
                break;
        }
        ?>
    </main>
    <?php include './partials/footer.php'; ?>
</body>

</html>