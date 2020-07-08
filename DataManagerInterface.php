<?php

declare(strict_types=1);

interface DataManagerInterface
{
    public function get(array $params): array;
}