<?php
namespace src;

use SismoConfig;
/**
 * @author Vladimir Prudilin <vladimir.prudilin@opensoftdev.ru>
 */
class TravisToSismoConfigConverter 
{
    private $commandCategories = ['env', 'before_script', 'script', 'after_script'];

    /**
     * @var
     */
    private $inputFilePath;

    /**
     * @var
     */
    private $sismoConfig;

    /**
     * @var
     */
    private $parsedData;

    public function __construct($inputFilePath, SismoConfig $sismoConfig, $yamlParser)
    {
        $this->inputFilePath = $inputFilePath;
        $this->sismoConfig = $sismoConfig;
        $this->yamlParser = $yamlParser;
    }

    public function convert()
    {
        $this->parseTravisConfig();
        $this->fillCommands($sismoConfig);
    }

    private function parseTravisConfig()
    {
        $inputFileContent = file_get_contents($this->inputFilePath);
        $this->parsedData = $this->yamlParser->parse($inputFileContent);
    }

    private function convertCommands()
    {
        foreach($this->commandCategories as $category) {
            if (!empty($this->parsedData[$category])) {
                foreach ($this->parsedData[$category] as $command) {
                    $this->sismoConfig->addCommand($command);
                }
            }
        }
    }


} 