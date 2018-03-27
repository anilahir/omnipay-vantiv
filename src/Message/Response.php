<?php

namespace Omnipay\Vantiv\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return (isset($this->data['CmdStatus']) && $this->data['CmdStatus'] === "Approved");
    }

    public function getCardReference()
    {
        return isset($this->data['RecordNo']) ? $this->data['RecordNo'] : null;
    }

    public function getCode()
    {
        return isset($this->data['DSIXReturnCode']) ? $this->data['DSIXReturnCode'] : null;
    }

    public function getAuthCode()
    {
        return isset($this->data['AuthCode']) ? $this->data['AuthCode'] : null;
    }

    public function getTransactionId()
    {
        return isset($this->data['AcqRefData']) ? $this->data['AcqRefData'] : null;
    }

    public function getTransactionReference()
    {
        return isset($this->data['RefNo']) ? $this->data['RefNo'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['TextResponse']) ? $this->data['TextResponse'] : null;
    }

    public function getOrderNumber()
    {
        return isset($this->data['InvoiceNo']) ? $this->data['InvoiceNo'] : null;
    }

    public function getData()
    {
        return json_encode($this->data);
    }
}
