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
            'nama_penyelenggara' => 'alipa',
            'cover_event' => 'components/asset/s5.jpeg',
            'nama_event' => 'event alipa',
            'tanggal_event' => '2022-02-25',
            'waktu_event' => '10:00',
            'lokasi_event' => 'jalan kemiri',
            'deskripsi_event' => 'ini adalah sebuah event contoh',
            'user_id'=> '2'
        ]);

        Event::create([
            'nama_penyelenggara' => 'ajelo',
            'cover_event' => 'components/asset/s2.jpeg',
            'nama_event' => 'event ajelo',
            'tanggal_event' => '2022-02-25',
            'waktu_event' => '10:00',
            'lokasi_event' => 'jalan kemiri',
            'deskripsi_event' => 'ini adalah sebuah event contoh',
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
            'user_id'=> '3'
        ]);
        Event::create([
            'nama_penyelenggara' => 'cumi',
            'cover_event' => 'components/asset/s4.jpeg',
            'nama_event' => 'event cumi',
            'tanggal_event' => '2022-02-25',
            'waktu_event' => '10:00',
            'lokasi_event' => 'jalan kemiri',
            'deskripsi_event' => 'ini adalah sebuah event contoh',
            'user_id'=> '3'
        ]);

        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>'200000',
           'jumlah_tiket' =>'100',
           'event_id' => '1'
        ]);
        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>'200000',
           'jumlah_tiket' =>'100',
           'event_id' => '2'
        ]);
        Tiket::create([
           'kategori_tiket' =>'online',
           'harga_tiket' =>'200000',
           'jumlah_tiket' =>'100',
           'event_id' => '3'
        ]);
        Tiket::create([
           'kategori_tiket' =>'offline',
           'harga_tiket' =>'200000',
           'jumlah_tiket' =>'100',
           'event_id' => '4'
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
