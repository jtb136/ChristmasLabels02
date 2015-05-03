<html>
<body>

<Center><B><H2><FONT COLOR="#0000FF">Burgess Family</FONT></H2></B></Center>
<Center><B><H2><FONT COLOR="#0000FF">Christmas Label Database</FONT></H2></B></Center>

<a href="labels.php">Return to viewing program</a><br><br>

<?php 
  include("globals.php");
  $addrName   = $_POST["addrName"];
  $lastName   = $_POST["lastName"];
  $address    = $_POST["address"];
  $city       = $_POST["city"];
  $state      = $_POST["state"];
  $zip        = $_POST["zip"];
  $rec_c_card = $_POST["rec_c_card"];

  echo '<TABLE border="1"><TR><TD>';
  echo ("Address name = " . $addrName );
  echo ("<br>");
  echo ("Last name: " . $lastName);
  echo ("<br>");
  echo ("address = " . $address);
  echo ("<br>");
  echo ("city : " . $city);
  echo ("<br>");
  echo ("State:  " . $state);
  echo ("<br>");
  echo ("Zip : " . $zip);
  echo ("<br>");
  echo ("Year of last card: " . $rec_c_card);
  echo '</TD></TR></TABLE>';
  echo "<br><br>";

  // open a connection to the database server
  $connection = pg_connect("host=$host dbname=$db user=$user password=$pass");
  if (!$connection)
  {
    die("Could not open connection to database server");
  }

  // $dbname = pg_dbname($connection);
  // $dbhost = pg_host($connection);
  // echo('Current database: ' .  $dbname . '<br>');
  // echo('Current host: ' .  $dbhost . '<br>');

  // move this code inside the loop after testing
  $query = 'SELECT MAX("Index") from burgaddr."Address"';
  $result = pg_query($connection,$query) or die("Error in INSERT query: $query." . pg_last_error($connection));
  $myarray = pg_fetch_row($result,0);
  $newIndex = $myarray[0] + 1;
  echo ('Maximum = ' . $myarray[0] . "<br>");
  echo ('newIndex = ' . $newIndex . "<br>");

  if ($lastName) 
  {
    // generate and execute a query
    $query = 'INSERT INTO burgaddr."Address" ("LastName", "AddrName","MFirstMI",';
    $query .= '"Address","City","State","Zip","Rec_C_Card","Index") ';
    $query .= "VALUES ('" . $lastName. "','" . $addrName . "','extra',";
    $query .= "'" . $address . "','" . $city . "','" . $state . "','";
    $query .= $zip . "','" . $rec_c_card . "','" . $newIndex . "')";
    echo ("Write query = " . $query);
    // new name is pg_query, not pg_exec
    $result = pg_exec($connection,$query) or die("Error in INSERT query: $query." . pg_last_error($connection));

    // get the number of rows in the resultset
    $cmdtuples = pg_cmdtuples($result);
    echo ("<br>Result: $cmdtuples row added");
    echo "<br><br>";
 

  }
  
  // close database connection
  pg_close($connection);

  // Displaying input form
  echo ('<FORM ENCTYPE="multipart/form-data" ACTION="addRecord.php" METHOD=POST> ');
  echo ('First part of name: <INPUT name="addrName"> <br>');
  echo ('Last name: <INPUT name="lastName"> <br>');
  echo ('Street address: <INPUT name="address"> <br>');
  echo ('City: <INPUT name="city"> <br>');
  echo ('State: <INPUT name="state"> <br>');
  echo ('Zip Code: <INPUT name="zip"> <br>');
  echo ('Year of last card: <INPUT name="rec_c_card"> &nbsp; &nbsp;
          <INPUT TYPE="submit" VALUE="Add Record"> ');
  echo ('</FORM> ');

?>
</body>
</html>
