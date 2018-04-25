<?php
namespace EnumGenerator;

class EnumGenerator
{
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function generate()
    {
        $classes = $this->parser->parse();
        echo $classes;
    }

    public function generateFile($dirname)
    {
        $classes = $this->parser->parse();
        $classes->toFiles($dirname);
    }
}
