<?php
class Egyenlet
{
    private $data;

    public function __construct($d)
    {
        $this->data = $d;
    }

    protected function split()
    {
        $this->data = explode("=", self::minusToPlusMinus());
        return $this->data;
    }
    protected function removeSpace()
    {
        $this->data = str_replace(" ", "", $this->data);
        return $this->data;
    }
    protected function minusToPlusMinus()
    {
        $this->data = str_replace("-", "+-", self::removeSpace());
        return $this->data;
    }
    protected function invert()
    {
        $halves = self::split();
        //var_dump($halves);
        $invert = self::explodeToTags($halves[1]);
        // var_dump($halves[1]);
        foreach ($invert as $key => $tag) {
            if ($this->tag[0] == "-") {
                //negative
                $invert[$key] = str_replace("-", "", $invert[$key]);
            } else {
                //positive
                $invert[$key] = "-" . $invert[$key];
            }
        }
        //var_dump($halves[0]);
        $invert[] = $halves[0];
        return $invert;
    }
    protected function arrangeToLeft()
    {
        $this->data = implode("+", self::invert());
        //var_dump($this->data);
        return $this->data;
    }
    public function explodeToTags($d)
    {
        $this->data = $d;
        // var_dump($this->data);
        $tags = [];
        //$data = self::arrangeToLeft();
        $tags = explode("+", $this->data);
        //var_dump($tags);
        return $tags;
    }
    private function sumNumeric($t)
    {
        $tags;
        $this->tags = $t;
        foreach ($this->tags as $key => $tag) {
            if (is_numeric($tag)) {
                $sum = $sum + $tag;
            }
        }
        return $sum;
    }
    private function getTags($d)
    {
        $tags = self::explodeToTags(self::arrangeToLeft());
        $data2 = $d;
        $quotients[] = self::sumNumeric($tags);
        foreach ($data2 as $find) {
            $matches = preg_grep($find, $tags);
            //var_dump($matches);
            $a = implode("", $matches);
            if (($key = array_search($a, $tags)) !== false) {
                unset($tags[$key]);}
            $quotients[] = $a;
        }
        var_dump($quotients);
        return $tags;
    }
    public function getQuotient($Q)
    {
        $data2 = [];
        $quotients = [];
        $data2 = $Q;
        $kulcs = 0;
        //var_dump($this->data2);
        $tags = self::getTags($data2);
        //var_dump($tags);
        foreach ($tags as $key => $tag) {
            if (is_numeric($tag));
            else{
                $matches = preg_grep($data2, $tags);
                
            }
        }
        return $quotients;
    }

}

class Masodfoku extends Egyenlet
{

}
$solvant = ["/x\^2/m", "/x/m"];
$masod = new Egyenlet("x^2 - 2x + 1= 0 ");
//var_dump($masod->getQuotient($solvant));
$masod->getQuotient($solvant);
