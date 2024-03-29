<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portals', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 100);
            $table->string('language', 100)->nullable();
            $table->string('license', 100)->nullable();
            $table->string('member_id', 100);
            $table->string('access_token', 100);
            $table->string('refresh_token', 100);
            $table->dateTime('date_uninstall')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portals');
    }
};
