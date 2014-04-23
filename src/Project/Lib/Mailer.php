<?php

namespace Project\Lib;

class Mailer
{
    protected $app;
    
    function __construct($app) 
    {
        $this->app = $app;
    }
    
    /**
     * Sends an email to the new member to validate his subscription
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendSubscriptionConfirmationEmail(array $member, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($member['email'] => $member['prenom'] . ' ' . $member['nom']));
        $sender->title($this->app['translator']->trans('mail.subscriptionConfirmation.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to the new member to inform him that his account as been created
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendSubscriptionValidationEmail(array $member, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($member['email'] => $member['prenom'] . ' ' . $member['nom']));
        $sender->title($this->app['translator']->trans('mail.subscriptionValidation.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to a member to reinitialize his passextends Abstactword
     * 
     * @param string $email Member email
     * @param string $template Twig template content used for this email
     */
    public function sendLostPasswordEmail($email, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($email => $email));
        $sender->title($this->app['translator']->trans('mail.lostPassword.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to a tombola winner
     * 
     * @param string $email Email of the winner
     * @param string $template Twig template content used for this email
     */
    public function sendTombolaWinnerEmail($email, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($email => $email));
        $sender->title($this->app['translator']->trans('mail.tombolaWinner.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to a tombola looser
     * 
     * @param string $email Email of the looser
     * @param string $template Twig template content used for this email
     */
    public function sendTombolaLooserEmail($email, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($email => $email));
        $sender->title($this->app['translator']->trans('mail.tombolaLooser.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to invite a potential godchild
     * 
     * @param string $email Email where to send invitation
     * @param string $template Twig template content used for this email
     */
    public function sendTellAFriendEmail($email, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($email => $email));
        $sender->title($this->app['translator']->trans('mail.tellAFriend.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to the new member just registered with facebook
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendFacebookSubscriptionEmail(array $member, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($member['email'] => $member['prenom'] . ' ' . $member['nom']));
        $sender->title($this->app['translator']->trans('mail.facebookSubscription.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to a member who has just get a gift
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendGiftEmail(array $member, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($member['email'] => $member['prenom'] . ' ' . $member['nom']));
        $sender->title($this->app['translator']->trans('mail.gift.object'));
        $sender->setContent($template);
        $sender->send();
    }
    
    /**
     * Sends an email to a member who has just get a gift with a code
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendGiftCodeEmail(array $member, $template)
    {
        $this->sendGiftEmail($member, $template);
    }
    
    /**
     * Sends an email to a member who has just get a gift with a downbload link
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendGiftLinkEmail(array $member, $template)
    {
        $this->sendGiftEmail($member, $template);
    }
    
    /**
     * Sends an email to a member who has just won a gift on an event draw
     * 
     * @param array $member Member entity as an array
     * @param string $template Twig template content used for this email
     */
    public function sendEventWinnerEmail($email, $template)
    {
        $sender = new Sender();
        $sender->from($this->app['global.conf']['general']['mailer']['from']);
        $sender->to(array($email => $email));
        $sender->title($this->app['translator']->trans('mail.eventWinner.object'));
        $sender->setContent($template);
        $sender->send();
    }
}