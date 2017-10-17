<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
final class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PrestoSeeder::class);
    }
}
