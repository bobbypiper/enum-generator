<?php
namespace EnumGenerator;

use EnumGenerator\ConstSet;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\Stmt;

class Class_
{
    private $class;

    private $printer;

    public function __construct($class, $printer)
    {
        $this->class = $class;
        $this->printer = $printer;
    }

    public function toString()
    {
        return $this->printer->prettyPrintFile($this->nodes()) . PHP_EOL;
    }

    private function nodes()
    {
        $nodes = [];

        $factory = new BuilderFactory();
        foreach ($this->class as $name => $enums) {
            foreach ($enums as $const => $value) {
                $class = $factory->class(str_replace('::', '_', $name) . $this->toCamel($const));
                $class->extend('Enum');
                $class = $this->addConst($class, new ConstSet($value));
                $nodes[] = $class->getNode();
            }
        }

        return $nodes;
    }

    private function addConst($class, ConstSet $constSet)
    {
        foreach ($constSet->getValue() as $name => $value) {
            switch (true) {
                case is_int($value):
                    $expr = new Node\Scalar\LNumber($value);
                    break;
                case is_string($value):
                    $expr = new Node\Scalar\String_($value);
                    break;
                default:
                    throw new RuntimeException("Unknown type of $name => $value");
            }
            $const = new Node\Const_(strtoupper($name), $expr);
            $class->addStmt(new Stmt\ClassConst(array($const)));
        }
        return $class;
    }

    private function toCamel($str)
    {
        $str = ucwords($str, '_');
        return str_replace('_', '', $str);
    }
}
