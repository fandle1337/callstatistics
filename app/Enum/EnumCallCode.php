<?php

namespace App\Enum;

enum EnumCallCode: int
{
    case SUCCESSED = 200;
    case MISSED = 304;
    case REJECTED = 603;
    case FORBIDDEN = 403;
    case WRONG = 404;
    case BUSY = 486;
    case UNAVAILABLE = 480;
    case INSUFFICIENT_FUNDS = 402;
    case BLOCKED = 423;
}
