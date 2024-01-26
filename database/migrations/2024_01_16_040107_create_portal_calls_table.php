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
            $table->unsignedBigInteger('portal_id')->index();
            $table->foreign('portal_id')->references('id')->on('portals');
            $table->string('call_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('portal_number')->nullable()->index();
            $table->unsignedBigInteger('duration')->nullable()->index();
            $table->dateTime('date')->nullable();
            $table->float('cost', 10, 2, false)->nullable();
            $table->string('cost_currency', 100)->nullable()->index();
            $table->unsignedInteger('type_id')->nullable()->index();
            $table->unsignedInteger('code_id')->nullable()->index();
            $table->timestamps();
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
