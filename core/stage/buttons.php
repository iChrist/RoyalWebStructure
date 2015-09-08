<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
    <button type="button" class="btn btn-sm actions-buttons">
        <b>Acciones</b>
    </button>
    <!--<button type="button" class="btn btn-sm btn-default" onclick="_read();">
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
    </button>!-->
<?php
    for($i=1;$i<=count($_buttons);$i++){
        if(array_key_exists($_buttons[$i]['skPermissions'] , $_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['skProfile']])){
            echo $_buttons[$i]['sHtml']; 
        }
    }
?>
</div>
<hr>
<?php
echo "<pre>".print_r($_secutiry,1)."</pre>";    
echo "<pre>".print_r($_buttons,1)."</pre>";
?>