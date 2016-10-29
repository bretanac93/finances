<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FinancialPosition
 *
 * @ORM\Table(name="financial_position")
 * @ORM\MappedSuperclass
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({ 
        "income" = "Income", 
        "debit" = "Debit", 
        "expenditure" = "Expenditure", 
        "saving" = "Saving",
        "amortization" = "Amortization"
    })
 */
abstract class FinancialPosition
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
     * @var ChildAccount
     * @ORM\ManyToOne(targetEntity="ChildAccount", inversedBy="financial_positions")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    protected $account;


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
     * Set account
     *
     * @param ChildAccount $account
     *
     * @return FinancialPosition
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return ChildAccount
     */
    public function getAccount()
    {
        return $this->account;
    }
}

