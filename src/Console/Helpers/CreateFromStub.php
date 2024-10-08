<?php

namespace ImprovePhp\KaataaCore\Console\Helpers;

class CreateFromStub
{
    public $stub;
    public $content;
    public $destination;
    public $replace = [];
    public $output;
    public $fileName;
    public $directory;

    public function __construct()
    {
        $this->destination();
    }

    public function stub(string $stubFile)
    {
        $this->stub = __DIR__ . "/../Stubs/{$stubFile}.stub";

        return $this;
    }

    public function content()
    {
        $this->content = file($this->stub);

        return $this;
    }

    protected function determinePackageLocation()
    {
        return (debug_backtrace()[count(debug_backtrace()) - 1]['file']);
    }

    public function destination(string $destination = null)
    {
        $destination = $destination ?: $this->determinePackageLocation();

        return $this;
    }

    public function replace(array $replace = null)
    {
        $this->replace = $replace ?: [
            '{{ exampleToReplace }}' => 'ExampleToReplace',
        ];

        return $this;
    }

    public function output()
    {
        $keys = array_keys($this->replace);
        $values = array_values($this->replace);

        $this->output = (str_replace($keys, $values, $this->content));

        return $this;
    }

    public function inDirectory($name)
    {
        $this->directory = $this->destination . $name;
        @mkdir($this->directory);

        return $this;
    }

    public function fileName($fileName)
    {
        $this->fileName = $fileName . '.php';

        return $this;
    }

    public function create()
    {
        $fileContent = $this->output;

        $file = $this->directory . '/' . $this->fileName;

        if (! file_exists($file)) {
            return file_put_contents($file, $fileContent);
        }

        throw new \Exception("File {$this->fileName} already exists. Please check it and try again.");
    }
}
