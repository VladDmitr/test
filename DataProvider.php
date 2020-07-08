<?php

declare(strict_types=1);

class DataProvider implements DataProviderInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    public function get(array $params): array
    {
        // returns a response from external service
        return [];
    }
}