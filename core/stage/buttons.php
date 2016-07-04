<!--<form id="_save" method="post" class="form-horizontal" role="form">-->
<div class="col-md-6 col-xs-6">
    <div class="btn-group btn-group-xs" role="group" aria-label="Acciones">
        <?php
            $buttons = $core->printModulesButtons(1,array(
                isset($_GET['p1']) ? $_GET['p1'] : NULL
            ));
            echo $buttons['sHtml'];
        ?>
    </div>
</div>
<div class="clearfix">
    <script type="text/javascript">
    <?php
        echo $buttons['sScript'];
    ?>
    </script>
</div>