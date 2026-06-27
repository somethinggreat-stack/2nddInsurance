<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('contact');   // quote | contact | callback | consultation | questionnaire
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->json('interests')->nullable();         // lines of insurance they want
            $table->text('message')->nullable();
            $table->json('data')->nullable();              // full questionnaire payload
            $table->string('status')->default('new');      // new | contacted | quoted | won | closed
            $table->string('source')->nullable();          // page / referrer
            $table->string('ip_address')->nullable();
            $table->string('user_agent', 512)->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
