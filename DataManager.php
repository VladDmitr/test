<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;

class DataManager implements DataManagerInterface
{
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(DataProviderInterface $dataProvider, LoggerInterface $logger)
    {
        $this->dataProvider = $dataProvider;
        $this->logger = $logger;
    }

    public function get(array $params): array
    {
        $result = [];
        try {
            $result = $this->dataProvider->get($params);
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage(), $params);
        }

        return $result;
    }
}