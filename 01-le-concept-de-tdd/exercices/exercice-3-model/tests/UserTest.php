<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Parser;

class UserTest extends TestCase
{
    private PDO $pdo;
    protected function setUp(): void
    {
        parent::setUp();
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS user
          (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username VARCHAR( 225 ),
            createdAt DATETIME
          )
      "
        );

        $yaml = new Parser();
        $users = $yaml->parse(file_get_contents(__DIR__.'/_data/seed.yml'));
        $model = new \App\ModelPrepare($this->pdo);
        foreach ($users as $user) {
            $model->hydrate($user);
        }
    }

    public function testCorrectNumberOfFixtures() {
        $users = (new \App\ModelPrepare($this->pdo))->all();
        self::assertCount(11, $users);
    }
}
