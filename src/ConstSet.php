<?php
namespace EnumGenerator;

class ConstSet
{
    private $set;

    public function __construct(\stdClass $set)
    {
        $this->set = $set;
    }

    public function getValue(): \stdClass
    {
        if (method_exists($this->set, 'getValue')) {
            return $this->set->getValue();
        }
        return $this->set;
    }
}
