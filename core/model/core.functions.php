<?php
Class Core_Functions {
    public static function table_ajax($total){
        if(!$total){
            $records['data'] = array(); 
            $records['draw'] = 0;
            $records['recordsTotal'] = 0;
            $records['recordsFiltered'] = 0;
            return $records;
        }
        $total = $total->fetch_assoc();
        $iTotalRecords = $total['total'];
        // "LIMIT" TOTAL DE REGISTROS PARA MOSTRAR //
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = ($iDisplayLength < 0) ? $iTotalRecords : $iDisplayLength; 
        // "OFFSET" //
        $iDisplayStart = intval($_REQUEST['start']);
        // PAGINA //
        $sEcho = intval($_REQUEST['draw']);
        
        $records['data'] = array();
        $records['draw'] = $sEcho;
        $records['recordsTotal'] = $iTotalRecords;
        $records['recordsFiltered'] = $iTotalRecords;
        $records['limit'] = $iDisplayLength;
        $records['offset'] = $iDisplayStart;
        return $records;
    }
}
?>