<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amortization
 *
 * @ORM\Table(name="amortization")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AmortizationRepository")
 */
class Amortization
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
     * @ORM\Column(name="account", type="string", length=255)
     */
    private $account;

    /**
     * @var float
     *
     * @ORM\Column(name="planned", type="float")
     */
    private $planned;


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
     * @param string $account
     *
     * @return Amortization
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

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

