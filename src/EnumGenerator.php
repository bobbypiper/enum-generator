<?php
namespace EnumGenerator;

class EnumGenerator
{
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function getParser(): Parser
    {
        return $this->parser;
    }

    public function generate()
    {
        $classes = $this->parser->getClasses();
        echo $classes;
    }

    public function generateFile(string $dirname, bool $isForce = false)
    {
        $this->registerErrorHandler($dirname, $isForce);

        mkdir($dirname, 0777, true);
        $dirname = rtrim($dirname, DIRECTORY_SEPARATOR);

        $classes = $this->parser->getClasses();
        foreach ($classes->each() as $class) {
            $filename = $dirname . DIRECTORY_SEPARATOR . $class->getName() . '.php';
            file_put_contents($filename, $class);
        }
    }

    private function registerErrorHandler(string $dirname, bool $isForce)
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline) use ($dirname, $isForce) {
            if (is_writable($dirname) && $isForce === true) {
                return;
            }
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }
}
