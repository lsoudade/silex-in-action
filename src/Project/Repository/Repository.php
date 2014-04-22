<?php

namespace Project\Repository;

abstract class Repository
{
    protected $db;
    protected $tableName;
    protected $primaryKey;

    public function __construct($dbConnector, $tableName, $primaryKey)
    {
        $this->db = $dbConnector;
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
    }

    public function add(array $data, $ignore = false)
    {
        try {
            $this->db->insert($this->tableName, $data);
        } catch (\Exception $e) {
            if ($e->getCode() == $this->getDuplicateEntryExceptionCode() && $ignore) {
                return false;
            } else {
                throw $e;
            }
        }
        return $this->db->lastInsertId();
    }

    public function insert(array $data, $ignore = false)
    {
        return $this->findByPk($this->add($data, $ignore));
    }

    public function all()
    {
        $query = sprintf('SELECT * FROM `%s`', $this->tableName);
        return $this->getRows($query);
    }

    public function deleteByPk($value)
    {
        return $this->deleteOneBy($this->primaryKey, $value);
    }

    public function deleteOneBy($field, $value)
    {
        $result = $this->db->createQueryBuilder()
            ->delete($this->tableName)
            ->where(sprintf('%s=:key', $field))
            ->setParameter('key', $value)
            ->setMaxResults(1)
            ->execute();

        return $result;
    }

    public function findBy($field, $value, array $fieldsToRetrieve = array())
    {
        $rows = $this->db->createQueryBuilder()
            ->select(empty($fieldsToRetrieve) ? '*' : implode(',', $fieldsToRetrieve))
            ->from($this->tableName, 't')
            ->where('t.' . $field . '=:key')
            ->setParameter('key', $value)
            ->execute()
            ->fetchAll();

        return $rows;
    }

    public function findByPk($value, array $fieldsToRetrieve = array())
    {
        return $this->findOneBy($this->primaryKey, $value, $fieldsToRetrieve);
    }

    public function findOneBy($field, $value, array $fieldsToRetrieve = array())
    {
        $row = $this->db->createQueryBuilder()
            ->select(empty($fieldsToRetrieve) ? '*' : implode(',', $fieldsToRetrieve))
            ->from($this->tableName, 't')
            ->where('t.' . $field . '=:key')
            ->setParameter('key', $value)
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        return $row;
    }

    public function findOneByConditions($conditions, array $fieldsToRetrieve = array())
    {
        $qb = $this->db->createQueryBuilder()
            ->select(empty($fieldsToRetrieve) ? '*' : implode(',', $fieldsToRetrieve))
            ->from($this->tableName, 't');

        foreach ( $conditions as $field => $value ) {
            $qb->andWhere('t.' . $field . '=:key_'.$field)
                ->setParameter('key_'.$field, $value);
        }

        $qb->setMaxResults(1);

        return $qb->execute()->fetch();
    }

    protected function formatFieldsForSelectQuery(array $fields = array())
    {
        if (empty($fields)) {
            return '*';
        }
        $inlineFields = '`' . implode('`,`', $fields) . '`';

        return $inlineFields;
    }

    private function getDuplicateEntryExceptionCode()
    {
        return 23000;
    }

    public function getRows($query)
    {
        $statement = $this->db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();

        return $rows;
    }

    public function increment($field, $value, array $identifier)
    {
        $queryMask = 'UPDATE %s SET %s = %s + %d WHERE %s = ?';
        $conditions = implode(' = ? AND ', array_keys($identifier));
        $query = sprintf($queryMask, $this->tableName, $field, $field, $value, $conditions);

        return $this->db->executeUpdate($query, array_values($identifier));
    }

    /**
     * @todo
     * attention, on voudrait mettre array "conditions" dans la signature de la
     * methode mais ce n'est pas compatible avec l'interface Storable qui est
     * utilisee conjointement sur la LF (en mode non PDO) et sur les projets
     * qui utilisent PDO et/ou doctrine
     */
    public function update(array $data, $conditions)
    {
        return $this->db->update($this->tableName, $data, $conditions);
    }

    public function updateWithPrimaryKey(array $data, $keyValue)
    {
        return $this->update($data, array($this->primaryKey => $keyValue));
    }

    public function getSingleValueFromQuery($query)
    {
        $statement = $this->db->prepare($query);
        $statement->execute();

        return $this->getSingleValueFrom($statement);
    }

    public function getMinimumPrimaryKey()
    {
        $queryMask = 'SELECT MIN(`%s`) FROM `%s`';
        $query = sprintf($queryMask, $this->primaryKey, $this->tableName);

        return $this->getSingleValueFromQuery($query);
    }

    public function getMaximumPrimaryKey()
    {
        $queryMask='SELECT MAX(`%s`) FROM `%s`';
        $query = sprintf($queryMask, $this->primaryKey, $this->tableName);

        return $this->getSingleValueFromQuery($query);
    }

    public function getSingleValueFrom($statement)
    {
        $row = $statement->fetch();
        return $row[0];
    }

    /**
     * Find rows from a table with possibility to add a paginator
     *
     * @param array $fieldsToFilter Conditions to retrieve data
     * @param array $fieldsToRetrieve Fields to retrieve from rows
     * @param array $fieldsToOrder Fields to order by. array('field' => 'ASC/DESC')
     * @param mixed $maxRows int or null
     * @return array of results
     */
    public function findAll(array $fieldsToFilter = array(), array $fieldsToRetrieve = array(), array $fieldsToOrder = array(), $maxRows = null)
    {
        // Execute query
        $qb = $this->db->createQueryBuilder()
            ->select(empty($fieldsToRetrieve) ? '*' : implode(',', $fieldsToRetrieve))
            ->from($this->tableName, 't');

        foreach ( $fieldsToFilter as $field => $value ) {
            $qb->andWhere('t.' . $field . '=:key_'.$field)
                ->setParameter('key_'.$field, $value);
        }

        foreach ( $fieldsToOrder as $field => $order ) {
            $qb->addOrderBy($field, $order);
        }

        if ( !is_null($maxRows) && is_numeric($maxRows) ) {
            $qb->setMaxResults($maxRows);
        }

        return $qb->execute()
            ->fetchAll();
    }
}