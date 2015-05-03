<html>
<body>

<Center><B><H2><FONT COLOR="#0000FF">Burgess Family</FONT></H2></B></Center>
<Center><B><H2><FONT COLOR="#0000FF">Christmas Label Database</FONT></H2></B></Center>

<a href="labels.php">Return to viewing program</a><br>

<?php
  include("globals.php");

  $delete = $_GET["delete"];



  echo "<br><br>";

  echo '<TABLE border="1"><TR><TD>';
  echo ("Record to delete = " . $delete );
  echo ("<br>");

  echo '</TD></TR></TABLE>';
  echo "<br><br>";

  // open a connection to the database server
  $connection = pg_connect("host=$host dbname=$db user=$user password=$pass");
  if (!$connection)
  {
    die("Could not open connection to database server");
  }

  // eventually confirm the deletion

  if (1 == 1)
  {
    // generate and execute a query
    $query = 'DELETE FROM burgaddr."Address" WHERE "Index" = ' . $delete;

    echo ("Delete query = " . $query);
    $result = pg_query($connection,$query) or die("Error in Delete query: $query." . pg_last_error($connection));

   if (!$result) {
     echo ("Error in delete");
   }
   else
     echo ("<br><br>Record deleted");


  }

  // close database connection
  pg_close($connection);



?>
</body>
</html>
