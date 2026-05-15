<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Semua user di bawah ini akan memiliki password: password123
        $defaultPassword = password_hash('password123', PASSWORD_DEFAULT);

        $data_users = [
            [
                'username' => 'andi_kristianto',
                'email'    => 'andi@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'budi_santoso',
                'email'    => 'budi@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'citra_kirana',
                'email'    => 'citra@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'dewi_lestari',
                'email'    => 'dewi@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'eka_putra',
                'email'    => 'eka@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'fajar_nugraha',
                'email'    => 'fajar@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'gita_savitri',
                'email'    => 'gita@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'hendra_wijaya',
                'email'    => 'hendra@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'indah_permatasari',
                'email'    => 'indah@contoh.com',
                'password' => $defaultPassword,
            ],
            [
                'username' => 'joko_anwar',
                'email'    => 'joko@contoh.com',
                'password' => $defaultPassword,
            ],
        ];

        // Memasukkan data ke tabel users secara massal (batch)
        $this->db->table('users')->insertBatch($data_users);
    }
}