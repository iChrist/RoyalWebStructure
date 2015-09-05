<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
    <button type="button" class="btn btn-sm actions-buttons">
        <b>Acciones</b>
    </button>
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
</div>
<hr>
<?php echo "<pre>".print_r($_secutiry,1)."</pre>"; ?>
<?php
    $_SESSION['skProfile'] = 'profile2';
    foreach($_secutiry['_users_profiles'][$_GET['sysController']] AS $key => $value){
        if(array_key_exists("A",$_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$key])){
            echo "A<br>";
            break;
        }
        if(array_key_exists("D",$_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$key])){
            echo "D<br>";
        }
        if(array_key_exists("R",$_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$key])){
            echo "R<br>";
        }
        if(array_key_exists("W",$_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$key])){
            echo "W<br>";
        }
    }
?>
<?php
    echo "<hr><pre>".print_r($_buttons,1)."</pre>";
?>