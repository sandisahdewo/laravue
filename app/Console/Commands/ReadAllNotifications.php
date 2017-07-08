<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ReadAllNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read All Notification';

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
        DB::table('notifications')
          ->update(['read_at' => \Carbon\Carbon::now()]);
    }
}
