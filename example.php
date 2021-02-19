<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use SBSEDV\Jtl\Ameise\Command;
use SBSEDV\Jtl\Ameise\Database;
use SBSEDV\Jtl\Ameise\Options;

$command = (new Command())->setExecutablePath('C:\\JTL-wawi-ameise.exe')
              ->setDatabase(new Database('(local)\\JTLWAWI', 'eazybusiness', 'sa', 's35r3t'))
              ->setTemplateId('EXP42')
              ->setOutputFile(realpath(__DIR__) . DIRECTORY_SEPARATOR . 'test.csv')
              ->setLogFile(realpath(__DIR__) . DIRECTORY_SEPARATOR . 'log.text')
              ->setLogLevel(Options::LOG_LEVEL_VERBOSE)
              ->disableStdOut()
              ->disableWorkflows()
              ->writeLogAtEnd();

// print the constructed command
print $command->getCommandAsString();
// outputs: start /b C:\JTL-wawi-ameise.exe --server=(local)\JTLWAWI --database=eazybusiness --dbuser=sa --dbpass=s35r3t --templateid=EXP42 --outputfile=C:\YOUR_FOLDER\test.csv --log=C:\YOUR_FOLDER\log.text --loglevel=1 --nostdout --no_workflows --writeLogAtEnd

// OR

// execute the command with popen
// $command->execute();
