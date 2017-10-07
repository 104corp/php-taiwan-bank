<?php
namespace Corp104\Taiwan\Bank;

use Corp104\Support\GuzzleClientAwareInterface;
use Corp104\Support\GuzzleClientAwareTrait;

class OpenData extends Resource implements GuzzleClientAwareInterface
{
    use GuzzleClientAwareTrait;

    protected function fetchData()
    {
        $config = [
            'verify' => getenv('TRAVIS') !== 'true', // Workaround for issue #1 server certificate verification failed
            'headers' => [
                'User-Agent' => 'Guzzle/Fake',
            ],
        ];

        $client = $this->getHttpClient($config);

        $response = $client->get('https://www.banking.gov.tw/ch/ap/bankno_excel.jsp');
        $content = (string)$response->getBody();
        $content = mb_convert_encoding($content, 'UTF-8', 'UTF-16LE');
        $content = explode("\n", $content);

        // Ignore title row
        array_shift($content);

        $data = [];

        foreach ($content as $item) {
            $cols = explode("\t", $item);

            // Ignore comment
            if (!isset($cols[1])) {
                continue;
            }

            $cols = array_map(function ($col) {
                return substr(trim($col), 2, -1);
            }, $cols);

            $data[] = $cols;
        }

        return $data;
    }
}
