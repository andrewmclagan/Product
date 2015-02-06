<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Schema;

class CreateOptionProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{ 
        // Creates the products table
       	Schema::create('option_product', function (Blueprint $table) {
        	
    		$table->integer('option_id');
        	$table->integer('product_id');
    	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('option_product');
	}

}