<?php
namespace App;

// we're not using a framework so DI/IoC autoloading not done 
require 'src/Triangle.php'; 
require 'src/Circle.php';
require 'src/Square.php';

require 'src/Shape.php'; // the better way of doing it

/*
    I would liked to have created interfaces and used a more abstract model (strategy and factory/adapters), however this is rudimentry.
    Another Method could have been to create Shape class with Interfaces for ShapeType (struct)
*/


class Question4 {    
    function __construct() {
        $array = [];

        if (($open = fopen("./shapes.csv", "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                $array[] = $data;
            }
         
            fclose($open);
        }

        // thoughts: bind column names, but using index for now
        foreach($array as $shape) {
            $this->create($shape);
        }
    }

     function create( $shape ) { 

        $type = $shape[0];
        $data = $shape[1];
        switch( $type ) { 
            case "triangle": return new Triangle($data);
            case "circle": return new Circle($data);
            case "square": return new Square($data);
            case "pentagon": return new Shape($type,$data);
            default:
                return;
         }
    }
}

new Question4();

?>