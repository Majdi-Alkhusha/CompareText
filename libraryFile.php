<?php

class Hamming
{
    public function __construct()
    {
        echo 'The class "' . __CLASS__ . '" ready!<br>';
    }

    private $first;
    private $second;

    public function set_First_Value($first)
    {
        $this->first = $first;
    }

    public function set_Second_Value($second)
    {
        $this->second = $second;
    }

    public function calling_Function()
    {
        echo "Result: ".$this->HammingFunction($this->first, $this->second);
    }

    public function HammingFunction($a, $b)
    {
        if (strlen($a) !== strlen($b)) {
            echo 'Strings must same length';
            return null;
        }

        $distance = 0;

        for ($i = 0; $i < strlen($a); $i += 1) {
            if ($a[$i] !== $b[$i]) {
                $distance += 1;
            }
        }

        return $distance;
    }
}

//Levenshtein
class Levenshtein
{
    public function __construct()
    {
        echo 'The class "' . __CLASS__ . '" ready!<br>';
    }

    private $first;
    private $second;

    public function set_First_Value($first)
    {
        $this->first = $first;
    }

    public function set_Second_Value($second)
    {
        $this->second = $second;
    }

    public function calling_Function()
    {
        echo "Result: ".$this->LevenshteinFunction($this->first, $this->second);
    }

    public function LevenshteinFunction($a, $b)
    {
        if (strlen($a) === 0) {
            return strlen($b);
        }

        if (strlen($b) === 0) {
            return strlen($a);
        }

        $matrix = [];
        for ($i = 0; $i <= strlen($b); $i++) {
            $matrix[$i] = [$i];
        }
        $j;
        for ($j = 0; $j <= strlen($a); $j++) {
            $matrix[0][$j] = $j;
        }

        for ($i = 1; $i <= strlen($b); $i++) {
            for ($j = 1; $j <= strlen($a); $j++) {
                if ($b[$i - 1] == $a[$j - 1]) {
                    $matrix[$i][$j] = $matrix[$i - 1][$j - 1];
                } else {
                    $matrix[$i][$j] = min($matrix[$i - 1][$j - 1] + 1, // substitution/replace ↘ 
                        min($matrix[$i][$j - 1] + 1, // insert →
                            $matrix[$i - 1][$j] + 1)); // delete ↓
                }
            }
        }
        return $matrix[strlen($b)][strlen($a)];
    }
}


