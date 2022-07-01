<?php
namespace App\Lib\Common\Excel\ExcelDown\Addon;

use App\Lib\Common\Excel\Func\WebExcel;
use App\Lib\Common\Excel\ExcelDown\Addon\Write\WriteHeader;
use App\Lib\Common\Excel\ExcelDown\Addon\Write\WriteExplain;
use App\Lib\Common\Excel\ExcelDown\Addon\Write\WriteInfoArr;

class WriteExcel
{
    public static function writeDataToExcel($in_opt_arr=[]){
        $opt_arr=[
            'objPHPExcel'=>null,
            'x_column_list_arr'=>[],//[ 'jasa_title'=>['name'=>'회사상호','type'=>'varchar','length'=>'30','pri'=>'','width'=>'100'], ]
            'x_pri_col_arr'=>[],
            'except_col_arr'=>[],//['key1','key2']
            'select_col_arr'=>[],//'key'=>[ ['value'=>'1','text'=>'Y'],['value'=>'0','text'=>'N'] ]
            'is_date_col_arr'=>[],
            's_start_date'=>'',
            's_end_date'=>'',
            'info_arr'=>[],//[ ['name'=>'','text'=>'1'],['name'=>'','text'=>'2'] ]
            'excel_title'=>'excel_down',
            'sheet_title'=>'',
            'is_explain'=>true,
            'is_header_key'=>true,
            'is_add_pri_val'=>true,
            'sheet_num'=>0,
            'phpExcelSrc'=>''
        ];
        foreach($in_opt_arr as $key=>$val){
            $opt_arr[$key]=$val;
        }
        if(empty($opt_arr['sheet_title'])){
            if(!empty($opt_arr['excel_title'])){
                $opt_arr['sheet_title']=$opt_arr['excel_title'];
            }else{
                $opt_arr['sheet_title']='sheet'.$opt_arr['sheet_num'];
            }
        }
        include_once $opt_arr['phpExcelSrc'];

        $objPHPExcel=$opt_arr['objPHPExcel'];

        if($opt_arr['sheet_num']!=0){
            $objPHPExcel->createSheet();
        }
        $sheet=$objPHPExcel->setActiveSheetIndex($opt_arr['sheet_num']);
        $sheet->setShowGridLines(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arila')->setSize(10);

        $opt_arr['sheet_title']=WebExcel::checkSheetTitle($opt_arr['sheet_title']);
        $sheet->setTitle($opt_arr['sheet_title']);

        //x_column_list_arr 세팅
        $x_column_list_arr=[];
        $max_a_length=0;
        foreach($opt_arr['x_column_list_arr'] as $key=>$val){
            if(in_array($key,$opt_arr['except_col_arr'])){continue;}
            if(isset($val['is_use'])&&empty($val['is_use'])){continue;}
            $x_column_list_arr[$key]=$val;
            $max_a_length++;
        }
        //add pri_col
        if(!empty($opt_arr['is_add_pri_val'])){
            if(!empty($opt_arr['x_pri_col_arr'])){
                $x_column_list_arr['pri_val']=['name'=>'고유번호','type'=>'varchar','length'=>'50','pri'=>'','width'=>'110'];
                $max_a_length++;
            }
        }

        $abc_array=WebExcel::get_ABC_array($max_a_length);
        $max_a=$max_a_length-1;
        //셀크기 조절
        $i=1;
        $a=0;
        foreach ($x_column_list_arr as $key=>$val){
            $sheet->getColumnDimension($abc_array[$a])->setWidth(($val['width']/4));
            $a++;
        }

        //제목입력
        $tmp_title=$opt_arr['excel_title'];
        if(!empty($opt_arr['s_start_date'])){
            $tmp_title.="기간: ".$opt_arr['s_start_date']."~";
        }
        if(!empty($opt_arr['s_end_date'])){
            $tmp_title.=$opt_arr['s_end_date'];
        }
        $sheet->setCellValue($abc_array[0].$i,$tmp_title);
        //$sheet->mergeCells($abc_array[0].$i.":".$abc_array[5].$i);//$abc_array[$max_a]
        $i++;

        //헤더입력
        $start_i=$i;
        $tmp_rs=WriteHeader::action([
            'objPHPExcel'=>$objPHPExcel,
            'sheet'=>$sheet,
            'x_column_list_arr'=>$x_column_list_arr,
            'i'=>$i,
            'max_a'=>$max_a,
            'abc_array'=>$abc_array,
            'is_header_key'=>$opt_arr['is_header_key']
        ]);
        $i=$tmp_rs['data']['i'];

        //제목스타일
        $headline_style=
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' =>'E1FF36')
                ),
                "font" => array("bold" => true,'color' => array('rgb' =>'0100FF'))
            );
        $sheet->getStyle('A'.$start_i.':'.$abc_array[$max_a].($i-1))->applyFromArray($headline_style);
        $sheet->getStyle("A".$start_i.':'.$abc_array[$max_a].($i-1))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //설명입력
        if($opt_arr['is_explain']){
            $start_i=$i;
            $tmp_rs=WriteExplain::action([
                'objPHPExcel'=>$objPHPExcel,
                'sheet'=>$sheet,
                'x_column_list_arr'=>$x_column_list_arr,
                'select_col_arr'=>$opt_arr['select_col_arr'],
                'is_date_col_arr'=>$opt_arr['is_date_col_arr'],
                'i'=>$i,
                'max_a'=>$max_a,
                'abc_array'=>$abc_array
            ]);
            $i=$tmp_rs['data']['i'];

            //설명스타일
            $headline_style=
                array(
                    'fill' => array(
                        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' =>'FFFFE4')
                    ),
                    "font" => array("bold" => true,'color' => array('rgb' =>'000000'))
                );
            $sheet->getStyle('A'.$start_i.':'.$abc_array[$max_a].($i-1))->applyFromArray($headline_style);
            $sheet->getStyle("A".$start_i.':'.$abc_array[$max_a].($i-1))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

        //내용입력
        $tmp_rs=WriteInfoArr::action([
            'objPHPExcel'=>$objPHPExcel,
            'sheet'=>$sheet,
            'x_column_list_arr'=>$x_column_list_arr,
            'x_pri_col_arr'=>$opt_arr['x_pri_col_arr'],
            'info_arr'=>$opt_arr['info_arr'],
            'is_date_col_arr'=>$opt_arr['is_date_col_arr'],
            'i'=>$i,
            'max_a'=>$max_a,
            'abc_array'=>$abc_array
        ]);
        $i=$tmp_rs['data']['i'];

        //인라인 그리기
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $i+=5;
        $sheet->getStyle("A1:".$abc_array[$max_a].$i)->applyFromArray($BStyle);
    }
}
