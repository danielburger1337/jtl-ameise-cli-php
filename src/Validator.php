<?php declare(strict_types=1);

namespace SBSEDV\Jtl\Ameise;

/**
 * Validator for Command
 */
class Validator
{
    /**
     * The command to validate
     * @var Command
     */
    private Command $command;

    /**
     * @param Command       $command        The command to validate.
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Validate the arguments of the Command instance
     *
     * @return void
     */
    public function validate(): void
    {
        if (empty($this->command->getExecutablePath())) {
            throw new InvalidArgumentException('No executable path specified');
        }

        if (null === $this->command->getArgument(Options::WAWI_PROFILE)) {
            $this->validateDatabase();
        } else {
            $this->command->unsetArgument(Options::DB_SERVER);
            $this->command->unsetArgument(Options::DB_NAME);
            $this->command->unsetArgument(Options::DB_USER);
            $this->command->unsetArgument(Options::DB_PASSWORD);
        }

        $templateId = $this->command->getArgument(Options::TEMPLATE_ID);

        if (!$templateId) {
            throw new InvalidArgumentException('No template id was specified');
        }

        if (substr($templateId, 0, 3) === 'IMP') {
            $this->validateInput();
        } else {
            $this->validateOutput();
        }
    }

    /**
     * Validate the database arguments of the Command instance
     *
     * @return void
     */
    private function validateDatabase(): void
    {
        if (!$this->command->getArgument(Options::DB_SERVER)) {
            throw new InvalidArgumentException('No database was server specified');
        }

        if (!$this->command->getArgument(Options::DB_NAME)) {
            throw new InvalidArgumentException('No database name was specified');
        }

        if (!$this->command->getArgument(Options::DB_USER)) {
            throw new InvalidArgumentException('No database user was specified');
        }

        if (!$this->command->getArgument(Options::DB_PASSWORD)) {
            throw new InvalidArgumentException('No database password was specified');
        }
    }

    /**
     * Validate the input file arguments of the Command instance
     *
     * @return void
     */
    private function validateInput()
    {
        if (!$this->command->getArgument(Options::INPUT_FILE)) {
            throw new InvalidArgumentException('An import template id was specified, but no input file was given.');
        }

        $this->command->unsetArgument(Options::OUTPUT_FILE);
    }

    /**
     * Validate the output file arguments of the Command instance
     *
     * @return void
     */
    private function validateOutput()
    {
        if (!$this->command->getArgument(Options::OUTPUT_FILE)) {
            throw new InvalidArgumentException('An export template id was specified, but no output file was given.');
        }

        $this->command->unsetArgument(Options::INPUT_FILE);
    }
}
