<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use Illuminate\Console\Command;
use Faker\Factory as Faker;

class CreatePegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pegawai:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create pegawai';

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
     * @return int
     */
    public function handle()
    {
        $jumlah = $this->ask("Masukan Jumlah Data Pegawai");
        Pegawai::factory($jumlah)->create();
        $this->info('Data added successfully');
    }
}
