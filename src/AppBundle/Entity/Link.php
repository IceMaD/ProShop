<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Link
 *
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinkRepository")
 */
class Link
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
    private $url;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="Demand", mappedBy="link")
     **/
    private $demands;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="links")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="suppliers")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     **/
    private $supplier;


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
     * Set url
     *
     * @param string $url
     *
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Link
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->demands = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add demand
     *
     * @param \AppBundle\Entity\Demand $demand
     *
     * @return Link
     */
    public function addDemand(\AppBundle\Entity\Demand $demand)
    {
        $this->demands[] = $demand;

        return $this;
    }

    /**
     * Remove demand
     *
     * @param \AppBundle\Entity\Demand $demand
     */
    public function removeDemand(\AppBundle\Entity\Demand $demand)
    {
        $this->demands->removeElement($demand);
    }

    /**
     * Get demands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemands()
    {
        return $this->demands;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Link
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set supplier
     *
     * @param \AppBundle\Entity\Supplier $supplier
     *
     * @return Link
     */
    public function setSupplier(\AppBundle\Entity\Supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \AppBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
}
