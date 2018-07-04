<?php
session_start();
class Validator
{
    private $valid = true;
    public function __construct($pattern, $inputs)
    {
        foreach ($pattern as $key => $rules) {
            foreach (explode("|", $rules) as $rule) {

                if (!$this->activateRule(trim($rule), $inputs[$key])) {
                    $this->messages[] = "Rule: $rule failed for '$key'";
                    $this->valid = false;
                }
            }
        }
    }
    public function getMessages()
    {
        return $this->messages;
    }

    public function isValid()
    {
        return $this->valid;
    }

    private function activateRule($rule, $string)
    {
        if ($rule == "alpha") {
            return $this->ruleAlpha($string);
        } elseif ($rule == "alnum") {
            return $this->ruleAlnum($string);
        } elseif ($rule == "num") {
            return $this->ruleNum($string);
        } elseif (strpos($rule, "if") !== false) {
            return $this->ruleIf(str_replace("{x}", "'$string'", $rule));
        } elseif ($rule == "required") {
            return $this->ruleNotEmpty($string);
        }
    }

    private function ruleNotEmpty($string)
    {
        return !empty($string);
    }
    private function ruleAlpha($string)
    {
        return ctype_alpha($string);
    }
    private function ruleAlnum($string)
    {
        return ctype_alnum($string);
    }
    private function ruleNum($string)
    {
        return is_numeric($string);
    }
    private function ruleIf($string)
    {
        $if = str_replace("if", "", $string);
        $ret = false;
        eval('
        $ret = (' . $if . ');
        ');
        return $ret;
    }
}
