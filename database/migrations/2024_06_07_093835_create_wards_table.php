<?php

use App\Models\Staff;
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
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->foreignIdFor(Staff::class)->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('floor')->nullable();
            $table->string('type')->default('General');
            $table->string('capacity');
            $table->enum('status',['Available','Unavailable'])->default("Available");
            $table->integer('sick_person')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
