<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::Statement('CREATE DATABASE '.$this->argument('name'));
    }

    protected function getArguments(){
        return [
            ['name', inputArgument::REQUIRED, "Database Name"]
        ];
    }
}
