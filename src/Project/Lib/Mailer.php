<?php

namespace Project\Lib;

class Mailer
{
    protected $app,
              $mailer;
    
    function __construct($app) 
    {
        $this->app = $app;
        
        // Create the Transport
        $transport = \Swift_MailTransport::newInstance();

        // Create the Mailer using your created Transport
        $this->mailer = \Swift_Mailer::newInstance($transport);
    }
    
    /**
     * Sends an email to the new member to confirm his registration
     * 
     * @param array $user Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendRegistrationEmail($email, $template)
    {
        // Create
        $message = \Swift_Message::newInstance($this->app['translator']->trans('mail.signup.object'))
          ->setFrom(array($this->app['parameters']['mailer']['from']))
          ->setTo(array($email))
          ->setBody($template, 'text/html');

        // Send
        return $this->mailer->send($message);
    }
    
    /**
     * Sends an email to a member to reinitialize his password
     * 
     * @param string $email User email
     * @param string $template Twig template content used for this email
     */
    public function sendLostPasswordEmail($email, $template)
    {
        // Create
        $message = \Swift_Message::newInstance($this->app['translator']->trans('mail.lost_password.object'))
          ->setFrom(array($this->app['parameters']['mailer']['from']))
          ->setTo(array($email))
          ->setBody($template, 'text/html');

        // Send
        return $this->mailer->send($message);
    }
}