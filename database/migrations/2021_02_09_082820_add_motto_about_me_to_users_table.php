<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMottoAboutMeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            /*  - https://laravel.com/docs/7.x/migrations#creating-tables
                - https://laravel.com/docs/7.x/migrations#generating-migrations
            */
            $table->string('motto')->nullable()->after('email');
            $table->string('about_me')->nullable()->after('motto');
            /* after: https://stackoverflow.com/questions/20982538/add-sql-table-column-before-or-after-specific-other-column-by-migrations-in-la */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}