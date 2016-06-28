<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Demand
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $techStatus;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255) 
     */
    private $finStatus;

    /**
     * @ORM\ManyToOne(targetEntity="Link", inversedBy="demands")
     * @ORM\JoinColumn(name="link_id", referencedColumnName="id")
     **/
    private $link;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Demand
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tStatus
     *
     * @param string $tStatus
     *
     * @return Demand
     */
    public function setTStatus($tStatus)
    {
        $this->tStatus = $tStatus;

        return $this;
    }

    /**
     * Get tStatus
     *
     * @return string
     */
    public function getTStatus()
    {
        return $this->tStatus;
    }

    /**
     * Set fStatus
     *
     * @param string $fStatus
     *
     * @return Demand
     */
    public function setFStatus($fStatus)
    {
        $this->fStatus = $fStatus;

        return $this;
    }

    /**
     * Get fStatus
     *
     * @return string
     */
    public function getFStatus()
    {
        return $this->fStatus;
    }

    /**
     * Set link
     *
     * @param \AppBundle\Entity\Link $link
     *
     * @return Demand
     */
    public function setLink(\AppBundle\Entity\Link $link = null)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return \AppBundle\Entity\Link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set techStatus
     *
     * @param string $techStatus
     *
     * @return Demand
     */
    public function setTechStatus($techStatus)
    {
        $this->techStatus = $techStatus;

        return $this;
    }

    /**
     * Get techStatus
     *
     * @return string
     */
    public function getTechStatus()
    {
        return $this->techStatus;
    }

    /**
     * Set finStatus
     *
     * @param string $finStatus
     *
     * @return Demand
     */
    public function setFinStatus($finStatus)
    {
        $this->finStatus = $finStatus;

        return $this;
    }

    /**
     * Get finStatus
     *
     * @return string
     */
    public function getFinStatus()
    {
        return $this->finStatus;
    }
}
