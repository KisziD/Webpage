<?php
// 3x=2
//2x=x^2+10
// 5x^2 = 25
// 25 = 5x^2
// 2*x + x^2 = 0
// 3x^2 + 2x -1 = 0
// 3x^2 + 2x -1 = 0+10-20+10
$c = "0";
$numsum = "0";
$re = '/\+/m';
$formula = " 5x^2 = 25";
$formula = str_replace(" ", "", $formula);
$formula = str_replace("-", "+-", $formula);
$fb = explode("=", $formula);
//$preg0=preg_split($re, $fb[0]);
$preg1 = preg_split($re, $fb[1]);
foreach ($preg1 as $pregnum) {
    $fb[0] = $fb[0] . "-" . $pregnum;
}

$fb[0] = str_replace("--", "+", $fb[0]);
$fb[0] = str_replace("+-", "-", $fb[0]);
$fb[0] = str_replace("-+", "-", $fb[0]);
$fb[0] = str_replace("-0", "", $fb[0]);
$fb[0] = str_replace("-", "+-", $fb[0]);
$preg0 = preg_split($re, $fb[0]);
$fb[1] = "0";
$a;
$b;
$c;

foreach ($preg0 as $key => $isnum) {
    if (is_numeric($isnum)) {
        $numsum = $numsum + $isnum;
        $preg0[$key] = "0";
    }
}

$formulanew = implode("+", $preg0) . "+" . $numsum;

$formulanew = str_replace("0", "", $formulanew);
$formulanew = preg_split($re, $formulanew);

foreach ($formulanew as $asdasyd) {
    if (($key = array_search("", $formulanew)) !== false) {
        unset($formulanew[$key]);
    }
}

$matches = preg_grep("/x\^2/m", $formulanew);

$a = implode($matches);
foreach ($formulanew as $asdasyd) {
    if (($key = array_search($a, $formulanew)) !== false) {
        unset($formulanew[$key]);
    }
}

$matches = preg_grep("/x/m", $formulanew);
$b = implode($matches);
foreach ($formulanew as $asdasyd) {
    if (($key = array_search($b, $formulanew)) !== false) {
        unset($formulanew[$key]);
    }
}

$c = implode($formulanew);

echo "a: " . $a;
echo "<br/>";
echo "<br/>";
echo "b: " . $b;
echo "<br/>";
echo "<br/>";
echo "c: " . $c;
echo "<br/>";
echo "<br/>";
if (($b * $b - 4 * $a * $c) < 0 or $a == 0) {
    echo "Nincs megoldás";
} else {

    $bmin = (-$b - sqrt($b * $b - 4 * $a * $c)) / (2 * $a);
    $bplus = (-$b + sqrt($b * $b - 4 * $a * $c)) / (2 * $a);
    echo $bmin;
	echo "<br/>";
	echo "<br/>";
    echo $bplus;
}
