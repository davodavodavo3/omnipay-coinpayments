<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayRequest;

abstract class AbstractRequest extends OmnipayRequest
{
    protected $liveMerchantEndpoint = 'https://www.coinpayments.net/index.php';
    protected $liveApiEndpoint = 'https://www.coinpayments.net/index.php';


    protected function getMerchantEndpoint()
    {
        return $this->liveMerchantEndpoint;
    }
}
