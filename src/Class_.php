<?php
namespace EnumGenerator;

use EnumGenerator\ConstSet;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\Stmt;

class Class_
{
    private $printer;

    private $name;

    private $nodes;

    public function __construct($name, $enum, $printer)
    {
        $this->name = $name;
        $this->printer = $printer;
        $this->nodes = $this->createNodes($enum);
    }

    public function __toString()
    {
        return $this->printer->prettyPrintFile($this->nodes) . PHP_EOL;
    }

    public function getName()
    {
        return $this->name;
    }

    private function createNodes($value)
    {
        $nodes = [];

        $factory = new BuilderFactory();

        $class = $factory->class($this->name);
        $class->extend('Enum');
        $class = $this->addConst($class, new ConstSet($value));
        $nodes[] = $class->getNode();

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
                    throw new \RuntimeException("Unknown type of $name => $value");
            }
            $const = new Node\Const_(strtoupper($name), $expr);
            $class->addStmt(new Stmt\ClassConst(array($const)));
        }
        return $class;
    }
}
