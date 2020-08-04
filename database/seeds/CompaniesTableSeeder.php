<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();

        Company::create([
            
            'company_name' => 'KITEA',
            'company_country' => 'MOROCCO',
            'company_city' => 'Casablanca',
            'company_address' => 'Medersa Sidi Maarouf, 4 éme étage'
            
            ]);
    }
}
