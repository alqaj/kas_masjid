<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->text('address')->nullable();
            $table->string('telp', 12)->nullable();
            $table->timestamps();
        });

        Schema::table('kas', function (Blueprint $table) {
            $table->bigInteger('company_id')->after('user_id')->default(0);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('company_id')->after('id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');

        Schema::table('kas', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

    }
}
