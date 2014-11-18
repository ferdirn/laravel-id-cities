<?php

namespace Ferdirn\Cities;

/**
 * List of Cities in Indonesia
 *
 */
class Cities extends \Eloquent {

	/**
	 * @var string
	 * Cities data.
	 */
	protected $cities;

	/**
	 * @var string
	 * The table for the cities in the database, is "cities" by default.
	 */
	protected $table;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
       $this->table = \Config::get('laravel-id-cities::table_name');
    }

    /**
     * Get the cities from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getCities()
    {
        //Get the cities from the JSON file
        if (sizeof($this->cities) == 0){
            $this->cities = json_decode(file_get_contents(__DIR__ . '/Models/cities.json'), true);
        }

        //Return the cities
        return $this->cities;
    }

	/**
	 * Returns one cities
	 *
	 * @param string $id The cities id
     *
	 * @return array
	 */
	public function getOne($id)
	{
        $cities = $this->getCities();
		return $cities[$id];
	}

	/**
	 * Returns a list of cities
	 *
	 * @param string sort
	 *
	 * @return array
	 */
	public function getList($sort = null)
	{
	    //Get the cities list
	    $cities = $this->getCities();

	    //Sorting
	    $validSorts = array(
	    	'province_id',
	        'name',
        );

	    if (!is_null($sort) && in_array($sort, $validSorts)){
	        uasort($cities, function($a, $b) use ($sort) {
	            if (!isset($a[$sort]) && !isset($b[$sort])){
	                return 0;
	            } elseif (!isset($a[$sort])){
	                return -1;
	            } elseif (!isset($b[$sort])){
	                return 1;
	            } else {
	                return strcasecmp($a[$sort], $b[$sort]);
	            }
	        });
	    }

	    //Return the cities
		return $cities;
	}
}
