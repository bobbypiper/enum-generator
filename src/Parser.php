<?php
namespace EnumGenerator;

abstract class Parser
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    abstract function parse();
}
