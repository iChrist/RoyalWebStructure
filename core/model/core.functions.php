<?php
Class Core_Functions {
    
    // PUBLIC VARIABLES //
                
    // PROTECTED VARIABLES //

    // PRIVATE VARIABLES //
    
    /*public function __construct(){
        
    }*/
    
    /*public function __destruct(){
        
    }*/
    
    /**
    * PDF
    *
    * @param	string		$content - pdf content
    * @param	string		$title - pdf title 
    * @param	string		$orientation - landscape or portrait orientation
    * @param	string		$format - format A4, A5, ...
    * @param	string		$language - language: fr, en, it, es... 
    * @param	boolean		$unicode - TRUE means clustering the input text IS unicode (default = true)
    * @param 	String		$encoding - charset encoding; Default is UTF-8
    * @param	array		$margins - margins by default, in order (left, top, right, bottom)
    * @return	null
    */
    public function pdf($content, $title, $orientation = 'P', $format = 'A4', $language = 'es', $unicode = true, $encoding = 'UTF-8', $margins = array()){
        require_once(CORE_PATH.'assets/pdf/html2pdf.class.php');
        try{
            $html2pdf = new HTML2PDF($orientation, $format, $language, $unicode, $encoding, $margins);
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output($title.'.pdf');
        }catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
    
    /**
    * PDF
    *
    * @param	obj		$total - database query object
    * @return	array
    */
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