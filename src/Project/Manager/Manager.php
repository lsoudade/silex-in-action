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
    
    /**
     * Processes to update
     * 
     * @param array $data An associative array containing row data to update.
     * @param int $id Row id to update, can be null if id is in data array
     * @return boolean 
     */
    public function update(array $data, $id = null) 
    {
        if ( is_null($id) )
            $id = $data['id'];
        
        return $this->repository->updateWithPrimaryKey($data, $id);
    }
    
    /**
     * Returns given manager repository
     */
    public function getRepository() 
    {
        return $this->repository;
    }
}