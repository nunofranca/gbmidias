<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Http::upmidias()->post('/', [
            'key' => config('upmidias.token'),
           "action"=> "services"
        ])->json();

        collect($services)->map(function($service){
            Service::create($service);
        });
    }
}
