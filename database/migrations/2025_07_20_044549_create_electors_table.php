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
        Schema::create('electors', function (Blueprint $table) {
            $table->id();
            $table->string('elector_name');
            $table->string('phone');
            $table->text('address');
            $table->string('Years');
            $table->longtext("description");
            $table->string('gender');
            $table->integer('won_status');
            $table->integer('vote_same')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electors');
    }
};
