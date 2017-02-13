<?php

//gabber.php for getting the statistics

//first we want to define the server

$server = $_GET['server_id'];

if ($server == 1){
//Zues
$query = "SELECT player, zeus_stats_player.name, SUM(KILLS) AS TOTALKILLS, SUM(DEATHS) AS TOTALDEATHS,SUM(KILLS)/IF(SUM(DEATHS) > 0,SUM(DEATHS),1)  AS KDR
FROM (
SELECT player, 0 AS KILLS, sum(count) AS DEATHS FROM zeus_stats_player_death WHERE Cause <> 'SUICIDE' GROUP BY player
UNION ALL
SELECT killer as player, COUNT(1) AS KILLS, 0 AS DEATHS FROM zeus_stats_player_kill group by killer) AS TBL INNER JOIN zeus_stats_player ON zeus_stats_player.id = TBL.player
GROUP BY zeus_stats_player.name
ORDER BY TOTALKILLS DESC";
} else if ($server == 2){
//Ares
$query = "SELECT player, ares_stats_player.name, SUM(KILLS) AS TOTALKILLS, SUM(DEATHS) AS TOTALDEATHS,SUM(KILLS)/IF(SUM(DEATHS) > 0,SUM(DEATHS),1)  AS KDR
FROM (
SELECT player, 0 AS KILLS, sum(count) AS DEATHS FROM ares_stats_player_death WHERE Cause <> 'SUICIDE' GROUP BY player
UNION ALL
SELECT killer as player, COUNT(1) AS KILLS, 0 AS DEATHS FROM ares_stats_player_kill group by killer) AS TBL INNER JOIN ares_stats_player ON ares_stats_player.id = TBL.player
GROUP BY ares_stats_player.name ORDER BY TOTALKILLS DESC";

} else {
//the server must be Enyo
$query = "SELECT player, enyo_stats_player.name, SUM(KILLS) AS TOTALKILLS, SUM(DEATHS) AS TOTALDEATHS,SUM(KILLS)/IF(SUM(DEATHS) > 0,SUM(DEATHS),1)  AS KDR
FROM (
SELECT player, 0 AS KILLS, sum(count) AS DEATHS FROM enyo_stats_player_death WHERE Cause <> 'SUICIDE' GROUP BY player
UNION ALL
SELECT killer as player, COUNT(1) AS KILLS, 0 AS DEATHS FROM enyo_stats_player_kill group by killer) AS TBL INNER JOIN enyo_stats_player ON enyo_stats_player.id = TBL.player
GROUP BY enyo_stats_player.name ORDER BY TOTALKILLS DESC";

}

//now we have our query

//okay so we know which server we are getting lets pull the info from the Database

$user = "";
$pass = "";


// try catch the error if fails
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=db_stats_rustoria', $user, $pass);
	$sth = $dbh->prepare($query);
	$sth->execute();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


//place the results into an array

$results = $sth->fetchAll();

header('Content-Type: application/json');

$results = json_encode($results);

echo $results;

?>
