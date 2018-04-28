<?php
use \PHPUnit\Framework\TestCase;
use \EnumGenerator\{EnumGenerator, Factory};
use \EnumGenerator\Parser\{YamlParser, JsonParser};

class FactoryTest extends TestCase
{
    public function testCreateReturnsEnumGeneratorHavingYamlParser()
    {
        $enum = Factory::create('test.yaml');
        $this->assertInstanceOf(EnumGenerator::class, $enum);
        $this->assertInstanceOf(YamlParser::class, $enum->getParser());

        $enum = Factory::create('test.yml');
        $this->assertInstanceOf(EnumGenerator::class, $enum);
        $this->assertInstanceOf(YamlParser::class, $enum->getParser());
    }

    public function testCreateReturnsEnumGeneratorHavingJsonParser()
    {
        $enum = Factory::create('test.json');
        $this->assertInstanceOf(EnumGenerator::class, $enum);
        $this->assertInstanceOf(JsonParser::class, $enum->getParser());
    }

    /**
     * @expectedException               RuntimeException
     * @expectedExceptionMessageRegExp  /^Unknown file type\.$/
     */
    public function testCreateThrowsRuntimeException()
    {
        $enum = Factory::create('test.csv');
    }
}
