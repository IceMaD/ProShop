<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Wishlist", mappedBy="owner")
     **/
    private $wishlists;

    public function __construct()
    {
        $this->wishlists = new ArrayCollection();
    }


    /**
     * Add wishlist
     *
     * @param \AppBundle\Entity\Wishlist $wishlist
     *
     * @return User
     */
    public function addWishlist(\AppBundle\Entity\Wishlist $wishlist)
    {
        $this->wishlists[] = $wishlist;

        return $this;
    }

    /**
     * Remove wishlist
     *
     * @param \AppBundle\Entity\Wishlist $wishlist
     */
    public function removeWishlist(\AppBundle\Entity\Wishlist $wishlist)
    {
        $this->wishlists->removeElement($wishlist);
    }

    /**
     * Get wishlists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWishlists()
    {
        return $this->wishlists;
    }
}
