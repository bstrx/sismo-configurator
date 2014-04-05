<html>
    <head>
    </head>
    <body>
        <form method="post">
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name'></td>
                </tr>
                <tr>
                    <td>Repository</td>
                    <td><input type='text' name='repository'></td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td><input type='text' name='branch'></td>
                </tr>
                <tr>
                    <td>Slug</td>
                    <td><input type='text' name='slug'></td>
                </tr>
                <tr>
                    <td>Url pattern</td>
                    <td><input type='text' name='urlPattern'></td>
                </tr>
                <tr>
                    <td>Notifier</td>
                    <td><input type='text' name='notifier'></td>
                </tr>
                <tr>
                    <td><input type='submit'></td>
                </tr>
            </table>
        </form>
    </body>
</html>

<?php
use \Symfony\Component\Yaml\Yaml;

require 'src/SismoConfig.php';
require 'src/TravisToSismoConfigConverter.php';
require 'vendor/autoload.php';

$name = $_POST['name'];
$repository = $_POST['repository'];
$inputFilePath = './.travis.yml';
$outputFilePath = 'result/config.php';

$sismoConfig = new SismoConfig($name, $repository);
$converter = new TravisToSismoConfigConverter($inputFilePath, $sismoConfig, new Yaml());
$converter->convert();
$sismoConfig->saveConfigOnDisk($outputFilePath);
