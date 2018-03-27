<?php

namespace Omnipay\Vantiv\Message;

class RefundRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $endPoint =  $this->getTestMode() ? $this->testHost : $this->host;
        return $endPoint . '/VoidSaleByRecordNo';
    }

    public function getData()
    {
        $this->validate('amount', 'transactionReference');

        $transactionReference = json_decode($this->getTransactionReference());

        $data = [
            'InvoiceNo' => $transactionReference->InvoiceNo,
            'RefNo' => $transactionReference->RefNo,
            'Memo' => $transactionReference->Memo,
            'Name' => 'MPS TEST',
            'Purchase' => $this->getAmount(),
            'AuthCode' => $transactionReference->AuthCode,
            'Frequency' => 'Recurring',
            'RecordNo' => $transactionReference->RecordNo,
            'AcqRefData' => $transactionReference->AcqRefData,
            'ProcessData' => $transactionReference->ProcessData,
            'TerminalName' => 'MPS Terminal',
            'ShiftID' => 'MPS Shift',
            'OperatorID' => 'MPS Operator',
        ];

        return json_encode($data);
    }
}
