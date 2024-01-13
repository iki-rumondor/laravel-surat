<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->truncate();

        DB::table('kategori')->insert([
            [
                'nama' => 'Laporan Pertanggung Jawaban',
                'jenis' => 'Dokumen',
            ],
            [
                'nama' => 'Rencana Anggaran',
                'jenis' => 'Dokumen',
            ]
        ]);
    }
}
