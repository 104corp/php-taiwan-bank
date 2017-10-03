<?php
namespace Corp104\Taiwan\Bank;

use RuntimeException;

class CsvFile extends Resource
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    protected function fetchData()
    {
        $handle = fopen($this->path, 'rb');

        if ($handle === false) {
            throw new RuntimeException('File open error');
        }

        $data = [];

        // Ignore title row
        fgetcsv($handle, null, ' ');

        while (($row = fgetcsv($handle, null, ' ')) !== false) {
            // Ignore comment
            if (!isset($row[1])) {
                continue;
            }

            $data[] = $row;
        }

        fclose($handle);

        return $data;
    }
}
