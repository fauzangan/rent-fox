<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'nama' => 'Fauzan Zaman',
                'jenis_identitas' => 'KTP',
                'nomor_identitas' => '3603232812000341',
                'jabatan' => 'Chief Technology Officer',
                'alamat' => 'Tangerang Selatan No. 70',
                'kota' => 'Kota Tangerang',
                'provinsi' => 'Banten',
                'telp' => '0213551235',
                'fax' => '0315551234',
                'handphone' => '0812 3213 3321',
                "is_perusahaan" => "1",
                'surat_kuasa' => "0",
                'badan_hukum' => 'PT',
                'nama_perusahaan' => 'Quantum Computer Tech',
                'alamat_perusahaan' => 'Jl Tangerang Selatan No. 70',
                'kota_perusahaan' => 'Tangerang Selatan',
                'provinsi_perusahaan' => 'Tangerang',
                'telp_perusahaan' => '021 9423441',
                'fax_perusahaan' => '021 9423441',
                'keterangan' => 'Memesan Scafolding',
                'bonafidity' => '$$',
                'status_customer_id' => 1, 
            ],
            [
                'nama' => 'Mita Ayu Lestari',
                'jenis_identitas' => 'KTP',
                'nomor_identitas' => '3603232812000123',
                'jabatan' => 'Chief Technology Officer',
                'alamat' => 'Petukangan Selatan No. 30',
                'kota' => 'Jakarta Selatan',
                'provinsi' => 'DKI Jakarta',
                'telp' => '021 8524731',
                'fax' => '021 5551234',
                'handphone' => '0812 9128 9955',
                'is_perusahaan' => "0",
                'surat_kuasa' => "0",
                'keterangan' => 'Memesan Scafolding',
                'bonafidity' => '$$',
                'status_customer_id' => 1, 
            ],
            [
                'nama' => 'Faisal Yunianto',
                'jenis_identitas' => 'SIM',
                'identitas_berlaku' => '06/08/2027',
                'nomor_identitas' => '36032335004211',
                'jabatan' => 'Chief Technology Officer',
                'alamat' => 'Semarang Tawang Bank Jateng Jl Asprindo No. 11',
                'kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'telp' => '021 3551235',
                'fax' => '021 5551234',
                'handphone' => '0852 9128 9238',
                "is_perusahaan" => "1",
                'surat_kuasa' => "0",
                'badan_hukum' => 'PT',
                'nama_perusahaan' => 'Data Excel Sejahtera',
                'alamat_perusahaan' => 'Semarang Tawang Bank Jateng',
                'kota_perusahaan' => 'Semarang',
                'provinsi_perusahaan' => 'Jawa Tengah',
                'telp_perusahaan' => '021 9423531',
                'fax_perusahaan' => '021 9423531',
                'keterangan' => 'Memesan Scafolding',
                'bonafidity' => '$$',
                'status_customer_id' => 1, 
            ],
            [
                'nama' => 'Ahmad Daffa',
                'jenis_identitas' => 'KTP',
                'nomor_identitas' => '360123192839123',
                'jabatan' => 'Chief Technology Officer',
                'alamat' => 'Semarang Tawang Bank Jateng Jl Asprindo No. 123',
                'kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'telp' => '021 3551235',
                'fax' => '021 5551234',
                'handphone' => '0852 9128 4123',
                "is_perusahaan" => "1",
                'surat_kuasa' => "0",
                'badan_hukum' => 'PT',
                'nama_perusahaan' => 'Logistik Alam Jaya',
                'alamat_perusahaan' => 'Semarang Tawang Bank Jateng',
                'kota_perusahaan' => 'Semarang',
                'provinsi_perusahaan' => 'Jawa Tengah',
                'telp_perusahaan' => '021 9423531',
                'fax_perusahaan' => '021 9423531',
                'keterangan' => 'Memesan Scafolding',
                'bonafidity' => '$$',
                'status_customer_id' => 1, 
            ],
            [
                'nama' => 'Dono',
                'jenis_identitas' => 'KTP',
                'nomor_identitas' => '182731892371872',
                'jabatan' => 'Chief Technology Officer',
                'alamat' => 'Semarang Tawang Bank Jateng Jl Asprindo No. 123',
                'kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'telp' => '021 3551235',
                'fax' => '021 5551234',
                'handphone' => '0852 9128 6345',
                "is_perusahaan" => "1",
                'surat_kuasa' => "0",
                'badan_hukum' => 'PT',
                'nama_perusahaan' => 'Warkop DKI',
                'alamat_perusahaan' => 'Semarang Tawang Bank Jateng',
                'kota_perusahaan' => 'Semarang',
                'provinsi_perusahaan' => 'Jawa Tengah',
                'telp_perusahaan' => '021 9423531',
                'fax_perusahaan' => '021 9423531',
                'keterangan' => 'Memesan Scafolding',
                'bonafidity' => '$$',
                'status_customer_id' => 1, 
            ],
        ];

        foreach($customers as $customer){
            Customer::createCustomer($customer);
        }
    }
}
