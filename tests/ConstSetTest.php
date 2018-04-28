<?php
use \PHPUnit\Framework\TestCase;
use \EnumGenerator\ConstSet;

class ConstSetTest extends TestCase
{
    public function testGetValueUseGetValue()
    {
        $set = new class {
            public function getValue()
            {
                return 'getValue() called.';
            }
        };

        $constSet = new ConstSet($set);

        $this->assertEquals('getValue() called.', $constSet->getValue());
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
