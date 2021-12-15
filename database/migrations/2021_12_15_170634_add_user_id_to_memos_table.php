<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');  //追加
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->dropForeign('memos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
