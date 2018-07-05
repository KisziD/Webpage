<?php
class egyenlet
{
    private $data;
    private $data1;
    private $sum;
    private $implodeddata;
    protected function __construct($t)
    {
        $this->data = $t;
    }

    protected function reorder()
    {
        //ketté válsztja a string-et az "="-nél.
        $data = explode("=", $this->data);
        //a "-"-t "+-"-ra cseréli.
        $this->data = $data;
        $this->data[1] = str_replace("-", "+-", $this->data[1]);
        //felbontja a $data[1]-t minden "+" karakternél.
        $this->data1 = explode("+", $this->data[1]);

        //invertálja az egyenlet második felét.
        foreach ($this->data1 as $key => $tag) {
            if ($tag[0] == "-") {
                //negatív
                $this->data1[$key] = str_replace("-", "", $tag);
            } else {
                //pozitív
                $this->data1[$key] = "-" . $tag;
            }
        }
        $this->data[1] = implode("+", $this->data1);
        //var_dump($this->data1);
        //összefüzi az egyenlet 2 felét.
        // var_dump($this->data[1]);
        $this->implodeddata = $this->data[0] . "+" . $this->data[1];
        //var_dump($this->implodeddata);
        $this->implodeddata = str_replace("+-", "-", $this->implodeddata);
        //kitörli a szóközöket
        $this->implodeddata = str_replace(" ", "", $this->implodeddata);
        //visszaadja az egyenletet.
        //var_dump($this->implodeddata);
        return $this->implodeddata;
    }
    protected function simplify()
    {
        //var_dump($this->data);
        //a "-"-t "+-"-ra cseréli.
        $this->data = str_replace("-", "+-", self::reorder());
        //felbontja a $data-t minden "+" karakternél.
        $this->data = explode("+", $this->data);
        //az összes numerikus tagot összeadje, majd törli a $data tömbből.
        foreach ($this->data as $key => $piece) {
            if (is_numeric($piece)) {
                $this->sum = $this->sum + $piece;
                unset($this->data[$key]);
            }
        }
        var_dump($this->sum);
        //összevonja a tömböt egy stringgé.
        $this->data = implode("+", $this->data);
        //hozzáfűzi az előbb kapott összeget a string-hez.
        $this->data = $this->data . "+" . $this->sum;
        //minden "+-"-t lecserél egy "-"-ra.
        $this->data = str_replace("+-", "-", $this->data);
        //visszaadja a kapott string-et.
        return $this->data;
    }
}

class masodfoku extends egyenlet
{
   private function left_explode()
    {
        //kicseréli a "-"-t "+-"-ra.
        $this->data = str_replace("-", "+-", egyenlet::simplify());
        //felbontja a $data-t minden "+" karakternél.
        $this->data = explode("+", $this->data);
        //visszaadja a kapott tömböt.
        return $this->data;
    }
    private function getQuotient($abc)
    {
        foreach($abc as $key=>$test)
        if ($test == "") {
            $abc[$key] = "1";} elseif ($test == "-") {
            $abc[$key] = "-1";
        }
        return $abc;
    }
    private function findabc()
    {
        //$data-nak ad értéket.
        $data = self::left_explode();
        //megkeresi a $data-ban az "a"-t.
        $this->matches = preg_grep("/x\^2/m", $data);
        //megadja az "a" értékét.
        $this->a = implode($this->matches);

        foreach ($data as $sdasyd) {
            if (($key = array_search($this->a, $data)) !== false) {
                unset($data[$key]);
            }

        }

        //megkeresi a $data-ban a "b"-t.
        $matches = preg_grep("/x/m", $data);
        //megadja a "b" értékét.
        $b = implode($matches);
        //tőrli a "b"-t a $data-ból.
        foreach ($data as $asdasyd) {
            if (($key = array_search($b, $data)) !== false) {
                unset($data[$key]);
            }
        }
        //megadja a "c" értékét.
        $c = implode("",$data);
        

        //törli az "x^2"-t az "a" változóból.
        $a = str_replace("x^2", "", $a);
        

        //törli az "x"-et a "b" változóból.
        $b = str_replace("x", "", $b);
       

        var_dump($c);
        //vissza ad egy tömböt amiben az "a" "b" és "c" változók értéke van, ebben a sorrendben.
        $abc = [$a, $b, $c];
        self::nox();
        return $abc;

    }

    public function solve()
    {
        $solution = [];
        //$abc táblát tölti fel.
        $abc = self::findabc();
        var_dump($abc);
        $D = pow($abc[1], 2) - 4 * $abc[0] * $abc[2];
        if ($D >= 0) {
            //kiszámolja az egyenletet.
            $solution[] = (-$abc[1] - sqrt($D)) / (2 * $abc[0]);
            $solution[] = (-$abc[1] + sqrt($D)) / (2 * $abc[0]);
            //visszaajda az egyenlet megoldását.
            //var_dump($abc);
        }
        return $solution;

    }
}
//$masod = new egyenlet("3x^2 + 2x -1 = 0+10-20+10");
$masod = new masodfoku("x^2 + 2x + 1= 0 ");
var_dump($masod->solve());
