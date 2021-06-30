<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale' => 'en',
            'default_timzone' => 'Africa/Cairo',
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD','LE','SAR'],
            'default_currency' => 'USD',
            'store_email' => 'admin@email.com',
            'search_engine' => 'mysql',
            'local_shipping_cost' => 0,
            'outer_shipping_cust' => 0,
            'free_sipping_cost' => 0,
            'translatable' => [
                'story_name' => 'صوار',
                'free_shipping_label' => 'توصيل مجاني',
                'local_lable' => 'توصيل داخلي',
                'outer_lable' => 'توصيل خارجي',
            ],
        ]);
    }
}
