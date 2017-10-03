<?php
namespace Corp104\Taiwan\Bank;

class Bank
{
    /**
     * @var ResourceInterface
     */
    protected static $defaultResource;

    /**
     * @var null|array
     */
    protected $bankCode;

    /**
     * @var null|array
     */
    protected $branchCode;

    /**
     * @var array
     */
    protected $data;

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
     * @param ResourceInterface|null $resource
     */
    public function __construct(ResourceInterface $resource = null)
    {
        if (null === $resource) {
            $resource = static::getDefaultResource();
        }

        $this->data = $resource->getData();
    }

    /**
     * @return array
     */
    public function getBankCode()
    {
        if (null === $this->bankCode) {
            $this->bankCode = array_filter($this->data, function ($item) {
                return '' === trim($item[1]);
            });

            $this->bankCode = array_reduce($this->bankCode, function ($carry, $item) {
                $key = (string)$item[0];
                $carry[$key] = $item[2];

                return $carry;
            }, []);

            ksort($this->bankCode, SORT_NATURAL);
        }

        return $this->bankCode;
    }

    /**
     * @return array
     */
    public function getBranchCode()
    {
        if (null === $this->branchCode) {
            $this->branchCode = array_filter($this->data, function ($item) {
                return '' !== trim($item[1]);
            });

            $this->branchCode = array_reduce($this->branchCode, function ($carry, $item) {
                $key = (string)$item[1];
                $carry[$key] = $item[2];

                return $carry;
            }, []);

            ksort($this->branchCode, SORT_NATURAL);
        }

        return $this->branchCode;
    }
}
