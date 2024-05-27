<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title',255);
            $table->text('job_description');
            $table->text('job_requirement');
            $table->unsignedInteger('employer_id');
            $table->decimal('salary');
            $table->string('employment_type',50);
            $table->date('post_date');
            $table->date('expiration_date');
            $table->boolean('is_highlighted')->default(false);
            $table->unsignedTinyInteger('status')->default(2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_jobs');
    }
};
