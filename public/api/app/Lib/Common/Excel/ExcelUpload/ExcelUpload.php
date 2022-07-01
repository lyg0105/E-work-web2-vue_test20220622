<?php
namespace App\Lib\Common\Excel\ExcelUpload;

use App\Lib\Common\Excel\Func\WebExcel;

include_once ABS.ROOT_DIR.'lib/php/PHPExcel-1.8/Classes/PHPExcel.php';
include_once ABS.ROOT_DIR.'lib/php/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

class ExcelUpload
{
    public $objPHPExcel=null;
    public $opt=[
        'up_file'=>null,
        'col_key_row_num'=>'2',
        'up_start_row_num'=>'3',
        'except_col_arr'=>[],
        'x_column_arr'=>[],
        'x_column_list_arr'=>[],//[ 'jasa_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'], ]
        'x_pri_col_arr'=>[],
        'except_col_arr'=>[],//['key1','key2']
        'select_col_arr'=>[],//'key'=>[ ['value'=>'1','text'=>'Y'],['value'=>'0','text'=>'N'] ]
        'is_date_col_arr'=>[],//['key1','key2']
        'sheet_num'=>0,
        'phpExcelSrc'=>ABS.ROOT_DIR.'lib/php/PHPExcel-1.8/Classes/PHPExcel.php',
        'phpExcelIOSrc'=>ABS.ROOT_DIR.'lib/php/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php'
    ];
    function __construct($in_opt_arr=[]){
        $this->setExcelOption($in_opt_arr);
    }

    public function setExcelOption($in_opt_arr=[]){
        foreach($in_opt_arr as $key=>$val){
            $this->opt[$key]=$val;
        }
    }

    public function readExcel(){
        $data_col_val_arr_arr=[];

        if(empty($this->opt['up_file'])){
            $result_arr=['result'=>'false','data'=>[],'msg'=>'첨부파일 정보 없음.'];
            return $result_arr;
        }
        if(!file_exists($this->opt['up_file']['tmp_name'])){
            $result_arr=['result'=>'false','data'=>[],'msg'=>'첨부파일 내용 없음.'];
            return $result_arr;
        }
        if(empty($this->opt['col_key_row_num'])){
            $result_arr=['result'=>'false','data'=>[],'msg'=>'키값 줄 없음.'];
            return $result_arr;
        }

        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        try {
            // Create new PHPExcel object
            $this->objPHPExcel = new \PHPExcel();
            // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
            $objReader = \PHPExcel_IOFactory::createReaderForFile($this->opt['up_file']['tmp_name']);
            // 읽기전용으로 설정
            $objReader->setReadDataOnly(true);
            // 엑셀파일을 읽는다
            $objExcel = $objReader->load($this->opt['up_file']['tmp_name']);
            // 첫번째 시트를 선택
            $objExcel->setActiveSheetIndex(0);
            $objWorksheet = $objExcel->getActiveSheet();
            $rowIterator = $objWorksheet->getRowIterator();
            foreach ($rowIterator as $row) { // 모든 행에 대해서
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
            }
            $maxRow = $objWorksheet->getHighestRow();

            $read_abc_arr=WebExcel::get_ABC_array(200);
            $col_key_abc_arr=[];//['key'=>'A','key2'=>'B']
            foreach($read_abc_arr as $a => $abc_str){
                $row_value=$objWorksheet->getCell($abc_str.$this->opt['col_key_row_num'])->getValue();
                if(!empty($row_value)){
                    $col_key_abc_arr[$row_value]=$abc_str;
                }
            }
            $suc_cnt=0;
            $i=1;
            for ($i = 1 ; $i <= $maxRow ; $i++){
                if($i>=$this->opt['up_start_row_num']){
                    $suc_cnt++;
                    $row_col_val_arr=array();
                    foreach($col_key_abc_arr as $key => $abc_str){
                        $row_value=$objWorksheet->getCell($abc_str.$i)->getValue();
                        if(!empty($row_value)&&in_array($key,$this->opt['is_date_col_arr'])){
                            if($row_value>1000){
                                $row_value=WebExcel::get_cell_date_of_excel($objWorksheet->getCell($abc_str.$i));
                            }
                        }
                        if(empty($row_value)){
                            $row_value='';
                        }
                        $row_col_val_arr[$key]=$row_value;
                    }
                    $data_col_val_arr_arr[]=$row_col_val_arr;
                }
            }
        }catch (exception $e){
            $result_arr=array('result'=>'false','data'=>'','msg'=>"엑셀파일을 읽는도중 오류가 발생하였습니다.");
            return $result_arr;
        }

        $result_arr=['result'=>'true','data'=>$data_col_val_arr_arr,'msg'=>'성공.'];
        return $result_arr;
    }
}
