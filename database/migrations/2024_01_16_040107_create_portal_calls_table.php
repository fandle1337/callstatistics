<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portal_calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('portal_number')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('cost')->nullable();
            $table->string('cost_currency', 100)->nullable();
            $table->unsignedInteger('type')->nullable();
            $table->unsignedInteger('code')->nullable();
            $table->timestamps();

            $table->foreign('portal_id')->on('portals')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_calls');
    }
};
