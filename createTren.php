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
    ?>
    <center><h3>Krepšinio turnyro organizavimas</h3></center>
    <center><div class="container">
        <form method='post'>
            <div class="from-group col-lg-12">
                <center><h4>Treneris</h4></center><br>
            </div>
            <div class="form-group col-lg-12">
                <label for="Vardas" class="control-label">Vardas:</label><br>
                <input name='Vardas' type='text' class="form-control input-sm">
            </div>
            <div class="form-group col-lg-12">
                <label for="Pavarde" class="control-label">Pavardė:</label><br>
                <input name='Pavarde' type="text" class="form-control input-sm">
<!--            </div>
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
            </div>-->
            <center><div class="form-group col-lg-12">
                <label for="Komanda" class="control-label">Komanda:</label><br>
                <div class="select-style">
                    <select name="Komanda">
                        <option value="">Pasirinkti...</option>
                        <?php
                        $result = $dbc->query("SELECT * from komanda11");
                        while ($row = $result->fetch_assoc()) {
                            unset($name);
                            $name = $row['Lytis'];
                            $row1 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT Name FROM lytis WHERE lytis.id='$name'"));
                            $gender = $row1['Name'];
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
                </div></center>
            <div class="form-group col-lg-12">
                <input type='submit' name='ok' value='Siųsti' class="btnbtn-default">
            </div>

        </form>
        </div></center>
</html>
<?php
//if (!isset($_POST['Lytis'])) {
//    echo "<li>You forgot to select your Gender!</li>";
//}
if ($_POST != null) {
    $vardas = $_POST['Vardas'];
    $pavarde = $_POST['Pavarde'];
//    $amzius = $_POST['Amzius'];
//    $lytis = $_POST['Lytis'];
    $komanda = $_POST['Komanda'];
    $vaidmuo = '4';
    if ($komanda!="") {
    $sql = "INSERT INTO asmuo (Vardas, Pavarde, Komanda, Vaidmuo) VALUES ('$vardas', '$pavarde', '$komanda', '$vaidmuo')";
    if (mysqli_query($dbc, $sql)) {
        echo "Įrašyta";
        header("Location:createTren.php");
        exit;
    } else
        die("Klaida įrašant:" . mysqli_error($dbc));
    }else {
        $sql = "INSERT INTO asmuo (Vardas, Pavarde, Vaidmuo) VALUES ('$vardas', '$pavarde', '$vaidmuo')";
    if (mysqli_query($dbc, $sql)) {
        echo "Įrašyta";
        header("Location:createTren.php");
        exit;
    } else
        die("Klaida įrašant:" . mysqli_error($dbc));
    }
}
?>