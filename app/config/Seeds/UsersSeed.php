<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use \Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                "email" => "test1@email.com",
                "password" => (new DefaultPasswordHasher)->hash("12345678a"),
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "email" => "test2@email.com",
                "password" => (new DefaultPasswordHasher)->hash("12345678a"),
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "email" => "test3@email.com",
                "password" => (new DefaultPasswordHasher)->hash("12345678a"),
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
