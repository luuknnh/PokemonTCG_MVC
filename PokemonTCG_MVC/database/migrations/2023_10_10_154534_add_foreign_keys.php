<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->foreign('cardcollection')->references('id')->on('collections');
            $table->foreign('cardwishlist')->references('id')->on('wishlists');
                    $table->foreign('user_id')->references('id')->on('users');

        });

        Schema::table('collections', function (Blueprint $table) {
            $table->foreign('cardid')->references('id')->on('cards');
            $table->foreign('userid')->references('id')->on('users');
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('cardid')->references('id')->on('cards');
            $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop the foreign keys in the reverse order.
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropForeign(['cardid']);
            $table->dropForeign(['userid']);
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->dropForeign(['cardid']);
            $table->dropForeign(['userid']);
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(['cardcollection']);
            $table->dropForeign(['cardwishlist']);
        });
    }
}

