<?php
class Vartotojas{
    public $id;
    public $vardas;
    public $pavarde;
    public $amzius;
    public $lytis;
    public $komanda;
    public $vaidmuo;
    //Naujienos konstruktorius.
    function __construct($vardas = '', $pavarde = '', $amzius = 0, $lytis = 0, $komanda = 0, $vaidmuo = 0) {
        $this->vardas = $vardas;
        $this->pavarde = $pavarde;
        $this->amzius = $amzius;
        $this->lytis = $lytis;
        $this->komanda = $komanda;
        $this->vaidmuo = $vaidmuo;
    }
    public function getRoles(){
        $result = [false, false, false, false];
        $bool = [false, true];
        $temp = $this->role;
        for($i = 0; $i < 4; $i++){
            $result[3-$i] = $bool[(int) floor($temp/pow(2, 3-$i))];
            $temp = $temp%pow(2, 3-$i);
        }
        return $result;
    }
}