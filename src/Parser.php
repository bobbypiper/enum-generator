<?php
namespace EnumGenerator;

use EnumGenerator\{Class_, Classes};
use PhpParser\PrettyPrinter;

abstract class Parser
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $this->toCamel($filename);
    }

    abstract function parse();

    public function getClasses(): Classes
    {
        $parsed = $this->parse();

        $classes = [];
        foreach ($parsed as $class) {
            foreach ($class as $name => $enum) {
                $classes[] = new Class_($this->toCamel($name), $enum, new PrettyPrinter\Standard);
            }
        }

        return new Classes($classes);
    }

    private function toCamel($str): string
    {
        $str = ucwords($str, '_');
        return str_replace('_', '', $str);
    }
}
