<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationcomments', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id')->nullable();
            $table->string('to_user_id')->nullable();
            $table->string('comment_id')->nullable();
            $table->string('post_id')->nullable();
            $table->boolean('read')->default(0);
  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificationcomments');
    }
}
