<?php

namespace App;
/*

CONSIDERATIONS:

#1) Iterating through the string object should be minimal
#1) We want to fail fast

#3) We could create a HTMLNode Object for each tag with children[] and parent node for iteration.
#   : However, for consideration of time and the sake of catching errors; keeping this minimal and with less recursion is the approach decided upon.
#   : Implimenting in any desired manner could be done if needed (regex: author is comfortable with. and other methods: though the rule sets can become very complex)

#4) Normally one would use XML and Document Parsers built into PHP in order to achieve this (years of development and testing on libraries)

#5) I am skipping the normal methods I might normally use for creating stratgey, factory or other patterns that one might use in an enterprise app.
   : Additionally I wanted to pay attemption to specifically match the desired output over the actual data/programming structures implimented.


   *
#Please provide feadback: mlzummo@gmail.com
*/

class Question2 {

    public $output = '';
    
    function __construct($html) {

        $html1 = "<html><body><div><a>hello</a></div></body></html>";

        $html2 = "<html><body><div></a></body></html>";
        $html3 = "<html><body><div><a></div></a>";

        $this->output = $this->parseAndFormatHTML($html);
    }


    function parseAndFormatHTML($rawHTML) {
        $stack = array();  // Stack to keep track of open tags
        $output = array();  // Array to store the formatted HTML

        $i = 0;  // Index to traverse the input string

        while ($i < strlen($rawHTML)) {
            if ($rawHTML[$i] == '<') {
                if ($i + 1 < strlen($rawHTML) && $rawHTML[$i + 1] == '/') {
                    // Closing tag
                    $tag_name = '';
                    $i += 2;
                    while ($i < strlen($rawHTML) && $rawHTML[$i] != '>') {
                        $tag_name .= $rawHTML[$i];
                        $i++;
                    }
                    $i++;  // Consume '>'
                    if (empty($stack) || end($stack) != $tag_name) {
                        return "Error: Mismatched closing tag: $tag_name\n";
                    }
                    array_pop($stack);  // Pop the corresponding open tag
                    $output[] = str_repeat("  ", count($stack)) . "</$tag_name>\n";
                } else {
                    // Opening tag
                    $tag_name = '';
                    $i++;
                    while ($i < strlen($rawHTML) && $rawHTML[$i] != '>') {
                        $tag_name .= $rawHTML[$i];
                        $i++;
                    }
                    $i++;  // Consume '>'
                    array_push($stack, $tag_name);
                    $output[] = str_repeat("  ", count($stack) - 1) . "<$tag_name>\n";
                }
            } else {
                // Text content
                $text = '';
                while ($i < strlen($rawHTML) && $rawHTML[$i] != '<') {
                    $text .= $rawHTML[$i];
                    $i++;
                }
                $output[] = str_repeat("  ", count($stack)) . $text . "\n";
            }
        }

        if (!empty($stack)) {
            return "Error: Unclosed tag(s): " . implode(', ', $stack) . "\n";
        }

        return implode('', $output);
    }
}

// var_dump(new Question2("<html><div></div></div></html>"));
// $obj = new Question2("<html><body><div><a>hello</a></div></body></html>");
// echo $obj->output;

?>