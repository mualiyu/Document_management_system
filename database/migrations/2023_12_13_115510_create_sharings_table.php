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
        Schema::create('sharings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('user_id')->unsigned();
            $table->string('type');
            $table->string('start_time')->nullable();
            $table->string('stop_time')->nullable();
            $table->string('status');
            $table->string('uuid');
            $table->longText('description')->nullable();
            $table->longText('terms')->nullable();
            $table->longText('n_d_a')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sharings');
    }
};
