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
    // nuskaityti viska bei spausdinti
    ?>
    <center><h3>Krepšinio turnyro organizavimas</h3></center>
    <center>
        <div class="container">
            <form method="post">
                <div class="from-group col-lg-12">
                    <center><h4>Rezultatai</h4></center><br>
                </div>
                <div class="form-group col-lg-12">
                    <label for="Komanda1" class="control-label">Pirma komanda:</label><br>
                    <div class="select-style">
                        <select name="Komanda1">
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
                <div class= "form-group col-lg-12">
                    <label for="Rez1" class="control-label">Rezultatas:</label><br>
                    <input name='Rez1' type='number' class="form-control input-sm">
                </div>
                <div class="form-group col-lg-12">
                    <label for="Komanda2" class="control-label">Antra komanda:</label><br>
                    <div class="select-style">
                        <select name="Komanda2">
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
                <div class="form-group col-lg-12">
                    <label for="Rez2" class="control-label">Rezultatas:</label><br>
                    <input name='Rez2' type="number" class="form-control input-sm">
                </div>
                <div class="form-group col-lg-12">
                    <input type='submit' name='ok' value='Siųsti' class="btnbtn-default">
                </div>
            </form>
        </div>
    </center>
</html>
<?php
if ($_POST != null) {
    $komanda1 = $_POST['Komanda1'];
    $komanda2 = $_POST['Komanda2'];
    $rez1 = $_POST['Rez1'];
    $rez2 = $_POST['Rez2'];
    $sql = "INSERT INTO rez (Rez1, Rez2, Komanda1, Komanda2) VALUES ('$rez1', '$rez2', '$komanda1', '$komanda2')";
    if (mysqli_query($dbc, $sql)) {
        echo "Įrašyta";
        header("Location:2part.php");
        exit;
    } else
        die("Klaida įrašant:" . mysqli_error($dbc));
}
?>