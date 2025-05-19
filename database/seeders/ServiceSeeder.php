<?php

namespace Database\Seeders;

use App\Models\Category;
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
            "action" => "services"
        ])->json();


        collect($services)->map(function ($service) {

            if (Str::contains($service['category'], ['Categoria Privada'])) return;
            // 1. Remove vírgula e ponto → "6900"
            $coast = (int)Str::remove(['.', ','], $service['rate']);

            // 2. Aplica 75% de margem
            $rate = (int)round($coast * 1.75);

            // 3. Salva os valores
            $service['coast'] = $coast;
            $service['rate'] = $rate;

            $category = Category::firstOrCreate(['name' =>$service['category']]);
            $category->services()->create($service);
        });
    }
}
