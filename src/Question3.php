<?php
/*

Given an array of letters [a, b, c, d, e, f], write a recursive function that outputs the following
structure:

*/

namespace App;

class Question3 {

    function __construct() {

        $letters = ['a','b','c','d','e','f'];
        $this->output($letters);

    }

    private function output($arr, $index = 0) {
        if (!$arr) {
            return;
        }

        $spaces = str_repeat(' ', $index * 2);
        echo $spaces . "<{$arr[0]}>" . PHP_EOL;

        $this->output(array_slice($arr, 1), $index + 1);

        echo $spaces . "</{$arr[0]}>" . PHP_EOL;

        // curious could one write this so that the recursive call is not inbetween the output operands.

    }

    /*

    Few iterations below

    */


    // private function outputF($arr, $index = 0) {
    //     if ($index >= count($arr)) {
    //         return;
    //     }
    //     echo "<{$arr[$index]}>";

    //     $this->outputF($arr, $index + 1);

    //     echo "</{$arr[$index]}>";
    // }

    // private function output2($arr, $index = 0) {

    //     if ($index >= count($arr)) {
    //         return;
    //     }
    //     $spaces = str_repeat(' ', $index * 2);
    //     echo $spaces . "<{$arr[$index]}>" . PHP_EOL;

    //     $this->output2($arr, $index + 1);

    //     echo $spaces . "</{$arr[$index]}>" . PHP_EOL;
    // }


}

new Question3();