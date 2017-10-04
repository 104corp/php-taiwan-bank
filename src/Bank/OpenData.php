<?php
namespace Corp104\Taiwan\Bank;

use Corp104\Support\GuzzleClientAwareInterface;
use Corp104\Support\GuzzleClientAwareTrait;

class OpenData extends Resource implements GuzzleClientAwareInterface
{
    use GuzzleClientAwareTrait;

    protected function fetchData()
    {
        $client = $this->getHttpClient([
            'headers' => [
                'User-Agent' => 'Guzzle/Fake',
            ],
        ]);

        $response = $client->get('http://www.banking.gov.tw/ch/ap/bankno_text.jsp');
        $content = (string)$response->getBody();
        $content = explode("\n", $content);

        // Ignore title row
        array_shift($content);

        $data = [];

        foreach ($content as $item) {
            $row = str_getcsv($item, ' ');

            // Ignore comment
            if (!isset($row[1])) {
                continue;
            }

            $data[] = $row;
        }

        return $data;
    }
}
