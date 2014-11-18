use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the cities table
		Schema::create(\Config::get('laravel-id-cities::table_name'), function($table)
		{
		    $table->bigInteger('id')->index();
		    $table->integer('province_id');
		    $table->string('name', 255)->default('');
		    $table->text('desc')->nullable();

		    $table->primary('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(\Config::get('laravel-id-cities::table_name'));
	}

}
