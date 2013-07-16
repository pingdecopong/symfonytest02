<?php

namespace Test\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TBDepartment
 */
class TBDepartment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="5")
     */
    private $Name;

    /**
     * @var integer
     */
    private $SortNo;

    /**
     * @var boolean
     */
    private $DeleteFlug;

    /**
     * @var \DateTime
     */
    private $CreatedDatetime;

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
     * Set Name
     *
     * @param string $name
     * @return TBDepartment
     */
    public function setName($name)
    {
        $this->Name = $name;
    
        return $this;
    }

    /**
     * Get Name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set SortNo
     *
     * @param integer $sortNo
     * @return TBDepartment
     */
    public function setSortNo($sortNo)
    {
        $this->SortNo = $sortNo;
    
        return $this;
    }

    /**
     * Get SortNo
     *
     * @return integer 
     */
    public function getSortNo()
    {
        return $this->SortNo;
    }

    /**
     * Set DeleteFlug
     *
     * @param boolean $deleteFlug
     * @return TBDepartment
     */
    public function setDeleteFlug($deleteFlug)
    {
        $this->DeleteFlug = $deleteFlug;
    
        return $this;
    }

    /**
     * Get DeleteFlug
     *
     * @return boolean 
     */
    public function getDeleteFlug()
    {
        return $this->DeleteFlug;
    }

    /**
     * Set CreatedDatetime
     *
     * @param \DateTime $createdDatetime
     * @return TBDepartment
     */
    public function setCreatedDatetime($createdDatetime)
    {
        $this->CreatedDatetime = $createdDatetime;
    
        return $this;
    }

    /**
     * Get CreatedDatetime
     *
     * @return \DateTime 
     */
    public function getCreatedDatetime()
    {
        return $this->CreatedDatetime;
    }

    /**
     * @var string
     */
    private $Name2;


    /**
     * Set Name2
     *
     * @param string $name2
     * @return TBDepartment
     */
    public function setName2($name2)
    {
        $this->Name2 = $name2;
    
        return $this;
    }

    /**
     * Get Name2
     *
     * @return string 
     */
    public function getName2()
    {
        return $this->Name2;
    }
}