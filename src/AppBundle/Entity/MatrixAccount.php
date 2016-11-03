<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MatrixAccount
 *
 * @ORM\Table(name="matrix_account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatrixAccountRepository")
 */
class MatrixAccount
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
     * @var int
     * @ORM\Column(name="code", type="integer", unique=true)
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=40)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var AccountType
     *
     * @ORM\ManyToOne(targetEntity="AccountType", inversedBy="matrix_accounts")
     * @ORM\JoinColumn(name="account_type_id", referencedColumnName="id")
     */
    private $account_type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ChildAccount", mappedBy="matrix_account", cascade={"remove"})
     */
    private $child_accounts;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="matrix_accounts")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    public function __construct() {
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
     * Set code
     *
     * @param integer $code
     * @return MatrixAccount
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return MatrixAccount
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
     * Set accountType
     *
     * @param AccountType $accountType
     * @return MatrixAccount
     */
    public function setAccountType($accountType)
    {
        $this->account_type = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return AccountType 
     */
    public function getAccountType()
    {
        return $this->account_type;
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
     * Attach child account to $this
     *
     * @param ChildAccount 
     */
    public function addChildAccount($child_account) {
        $this->child_accounts->add($child_account);
    }

    /**
     * Get owner
     *
     * @return User 
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * Set owner
     * @param User owner
     * @return MatrixAccount 
     */
    public function setOwner($owner) {
        $this->owner = $owner;

        return $this;
    }

    public function __toString() {
        return "$this->code. $this->name";
    }
}
