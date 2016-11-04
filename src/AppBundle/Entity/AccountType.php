<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AccountType
 *
 * @ORM\Table(name="account_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountTypeRepository")
 */
class AccountType
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="required_balance", type="string", length=20)
     * @Assert\NotBlank()
     */
    private $required_balance;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MatrixAccount", mappedBy="account_type", cascade={"remove"})
     */
    private $matrix_accounts;

    public function __construct() {
        $this->matrix_accounts = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return AccountType
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
     * Set requiredBalance
     *
     * @param string $requiredBalance
     * @return AccountType
     */
    public function setRequiredBalance($requiredBalance)
    {
        $this->required_balance = $requiredBalance;

        return $this;
    }

    /**
     * Get requiredBalance
     *
     * @return string 
     */
    public function getRequiredBalance()
    {
        return $this->required_balance;
    }
    
    /**
     * Get matrix_accounts
     *
     * @return ArrayCollection 
     */
    public function getMatrixAccounts() {
        return $this->matrix_accounts;
    }
    /**
     * Add matrix account
     *
     * @param MatrixAccount $matrix_account
     */
    public function addMatrixAccount($matrix_account) {
        $this->matrix_accounts->add($matrix_account);
    } 
    public function __toString() {
        return "$this->id. $this->name";
    }
}
