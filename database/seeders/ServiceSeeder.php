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
        
            $service['category'] = 'instagram';
        };
        if(Str::contains($service['category'], ['YT'])){
        
            $service['category'] = 'youtube';
        };
        if(Str::contains($service['category'], ['TTK'])){
        
            $service['category'] = 'tiktok';
        };
        if(Str::contains($service['category'], ['TW'])){
        
            $service['category'] = 'twitch';
        };
        if(Str::contains($service['category'], ['KW'])){
        
            $service['category'] = 'kawaii';
        };

        if(Str::contains($service['category'], ['FB'])){
        
            $service['category'] = 'facebook';
        };

        if(Str::contains($service['category'], ['Categoria Privada'])){
        
            return;
        };

       

        // 1. Remove vírgula e ponto → "6900"
        $coast = (int) Str::remove(['.', ','], $service['rate']);
        
        // 2. Aplica 75% de margem
        $rate = (int) round($coast * 1.75);
        
        // 3. Salva os valores
        $service['coast'] = $coast;
        $service['rate'] = $rate;
 

            Service::create($service);
        });
    }
}
