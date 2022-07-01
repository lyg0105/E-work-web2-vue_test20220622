<?php
namespace App\Lib\Common\Excel\Func;

class WebExcel
{
	//엑셀용 ABC 배열얻기
	public static function get_ABC_array($max_num){
		$ABC_array=array();
		$added_cnt=0;
		for($j=64;$j<=90;$j++){
			$pre_fix="";
			if($j!=64){
				$pre_fix=chr($j);
			}
			for($i=65;$i<=90;$i++){
				$ABC_array[]=$pre_fix.chr($i);
				$added_cnt++;
				if($added_cnt>=$max_num){
					return $ABC_array;
				}
			}
		}
		return $ABC_array;
	}
	//엑셀 date 폼데이터 변환  PHPExcel 필요
	public static function get_cell_date_of_excel($cell){
		include_once ABS.ROOT_DIR.'lib/php/PHPExcel-1.8/Classes/PHPExcel.php';

		$cel_foramt=$cell->getValue();
		if(strstr($cel_foramt,'0000-00-00')!==false){
			$cel_foramt='';
			return $cel_foramt;
		}
		$cel_foramt=str_replace(array(".","/"),"-",$cel_foramt);
		$cel_foramt=str_replace(array(" ",chr(10),"\\","\n","\r"),"",$cel_foramt);
		$cel_foramt=trim($cel_foramt);

		if(strlen($cel_foramt)==8){
			if(strstr($cel_foramt,"-")!==false){
				$pre_str=substr($cel_foramt,0,2);
				$now_y=substr(date("Y"),2,2);
				if($pre_str<=$now_y){
					$cel_foramt="20".$cel_foramt;
				}else{
					$cel_foramt="19".$cel_foramt;
				}
			}
		}
		$tmp_cel_format=$cel_foramt;
		if(strlen($cel_foramt)==6){
			if(strstr($cel_foramt,"-")===false){
				$pre_str=substr($cel_foramt,0,2);
				$now_y=substr(date("Y"),2,2);
				if($pre_str<=$now_y){
					$tmp_cel_format="20".$cel_foramt;
				}else{
					$tmp_cel_format="19".$cel_foramt;
				}
			}
		}

		if(!strtotime($tmp_cel_format)){

			$cellValue = $cell->getValue();
			$dateValue = \PHPExcel_Shared_Date::ExcelToPHP($cellValue);
			if($cellValue>10){
				$tmp_cel_format = date('Y-m-d',$dateValue);
				if(\PHPExcel_Shared_Date::isDateTime($cell)){

				}
			}
		}

		$cel_foramt=substr($tmp_cel_format,0,10);
		return $cel_foramt;
	}
	public static function checkSheetTitle($text){
		$filter_str_arr=['\\','/','?','*','[',']',':','\''];
		$text=str_replace($filter_str_arr,'_',$text);
		return $text;
	}
}
?>
