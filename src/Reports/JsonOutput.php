<?php
declare(strict_types=1);

namespace Supermetrics\Reports;

use Supermetrics\Reports\Interfaces\Report;

class JsonOutput implements \JsonSerializable
{
    /**
     * @var Report[]
     */
    private $reports;

    /**
     * JsonOutput constructor.
     * @param Report ...$reports
     */
    public function __construct(Report ...$reports)
    {
        $this->reports = $reports;
    }

    public function jsonSerialize()
    {
        $output = [];
        foreach ($this->reports as $report){
            $output[] = [
                'report_name' => $report->name(),
                'report_description' => $report->description(),
                'data' => $report->toArray()
            ];
        }

        return $output;
    }
}