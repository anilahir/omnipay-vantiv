<?php

namespace Omnipay\Vantiv\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $endPoint =  $this->getTestMode() ? $this->testHost : $this->host;
        return $endPoint . '/SaleByRecordNo';
    }

    public function getData()
    {
        $this->validate('amount');

        $data = [
            'InvoiceNo' => $this->getOrderNumber(),
            'RefNo' => 'Transaction_' . $this->getOrderNumber(),
            'Memo' => 'MPS Example JSON v1.0',
            'Purchase' => $this->getAmount()
        ];

        $paymentMethod = $this->getPaymentMethod();

        switch ($paymentMethod)
        {
            case 'card' :
                break;

            case 'payment_profile' :
                if ($this->getCardReference()) {
                    $data['Frequency'] = 'Recurring';
                    $data['RecordNo'] = $this->getCardReference();
                }
                break;

            case 'token' :
                break;

            default :
                break;
        }

        return json_encode($data);
    }
}

