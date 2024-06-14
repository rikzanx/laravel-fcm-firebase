<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\User::where('role','admin')->first();
        $user = \App\Models\User::where('role','user')->first();
        if($admin && $user){
            \App\Models\Notification::create([
                'user_id_from' => $admin->id,
                'user_id_to' => $user->id,
                'text' => 'Admin telah menmabah stock Tenda 5 biji'
            ]);
            \App\Models\Notification::create([
                'user_id_from' => $admin->id,
                'user_id_to' => $user->id,
                'text' => 'Admin telah menmabah stock Tenda 10 biji'
            ]);
        }
    }
}
