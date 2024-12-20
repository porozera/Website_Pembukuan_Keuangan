<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret')
        ]);
                // Data accounts
        $accounts = [
            ['code' => '1-10001', 'name' => 'Kas', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10002', 'name' => 'Rekening Bank', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10003', 'name' => 'Bank Mandiri', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10004', 'name' => 'Bank Negara Indonesia (BNI)', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10005', 'name' => 'Bank Rakyat Indonesia (BRI)', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10006', 'name' => 'Bank Tabungan Negara (BTN)', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10007', 'name' => 'Bank Central Asia (BCA)', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10008', 'name' => 'GoPay', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10009', 'name' => 'OVO', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10010', 'name' => 'Dana', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10011', 'name' => 'Link Aja', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10012', 'name' => 'Cashlez', 'category' => 'Kas & Bank', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10100', 'name' => 'Piutang Usaha', 'category' => 'Akun Piutang', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10101', 'name' => 'Piutang Belum Ditagih', 'category' => 'Akun Piutang', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10200', 'name' => 'Persediaan Barang', 'category' => 'Persediaan', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10300', 'name' => 'Piutang Lainnya', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10301', 'name' => 'Piutang Karyawan', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10400', 'name' => 'Dana Belum Disetor', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10401', 'name' => 'Aset Lancar Lainnya', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10402', 'name' => 'Biaya Dibayar Di Muka', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10403', 'name' => 'Uang Muka', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10500', 'name' => 'PPN Masukan', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10501', 'name' => 'Pajak Penghasilan Dibayar Di Muka - PPh 22', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10502', 'name' => 'Pajak Penghasilan Dibayar Di Muka - PPh 23', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10503', 'name' => 'Pajak Penghasilan Dibayar Di Muka - PPh 25', 'category' => 'Harta Lancar Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10700', 'name' => 'Aktiva Tetap - Tanah', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10701', 'name' => 'Aset Tetap - Bangunan', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10702', 'name' => 'Aset Tetap - Pengembangan Bangunan', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10703', 'name' => 'Aset Tetap - Kendaraan', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10704', 'name' => 'Aset Tetap - Mesin & Peralatan', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10705', 'name' => 'Aset Tetap - Peralatan Kantor', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10706', 'name' => 'Aset Tetap - Aset Sewaan', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10707', 'name' => 'Aset Tidak Berwujud', 'category' => 'Harta Tetap', 'account_type' => 'Debit', 'description' => null],
            ['code' => '1-10751', 'name' => 'Akumulasi Penyusutan - Bangunan', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10752', 'name' => 'Akumulasi Penyusutan - Pengembangan Bangunan', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10753', 'name' => 'Akumulasi Penyusutan - Kendaraan', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10754', 'name' => 'Akumulasi Penyusutan - Mesin & Peralatan', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10755', 'name' => 'Akumulasi Penyusutan - Peralatan Kantor', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10756', 'name' => 'Akumulasi Penyusutan - Aset Sewaan', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10757', 'name' => 'Akumulasi Armotisasi', 'category' => 'Depresiasi & Armotisasi', 'account_type' => 'Credit', 'description' => null],
            ['code' => '1-10800', 'name' => 'Investasi', 'category' => 'Harta Lainnya', 'account_type' => 'Debit', 'description' => null],
            ['code' => '2-20100', 'name' => 'Hutang Usaha', 'category' => 'Akun Hutang', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20101', 'name' => 'Hutang Belum Ditagih', 'category' => 'Akun Hutang', 'account_type' => 'Debit', 'description' => null],
            ['code' => '2-20200', 'name' => 'Hutang Lainnya', 'category' => 'Kewajiban Lancar Lainnya', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20201', 'name' => 'Hutang Gaji', 'category' => 'Kewajiban Lancar Lainnya', 'account_type'=>'Credit', 'description' => null],
            ['code' => '2-20202', 'name' => 'Hutang Deviden', 'category' => 'Kewajiban Lancar Lainnya', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20203', 'name' => 'Pendapatan Diterima Di Muka', 'category' => 'Kewajiban Lancar Lainnya', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20301', 'name' => 'Sarana Kantor Terhutang', 'category' => 'Kewajiban Lancar Lainnya', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20302', 'name' => 'Bunga Terhutang', 'category' => 'Kewajiban Lancar Lainnya', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20399', 'name' => 'Biaya Terhutang lainnya', 'category' => 'Kewajiban Lancar Lainnya', 'account_type' => 'Credit', 'description' => null],
            ['code' => '2-20400', 'name' => 'Hutang Bank', 'category' => 'Kewajiban Lancar Lainnya',  'account_type'=>'Credit','description'=>null],
            ['code' => '2-20500', 'name'=> 'Hutang Pajak - PPN Keluaran','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20501', 'name'=> 'Hutang Pajak - PPh 21','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20502', 'name'=> 'Hutang Pajak - PPh 22','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20503', 'name'=> 'Hutang Pajak - PPh 23','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20504', 'name'=> 'Hutang Pajak - PPh 29','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20599', 'name'=> 'Hutang Pajak Lainnya','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20600', 'name'=> 'Hutang Dari Pemegang Saham','category'=> 'Kewajiban Lancar Lainnya','account_type'=> 'Credit','description'=>null],
            ['code' => '2-20601', 'name'=> 'Kewajiban Lancar Lainnya','category'=>'Kewajiban Lancar Lainnya','account_type'=>'Credit','description'=>null],
            ['code' => '2-20700','name'=>'Kewajiban Manfaat Karyawan','category'=>'Kewajiban Jangka Panjang','account_type'=>'Credit','description'=>null],
            ['code' => '3-30000','name'=>'Modal Saham','category'=>'Modal','account_type'=>'Credit','description'=>null],
            ['code' => '3-30001','name'=>'Modal Tambahan Modal','category'=>'Modal','account_type'=>'Credit','description'=>null],
            ['code' => '3-30100','name'=>'Laba Ditahan','category'=>'Modal','account_type'=>'Credit','description'=>null],
            ['code' => '3-30200','name'=>'Deviden','category'=>'Modal','account_type'=>'Credit','description'=>null],
            ['code' => '3-30300', 'name' => 'Pendapatan Komprehensif Lainnya', 'category' => 'Modal', 'account_type'=>'Credit', 'description' => null],
            ['code' => '3-30999' , 'name' => 'Saldo Awal Modal' , 'category' =>'Modal' , 'account_type' => 'Credit' , 'description' => null ],
            ['code' => '4-40000' , 'name' => 'Pendapatan' , 'category' => 'Pendapatan' , 'account_type' => 'Credit' , 'description' => null ],
            ['code' => '4-40100' , 'name' => 'Diskon Penjualan' , 'category' => 'Pendapatan' , 'account_type' => 'Credit' , 'description' => null ],
            ['code' => '4-40200' , 'name' => 'Pengembalian Penjualan' , 'category' => 'Pendapatan' , 'account_type' => 'Credit' , 'description' => null ],
            ['code' => '5-50000' , 'name' => 'Beban Pokok Pendapatan' , 'category' => 'Harga Pokok Penjualan' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '5-50100' , 'name' => 'Diskon Pembelian' , 'category' => 'Harga Pokok Penjualan' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '5-50200' , 'name' => 'Pengembalian Pembelian' , 'category' => 'Harga Pokok Penjualan' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '5-50300', 'name'=>'Pengiriman/Pengangkutan ', 'category'=>'Harga Pokok Penjualan', 'account_type'=> 'Debit', 'description'=>null ],
            ['code' => '5-50400', 'name'=>'Biaya Import', 'category'=>'Harga Pokok Penjualan ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '5-50500', 'name'=>'Biaya Produksi', 'category'=>'Harga Pokok Penjualan ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60000', 'name'=>'Biaya Penjualan', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60001', 'name'=>'Iklan & Promosi', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60002', 'name'=>'Komisi & Fee', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60003', 'name'=>'Bensin - Toll - dan Parkir - Penjualan', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60004', 'name'=>'Perjalanan (Travelling) - Penjualan', 'category'=>'Beban', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60005', 'name'=>'Komunikasi - Penjualan', 'category'=>'Beban', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60006', 'name'=>'Pemasaran Lainnya', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60100', 'name'=>'Biaya Umum & Administratif', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60101', 'name'=>'Gaji', 'category'=>'Beban', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60102', 'name'=>'Upah', 'category'=>'Beban', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60103', 'name'=>'Konsumsi & Transport', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60104', 'name'=>'Lembur', 'category'=>'Beban ', 'account_type'=>'Debit', 'description'=>null ],
            ['code' => '6-60105', 'name'=>'Kesehatan','category'=>'Beban','account_type' => 'Debit', 'description' => null ], 
            ['code' => '6-60106', 'name' => 'THR dan Bonus', 'category' => 'Beban', 'account_type'=>'Debit', 'description' => null], 
            ['code' => '6-60107', 'name' => 'Jamsostek', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60108', 'name' => 'Insentif', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60109', 'name' => 'Pesangon', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60110', 'name' => 'Tunjangan Lainnya', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60200', 'name' => 'Donasi', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60201', 'name' => 'Hiburan', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60202', 'name' => 'Bensin - Toll - dan Parkir - Umum', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60203', 'name' => 'Perbaikan dan Perawatan', 'category' => 'Beban', 'account_type' => 'Debit', 'description' => null],
            ['code' => '6-60204', 'name' => 'Perjalanan (Travelling) - Umum', 'category' => 'Beban',  'account_type'=>  'Debit','description'=>null],
            ['code' => '6-60205', 'name'=> 'Konsumsi', 'category'=> 'Beban', 'account_type'=> 'Debit', 'description'=>null],
            ['code' => '6-60206', 'name'=> 'Komunikasi - Umum', 'category'=> 'Beban', 'account_type'=> 'Debit', 'description'=>null],
            ['code' => '6-60207', 'name'=> 'Iuran & Berlangganan', 'category'=> 'Beban', 'account_type'=> 'Debit', 'description'=>null],
            ['code' => '6-60208', 'name'=> 'Asuransi', 'category'=> 'Beban', 'account_type'=> 'Debit', 'description'=>null],
            ['code' => '6-60209', 'name'=> 'Biaya Hukum & Professional', 'category'=> 'Beban', 'account_type'=> 'Debit',  'description'=>null],
            ['code' => '6-60210', 'name'=>'Beban Tunjangan Karyawan', 'category'=>'Beban','account_type'=>'Debit','description'=>null],
            ['code' => '6-60211', 'name'=>'Sarana Kantor','category '=>'Beban','account_type'=>'Debit','description '=>null],
            ['code' => '6-60212','name'=>'Pelatihan & Pengembangan','category '=>'Beban','account_type'=>'Debit','description '=>null],
            ['code' => '6-60213','name'=>'Beban Hutang Buruk','category '=>'Beban','account_type'=>'Debit','description '=>null],
            ['code' => '6-60214','name'=>'Pajak & Lisensi','category '=>'Beban', 'account_type'=>'Debit','description'=> null ],
            ['code' => '6-60215' , 'name' => 'Denda' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60216' , 'name' => 'Pengeluaran Barang Rusak' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60300' , 'name' => 'Beban Kantor' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60301' , 'name' => 'ATK & Print' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60302' , 'name' => 'Materai' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60303' , 'name' => 'Keamanan & Kebersihan' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60304' , 'name' => 'Persediaan Material ', 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6-60305' , 'name' => 'Sub Kontraktor' , 'category' => 'Beban' , 'account_type' => 'Debit' , 'description' => null ],
            ['code' => '6–60400', 'name'=> 'Beban Sewa – Bangunan' ,'category' => 'Beban' ,'account_type' => 'Debit' ,'description' => null],  
            ['code' => '7–70000','name'=>'Pendapatan Bunga – Bank','category'=>'Pendapatan Lainnya','account_type'=>'Credit','description'=>null],  
            ['code' => '7–70001','name'=>'Pendapatan Bunga – Waktu Deposit','category'=>'Pendapatan Lainnya','account_type'=>'Credit','description'=>null],  
            ['code' => '7–70099','name'=>'Pendapatan Lainnya','category'=>'Pendapatan Lainnya','account_type'=>'Credit','description'=>null],  
            ['code' => '8–80000','name'=>'Beban Bunga ','category'=>'Beban Lainnya ','account_type'=>'Debit','description'=>null],  
            ['code' => '8–80001','name'=>'Persediaan ','category'=>'Beban Lainnya ','account_type'=>'Debit','description'=>null],  
            ['code' => '8–80002','name'=>'(Keuntungan) / Kerugian Pembuangan Aset Tetap','category' => 'Beban Lainnya', 'account_type' => 'Debit','description' => null],  
            ['code' => '8–80100','name' => 'Penyesuaian Persediaan','category' => 'Beban Lainnya','account_type'=>'Debit','description' =>null],  
            ['code' => '8–80999','name' =>'Biaya lain','category'=>'Biaya lain','account_type'=>'Debit','description'=> null ],
            ['code' => '9–90000','name' => 'Pajak Penghasilan-Saat Ini','category'=>'Biaya lain','account_type'=>'Debit','description'=>null] ,
            ['code' => '9–90001','name' =>'Pajak Penghasilan-Ditangguhkan','category'=>'Biaya lain','account_type'=>'Debit','description'=>null],
        ];

        foreach ($accounts as $index => $account) {
            if (empty($account['account_type']) || !in_array($account['account_type'], ['Debit', 'Credit'])) {
                $code = $account['code'] ?? 'UNKNOWN';
                throw new \Exception("Account type is invalid or missing at index $index (Code: $code).");
            }
        }
        // Insert data ke tabel accounts
        DB::table('accounts')->insert($accounts);
    }
}
