<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

        if(Str::contains($service['category'], ['Instagram', 'IG'])){
        
            $service['category'] = 'Instagram';
        };

            Service::create($service);
        });
    }
}
