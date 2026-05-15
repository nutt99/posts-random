<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $data_posts = [];
        $kategori = ['Pemandangan', 'Arsitektur', 'Makanan', 'Teknologi', 'Seni', 'Hewan Peliharaan', 'Fashion', 'Otomotif', 'Desain Interior', 'Kutipan'];

        // Looping untuk 10 User (ID 1 sampai 10)
        for ($user_id = 1; $user_id <= 10; $user_id++) {
            
            // Tiap user membuat 10 postingan
            for ($post_num = 1; $post_num <= 10; $post_num++) {
                
                // Ambil kata acak dari array kategori untuk variasi judul
                $tema = $kategori[array_rand($kategori)];
                
                // Tinggi gambar diacak agar efek Masonry Grid-nya terlihat bagus
                $tinggiGambar = rand(300, 700);

                $data_posts[] = [
                    'id_user'     => $user_id,
                    'title'       => "Ide $tema Keren ke-$post_num",
                    'description' => "Ini adalah deskripsi untuk postingan dengan tema $tema yang diunggah oleh pengguna dengan ID $user_id. Sangat menginspirasi!",
                    // Menggunakan gambar dari internet
                    'content_url' => "https://picsum.photos/400/$tinggiGambar?random=" . rand(1, 9999),
                ];
            }
        }

        // Memasukkan 100 data sekaligus ke tabel posts
        $this->db->table('posts')->insertBatch($data_posts);
    }
}