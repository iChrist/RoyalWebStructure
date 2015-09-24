<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <!--<div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                        <i class="fa fa-shopping-cart"></i>Order Listing
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-480">
                    New Order </span>
                    </a>
                    <div class="btn-group">
                        <a class="btn btn-success dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
                        <span class="hidden-480">Tools </span>
                        <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                            <a href="#">
                            Export to Excel </a>
                            </li>
                            <li>
                            <a href="#">
                            Export to CSV </a>
                            </li>
                            <li>
                            <a href="#">
                            Export to XML </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                            <a href="#">
                            Print Invoices </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">!-->
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span>
                        </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Cancel</option>
                            <option value="Cancel">Hold</option>
                            <option value="Cancel">On Hold</option>
                            <option value="Close">Close</option>
                        </select>
                        <button class="btn btn-sm btn-warning table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                    </div>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="5%">
                                <input type="checkbox" class="group-checkable">
                            </th>
                            <th width="19%">
                                Nombre
                            </th>
                            <th width="19%">
                                Correo electr&oacute;nico
                            </th>
                            <th width="19%">
                                Nombre de usuario
                            </th>
                            <th width="19%">
                                Estatus
                            </th>
                            <th width="19%">
                                Acciones
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sName">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sEmail">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sUserName">
                            </td>
                            <td>
                                <select name="skStatus" class="form-control form-filter input-sm">
                                    <option value="">Select...</option>
                                    <option value="pending">Pending</option>
                                    <option value="closed">Closed</option>
                                    <option value="hold">On Hold</option>
                                    <option value="fraud">Fraud</option>
                                </select>
                            </td>
                            <td>
                                <div class="margin-bottom-5">
                                    <button class="btn btn-sm btn-warning filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
                                </div>
                                <button class="btn btn-sm btn-danger filter-cancel"><i class="fa fa-times"></i> Reset</button>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                </div>
            <!--</div>!-->
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {       
   // init ajax table 
   //TableAjax.init('<?php echo $_SERVER["REQUEST_URI"]; ?>?axn=fetch_all');
   TableAjax.init('?axn=fetch_all');
});
</script>