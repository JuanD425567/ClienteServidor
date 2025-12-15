<?php
/**
 * Modelo de Tipo de Membresía
 * Ubicación: models/MembershipType.php
 */

require_once __DIR__ . '/../config/database.php';

class MembershipType {
    private $db;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    
    // Obtener todos los tipos
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM membership_types ORDER BY price ASC");
        return $stmt->fetchAll();
    }
    
    // Obtener por ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM membership_types WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    // Crear nuevo tipo
    public function create($data) {
        $sql = "INSERT INTO membership_types (name, price, duration_days, description) 
                VALUES (:name, :price, :duration_days, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration_days' => $data['duration_days'],
            'description' => $data['description'] ?? null
        ]);
        return $this->db->lastInsertId();
    }
    
    // Actualizar existente
    public function update($id, $data) {
        $sql = "UPDATE membership_types 
                SET name = :name, price = :price, duration_days = :duration_days, description = :description
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'price' => $data['price'],
            'duration_days' => $data['duration_days'],
            'description' => $data['description'] ?? null
        ]);
    }
    
    // Eliminar
    public function delete($id) {
        // Nota: Esto podría fallar si hay pagos asociados (Integridad referencial)
        $stmt = $this->db->prepare("DELETE FROM membership_types WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}