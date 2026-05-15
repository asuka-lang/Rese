<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->timestamp('reminded_at')->nullable()->comment('リマインダー送信日時');
            $table->integer('price')->nullable();
            $table->boolean('is_paid')->default('0');
            $table->string('payment_intent_id')->nullable();
            $table->string('qr_token')->nullable();
            $table->timestamp('qr_token_expires_at')->nullable();
            $table->timestamp('checkin_at')->nullable();
            $table->boolean('is_reviewed')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->dropColumn('reminded_at');
            $table->dropColumn('price');
            $table->dropColumn('is_paid');
            $table->dropColumn('payment_intent_id');
            $table->dropColumn('qr_token');
            $table->dropColumn('qr_token_expires_at');
            $table->dropColumn('checkin_at');
            $table->dropColumn('is_reviewed');
        });
    }
}
