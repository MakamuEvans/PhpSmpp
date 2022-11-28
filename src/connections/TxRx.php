<?php


namespace makamuevans\PhpSmpp\connections;


trait TxRx
{
    public function transmit(string $sender, string $phone, string $message, $dataEncoding = \SMPP::DATA_CODING_DEFAULT)
    {
        $formattedData = $this->prepareData($phone, $sender, $message);
        $message_id = $this->smpp->sendSMS(
            $formattedData->sender,
            $formattedData->phone,
            $formattedData->message,
            null, $dataEncoding);
        return $message_id;
    }

    public function receive()
    {
        $response = $this->smpp->readSMS();
        //$this->closeConnection();
        return $response;
    }
}