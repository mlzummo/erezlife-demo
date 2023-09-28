<?php
namespace Tests\Unit;

use App;
use PHPUnit\Framework\TestCase;


class DOMParserTest extends TestCase
{

    public function testError1()
    {
        $x = new App\Question2("<html><div></div></div></html>");
        $this->assertSame('Error: Mismatched closing tag: div', trim($x->output));
    }

    public function testSuccess() //normally loading data from a file would be better here (multi line strings ehh)
    { 
        $x = new App\Question2("<html><body><div><a>hello</a></div></body></html>");
        $str = 
<<<EOD
<html>
  <body>
    <div>
      <a>
        hello
      </a>
    </div>
  </body>
</html>
EOD;
                $this->assertSame($str, trim($x->output));

    }
}