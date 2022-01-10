<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Brand;
use \App\Models\Type;
use \App\Models\Car;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            Brand::truncate();
            Type::truncate();
            Car::truncate();
            User::truncate();
    
    
    
            $brand1 = Brand::create([
                'name'=>'Mercedes'
            ]);
            $brand2 = Brand::create([
                'name'=>'Audi'
            ]);

            $type1 = Type::create([
                'name'=>'suv'
            ]);
            $type2 = Type::create([
                'name'=>'sedan'
            ]);

    
            $car1 = Car::create([
                'model'=>'E 220',
                'color'=>'Red',
                'hp'=>'150',
                'type_id'=>$type1->id,
                'brand_id'=>$brand1->id
            ]);
    
            $car2 = Car::create([
                'model'=>'A7',
                'color'=>'Black',
                'hp'=>'204',
                'type_id'=>$type2->id,
                'brand_id'=>$brand2->id
            ]);

            $user1 = User::create([
                'username'=>'test',
                'password'=> md5('test')
            ]);
    
    }
}
