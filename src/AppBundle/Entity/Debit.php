<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Debit
 *
 * @ORM\Table(name="debit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DebitRepository")
 */
class Debit
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
     * @ORM\Column(name="cash_withdrawal", type="string", length=255)
     */
    private $cashWithdrawal;

    /**
     * @var string
     *
     * @ORM\Column(name="withdrawal_reason", type="string", length=255)
     */
    private $withdrawalReason;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="brief_description", type="text")
     */
    private $briefDescription;


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
     * Set cashWithdrawal
     *
     * @param string $cashWithdrawal
     *
     * @return Expenditure
     */
    public function setCashWithdrawal($cashWithdrawal)
    {
        $this->cashWithdrawal = $cashWithdrawal;

        return $this;
    }

    /**
     * Get cashWithdrawal
     *
     * @return string
     */
    public function getCashWithdrawal()
    {
        return $this->cashWithdrawal;
    }

    /**
     * Set withdrawalReason
     *
     * @param string $withdrawalReason
     *
     * @return Expenditure
     */
    public function setWithdrawalReason($withdrawalReason)
    {
        $this->withdrawalReason = $withdrawalReason;

        return $this;
    }

    /**
     * Get withdrawalReason
     *
     * @return string
     */
    public function getWithdrawalReason()
    {
        return $this->withdrawalReason;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Expenditure
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set briefDescription
     *
     * @param string $briefDescription
     *
     * @return Expenditure
     */
    public function setBriefDescription($briefDescription)
    {
        $this->briefDescription = $briefDescription;

        return $this;
    }

    /**
     * Get briefDescription
     *
     * @return string
     */
    public function getBriefDescription()
    {
        return $this->briefDescription;
    }
}

