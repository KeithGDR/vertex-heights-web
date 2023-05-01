<?php
	header("Refresh:60");
	$mysql = new mysqli("localhost", "servers", "D6DEseEJwzlviUQi", "vertex_servers");

	if ($mysql->connect_error)
	{
		mysqli_close($mysql);
		die($mysql->connect_error);
	}
	
	//Table: servers
	$query  = "SELECT a.id as serverid, a.ip as ipaddress, b.name as gamemode_name, c.id as region_id, c.name as region_name, c.dns as region_dns, d.name as hoster_name, d.url as hoster_url, e.game as game FROM servers a INNER JOIN gamemodes b ON a.g_id = b.id INNER JOIN regions c ON a.r_id = c.id INNER JOIN hosters d ON a.h_id = d.id INNER JOIN games e ON a.game = e.id;";
	$result = $mysql->query($query);
	
	$id = array();
	$ip = array();
	$gamemode = array();
	$regionid = array();
	$region = array();
	$region_dns = array();
	$hoster = array();
	$hoster_url = array();
	$game = array();
	
	while ($row = mysqli_fetch_assoc($result))
	{
		array_push($id, $row["serverid"]);
		array_push($ip, $row["ipaddress"]);
		array_push($gamemode, $row["gamemode_name"]);
		array_push($regionid, $row["region_id"]);
		array_push($region, $row["region_name"]);
		array_push($region_dns, $row["region_dns"]);
		array_push($hoster, $row["hoster_name"]);
		array_push($hoster_url, $row["hoster_url"]);
		array_push($game, $row["game"]);
	}

	mysqli_free_result($result);
	
	//Table: regions
	$query  = "SELECT id, name FROM `regions`;";
	$result = $mysql->query($query);
	
	$regions = array();
		
	while ($row = mysqli_fetch_assoc($result))
		$regions[$row["id"]] = $row["name"];

	mysqli_free_result($result);
	
	mysqli_close($mysql);
	
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
	<script>
	$(document).ready(function(){
	    $("select").change(function(){
	        $(this).find("option:selected").each(function(){
	            var optionValue = $(this).attr("value");
	            if(optionValue){
	                $(".box").not("." + optionValue).hide();
	                $("." + optionValue).show();
	            } else{
	                $(".box").hide();
	            }
	        });
	    }).change();
	});
	</script>
</head>
<body>
	<select>
		<?php
		while ($regionname = current($regions)) {
			echo '<option value="' . key($regions) . '">' . $regionname . '</option>';
			next($regions);
		}
		?>
	</select>
	
	<div class="clearfix">
	<div class="box1 container-fluid">
	
	<div class="1 box">
	<div style="color:white"><h2>Region: <?php echo $regions[$region["1"]] ?></h2></div>
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:6%">Server ID</th>
					<th scope="col">IP</th>
					<th scope="col">Gamemode</th>
					<th scope="col">Map</th>
					<th scope="col" style="width:9%">Players</th>
					<th scope="col" style="width:8%">Join</th>
					<th scope="col">Game</th>
					<th scope="col">Host</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($x = 0; $x < count($ip); $x++)
					{
						if ($regionid[$x] != "1")
							continue;
						
						$data = getData($ip[$x]);
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						
						if ($data["Password"] != null)
							echo '<th scope="row"><b>' . $id[$x] . '</b>' . ' 🔒' . '</th>';
						else
							echo '<th scope="row"><b>' . $id[$x] . '</b></th>';
						
						echo '<td>' . $region_dns[$x] . '.vertexheights.com</td>';
						
						if ($gamemode[$x] != null)
							echo '<td>' . $gamemode[$x] . '</td>';
						else
							echo '<td>Casual</td>';
						
						if ($data["Map"] != null)
							echo '<td>' . $data["Map"] . '</td>';
						else
							echo '<td>N/A</td>';

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
						
						if ($data["Password"] == null)
							echo '<td><a href="steam://connect/' . $ip[$x] . '">' . Connect . '</a></td>';
						else
							echo '<td>Connect</td>';
						
						echo '<td>' . $game[$x] . '</td>';
						echo '<td><a href="'. $hoster_url[$x] .'">' . $hoster[$x] . '</a></td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	
	<div class="2 box">
	<div style="color:white"><h2>Region: <?php echo $regions[$region["2"]] ?></h2></div>
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:6%">Server ID</th>
					<th scope="col">IP</th>
					<th scope="col">Gamemode</th>
					<th scope="col">Map</th>
					<th scope="col" style="width:9%">Players</th>
					<th scope="col" style="width:8%">Join</th>
					<th scope="col">Game</th>
					<th scope="col">Host</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($x = 0; $x < count($ip); $x++)
					{
						if ($regionid[$x] != "2")
							continue;
						
						$data = getData($ip[$x]);
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						
						if ($data["Password"] != null)
							echo '<th scope="row"><b>' . $id[$x] . '</b>' . ' 🔒' . '</th>';
						else
							echo '<th scope="row"><b>' . $id[$x] . '</b></th>';
						
						echo '<td>' . $region_dns[$x] . '.vertexheights.com</td>';
						
						if ($gamemode[$x] != null)
							echo '<td>' . $gamemode[$x] . '</td>';
						else
							echo '<td>Casual</td>';
						
						if ($data["Map"] != null)
							echo '<td>' . $data["Map"] . '</td>';
						else
							echo '<td>N/A</td>';

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
						
						if ($data["Password"] == null)
							echo '<td><a href="steam://connect/' . $ip[$x] . '">' . Connect . '</a></td>';
						else
							echo '<td>Connect</td>';
						
						echo '<td>' . $game[$x] . '</td>';
						echo '<td><a href="'. $hoster_url[$x] .'">' . $hoster[$x] . '</a></td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	
	<div class="3 box">
	<div style="color:white"><h2>Region: <?php echo $regions[$region["3"]] ?></h2></div>
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:6%">Server ID</th>
					<th scope="col">IP</th>
					<th scope="col">Gamemode</th>
					<th scope="col">Map</th>
					<th scope="col" style="width:9%">Players</th>
					<th scope="col" style="width:8%">Join</th>
					<th scope="col">Game</th>
					<th scope="col">Host</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($x = 0; $x < count($ip); $x++)
					{
						if ($regionid[$x] != "3")
							continue;
						
						$data = getData($ip[$x]);
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						
						if ($data["Password"] != null)
							echo '<th scope="row"><b>' . $id[$x] . '</b>' . ' 🔒' . '</th>';
						else
							echo '<th scope="row"><b>' . $id[$x] . '</b></th>';
						
						echo '<td>' . $region_dns[$x] . '.vertexheights.com</td>';
						
						if ($gamemode[$x] != null)
							echo '<td>' . $gamemode[$x] . '</td>';
						else
							echo '<td>Casual</td>';
						
						if ($data["Map"] != null)
							echo '<td>' . $data["Map"] . '</td>';
						else
							echo '<td>N/A</td>';

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
						
						if ($data["Password"] == null)
							echo '<td><a href="steam://connect/' . $ip[$x] . '">' . Connect . '</a></td>';
						else
							echo '<td>Connect</td>';
						
						echo '<td>' . $game[$x] . '</td>';
						echo '<td><a href="'. $hoster_url[$x] .'">' . $hoster[$x] . '</a></td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	
	<div class="4 box">
	<div style="color:white"><h2>Region: <?php echo $regions[$region["4"]] ?></h2></div>
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:6%">Server ID</th>
					<th scope="col">IP</th>
					<th scope="col">Gamemode</th>
					<th scope="col">Map</th>
					<th scope="col" style="width:9%">Players</th>
					<th scope="col" style="width:8%">Join</th>
					<th scope="col">Game</th>
					<th scope="col">Host</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($x = 0; $x < count($ip); $x++)
					{
						if ($regionid[$x] != "4")
							continue;
						
						$data = getData($ip[$x]);
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						
						if ($data["Password"] != null)
							echo '<th scope="row"><b>' . $id[$x] . '</b>' . ' 🔒' . '</th>';
						else
							echo '<th scope="row"><b>' . $id[$x] . '</b></th>';
						
						echo '<td>' . $region_dns[$x] . '.vertexheights.com</td>';
						
						if ($gamemode[$x] != null)
							echo '<td>' . $gamemode[$x] . '</td>';
						else
							echo '<td>Casual</td>';
						
						if ($data["Map"] != null)
							echo '<td>' . $data["Map"] . '</td>';
						else
							echo '<td>N/A</td>';

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
						
						if ($data["Password"] == null)
							echo '<td><a href="steam://connect/' . $ip[$x] . '">' . Connect . '</a></td>';
						else
							echo '<td>Connect</td>';
						
						echo '<td>' . $game[$x] . '</td>';
						echo '<td><a href="'. $hoster_url[$x] .'">' . $hoster[$x] . '</a></td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	
	<div class="5 box">
	<div style="color:white"><h2>Region: <?php echo $regions[$region["5"]] ?></h2></div>
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width:6%">Server ID</th>
					<th scope="col">IP</th>
					<th scope="col">Gamemode</th>
					<th scope="col">Map</th>
					<th scope="col" style="width:9%">Players</th>
					<th scope="col" style="width:8%">Join</th>
					<th scope="col">Game</th>
					<th scope="col">Host</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($x = 0; $x < count($ip); $x++)
					{
						if ($regionid[$x] != "5")
							continue;
						
						$data = getData($ip[$x]);
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						
						if ($data["Password"] != null)
							echo '<th scope="row"><b>' . $id[$x] . '</b>' . ' 🔒' . '</th>';
						else
							echo '<th scope="row"><b>' . $id[$x] . '</b></th>';
						
						echo '<td>' . $region_dns[$x] . '.vertexheights.com</td>';
						
						if ($gamemode[$x] != null)
							echo '<td>' . $gamemode[$x] . '</td>';
						else
							echo '<td>Casual</td>';
						
						if ($data["Map"] != null)
							echo '<td>' . $data["Map"] . '</td>';
						else
							echo '<td>N/A</td>';

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
						
						if ($data["Password"] == null)
							echo '<td><a href="steam://connect/' . $ip[$x] . '">' . Connect . '</a></td>';
						else
							echo '<td>Connect</td>';
						
						echo '<td>' . $game[$x] . '</td>';
						echo '<td><a href="'. $hoster_url[$x] .'">' . $hoster[$x] . '</a></td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	
	</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
