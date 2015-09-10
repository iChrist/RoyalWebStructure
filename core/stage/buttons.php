<div class="col-md-6 col-sm-12">
    <div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
        <button type="button" class="btn btn-sm actions-buttons">
            <b>Acciones</b>
        </button>
        <?php
            for($i=1;$i<=count($_buttons);$i++){
                if(array_key_exists($_buttons[$i]['skPermissions'] , $_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['session']['skProfile']])){
                    echo html_entity_decode($_buttons[$i]['sHtml'],ENT_QUOTES); 
                }
            }
        ?>
    </div>
</div>
<div class="clearfix"></div>