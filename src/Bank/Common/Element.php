<?php
namespace Corp104\Taiwan\Bank\Common;

interface Element
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @return array
     */
    public function toArray();
}
