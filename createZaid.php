<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            #label1{
                visibility: hidden;
                color: red;
                font-size: 20;
            }
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

            #error {
                font-size: 20;
                color: red;
            }
        </style>
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
//    $sql = "SELECT * FROM Asmuo order by id desc limit 5";
//    $result = mysqli_query($dbc, $sql);
    ?>
    <center><h3>Krepšinio turnyro organizavimas</h3></center>
<!--    <table style="margin: 0px auto;" id="zinutes">
        <tr><td><center><h3>Nr</h3></center></td><td><center><h3>Vardas</h3></center></td><td><center><h3>Pavardė</h3></center></td>
<td><center><h3>Amžius</h3></center></td><td><center><h3>Lytis</h3></center></td><td><center><h3>Komanda</h3></center></td><tr>-->

    <?php
//    if (mysqli_num_rows($result) > 0) {
//        while ($row = mysqli_fetch_assoc($result)) {
//            $username1 = $row['Komanda'];
//            $row2 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM komanda WHERE komanda.id='$username1'"));
//            $username = $row['Lytis'];
//            $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Name FROM lytis WHERE lytis.id='$username'"));
//
//            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['Vardas'] . "</td><td>" . $row['Pavarde'] . "</td><td>" . $row['Amzius'] . "</td><td>" . $row1['Name'] . "</td><td>" . $row2['Pavadinimas'] . "</td></tr>";
//        }
//    };
//    echo "</table>";
    ?>
    <center><div class="container">
            <label id="label1">Ne visi duomenys suvesti!!!</label>
            <form method='post'>
                <div class="from-group col-lg-12">
                    <center><h4>Komanda</h4></center><br>
                </div>
                <div class="form-group col-lg-12">
                    <label for="Pavadinimas" class="control-label">Pavadinimas:</label><br>
                    <div class="select-style">
                        <select name="Komanda">
                            <option value="">Pasirinkti...</option>
                            <?php
                            $result = $dbc->query("SELECT * from komanda");
                            while ($row = $result->fetch_assoc()) {
                                unset($name);
                                $name = $row['Lytis'];
                                $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Pavadinimas FROM lytis WHERE lytis.id='$name'"));
                                $gender = $row1['Pavadinimas'];
                                if ($gender == 'vyras') {
                                    $gender = 'vyr.';
                                } else {
                                    $gender = 'mot.';
                                }
                                echo "<option value=" . $row['id'] . ">" . $row['Pavadinimas'] . " U" . $row['Amzius'] . " " . $gender . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="from-group col-lg-12">
                    <center><h4>Žaidėjas</h4></center><br>
                </div>
                <div class="form-group col-lg-12">
                    <label for="Vardas" class="control-label">Vardas:</label><br>
                    <input name='Vardas' type='text' class="form-control input-sm">
                </div>
                <div class="form-group col-lg-12">
                    <label for="Pavarde" class="control-label">Pavardė:</label><br>
                    <input name='Pavarde' type="text" class="form-control input-sm">
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
                    <input type='submit' name='ok' value='Siųsti' class="btnbtn-default">
                </div>

            </form>
        </div></center>
</html>
<?php
if ($_POST != null) {
    $vardas = $_POST['Vardas'];
    $pavarde = $_POST['Pavarde'];
    $amzius = $_POST['Amzius'];
    $lytis = $_POST['Lytis'];
    $komanda = $_POST['Komanda'];
    $vaidmuo = '3';
    if ($amzius == "" || $vardas == "" || $pavarde == "" || $lytis == "" || $komanda == "") {
        ?>
        <style type="text/css">
            #label1{
                visibility: visible;
            }
        </style>
        <?php
    }
    $isok = FALSE;
    $sql = "SELECT * FROM komanda WHERE komanda.id='$komanda'";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['Amzius'] != $_POST['Amzius'] || $row['Lytis'] != $_POST['Lytis']) {
                $amzius1 = $row['Amzius'];
                $username = $row['Lytis'];
                $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Pavadinimas FROM lytis WHERE lytis.id='$username'"));
                $lytis1 = $row1['Pavadinimas'];
                echo "<div class='container' id='error'>Komandai gali priklausyti tik $amzius1 metų $lytis1</div>";
                $isok = FALSE;
            } else {
                $isok = TRUE;
            }
        }
    }
    if ($isok) {
        $sql = "INSERT INTO asmuo (Vardas, Pavarde, Amzius, Lytis, Komanda, Vaidmuo) VALUES ('$vardas', '$pavarde', '$amzius', '$lytis', '$komanda', '$vaidmuo')";
        if (mysqli_query($dbc, $sql)) {
            echo "Įrašyta";
            header("Location:createZaid.php");
            exit;
        } else
            die("Klaida įrašant:" . mysqli_error($dbc));
    }
}
?>