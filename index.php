<?php
require 'vendor/autoload.php';

$parser = new \Symfony\Component\Yaml\Yaml();
$inputFilePath = './.travis.yml';
$outputFilePath = 'result/config.php';

echo "Trying to create " . $outputFilePath . " from " . $inputFilePath . '... ';

$inputFileContent = file_get_contents($inputFilePath);
$config = $parser->parse($inputFileContent);
$outputFileContent = implode(PHP_EOL, getCommands($config));

if (file_put_contents($outputFilePath, $outputFileContent)) {
    echo 'Done';
}

function getCommands($config) {
    $allCommands = array();
    $commandsCategories = array('before_script', 'script', 'after_script');
    foreach($commandsCategories as $category) {
        if (!empty($config[$category])) {
            $allCommands = array_merge($allCommands, $config[$category]);
        }
    }

    return $allCommands;
}

