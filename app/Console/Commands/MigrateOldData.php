<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:old-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//        foreach ($users as $user) {
//            $transform = $user->transform;
//            DB->insert($transform );
//
//            $this->info('user with ID ' . $user->id . ' has been saved');
//        }
        // select from old data base
//        $model = DB::connection('old_data')->table('x')->chunk(1000, function($users) {
//        });
//
//        $old_data = $model->all();
//
//        // transform to new shape
//        $transformedData = (new Transformer($old_data))->transform();
//
//        // insert into data base
//        DB::connection('mysql')->table('z')->insert($transformedData);
    }
}
