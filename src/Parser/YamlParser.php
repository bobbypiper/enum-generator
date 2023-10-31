<?php
namespace EnumGenerator\Parser;

use EnumGenerator\Parser;
use Symfony\Component\Yaml\Yaml;

class YamlParser extends Parser
{
    public function parse(): array
    {
        return Yaml::parseFile($this->filename, Yaml::PARSE_CUSTOM_TAGS | Yaml::PARSE_OBJECT_FOR_MAP);
    }
}
