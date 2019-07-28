<?php
declare(strict_types=1);

namespace Supermetrics\Reports;

use Supermetrics\Reports\Interfaces\Report;
use Supermetrics\SupermetricsApi\Post;

/**
 * Class WeeklyReport.
 */
class WeeklyReport implements Report
{
    /**
     * @var Post[]
     */
    private $posts;

    /**
     * WeeklyReport constructor.
     * @param array $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Name of the report
     * @return string
     */
    public function name(): string
    {
        return 'Weekly report';
    }

    /**
     * Report description
     * @return string
     */
    public function description(): string
    {
        return 'Total posts split by week';
    }

    /**
     * Array representation of report
     * @return array
     */
    public function toArray(): array
    {
        $stats = [
            'postByWeek' => [],
        ];

        foreach ($this->posts as $post) {
            $week = $post->getCreatedTime()->format('YW');

            if (!array_key_exists($week, $stats['postByWeek'])) {
                $stats['postByWeek'][$week] = 1;
            } else {
                $stats['postByWeek'][$week] += 1;
            }
        }

        return $stats;
    }
}