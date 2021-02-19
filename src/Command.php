<?php declare(strict_types=1);

namespace SBSEDV\Jtl\Ameise;

/**
 * Wrapper for JTL Ameise cli command construction
 *
 * @link https://guide.jtl-software.de/jtl-wawi/jtl-ameise/cmd-line-version/
 */
class Command
{
    /**
     * The command line arguments passed to JTL Ameise
     * @var array
     */
    private array $arguments = [];

    /**
     * Path to the executable
     * @var string
     */
    private string $executablePath;

    /**
     * Set the JTL WaWi import template id
     *
     * @param string       $templateId         The JTL WaWi import template id.
     *
     * @return self
     */
    public function setTemplateId(string $templateId): self
    {
        $beginsWith = strtoupper(substr($templateId, 0, 3));

        if (!in_array($beginsWith, ['IMP', 'EXP'], true)) {
            throw new InvalidArgumentException("The template id must begin with either IMP or EXP. {$beginsWith} given.");
        }

        $this->addArgument(Options::TEMPLATE_ID, $templateId);

        return $this;
    }

    /**
     * Set the file that will be imported
     *
     * @param string        $inputFile         The file that will be imported.
     *
     * @return self
     */
    public function setInputFile(string $inputFile): self
    {
        if (!file_exists($inputFile)) {
            throw new InvalidArgumentException("Import file {$inputFile} does not exist");
        }

        $this->addArgument(Options::INPUT_FILE, realpath($inputFile));

        return $this;
    }

    /**
     * Set the file that will be exported
     *
     * @param string        $outputFile         The file that will be exported.
     *
     * @return self
     */
    public function setOutputFile(string $outputFile): self
    {
        $this->addArgument(Options::OUTPUT_FILE, $outputFile);

        return $this;
    }

    /**
     * Add a command line argument that is passed to JTL Ameise
     *
     * @param string        $key        The command line option key.
     * @param string        $value      [optional] The command line option value.
     *
     * @return self
     */
    private function addArgument(string $key, string $value = ''): self
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    /**
     * Unset a command line argument by its key
     *
     * @param string        $key        The command line option key to unset.
     *
     * @return self
     */
    public function unsetArgument(string $key): self
    {
        unset($this->arguments[$key]);

        return $this;
    }

    /**
     * Get the command line arguments that are passed to JTL Ameise
     *
     * @return string[]
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * Get a single argument by its key. Returns NULL if argument was not found.
     *
     * @param string        $key        The argument key.
     *
     * @return mixed
     */
    public function getArgument(string $key)
    {
        if (isset($this->arguments[$key])) {
            return $this->arguments[$key];
        }

        return null;
    }

    /**
     * String representation of the command line arguments that are passed to JTL Ameise
     *
     * @return string
     */
    public function getArgumentsAsString(): string
    {
        $arguments = [];

        foreach ($this->getArguments() as $key => $value) {
            $argument = $key;

            if (strpos($value, ' ') !== false) {
                $argument .= '"' . $value . '"';
            } else {
                $argument .= $value;
            }

            $arguments[] = $argument;
        }

        return implode(' ', $arguments);
    }

    /**
     * For better performance, you can tell the Ameise to write the log at the end.
     *
     * This however has the drawback that no log will be written if the process unexpectetly crashes.
     *
     * @return self
     */
    public function writeLogAtEnd(): self
    {
        $this->addArgument(Options::WRITE_LOG_AT_END);

        return $this;
    }

    /**
     * Set the log level
     *
     * @param string|int        $logLevel       The desired log level.
     *
     * @return self
     */
    public function setLogLevel($logLevel): self
    {
        if (!Options::isAllowedLogLevel($logLevel)) {
            throw new InvalidArgumentException("{$logLevel} is not a valid log level. Allowed log levels are: " . implode(', ', Options::getAllowedLogLevels()));
        }

        $this->addArgument(Options::LOG_LEVEL, (string) $logLevel);

        return $this;
    }

    /**
     * Set the log output file
     *
     * This file will contain the "Hauptbericht".
     *
     * @param string        $logFile        The log output file.
     *
     * @return self
     */
    public function setLogFile(string $logFile): self
    {
        $this->addArgument(Options::LOG_FILE, $logFile);

        return $this;
    }

    /**
     * Set the error log ouput file
     *
     * This file will contain the errors that occured.
     *
     * @param string        $errorLogFile       The error log output file.
     *
     * @return self
     */
    public function setErrorsLogFile(string $errorLogFile): self
    {
        $this->addArgument(Options::ERRORS_LOG_FILE, $logFile);

        return $this;
    }

    /**
     * Set the warning log ouput file
     *
     * This file will contain the warnings that occured.
     *
     * @param string        $warningLogFile       The warning log output file.
     *
     * @return self
     */
    public function setWarningsLogFile(string $warningLogFile): self
    {
        $this->addArgument(Options::WARNINGS_LOG_FILE, $warningLogFile);

        return $this;
    }

    /**
     * Set the imported datasets log ouput file
     *
     * This file will contain a log of the imported datasets.
     *
     * @param string        $importedLogFile       The imported datasets log output file.
     *
     * @return self
     */
    public function setImportedLogFile(string $importedLogFile): self
    {
        $this->addArgument(Options::IMPORTED_LOG_FILE, $importedLogFile);

        return $this;
    }

    /**
     * Set the updated datasets log ouput file
     *
     * This file will contain a log of the updated datasets.
     *
     * @param string        $updatedLogFile       The updated datasets log output file.
     *
     * @return self
     */
    public function setUpdatedLogFile(string $updatedLogFile): self
    {
        $this->addArgument(Options::UPDATED_LOG_FILE, $updatedLogFile);

        return $this;
    }

    /**
     * Set the log ouput file for others
     *
     * This file will contain a log of others.
     *
     * @param string        $othersLogFile       The others log output file.
     *
     * @return self
     */
    public function setOthersLogFile(string $othersLogFile): self
    {
        $this->addArgument(Options::OTHER_LOG_FILE, $othersLogFile);

        return $this;
    }

    /**
     * Set the file that will contain invalid datasets
     *
     * @param string        $csvErrorsFile       The csv error file.
     *
     * @return self
     */
    public function setCsvErrorsFile(string $csvErrorsFile): self
    {
        $this->addArgument(Options::CSV_ERRORS_FILE, $csvErrorsFile);

        return $this;
    }

    /**
     * Set the file that will contain datasets with warnings
     *
     * @param string        $csvWarningsFile       The csv warnings file.
     *
     * @return self
     */
    public function setCsvWarningsFile(string $csvWarningsFile): self
    {
        $this->addArgument(Options::CSV_WARNINGS_FILE, $csvWarningsFile);

        return $this;
    }

    /**
     * Enable stdOut (output to console)
     *
     * @return self
     */
    public function enableStdOut(): self
    {
        $this->unsetArgument(Options::NO_STD_OUT);

        return $this;
    }

    /**
     * Disable stdOut (output to console)
     *
     * @return self
     */
    public function disableStdOut(): self
    {
        $this->addArgument(Options::NO_STD_OUT);

        return $this;
    }

    /**
     * Enable the execution of workflows
     *
     * @return self
     */
    public function enableWorkflows(): self
    {
        $this->unsetArgument(Options::NO_WORKFLOWS);

        return $this;
    }

    /**
     * Disable the execution of workflows
     *
     * @return self
     */
    public function disableWorkflows(): self
    {
        $this->addArgument(Options::NO_WORKFLOWS);

        return $this;
    }

    /**
     * Set the database arguments
     *
     * This method accepts an instance of `SBSEDV\Jtl\Ameise\Database` which will then be transformed to the specific arguments.
     *
     * If given a `string`, it is assumed that a `wawiprofile` was given.
     *
     *
     * @param Database|string       $database       The database options.
     *
     * @return self
     */
    public function setDatabase($database): self
    {
        if (is_string($database)) {
            $this->addArgument(Options::WAWI_PROFILE, $database);

            return $this;
        }

        if ($database instanceof Database) {
            $this->addArgument(Options::DB_SERVER, $database->getServer());
            $this->addArgument(Options::DB_NAME, $database->getName());
            $this->addArgument(Options::DB_USER, $database->getUser());
            $this->addArgument(Options::DB_PASSWORD, $database->getPassword());

            return $this;
        }

        throw new InvalidArgumentException('$database must either be of type string or and instance of ' . Database::class . '". ' . gettype($database) . ' given');
    }

    /**
     * Set the path to the executable
     *
     * @param string        $executablePath       Path to the executable.
     *
     * @return self
     */
    public function setExecutablePath(string $executablePath): self
    {
        $this->executablePath = $executablePath;

        return $this;
    }

    /**
     * Get the path to the executable
     *
     * @return string
     */
    public function getExecutablePath(): string
    {
        return $this->executablePath;
    }

    /**
     * Set the mode of the ameise
     *
     * @param string        $mode       The mode of the ameise.
     *
     * @return self
     */
    public function setMode(string $mode): self
    {
        if (!Options::isAllowedMode($mode)) {
            throw new InvalidArgumentException("{$mode} is not a valid mode. Valid modes are " . implode(', ', Options::getAllowedModes()));
        }

        $this->addArgument(Options::MODE, $mode);

        return $this;
    }

    /**
     * Validate the current command arguments
     *
     * @return self
     */
    public function validate(): self
    {
        $validator = new Validator($this);
        $validator->validate();

        return $this;
    }

    /**
     * Get the complete command as string
     *
     * @param string        $startCommand       [optional] The cmd / powershell start command.
     *
     * @return string
     */
    public function getCommandAsString(string $startCommand = 'start /b'): string
    {
        $this->validate();

        return trim("{$startCommand} {$this->getExecutablePath()} {$this->getArgumentsAsString()}");
    }

    /**
     * Execute the constructed command
     *
     * @param callable|null      $processHandler     [optional] Pass a proccess handler to interact with the spawned process.
     *                                                          The first only argument passed to the callable is the created process.
     *
     * @return string|void
     */
    public function execute(?callable $processHandler = null)
    {
        $process = popen($this->getCommandAsString(), 'r');

        if (is_callable($processHandler)) {
            call_user_func($processHandler, $process);
        }

        pclose($process);
    }
}
