<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([
            'site_name' => 'Laravel blog',
            'site_email' => 'fares@blog.info',
            'site_phone' => '+79260819844',
        ]);
    }
}
