<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            input[type=text] {
                width: 20%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type=number] {
                width: 20%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type=submit] {
                width: 10%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type=submit]:hover {
                background-color: #45a049;
            }
            .select-style {
                border: 1px solid #ccc;
                width: 225px;
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
    $sql = "SELECT * FROM Asmuo order by id desc limit 5";
    $result = mysqli_query($dbc, $sql);
    ?>
    <center><h3>Krepšinio turnyro organizavimas</h3></center>
<!--    <table style="margin: 0px auto;" id="zinutes">
        <tr><th><center><h3>Vardas</h3></center></th>
    <th><center><h3>Pavarde</h3></center></th><th><center><h3>Amzius</h3></center></th>
    <th><center><h3>Lytis</h3></center></th><th><center><h3>Komanda</h3></center></th></tr>-->
    <?php
//    if (mysqli_num_rows($result) > 0) {
//        while ($row = mysqli_fetch_assoc($result)) {
//            $username = $row['Lytis'];
//            $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Name FROM lytis WHERE lytis.id='$username'"));
//            $username1 = $row['Komanda'];
//            $row2 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM komanda WHERE komanda.id='$username1'"));
//            echo "<tr><td>" . $row['Vardas'] . "</td><td>" . $row['Pavarde'] . "</td><td>" . $row['Amzius'] . "</td><td>" . $row1['Name'] . "</td><td>" . $row2['Pavadinimas'] . "</td></tr>";
//        }
//    }
    ?>
    <!--</table>-->
    <center><div class="container">
            <form method='post'>
                <div class="from-group col-lg-12">
                    <center><h4>Komanda</h4></center><br>
                </div>
                <div class="form-group col-lg-12">
                    <label for="Pavadinimas" class="control-label">Pavadinimas:</label><br>
                    <input name='Pavadinimas' type='text' class="form-control input-sm">
                </div>
                <div class="form-group col-lg-12">
                    <label for="Miestas" class="control-label">Miestas:</label><br>
                    <input name='Miestas' type="text" class="form-control input-sm">
                </div>
                <div class="form-group col-lg-12">
                    <label for="Amzius" class="control-label">Amžius:</label><br>
                    <input name='Amzius' type="number" class="form-control input-sm">
                </div>
                <div class="form-group col-lg-12">
                    <label for="Lytis" class="control-label">Lytis:</label>
                    <div class="select-style">
                        <select name="Lytis">
                            <option value="">Pasirinkti...</option>
                            <option value="2">Vyras</option>
                            <option value="1">Moteris</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label for="Treneris" class="control-label">Treneris:</label><br>
                    <div class="select-style">
                        <select name="Treneris">
                            <option value="">Pasirinkti...</option>
                            <?php
                            $result = $dbc->query("SELECT * from asmuo WHERE Vaidmuo=4");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value=" . $row['id'] . ">" . $row['Vardas'] . " " . $row['Pavarde'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <input type='submit' name='ok' value='Siųsti' class="btnbtn-default">
                </div>
            </form>
        </div></center>
    <?php
//if (!isset($_POST['Lytis'])) {
//    echo "<li>You forgot to select your Gender!</li>";
//}
    if ($_POST != null) {
        $pavadinimas = $_POST['Pavadinimas'];
        $miestas = $_POST['Miestas'];
        $amzius = $_POST['Amzius'];
        $lytis = $_POST['Lytis'];
        $treneris=$_POST['Treneris'];
        $sql = "INSERT INTO komanda (Pavadinimas, Miestas, Amzius, Lytis, Treneris) VALUES ('$pavadinimas', '$miestas', '$amzius', '$lytis', '$treneris')";
        printf($dbc->insert_id);
        if ($dbc->query($sql)) {
            //printf($dbc->insert_id);
            echo "Įrašyta";
            header("Location:createKomZaid.php");
        } else {
            die("Klaida įrašant:" . mysqli_error($dbc));
        }
    }
    ?>
</html>