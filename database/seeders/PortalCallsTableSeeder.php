<?php

namespace Database\Seeders;

use App\Models\PortalCall;
use Illuminate\Database\Seeder;

class PortalCallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PortalCall::factory(100)->create();
    }
}
