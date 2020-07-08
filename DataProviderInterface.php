<?php

declare(strict_types=1);

interface DataProviderInterface
{
    public function get(array $params): array;
}