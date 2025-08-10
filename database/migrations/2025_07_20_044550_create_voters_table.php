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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('voter_name');
            $table->string('voter_email')->unique();
            $table->string('voter_password');
            $table->string('Major')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('Years')->nullable();
            $table->rememberToken();
            $table->string('roll_name')->nullable();
            $table->string("profile_image")->nullable();
             $table->integer('vote_male')->default(0);
             $table->integer('vote_female')->default(0);
            $table->timestamps();
        });
        Schema::create('voter_password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('voters_sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('voter_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('voters');
        Schema::dropIfExists('voter_password_reset_tokens');
        Schema::dropIfExists('voters_sessions');
    }
};
