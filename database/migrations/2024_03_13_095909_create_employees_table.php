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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('first_name');
            $table->string('last_name');
            $table->decimal('salary');
            $table->string('image')->nullable();
            $table->enum('type', ['employee', 'manager', 'admin']);
            $table->timestamps();

            $table->foreign('manager_id')->on('employees')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
