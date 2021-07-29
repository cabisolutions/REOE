<div style="width: 15rem;">    
    <div class="nav flex-column nav-pills me-3 h-100 p-1 pt-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <h2 class="h5 text-center pb-3">Administración</h2>
        <a href="<?=BASEPATH.'resumen'?>" class="nav-link shadow-sm p-3 <?php if($opcion == 'resumen') echo 'active'?>" type="button">
            <i class="bi bi-house-door"></i> Resumen
        </a>
        <a href="<?=BASEPATH.'rentas'?>" class="nav-link shadow-sm p-3 <?php if($opcion == 'rentas') echo 'active'?>" type="button">
            <i class="bi bi-cash-coin"></i> Rentas
        </a>
        <a href="<?=BASEPATH.'espacios'?>" class="nav-link shadow-sm p-3 <?php if($opcion == 'espacios') echo 'active'?>" type="button">
            <i class="bi bi-building"></i> Espacios
        </a>
        <a href="<?=BASEPATH.'tipo_espacios'?>" class="nav-link shadow-sm p-3 <?php if($opcion == 'tipo_espacios') echo 'active'?>" type="button">
            <i class="bi bi-people"></i> Tipos de espacios
        </a>
        <a href="<?=BASEPATH.'servicios'?>" class="nav-link shadow-sm p-3 <?php if($opcion == 'servicios') echo 'active'?>" type="button">
            <i class="bi bi-people"></i> Servicios
        </a>
        <a href="<?=BASEPATH.'usuarios'?>" class="nav-link shadow-sm p-3 <?php if($opcion == 'usuarios') echo 'active'?>" type="button">
            <i class="bi bi-people"></i> Usuarios
        </a>
    </div>
</div>