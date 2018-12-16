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
/*            input[type=text] {
                background-color: white;
                background-image: url('search.png');
                background-position: 10px 10px; 
                background-repeat: no-repeat;
                padding-left: 40px;
            }*/
            #zinutes {
                font-family: Arial; border-collapse: collapse; width: 70%;
            }
            #zinutes th, td {
                border: 1px solid #ddd; padding: 8px;
            }
            #zinutes tr:nth-child(even){background-color: #f2f2f2;}
            #zinutes tr:hover {background-color: #ddd;}
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
    <form action="search.php" method="post">
        <center><input type="text" name="valueToSearch" placeholder=""></center>
        <center><input type="submit" name="search" value="Ieškoti"></center><br>
        <table style="margin: 0px auto;" id="zinutes">
            <tr><th><center><h3>Vardas</h3></center></th><th><center><h3>Pavardė</h3></center></th>
            <th><center><h3>Amžius</h3></center></th><th><center><h3>Lytis</h3></center></th>
        <th><center><h3>Komanda</h3></center></th><th><center><h3>Miestas</h3></center></th><th><center><h3>Vaidmuo</h3></center></th><tr>

                <?php
                if (isset($_POST['search'])) {
                    $valueToSearch = $_POST['valueToSearch'];
                    $query = "SELECT Vardas, Pavarde, asmuo.Amzius AS Amzius, lytis.Pavadinimas AS Lytis, komanda.Pavadinimas AS Komanda, komanda.Miestas "
                            . "AS Miestas, vaidmuo.Pavadinimas AS Vaidmuo FROM asmuo LEFT JOIN komanda ON asmuo.Komanda=komanda.id LEFT JOIN vaidmuo "
                            . "ON asmuo.Vaidmuo=vaidmuo.id LEFT JOIN lytis ON asmuo.Lytis=lytis.id WHERE "
                            . "CONCAT(Vardas,Pavarde,asmuo.Amzius,lytis.Pavadinimas,komanda.Pavadinimas,komanda.Miestas, vaidmuo.Pavadinimas) LIKE '%" . $valueToSearch . "%'";
                    $search_result = mysqli_query($dbc, $query);
                    if (mysqli_num_rows($search_result) > 0) {
                        while ($row = mysqli_fetch_assoc($search_result)) {
                            echo "<tr><td>" . $row['Vardas'] . "</td><td>" . $row['Pavarde'] . "</td><td>" . $row['Amzius'] . "</td><td>" . $row['Lytis'] . "</td><td>" . $row['Komanda'] . "</td><td>" . $row['Miestas'] . "</td><td>" . $row['Vaidmuo'] . "</td></tr>";
                        }
                    };
                } else {
                    $query = "SELECT Vardas, Pavarde, asmuo.Amzius AS Amzius, lytis.Pavadinimas AS Lytis, komanda.Pavadinimas AS Komanda, komanda.Miestas AS Miestas, vaidmuo.Pavadinimas "
                            . "AS Vaidmuo FROM asmuo LEFT JOIN komanda ON asmuo.Komanda=komanda.id LEFT JOIN vaidmuo ON asmuo.Vaidmuo=vaidmuo.id LEFT JOIN lytis ON asmuo.Lytis=lytis.id UNION "
                            . "SELECT Vardas, Pavarde, asmuo.Amzius AS Amzius, lytis.Pavadinimas AS Lytis, komanda.Pavadinimas AS Komanda, komanda.Miestas AS Miestas, vaidmuo.Pavadinimas "
                            . "AS Vaidmuo FROM asmuo RIGHT JOIN komanda ON asmuo.Komanda=komanda.id LEFT JOIN vaidmuo ON asmuo.Vaidmuo=vaidmuo.id LEFT JOIN lytis ON asmuo.Lytis=lytis.id";
                    $search_result = mysqli_query($dbc, $query);
                    if (mysqli_num_rows($search_result) > 0) {
                        while ($row = mysqli_fetch_assoc($search_result)) {
                            echo "<tr><td>" . $row['Vardas'] . "</td><td>" . $row['Pavarde'] . "</td><td>" . $row['Amzius'] . "</td><td>" . $row['Lytis'] . "</td><td>" . $row['Komanda'] . "</td><td>" . $row['Miestas'] . "</td><td>" . $row['Vaidmuo'] . "</td></tr>";
                        }
                    };
                }
                ?>
        </table>
    </form>
</html>