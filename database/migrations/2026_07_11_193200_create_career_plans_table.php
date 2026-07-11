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
        Schema::create('career_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('target_job');
            $table->json('missing_skills')->nullable();
            $table->json('market_requirements')->nullable();
            $table->integer('readiness_score')->nullable()->comment('0-100');
            $table->text('gap_summary')->nullable();
            $table->longText('improvement_plan')->nullable();
            $table->string('status')->default('active')->comment('active|completed');
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_plans');
    }
};
