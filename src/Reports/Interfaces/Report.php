<?php
declare(strict_types=1);

namespace Supermetrics\Reports\Interfaces;

interface Report
{
    /**
     * Name of the report
     * @return string
     */
    public function name(): string;

    /**
     * Report description
     * @return string
     */
    public function description(): string;

    /**
     * Array representation of report
     * @return array
     */
    public function toArray(): array;
}