<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupplierRepository")
 */
class Supplier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Link", mappedBy="supplier")
     **/
    private $suppliers;


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
     * Set name
     *
     * @param string $name
     *
     * @return Supplier
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->suppliers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add supplier
     *
     * @param \AppBundle\Entity\Link $supplier
     *
     * @return Supplier
     */
    public function addSupplier(\AppBundle\Entity\Link $supplier)
    {
        $this->suppliers[] = $supplier;

        return $this;
    }

    /**
     * Remove supplier
     *
     * @param \AppBundle\Entity\Link $supplier
     */
    public function removeSupplier(\AppBundle\Entity\Link $supplier)
    {
        $this->suppliers->removeElement($supplier);
    }

    /**
     * Get suppliers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }
}
