<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->string("psis_monitoring_status",7)->default('000024')->comment('psis_type_code 000006');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->dropColumn('psis_monitoring_status');
        });
    }
};
