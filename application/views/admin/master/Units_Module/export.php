<?php
			/*	echo "<pre>";
			print_r($customer_sales_data);
			echo "</pre>";
			exit;*/


	$file_title = "$Module_name List";
//	echo $file_title;exit;



	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle($file_title);



	$title_arr = array('Sl No.' , 'Name' , 'Added On' , 'Added By' , 'Updated On' , 'Updated By',"Status" );

	$last_cell_alpha = 'G';
	 $search_text = "$Module_name : ";
	if(!empty($start_date)){ $search_text.= "From : ".date('d-m-Y' , strtotime($start_date)); }

	if(!empty($end_date)){ $search_text.= " 	 To : ".date('d-m-Y' , strtotime($end_date)); }
$BStyle = array(
  'borders' => array(
    'outline' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
	$cellCountAlpha = "A";
	$cellCount = 1;
	$objPHPExcel->getActiveSheet()->mergeCells("A1:G1");
	$objPHPExcel->getActiveSheet()->SetCellValue("A$cellCount", $search_text);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:E$cellCount")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	 $objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")-> getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	 $objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	 $objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getFill()->getStartColor()->setARGB('FFC0C0C0');

	$cellCount = 2;
	$cellCountAlpha = "A";
	$arr_count=0;

	foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
    }

	foreach($title_arr as $tr)
	{
		$arr_count++;
		$objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $tr);
		if($arr_count < count($title_arr)){$cellCountAlpha++;}
	}

	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:$cellCountAlpha$cellCount")->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:$cellCountAlpha$cellCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:$cellCountAlpha$cellCount")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:$cellCountAlpha$cellCount")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:$cellCountAlpha$cellCount")->getFill()->getStartColor()->setARGB('FFC0C0C0');


	$total = 0;


	$i=$k=$l=0;
	if(!empty($list_data) )
	{
		$total_no_of_particulars=0;
		foreach($list_data as $row)
		{
			$i++; $cellCount++;

			$cellCountAlpha = "A";
			$objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $i); $cellCountAlpha++;

			$value = '-';if(!empty($row->name)){ $value = $row->name; }
			$objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $value);  $cellCountAlpha++;

      $value = '-';if(!empty($row->added_on)){ $value = date("d-m-Y" , strtotime($row->added_on)); }
			$objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $value);  $cellCountAlpha++;
      $value = '-';if(!empty($row->added_by_name)){ $value = $row->added_by_name; }
      $objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $value);  $cellCountAlpha++;

      $value = '-';if(!empty($row->updated_on)){ $value = date("d-m-Y" , strtotime($row->updated_on)); }
			$objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $value);  $cellCountAlpha++;

			$value = '-';if(!empty($row->updated_by_name)){ $value = $row->updated_by_name; }
			$objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $value);  $cellCountAlpha++;

      $value = '-';
         if($row->status ==1){
            $value = "Active";

					}elseif($row->status ==0){
              $value = "Block";


						}else{
							  $value = "-";
						}
      $objPHPExcel->getActiveSheet()->SetCellValue("$cellCountAlpha$cellCount", $value);  $cellCountAlpha++;

			//$cellCount++;
			/*echo "<pre>";
			print_r($row->details);
			echo "</pre>";*/
		}


		$cellCount++;
		$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle("A$cellCount:G$cellCount")->getFill()->getStartColor()->setARGB('FFC0C0C0');
	}else{
		$cellCount++;
		$objPHPExcel->getActiveSheet()->SetCellValue("A$cellCount", 'Content Not Found');
	}

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
  $filename = str_replace(' ', '-', $file_title)."(".date('Y-m-d').").xls";

  header("Content-Type: application/vnd.ms-excel; name='excel'");
  header("Content-Disposition: attachment;filename=$filename");
  header('Cache-Control: max-age=0');
  header('Cache-Control: max-age=1');
  header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
  header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
  header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
  header ('Pragma: public'); // HTTP/1.0
  error_reporting("E_ALL");

	$objWriter->save('php://output');
	exit;

//$filename = "Request-For-Quotation-List-" . date('d-m-Y') . ".xls"; header("Content-Disposition: attachment; filename=\"$filename\"");
//header("Content-Type: application/vnd.ms-excel");
//print_r($customers_list);

?>
