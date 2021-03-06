<?php

namespace Test\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SystemUser
 */
class SystemUser
{
    /**
     * @var integer
     */
    private $SystemUserId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $watertanks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->watertanks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get SystemUserId
     *
     * @return integer 
     */
    public function getSystemUserId()
    {
        return $this->SystemUserId;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return SystemUser
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add watertanks
     *
     * @param \Test\TestBundle\Entity\Watertank $watertanks
     * @return SystemUser
     */
    public function addWatertank(\Test\TestBundle\Entity\Watertank $watertanks)
    {
        $this->watertanks[] = $watertanks;
    
        return $this;
    }

    /**
     * Remove watertanks
     *
     * @param \Test\TestBundle\Entity\Watertank $watertanks
     */
    public function removeWatertank(\Test\TestBundle\Entity\Watertank $watertanks)
    {
        $this->watertanks->removeElement($watertanks);
    }

    /**
     * Get watertanks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWatertanks()
    {
        return $this->watertanks;
    }
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}