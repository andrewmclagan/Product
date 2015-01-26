<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Schema;

class CreateVariationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{ 
        // Creates the variations table
       Schema::create('variations', function (Blueprint $table) {
        	
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->boolean('master')->nullable();
            $table->string('presentation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('variations');
	}

}