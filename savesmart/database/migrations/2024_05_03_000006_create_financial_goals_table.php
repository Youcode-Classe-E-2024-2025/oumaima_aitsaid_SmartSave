<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_member_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('target_amount', 10, 2);
            $table->date('target_date');
            $table->decimal('saved_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_goals');
    }
};