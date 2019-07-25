<?php


namespace Supermetrics\Tools;

use DateTime;

/**
 * Trait DataIterator.
 */
trait DataIterator
{
    /**
     * @param string $token
     *
     * @return array
     */
    public function collectData(string $token): array
    {
        $ch = curl_init();
        $collection = [];
        for ($i= 1; $i <= 10; $i++) {
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.supermetrics.com/assignment/posts?sl_token='.$token.'&page='.$i
            ]);

            $data = json_decode(curl_exec($ch), true);
            $collection[] = $data['data']['posts'];
        }

        curl_close($ch);

        return array_merge(...$collection);
    }

    /**
     * @param $collection
     *
     * @return array
     * @throws \Exception
     */
    public function dateAnalysis(array $collection): array
    {
        $dataArray = [];
        foreach ($collection as $item) {

            $date = (new DateTime($item['created_time']))->format('Y-m');

            if (!array_key_exists($date, $dataArray)) {
                $dataArray[$date] = [
                    'postLength' => strlen($item['message']),
                    'postsCount' => 1,
                    'longestPost' => strlen($item['message'])
                ];
            }
            else {
                $dataArray[$date]['postsCount'] += 1;
                $dataArray[$date]['postLength'] += strlen($item['message']);
                $dataArray[$date]['longestPost'] < strlen($item['message'])
                    ? $dataArray[$date]['longestPost'] = strlen($item['message'])
                    : $dataArray[$date]['longestPost'];
            }

            if (array_key_exists($item['from_id'], $dataArray[$date])) {
                $dataArray[$date] = [
                    $item['from_id'] => 1
                ];
            } else {
                $dataArray[$date][$item['from_id']] += 1;
            }

        }

        return $dataArray;
    }

}