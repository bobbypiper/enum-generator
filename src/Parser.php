<?php
namespace EnumGenerator;

use EnumGenerator\Class_;
use EnumGenerator\Classes;
use PhpParser\PrettyPrinter;

abstract class Parser
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    abstract function parse();

    public function getClasses()
    {
        $parsed = $this->parse();

        $classes = [];
        foreach ($parsed as $class) {
            foreach ($class as $prefix => $enums) {
                foreach ($enums as $name => $enum) {
                    $classes[] = new Class_($this->buildClassName($prefix, $name), $enum, new PrettyPrinter\Standard);
                }
            }
        }

        return new Classes($classes);
    }

    protected function buildClassName($prefix, $name)
    {
        return str_replace('::', '_', $prefix) . $this->toCamel($name);
    }

    private function toCamel($str)
    {
        $str = ucwords($str, '_');
        return str_replace('_', '', $str);
    }
}
