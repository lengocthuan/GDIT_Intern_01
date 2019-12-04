<table class="container table table-border table-hover">
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
</table>