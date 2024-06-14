<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangs = Array(
            array(
                'nama' => 'Tenda Dome Kapasitas 2',
                'foto' => 'tenda-dome-kapasitas-2.jfif'
            ),
            array(
                'nama' => 'Tenda Dome Kapasitas 4',
                'foto' => 'tenda-dome-kapasitas-4.jfif'
            ),
            array(
                'nama' => 'Carrier',
                'foto' => 'carrier.webp'
            ),
            array(
                'nama' => 'Sleeping Bag',
                'foto' => 'sleeping-bag.jfif'
            ),
            array(
                'nama' => 'Nesting',
                'foto' => 'nesting.png'
            ),
            array(
                'nama' => 'Matras',
                'foto' => 'matras.avif'
            ),
            array(
                'nama' => 'Flysheet',
                'foto' => 'flysheet.webp'
            ),
            array(
                'nama' => 'Headlamp',
                'foto' => 'headlamp.jpg'
            ),
            array(
                'nama' => 'Traking Pool',
                'foto' => 'traking-pool.jpg'
            ),
        );

        foreach($barangs as $barang){
            $existingCount = \App\Models\Barang::count();
            $nextId = str_pad($existingCount + 1, 4, '0', STR_PAD_LEFT);
            $nextId = 'B'.$nextId;

            \App\Models\Barang::create([
                'kode' => $nextId,
                'nama' => $barang['nama'],
                'foto' => $barang['foto'],
                'deskripsi' => 'Deskripsi : '.$barang['nama']
            ]);
        }
    }
}
