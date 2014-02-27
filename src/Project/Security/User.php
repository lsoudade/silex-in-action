<?php

namespace Project\Security;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User implementation used by the in-memory user provider.
 */
class User implements AdvancedUserInterface
{
    private $username;
    private $password;
    private $id;
    private $enabled;
    private $accountNonExpired;
    private $credentialsNonExpired;
    private $accountNonLocked;
    private $roles;
    private $extra;

    public function __construct($username, $password, $id, array $roles = array(), $enabled = true, $userNonExpired = true, $credentialsNonExpired = true, $userNonLocked = true)
    {
        if (empty($username)) {
            throw new \InvalidArgumentException('The username cannot be empty.');
        }
        
        if (empty($id)) {
            throw new \InvalidArgumentException('The id cannot be empty.');
        }

        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
        $this->enabled = $enabled;
        $this->accountNonExpired = $userNonExpired;
        $this->credentialsNonExpired = $credentialsNonExpired;
        $this->accountNonLocked = $userNonLocked;
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @return int Current member id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return $this->accountNonExpired;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return $this->accountNonLocked;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return $this->credentialsNonExpired;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }
    
    /**
     * Stocks array containing pau_member fields
     * 
     * @param array $member
     */
    public function setExtra($member)
    {
        $this->extra = $member;
    }
    
    /**
     * Updates array containing pau_member fields
     * 
     * @param string $field
     * @param mixed $value
     */
    public function setExtraField($field, $value)
    {
        $this->extra[$field] = $value;
    }
    
    /**
     * Returns a given field value of current member
     * 
     * @param string $field. May be null
     * @return mixed
     */
    public function getExtra($field = null)
    {
        if ( !is_null($field) ) {
            return $this->extra[$field];
        }
        
        return $this->extra;
    }
    
    /**
     * Returns a given field value of current member
     * 
     * @param string $field
     * @return mixed
     */
    public function getExtraField($field)
    {
        return $this->getExtra($field);
    }
}
