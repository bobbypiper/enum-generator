<?php
namespace EnumGenerator;

class Classes
{
    private $classes;

    public function __construct(array $classes)
    {
        $this->classes = $classes;
    }

    public function __toString()
    {
        $str = '';
        foreach ($this->classes as $class) {
            $str .= $class->toString();
        }
        return $str;
    }

    public function toFiles($dirname)
    {
    }
}
