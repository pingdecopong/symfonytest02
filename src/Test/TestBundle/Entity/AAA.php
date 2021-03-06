<?php

namespace Test\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AAA
 */
class AAA
{
    /**
     * @var integer
     */
    private $aaaid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bbbs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bbbs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get aaaid
     *
     * @return integer 
     */
    public function getAaaid()
    {
        return $this->aaaid;
    }

    /**
     * Add bbbs
     *
     * @param \Test\TestBundle\Entity\BBB $bbbs
     * @return AAA
     */
    public function addBbb(\Test\TestBundle\Entity\BBB $bbbs)
    {
        $this->bbbs[] = $bbbs;
    
        return $this;
    }

    /**
     * Remove bbbs
     *
     * @param \Test\TestBundle\Entity\BBB $bbbs
     */
    public function removeBbb(\Test\TestBundle\Entity\BBB $bbbs)
    {
        $this->bbbs->removeElement($bbbs);
    }

    /**
     * Get bbbs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBbbs()
    {
        return $this->bbbs;
    }
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return AAA
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}