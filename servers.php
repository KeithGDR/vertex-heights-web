<?php

	$ip = array("45.76.170.19:27015");
	array_push($ip, "45.76.170.19:27018");
	array_push($ip, "45.76.170.19:27021");
	array_push($ip, "45.76.170.19:27024");
	array_push($ip, "45.76.170.19:27027");
	array_push($ip, "45.76.170.19:27030");
	array_push($ip, "45.76.170.19:27033");
	array_push($ip, "45.76.170.19:27036");
	array_push($ip, "45.76.170.19:27039");
	array_push($ip, "45.76.170.19:27042");
	array_push($ip, "45.76.170.19:27045");
	array_push($ip, "45.76.170.19:27048");
	array_push($ip, "45.76.170.19:27051");
	array_push($ip, "45.76.170.19:27054");
	array_push($ip, "45.76.170.19:27057");
	array_push($ip, "45.76.170.19:27060");
	array_push($ip, "45.76.170.19:27063");
	array_push($ip, "45.76.170.19:27066");
	array_push($ip, "45.76.170.19:27069");
	array_push($ip, "45.76.170.19:27072");
	array_push($ip, "45.76.170.19:27075");
	array_push($ip, "45.76.170.19:27078");
	array_push($ip, "45.76.170.19:27081");
	
	$gamemodes = array("Battlegrounds");
	array_push($gamemodes, "Boss Fortress");
	array_push($gamemodes, "Casual+");
	array_push($gamemodes, "Cops and Robbers");
	array_push($gamemodes, "Demos Paradise");
	array_push($gamemodes, "Duo Fortress");
	array_push($gamemodes, "Fortressland");
	array_push($gamemodes, "Fortress Night Combat");
	array_push($gamemodes, "Horror Fortress");
	array_push($gamemodes, "Hungry Heavy Delivery");
	array_push($gamemodes, "Infiltrators");
	array_push($gamemodes, "Invisifortress");
	array_push($gamemodes, "Jailbreak");
	array_push($gamemodes, "Man vs Machines");
	array_push($gamemodes, "Skullduggery Medieval");
	array_push($gamemodes, "Memes Fortress");
	array_push($gamemodes, "Minigames");
	array_push($gamemodes, "Random Warfare");
	array_push($gamemodes, "Spyparty");
	array_push($gamemodes, "TF2007");
	array_push($gamemodes, "TFGO");
	array_push($gamemodes, "Trading Central");
	array_push($gamemodes, "Undead Zombies");

	require __DIR__ . '/./SourceQuery/bootstrap.php';
	use xPaw\SourceQuery\SourceQuery;
	
	define('SQ_TIMEOUT', 1);
	define('SQ_ENGINE', SourceQuery::SOURCE);
	
	function getData($ip)
	{
		$pieces = explode(":", $ip);
		$Query = new SourceQuery();
		
		try
		{
			$Query->Connect($pieces[0], $pieces[1], SQ_TIMEOUT, SQ_ENGINE);
			$data = $Query->GetInfo();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		finally
		{
			$Query->Disconnect();
		}
		
		return $data;
	}

	function fill_missing_keys($array, $default = null, $atleast = 0)
	{
		return $array + array_fill(0, max($atleast, max(array_keys($array))), $default);
	}

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
	<div class="box1 container-fluid">
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:2%">ID</th>
					<th scope="col" style="width:4%">Status</th>
					<th scope="col" style="width:9%">IP Address</th>
					<th scope="col" style="width:9%">Gamemode</th>
					<th scope="col" style="width:9%">Location</th>
					<th scope="col" style="width:9%">Map</th>
					<th scope="col" style="width:9%">Players</th>
					<th scope="col" style="width:9%">Game</th>
					<th scope="col" style="width:9%">Join</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$count = 1;
					for ($x = 0; $x < count($ip); $x++)
					{
						$data = getData($ip[$x]);
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						
						echo '<th scope="row"><b>' . $count . '</b></th>';
						$count++;
						
						if ($data != null)
							echo '<td><font color="lightgreen">Online</font></td>';
						else
							echo '<td><font color="red">Offline</font></td>';
					
						echo '<td>' . $ip[$x] . '</td>';
						echo '<td>' . $gamemodes[$x] . '</td>';
						echo '<td>Los Angeles, California</td>';
						
						if ($data["Map"] != null)
							echo '<td>' . $data["Map"] . '</td>';
						else
							echo '<td>Not Available</td>';

						$players = $data["Players"];
						if ($players == null)
							$players = 0;
						
						$maxplayers = $data["MaxPlayers"];
						if ($maxplayers == null)
							$maxplayers = 0;

						$bots = $data["Bots"];
						if ($bots== null)
							$bots= 0;
						
						echo '<td>' . $players . '/' . $maxplayers . ' (' . $bots . ' Bots)' . '</td>';
						echo '<td>Team Fortress 2</td>';
						
						if ($data != null)
							echo '<td><a href="steam://connect/' . $ip[$x] . '">Connect</a></td>';
						else
							echo '<td>Unavailable</td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
