<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitializeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize all app components.';

    /**
     * Database seeder variable.
     *
     * @var \DatabaseSeeder
     */
    protected $seeder;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->seeder = new \DatabaseSeeder();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Resetting all migrations..');
        $this->call('migrate:reset');

        $this->info('Start migrate..');
        $this->call('migrate');

        $this->info('Running seeders..');
        $this->seeder->run();
        $this->info('Seeders finished');
    }
}
