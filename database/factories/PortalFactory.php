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
            'access_token' => 'b384af65006a2fcc000038f40000256f40380709c68b5e521ea5d51b5903eb02f0313b',
            'refresh_token' => 'a303d765006a2fcc000038f40000256f403807e077e5405746f61f7daaffbd35b3c206',
            'date_uninstall' => null
        ];
    }
}
