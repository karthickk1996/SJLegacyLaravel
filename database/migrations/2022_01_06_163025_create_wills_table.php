<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('email');
            $table->string('dob');
            $table->boolean('hasPartner')->default(false);
            $table->boolean('hasChildrenUnderEighteen')->default(false);
            $table->boolean('hasMirrorWill')->default(false);
            $table->boolean('ownProperty')->default(false);
            $table->json('addressSummary')->nullable();
            $table->json('secondApplicant')->nullable();
            $table->json('secondExecutor')->nullable();
            $table->boolean('eachOtherExecutor')->default(false);
            $table->json('executor')->nullable();
            $table->json('reserveExecutor')->nullable();
            $table->json('giftOptions')->nullable();
            $table->json('giftMoney')->nullable();
            $table->json('giftCharity')->nullable();
            $table->json('giftBank')->nullable();
            $table->json('giftProperty')->nullable();
            $table->json('giftPet')->nullable();
            $table->json('businessAssignment')->nullable();
            $table->json('residueDetails')->nullable();
            $table->json('requestDetails')->nullable();
            $table->boolean('appointGuardian')->default(false);
            $table->boolean('hasMoreThanOneChildren')->default(false);
            $table->boolean('sameGuardianAllChildren')->default(false);
            $table->json('children')->nullable();
            $table->json('reserveGuardian')->nullable();
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
        Schema::dropIfExists('wills');
    }
}
