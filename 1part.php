<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            input[type=number] {
                width: 20%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
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
            #zinutes td {
                border: 1px solid #ddd; 
                padding: 8px;
                width: 40%;
            }
            #zinutes tr:nth-child(even){background-color: #f2f2f2;}
            #zinutes tr:hover {background-color: #ddd;}

            #error {
                font-size: 20;
                color: red;
            }
        </style>
    </head>
    <?php
    ob_start();
    $count = 0;
    $count1 = 0;
    include "./Meniu.php";
    $dbc = mysqli_connect('localhost', 'root', '', 'nerlai');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    if (!$dbc) {
        die("Negaliu prisijungti prie MySQL:" . mysqli_error($dbc));
    }
    mysqli_query($dbc, "DROP TABLE komanda1 ");
    mysqli_query($dbc, "CREATE TABLE komanda1 LIKE komanda");
    mysqli_query($dbc, "DROP TABLE laimetojai ");
    mysqli_query($dbc, "CREATE TABLE laimetojai LIKE komanda");
    //mysqli_query($dbc, "INSERT INTO komanda1 SELECT * FROM komanda");
    $roww = mysqli_query($dbc, "SELECT * FROM komanda");
    $count = mysqli_num_rows($roww);
    $count = $count / 2;
    // nuskaityti viska bei spausdinti
    $sql = "SELECT * FROM komanda";
    $result = mysqli_query($dbc, $sql);
    ?>
    <center><h3>Krepšinio turnyro organizavimas</h3></center>
    <center><h4>Rungtynės</h4></center>
    <center><h4>I turas</h4></center>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['Lytis'];
            $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Pavadinimas FROM lytis WHERE lytis.id='$username'"));
            $gender = $row1['Pavadinimas'];
            if ($gender == 'vyras') {
                $gender = 'Vyrai';
            } else {
                $gender = 'Moterys';
            }
            echo "<table style='margin: 0px auto;' id='zinutes'>";
            echo "<tr><td>" . $row['Pavadinimas'] . " (" . $row['Miestas'] . ")</td><td style='width: 10%'>VS</td>";
            if ($row2 = mysqli_fetch_assoc($result)) {
                echo "<td>" . $row2['Pavadinimas'] . " (" . $row2['Miestas'] . ")</td></tr>";
                $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Rez1, Rez2 FROM rez, komanda WHERE rez.Komanda1=" . $row['id'] . " AND rez.Komanda2=" . $row2['id']));
                if ($row1['Rez1'] != "") {
                    $count1 = $count1 + 1;
                }
                echo "<tr><td>" . $row1['Rez1'] . "</td><td style='width: 10%'></td><td>" . $row1['Rez2'] . "</td></tr>";
                if ($row1['Rez1'] < $row1['Rez2']) {
                    mysqli_query($dbc, "INSERT INTO komanda1(`id`, `Pavadinimas`, `Miestas`, `Amzius`, `Lytis`) VALUES (" . $row2['id'] . ",'" . $row2['Pavadinimas'] . "','" . $row2['Miestas'] . "'," . $row2['Amzius'] . "," . $row2['Lytis'] . ")");
                }
                if ($row1['Rez1'] > $row1['Rez2']) {
                    mysqli_query($dbc, "INSERT INTO komanda1(`id`, `Pavadinimas`, `Miestas`, `Amzius`, `Lytis`) VALUES (" . $row['id'] . ",'" . $row['Pavadinimas'] . "','" . $row['Miestas'] . "'," . $row['Amzius'] . "," . $row['Lytis'] . ")");
                }
            }
            echo "<center><h5>" . $gender . " U" . $row['Amzius'] . "</h5></center>";
        }
    };
    echo "</table>";
    echo "<br><center><h4>II turas</h4></center>";

    $sql = "SELECT * FROM komanda1";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['Lytis'];
            $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Pavadinimas FROM lytis WHERE lytis.id='$username'"));
            $gender = $row1['Pavadinimas'];
            if ($gender == 'vyras') {
                $gender = 'Vyrai';
            } else {
                $gender = 'Moterys';
            }
            echo "<table style='margin: 0px auto;' id='zinutes'>";
            if ($row2 = mysqli_fetch_assoc($result)) {
                echo $row2['id'];
                if ($row['Amzius'] == $row2['Amzius'] && $row['Lytis'] == $row2['Lytis']) {
                    $count++;
                    echo "<tr><td>" . $row['Pavadinimas'] . " (" . $row['Miestas'] . ")</td><td>VS</td>";
                    echo "<td>" . $row2['Pavadinimas'] . " (" . $row2['Miestas'] . ")</td></tr>";
                    $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Rez1, Rez2 FROM rez, komanda1 WHERE rez.Komanda1=" . $row['id'] . " AND rez.Komanda2=" . $row2['id']));
                    if ($row1['Rez1'] != "") {
                        $count1 = $count1 + 1;
                    }
                    echo "<tr><td>" . $row1['Rez1'] . "</td><td></td><td>" . $row1['Rez2'] . "</td></tr>";
                    if ($row1['Rez1'] < $row1['Rez2']) {
                        mysqli_query($dbc, "DELETE FROM komanda1 WHERE id=" . $row['id']);
                    }
                    if ($row1['Rez1'] > $row1['Rez2']) {
                        mysqli_query($dbc, "DELETE FROM komanda1 WHERE id=" . $row2['id']);
                    }
                }
            }
            echo "<center><h5>" . $gender . " U" . $row['Amzius'] . "</h5></center>";
        }
    };
    echo "</table>";

    ?>
</html>