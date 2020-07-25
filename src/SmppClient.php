<?php


namespace makamuevans\PhpSmpp;

use makamuevans\PhpSmpp\connections\TxRx;
use makamuevans\PhpSmpp\core\BaseSmpp;


class SmppClient extends BaseSmpp
{
    use TxRx;

}