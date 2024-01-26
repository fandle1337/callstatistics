<?php

namespace App\Enum;

enum EnumCallType: int
{
    case OUTGOING = 1;
    case INCOMING = 2;
    case INCOMING_WITH_REDIRECTION = 3;
}
