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
    * table_ajax
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
    
    /**
    * thumbnailImage
    *
    * @param	string		$imagePath - path to image
    * @param	integer		$width - width 
    * @param	integer		$height - height
    * @return	string          thumbnail image
    */
    function thumbnailImage($imagePath,$width,$height) {
        if( !$imagePath ){
            return  false;
        }
        $imagick = new \Imagick($imagePath);
        $imagick->setbackgroundcolor('rgb(64, 64, 64)');
        $imagick->thumbnailImage($width, $height, true, false);
        header("Content-Type: image/jpg");
        echo $imagick->getImageBlob();
    }
    
    /**
    * exportExcel
    *
    * @param	array		$data - array data
    * @return	file            xlsx file
    */
    function exportExcel(&$data,$fileName){
        if(count($data)>0){
            require_once(CORE_PATH."assets/PHPExcel/Classes/PHPExcel/IOFactory.php");
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load(CORE_PATH."assets/templates/tplExcel.xlsx");
            $row=1;
            foreach($data AS $k=>$v){
                $column=0;
                if($row==1){
                    $titles = array_keys($v);
                    foreach($titles AS $key=>$val){
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $val);
                        $column++;
                    }
                    $column=0;
                    $row++;
                }
                foreach($v AS $key=>$val){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $val);
                    $column++;
                }
                $row++;
            }//ENDFOREACH
            
            // Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            //$objWriter->save(SYS_PATH.'cla/files/claara/Reporte.xlsx');
            $objWriter->save('php://output');
            exit;
        }else{
            header('Location: '.$_SERVER['HTTP_REFERER']); 
            return false; 
        }
    }
    
    /**
    * table_ajax
    *
    * @param	obj		$total - database query object
    * @return	array
    */
    function printDropzoneImages($datos = array()){
        $html = "";
        if($datos){
            foreach($datos AS $k=>&$v){
                $html .= '
                <div class="dz-preview dz-image-preview">
                    <div class="dz-details">
                        <div class="dz-filename"><span data-dz-name>'.$v['fileName'].'</span></div>
                        <div class="dz-size" data-dz-size>'.$v['size'].'</div>
                        <img data-dz-thumbnail="" src="'.$v['src'].'" />
                        <input type="hidden" name="'.$v['param'].'" value="'.$v['id'].'">
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-success-mark"><span>✔</span></div>
                    <div class="dz-error-mark"><span>✘</span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <button class="btn btn-sm btn-danger btn-block deleteDropzoneImage"><i class="fa fa-trash-o"></i> Descartar</button>
                </div>';
            }
        }
        echo $html;
    }
}
?>