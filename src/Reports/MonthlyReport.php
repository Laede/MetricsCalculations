<?php
declare(strict_types=1);

namespace Supermetrics\Reports;

use Supermetrics\Reports\Interfaces\Report;
use Supermetrics\SupermetricsApi\Post;

/**
 * Class MonthlyReport.
 */
class MonthlyReport implements Report
{
    /**
     * @var Post[]
     */
    private $posts;

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
        return 'Monthly report';
    }

    /**
     * Report description
     * @return string
     */
    public function description(): string
    {
        return "Average character length / post / month\n  Longest post by character length / month\n Average number of posts per user / month";
    }

    /**
     * Array representation of report
     * @return array
     */
    public function toArray(): array
    {
        $stats = [
            'averagePostLengthPerMonth' => [],
            'longestPost' => [],
            'postCountPerMonth' => [],
            'averagePostsPerUser' => [],
        ];
        foreach ($this->posts as $post) {
            $month = $post->getCreatedTime()->format('Y-m');

            if (!array_key_exists($month, $stats['averagePostLengthPerMonth'])) {
                $stats['averagePostLengthPerMonth'][$month] = strlen($post->getMessage());
            } else {
                $stats['averagePostLengthPerMonth'][$month] += strlen($post->getMessage());
            }

            if (!array_key_exists($month, $stats['longestPost'])) {
                $stats['longestPost'][$month] = strlen($post->getMessage());
            } else {
                $stats['longestPost'][$month] < strlen($post->getMessage())
                    ? $stats['longestPost'][$month] = strlen($post->getMessage())
                    : $stats['longestPost'][$month];
            }

            if (!array_key_exists($month, $stats['postCountPerMonth'])) {
                $stats['postCountPerMonth'][$month] = 1;

            } else {
                $stats['postCountPerMonth'][$month] += 1;
            }

            if (!array_key_exists($post->getFromId(), $stats['averagePostsPerUser'])) {
                $stats['averagePostsPerUser'][$post->getFromId()] = 1;
            } else {
                $stats['averagePostsPerUser'][$post->getFromId()] += 1;
            }
        }

        foreach ($stats['averagePostLengthPerMonth'] as $key => $value) {
            $stats['averagePostLengthPerMonth'][$key] = round($value / $stats['postCountPerMonth'][$key]);
        }

        foreach ($stats['averagePostsPerUser'] as $key => $userPosts) {
            $stats['averagePostsPerUser'][$key] = round($userPosts / count($stats['averagePostLengthPerMonth']));
        }

        return $stats;
    }
}