<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
            [
                'setting_key' => 'shop_name',
                'setting_value' => 'Smart Shop',
            ],
            [
                'setting_key' => 'shop_country',
                'setting_value' => 'Kenya',
            ],
            [
                'setting_key' => 'shop_address',
                'setting_value' => '100000 Riverside',
            ],
            [
                'setting_key' => 'shop_city',
                'setting_value' => 'Nairobi',
            ],
            [
                'setting_key' => 'shop_zip',
                'setting_value' => '00100',
            ],
            [
                'setting_key' => 'shop_email',
                'setting_value' => 'info@smartshop.com',
            ],
            [
                'setting_key' => 'shop_website',
                'setting_value' => 'smartshop.com',
            ],
            [
                'setting_key' => 'shop_pin',
                'setting_value' => 'pin',
            ],
            [
                'setting_key' => 'shop_currency',
                'setting_value' => 'KES',
            ],
            [
                'setting_key' => 'currency_symbol',
                'setting_value' => 'Ksh',
            ],
            [
                'setting_key' => 'currency_position',
                'setting_value' => 'left',
            ],
            [
                'setting_key' => 'shop_logo',
                'setting_value' => 'bk.jpg',
            ],
        ]);
    }
}
