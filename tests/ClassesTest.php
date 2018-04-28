<?php
use \PHPUnit\Framework\TestCase;
use \EnumGenerator\{Class_, Classes};
use \PhpParser\PrettyPrinter;

class ClassesTest extends TestCase
{
    public function setUp()
    {
        $const = new stdClass();
        $const->active = 0;
        $const->inactive = 1;

        $classes[] = new Class_(
            'UserState',
            $const,
            new PrettyPrinter\Standard()
        );

        $const = new stdClass();
        $const->active = 0;
        $const->inactive = 1;

        $classes[] = new Class_(
            'ShopState',
            $const,
            new PrettyPrinter\Standard()
        );

        $this->classes = new Classes($classes);
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
<?php

class ShopState extends Enum
{
    const ACTIVE = 0;
    const INACTIVE = 1;
}

EOT;

        $this->assertEquals($expected, (string) $this->classes);
    }

    public function testEachReturnsEachClass()
    {
        $i = 0;
        foreach ($this->classes->each() as $class) {
            if ($i == 0) {
                $this->assertEquals('UserState', $class->getName());
            }
            if ($i == 1) {
                $this->assertEquals('ShopState', $class->getName());
            }
            $i++;
        }
    }
}
