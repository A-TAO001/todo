<?php
// use宣言とは、これからファイルの内部で使うクラスや関数や定数、名前空間の一部などをインポートするために使います。
use Carbon\Carbon;
use Illuminate\Database\Seeder;
// DBを使っていたらクエリビルダ、Facadesはクラスをインスタンス化しなくても使えるようにする仕組み
use Illuminate\Support\Facades\DB;


class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first(); // ★
        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            // foldersテーブルにインサート処理をします
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id, // ★
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
