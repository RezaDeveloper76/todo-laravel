<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['admin', 'user'];
        foreach ($types as $type) {
            $user_type = new UserType();
            $user_type->user_type_title = $type;
            $user_type->save();
        }
    }
}
