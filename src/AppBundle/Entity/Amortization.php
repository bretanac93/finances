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
     * @var float
     *
     * @ORM\Column(name="planned", type="float")
     */
    private $planned;

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
}

