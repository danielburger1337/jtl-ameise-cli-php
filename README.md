# SBSEDV/jtl-ameise-cli-php

Wrapper for JTL-Ameise (c) JTL-Software-GmbH cli command creation written in PHP.

This package is currently tested against version **0.984**.

___

A [phpDocumentor](https://www.phpdoc.org/) documentation of this package can be found in [/docs](./docs) or [here](https://danielburger1337.github.io/jtl-ameise-cli-php/).

Documentation on all available command line options is available [here](https://guide.jtl-software.de/jtl-wawi/jtl-ameise/cmd-line-version/) (GERMAN ONLY).

___

### Example:


```php
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
$command->execute();
```
