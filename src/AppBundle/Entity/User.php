<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MatrixAccount", mappedBy="owner", cascade={"remove"})
     */
    private $matrix_accounts;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ChildAccount", mappedBy="owner", cascade={"remove"})
     */
    private $child_accounts;

    public function __construct() {
        parent::__construct();
        $this->matrix_accounts = new ArrayCollection();
        $this->child_accounts = new ArrayCollection();
    }

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
     * Get matrix accounts
     *
     * @return ArrayCollection 
     */
    public function getMatrixAccounts() {
        return $this->matrix_accounts;
    }

    /**
     * Add matrix account
     *
     * @param MatrixAccount matrix_account
     */
    public function addMatrixAccount($matrix_account) {
        $this->matrix_accounts->add($matrix_account);
    }

    /**
     * Get child accounts
     *
     * @return ArrayCollection 
     */
    public function getChildAccounts() {
        return $this->child_accounts;
    }

    /**
     * Add child account
     *
     * @param ChildAccount child_account
     */
    public function addChildAccount($child_account) {
        $this->matrix_accounts->add($child_account);
    }
}
