<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin/moderator
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'role' => 'moderator',
            'name' => 'Admin Moderator',
            'email' => 'admin@makermarket.nl',
        ]);

        // Create makers
        $makers = [
            [
                'username' => 'woodcraft_by_jan',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Jan van der Wood',
                'email' => 'jan@woodcraft.nl',
            ],
            [
                'username' => 'ceramic_art',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Emma Ceramics',
                'email' => 'emma@ceramicart.nl',
            ],
            [
                'username' => 'textile_dreams',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Lisa Textiles',
                'email' => 'lisa@textiledreams.nl',
            ],
            [
                'username' => 'jewelry_designs',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Sophie Jewelry',
                'email' => 'sophie@jewelrydesigns.nl',
            ],
            [
                'username' => 'metal_art_studio',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Thomas Metalworks',
                'email' => 'thomas@metalart.nl',
            ],
            [
                'username' => 'glass_artisan',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Anna Glassworks',
                'email' => 'anna@glassartisan.nl',
            ],
            [
                'username' => 'furniture_craft',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Robert Furniture',
                'email' => 'robert@furniturecraft.nl',
            ],
            [
                'username' => 'knit_creations',
                'password' => Hash::make('password123'),
                'role' => 'maker',
                'name' => 'Maria Knits',
                'email' => 'maria@knitcreations.nl',
            ],
        ];

        foreach ($makers as $maker) {
            User::create($maker);
        }

        // Create buyers
        $buyers = [
            [
                'username' => 'piet_koper',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Piet Jansen',
                'email' => 'piet@example.nl',
            ],
            [
                'username' => 'maria_liefhebber',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Maria de Vries',
                'email' => 'maria@example.nl',
            ],
            [
                'username' => 'henk_verzamelaar',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Henk Bakker',
                'email' => 'henk@example.nl',
            ],
            [
                'username' => 'sofie_kunstliefhebber',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Sofie van Dijk',
                'email' => 'sofie@example.nl',
            ],
            [
                'username' => 'tim_interieur',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Tim Vermeer',
                'email' => 'tim@example.nl',
            ],
            [
                'username' => 'lisa_collector',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Lisa de Wit',
                'email' => 'lisa@example.nl',
            ],
            [
                'username' => 'bas_ambacht',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Bas Mulder',
                'email' => 'bas@example.nl',
            ],
            [
                'username' => 'eva_cadeau',
                'password' => Hash::make('password123'),
                'role' => 'koper',
                'name' => 'Eva Groen',
                'email' => 'eva@example.nl',
            ],
        ];

        foreach ($buyers as $buyer) {
            User::create($buyer);
        }
    }
}
