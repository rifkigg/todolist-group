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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('project_name');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('task_label_id');
            $table->unsignedBigInteger('user_id');
            $table->date('due_date');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('task_status');
            $table->foreign('priority_id')->references('id')->on('task_priorities');
            $table->foreign('task_label_id')->references('id')->on('task_labels');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
