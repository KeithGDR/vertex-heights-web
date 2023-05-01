<?php
	
	$mysql = new mysqli("localhost", "servers", "D6DEseEJwzlviUQi", "vertex_servers");

	if ($mysql->connect_error)
	{
		mysqli_close($mysql);
		die($mysql->connect_error);
	}
	
	$query  = "SELECT names.name, levels.level FROM `player_levels` as levels RIGHT JOIN `player_names` AS names ON names.vid = levels.vid ORDER BY levels.level DESC LIMIT 50;";
	$result = $mysql->query($query);
	
	$names = array();
	$levels = array();
	$count = 0;
		
	while ($row = mysqli_fetch_assoc($result))
	{
		array_push($names, $row["name"]);
		array_push($levels, $row["level"]);
	}

	mysqli_free_result($result);
	mysqli_close($mysql);

	function r($var)
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Vertex Heights</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>
<body>
	<div class="clearfix">
	<div class="box1 container-fluid">
	
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:6%">#</th>
					<th scope="col">Name</th>
					<th scope="col">Level</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$a = 1;
					for($x = 0; $x < count($levels); $x++)
					{
						echo '<tr>';
						echo '<th scope="row"><b>' . $a . '</b></th>';
						echo '<td><b>' . $names[$x] . '</b></td>';
						echo '<td><b>' . $levels[$x] . '</b></td>';
						echo '</tr>';
						$a++;
					}
				?>
			</tbody>
		</table>
	
	</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
