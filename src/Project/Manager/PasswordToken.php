<?php

namespace Project\Manager;

class PasswordToken extends Manager
{
    protected $app,
              $repository;
    
    public function __construct($app) 
    {
        $this->app            = $app;
        $this->repository     = new \Project\Repository\PasswordToken($app['db']);
    }
    
    /**
     * Processes to new password token creation
     * @see AbstractToken
     * 
     * @param string $email Member email
     * @param int $expirationDurationInHours
     * @return string Token generated
     */
    function create($email, $expirationDurationInHours) 
    {
        $user = $this->app['manager.user']->findOneBy( 
            'email', $email, array('id') );
        
        return $this->store($this->generate(), $user['id'], $expirationDurationInHours);
    }
    
    /**
     * Verify token validity
     * 
     * @param string $token
     * @return boolean true if token is valid, false otherwise
     */
    function validate($token) 
    {
        $tokenRec = $this->repository->findOneBy('token', $token);
        
        if ( is_array($tokenRec) && $tokenRec['token'] == $token ) {
        
            // Token found, check date validity
            $expirationDate = new \DateTime($tokenRec['expiration_date']);
            
            if ( new \DateTime() <= $expirationDate ) { 
                return $tokenRec['user_id'];
            }
        }
        
        return false;
    }
    
    /**
     * Regenerates a new token for a member, from his old token
     * 
     * @param type $token Old token
     * @param type $expirationDurationInHours
     * @return boolean
     */
    function regenerate($token, $expirationDurationInHours) 
    {
        $tokenRec = $this->repository->findOneBy('token', $token);
        
        if ( is_array($tokenRec) && $tokenRec['token'] == $token ) {
            return $this->create($tokenRec['user_id'], $expirationDurationInHours);
        }
        
        return false;
    }
    
    public function store($token, $userId, $expirationDurationInHours)
    {
        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval(sprintf('PT%dH', $expirationDurationInHours)));
        
        $existingEntry = $this->repository->findOneBy('user_id', $userId);
        $data = array(
            'token' => $token,
            'expiration_date' => $expirationDate->format('Y-m-d H:i:s')
        );
        if (is_array($existingEntry)) {
            $this->repository->update($data, array('user_id' => $userId));
        } else {
            $data['user_id'] = $userId;
            $this->repository->insert($data);
        }
        
        return $token;
    }
    
    public function generate()
    {
        return md5(uniqid());
    }
}