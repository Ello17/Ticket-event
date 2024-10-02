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
<<<<<<<<< Temporary merge branch 1
            'nama_penyelenggara' => 'jtc festival',
            'cover_event' => 'components/asset/offline3.jpg',
            'nama_event' => 'JFEST Vol.8 20204',
            'tanggal_event' => '09 Desember 2024',
            'waktu_event' => '10.00 WIB',
            'lokasi_event' => 'Jatim explo, Surabaya',
            'deskripsi_event' => 'Jangan Lewatkan bakalan banyak brand dan Guest star yang bikin event ini makin meriah !! Goyang Bersama Jfest Music Guys !! See You',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'FBS_Festival',
            'cover_event' => 'components/asset/offline4.jpg',
            'nama_event' => 'FBS Festival 2024',
            'tanggal_event' => '07 Desember 2024',
            'waktu_event' => '14.00 WIB',
            'lokasi_event' => 'Lapangan FBS UNESA Lidah Wetan, Surabaya',
            'deskripsi_event' => 'Feel the Beat of the Sounds tahun ini mengambil tema Gandrung Alunan Nada dalam Senandung Relungan Jiwa yang siap untuk memberikan kesan menyentuh hati dan kebahagiaan menyambut akhir tahun 2024. Selain ngonser, ada lomba-lomba seputar seni dan budaya yang tak kalah serunya. Persiapkan dirimu untuk mengikuti serangkaian acara FBS FEST 2024 di Lapangan FBS Universitas Negeri Surabaya, Lidah Wetan.',
            'user_id'=> '2'
=========
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
>>>>>>>>> Temporary merge branch 2
        ]);
        Event::create([
            'nama_penyelenggara' => 'Weekfest',
            'cover_event' => 'components/asset/offline5.jpg',
            'nama_event' => 'WEEKFEST 2024',
            'tanggal_event' => '16 November 2024',
            'waktu_event' => '14.00 WIB',
            'lokasi_event' => 'Balai Pemuda Jl. Gubernur Suryo no.15, Surabaya',
            'deskripsi_event' => 'Festival bertajuk Weekfest ini mengusung tema “Voice Your Heart Through Happiness” yang akan memberikan kita susana akhir pekan yang menggembirakan. Bersiaplah untuk menyelami pengalaman seru di Weekfest 2024. Event ini dirancang sebagai wujud nyata karya anak muda untuk menggabungkan seni, budaya, musik, talkshow dan kuliner dalam satu event yang tak boleh weekly lewatkan.',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'surabayaevent',
            'cover_event' => 'components/asset/online1.jpg',
            'nama_event' => 'Webinar Nasional Keperawatan',
            'tanggal_event' => '22 Oktober 2024',
            'waktu_event' => '14.00 WIB',
            'lokasi_event' => ' Institut Kesehatan dan Bisnis Surabaya, Surabaya',
            'deskripsi_event' => 'Dalam kegiatan tersebut mahasiswa keperawatan diharapkan mampu melakukan pengambilan keputusan untuk mengembangkan dan meningkatkan kesejahteraan organisasi dan profesi. Serta dalam meningkatkan derajat kesehatan dan kemampuan perawat dalam menjalankan tugas sebagai profesi yang professional dalam menjalankan tugas untuk menjaga keselamatan diri dan orang lain. Dengan harapan mahasiswa kesehatan terutama calon profesi keperawatan memiliki persiapan peran dan kompetensi di berbagai tatanan layanan kesehatan.',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'Festivalif',
            'cover_event' => 'components/asset/online2.jpg',
            'nama_event' => 'Festivalif "Swavarna" Seminar Literasi',
            'tanggal_event' => '28 Oktober 2024',
            'waktu_event' => '11.00 WIB',
            'lokasi_event' => ' Jl. Pabelan I, Pabelan Satu, Pabelan, Kec. Mungkid, Kabupaten Magelang, Jawa Tengah, KABUPATEN MAGELANG',
            'deskripsi_event' => 'Festivalif Book Party merupakan sebuah pesta raya untuk para penggemar buku yang selalu haus dengan bacaan. Pada kesempatan kali ini, kami mendatangkan langsung salah satu penulis best seller untuk menemani para penggemar buku dalam kegiatan Seminar Literasi. Kegiatan ini tentunya sangat menarik sekali serta dapat menambah pengetahuan sekaligus referensi bagi para penggemar buku.',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'Dynamic',
            'cover_event' => 'components/asset/online3.jpg',
            'nama_event' => 'DYNAMIC (Diskusi Inovasi dalam Bisnis Creative)',
            'tanggal_event' => '27 Oktober 2024',
            'waktu_event' => '08.00 WIB',
            'lokasi_event' => ' Gedung SerbaGuna GSG UNESA Ketintang, Surabaya',
            'deskripsi_event' => 'Acara Talkshow Nasional yang diselenggarakan oleh Himpunan Mahasiswa Prodi Bisnis Digital dan Himpunan Mahasiswa Prodi Manajemen UNESA yang mengkolaborasikan Talkshow dengan Start-Up Exhibition. Menghadirkan tiga pakar ternama untuk memaparkan wawasan dan pengetahuannya tentang Branding, Kepemimpinan, dan Inovasi dalam Bisnis Creative dengan ditemani oleh moderator.',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'Movservation2024',
            'cover_event' => 'components/asset/online4.jpg',
            'nama_event' => 'Movservation 2024',
            'tanggal_event' => '02 November 2024',
            'waktu_event' => '07.30 WIB',
            'lokasi_event' => ' Teater Fisip Universitas Diponegoro, Semarang',
            'deskripsi_event' => 'Movservation 2024 merupakan sebuah acara tahunan yang menjadi wadah publikasi dan penayangan karya anak bangsa. Dalam kegiatan ini, kami memberikan kesempatan bagi semua pihak untuk menghargai karya-karya sineas lokal, serta meningkatkan kesadaran mahasiswa dan masyarakat luas terhadap pentingnya pelestarian industri perfilman. Kami berharap para penonton bisa lebih peduli terhadap isu-isu sosial dan politik serta memahami bagaimana budaya yang ada berperan dalam membentuk masyarakat.',
            'user_id'=> '2'
        ]);
        Event::create([
            'nama_penyelenggara' => 'Indiefest 2024',
            'cover_event' => 'components/asset/online5.jpg',
            'nama_event' => 'Indiefest 2024',
            'tanggal_event' => '09 November 2024',
            'waktu_event' => '09.45 WIB',
            'lokasi_event' => ' Universitas Pakuan Bogor, Bogor',
            'deskripsi_event' => 'Indiefest 2024 adalah Festival Film Pelajar SMK/SMA sederajat yang diselenggarakan oleh Club Lobi Pilm (CLP) dari Studi Ilmu Komunikasi, Universitas Pakuan Bogor. Selain perlombaan film, Indiefest 2024 juga menyajikan pertunjukan seni seperti duet vokal, dance, dan solo vokal.',
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
