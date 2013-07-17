<?php

namespace Test\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BBB
 */
class BBB
{
    /**
     * @var integer
     */
    private $bbbid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $aaas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aaas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get bbbid
     *
     * @return integer 
     */
    public function getBbbid()
    {
        return $this->bbbid;
    }

    /**
     * Add aaas
     *
     * @param \Test\TestBundle\Entity\AAA $aaas
     * @return BBB
     */
    public function addAaa(\Test\TestBundle\Entity\AAA $aaas)
    {
        $this->aaas[] = $aaas;
    
        return $this;
    }

    /**
     * Remove aaas
     *
     * @param \Test\TestBundle\Entity\AAA $aaas
     */
    public function removeAaa(\Test\TestBundle\Entity\AAA $aaas)
    {
        $this->aaas->removeElement($aaas);
    }

    /**
     * Get aaas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAaas()
    {
        return $this->aaas;
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
     * @return BBB
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