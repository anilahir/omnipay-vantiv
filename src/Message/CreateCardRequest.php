<?php

namespace Omnipay\Vantiv\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $endPoint =  $this->getTestMode() ? $this->testHost : $this->host;
        return $endPoint . '/ZeroAuth';
    }

    public function getData()
    {
        $data = [];
        $this->getCard()->validate();

        if($this->getCard()) {

            $data = [
                'InvoiceNo' => 1,
                'RefNo' => 1,
                'Memo' => 'MPS Example JSON v1.0',
                'Frequency' => 'Recurring',
                'RecordNo' => 'RecordNumberRequested',
                'TerminalName' => 'MPS Terminal',
                'ShiftID' => 'MPS Shift',
                'OperatorID' => 'MPS Operator',
                'AcctNo' => $this->getCard()->getNumber(),
                'ExpDate' => $this->getCard()->getExpiryDate('my'),
                'Address' => $this->getCard()->getBillingAddress1(),
                'Zip' => $this->getCard()->getBillingPostcode(),
                'CVVData' => $this->getCard()->getCvv()
            ];
        }

        return json_encode($data);
    }
}
