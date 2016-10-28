<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Income
 *
 * @ORM\Table(name="income")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IncomeRepository")
 */
class Income
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
     * @ORM\Column(name="cash_entry", type="string", length=255)
     */
    private $cashEntry;

    /**
     * @var string
     *
     * @ORM\Column(name="entry_reason", type="string", length=255)
     */
    private $entryReason;

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
     * Set cashEntry
     *
     * @param string $cashEntry
     *
     * @return Income
     */
    public function setCashEntry($cashEntry)
    {
        $this->cashEntry = $cashEntry;

        return $this;
    }

    /**
     * Get cashEntry
     *
     * @return string
     */
    public function getCashEntry()
    {
        return $this->cashEntry;
    }

    /**
     * Set entryReason
     *
     * @param string $entryReason
     *
     * @return Income
     */
    public function setEntryReason($entryReason)
    {
        $this->entryReason = $entryReason;

        return $this;
    }

    /**
     * Get entryReason
     *
     * @return string
     */
    public function getEntryReason()
    {
        return $this->entryReason;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Income
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
     * @return Income
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

