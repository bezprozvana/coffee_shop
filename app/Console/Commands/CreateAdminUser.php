<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'make:admin-user';
    protected $description = 'Створити адміністратора';

    public function handle()
    {
        $name = $this->ask('Ім\'я');
        $email = $this->ask('Email');
        $phone = $this->ask('Номер телефону');
        $password = $this->secret('Пароль');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone,
            'password' => Hash::make($password),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        $this->info("Адмін-користувач '{$user->name}' створений успішно!");
    }
}
