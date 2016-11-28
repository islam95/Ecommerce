<?php
	require_once('../include/autoload.php');
	echo WEBSITE_URL;
	echo "<br>";
	echo "<br>";
	
	echo '<a href="/admin/?page=products">Link</a>';
	
	echo "<br>";
	echo "<br>";
	echo ROOT_PATH;
	
?>
	<form name="addProduct" onsubmit="return checkSize()" action="" method="post">
		<table>
		<tr>
			<th>Size: </th>
			<td>
				<input type="text" name="size" id="" value="" />
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td>
				<label for="btn" class="">
					<input type="submit" id="btn" value="Add" />
				</label>
			</td>
		</tr>
		</table>
	</form>
	
<script>
function checkSize(){
    var value = document.forms["addProduct"]["size"].value;
    if(isNaN(value)){
	    document.forms["addProduct"]["size"].id = "size_letter";
	    document.forms["addProduct"]["size"].name = "size_letter";
	    return false;
	} else {
		document.forms["addProduct"]["size"].id = "size_number";
		document.forms["addProduct"]["size"].name = "size_number";
		return false;
	}
}
</script>