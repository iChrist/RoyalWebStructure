<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
    <button type="button" class="btn btn-sm actions-buttons">
        <b>Acciones</b>
    </button>
<?php
    for($i=1;$i<=count($_buttons);$i++){
        if(array_key_exists($_buttons[$i]['skPermissions'] , $_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['skProfile']])){
            echo html_entity_decode($_buttons[$i]['sHtml'],ENT_QUOTES); 
        }
    }
?>
</div>
<hr>
<?php
//echo "<pre>".print_r($_secutiry,1)."</pre>";    
echo "<pre>".print_r($_buttons,1)."</pre>";
?>