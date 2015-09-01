<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
    <button type="button" class="btn btn-sm">
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
<?php
    while($row= $data['infoEdicion']["EdicionEntidad"]->fetch_assoc()){
        echo "<pre>".print_r($row,1)."</pre>";
    }
    while($row= $data['infoEdicion']["EdicionDomicilio"]->fetch_assoc()){
        echo "<pre>".print_r($row,1)."</pre>";
    }
?>
<form action="" method="post" id="_save">
    <input type="text" name="nombre">
    <input type="hidden" name="axn" value="getEntidades">
</form>