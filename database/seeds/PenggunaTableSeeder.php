<?php

use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncatePengguna = DB::table('pengguna')
            ->truncate();

        $createPengguna = DB::table('pengguna')
            ->insert([
                [
                    'nama'=>'Admin',
                    'nip'=>'A101',
                    'password' => bcrypt('secret'),
                    'role' => 'Super Admin'
                ],
                [
                    'nama'=>'Kepala Dinas',
                    'nip'=>'KD001',
                    'password' => bcrypt('kadis'),
                    'role' => 'Kadis'
                ],
                [
                    'nama'=>'Kepala Kasubag',
                    'nip'=>'KK001',
                    'password' => bcrypt('kasubag'),
                    'role' => 'Kasubag'
                ],
                [
                    'nama'=>'Sekretaris',
                    'nip'=>'SK001',
                    'password' => bcrypt('sekretaris'),
                    'role' => 'Sekretaris'
                ],
            ]);
    }
}
