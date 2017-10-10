<?php
namespace Corp104\Taiwan\Bank\Common;

interface Element
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);
}
