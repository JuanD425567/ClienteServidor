<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2>Gestión de Membresías</h2>

<div class="actions">
    <a href="index.php?controller=membershiptype&action=create" class="btn btn-primary">➕ Nuevo Tipo</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Duración</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($membershipTypes)): ?>
            <tr><td colspan="5" class="text-center">No hay tipos registrados</td></tr>
        <?php else: ?>
            <?php foreach ($membershipTypes as $type): ?>
                <tr>
                    <td><?php echo htmlspecialchars($type['name']); ?></td>
                    <td>$<?php echo number_format($type['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($type['duration_days']); ?> días</td>
                    <td><?php echo htmlspecialchars($type['description'] ?? '-'); ?></td>
                    <td class="actions-cell">
                        <a href="index.php?controller=membershiptype&action=edit&id=<?php echo $type['id']; ?>" 
                           class="btn btn-sm btn-secondary">Editar</a>
                        
                        <a href="index.php?controller=membershiptype&action=delete&id=<?php echo $type['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('⚠️ ¡CUIDADO! \n\nSi eliminas esta membresía, podrías afectar el historial de pagos.\n\n¿Estás seguro de continuar?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>