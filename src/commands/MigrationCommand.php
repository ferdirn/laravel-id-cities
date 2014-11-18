<?php
namespace Ferdirn\Cities;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigrationCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cities:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration of cities table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $app = app();
        $app['view']->addNamespace('cities',substr(__DIR__,0,-8).'views');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->line('');
        $this->info('Welcome to package ferdirn/laravel-id-cities');
        $this->line('');
        $this->info('The migration file will create a table cities and a seeder for the cities data');

        $this->line('');

        if ( $this->confirm("Create migration file? [Yes|no]") )
        {
            $this->line('');

            $this->info( "Creating migration and seed file..." );
            if( $this->createMigration( 'cities' ) )
            {
                $this->line('');

                $this->call('dump-autoload', array());

                $this->line('');

                $this->info( "Migration successfully created!" );
            }
            else{
                $this->error(
                    "Error! Failed to create migration.\n Check the write permissions".
                    " within the app/database/migrations directory."
                );
            }

            $this->line('');
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

    /**
     * Create the migration
     *
     * @param  string $name
     * @return bool
     */
    protected function createMigration()
    {
        //Create the migration
        $app = app();
        $migrationFiles = array(
            $this->laravel->path."/database/migrations/*_create_cities_table.php" => 'cities::generators.migration',
        );

        $seconds = 0;

        foreach ($migrationFiles as $migrationFile => $outputFile) {
            if (sizeof(glob($migrationFile)) == 0) {
                $migrationFile = str_replace('*', date('Y_m_d_His', strtotime('+' . $seconds . ' seconds')), $migrationFile);

                $fs = fopen($migrationFile, 'x');
                if ($fs) {
                    $output = "<?php\n\n" .$app['view']->make($outputFile)->with('table', 'cities')->render();

                    fwrite($fs, $output);
                    fclose($fs);
                } else {
                    return false;
                }

                $seconds++;
            }
        }


        //Create the seeder
        $seeder_file = $this->laravel->path."/database/seeds/CitiesSeeder.php";
        $output = "<?php\n\n" .$app['view']->make('cities::generators.seeder')->render();

        if (!file_exists( $seeder_file )) {
            $fs = fopen($seeder_file, 'x');
            if ($fs) {
                fwrite($fs, $output);
                fclose($fs);
            } else {
                return false;
            }
        }

        return true;
    }

}
