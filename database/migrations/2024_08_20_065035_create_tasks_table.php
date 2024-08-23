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
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('task_label_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('attachments')->nullable();
            $table->text('activities')->nullable();
            $table->text('checklist')->nullable();
            $table->string('time_count')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();

<<<<<<< HEAD:database/migrations/2024_08_20_065035_create_tasks_table.php
            // Foreign keys
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('task_statuses')->onDelete('cascade');
            $table->foreign('priority_id')->references('id')->on('task_priorities')->onDelete('cascade');
            $table->foreign('task_label_id')->references('id')->on('task_labels')->onDelete('cascade');
=======
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('status_id')->references('id')->on('task_statuses');
            $table->foreign('priority_id')->references('id')->on('task_priorities');
            $table->foreign('task_label_id')->references('id')->on('task_labels');
            $table->foreign('user_id')->references('id')->on('users');
>>>>>>> 46a65819f6e14ce58097224bc9827bba13ff65fd:database/migrations/2024_08_20_065033_create_tasks_table.php
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
