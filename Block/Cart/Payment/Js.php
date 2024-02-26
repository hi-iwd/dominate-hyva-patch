<?php

namespace IWD\CheckoutHyvaPatch\Block\Cart\Payment;

use IWD\CheckoutConnector\Block\Shortcut\PayPalButton;

class Js extends PayPalButton
{
    /**
     * @var string
     */
    private $containerId;

    /**
     * @var string
     */
    private $blockName;

    /**
     * @param $containerId
     */
    public function setLocalContainerId($containerId) {
        $this->containerId = $containerId;
    }

    /**
     * @return mixed
     */
    public function getLocalContainerId() {
        return $this->containerId;
    }

    /**
     * @param $blockName
     */
    public function setBlockName($blockName) {
        $this->blockName = $blockName;
    }

    /**
     * @return string
     */
    public function getBlockName() {
        return $this->blockName;
    }
}
