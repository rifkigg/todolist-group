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
            $table->unsignedBigInteger('board_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('priority_id')->nullable();
            $table->unsignedBigInteger('task_label_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('time_count')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('task_statuses')->onDelete('cascade');
            $table->foreign('priority_id')->references('id')->on('task_priorities')->onDelete('cascade');
            $table->foreign('task_label_id')->references('id')->on('task_labels')->onDelete('cascade');
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
