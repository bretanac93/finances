<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amortization
 *
 * @ORM\Table(name="amortization")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AmortizationRepository")
 */
class Amortization extends FinancialPosition
{

    /**
     * @var string
     *
     * @ORM\Column(name="amortizationAccount", type="string", length=255)
     */
    private $amortizationAccount;

    /**
     * @var float
     *
     * @ORM\Column(name="planned", type="float")
     */
    private $planned;

    /**
     * @var float
     *
     * @ORM\Column(name="totalAmortization", type="float")
     */
    private $totalAmortization;

    /**
     * @var float
     *
     * @ORM\Column(name="totalExcessive", type="float")
     */
    private $totalExcessive;

    

    /**
     * Set planned
     *
     * @param float $planned
     *
     * @return Amortization
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
     * Set amortizationAccount
     *
     * @param string $amortizationAccount
     *
     * @return Amortization
     */
    public function setAmortizationAccount($amortizationAccount)
    {
        $this->amortizationAccount = $amortizationAccount;

        return $this;
    }

    /**
     * Get amortizationAccount
     *
     * @return string
     */
    public function getAmortizationAccount()
    {
        return $this->amortizationAccount;
    }

    /**
     * Set totalAmortization
     *
     * @param float $totalAmortization
     *
     * @return Amortization
     */
    public function setTotalAmortization($totalAmortization)
    {
        $this->totalAmortization = $totalAmortization;

        return $this;
    }

    /**
     * Get totalAmortization
     *
     * @return float
     */
    public function getTotalAmortization()
    {
        return $this->totalAmortization;
    }

    /**
     * Set totalExcessive
     *
     * @param float $totalExcessive
     *
     * @return Amortization
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
}
