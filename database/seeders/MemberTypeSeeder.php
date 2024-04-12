<?php

namespace Database\Seeders;

use App\Models\MemberType;
use Illuminate\Database\Seeder;

class MemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberType::factory()->create(['id' => 1, 'type' => 'Professor(a)']);
        MemberType::factory()->create(['id' => 2, 'type' => 'Estudante']);
    }
}
