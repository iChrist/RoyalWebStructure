<div class="col-md-6 col-sm-12">
    <div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
        <button type="button" class="btn btn-sm actions-buttons">
            <b> <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></b>
        </button>
        <?php $f = '';
            if(!empty($_buttons) && count($_buttons) > 0){
                if($_SESSION['session']['sGroup'] == 'A'){
                    for($i=1;$i<=count($_buttons);$i++){
                        echo html_entity_decode($_buttons[$i]['sHtml'],ENT_QUOTES);
                        echo '<script type="text/javascript">'.html_entity_decode($_buttons[$i]['sScript'],ENT_QUOTES).'</script>';
                    }
                }else{
                    if(!empty($_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['session']['skProfile']])){
                        for($i=1;$i<=count($_buttons);$i++){
                            if(array_key_exists($_buttons[$i]['skPermissions'] , $_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['session']['skProfile']])){
                                echo html_entity_decode($_buttons[$i]['sHtml'],ENT_QUOTES);
                                echo '<script type="text/javascript">'.html_entity_decode($_buttons[$i]['sScript'],ENT_QUOTES).'</script>';
                            }
                        }
                    }
                }
            }
        ?>
    </div>
</div>
<div class="clearfix"></div>