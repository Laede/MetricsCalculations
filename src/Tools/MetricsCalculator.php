<?php


namespace Supermetrics\Tools;

use DateTime;

/**
 * Class MetricsCalculator.
 */
class MetricsCalculator
{
    /**
     * @param array $collection
     *
     * @return array
     * @throws \Exception
     */
    public function calculate(array $collection): array
    {
        $stats = [
            'averagePostLengthPerMonth' => [],
            'longestPost' => [],
            'postCountPerMonth' => [],
            'postByWeek' => [],
            'averagePostsPerUser' => [],
        ];
        foreach ($collection as $item) {
            $month = (new DateTime($item['created_time']))->format('Y-m');
            $week = (new DateTime($item['created_time']))->format('YW');

            if (!array_key_exists($month, $stats['averagePostLengthPerMonth'])) {
                $stats['averagePostLengthPerMonth'][$month] = strlen($item['message']);
            } else {
                $stats['averagePostLengthPerMonth'][$month] += strlen($item['message']);
            }

            if (!array_key_exists($month, $stats['longestPost'])) {
                $stats['longestPost'][$month] = strlen($item['message']);
            } else {
                $stats['longestPost'][$month] < strlen($item['message'])
                    ? $stats['longestPost'][$month] = strlen($item['message'])
                    : $stats['longestPost'][$month];
            }

            if (!array_key_exists($month, $stats['postCountPerMonth'])) {
                $stats['postCountPerMonth'][$month] = 1;

            } else {
                $stats['postCountPerMonth'][$month] += 1;
            }

            if (!array_key_exists($week, $stats['postByWeek'])) {
                $stats['postByWeek'][$week] = 1;
            } else {
                $stats['postByWeek'][$week] += 1;
            }

            if (!array_key_exists($item['from_id'], $stats['averagePostsPerUser'])) {
                $stats['averagePostsPerUser'][$item['from_id']] = 1;
            } else {
                $stats['averagePostsPerUser'][$item['from_id']] += 1;
            }
        }

        foreach ($stats['averagePostLengthPerMonth'] as $key => $post) {
            $stats['averagePostLengthPerMonth'][$key] = bcdiv($post, $stats['postCountPerMonth'][$key]);
        }

        foreach ($stats['averagePostsPerUser'] as $key => $userPosts) {
            $stats['averagePostsPerUser'][$key] = bcdiv($userPosts, count($stats['averagePostLengthPerMonth']));
        }

        return $stats;
    }
}
