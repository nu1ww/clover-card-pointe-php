<?php

namespace Nu1ww\CardConnect\Responses;

use Nu1ww\CardConnect\Responses\Traits\ChecksSuccess;
use Nu1ww\CardConnect\Responses\Traits\ConvertsNumbers;

class Response extends Fluent
{
    use ChecksSuccess;
    use ConvertsNumbers;

    public function __construct(array $res)
    {
        parent::__construct($res);
        $this->convertNumbers();
    }
}
