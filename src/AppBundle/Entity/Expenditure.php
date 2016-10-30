<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expenditure
 *
 * @ORM\Table(name="expenditure")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpenditureRepository")
 */
class Expenditure extends FinancialPosition
{

    /**
     * @var string
     *
     * @ORM\Column(name="expenditureAccount", type="string", length=255)
     */
    private $expenditureAccount;

    /**
     * @var float
     *
     * @ORM\Column(name="planned", type="float")
     */
    private $planned;

    /**
     * @var float
     *
     * @ORM\Column(name="totalExpenditure", type="float")
     */
    private $totalExpenditure;

    /**
     * @var float
     *
     * @ORM\Column(name="totalExcessive", type="float")
     */
    private $totalExcessive;

    /**
     * @var float
     *
     * @ORM\Column(name="subTotalExcessive", type="float")
     */
    private $subTotalExcessive;

    /**
     * Set planned
     *
     * @param float $planned
     *
     * @return Expenditure
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
     * Set expenditureAccount
     *
     * @param string $expenditureAccount
     *
     * @return Expenditure
     */
    public function setExpenditureAccount($expenditureAccount)
    {
        $this->expenditureAccount = $expenditureAccount;

        return $this;
    }

    /**
     * Get expenditureAccount
     *
     * @return string
     */
    public function getExpenditureAccount()
    {
        return $this->expenditureAccount;
    }

    /**
     * Set totalExpenditure
     *
     * @param float $totalExpenditure
     *
     * @return Expenditure
     */
    public function setTotalExpenditure($totalExpenditure)
    {
        $this->totalExpenditure = $totalExpenditure;

        return $this;
    }

    /**
     * Get totalExpenditure
     *
     * @return float
     */
    public function getTotalExpenditure()
    {
        return $this->totalExpenditure;
    }

    /**
     * Set totalExcessive
     *
     * @param float $totalExcessive
     *
     * @return Expenditure
     */
    public function setTotalExcessive($totalExcessive)
    {
        $this->totalExcessive = $totalExcessive;

        return $this;
    }

    /**
     * Get totalExcessive
     *
     * @return float
     */
    public function getTotalExcessive()
    {
        return $this->totalExcessive;
    }

    /**
     * Set subTotalExcessive
     *
     * @param float $subTotalExcessive
     *
     * @return Expenditure
     */
    public function setSubTotalExcessive($subTotalExcessive)
    {
        $this->subTotalExcessive = $subTotalExcessive;

        return $this;
    }

    /**
     * Get subTotalExcessive
     *
     * @return float
     */
    public function getSubTotalExcessive()
    {
        return $this->subTotalExcessive;
    }
}
