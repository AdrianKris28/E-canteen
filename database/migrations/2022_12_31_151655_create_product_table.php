<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sellerId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('description', 100);
            $table->integer('price');
            $table->integer('stock');
            $table->string('image')->nullable(true);
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
        Schema::dropIfExists('product');
    }

    /*
    Update existing table's column with migration without losing data

    Make new migration file for example "php artisan make:migration add_phone_number_to_users_table"

    class AddPhoneNumberToUsersTable extends Migration
    {
     
        public function up()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone_number')->unique()->after('email');
            });
        }

        public function down()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone_number');
            });
        }
    }
    */
}
