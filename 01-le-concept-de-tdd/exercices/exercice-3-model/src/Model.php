<?php

namespace App;

class Model
{
    public function __construct(private readonly \PDO $pdo)
    {
    }

    /**
     * Delete resource by pk
     *
     * @param int $id
     * @return \PDOStatement
     */
    public function delete(int $id)
    {
        return $this->pdo->query("DELETE FROM user WHERE id=$id");
    }

    /**
     * Return all resources
     *
     * @return array resources
     */
    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM user");

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\User');
    }

    /**
     * Return all resources
     *
     * @return array resources
     */
    public function update(User $user)
    {
        $stmt = $this->pdo->query(sprintf('UPDATE user SET username="%s" WHERE id=%s', $user->username, $user->id));

        return $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\\User');
    }

    /**
     * @param array $id
     * @return mixed
     */
    public function find(int $id)
    {
        $query = sprintf(
            'SELECT * FROM user WHERE id=%s',
            $id
        );

        $stmt = $this->pdo->query($query);

        return $stmt->fetchObject('App\\User');
    }

    /**
     * Return all resources
     *
     * @return array resources
     */
    public function hydrate(array $users): void
    {
        foreach ($users as $u) {
            $v[] = sprintf(" ('%s', '%s') ", $u['username'], $u['createdAt']);
        }

        $v = implode(',', $v);

        $this->pdo->query(sprintf('INSERT INTO user (username, createdAt) VALUES %s', $v));
    }

    public function save(User $user): void
    {
        $this->pdo->query(sprintf('INSERT INTO user (username) VALUES ("%s")', $user->username));
    }
}
