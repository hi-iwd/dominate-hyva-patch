<?php

namespace IWD\CheckoutHyvaPatch\Block\Cart\Payment;

use IWD\CheckoutConnector\Model\Ui\IWDCheckoutPayConfigProvider;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class PayPalCreditMsg extends Template
{
    /**
     * @var IWDCheckoutPayConfigProvider
     */
    private $configProvider;

    /**
     * @var JsonHelper
     */
    private $jsonHelper;


    /**
     * PayPalCreditMsg constructor.
     * @param Context $context
     * @param IWDCheckoutPayConfigProvider $configProvider
     * @param JsonHelper $jsonHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        IWDCheckoutPayConfigProvider $configProvider,
        JsonHelper $jsonHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->configProvider = $configProvider;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPayPalCreditMsgConfig()
    {
        $config = $this->configProvider;

        return $this->jsonHelper->jsonEncode([
            'status'             => $config->getConfigData('paypal_credit_status'),
            'container_id'       => $config->getGeneratedContainerId(),
            'grand_total_amount' => $this->priceFormat($config->getGrandTotalAmount()),
            'subtotal'           => $this->priceFormat($config->getQuote()->getSubtotal()),
            'logo_type'          => $config->getConfigData('credit_msg_logo_type'),
            'logo_position'      => $config->getConfigData('credit_msg_logo_position'),
            'text_color'         => $config->getConfigData('credit_msg_text_color'),
        ]);
    }

    /**
     * @param $price
     * @return string
     */
    public function priceFormat($price)
    {
        return number_format($price, 2, '.', '');
    }
}
