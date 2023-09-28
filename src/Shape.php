<?php
namespace App;
class Shape {
    private $area = null;
    private $perimeter = null;
    private $length = null; // todo: abstract and interfaces

    private $type;

    function __construct($type, $data) {
        $this->length = $data;
        $this->type = $type;
        $this->perimeter = round($this->calcPerimeter(),2);
        $this->area = number_format($this->calcArea(),2);

        echo $this->text() . PHP_EOL;
    }

    function text() { // could have abstracted this such that abstract shape class could handle most of the functions
        return "A {$this->type} with side length {$this->length} u has a perimeter of {$this->perimeter} u and an area of {$this->area} u^2";
    }

    function getPerimeter() {
        return $this->perimeter;
    }

    private function calcPerimeter() {
        switch ($this->type) {
            case "pentagon": return (double) $this->length * 5;
            default: // ....
        }
    }

    function getArea() {
        return $this->area;
    }

    function calcArea() {
        $a = $this->length;
        switch ($this->type) {
            case "pentagon": return sqrt(5 * (5 + 2 * (sqrt(5)))) * pow($a, 2) / 4;
        }
    }
}

?>