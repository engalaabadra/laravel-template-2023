<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Payment\Entities\Payment;

/**
 * Class PaymentTableSeeder.
 */
class PaymentSeeder extends Seeder
{

    /**
     * Run the database seed.
     */
    public function run(): void
    {

        Payment::create([
            'name' => trans('modules/payments/seeders.Card')
        ]);
        Payment::create([
            'name' => trans('modules/payments/seeders.PayPal')
        ]);
        Payment::create([
            'name' => trans('modules/payments/seeders.Google Pay')
        ]);
        Payment::create([
            'name' => trans('modules/payments/seeders.Apple Pay')
        ]);
        Payment::create([
            'name' => trans('modules/payments/seeders.Wallet')
        ]);
    }
}
