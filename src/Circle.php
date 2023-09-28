<?php
namespace App;

class Circle {
    private $area = null;
    private $perimeter = null;

    private $radius = null; // i could have declared length or radius = length but its a circle and radius and side length are 2 diff things

    function __construct($data) {
        $this->radius = $data;
        $this->perimeter = number_format($this->calcPerimeter(),2);
        $this->area = number_format($this->calcArea(),2);

        echo $this->text() . PHP_EOL;
    }

    function text() { // could have abstracted this such that abstract shape class could handle most of the functions
        return "A circle with radius {$this->radius} u has a perimeter of {$this->perimeter} u and an area of {$this->area} u^2";
    }

    function getPerimeter() {
        return $this->perimeter;
    }

    private function calcPerimeter() {
        return (float) 2 * pi() * $this->radius;
    }

    function getArea() {
        return $this->area;
    }

    function calcArea() {
        return (float) pi() * ($this->radius ** 2);
    }
}

?>