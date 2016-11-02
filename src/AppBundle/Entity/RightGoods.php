<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RightGoods
 *
 * @ORM\Table(name="right_goods")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RightGoodsRepository")
 */
class RightGoods extends OpeningBalance
{
    /**
     * @var string
     *
     * @ORM\Column(name="openingBalance", type="decimal", precision=10, scale=2)
     */
    private $openingBalance;

    /**
     * Set rightGoodsAccount
     *
     * @param string $rightGoodsAccount
     *
     * @return RightGoods
     */
    public function setRightGoodsAccount($rightGoodsAccount)
    {
        $this->rightGoodsAccount = $rightGoodsAccount;

        return $this;
    }

    /**
     * Get rightGoodsAccount
     *
     * @return string
     */
    public function getRightGoodsAccount()
    {
        return $this->rightGoodsAccount;
    }

    /**
     * Set openingBalance
     *
     * @param string $openingBalance
     *
     * @return RightGoods
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

