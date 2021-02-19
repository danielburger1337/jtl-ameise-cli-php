<?php declare(strict_types=1);

namespace SBSEDV\Jtl\Ameise;

/**
 * This class represents the available cli options for JTL-Ameise.
 */
final class Options
{
    /**
     * The database server name
     * @var string
     */
    public const DB_SERVER = '--server=';

    /**
     * The database name
     * @var string
     */
    public const DB_NAME = '--database=';

    /**
     * The database username
     * @var string
     */
    public const DB_USER = '--dbuser=';

    /**
     * The database password
     * @var string
     */
    public const DB_PASSWORD = '--dbpass=';

    /**
     * The JTL WaWi database profile
     * @var string
     */
    public const WAWI_PROFILE = '--wawiprofile=';

    /**
     * The import / export template id
     * @var string
     */
    public const TEMPLATE_ID = '--templateid=';

    /**
     * The input file for imports
     * @var string
     */
    public const INPUT_FILE = '--inputfile=';

    /**
     * The output file for exports
     * @var string
     */
    public const OUTPUT_FILE = '--outputfile=';

    /**
     * The ameise mode
     * @var string
     */
    public const MODE = '--mode=';

    /**
     * Test mode
     * @var string
     */
    public const MODE_TEST = 'test';

    /**
     * Production mode
     * @var string
     */
    public const MODE_PRODUCTION = 'production';

    /**
     * The log level
     * @var string
     */
    public const LOG_LEVEL = '--loglevel=';

    /**
     * Verbose log level
     * @var string
     */
    public const LOG_LEVEL_VERBOSE = 1;

    /**
     * Compact log level
     * @var string
     */
    public const LOG_LEVEL_COMPACT = 3;

    /**
     * Only errors and warnings log level
     * @var string
     */
    public const LOG_LEVEL_ERRORS = 5;

    /**
     * Log file for "Hauptbericht"
     * @var string
     */
    public const LOG_FILE = '--log=';

    /**
     * Log file for errors
     * @var string
     */
    public const ERRORS_LOG_FILE = '--log_errors=';

    /**
     * Log file for warnings
     * @var string
     */
    public const WARNINGS_LOG_FILE = '--log_warnings=';

    /**
     * Log file for imported datasets
     * @var string
     */
    public const IMPORTED_LOG_FILE = '--log_imported=';

    /**
     * Log file for updated datasets
     * @var string
     */
    public const UPDATED_LOG_FILE = '--log_updated=';

    /**
     * Log file for other
     * @var string
     */
    public const OTHER_LOG_FILE = '--log_other=';

    /**
     * Log file for erroneous datasets
     * @var string
     */
    public const CSV_ERRORS_FILE = '--csv_errors=';

    /**
     * Log file for dataset warnings
     * @var string
     */
    public const CSV_WARNINGS_FILE = '--csv_warnings=';

    /**
     * Disable console output
     * @var string
     */
    public const NO_STD_OUT = '--nostdout';

    /**
     * Disable the execution of workflows
     * @var string
     */
    public const NO_WORKFLOWS = '--no_workflows';

    /**
     * Write logfiles at the end
     * @var string
     */
    public const WRITE_LOG_AT_END = '--writeLogAtEnd';

    /**
     * Returns all allowed log levels
     *
     * @return int[]
     */
    public static function getAllowedLogLevels(): array
    {
        return [self::LOG_LEVEL_VERBOSE, self::LOG_LEVEL_COMPACT, self::LOG_LEVEL_ERRORS];
    }

    /**
     * Checks if the given log level is supported
     *
     * @param string|int    $logLevel       The log level to check.
     *
     * @return bool
     */
    public static function isAllowedLogLevel($logLevel): bool
    {
        return in_array((int) $logLevel, self::getAllowedLogLevels());
    }

    /**
     * Returns the allowed "mode" option values
     *
     * @return string[]
     */
    public static function getAllowedModes(): array
    {
        return [self::MODE_TEST, self::MODE_PRODUCTION];
    }

    /**
     * Checks if the given mode is a supported value
     *
     * @param string        $mode       The mode to check.
     *
     * @return bool
     */
    public static function isAllowedMode(string $mode): bool
    {
        return in_array($mode, self::getAllowedLogLevels());
    }
}
