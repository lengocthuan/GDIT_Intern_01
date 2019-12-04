<?php
	require_once 'config.php';
	require_once dirname(__DIR__) . "/model/model.php";

	$page_number = '';
	$output = '';
	$model = new Model($db);

	if (isset($_POST["page"])) {
	 //    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	 //    if (!is_numeric($page_number)) {
	 //    	die('Invalid page number!');
		// } //incase of invalid page number
		$page_number = (int)$_POST['page'];
	} else {
	    $page_number = 1;
	}
	//get current starting point of records
	$position = (($page_number - 1) * $no_of_records_per_page);

	//$position get current starting point of records
	$stmt = $model->index('posts', '', ["ORDER BY `updated_at` DESC LIMIT $position, $no_of_records_per_page"]);
	// var_dump($stmt);
	$row = $stmt->fetchAll();


	$total_records = 0;
	$count_total = $model->index('posts', '', '');

	$records = $count_total->fetchAll();
	// var_dump($row); die();
	if ($records > 0) {
	    $total_records = count($records);
	}
	// 1 2 3 4 5 (total = 20 , per_page = 4 records)
	$pages = ceil($total_records / $no_of_records_per_page);
	require_once dirname(__DIR__) . '/view/Post/showTable.php';
	// if ()
	// $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>"
	// $show_paginate = ceil($pages / $no_of_records_per_page);
	// $step_show_paginate = $show_paginate - $no_of_records_per_page;
	// if ($step_show_paginate > 0) {
	// 	for ($i=1; $i < $show_paginate; $i++) { 
	// 		if ($i == $show_paginate) {

	// 		}
	// 	}
	// }
	for($i=1; $i<=$pages; $i++) {
		if($i == 1) {
			$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".'First' ."</span>";
			$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='". '<' ."'>".'Previous'."</span>";
		}

	    $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";

	    if ($i == $pages) {
	    	$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='". '>' ."'>".'Next'."</span>";
	    	$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".'Last' ."</span>";
	    }

	}
	$output .= '</div><br /><br />';
	echo $output;
?>
