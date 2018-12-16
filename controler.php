<?php
//Paima daug elemetų iš duombazės pagal pateiktą sąlygą
function selectManyVartotojas($where = null){
    global $mysqli;
    if($where == null){
        $where = "";
    }else{
        $where = " WHERE ".$where;
    }
    $results = [];
    $query = "SELECT * FROM asmuo".$where;
    if($result = mysqli_query($mysqli, $query)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $temp = new Vartotojas($row['vardas'], $row['pavarde'], $row['Amzius'], $row['Lytis'], $row['Komanda'],
                $row['Vaidmuo'] );
            $temp->id = $row['id'];
            $results[] = $temp;
        }
    }
    return $results;
}
?>