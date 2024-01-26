<?php

namespace App\Helper;

use App\Enum\EnumQuarter;

class HelperQuarterDate
{
    public static function get(int $quarter, int $year): array
    {
        return match ($quarter) {
            EnumQuarter::FIRST->value => [
                'start' => $year . '-01-01 00:00:00',
                'end'   => $year . '-03-31 23:59:59',
            ],
            EnumQuarter::SECOND->value => [
                'start' => $year . '-04-01 00:00:00',
                'end'   => $year . '-06-30 23:59:59',
            ],
            EnumQuarter::THIRD->value => [
                'start' => $year . '-07-01 00:00:00',
                'end'   => $year . '-09-30 23:59:59',
            ],
            EnumQuarter::FOURTH->value => [
                'start' => $year . '-10-01 00:00:00',
                'end'   => $year . '-12-31 23:59:59',
            ],
            default => [
                'start' => $year . '-01-01 00:00:00',
                'end'   => $year . '-12-31 23:59:59',
            ],
        };
    }
}
