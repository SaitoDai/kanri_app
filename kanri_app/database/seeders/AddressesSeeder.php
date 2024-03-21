<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("addressesの作成を開始します...");

        $memberSplFileObject = new \SplFileObject(__DIR__ . '/x-ken-all.csv');
        $memberSplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        foreach ($memberSplFileObject as $key => $row) {
            //excelでcsvを保存するとBOM付きになるので削除する
            if ($key === 0) {
                $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);
            }

            DB::table('addresses')->insert([
                'postal' => trim($row[0]),
                'prefecture' => trim($row[1]),
                'address1' => trim($row[2]),
                'address2' => trim($row[3]),
            ]);
        }
        $this->command->info("addressesを作成しました。");
    }
}
