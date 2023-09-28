<?php
namespace App;
class Triangle {
    private $area = null;
    private $perimeter = null;

    private $length = null; // todo: abstract and interfaces


    function __construct($data) {
        $this->length = $data;
        $this->perimeter = round($this->calcPerimeter(),2);
        $this->area = number_format($this->calcArea(),2);

        echo $this->text() . PHP_EOL;
    }

    function text() { // could have abstracted this such that abstract shape class could handle most of the functions
        return "A triangle with side length {$this->length} u has a perimeter of {$this->perimeter} u and an area of {$this->area} u^2";
    }

    function getPerimeter() {
        return $this->perimeter;
    }

    private function calcPerimeter() {
        return (double) $this->length * 3;
    }

    function getArea() {
        return $this->area;
    }

    function calcArea() {
        return (double) (sqrt(3) / 4) * ($this->length ** 2);
    }
}

?>