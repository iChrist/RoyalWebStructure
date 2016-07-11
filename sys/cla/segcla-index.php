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
                            <th width="10%">
                                Acciones
                            </th>
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
                                Fracciones
                            </th>
                            <th width="25%">
                                Ejecutivo
                            </th>
                            <th width="25%">
                                Clasificador
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                                    <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                                    <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                                </div>
                            </td>
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
                                <!--<input type="text" class="form-control form-filter input-sm" name="skUsersCreacion" placeholder="Ejecutivo">!-->
                                <select name="skUsersCreacion" class="form-control form-filter input-sm">
                                    <option value="">- Ejecutivo -</option>
                                <?php
                                    if($data['users']){
                                        while($row = $data['users']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skUsers']; ?>">
                                                <?php echo utf8_encode($row['sName'].' '.$row['sLastNamePaternal'].' '.$row['sLastNameMaternal']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                    $data['users']->data_seek(0);
                                ?>
                                </select>
                            </td>
                            <td>
                                <!--<input type="text" class="form-control form-filter input-sm" name="skUsersModificacion" placeholder="Clasificador">!-->
                                <select name="skUsersModificacion" class="form-control form-filter input-sm">
                                    <option value="">- Clasificador -</option>
                                <?php
                                    if($data['users']){
                                        while($row = $data['users']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skUsers']; ?>">
                                                <?php echo utf8_encode($row['sName'].' '.$row['sLastNamePaternal'].' '.$row['sLastNameMaternal']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                    $data['users']->data_seek(0);
                                ?>
                                </select>
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

$(document).ready(function(){
   TableAjax.init('?axn=fetch_all');
});
</script>