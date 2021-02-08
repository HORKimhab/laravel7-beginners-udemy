<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeteleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hobbies', function (Blueprint $table) {
            /* https://laravel.com/docs/7.x/migrations#creating-tables */
            $table->boolean('is_delete')->nullable()->default(0)->after('description');
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
        Schema::table('hobbies', function (Blueprint $table) {
            //
        });
    }
}