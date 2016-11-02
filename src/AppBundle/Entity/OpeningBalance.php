<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpeningBalance
 *
 * @ORM\Table(name="opening_balance")
 * @ORM\MappedSuperclass
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
    "debt" = "Debt",
    "right_goods" = "RightGoods",
    "saving_plan" = "SavingPlan",
    })
 */
abstract class OpeningBalance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ChildAccount
     * @ORM\ManyToOne(targetEntity="ChildAccount", inversedBy="opening_balance")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    protected $account;

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
     * @param ChildAccount $account
     *
     * @return OpeningBalance
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return ChildAccount
     */
    public function getAccount()
    {
        return $this->account;
    }
}

