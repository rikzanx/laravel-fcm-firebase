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
                'foto' => 'tenda-dome-kapasitas-2.jfif',
                'harga' => 40000
            ),
            array(
                'nama' => 'Tenda Dome Kapasitas 4',
                'foto' => 'tenda-dome-kapasitas-4.jfif',
                'harga' => 65000
            ),
            array(
                'nama' => 'Carrier',
                'foto' => 'carrier.webp',
                'harga' => 30000
            ),
            array(
                'nama' => 'Sleeping Bag',
                'foto' => 'sleeping-bag.jfif',
                'harga' => 15000
            ),
            array(
                'nama' => 'Nesting',
                'foto' => 'nesting.png',
                'harga' => 10000
            ),
            array(
                'nama' => 'Matras',
                'foto' => 'matras.avif',
                'harga' => 5000
            ),
            array(
                'nama' => 'Flysheet',
                'foto' => 'flysheet.webp',
                'harga' => 20000
            ),
            array(
                'nama' => 'Headlamp',
                'foto' => 'headlamp.jpg',
                'harga' => 5000
            ),
            array(
                'nama' => 'Traking Pool',
                'foto' => 'traking-pool.jpg',
                'harga' => 20000
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
                'harga' => $barang['harga'],
                'deskripsi' => 'Deskripsi : '.$barang['nama'],
                'stock' => 100,
                'stock_ready' => 100
            ]);
        }
    }
}
