<?php
namespace EnumGenerator;

use EnumGenerator\Parser\{YamlParser, JsonParser};
use EnumGenerator\EnumGenerator;

class Factory
{
    public function create($filename)
    {
        $base = basename($filename);
        $split = explode('.', $base);
        $ext = end($split);

        switch ($ext) {
        case 'yaml':
        case 'yml':
            return new EnumGenerator(new YamlParser($filename));
            break;
        case 'json':
            return new EnumGenerator(new JsonParser($filename));
            break;
        default:
            throw new \RuntimeException("Unknown file type.");
        }
    }
}
