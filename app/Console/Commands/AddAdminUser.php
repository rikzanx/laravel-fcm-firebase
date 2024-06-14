<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Factory;

class AddAdminUser extends Command
{
    protected $signature = 'app:add-admin-user';
    protected $description = 'Add an admin user to Firebase Authentication and Realtime Database';

    public function handle()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path('resources/credentials/firebase_credentials.json'))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

            $auth = $firebase->createAuth();
            $database = $firebase->createDatabase();

        try {
            $user = $auth->createUser([
                'email' => 'admin@gmail.com',
                'emailVerified' => false,
                'password' => 'admin111',
                'displayName' => 'Admin User',
                'disabled' => false,
            ]);

            echo 'Successfully created new user: ' . $user->uid . PHP_EOL;

            $database->getReference('users/' . $user->uid)->set([
                'email' => 'admin@gmail.com',
                'role' => 'admin',
            ]);

            echo 'Successfully set role for new user.' . PHP_EOL;
        } catch (\Kreait\Firebase\Exception\Auth\AuthError $e) {
            echo 'Error creating user: ' . $e->getMessage() . PHP_EOL;
        }
    }
}
