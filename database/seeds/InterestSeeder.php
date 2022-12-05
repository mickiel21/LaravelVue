<?php

use Illuminate\Database\Seeder;
use App\Models\Interest;
class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interests = [
         'Balance impactful knowledgebase',
         'Digitized value-added adapter',
         'Distributed high-level extranet',
         'Horizontal bottom-line archive',
         'integrated actuating algorithm',
         'Persistent fresh-thinking blockchain',
         'Seamless secondary archive',
         'Synergized modular moratorium',
         'Team-oriented bachground architecture',
         'Total mazimized hierarch'

        ];


        foreach($interests as $interest){
            Interest::create(['name' => $interest]);
        }
    }
}
