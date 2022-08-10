<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class MessageBuy {

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */

     private $firstname;
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */

     private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */

     private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */

    private $message;

    /**
     * @var int|null
     */
    private $idPoduct;


     /**
      * Get the value of firstname
      */ 
     public function getFirstname()
     {
          return $this->firstname;
     }

     /**
      * Set the value of firstname
      *
      * @return  self
      */ 
     public function setFirstname($firstname)
     {
          $this->firstname = $firstname;

          return $this;
     }

     /**
      * Get the value of lastname
      */ 
     public function getLastname()
     {
          return $this->lastname;
     }

     /**
      * Set the value of lastname
      *
      * @return  self
      */ 
     public function setLastname($lastname)
     {
          $this->lastname = $lastname;

          return $this;
     }

     /**
      * Get the value of email
      */ 
     public function getEmail()
     {
          return $this->email;
     }

     /**
      * Set the value of email
      *
      * @return  self
      */ 
     public function setEmail($email)
     {
          $this->email = $email;

          return $this;
     }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

 

    /**
     * Get the value of idPoduct
     *
     * @return  int|null
     */ 
    public function getIdPoduct()
    {
        return $this->idPoduct;
    }

    /**
     * Set the value of idPoduct
     *
     * @param  int|null  $idPoduct
     *
     * @return  self
     */ 
    public function setIdPoduct($idPoduct)
    {
        $this->idPoduct = $idPoduct;

        return $this;
    }
}

