<?php

class Tag
{
    public $tag;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function invert()
    {
        if ($this->tag[0] == "-") {
            //negative
            $this->tag = str_replace("-", "", $this->tag);
        } else {
            //positive
            $this->tag = "-" . $this->tag;
        }
    }

    public function getExponent()
    {
        $exploded = explode("^", $this->tag);
        if (count($exploded) == 1) {
            if (str_replace("x", "", $this->tag) != $this->tag) {
                //has x but not has '^'
                return 1;
            }
            return 0;
        }

        return $exploded[1];
    }

    public function getQuotient()
    {
        $replaced = preg_replace("/x(\^[0-9]+)?/", "", $this->tag);
        if (empty($replaced)) {
            //it was only an x or x^2
            return 1;
        }

        return $replaced;
    }
}

class Formula
{
    public $formula;
    public $parsed_formula;

    public function getTags()
    {
        return $this->parsed_formula;
    }

    public function __construct($formula)
    {
        if (is_array($formula)) {
            $this->parsed_formula = $formula;
        } else {
            $this->formula = str_replace(" ", "", $formula);
        }
    }

    public function separate()
    {
        $formulas = explode("=", $this->formula);
        $separated = [new Formula($formulas[0]), new Formula($formulas[1])];
        $separated[0]->parseToTags();
        $separated[1]->parseToTags();

        return $separated;
    }

    public function parseToTags()
    {
        $tags = explode("+", str_replace("-", "+-", $this->formula));
        $tags_objects = [];
        foreach ($tags as $tag) {
            $tags_objects[] = new Tag($tag);
        }
        $this->parsed_formula = $tags_objects;

    }

    public function invert()
    {
        foreach ($this->parsed_formula as $tag) {
            $tag->invert();
        }
    }

    public function getSumOfQuotient()
    {
        $sum = 0;
        foreach ($this->parsed_formula as $tag) {
            $sum += $tag->getQuotient();
        }
        return $sum;
    }
}

class Polynom extends Formula
{
    public function simplify()
    {
        $pows = [];
        foreach ($this->parsed_formula as $tag) {
            $exp = $tag->getExponent();
            if (isset($pows[$exp])) {
                $pows[$exp] = [];
            }

            $pows[$exp][] = $tag;
        }

        $finals = [];
        foreach ($pows as $key => $pow) {
            $p = new Polynom($pow);
            $finals[$key] = $p->getSumOfQuotient();
        }
        $this->parsed_formula = [];
        foreach ($finals as $key => $final) {
            $this->parsed_formula[] = new Tag($final . "x^" . $key);
        }
    }
}

class SecondDegreePolynom extends Polynom
{

    public function solve()
    {
        $this->simplify();
        $a = $this->getNthPowTag(2)->getQuotient();
        $b = $this->getNthPowTag(1)->getQuotient();
        $c = $this->getNthPowTag(0)->getQuotient();

        $D = pow($b, 2) - 4 * $a * $c;
        if ($D > 0) {
            return [
                (-$b + sqrt($D)) / (2 * $a),
                (-$b - sqrt($D)) / (2 * $a),
            ];
        } else {
            throw new Exception("Unable to solve this formula.");
        }
    }

    private function getNthPowTag($level)
    {
        foreach ($this->parsed_formula as $tag) {
            if ($tag->getExponent() == $level) {
                return $tag;
            }

        }
        return new Tag("0x^".$level);
    }
}

class FormulaSolver
{
    public static function solve($formula)
    {
        $mainFormula = new Formula($formula);
        $formulas = $mainFormula->separate();
        $merged = self::merge($formulas[0], $formulas[1]);
        $sdf = new SecondDegreePolynom($merged->getTags());

        return $sdf->solve();
    }

    private static function merge($left, $right)
    {
        $right->invert();
        $arr = array_merge($left->getTags(), $right->getTags());
        return new Formula($arr);
    }
}

$formula = "3x^2-1=0";
var_dump(FormulaSolver::solve($formula));
//x^2 + 4 = 5x