<?php

class HtmlNode {

    private $tagName;
    private $attributes;
    private $children;
    private $text;

    public function __construct() {
        $this->tagName = null;
        $this->attributes = [];
        $this->children = [];
        $this->text = null;
    }

    public function setTagName($tagName) {
        $this->tagName = $tagName;
    }

    public function getTagName() {
        return $this->tagName;
    }

    public function addAttribute($name, $value) {
        $this->attributes[$name] = $value;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function addChild(HtmlNode $child) {
        $this->children[] = $child;
    }

    public function getChildren() {
        return $this->children;
    }

    public function addText($text) {
        $this->text .= $text;
    }

    public function getText() {
        return $this->text;
    }
}

class HtmlNodeTreeParser {

    private $htmlString;
    private $stack;
    private $currentNode;
    private $previousNode;

    public function __construct($htmlString) {
        $this->htmlString = $htmlString;
        $this->stack = new SplStack();
        $this->currentNode = new HtmlNode();
        $this->previousNode = new HtmlNode();
    }

    public function parse() {
        $this->currentNode = new HtmlNode();
        $this->stack->push($this->currentNode);

        $position = 0;
        while ($position < strlen($this->htmlString)) {
            $character = $this->htmlString[$position];

            if ($character === '<') {
                // If we encounter an opening tag, we create a new node and push it onto the stack.
                $newNode = new HtmlNode();
                $this->stack->push($newNode);
            } elseif ($character === '>') {
                // If we encounter a closing tag, we pop the current node off the stack and make it a child of the previous node.
                $this->currentNode = $this->stack->pop();
                $this->previousNode = $this->stack->peek();

                if ($this->previousNode === null) {
                    // If there is no previous node, it means we are missing an opening tag.
                    throw new Exception("Missing opening tag for closing tag: {$currentNode->getTagName()}");
                }

                $this->previousNode->addChild($currentNode);
            } else {
                // If we encounter a text node, we add it to the current node.
                $this->currentNode->addText($character);
            }

            $position++;
        }

        // If there is still a node on the stack, it means we are missing a closing tag.
        if (!$this->stack->isEmpty()) {
            $this->$currentNode = $this->stack->pop();
            throw new Exception("Missing closing tag for opening tag: {$currentNode->getTagName()}");
        }

        // Once we reach the end of the HTML string, we return the root node of the tree.
        return $rootNode;
    }
}



// Example usage:

$htmlString = '<p>This is some text and here is a <strong>bold text</strong> then the post stop here....</p>';
echo "HELLO";
$parser = new HtmlNodeTreeParser($htmlString);
try {
    $rootNode = $parser->parse();

    // Print the tag name of the root node.
    echo $rootNode->getTagName(); // Output: p

    // Print the text content of the root node.
    echo $rootNode->getText(); // Output: This is some text and here is a bold text then the post stop here....

    // Print the tag name of the first child node of the root node.
    echo $rootNode->getChildren()[0]->getTagName(); // Output: strong

    // Print the text content of the first child node of the root node.
    echo $rootNode->getChildren()[0]->getText(); // Output: bold text
} catch (Exception $e) {
    echo $e->getMessage();
}