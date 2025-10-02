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
            $table->id('task_id'); 
            $table->foreignId('project_id')->constrained('projects', 'project_id') ->cascadeOnDelete();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->enum('status', ['todo', 'in_progress', 'review', 'done'])->default('todo');
            $table->enum('priority', ['low','medium','high','urgent'])->default('low');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('assignee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('percentage')->unsigned()->default(0);
            $table->foreignId('staff_created')->constrained('users')->cascadeOnDelete();
            $table->foreignId('staff_updated')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
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
