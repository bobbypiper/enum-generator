<?php
namespace EnumGenerator;

class ConstSet
{
    private $set;

    public function __construct($set)
    {
        $this->set = $set;
    }

    public function getValue()
    {
        if (method_exists($this->set, 'getValue')) {
            return $this->set->getValue();
        }
        return $this->set;
    }
}
