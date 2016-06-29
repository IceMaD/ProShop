<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfigRepository")
 */
class Config
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
     * @ORM\Column(name="discriminator", type="string", length=255)
     */
    private $discriminator;

    /**
     * @var int
     *
     * @ORM\Column(name="budget_auto", type="integer")
     */
    private $budgetAuto;

    /**
     * @var array
     *
     * @ORM\Column(name="suppliers", type="array")
     */
    private $suppliers;

    /**
     * @var bool
     *
     * @ORM\Column(name="suppliers_type", type="boolean")
     */
    private $suppliersType;

    /**
     * @var array
     *
     * @ORM\Column(name="brands", type="array")
     */
    private $brands;

    /**
     * @var bool
     *
     * @ORM\Column(name="brands_type", type="boolean")
     */
    private $brandsType;

    /**
     * @ORM\OneToOne(targetEntity="Team", cascade={"persist"})
     */
    private $team;

    /**
     * @ORM\OneToOne(targetEntity="Wishlist", cascade={"persist"})
     */
    private $wishlist;


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
     * Set discriminator
     *
     * @param string $discriminator
     *
     * @return Config
     */
    public function setDiscriminator($discriminator)
    {
        $this->discriminator = $discriminator;

        return $this;
    }

    /**
     * Get discriminator
     *
     * @return string
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }

    /**
     * Set budgetAuto
     *
     * @param integer $budgetAuto
     *
     * @return Config
     */
    public function setBudgetAuto($budgetAuto)
    {
        $this->budgetAuto = $budgetAuto;

        return $this;
    }

    /**
     * Get budgetAuto
     *
     * @return int
     */
    public function getBudgetAuto()
    {
        return $this->budgetAuto;
    }

    /**
     * Set suppliers
     *
     * @param array $suppliers
     *
     * @return Config
     */
    public function setSuppliers($suppliers)
    {
        $this->suppliers = $suppliers;

        return $this;
    }

    /**
     * Get suppliers
     *
     * @return array
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }

    /**
     * Set suppliersType
     *
     * @param boolean $suppliersType
     *
     * @return Config
     */
    public function setSuppliersType($suppliersType)
    {
        $this->suppliersType = $suppliersType;

        return $this;
    }

    /**
     * Get suppliersType
     *
     * @return bool
     */
    public function getSuppliersType()
    {
        return $this->suppliersType;
    }

    /**
     * Set brands
     *
     * @param array $brands
     *
     * @return Config
     */
    public function setBrands($brands)
    {
        $this->brands = $brands;

        return $this;
    }

    /**
     * Get brands
     *
     * @return array
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * Set brandsType
     *
     * @param boolean $brandsType
     *
     * @return Config
     */
    public function setBrandsType($brandsType)
    {
        $this->brandsType = $brandsType;

        return $this;
    }

    /**
     * Get brandsType
     *
     * @return bool
     */
    public function getBrandsType()
    {
        return $this->brandsType;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return Config
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set wishlist
     *
     * @param \AppBundle\Entity\Wishlist $wishlist
     *
     * @return Config
     */
    public function setWishlist(\AppBundle\Entity\Wishlist $wishlist = null)
    {
        $this->wishlist = $wishlist;

        return $this;
    }

    /**
     * Get wishlist
     *
     * @return \AppBundle\Entity\Wishlist
     */
    public function getWishlist()
    {
        return $this->wishlist;
    }
}
