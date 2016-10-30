<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saving
 *
 * @ORM\Table(name="saving")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SavingRepository")
 */
class Saving extends FinancialPosition
{

    /**
     * @var string
     *
     * @ORM\Column(name="savingAccount", type="string", length=255)
     */
    private $savingAccount;

    /**
     * @var float
     *
     * @ORM\Column(name="planned", type="float")
     */
    private $planned;

    /**
     * @var float
     *
     * @ORM\Column(name="totalSaving", type="float")
     */
    private $totalSaving;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float")
     */
    private $balance;


    /**
     * Set planned
     *
     * @param float $planned
     *
     * @return Saving
     */
    public function setPlanned($planned)
    {
        $this->planned = $planned;

        return $this;
    }

    /**
     * Get planned
     *
     * @return float
     */
    public function getPlanned()
    {
        return $this->planned;
    }

    /**
     * Set savingAccount
     *
     * @param string $savingAccount
     *
     * @return Saving
     */
    public function setSavingAccount($savingAccount)
    {
        $this->savingAccount = $savingAccount;

        return $this;
    }

    /**
     * Get savingAccount
     *
     * @return string
     */
    public function getSavingAccount()
    {
        return $this->savingAccount;
    }

    /**
     * Set totalSaving
     *
     * @param float $totalSaving
     *
     * @return Saving
     */
    public function setTotalSaving($totalSaving)
    {
        $this->totalSaving = $totalSaving;

        return $this;
    }

    /**
     * Get totalSaving
     *
     * @return float
     */
    public function getTotalSaving()
    {
        return $this->totalSaving;
    }

    /**
     * Set balance
     *
     * @param float $balance
     *
     * @return Saving
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }
}
