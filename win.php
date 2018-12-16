<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .select-style {
            border: 1px solid #ccc;
            width: 120px;
            border-radius: 3px;
            overflow: hidden;
            background: #fafafa url("img/icon-select.png") no-repeat 90% 50%;
        }
        .select-style select {
            padding: 5px 8px;
            width: 130%;
            border: none;
            box-shadow: none;
            background: transparent;
            background-image: none;
            -webkit-appearance: none;
        }
        #zinutes {
            font-family: Arial; border-collapse: collapse; width: 70%;
        }
        #zinutes td, th {
            border: 1px solid #ddd; padding: 8px;
        }
        #zinutes tr:nth-child(even){background-color: #f2f2f2;}
        #zinutes tr:hover {background-color: #ddd;}
    </style>
    <title>Krepšinio turnyro organizavimas</title>
</head>
<?php
ob_start();
include "./Meniu.php";
$dbc = mysqli_connect('localhost', 'root', '', 'nerlai');
mysqli_query($dbc, "SET NAMES 'utf8'");
if (!$dbc) {
    die("Negaliu prisijungti prie MySQL:" . mysqli_error($dbc));
}
// nuskaityti viska bei spausdinti
$sql = "SELECT * FROM komanda1";
$result = mysqli_query($dbc, $sql);
?>
<center><h3>Krepšinio turnyro organizavimas</h3></center>
<center><h4>Laimėtojai</h4></center>
<table style="margin: 0px auto;" id="zinutes">
    <tr><th><center><h3>Pavadinimas</h3></center></th><th><center><h3>Miestas</h3></center></th>
<th><center><h3>Amžius</h3></center></th><th><center><h3>Lytis</h3></center></th></tr>
<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['Lytis'];
        $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Pavadinimas FROM lytis WHERE lytis.id='$username'"));
        echo "<tr><td>" . $row['Pavadinimas'] . "</td><td>" . $row['Miestas'] . "</td><td>" . $row['Amzius'] . "</td><td>" . $row1['Pavadinimas'] . "</td></tr>";
    }
}
?>
</table>
</html>