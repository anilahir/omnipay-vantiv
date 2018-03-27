<?php

namespace Omnipay\Vantiv;

use Omnipay\Common\AbstractGateway;

/**
 * Vantiv Gateway
 * @link https://developer.vantiv.com/docs/DOC-1338
 */

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Vantiv';
    }

    public function getDefaultParameters()
    {
        return [
            'username' => '',
            'password' => ''
        ];
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Vantiv\Message\CreateCardRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Vantiv\Message\PurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Vantiv\Message\RefundRequest', $parameters);
    }
}

