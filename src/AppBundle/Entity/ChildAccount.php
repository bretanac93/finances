<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ChildAccount
 *
 * @ORM\Table(name="child_account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChildAccountRepository")
 */
class ChildAccount
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
     * @Assert\NotBlank()
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var MatrixAccount
     *
     * @ORM\ManyToOne(targetEntity="MatrixAccount", inversedBy="child_accounts")
     * @ORM\JoinColumn(name="matrix_account_id", referencedColumnName="id")
     */
    private $matrix_account;

    /**
     * @var string Only when matrix account is `Objetivos de ahorro`
     * 
     * @ORM\Column(name="purpose", type="text", nullable=true)
     */
    private $purpose;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="matrix_accounts")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

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
     * @param string $code
     * @return ChildAccount
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ChildAccount
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
     * Set matrixAccount
     *
     * @param MatrixAccount $matrixAccount
     * @return ChildAccount
     */
    public function setMatrixAccount($matrixAccount)
    {
        $this->matrix_account = $matrixAccount;

        return $this;
    }

    /**
     * Get matrixAccount
     *
     * @return MatrixAccount 
     */
    public function getMatrixAccount()
    {
        return $this->matrix_account;
    }

    /**
     * Set purpose
     *
     * @param string $purpose
     * @return ChildAccount
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return string 
     */
    public function getPurpose()
    {
        return $this->purpose;
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
     * @return ChildAccount 
     */
    public function setOwner($owner) {
        $this->owner = $owner;

        return $this;
    }
}
