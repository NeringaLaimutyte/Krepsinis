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
            input[type=password] {
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
    if (!isset($_POST['Vardas'])) {
        ?>
        <center><h3>Krepšinio turnyro organizavimas</h3></center>
        <div class="container">
            <form action="SingIn.php" method='post'>
                <div class="from-group col-lg-12">
                    <center><h4>Registracija</h4></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><label for="Vardas" class="control-label">Vardas:</label></center>
                    <center><input name='Vardas' type='text' class="form-control input-sm"></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><label for="Pavarde" class="control-label">Pavardė:</label></center>
                    <center><input name='Pavarde' type="text" class="form-control input-sm"></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><label for="Amzius" class="control-label">Amžius:</label></center>
                    <center><input name='Amzius' type="number" class="form-control input-sm"></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><label for="Lytis" class="control-label">Lytis:</label></center>
                    <center><div class="select-style">
                            <center><select name="Lytis">
                                    <option value="">Pasirinkti...</option>
                                    <option value="2">Vyras</option>
                                    <option value="1">Moteris</option>
                                </select></center>
                        </div></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><label for="pass1" class="control-label">Slaptažodis:</label></center>
                    <center><input name='pass1' type="password" class="form-control input-sm"></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><label for="pass2" class="control-label">Pakartoti slaptažodį:</label></center>
                    <center><input name='pass2' type="password" class="form-control input-sm"></center>
                </div>
                <div class="form-group col-lg-12">
                    <center><input type='submit' name='ok' value='Siųsti' class="btnbtn-default"></center>
                </div>
            </form>
        </div>
        <?php
    } elseif ($_POST['pass1'] == $_POST['pass2']) {
        $vardas = $_POST['Vardas'];
        $pavarde = $_POST['Pavarde'];
        $amzius = $_POST['Amzius'];
        $lytis = $_POST['Lytis'] * 1;
        $slapt = $_POST['pass1'];
        $vaidmuo = '4';
        $sql = "INSERT INTO asmuo (Vardas, Pavarde, Amzius, Lytis, Vaidmuo, Slaptazodis) VALUE (
                '" . mysqli_real_escape_string($dbc, $vardas) . "',
                '" . mysqli_real_escape_string($dbc, $pavarde) . "',
                " . mysqli_real_escape_string($dbc, $amzius) * 1 . ",
                " . mysqli_real_escape_string($dbc, $lytis) * 1 . ",
                " . mysqli_real_escape_string($dbc, $vaidmuo) * 1 . ",
                '" . mysqli_real_escape_string($dbc, $slapt) . "'
                )";
        if (mysqli_query($dbc, $sql)) {
            echo "Įrašyta";
            exit;
        } else
            die("Klaida įrašant:" . mysqli_error($dbc));
    }

    function insertVartotojas($object, $password) {
        global $mysqli;
        $query = "INSERT INTO Vartotojas (vardas, pavarde, el_pastas, slaptazodis, adresas, role, isleista_pinigu, nupirkta_knygu, 
      bonus_pinigai, nuolaida, bonus_narys) VALUE (
          '" . mysqli_real_escape_string($mysqli, $object->vardas) . "',
          '" . mysqli_real_escape_string($mysqli, $object->pavarde) . "',
          '" . mysqli_real_escape_string($mysqli, $object->el_pastas) . "',
          '" . mysqli_real_escape_string($mysqli, $password) . "',
          '" . mysqli_real_escape_string($mysqli, $object->adresas) . "',
          " . mysqli_real_escape_string($mysqli, $object->role) * 1 . ",
          " . mysqli_real_escape_string($mysqli, $object->isleista_pinigu) * 1 . ",
          " . mysqli_real_escape_string($mysqli, $object->nupirkta_knygu) * 1 . ",
          " . mysqli_real_escape_string($mysqli, $object->bonus_pinigai) * 1 . ",
          " . mysqli_real_escape_string($mysqli, $object->nuolaida) * 1 . ",
          " . mysqli_real_escape_string($mysqli, $object->bonus_narys) * 1 . "          
        )";
        mysqli_query($mysqli, $query);
    }
    ?>
</html>
