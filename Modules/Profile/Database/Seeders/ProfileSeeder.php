<?php

namespace Modules\Profile\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Profile\Entities\Profile;

/**
 * Class ProfileTableSeeder.
 */
class ProfileSeeder extends Seeder
{

    /**
     * Run the database seed.
     */
    public function run(): void
    {

        Profile::create([
            'user_id' => 7,
            'bio'=>trans('modules/profiles/seeders.welcome into my profile'),
            'gender'=>'1',
            'birth_date'=>'1995-06-09',
            'years_experience'=>3,
            'price_half_hour'=>22,

        ]);
        Profile::create([
            'user_id' => 8,
            'bio'=>trans('modules/profiles/seeders.welcome into my profile'),
            'gender'=>'0',
            'birth_date'=>'1995-06-10',
            'years_experience'=>3,
            'price_half_hour'=>22,

        ]);
        Profile::create([
            'user_id' => 9,
            'bio'=>trans('modules/profiles/seeders.welcome into my profile'),
            'gender'=>'1',
            'birth_date'=>'1995-06-11',
            'years_experience'=>3,
            'price_half_hour'=>10,

        ]);
        Profile::create([
            'user_id' => 10,
            'bio'=>trans('modules/profiles/seeders.welcome into my profile'),
            'gender'=>'0',
            'birth_date'=>'1995-06-12',
            'years_experience'=>3,
            'price_half_hour'=>11,

        ]);
        Profile::create([
            'user_id' => 11,
            'bio'=>trans('modules/profiles/seeders.welcome into my profile'),
            'gender'=>'1',
            'birth_date'=>'1995-06-13',
            'years_experience'=>4,
            'price_half_hour'=>25,

        ]);
    }
}
