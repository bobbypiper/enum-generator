<?php
namespace EnumGenerator\Parser;

use EnumGenerator\Parser;
use EnumGenerator\Class_;
use EnumGenerator\Classes;
use Symfony\Component\Yaml\Yaml;
use PhpParser\PrettyPrinter;

class YamlParser extends Parser
{
    public function parse()
    {
        $parsed = Yaml::parseFile($this->filename, Yaml::PARSE_CUSTOM_TAGS | Yaml::PARSE_OBJECT_FOR_MAP);

        $classes = [];
        foreach ($parsed as $class) {
            $classes[] = new Class_($class, new PrettyPrinter\Standard);
        }

        return new Classes($classes);
    }
}
