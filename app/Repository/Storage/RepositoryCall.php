<?php

namespace App\Repository\Storage;

use App\Dto\DtoCall;
use App\Dto\DtoCost;
use App\Dto\DtoGraphMonth;
use App\Dto\DtoNumberSector;
use App\Dto\DtoResponsibleSector;
use App\Dto\DtoTableRow;
use App\Enum\EnumCallCode;
use App\Enum\EnumCallType;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Models\PortalCall;
use Carbon\Carbon;

class RepositoryCall implements InterfaceRepositoryCall
{
    public function getTotalByPortalId(int $portalId): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->count();
    }

    public function getCountForTotalCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->count();
    }

    public function getSecondsForTotalCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->sum('duration');
    }

    public function getCountForIncomingCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->whereIn('type_id', [
                EnumCallType::INCOMING->value,
                EnumCallType::INCOMING_WITH_REDIRECTION->value,
            ])->count();
    }

    public function getSecondsForIncomingCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->whereIn('type_id', [
                EnumCallType::INCOMING->value,
                EnumCallType::INCOMING_WITH_REDIRECTION->value,
            ])->sum('duration');
    }

    public function getCountForOutgoingCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->where('type_id', EnumCallType::OUTGOING->value)->count();
    }

    public function getSecondsForOutgoingCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->where('type_id', EnumCallType::OUTGOING->value)->sum('duration');
    }

    public function getCountForMissedCalls(int $portalId, array $date): int
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->where('code_id', EnumCallCode::MISSED->value)->count();
    }

    public function getCountAndCurrencyForCosts(int $portalId, array $date): array
    {
        $response = PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->get()
            ->groupBy('cost_currency');

        $currencyOrder = ['RUR', 'USD', 'EUR'];

        $response = $response->sortBy(function ($calls, $currency) use ($currencyOrder) {
            return array_search($currency, $currencyOrder);
        });

        foreach ($response as $currency => $calls) {
            $costs[] = new DtoCost(
                count: $calls->sum('cost'),
                currency: $currency,
            );
        }
        return $costs ?? [];
    }

    /**
     * @param int $portalId
     * @param array $date
     * @return bool|DtoGraphMonth[]
     */
    public function getGraphStatistics(int $portalId, array $date): bool|array
    {
        $response = PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->get()
            ->groupBy(function ($row) {
                return \Carbon\Carbon::parse($row['date'])->format('Y-m');
            });

        if (empty($response)) {
            return [];
        }

        $response = $response->sortKeys();

        foreach ($response as $month => $calls) {
            $incomingCalls = $calls->whereIn('type_id', [
                EnumCallType::INCOMING->value,
                EnumCallType::INCOMING_WITH_REDIRECTION->value,
            ])->count();
            $outgoingCalls = $calls->where('type_id', EnumCallType::OUTGOING->value)->count();
            $missedCalls = $calls->where('code_id', EnumCallCode::MISSED->value)->count();

            $result[] = new DtoGraphMonth(
                date: round(strtotime($month) * 1000),
                incomingCalls: $incomingCalls,
                outgoingCalls: $outgoingCalls,
                missedCalls: $missedCalls,
            );
        }

        return $result ?? [];
    }

    public function getResponsibleStatistics(int $portalId, array $date): bool|array
    {
        $response = PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->get()
            ->groupBy('user_id');

        $response = $response->sortKeys();

        foreach ($response as $userId => $calls) {
            $totalCalls = $calls->count();

            $result[] = new DtoResponsibleSector(
                id: (int)$userId,
                count: $totalCalls,
            );
        }

        return $result ?? [];
    }

    public function getNumberStatistics(int $portalId, array $date): bool|array
    {
        $response = PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->get()
            ->groupBy('portal_number');

        foreach ($response as $number => $calls) {
            $result[] = new DtoNumberSector(
                name: $number,
                count: $calls->count(),
            );
        }

        return $result ?? [];
    }

    public function getTableStatistics(int $portalId, array $date): bool|array
    {
        $response = PortalCall::where('portal_id', $portalId)
            ->whereBetween('date', $date)
            ->get()
            ->groupBy('user_id');

        $response = $response->sortKeys();

        foreach ($response as $userId => $calls) {
            $result[] = new DtoTableRow(
                id: (int)$userId,
                totalCalls: $calls->count(),
                incomingCalls: $calls->whereIn('type_id', [
                    EnumCallType::INCOMING->value,
                    EnumCallType::INCOMING_WITH_REDIRECTION->value,
                ])->count(),
                outgoingCalls: $calls->where('type_id', EnumCallType::OUTGOING->value)->count(),
                missedCalls: $calls->where('code_id', EnumCallCode::MISSED->value)->count(),
                totalDuration: $calls->sum('duration'),
                cost: $calls->sum('cost'),
            );
        }

        return $result ?? [];
    }

    public function deleteAllByPortalId(int $portalId): bool
    {
        return PortalCall::where('portal_id', $portalId)
            ->delete();
    }

    public function add(DtoCall $dtoCall): bool
    {
        return PortalCall::create([
                'portal_id'     => $dtoCall->portalId,
                'call_id'       => $dtoCall->callId,
                'user_id'       => $dtoCall->userId,
                'portal_number' => $dtoCall->portalNumber,
                'duration'      => $dtoCall->duration,
                'date'          => Carbon::parse($dtoCall->date)->format('Y-m-d H:i:s'),
                'cost'          => $dtoCall->cost,
                'cost_currency' => $dtoCall->costCurrency,
                'type_id'       => $dtoCall->typeId,
                'code_id'       => $dtoCall->codeId,
            ]) !== null;
    }

    public function isHasByPortalId(array $callIdList, int $portalId): array
    {
        return PortalCall::where('portal_id', $portalId)
            ->whereIn('call_id', $callIdList)
            ->pluck('call_id')
            ->toArray();
    }


}
