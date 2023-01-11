<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Buyer1";
        $user->email = "buyer1@gmail.com";
        $user->password = "12345678"; 
        $user->password = bcrypt($user->password);
        $user->phone = "081223456718";
        $user->image = NULL;
        $user->QRimage = NULL;
        $user->role = "Buyer";
        $user->save();

        $user = new User();
        $user->name = "Buyer2";
        $user->email = "buyer2@gmail.com";
        $user->password = "12345678"; 
        $user->password = bcrypt($user->password);
        $user->phone = "081212356338";
        $user->image = NULL;
        $user->QRimage = NULL;
        $user->role = "Buyer";
        $user->save();

        $user = new User();
        $user->name = "Seller1";
        $user->email = "seller1@gmail.com";
        $user->password = "12345678"; 
        $user->password = bcrypt($user->password);
        $user->phone = "081234566338";
        $user->image = "images/1673436362.jpg";
        $user->QRimage = NULL;
        $user->role = "Seller";
        $user->save();

        $user = new User();
        $user->name = "Seller2";
        $user->email = "seller2@gmail.com";
        $user->password = "12345678"; 
        $user->password = bcrypt($user->password);
        $user->phone = "081234566338";
        $user->image = "images/1673436362.jpg";
        $user->QRimage = NULL;
        $user->role = "Seller";
        $user->save();

        $user = new User();
        $user->name = "Seller3";
        $user->email = "seller3@gmail.com";
        $user->password = "12345678"; 
        $user->password = bcrypt($user->password);
        $user->phone = "081234566338";
        $user->image = "images/1673436362.jpg";
        $user->QRimage = NULL;
        $user->role = "Seller";
        $user->save();

        $user = new User();
        $user->name = "Seller4";
        $user->email = "seller4@gmail.com";
        $user->password = "12345678"; 
        $user->password = bcrypt($user->password);
        $user->phone = "081234566338";
        $user->image = "images/1673436362.jpg";
        $user->QRimage = NULL;
        $user->role = "Seller";
        $user->save();
    }
}
