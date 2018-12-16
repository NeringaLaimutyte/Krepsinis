<?php
include_once("controler.php");
include_once 'config.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            input[type=text], select {
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
    //logas($_SERVER['REQUEST_URI']);
    include "./Meniu.php";
    $dbc = mysqli_connect('localhost', 'root', '', 'nerlai');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    if (!$dbc) {
        die("Negaliu prisijungti prie MySQL:" . mysqli_error($dbc));
    }
    ?>
    <center><h3>Krepšinio turnyro organizavimas</h3></center>
    <div class="container">
        <?php
        $form = '<form method="post">
            <div class="from-group col-lg-12">
                <center><h4>Prisijungimas</h4></center><br><br>
            </div>
            <div class="form-group col-lg-12">
                <center><label for="Vardas" class="control-label">Vardas:</label></center>
                <center><input name="Vardas" type="text" class="form-control input-sm"></center>
            </div>
            <div class="form-group col-lg-12">
                <center><label for="Pavarde" class="control-label">Pavardė:</label></center>
                <center><input name="Pavarde" type="text" class="form-control input-sm"></center>
            </div>
            <div class="form-group col-lg-12">
                <center><label for="Slaptazodis" class="control-label">Slaptažodis:</label></center>
                <center><input name="Slaptazodis" type="text" class="form-control input-sm"></center>
            </div>
            <div class="form-group col-lg-12">
                <center><input type="submit" name="ok" value="Siųsti" class="btnbtn-default"></center>
            </div>

        </form>';
        if (!isset($_POST['Vardas']) || !isset($_POST['Pavarde']) || !isset($_POST['Slaptazodis'])) {
            echo $form;
        } else {
            $user = selectManyVartotojas("el_pastas='" . mysqli_real_escape_string($mysqli, $_POST['el_pastas']) . "' AND 
    slaptazodis='" . md5(mysqli_real_escape_string($mysqli, $_POST['pass'])) . "';");
            if (count($user) == 1) {
                $_SESSION['user'] = $user[0];
                if ($user[0]->role == '4') {
                    //header("Location: sandelisMeniu.php");
                } else {
                    header("Location: index.php");
                }
            } else {
                echo '<h2>Nepavyko prisijungti</h2>' . $form;
            }
        }
        ?>
    </div>
</html>
<?php
//if (!isset($_POST['Lytis'])) {
//    echo "<li>You forgot to select your Gender!</li>";
//}
if ($_POST != null) {
    $vardas = $_POST['Vardas'];
    $pavarde = $_POST['Pavarde'];
    $amzius = $_POST['Amzius'];
    $lytis = $_POST['Lytis'];
    $slapt = $_POST['Slaptazodis'];
    $sql = "UPDATE asmuo SET Slaptazodis=" . $slapt . " WHERE Vardas=" . $vardas . " AND Pavarde=" . $pavarde;
    if (mysqli_query($dbc, $sql)) {
        echo "Įrašyta";
        header("Location:createTren.php");
        exit;
    } else
        die("Klaida įrašant:" . mysqli_error($dbc));
}
?>