<?php

namespace Project\Manager;

abstract class Manager
{
    /**
     * Find a row
     * 
     * @param string $field Field to request on
     * @param string $value Field value to match
     * @param array $fieldsToRetrieve Array of fields to retrieve from db
     * @return mixed Array of records if found, false otherwise
     */
    public function findOneBy($field, $value, array $fieldsToRetrieve = array()) 
    {
        return $this->repository->findOneBy($field, $value, $fieldsToRetrieve);
    }
}