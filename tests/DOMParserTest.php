<?php
namespace Tests\Unit;

use App;
use PHPUnit\Framework\TestCase;


class DOMParserTest extends TestCase
{

    public function testExpectFooActualFoo()
    {
        $x = new App\Question2("<html><div></div></div></html>");
        $this->assertSame('Error: Mismatched closing tag: div', $x->output);
    }

    // public function testExpectBarActualBaz()
    // {
    //     $this->expectOutputString('bar');
    //     print 'baz';
    // }
    // /**
    //  * @dataProvider provider
    //  */
    // public function testMethod($expectedResult, $input)
    // {

    //     //$x = new App\Question2("<html><div></div></div></html>");


    //     // fwrite(STDOUT, print_r($x, TRUE));
    //     //print_r($x);
    //     // $this->asserterror
    //     $this->assertSame($expectedResult,$input);
    // }


    // public static function provider()
    // {
    //     return [
    //         'return error' => [
    //             new App\Question2("<html><div></div></div></html>"),
    //             'Error: Mismatched closing tag: div',
    //         ]
    //     ];
    // }
    // public static function provider()
    // {
    //     // return [];
    //     return [
    //         'my named data' => [true],
    //         'my data'       => [true]
    //     ];
    // }
}