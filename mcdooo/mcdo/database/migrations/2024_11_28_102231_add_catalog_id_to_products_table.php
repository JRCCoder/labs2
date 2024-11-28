<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('products', 'catalog_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('catalog_id')->after('image')->nullable();
                $table->foreign('catalog_id')->references('id')->on('catalogs')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['catalog_id']);
            $table->dropColumn('catalog_id');
        });
    }
}; 