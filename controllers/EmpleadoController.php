<?php
class EmpleadoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Empleado();
    }

    // Listar todos
    public function index()
    {
        $empleados = $this->model->getAll();
        include './views/empleados/lista.php';
    }

    // Buscar por nombre
    public function search()
    {
        $termino = $_GET['termino'] ?? '';
        $empleados = $termino ? $this->model->search($termino) : $this->model->getAll();
        include './views/empleados/lista.php';
    }

    // Mostrar boleta
    public function show($id)
    {
        $empleado = $this->model->getById($id);
        $boleta = $this->model->calcularBoleta($empleado);
        include './views/empleados/boleta.php';
    }

    // Formulario creación
    public function create()
    {
        include './views/empleados/formulario.php';
    }

    // Formulario edición
    public function edit($id)
    {
        $empleado = $this->model->getById($id);
        include './views/empleados/formulario.php';
    }

    // Procesar formulario
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->save($_POST, $_POST['id'] ?? null);
            header('Location: index.php');
        }
    }

    // Eliminar
    public function destroy($id)
    {
        $this->model->delete($id);
        header('Location: index.php');
    }
}
