<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Debt
 *
 * @ORM\Table(name="debt")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DebtRepository")
 */
class Debt extends OpeningBalance
{
    /**
     * @var string
     *
     * @ORM\Column(name="openingBalance", type="decimal", precision=10, scale=2)
     */
    private $openingBalance;

    /**
     * Set debtAmortizationAccount
     *
     * @param string $debtAmortizationAccount
     *
     * @return Debt
     */
    public function setDebtAmortizationAccount($debtAmortizationAccount)
    {
        $this->debtAmortizationAccount = $debtAmortizationAccount;

        return $this;
    }

    /**
     * Get debtAmortizationAccount
     *
     * @return string
     */
    public function getDebtAmortizationAccount()
    {
        return $this->debtAmortizationAccount;
    }

    /**
     * Set openingBalance
     *
     * @param string $openingBalance
     *
     * @return Debt
     */
    public function setOpeningBalance($openingBalance)
    {
        $this->openingBalance = $openingBalance;

        return $this;
    }

    /**
     * Get openingBalance
     *
     * @return string
     */
    public function getOpeningBalance()
    {
        return $this->openingBalance;
    }
}

