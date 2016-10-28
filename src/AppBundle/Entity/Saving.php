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
}

