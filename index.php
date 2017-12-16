
<?php
//getting value from state selection
$data = $_POST['state'];

//getting value from district selection
$data2 = $_POST['district'];

// download database based on user selection
function download($state, $district){
	if (isset($_POST['submit'])){
		// if district selection is empty downlad all data of the selected state
		if ((empty($district)) and (!empty($state))){
			$new_state = 'State -' .$state;
			$sql = "SELECT state, votes, candidate, partyname INTO OUTFILE '$new_state.csv' FROM result WHERE state LIKE %$new_state%";
			echo $sql;
		}

		// else specific download
		elseif ((!empty($state)) && (!empty($district))){
			$new_district = strtolower($district);
			$new_state = 'State -' .$state;
			$sql = "SELECT state, votes, candidate, partyname district INTO OUTFILE '$new_state-$district.csv' FROM result WHERE state LIKE %$new_state% AND district LIKE %$new_district%" ."\r\n";
			echo $sql;			
		}
		// if both district and state are empty
		elseif(empty($state) && empty($district)){
			$sql = "SELECT state, district, votes, partyname, candidate INTO OUTFILE 'full_db.csv' FROM result";
			echo $sql;
			
		}
		// for invalid selection
		else{
			echo "You must specify the state";
		}

	}
}
download($data, $data2);
?>


<form action="" method="post" name="myform" id="myform">
	<select name="state">
		<option value=""></option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
	</select>
	<select name="district">
		<option value=""></option>
		<option value="Achham">Achham</option>
		<option value="Bhaktapur">Bhaktapur</option>
		<option value="Illam">Illam</option>
		<option value="Dadeldhura">Dadeldhura Studio</option>
		<option value="Kathmandu">Kathmandu</option>
	</select>
	<input type="submit" name="submit" value="Download">
</form>

