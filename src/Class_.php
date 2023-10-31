<?php
namespace EnumGenerator;

use PhpParser\{BuilderFactory};
use PhpParser\Node\Attribute;
use PhpParser\Node\Name;
use stdClass;

class Class_
{
    private $printer;

    private $name;

    private $nodes;

    public function __construct(string $name, \stdClass $enum, $printer)
    {
        $this->name = $name;
        $this->printer = $printer;
        $this->nodes = $this->createNodes($enum);
    }

    public function __toString(): string
    {
        return $this->printer->prettyPrintFile($this->nodes) . PHP_EOL;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function getNamespace(): ?string
    {
        foreach ($_SERVER['argv'] as $arg) {
            if (str_contains($arg, '--namespace')) {
                return str_replace('--namespace=', '', $arg);
            }
        }
        return null;
    }

    private function createNodes(stdClass $values): array
    {
        $factory = new BuilderFactory();
        $namespacePath = $this->getNamespace();
        $hasNamespace = is_null($namespacePath) === false;
        if ($hasNamespace) {
            $namespace = $factory->namespace($namespacePath);
        }
        $enum = $factory
            ->enum(preg_replace('/[^A-Za-z]/', '', $this->name))
            ->setScalarType('string');
        foreach ($values as $case => $value) {
            if (empty($value)) {
                $value = $case;
            }
            $case = str_replace('%', '_percent', $case);
            $case = str_replace(' ', '_', strtoupper($case));
            $case = preg_replace('/[^A-Za-z0-9\_]/', '', $case);
            $case = str_replace(['__', '___', '_____'], '_', $case);
            $enumCase = $factory
                ->enumCase($case)
                ->setValue($value);
            $enum->addStmt($enumCase);
        }
        $element = $enum->getNode();
        if ($hasNamespace) {
            $namespace->addStmt($enum);
            $element = $namespace->getNode();
        }
        return [
            $element,
        ];
    }
}
