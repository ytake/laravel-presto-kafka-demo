<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTestingTable
 */
final class CreateTestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('test_id');
            $table->string('test_name', 85)->default('');
            $table->timestamp('created_at')
                ->default(
                    new \Illuminate\Database\Query\Expression('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')
                );
            $table->unique(['test_name'], 'UIDX_TESTS_NAME');
            $table->index(['test_name', 'test_id'], 'IDX_TESTS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
