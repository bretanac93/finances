<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
}
