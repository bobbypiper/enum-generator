<?php
use \PHPUnit\Framework\TestCase;
use \EnumGenerator\Class_;
use \PhpParser\PrettyPrinter;

class Class_Test extends TestCase
{
    public function setUp()
    {
        $const = new stdClass();
        $const->active = 0;
        $const->inactive = 1;

        $this->class = new Class_(
            'UserState',
            $const,
            new PrettyPrinter\Standard()
        );
    }

    public function testStringRepresentation()
    {
        $expected = <<<'EOT'
<?php

class UserState extends Enum
{
    const ACTIVE = 0;
    const INACTIVE = 1;
}

EOT;

        $this->assertEquals($expected, (string) $this->class);
    }

    public function testGetNameReturnsClassName()
    {
        $this->assertEquals('UserState', $this->class->getName());
    }
}
