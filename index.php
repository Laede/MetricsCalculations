<?php
declare(strict_types=1);

use Supermetrics\Http\CurlClient;
use Supermetrics\Reports\MonthlyReport;
use Supermetrics\Reports\WeeklyReport;
use Supermetrics\SupermetricsApi\ApiClient;
use Supermetrics\SupermetricsApi\User;
use Supermetrics\Http\RequestException;
use Supermetrics\Reports\JsonOutput;

require __DIR__.'/vendor/autoload.php';

$client = new CurlClient('https://api.supermetrics.com/assignment');
$user = new User('ju16a6m81mhid5ue1z3v2g0uh', 'Your Name', 'your@email.address');
$api = new ApiClient($client, $user);

try {
$data = $api->getPosts();
$output = new JsonOutput(
new MonthlyReport($data),
new WeeklyReport($data)
);

header("Content-Type: application/json");
echo json_encode($output->jsonSerialize());

} catch (RequestException $ex) {
echo "Something went wrong with requests.\n Status: {$ex->getCode()}\n Message: {$ex->getMessage()}\n";
}