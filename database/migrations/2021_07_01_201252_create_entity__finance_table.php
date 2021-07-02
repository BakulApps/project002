<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_entity__items', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('item_code', 4)->nullable();
            $table->string('item_name', 100)->nullable();
        });

        Schema::create('finance_entity__lacks', function (Blueprint $table) {
            $table->id('lack_id');
            $table->string('lack_item', 3)->nullable();
            $table->string('lack_student', 4)->nullable();
            $table->string('lack_cost', 50)->nullable();
        });

        Schema::create('finance_entity__payments', function (Blueprint $table){
            $table->id('payment_id');
            $table->string('payment_number')->nullable();
            $table->string('payment_student', 4)->nullable();
            $table->mediumText('payment_item', )->nullable();
            $table->string('payment_cost', 50)->nullable();
            $table->string('payment_type_account', 2)->nullable();
            $table->string('payment_number_account', 200)->nullable();
            $table->string('payment_name_account', 200)->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->string('payment_status', 1)->nullable();
            $table->string('payment_file')->nullable();
            $table->boolean('payment_view')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('finance_entity__accounts', function (Blueprint $table){
            $table->id('account_id');
            $table->string('account_bank', 2)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('account_name', 100)->nullable();
            $table->boolean('account_active')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_entity__items');
        Schema::dropIfExists('finance_entity__lacks');
        Schema::dropIfExists('finance_entity__payments');
        Schema::dropIfExists('finance_entity__accounts');
    }
}
