<?php

namespace Database\Seeders;

use App\Models\General;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        General::create([
            'company_name' => 'QuickPick Foods',
            'company_tagline' => 'Order Food & QuickPick It',
            'company_abbrevation' => 'QPF',
            'company_description' => 'A quick way to order and get food online in Karu Metropolis & Its evirons',
            'company_phone' => '0810202202020',
            'company_email' => 'contact@testorder.com',
            'company_address' => 'Dash Road, Karu, F.C.T Abuja',
            'company_seo_description' => 'A quick way to order and get food online in Karu Metropolis & Its evirons',
            'company_seo_keywords' => array('Food Order', 'Abuja', 'Quick Order', 'Fast Food'),
            'company_logo_white' => 'logo_white.png',
            'company_logo_dark' => 'logo_dark.png',
            'company_favicon' => 'favicon.png',
            'company_footer_text' => 'QuickPick Foods | All Rights Reserved',
            'facebook' => 'https://facebook.com/quickpickfoods/',
            'twitter' => 'https://twitter.com/quickpickfoods/',
            'instagram' => 'https://instagram.com/quickpickfoods/',
        ]);
    }
}
