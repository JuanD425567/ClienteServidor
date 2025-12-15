<?php
/**
 * Vista: Editar Tipo de Membresía
 */
require_once __DIR__ . '/../layouts/header.php';
?>

<h2>Editar Membresía</h2>

<form method="POST" action="index.php?controller=membershiptype&action=update" class="form">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($membershipType['id']); ?>">
    
    <div class="form-group">
        <label for="name">Nombre *</label>
        <input type="text" id="name" name="name" required 
               value="<?php echo htmlspecialchars($membershipType['name']); ?>">
    </div>
    
    <div class="form-group">
        <label for="price">Precio ($) *</label>
        <input type="number" id="price" name="price" step="0.01" required 
               value="<?php echo htmlspecialchars($membershipType['price']); ?>">
    </div>

    <div class="form-group">
        <label for="duration_days">Duración (Días) *</label>
        <input type="number" id="duration_days" name="duration_days" required 
               value="<?php echo htmlspecialchars($membershipType['duration_days']); ?>">
    </div>
    
    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea id="description" name="description" rows="3"><?php echo htmlspecialchars($membershipType['description'] ?? ''); ?></textarea>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controller=membershiptype&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Guardar</button>
        
        <a href="index.php?controller=membershiptype&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>