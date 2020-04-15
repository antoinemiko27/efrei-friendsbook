<html>
<head>
<title>My friends book</title>
<style>


header {
    background-color: #666;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
}


footer {
    background-color: #777;
    padding: 10px;
    text-align: center;
    color: white;
}
</style>
</head>
<body>
<?php
include('header.html');
?>
<br>
<form action="index.php" method="post">
Name: <input type="text" name="name">
<input type="submit" value="Add new friend">
</form>

<h1>My best friends:</h1>

<?php

$filename = 'friends2.txt';
$nameFilter="";
if (isset($_POST['nameFilter'])) {
    $nameFilter = $_POST['nameFilter'];
}


$startingWith="";
if (isset($_POST['startingWith'])){
  $startingWith = $_POST['startingWith'];

}



$i = 0;

echo "<ul>";
$file = fopen( $filename, "r" );
if( $file != false ) {
    while (!feof($file)) {
        $name = fgets($file);
        if ($nameFilter=="" || strpos($name, $nameFilter)!==FALSE) {
          if ($startingWith == "" || strpos($name,$nameFilter) === 0){
              echo "<li>$name <button type='submit' name='delete' value='$i'>Delete</button></li> ";
              $i++;
          }
        }
    }
    fclose( $file );
}



if (isset($_POST['name']) && strlen($_POST['name'])>0) {
    $newFriendName = $_POST['name'];

    $file = fopen( $filename, "a+" );
    if( $file != false ) {
        echo "<li><b>$newFriendName <button type='submit' name='delete' value='$i'>Delete</button></b></li> ";
        fwrite( $file, "$newFriendName\n" );
        fclose( $file );
    }
}

if (isset($_POST['delete'])) {
        $name = file($filename);
        $indexToBeRemoved = $_POST['delete'];
        unset($name[$indexToBeRemoved]);
        $file = fopen($filename,"w");
        foreach ($name as $qqc) {
          fwrite($file,"$qqc");
        }
        fclose($file);
}

echo "</ul>";

?>

<form action="friendsprof.php" method="post">
<input type="text" name="nameFilter" value="<?=$nameFilter?>">
<input type="checkbox" name="startingWith" <?php if ($startingWith=='TRUE') echo "checked"?> value="TRUE">Only names starting with</input>
<input type="submit" value="Filter list">
</form>

<?php
include('footer.html');
?>

</body>
</html>
