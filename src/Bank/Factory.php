<?php
namespace Corp104\Taiwan\Bank;

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
            static::$defaultResource = new OpenData();
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
            $contact = (new Contact())
                ->setPhone($row[4])
                ->setName($row[5]);

            if (empty($row[1])) {
                // Bank
                $bank = (new Bank())
                    ->setCode($row[0])
                    ->setName($row[2])
                    ->setAddress($row[6])
                    ->setContact($contact)
                    ->setUrl($row[7])
                    ->setIsActive(true)
                    ->setUpdatedAt($row[6]);
                $collection->add($bank);

                continue;
            }

            // Branch
            $bank = $collection->get($row[0]);
            $branch = (new Branch())
                ->setBank($bank)
                ->setCode($row[1])
                ->setName($row[2])
                ->setAddress($row[3])
                ->setContact($contact)
                ->setIsActive(true)
                ->setUpdatedAt($row[6]);
            $bank->getBranches()->add($branch);
        }

        return $collection;
    }
}
