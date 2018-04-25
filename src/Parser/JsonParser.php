<?php
namespace EnumGenerator\Parser;

use EnumGenerator\Parser;
use EnumGenerator\Class_;
use EnumGenerator\Classes;
use PhpParser\PrettyPrinter;

class JsonParser extends Parser
{
    public function parse()
    {
        $parsed = json_decode(file_get_contents($this->filename), false);

        $classes = [];
        foreach ($parsed as $class) {
            $classes[] = new Class_($class, new PrettyPrinter\Standard);
        }

        return new Classes($classes);
    }
}
