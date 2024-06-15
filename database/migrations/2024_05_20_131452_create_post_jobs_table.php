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
            $table->foreignId('service_id')->nullable()->references('id')->on('services');
            $table->text('job_description');
            $table->text('job_requirement');
            $table->unsignedInteger('employer_id');
            $table->bigInteger('salary');
            $table->unsignedTinyInteger('employment_type')->comment('1:fulltime|2:parttime|3:contract');
            $table->date('post_date');
            $table->date('expiration_date');
            $table->unsignedTinyInteger('status')->default(2)->comment('1:yes|2:no');
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
