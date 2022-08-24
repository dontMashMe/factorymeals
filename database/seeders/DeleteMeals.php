<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;

class DeleteMeals extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //soft delete some records
         foreach(Meal::all() as $meal) {
            $p = mt_rand(0, 99);
            if ($p < 25) {
                print($meal->id);
                $model = Meal::find($meal->id);
                //dd($model);
                $model->delete();
            }
         }
    }
}
