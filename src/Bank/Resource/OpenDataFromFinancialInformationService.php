<?php
namespace Corp104\Taiwan\Bank\Resource;

use Corp104\Support\GuzzleClientAwareInterface;
use Corp104\Support\GuzzleClientAwareTrait;

class OpenDataFromFinancialInformationService extends Resource implements GuzzleClientAwareInterface
{
    use GuzzleClientAwareTrait;

    /**
     * @var int 對應typeList
     */
    private $defaultType = 0;

    /**
     * 資料來源類型共以下幾種(2018/03/08)
     * TODO 這裡要再想其他方式做分類感覺比較好
     **/
    public static $typeList = [
        0 => '跨行自動化服務機器業務(金融卡)',
        1 => '通匯業務-入戶電匯',
        2 => '通匯業務-公庫匯款',
        3 => '通匯業務-同業匯款',
        4 => '通匯業務-證券匯款',
        5 => '通匯業務-票券匯款',
        6 => '外幣結算平台-美元',
        7 => '外幣結算平台-人民幣',
        8 => '外幣結算平台-日圓',
        9 => '外幣結算平台-歐元',
        10 => '外幣結算平台-澳幣',
        11 => '外幣結算平台-代收付',
        12 => '跨行自動化服務機器業務(國際卡)',
        13 => '全國性繳費/稅業務-活期性帳戶繳費作業',
        14 => '全國性繳費/稅業務-晶片金融卡繳費作業',
        15 => '全國性繳費/稅業務-約定授權繳費作業',
        16 => '全國性繳費/稅業務-活期性帳戶繳稅作業',
        17 => '全國性繳費/稅業務-晶片金融卡繳稅作業',
        18 => '企業付款業務-金融EDI',
        19 => '企業付款業務-金融XML',
        20 => '信用卡業務(發卡)',
        21 => '信用卡業務(收單)',
        22 => '金融卡SmartPay業務(發卡)',
        23 => '金融卡SmartPay業務(收單)',
        24 => '金融卡SmartPay業務(跨國-日本)',
        25 => 'Visa金融卡業務',
        26 => '網路ATM',
    ];

    public function setDefaultType($type)
    {
        $this->defaultType = (int)$type;
    }

    public function getDefaultType()
    {
        return $this->defaultType;
    }

    protected function fetchData()
    {
        $config = [
            'verify' => getenv('TRAVIS') !== 'true', // Workaround for issue #1 server certificate verification failed
            'headers' => [
                'User-Agent' => 'Guzzle/Fake',
            ],
        ];

        $client = $this->getHttpClient($config);

        $response = $client->get('http://www.fisc.com.tw/TC/OPENDATA/Comm1_MEMBER.xml');
        $content = (string)$response->getBody();
        $content = new \SimpleXMLElement($content);

        $data = array_fill(0, count(self::$typeList), []);
        $typeFlip = array_flip(self::$typeList);

        foreach ($content->record as $row) {
            $data[$typeFlip[(string)$row->{'業務別'}]][] = [
                (string)$row->{'銀行代號BIC'},
                '',
                (string)$row->{'金融機構名稱'},
                '',
                '',
                '',
                '',
                '',
            ];
        }

        return $data[$this->getDefaultType()];
    }
}
