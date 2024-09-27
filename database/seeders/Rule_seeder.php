<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Rule_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
rule::create($this->rule_data());
    }
    public function rule_data(){
        return [
'title'=>"first rule",
            'description'=>"access all data",
        ];
    }
}
