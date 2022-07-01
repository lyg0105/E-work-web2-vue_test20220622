<?php
namespace App\Lib\Common\Excel\ExcelDown;

use App\Lib\Common\Excel\ExcelDown\Addon\WriteExcel;

include_once ABS.'lib/php/PHPExcel-1.8/Classes/PHPExcel.php';

class ExcelDown
{
    public $objPHPExcel=null;
    public $opt=[
        'excel_mark'=>'Litech',
        'x_column_list_arr'=>[],//[ 'jasa_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'], ]
        'x_pri_col_arr'=>[],
        'except_col_arr'=>[],//['key1','key2']
        'select_col_arr'=>[],//'key'=>[ ['value'=>'1','text'=>'Y'],['value'=>'0','text'=>'N'] ]
        'is_date_col_arr'=>[],//['key1','key2']
        's_start_date'=>'',
        's_end_date'=>'',
        'info_arr'=>[],//[ ['name'=>'','text'=>'1'],['name'=>'','text'=>'2'] ]
        'down_file_name'=>'',
        'excel_title'=>'excel_down',
        'sheet_title'=>'',
        'is_explain'=>true,
        'is_header_key'=>true,
        'is_add_pri_val'=>true,
        'sheet_num'=>0,
        'is_auto_write'=>true,
        'phpExcelSrc'=>ABS.'lib/php/PHPExcel-1.8/Classes/PHPExcel.php'
    ];
    function __construct($in_opt_arr=[]){
        $this->setExcelOption($in_opt_arr);
        $this->initExcel();
        if($this->opt['is_auto_write']){
            $this->writeDataToExcel();
        }
    }

    public function setExcelOption($in_opt_arr=[]){
        foreach($in_opt_arr as $key=>$val){
            $this->opt[$key]=$val;
        }
        if(empty($this->opt['down_file_name'])){
            $this->opt['down_file_name']='excel_data_'.date('Ymd H:i:s');
        }
    }

    public function initExcel(){
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        // Create new PHPExcel object
        $this->objPHPExcel = new \PHPExcel();

        // Set document properties
        $this->objPHPExcel->getProperties()->setCreator($this->opt['excel_mark']." Inc")
        ->setLastModifiedBy($this->opt['excel_mark']." Inc")
        ->setTitle($this->opt['excel_mark']." Inc")
        ->setSubject($this->opt['excel_mark']." Inc")
        ->setDescription($this->opt['excel_mark'].".")
        ->setKeywords($this->opt['excel_mark']."")
        ->setCategory($this->opt['excel_mark']."");
    }

    public function writeDataToExcel(){
        $this->opt['objPHPExcel']=$this->objPHPExcel;
        WriteExcel::writeDataToExcel($this->opt);
    }

    public function downExcel(){
        // Redirect output to a client’s web browser (Excel2005)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$this->opt['down_file_name'].'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;
    }
}
