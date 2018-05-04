<?php
use \PHPUnit\Framework\TestCase;
use \EnumGenerator\ConstSet;

class ConstSetTest extends TestCase
{
    public function testGetValueUseGetValue()
    {
        $set = new class extends stdClass {
            public function getValue()
            {
                $expected = new stdClass();
                $expected->called = true;

                return $expected;
            }
        };

        $constSet = new ConstSet($set);

        $this->assertTrue($constSet->getValue()->called);
    }

    public function testGetValueNotUseGetValue()
    {
        $set = new stdClass();
        $set->active = 0;
        $set->inactive = 1;

        $constSet = new ConstSet($set);

        $this->assertEquals($set, $constSet->getValue());
    }
}
