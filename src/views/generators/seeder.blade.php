use Illuminate\Database\Eloquent\Model as Eloquent;

class CitiesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the cities table
        DB::table(\Config::get('laravel-id-cities::table_name'))->delete();

        //Get all of the cities
        $cities = Cities::getList();
        foreach ($cities as $cityId => $city){
            DB::table(\Config::get('laravel-id-cities::table_name'))->insert(array(
                'id' => $cityId,
                'province_id' => $city['province_id'],
                'name' => $city['name'],
                'desc' => isset($city['desc']) ? $city['desc'] : null,
            ));
        }
    }
}
