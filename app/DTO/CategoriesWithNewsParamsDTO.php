<?php

namespace App\DTO;

/**
 * Class CategoriesWithNewsParamsDTO
 * @package App\DTO
 */
class CategoriesWithNewsParamsDTO {

    /**
     * @var array
     */
    private  $categoriesIds;

    /**
     * @var int
     */
    private  $categoriesLimit;

    /**
     * @var int
     */
    private  $newsLimit;


    /**
     * CategoriesWithNewsParamsDTO constructor.
     * @param array $categoriesIds
     * @param $categoriesLimit
     * @param $newsLimit
     */
    public function __construct(array $categoriesIds, $categoriesLimit,$newsLimit)
    {
        $this->categoriesIds=$categoriesIds;
        $this->categoriesLimit=$categoriesLimit;
        $this->newsLimit=$newsLimit;
    }

    /**
     * @return array
     */
    public function getCategoriesIds():array {
        return $this->categoriesIds;
    }

    /**
     * @return int
     */
    public function getCategoriesLimit():int {
        return $this->categoriesLimit;
    }

    /**
     * @return int
     */
    public function getNewsLimit():int {
        return $this->newsLimit;
    }

}

?>