<?php

namespace Omnipay\CoinPayments\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchant_id', $value);
    }

    public function getPrivateKey()
    {
        return $this->getParameter('private_key');
    }

    public function setPrivateKey($value)
    {
        return $this->setParameter('private_key', $value);
    }

    public function getPublicKey()
    {
        return $this->getParameter('public_key');
    }

    public function setPublicKey($value)
    {
        return $this->setParameter('public_key', $value);
    }
	
	public function getIpnSecret()
    {
        return $this->getParameter('ipn_secret');
    }

    public function setIpnSecret($value)
    {
        return $this->setParameter('ipn_secret', $value);
    }

    public function getData()
    {
        $this->validate('merchant_id', 'private_key', 'public_key', 'ipn_secret');

        $arHash = [
            $this->getShopId(),
            $this->getTransactionId(),
            $this->getAmount(),
            $this->getCurrency(),
            base64_encode($this->getDescription()),
            $this->getShopSecret(),
        ];
        $sign = strtoupper(hash('sha256', implode(":", $arHash)));

        $data['m_shop'] = $this->getShopId();
        $data['m_orderid'] = $this->getTransactionId();
        $data['m_amount'] = $this->getAmount();
        $data['m_curr'] = $this->getCurrency();
        $data['m_desc'] = base64_encode($this->getDescription());
        $data['m_sign'] = $sign;

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getMerchantEndpoint());
    }
}
