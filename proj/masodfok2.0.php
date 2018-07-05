<?php

$formula = "3x^2 + 2x -1 = 0+10-20+10";
class Formula
{
    public function __construct($formula){
        $this->formula=$formula;
    }
    public function former()
    {
        $ready = str_replace(" ", "", $this->formula);
        $ready = str_replace("-","+-",$ready);
        $this->formula = $ready;
        return $this->formula;
    }
    

}

class Tag
{
    public $formulas;
    public $tag;
    public function inverter()

    {
        $t=new Formula($formula);
        $this->tag=$t->split();
        if ($this->tag[0] == "-") {
            //negatív
            $this->tag = str_replace("-", "", $this->tag);
        } else {
            $this->tag = "-".$this->tag;  
        }
        return $this->tag;
       

    }
    public function split($formula){
    $formula_p=new Formula($formula);
    $this->formulas=explode("=", $formula_p->former());
    return $this->formulas;
    }
}


class FormulaSolver
{

}

class Polynom extends Formula
{

}

class SecondDegreePolynom extends Polynom
{

}
$b=new Formula("3x^2 + 2x -1 = 0+10-20+10");
$a=new Tag();
//var_dump($b);
var_dump($a->split($formula));
//var_dump($b->former());
//var_dump($formula);
var_dump($a->inverter());