<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Auth\Database\Seeders\LaratrustSeeder;
use Modules\Geocode\Database\Seeders\GeocodeDatabaseSeeder;
use Modules\Board\Database\Seeders\BoardDatabaseSeeder;
use Modules\Banner\Database\Seeders\BannerDatabaseSeeder;
use Modules\Review\Database\Seeders\ReviewDatabaseSeeder;
use Modules\Payment\Database\Seeders\PaymentDatabaseSeeder;
use Modules\Profile\Database\Seeders\ProfileDatabaseSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GeocodeDatabaseSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(BoardDatabaseSeeder::class);
        $this->call(BannerDatabaseSeeder::class);
        $this->call(ReviewDatabaseSeeder::class);
        $this->call(PaymentDatabaseSeeder::class);
        $this->call(ProfileDatabaseSeeder::class);
    }
}

