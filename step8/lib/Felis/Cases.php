<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/24/2018
 * Time: 7:24 PM
 */

namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id) {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));

    }

    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN)
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
FROM $this->tableName c
INNER JOIN $usersTable client
ON c.client = client.id
INNER JOIN $usersTable agent
ON c.agent = agent.id
ORDER BY c.status DESC, c.number
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();


        $statement->execute();
        if($statement->rowCount() === 0) {
            return null;
        }

        $clients = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $returnArray = array();

        foreach ($clients as $c){
            $returnArray[] = new ClientCase($c);
        }

        return $returnArray;
    }

    public function update(array $a){
        $sql =<<<SQL
update $this->tableName
set agent=?, number=?, summary=?, status=?
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            $ret = $statement->execute(array(
                $a['agent'],
                $a['number'],
                $a['summary'],
                $a['status'],
                $a['id']
            ));
        } catch(\PDOException $e) {
            return false;
        }
        if($ret === false || $statement->rowCount() == 0) {
            return false;
        }

        return true;
    }

    public function delete($id) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            $ret = $statement->execute(array($id));
        } catch(\PDOException $e) {
            return false;
        }

        return true;
    }
}