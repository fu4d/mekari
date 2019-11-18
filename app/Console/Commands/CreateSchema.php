<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:schema {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database';



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       \DB::statement('CREATE DATABASE '.$this->argument('name'));
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the database'],
        ];
    }

}
