<?php
use \PHPUnit\Framework\TestCase;
use \EnumGenerator\{EnumGenerator, Parser};
use \EnumGenerator\Parser\{YamlParser, JsonParser};

class EnumGeneratorTest extends TestCase
{
    public function testGetParserReturnsParser()
    {
        $enum = new EnumGenerator(new YamlParser('test.yaml'));
        $this->assertInstanceOf(Parser::class, $enum->getParser());

        $enum = new EnumGenerator(new JsonParser('test.json'));
        $this->assertInstanceOf(Parser::class, $enum->getParser());
    }
}
