<?php


namespace makamuevans\PhpSmpp\core;

use makamuevans\PhpSmpp\connections\Connection;

require_once "smppclient.class.php";
require_once "gsmencoder.class.php";
require_once "sockettransport.class.php";


abstract class BaseSmpp
{
    protected $host;
    protected $port;
    protected $username;
    protected $password;

    /**
     * @var $transport \SocketTransport
     */
    protected $transport;

    /**
     * @var \SmppClient $smpp
     */
    protected $smpp;

    public function __construct(string $host, int $port, string $username, string $password,
                                int $receive_timeout = 10000, int $send_timeout = 10000)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;

        $this->smpp = $this->createSmppInstance($receive_timeout, $send_timeout);

    }

    private function createSmppInstance($receive_timeout, $send_timeout){
        $this->transport =  new \SocketTransport([$this->host], $this->port);
        $this->transport->setRecvTimeout($receive_timeout);
        $this->transport->setSendTimeout($send_timeout);
        return new \SmppClient($this->transport);
    }

    public function debug($status = false){
        $this->smpp->debug = $status;
        $this->transport->debug = $status;
    }

    public function openConnection(int $type){
        $this->transport->open();
        switch ($type){
            case Connection::CONNECTION_TX:
                $this->smpp->bindTransmitter($this->username, $this->password);
                break;
            case Connection::CONNECTION_RX:
                $this->smpp->bindReceiver($this->username, $this->password);
                break;
        }
    }

    public function closeConnection(){
        $this->smpp->close();
    }

    protected function prepareData(string $phone, string $sender, string $message){
        $message = \GsmEncoder::utf8_to_gsm0338($message);
        $sender = new \SmppAddress($sender, \SMPP::TON_ALPHANUMERIC);
        $phone = new \SmppAddress($phone, \SMPP::TON_INTERNATIONAL, \SMPP::NPI_E164);
        return (object)['phone'=>$phone,'sender'=>$sender,'message'=>$message];
    }
}