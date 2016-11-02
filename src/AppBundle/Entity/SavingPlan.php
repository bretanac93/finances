<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SavingPlan
 *
 * @ORM\Table(name="saving_plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SavingPlanRepository")
 */
class SavingPlan extends OpeningBalance
{
    /**
     * @var string
     *
     * @ORM\Column(name="openingBalance", type="decimal", precision=10, scale=2)
     */
    private $openingBalance;

    /**
     * Set savingTargetAccount
     *
     * @param string $savingTargetAccount
     *
     * @return SavingPlan
     */
    public function setSavingTargetAccount($savingTargetAccount)
    {
        $this->savingTargetAccount = $savingTargetAccount;

        return $this;
    }

    /**
     * Get savingTargetAccount
     *
     * @return string
     */
    public function getSavingTargetAccount()
    {
        return $this->savingTargetAccount;
    }

    /**
     * Set openingBalance
     *
     * @param string $openingBalance
     *
     * @return SavingPlan
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

