<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('321'),
            'role' => 'admin',
        ]);
        User::create([
            'username' => 'Creator1',
            'email' => 'creator1@gmail.com',
            'password' => bcrypt('321'),
            'role' => 'creator',
        ]);
        User::create([
            'username' => 'Creator2',
            'email' => 'creator2@gmail.com',
            'password' => bcrypt('321'),
            'role' => 'creator',
        ]);
        User::create([
            'username' => 'Creator3',
            'email' => 'creator3@gmail.com',
            'password' => bcrypt('321'),
            'role' => 'creator',
        ]);
        User::create([
            'username' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('321'),
            'role' => 'customer',
        ]);

        Event::create([
            'nama_penyelenggara' => 'CroudSound',
            'cover_event' => 'components/asset/offline1.jpg',
            'nama_event' => 'Croud Sound',
            'tanggal_event' => '22 Februari 2025',
            'waktu_event' => '15.00 WIB',
            'lokasi_event' => 'Jatim explo, Surabaya',
            'deskripsi_event' => ' "CROWD SOUND ID" adalah konsep acara konser yang MAYORITAS GENRE EDM, yang mana memberikan pengalaman yang berkesan dan penuh riang gembira. dengan konsep multi stage yang kami usung, menjadi salah satu improvisasi yang baru dimana hal ini belum pernah dilakukan sebelumnya di kota surabaya. Target kami adalah bisa menghadirkan musisi dan artis skala nasional dan internasional yang bilamana ini terwujud maka akan menjadi ajang klreatifitas karya musik event yang unggul.',
            'user_id'=> '2'
        ]);

        Event::create([
            'nama_penyelenggara' => 'Funbike Nusantara',
            'cover_event' => 'components/asset/offline2.jpg',
            'nama_event' => 'Nusantara Funbike',
            'tanggal_event' => '12 Januari 2025',
            'waktu_event' => '07.00 WIB',
            'lokasi_event' => 'Paseben Agung, Mojokerto',
            'deskripsi_event' => 'Bergabunglah dalam acara Fun Bike, sebuah perayaan bersepeda yang menggabungkan kesenangan dan olahraga dalam satu pengalaman yang tak terlupakan! Dirancang untuk semua kalangan usia dan tingkat kebugaran, Fun Bike adalah kesempatan sempurna untuk merayakan kesehatan sambil menikmati udara segar dan pemandangan yang menakjubkan.',
            'user_id'=> '2'
        ]);

        Event::create([
            'nama_penyelenggara' => 'nae',
            'cover_event' => 'components/asset/s3.jpeg',
            'nama_event' => 'event nae',
            'tanggal_event' => '2022-02-25',
            'waktu_event' => '10:00',
            'lokasi_event' => 'jalan kemiri',
            'deskripsi_event' => 'ini adalah sebuah event contoh',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'cumi',
            'cover_event' => 'components/asset/s4.jpeg',
            'nama_event' => 'event cumi',
            'tanggal_event' => '2022-02-25',
            'waktu_event' => '10:00',
            'lokasi_event' => 'jalan kemiri',
            'deskripsi_event' => 'ini adalah sebuah event contoh',
            'user_id'=> '2'
        ]);



        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>35000,
           'jumlah_tiket' =>100,
           'event_id' => '1'
        ]);
        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>200000,
           'jumlah_tiket' =>100,
           'event_id' => '2'
        ]);
        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>75000,
           'jumlah_tiket' =>100,
           'event_id' => '3'
        ]);
        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>10000,
           'jumlah_tiket' =>100,
           'event_id' => '4'
        ]);
        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>55000,
           'jumlah_tiket' =>100,
           'event_id' => '5'
        ]);
        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>50000,
           'jumlah_tiket' =>100,
           'event_id' => '6'
        ]);
        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>30000,
           'jumlah_tiket' =>100,
           'event_id' => '7'
        ]);
        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>37000,
           'jumlah_tiket' =>100,
           'event_id' => '8'
        ]);
        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>22000,
           'jumlah_tiket' =>100,
           'event_id' => '9'
        ]);
        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>25000,
           'jumlah_tiket' =>100,
           'event_id' => '10'
        ]);

        // Transaksi::create([
        //    'tiket_dibeli'=>'1',
        //    'tanggal_transaksi'=>'2022-02-20',
        //    'jumlah_tiket'=>'1',
        //    'total_transaksi'=>'200000',
        //    'nama_lengkap'=>'customer',
        //    'no_ktp'=>'123456789',
        //    'no_telepon'=>'123456789',
        //    'email'=>'customer@gmail.com',
        //    'tiket_id'=>'1',
        //    'event_id'=>'1'
        // ]);

    }
}
