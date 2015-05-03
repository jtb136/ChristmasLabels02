<html>
<body>

<Center><B><H2><FONT COLOR="#0000FF">Burgess Family</FONT></H2></B></Center>
<Center><B><H2><FONT COLOR="#0000FF">Christmas Label Database</FONT></H2></B></Center>

<a href="labels.php">Return to viewing program</a><br>

<?php
  include("globals.php");

  $update = $_GET["update"];

  if ($update > 0) {

  echo "<br><br>";

  echo '<TABLE border="1"><TR><TD>';
  echo ("Record to update = " . $update );
  echo ("<br>");

  echo '</TD></TR></TABLE>';
  echo "<br><br>";

  // open a connection to the database server
  $connection = pg_connect("host=$host dbname=$db user=$user password=$pass");
  if (!$connection)
  {
    die("Could not open connection to database server");
  }

  // eventually confirm the update

  if (1 == 1)
  {
    // generate and execute a query
    $query = 'UPDATE burgaddr."Address" SET "Rec_C_Card" = ' . "'" . $setYear . "'" . ' WHERE "Index" = ';
    $query .= "'" . $update . "'";

    echo ("Update query = " . $query);
    $result = pg_query($connection,$query) or
    		die("Error in Update query: $query." . pg_last_error($connection));

   if (!$result) {
     echo ("Error in update");
   }
   else
     echo ("<br><br>Record updated");
  }

  // close database connection
  pg_close($connection);

  }
  else {
    echo ("<br/><br/><b>Invalid update id</b>");
  }

?>
</body>
</html>
