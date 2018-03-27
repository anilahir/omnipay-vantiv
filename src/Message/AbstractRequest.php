<?php

namespace  Omnipay\Vantiv\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $host = 'https://w1.mercurypay.com/PaymentsAPI/Credit';
    protected $testHost = 'https://w1.mercurycert.net/PaymentsAPI/Credit';
    protected $endpoint = '';

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testHost : $this->host;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
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

    public function getPaymentMethod()
    {
        return $this->getParameter('payment_method');
    }

    public function setPaymentMethod($value)
    {
        return $this->setParameter('payment_method', $value);
    }

    public function getPaymentProfile()
    {
        return $this->getParameter('payment_profile');
    }

    public function setPaymentProfile($value)
    {
        return $this->setParameter('payment_profile', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('order_number');
    }

    public function setOrderNumber($value)
    {
        return $this->setParameter('order_number', $value);
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        $header = base64_encode($this->getUsername() . ':' . $this->getPassword());

        // Don't throe exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        if(!empty($data)) {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                null,
                $data
            );
        }
        else {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint()
            );
        }

        $httpResponse = $httpRequest
            ->setHeader(
                'Content-Type',
                'application/json'
            )
            ->setHeader(
                'Authorization',
                $header
            )
            ->send();

        return $this->response = new Response($this, $httpResponse->json());
    }
}

