<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VoucherCompleteDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipient', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('recipient_id');
            $table->timestamps();
            $table->string('name');
            $table->string('email')->unique();
        });

        Schema::create('offer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('offer_id');
            $table->timestamps();
            $table->string('offer_name');
            $table->decimal('percentage_discount', 3, 2);
        });

        Schema::create('voucher', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('voucher_id');
            $table->timestamps();
            $table->string('voucher_code');
            $table->date('expiration_date');
            $table->boolean('voucher_used');
            $table->dateTime('usage_date');
            //Recipient Foreign Key
            $table->unsignedInteger('recipient_id');
            $table->foreign('recipient_id')->references('recipient_id')->on('recipient');

            // Offer
            $table->unsignedInteger('offer_id');
            $table->foreign('offer_id')->references('offer_id')->on('offer');

            // indexes
            $table->index('recipient_id');
            $table->index('offer_id');
            $table->unique('voucher_code');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
