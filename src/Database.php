<?php declare(strict_types=1);

namespace SBSEDV\Jtl\Ameise;

/**
 * This class represents the database command line options.
 */
final class Database
{
    /**
     * The database server address, e.g. (local)\JTLWAWI
     * @var string
     */
    private string $server;

    /**
     * The database name, e.g. eazybusiness
     * @var string
     */
    private string $name;

    /**
     * The database user, e.g. sa
     * @var string
     */
    private string $user;

    /**
     * The database password
     * @var string
     */
    private string $password;

    /**
     * @param string    $server     The database server address, e.g. (local)\JTLWAWI
     * @param string    $name       The database name, e.g. eazybusiness
     * @param string    $user       The database user, e.g. sa
     * @param string    $password   The database password
     */
    public function __construct(string $server, string $name, string $user, string $password)
    {
        $this->server = $server;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the database server address
     *
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * Get the database name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the database user
     *
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Get the database password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
