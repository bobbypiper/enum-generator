<?php
namespace EnumGenerator;

use EnumGenerator\Parser\YamlParser;
use EnumGenerator\Parser\JsonParser;
use EnumGenerator\EnumGenerator;

class Factory
{
    public function create($filename)
    {
        $base = basename($filename);
        $ext = end(explode('.', $base));

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
