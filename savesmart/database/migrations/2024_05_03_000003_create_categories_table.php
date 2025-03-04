<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         // Insert default categories
         DB::table('categories')->insert([
            ['name' => 'Food'],
            ['name' => 'Housing'],
            ['name' => 'Transportation'],
            ['name' => 'Entertainment'],
            ['name' => 'Savings'],
            ['name' => 'Other'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
