<?php

namespace App\Console\Commands;

use App\Models\BarangToko;
use Illuminate\Console\Command;

class Diskon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diskon';

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
     * @return int
     */
    public function handle()
    {
        $data = BarangToko::get();
        foreach ($data as $item) {
            $item->update([
                'harga_jual' => $item->harga - ($item->harga * ($item->diskon == null ? 0 : ($item->diskon / 100))),
            ]);
        }
        return 'sukses';
    }
}
