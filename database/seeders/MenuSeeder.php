<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Pastikan ada admin untuk create menus
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->error('Admin user not found. Please run AdminSeeder first.');
            return;
        }

        $menus = [
            [
                'title' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam suwir, dan sayuran segar. Dilengkapi dengan kerupuk dan acar.',
                'vote_start' => now(),
                'vote_end' => now()->addDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Soto Ayam Kuning',
                'description' => 'Soto ayam dengan kuah kuning yang gurih, dilengkapi dengan lontong, telur rebus, dan sambal.',
                'vote_start' => now(),
                'vote_end' => now()->addDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Gado-Gado Jakarta',
                'description' => 'Sayuran segar dengan bumbu kacang khas Jakarta, dilengkapi dengan lontong dan kerupuk.',
                'vote_start' => now(),
                'vote_end' => now()->addDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Nasi Uduk Betawi',
                'description' => 'Nasi uduk dengan lauk ayam goreng, tempe orek, telur balado, dan sambal kacang.',
                'vote_start' => now()->addDays(8),
                'vote_end' => now()->addDays(15),
                'is_active' => true,
            ],
            [
                'title' => 'Ayam Geprek Pedas',
                'description' => 'Ayam goreng crispy yang digeprek dengan sambal pedas level 5, disajikan dengan nasi hangat.',
                'vote_start' => now()->addDays(8),
                'vote_end' => now()->addDays(15),
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menuData) {
            Menu::create([
                'title' => $menuData['title'],
                'description' => $menuData['description'],
                'vote_start' => $menuData['vote_start'],
                'vote_end' => $menuData['vote_end'],
                'is_active' => $menuData['is_active'],
                'created_by' => $admin->id,
            ]);
        }

        $this->command->info('Menus seeded successfully!');
    }
}
