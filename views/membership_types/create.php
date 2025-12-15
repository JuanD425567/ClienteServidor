<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2>Nueva Membresía</h2>

<form method="POST" action="index.php?controller=membershiptype&action=store" class="form">
    <div class="form-group">
        <label for="name">Nombre *</label>
        <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
        <?php if (isset($errors['name'])): ?><span class="error-message"><?php echo $errors['name']; ?></span><?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="price">Precio ($) *</label>
        <input type="number" id="price" name="price" step="0.01" required value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
        <?php if (isset($errors['price'])): ?><span class="error-message"><?php echo $errors['price']; ?></span><?php endif; ?>
    </div>

    <div class="form-group">
        <label for="duration_days">Duración (Días) *</label>
        <input type="number" id="duration_days" name="duration_days" required value="<?php echo htmlspecialchars($_POST['duration_days'] ?? '30'); ?>">
        <?php if (isset($errors['duration_days'])): ?><span class="error-message"><?php echo $errors['duration_days']; ?></span><?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?controller=membershiptype&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>