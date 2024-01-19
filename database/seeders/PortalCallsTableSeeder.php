<?php

namespace Database\Seeders;

use app\Model\PortalCall;
use Illuminate\Database\Seeder;

class PortalCallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PortalCall::factory()->count(50)->create();
    }
}
