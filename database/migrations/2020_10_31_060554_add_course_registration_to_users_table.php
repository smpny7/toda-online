<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseRegistrationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('math1')->default(false);

            $table->boolean('math2')->default(false);

            $table->boolean('math3')->default(false);

            $table->boolean('mathA')->default(false);

            $table->boolean('mathB')->default(false);
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
            $table->dropColumn('math1', 'math2', 'math3', 'mathA', 'mathB');
        });
    }
}
