<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Organisation;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = array();

        
        for ($i = 0; $i < 1000; $i++) {
            $name = "Назва організації " . ($i + 1);
            $description = "<h2>Опис організації " . ($i + 1) . "</h2><p>Це опис організації з номером " . ($i + 1) . "</p>";
            $subscribed = (bool)rand(0, 1);
            $trial_end = date('Y-m-d', strtotime("+30 days"));

            
            $organization = array(
                'name' => $name,
                'description' => $description,
                'subscribed' => $subscribed,
                'trial_end' => $trial_end
            );

     
            $organizations[] = $organization;
        }
        Organisation::insert($organizations);
    }
}
