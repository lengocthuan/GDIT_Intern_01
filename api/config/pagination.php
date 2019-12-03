<?php
	// require_once 'config.php'; //include config file
	require_once 'database.php';
	// require_once dirname(__DIR__,2) . "/common/header.php";
	require_once dirname(__DIR__) . "/model/model.php";
	// echo dirname(__DIR__) . "/model/model.php"; die();
	//sanitize post value
	if (isset($_POST["page"])) {
	    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	    if (!is_numeric($page_number)) {die('Invalid page number!');} //incase of invalid page number
	    // $page_number = $_POST['page'];
	} else {
	    $page_number = 1;
	}
	//get current starting point of records
	$position = (($page_number - 1) * $no_of_records_per_page);
	$model = new Model($db);
	$total_records = 0;
	$count_total = $model->index('posts', '', '');
	$records = $count_total->fetchAll();
	// var_dump($row); die();
	if ($records > 0) {
	    $total_records = count($records);
	}
	// 1 2 3 4 5 (total = 20 , per_page = 4 records)
	$pages = ceil($total_records / $no_of_records_per_page);
	// var_dump($position);
	//$position get current starting point of records
	$stmt = $model->index('posts', '', ["ORDER BY `updated_at` DESC LIMIT $position, $no_of_records_per_page"]);
	var_dump($stmt);
	$row = $stmt->fetchAll();
?>
<!-- <table class="container table table-border table-hover">
	<thead>
		<tr>
			<th class ="border-top" style = "vertical-align: middle;" rowspan="2">No.<i class="fas fa-sort-up"></i><i class="fas fa-sort-down"></i></th>
			<th class ="border-top" style = "vertical-align: middle;" rowspan="2">Post title</th>
			<th class="border-top center" colspan="5">
				Information
			</th>
		</tr>
		<tr>
			<td class="width10">Edited</td>
			<td class="width10">Status</td>
			<td >Created at</td>
			<td >Publicized at</td>
			<td class="width15"><label><input type="checkbox" class="checkbox" id="checkAll">Check All</label></td>
		</tr>
	</thead>
	<tbody class="tbody">
		<?php
			// var_dump($row);
			if (!empty($row)) {
				foreach ($row as $value) {
			        ?>
					<tr>
						<td><?php echo $value['id']; ?></td>
						<td class ="alignment-left">
							<?php
			if ($value['status'] == 3 || $value['status'] == 2) {
			            ?>
							<a href="<?php echo PATH_GLOBAL_FTP . $value['path_in_global']; ?>"><?php echo htmlspecialchars($value['title']); ?></a>
							<?php
			} else {
			            echo htmlspecialchars($value['title']);
			        }
        ?>
			</td>
			<td>
				<a href="editpost.php?idpost=<?php echo $value['id']; ?>">
					<i class="fas fa-edit"></i>
				</a>
			</td>
			<td class ="alignment-left">
				<?php
				switch ($value['status']) {
				    case 1:
				        echo C; //The post has been created.
				        break;
				    case 2:
				        echo U; //The post has been edited after uploaded;
				        break;
				    case 3:
				        echo P; //The post has been uploaded to the latest version.
				        break;
				    default:
				        # code...
				        break;
				}
        ?>
			</td>
			<td>
				<?php
					if (is_null($value['created_at'])) {
						echo 'updating...';
					} else {
						echo date_format(date_create($value['created_at']), 'd-m-Y H:m:s');
					}
				?>
			</td>
			<td>
				<?php
					if ($value['status'] == 3) {
						echo date_format(date_create($value['publicized_at']), 'd-m-Y H:m:s');
					} else {
						echo 'updating...';
					}
				?>
			</td>
			<td>
				<input class ="checkbox" type="checkbox" name="post[]" value="<?php echo $value['id']; ?>"/>&nbsp;
			</td>
		</tr>
			<?php
				}
			} else {
			?>
		<tr>
			<td colspan="7" style='color:grey;'><i>Data is empty. Please create a new post if you want.</i></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table> -->