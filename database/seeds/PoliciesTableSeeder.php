<?php

use Illuminate\Database\Seeder;
use App\Models\Policy;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->delete();

        $policies = ['Administrator', 'Master'];

        foreach($policies as $policy) {
            Policy::create([
               'title' => $policy,
            ]);
        }
    }
}
