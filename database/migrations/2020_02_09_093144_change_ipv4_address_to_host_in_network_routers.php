<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIpv4AddressToHostInNetworkRouters extends Migration
{
    const OLD_COLUMN_NAME = "ipv4_address";
    const NEW_COLUMN_NAME = "host";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('network_routers', function (Blueprint $table) {
            $table->renameColumn(static::OLD_COLUMN_NAME, static::NEW_COLUMN_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('network_routers', function (Blueprint $table) {
            $table->renameColumn(static::NEW_COLUMN_NAME, static::OLD_COLUMN_NAME);
        });
    }
}
