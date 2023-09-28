<?php
namespace App;

class Square {
    private $area = null;
    private $perimeter = null;

    private $length = null; // i could have declared length or radius = length but its a circle and radius and side length are 2 diff things

    function __construct($data) {
        $this->length = $data;
        $this->perimeter = number_format($this->calcPerimeter(),2);
        $this->area = number_format($this->calcArea(),2);

        echo $this->text() . PHP_EOL;
    }

    function text() { // could have abstracted this such that abstract shape class could handle most of the functions
        return "A Square with side length {$this->length} u has a perimeter of {$this->perimeter} u and an area of {$this->area} u^2";
    }

    function getPerimeter() {
        return $this->perimeter;
    }

    private function calcPerimeter() {
        return (float) 4 * $this->length;
    }

    function getArea() {
        return $this->area;
    }

    function calcArea() {
        return ($this->length ** 2);
    }
}

?>