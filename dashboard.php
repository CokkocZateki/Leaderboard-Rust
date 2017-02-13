<html lang="en">
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" 		crossorigin="anonymous">
		
		
		<link href="https://fonts.googleapis.com/css?family=Quicksand:500|Raleway:500" rel="stylesheet">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

				
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/hover.css" rel="stylesheet" media="all">
		<title>Rustoria Leaderboards</title>
		</head>
	
	<body>
	
	<nav id="container"class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="pageheader navbar-brand" href="#">Rustoria Leaderboard</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://www.rustoria.uk/">Home</a></li>
            <li><a href="http://donate.rustoria.uk">Donate</a></li>
            <li><a href="http://www.rustoria.uk/forum/">Forum</a></li>
            <li><a href="http://www.steamcommunity.com/groups/rustoria">Steam Group</a></li>
			<li><a href="http://www.rustoria.uk/#vote">Vote</a></li>
          </ul>
        </div>
      </div>
    </nav>
	
	
<div id="tablepanel" class="table-responsive">
<div class="page-header">
  <h1>Rustoria Leaderboards</h1>
  <h4>Statistics are reset per wipe. Select the server you wish to search for using the buttons below.</h3>
</div>
<div id="buttoncontainer">
<div id="dashbuttons" role="group" aria-label="...">
<a href="#" class="update" data-target="1" ><img src="assets/img/GLOS3.png" width="100" height="100" class="img-circle hvr-grow" alt="Generic placeholder thumbnail"></a>
<a href="#" class="update" data-target="2" ><img src="assets/img/FKMR9.png" width="100" height="100" class="img-circle hvr-grow" alt="Generic placeholder thumbnail"></a>
<a href="#" class="update" data-target="3" ><img src="assets/img/MWZD7.png" width="100" height="100" class="img-circle hvr-grow" alt="Generic placeholder thumbnail"></a>
</div>
</div>
<div id="table" class="panel panel-default"</div>
			<table class='table' id='tables'><thead><tr><th>Name</th><th>Kills</th><th>Deaths</th><th>K/D Ratio</th></tr></thead>
				<tbody id="players">
			
				</tbody>
			</table>
			
			
			</div>
          </div>
</div>
	
	</body>
	
<!-- document ready comed after functions -->	
<script>

function get_stats(server_id, first_load){
 
$.ajax({
  url: "grabber.php?server_id="+server_id+"",
  dataType: 'json',
  success: function(response){
	
	// if ts a refresh destroy the table
	if (first_load == "no"){
		$('#tables').DataTable().destroy();
	}
	
	//first empty the table from all results	
	$('#players').empty();
	 
	//create an empty array
	var players = [];
	 
	//loop the the json data
	$.each(response, function(index,value){
	 
	//set the values
	 
	var name = value.name;
	var kills = value.TOTALKILLS;
	var deaths = value.TOTALDEATHS;
	var kdr = value.KDR;
	
	$('#players').append('<tr><td>'+name+'</td><td>'+kills+'</td><td>'+deaths+'</td><td>'+kdr+'</td></tr>');
	 
	});
	
	var table = $('#tables').DataTable()	
	var order = table.order();
	
	table.order( [ 0, 'desc' ] )
    .draw();
	
	
	}
	
});
 
}
	get_stats('1', "yes");
	
</script>
<script>

$('.update').click(function(){
	var server = $(this).data('target');
	
	get_stats(server, "no");
});


</script>



	
</html>