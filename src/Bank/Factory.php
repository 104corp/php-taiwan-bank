<?php
namespace Corp104\Taiwan\Bank;

use Corp104\Taiwan\Bank\Resource\OpenDataFromGovernmentBank;
use Corp104\Taiwan\Bank\Resource\Resource;
use Corp104\Taiwan\Bank\Resource\ResourceInterface;

class Factory
{
    /**
     * @var ResourceInterface
     */
    protected static $defaultResource;

    /**
     * @return ResourceInterface
     */
    public static function getDefaultResource()
    {
        if (null === static::$defaultResource) {
            static::$defaultResource = new OpenDataFromGovernmentBank();
        }

        return static::$defaultResource;
    }

    /**
     * @param Resource $resource
     */
    public static function setDefaultResource(Resource $resource)
    {
        static::$defaultResource = $resource;
    }

    /**
     * @return BankCollection
     */
    public static function create()
    {
        $collection = new BankCollection();

        foreach (static::getDefaultResource()->getData() as $row) {
            $contact = new Contact($row[4], $row[5]);

            if (empty($row[1])) {
                // Bank
                $bank = new Bank(
                    $row[0],
                    $row[2],
                    $row[3],
                    $contact,
                    $row[7],
                    new BranchCollection(),
                    true,
                    $row[6]
                );
                $collection->add($bank);

                continue;
            }

            // Branch
            $bank = $collection->get($row[0]);
            $branch = new Branch(
                $bank,
                $row[1],
                $row[2],
                $row[3],
                $contact,
                true,
                $row[6]
            );
            $bank->branches->add($branch);
        }

        return $collection;
    }
}
