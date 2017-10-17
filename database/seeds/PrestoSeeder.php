<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use Illuminate\Database\DatabaseManager;

/**
 * Class PrestoSeeder
 */
final class PrestoSeeder extends Seeder
{
    /**
     * @param DatabaseManager $databaseManager
     */
    public function run(DatabaseManager $databaseManager)
    {
        $databaseManager->connection()->table('tests')
            ->insert([
                [
                    'test_name' => 'presto'
                ],
                [
                    'test_name' => 'kafka'
                ],
                [
                    'test_name' => 'laravel'
                ],
                [
                    'test_name' => 'elasticsearch'
                ]
            ]);
    }
}
