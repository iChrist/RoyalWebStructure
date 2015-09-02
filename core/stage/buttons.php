<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
    <button type="button" class="btn btn-sm actions-buttons">
        <b>Acciones</b>
    </button>
    <?php
        if(!empty($data['_modules_profiles_permissions'][$_GET['sysController']]['profile2']['A'])){
    ?>
    <button type="button" class="btn btn-sm btn-default" onclick="_read();">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        Consultar
    </button>
    <button type="button" class="btn btn-sm btn-default" onclick="_new();">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        Nuevo
    </button>
    <button type="button" class="btn btn-sm btn-default" onclick="_save();">
        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        Guardar
    </button>
    <button type="button" class="btn btn-sm btn-default" onclick="_delete();">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        Eliminar
    </button>
    <?php
        }
    ?>
</div>
<hr>
<?php echo "<pre>".print_r($_secutiry,1)."</pre>"; ?>