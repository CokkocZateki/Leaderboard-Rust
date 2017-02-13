# Leaderboard-Rust
Script used to pull data from Rust game servers and display it in a datatables leaderboard.

This is a standalone script that can be used in conjuction with any data logging plugin you may have on your Oxide-based Rust server. All you must do is create the database tables for the server you wish to create the leaderboards for. 

<h1> Setting Up </h1>

Once you have found a plugin that can record the data for you and have set up the appropriate database tables to record the data in, you can then move through the steps below to ensure that the script is set up correctly.

<ol>
<li>Download the files and extract them to the root of your website</li>
<li>Open the grabber script, creating or deleting the servers as necessary</li>
<li>Complete the SQL script, pointing it to the tables you wish to display</li>
<li>Fill your database connection credentials in at the bottom of the script</li>
<li>Once completed, open the php file and modify the script at the bottom to use variables with the same name as your database tables, so  the data can be properly pulled across</li>

You are able to make changes to the core of the DataTables table, but you must do so through manipulation of the API itself as this script does not natively work with DataTables without modifying the API.

<a href="https://datatables.net/reference/api/">DataTables API</a>

An example of a website actively running the script can be found <a href="http://www.rustoria.uk/leaderboard">here</a>
