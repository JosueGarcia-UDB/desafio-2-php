<?php
class Empleado
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Obtener todos los empleados
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM empleados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar empleados por nombre
    public function search($termino)
    {
        $stmt = $this->db->prepare("SELECT * FROM empleados WHERE nombre LIKE ?");
        $stmt->execute(['%' . $termino . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar empleado por ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM empleados WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar o actualizar empleado
    public function save($data, $id = null)
    {
        // If editing, get current employee data
        $currentEmpleado = null;
        if ($id) {
            $currentEmpleado = $this->getById($id);
        }

        // Process photo only if a file was uploaded
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE) {
            $foto = $this->handlePhotoUpload($_FILES['foto']);
        } else if ($id && $currentEmpleado) {
            // Keep existing photo if editing and no new photo
            $foto = $currentEmpleado['foto'];
        } else {
            // No photo for new records without upload
            $foto = null;
        }

        if ($id) {
            $sql = "UPDATE empleados SET 
                    nombre = ?, 
                    salario = ?, 
                    horas_extras = ?, 
                    prestamo = ?, 
                    foto = ?
                    WHERE id = ?";
            $params = [
                $data['nombre'],
                $data['salario'],
                $data['horas_extras'],
                $data['prestamo'],
                $foto,
                $id
            ];
        } else {
            $sql = "INSERT INTO empleados 
                    (nombre, salario, horas_extras, prestamo, foto) 
                    VALUES (?, ?, ?, ?, ?)";
            $params = [
                $data['nombre'],
                $data['salario'],
                $data['horas_extras'],
                $data['prestamo'],
                $foto
            ];
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Eliminar empleado
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM empleados WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Cálculos de boleta
    public function calcularBoleta($empleado)
    {
        $salario = (float)$empleado['salario'];
        $horas_extras = (int)$empleado['horas_extras'];
        $prestamo = (float)$empleado['prestamo'];

        $monto_horas = $horas_extras * 10;
        $base = $salario + $monto_horas;

        $afp = $base * 0.0725;
        $isss = min($base * 0.03, 30);
        $renta = ($base > 500) ? $base * 0.1 : 0;

        $total_descuentos = $afp + $isss + $renta + $prestamo;
        $sueldo_liquido = $base - $total_descuentos;

        return [
            'salario' => $salario,
            'horas_extras' => $monto_horas,
            'afp' => round($afp, 2),
            'isss' => round($isss, 2),
            'renta' => round($renta, 2),
            'prestamo' => $prestamo,
            'total_descuentos' => round($total_descuentos, 2),
            'sueldo_liquido' => round($sueldo_liquido, 2)
        ];
    }

    // Manejo de fotos
    private function handlePhotoUpload($file)
    {
        // Si no hay archivo o hubo error, retornar null
        if (!isset($file) || $file['error'] == UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Configuración de rutas - Fix path
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Desafio_02/public/fotos/empleados/';

        // Crear directorio si no existe
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                return null;
            }
        }

        // Validar y mover el archivo
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        // Verificar que es una imagen válida
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($ext), $allowed)) {
            return null;
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $filename;
        } else {
            return null;
        }
    }
}
