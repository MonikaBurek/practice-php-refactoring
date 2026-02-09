<?php

namespace Core;

class Pagination
{
    public int $max;
    public int $itemsForPage;

    function __construct($max, $itemsForPage)
    {
        $this->max = $max;
        $this->itemsForPage = $itemsForPage;
    }

    public function prepare(): array
    {
        $result = [];
        if ($this->max > 0 && $this->itemsForPage > 0) {
            $numberOfIterations = floor($this->max / $this->itemsForPage);

            for ($i = 0; $i <= $numberOfIterations; $i++) {
                if ($this->itemsForPage * $i < $this->max) {
                    $result[] = $this->itemsForPage * $i;
                }
            }
        }

        return $result; //[0, 10, 20, 30]
    }
}