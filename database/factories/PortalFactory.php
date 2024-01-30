<?php

namespace Database\Factories;

use App\Models\Portal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portal>
 */
class PortalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Portal::class;
    public function definition(): array
    {
        return [
            'domain' => 'skyweb24.bitrix24.ru',
            'language' => 'ru',
            'license' => 'nfr',
            'member_id' => '7ef7b47de517bfb32b13ce6002e91dac',
            'access_token' => '8367b765006a6d20000038f4000000014038076d21af4c45a2de539b85ef15193109ab',
            'refresh_token' => '73e6de65006a6d20000038f4000000014038070fd50208bc83b7ef46f4e36c17e12f1e',
            'date_uninstall' => null
        ];
    }
}
