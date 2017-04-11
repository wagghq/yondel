<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->integer('team_id')->unsigned();
            $table->integer('inviter_id')->unsigned();
            $table->string('invitee_email');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('inviter_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
