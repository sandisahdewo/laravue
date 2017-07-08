<?php

namespace App\Console\Commands;

use File;
use Artisan;
use Illuminate\Console\Command;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is very simple way to install this application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting installation...');

        if (!File::exists('.env')) {
            $this->error('File Not Found: .env');
            $this->error('Aborted');
            return false;
        }

        $this->info('Generating App key...');
        Artisan::call('key:generate');
        $this->info('Migrating Database...');
        Artisan::call('migrate');
        $this->info('Done!');
    }
}
