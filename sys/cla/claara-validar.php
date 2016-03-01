<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <form id="_formTableAjax" method="POST" action="?axn=fetch_all">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span></span>
                        <div class="table-group-actions pull-right"><span></span>
                            <div class="btn-group btn-group-md" role="group" aria-label="Acciones">
                            <?php
                                $buttons = $this->printModulesButtons(3);
                                echo $buttons['sHtml'];
                            ?>
                            </div>
                        </div>
                    </div>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="25%">
                                Referencia
                            </th>
                            <th width="25%">
                                Pedimento
                            </th>
                            <th width="25%">
                                Cliente
                            </th>
                            <th width="5%">
                                Total Fracciones
                            </th>
                            <th width="25%">
                                Autor
                            </th>
                            <th width="25%">
                                Estatus
                            </th>
                            <th width="25%">
                                Acciones
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sPedimento" placeholder="Pedimento">
                            </td>
                            <td>
                                <select name="skEmpresa" class="form-control form-filter input-sm">
                                    <option value="">- Cliente -</option>
                                <?php
                                    if($data['empresas']){
                                        while($row = $data['empresas']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skEmpresa']; ?>">
                                                <?php echo utf8_encode($row['sNombre']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="skCreador" placeholder="Autor">
                            </td>
                            <td>
                                <select name="skStatus" class="form-control form-filter input-sm">
                                    <option value="">- Estatus -</option>
                                <?php
                                    if($data['status']){
                                        while($row = $data['status']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skStatus']; ?>">
                                                <?php echo $row['sName']; ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                                    <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                                    <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                                </div>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                </div>
            </form> <!-- FORMULARIO PARA BOTONES DE LA TABLA iPosition 3!-->
            <!--</div>!-->
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
    // DELETE DATA //
    var validarUrl = null;
    var valido
    function validarClasificacion(obj,url){
        validarUrl = url;
        var tr = $(obj).parent().parent().parent().parent().clone();
        //console.log(tr);
        $(tr[0]).children().last().remove();
        var thead = $("#datatable_ajax").children().children().clone();
        $(thead[0]).children().last().remove();
        $("._default-modal-title").html('Primera Clasifiaci&oacute;n');
        $("._default-modal-content").html('<center><h3>&iquest;Desea validar o rechazar el siguiente registro?</h3></center>');
        $("._default-modal-record").html('<table class="table"><thead><tr role="row" class="heading">'+thead[0].innerHTML+'</tr></thead><tr>'+tr[0].innerHTML+'</tr></table>');
        $("._default-modal-cancel").html('Rechazar');
        $("._default-modal-ok").html('Validar');
        $("._default-modal").modal('toggle');
        return false;
    }
    function sayHello(){
        alert("1");
    } 
$(document).ready(function(){
   TableAjax.init('?axn=fetch_all');
   $("._default-modal-ok").click(function(){
       $("._default-modal").modal('hide');
        $('.page-title-loading').css('display','inline');
        $.ajax({
            type: "GET",
            url: validarUrl,
            data: "",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if(data['response']){
                    toastr.success(data['message'], "Notificaci&oacute;n");
                    setInterval(function(){ 
                         location.reload(); 
                    }, 3000);
                }else{
                    toastr.error(data['message'], "Notificaci&oacute;n");
                    setInterval(function(){ 
                    }, 3000);
                }
                $('.page-title-loading').css('display','none');
                validarUrl = null;
            }
        });
   });
});
</script>