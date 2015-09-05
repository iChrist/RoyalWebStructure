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
    $_SESSION['skProfile'] = 'profile2';
    if($_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['skProfile']]){
        foreach($_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['skProfile']] AS $key => $value){
            for($i=1;$i<=count($_buttons);$i++){
                if($_buttons[$i]['skPermissions'] == $key){
                    echo $_buttons[$i]['sHtml'];
                }
            }
        }
    }
?>
</div>
<hr>
<?php
    echo "<pre>".print_r($_buttons,1)."</pre>";
?>