<?php
	
	$mysql = new mysqli("localhost", "web", "t3Mpl7tuKJOEUVVp", "vertex_web");

	if ($mysql->connect_error)
	{
		mysqli_close($mysql);
		die($mysql->connect_error);
	}

	$query  = "SELECT hostname, ip, port, host, display FROM `servers`;";
	$result = $mysql->query($query);
	
	$hosts = array();
	$ips = array();
	$ports = array();
	$serverhosts = array();
	$displays = array();
	$count = 0;
		
	while ($row = mysqli_fetch_assoc($result))
	{
		array_push($hosts, $row["hostname"]);
		array_push($ips, $row["ip"]);
		array_push($ports, $row["port"]);
		array_push($serverhosts, $row["host"]);
		array_push($displays, $row["display"]);
	}

	mysqli_free_result($result);
	mysqli_close($mysql);
	
	require __DIR__ . '/./SourceQuery/bootstrap.php';
	use xPaw\SourceQuery\SourceQuery;
	
	define('SQ_TIMEOUT', 1);
	define('SQ_ENGINE', SourceQuery::SOURCE);
	
	function getData($ip, $port)
	{
		$Query = new SourceQuery();
		
		try
		{
			$Query->Connect($ip, $port, SQ_TIMEOUT, SQ_ENGINE);
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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Vertex Heights</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<center><img src="logo.png" style="width:300px;"></center>
	<div class="clearfix">
	<div class="box1 container-fluid">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" href="forum">Forums</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="index.php">Servers</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="https://steamcommunity.com/groups/vertexheights/discussions/3/1636418037476073044/">Rules</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="https://discord.gg/8c8Qy4e">Discord</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="https://www.paypal.me/drixevel">Donate</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="https://steamcommunity.com/tradeoffer/new/?partner=76528750&token=V9aoqE8A">Trade Link</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="https://steamcommunity.com/groups/vertexheights">Steamgroup</a>
			</li>
		</ul>
		<table class="table table-dark table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" width="4%">#</th>
					<th scope="col">Name</th>
					<th scope="col">IP</th>
					<th scope="col">Map</th>
					<th scope="col"width="9%">Players</th>
					<th scope="col">Game</th>
					<th scope="col" width="8%">Join</th>
					<th scope="col">Host</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$a = 1;
					for($x = 0; $x < count($ips); $x++)
					{
						$data = getData($ips[$x], $ports[$x]);

						if ($displays[$x] == 0)
							continue;
						
						foreach ($data as &$str)
							$str = str_replace('workshop/', '', $str);
						
						echo '<tr>';
						echo '<th scope="row"><b>' . $a . '</b></th>';
						echo '<td>' . $hosts[$x] . '</td>';
						echo '<td>' . $ips[$x] . ':' . $ports[$x] . '</td>';
						
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

						if ($data["ModDesc"] != null)
							echo '<td>' . $data["ModDesc"] . '</td>';
						else
							echo '<td>N/A</td>';

						echo '<td><a href="steam://connect/' . $ips[$x] . ':' . $ports[$x] . '">' . Connect . '</a></td>';
						echo '<td><b>' . $serverhosts[$x] . '</b></td>';
						echo '</tr>';
						$a++;
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="box2">
		<iframe src="https://discordapp.com/widget?id=555541761485832192&theme=dark" width="350" height="545" allowtransparency="true" frameborder="0"></iframe>
	</div>
	</div>
	<footer>
		<p>&copy; Copyright <?php echo date(Y);?>, Vertex Heights | Contact Information: me@drixevel.dev</p>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
