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
}

