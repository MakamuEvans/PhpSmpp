<?php


namespace makamuevans\PhpSmpp;

use makamuevans\PhpSmpp\connections\TxRx;
use makamuevans\PhpSmpp\core\BaseSmpp;


class PhpSmpp extends BaseSmpp
{
    use TxRx;

}