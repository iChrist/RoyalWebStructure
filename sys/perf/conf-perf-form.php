<?php 
echo $data['msg']; 
if($data['datos']){
    $result = $data['datos']->fetch_assoc();
}
?>
<div class="alert alert-danger display-hide" style="display: block;">
    <button data-close="alert" class="close"></button>
    <?php echo $data['msg']; ?>
</div>
<div class="alert alert-success display-hide" style="display: block;">
    <button data-close="alert" class="close"></button>
    <?php echo $data['msg']; ?>
</div>
<form id="_save" method="post" class="form-horizontal form-bordered form-row-stripped" role="form">
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-1 control-label">Nombre</label>
            <div class="col-md-4">
                <input type="text" name="sName" class="form-control" placeholder="Enter text" value="<?php echo (isset($result['sName'])) ? $result['sName'] : '' ; ?>">                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-1 control-label">Estatus</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios22" value="AC" checked> Activo
                    </label>
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios23" value="IN" checked> Inactivo
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>