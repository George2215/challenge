<?php

use App\Invoice;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 8)->create()->each(function ($user) {
            $invoice = $user->invoices()->save(factory(Invoice::class)->make());

            $invoice->products()->save(factory(Product::class)->make());
        });
        
        DB::table('users')->insert([
            'name' 			=> 'Jorge Navia',
            'email'			=> 'georgato22@gmail.com',
            'password' 		=> bcrypt('12345678'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //$this->call(UserSeeder::class);
    }
}
