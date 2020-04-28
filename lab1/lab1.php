<?php
	include_once 'DBConnector.php';
	include_once 'user.php';
	$con = new DBConnector;

	if (isset ($_POST['btn-save'])) {
		# code...
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city_name = $_POST['city_name'];

		$user = new User ($first_name, $last_name, $City);
		$res = $user->save();

		if($res){
			echo "Save operation was succesfull";
		}else{
			echo "An Error occured";
		}
	}
?>
<html>
	<head>
		<title>Title goes here</title>
	</head>
	<body>
		<from method="post">
			<table align="cemter">
				<tr>
					<td><input type="text" name="first_name"required placeholder="First Name" /></td>
				</tr>
				<tr>
					<td><input type="text" name="last_name"required placeholder="Last Name" /></td>
				</tr>
				<tr>
					<td><input type="text" name="city_name"required placeholder="City" /></td>
				</tr>
				<tr>
					<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
				</tr>
			</table>
		</from>
	</body>
</html>