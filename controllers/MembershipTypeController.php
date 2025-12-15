<?php
/**
 * Controlador de Tipos de Membresía
 * Ubicación: controllers/MembershipTypeController.php
 */

require_once __DIR__ . '/../models/MembershipType.php';

class MembershipTypeController {
    private $model;
    
    public function __construct() {
        $this->model = new MembershipType();
    }
    
    public function index() {
        $membershipTypes = $this->model->getAll();
        require_once __DIR__ . '/../views/membership_types/index.php';
    }
    
    public function create() {
        $errors = [];
        require_once __DIR__ . '/../views/membership_types/create.php';
    }
   public function store() {
        // 1. Validar los datos recibidos del formulario
        $errors = $this->validate($_POST);
        
        if (empty($errors)) {
            try {
                // 2. Intentar crear el registro en la base de datos
                $this->model->create($_POST);
                
                // 3. Redireccionar al índice (SIN barra inicial para XAMPP)
                header('Location: index.php?controller=membershiptype&action=index&success=created');
                exit;
                
            } catch (PDOException $e) {
                // Manejo de errores de base de datos (ej. nombre duplicado)
                if (strpos($e->getMessage(), 'unique constraint') !== false) {
                    $errors['name'] = 'Ya existe una membresía con este nombre';
                } else {
                    $errors['general'] = 'Error al guardar en la base de datos: ' . $e->getMessage();
                }
            }
        }
        
        // 4. Si hay errores, volver a mostrar el formulario con los errores
        require_once __DIR__ . '/../views/membership_types/create.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=membershiptype&action=index&error=not_found');
            exit;
        }
        
        $membershipType = $this->model->getById($id);
        if (!$membershipType) {
            header('Location: index.php?controller=membershiptype&action=index&error=not_found');
            exit;
        }
        
        $errors = [];
        require_once __DIR__ . '/../views/membership_types/edit.php';
    }
    
public function update() {
        // 1. Verificar que tenemos un ID
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            header('Location: index.php?controller=membershiptype&action=index&error=not_found');
            exit;
        }
        
        // 2. Validar los datos nuevos
        $errors = $this->validate($_POST);
        
        if (empty($errors)) {
            try {
                // 3. Actualizar en base de datos
                $this->model->update($id, $_POST);
                
                // 4. Redireccionar al índice (SIN barra inicial)
                header('Location: index.php?controller=membershiptype&action=index&success=updated');
                exit;
                
            } catch (PDOException $e) {
                if (strpos($e->getMessage(), 'unique constraint') !== false) {
                    $errors['name'] = 'Ya existe una membresía con este nombre';
                } else {
                    $errors['general'] = 'Error al actualizar: ' . $e->getMessage();
                }
            }
        }
        
        // 5. Si hay errores, recargar los datos originales y mostrar el formulario de edición
        $membershipType = $this->model->getById($id);
        require_once __DIR__ . '/../views/membership_types/edit.php';
    }
    
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->model->delete($id);
                header('Location: index.php?controller=membershiptype&action=index&success=deleted');
            } catch (Exception $e) {
                // Probablemente restricción de clave foránea en pagos
                header('Location: index.php?controller=membershiptype&action=index&error=delete_failed');
            }
        }
        exit;
    }
    
    
    private function validate($data) {
        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'El nombre es requerido';
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
            $errors['price'] = 'El precio debe ser un número positivo';
        }
        if (empty($data['duration_days']) || !is_numeric($data['duration_days']) || $data['duration_days'] < 1) {
            $errors['duration_days'] = 'La duración debe ser mayor a 0 días';
        }
        return $errors;
    }
}