<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $customers = [
        //     [
        //         'nama' => 'Fauzan Zaman',
        //         'jenis_identitas' => 'KTP',
        //         'nomor_identitas' => '3603232812000341',
        //         'jabatan' => 'Chief Technology Officer',
        //         'alamat' => 'Tangerang Selatan No. 70',
        //         'kota' => 'Kota Tangerang',
        //         'provinsi' => 'Banten',
        //         'telp' => '0213551235',
        //         'fax' => '0315551234',
        //         'handphone' => '0812 3213 3321',
        //         "is_perusahaan" => "1",
        //         'surat_kuasa' => "0",
        //         'badan_hukum' => 'PT',
        //         'nama_perusahaan' => 'Quantum Computer Tech',
        //         'alamat_perusahaan' => 'Jl Tangerang Selatan No. 70',
        //         'kota_perusahaan' => 'Tangerang Selatan',
        //         'provinsi_perusahaan' => 'Tangerang',
        //         'telp_perusahaan' => '021 9423441',
        //         'fax_perusahaan' => '021 9423441',
        //         'keterangan' => 'Memesan Scafolding',
        //         'bonafidity' => '$$',
        //         'status_customer_id' => 1, 
        //     ],
        //     [
        //         'nama' => 'Mita Ayu Lestari',
        //         'jenis_identitas' => 'KTP',
        //         'nomor_identitas' => '3603232812000123',
        //         'jabatan' => 'Chief Technology Officer',
        //         'alamat' => 'Petukangan Selatan No. 30',
        //         'kota' => 'Jakarta Selatan',
        //         'provinsi' => 'DKI Jakarta',
        //         'telp' => '021 8524731',
        //         'fax' => '021 5551234',
        //         'handphone' => '0812 9128 9955',
        //         'is_perusahaan' => "0",
        //         'surat_kuasa' => "0",
        //         'keterangan' => 'Memesan Scafolding',
        //         'bonafidity' => '$$',
        //         'status_customer_id' => 1, 
        //     ],
        //     [
        //         'nama' => 'Faisal Yunianto',
        //         'jenis_identitas' => 'SIM',
        //         'identitas_berlaku' => '06/08/2027',
        //         'nomor_identitas' => '36032335004211',
        //         'jabatan' => 'Chief Technology Officer',
        //         'alamat' => 'Semarang Tawang Bank Jateng Jl Asprindo No. 11',
        //         'kota' => 'Semarang',
        //         'provinsi' => 'Jawa Tengah',
        //         'telp' => '021 3551235',
        //         'fax' => '021 5551234',
        //         'handphone' => '0852 9128 9238',
        //         "is_perusahaan" => "1",
        //         'surat_kuasa' => "0",
        //         'badan_hukum' => 'PT',
        //         'nama_perusahaan' => 'Data Excel Sejahtera',
        //         'alamat_perusahaan' => 'Semarang Tawang Bank Jateng',
        //         'kota_perusahaan' => 'Semarang',
        //         'provinsi_perusahaan' => 'Jawa Tengah',
        //         'telp_perusahaan' => '021 9423531',
        //         'fax_perusahaan' => '021 9423531',
        //         'keterangan' => 'Memesan Scafolding',
        //         'bonafidity' => '$$',
        //         'status_customer_id' => 1, 
        //     ],
        //     [
        //         'nama' => 'Ahmad Daffa',
        //         'jenis_identitas' => 'KTP',
        //         'nomor_identitas' => '360123192839123',
        //         'jabatan' => 'Chief Technology Officer',
        //         'alamat' => 'Semarang Tawang Bank Jateng Jl Asprindo No. 123',
        //         'kota' => 'Semarang',
        //         'provinsi' => 'Jawa Tengah',
        //         'telp' => '021 3551235',
        //         'fax' => '021 5551234',
        //         'handphone' => '0852 9128 4123',
        //         "is_perusahaan" => "1",
        //         'surat_kuasa' => "0",
        //         'badan_hukum' => 'PT',
        //         'nama_perusahaan' => 'Logistik Alam Jaya',
        //         'alamat_perusahaan' => 'Semarang Tawang Bank Jateng',
        //         'kota_perusahaan' => 'Semarang',
        //         'provinsi_perusahaan' => 'Jawa Tengah',
        //         'telp_perusahaan' => '021 9423531',
        //         'fax_perusahaan' => '021 9423531',
        //         'keterangan' => 'Memesan Scafolding',
        //         'bonafidity' => '$$',
        //         'status_customer_id' => 1, 
        //     ],
        //     [
        //         'nama' => 'Dono',
        //         'jenis_identitas' => 'KTP',
        //         'nomor_identitas' => '182731892371872',
        //         'jabatan' => 'Chief Technology Officer',
        //         'alamat' => 'Semarang Tawang Bank Jateng Jl Asprindo No. 123',
        //         'kota' => 'Semarang',
        //         'provinsi' => 'Jawa Tengah',
        //         'telp' => '021 3551235',
        //         'fax' => '021 5551234',
        //         'handphone' => '0852 9128 6345',
        //         "is_perusahaan" => "1",
        //         'surat_kuasa' => "0",
        //         'badan_hukum' => 'PT',
        //         'nama_perusahaan' => 'Warkop DKI',
        //         'alamat_perusahaan' => 'Semarang Tawang Bank Jateng',
        //         'kota_perusahaan' => 'Semarang',
        //         'provinsi_perusahaan' => 'Jawa Tengah',
        //         'telp_perusahaan' => '021 9423531',
        //         'fax_perusahaan' => '021 9423531',
        //         'keterangan' => 'Memesan Scafolding',
        //         'bonafidity' => '$$',
        //         'status_customer_id' => 1, 
        //     ],
        // ];

        // foreach($customers as $customer){
        //     Customer::createCustomer($customer);
        // }
        $faker = Faker::create('id_ID');
        $customers = [];

        for ($i = 0; $i < 100; $i++) {
                // Menentukan jenis identitas
                $jenis_identitas = $faker->randomElement(['KTP', 'SIM']);
                
                // Menentukan identitas_berlaku, hanya jika jenis identitas adalah SIM
                $identitas_berlaku = $jenis_identitas === 'SIM' ? $faker->date($format = 'd/m/Y', $max = 'now +5 years') : null;

                $is_perusahaan = $faker->boolean;
                $customers[] = [
                    'nama' => $faker->name,
                    'jenis_identitas' => $jenis_identitas,
                    'identitas_berlaku' => $identitas_berlaku,
                    'nomor_identitas' => $faker->numerify('##########'),
                    'jabatan' => 'Chief Technology Officer',
                    'alamat' => $faker->address,
                    'kota' => $faker->city,
                    'provinsi' => $faker->state,
                    'telp' => $faker->phoneNumber,
                    'fax' => $faker->phoneNumber,
                    'handphone' => $faker->phoneNumber,
                    'is_perusahaan' => $is_perusahaan,
                    'surat_kuasa' => $faker->boolean ? '1' : '0',
                    'badan_hukum' => $is_perusahaan ? 'PT' : null,
                    'nama_perusahaan' => $is_perusahaan ? $faker->company : null,
                    'alamat_perusahaan' => $is_perusahaan ? $faker->address : null,
                    'kota_perusahaan' => $is_perusahaan ? $faker->city : null,
                    'provinsi_perusahaan' => $is_perusahaan ? $faker->state : null,
                    'telp_perusahaan' => $is_perusahaan ? $faker->phoneNumber : null,
                    'fax_perusahaan' => $is_perusahaan ? $faker->phoneNumber : null,
                    'keterangan' => 'Memesan Scafolding',
                    'bonafidity' => $faker->randomElement(['$', '$$', '$$$']),
                    'status_customer_id' => 1, // Sesuaikan dengan ID status yang relevan
                ];
        }
        
        foreach( $customers as $customer){
            Customer::createCustomer($customer); 
        }
    }
}
