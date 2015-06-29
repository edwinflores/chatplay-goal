<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWebchatLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('webchat_lines', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('author');
            $table->string('gravatar', 64);
            $table->text('text');
            $table->timestamp('ts');
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
        Schema::drop('webchat_lines');
	}

}
