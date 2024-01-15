<?php
require_once 'interface.php';
require_once 'makersDbTools.php';

class DBMaker extends DB implements CarsInterface{

    public function create(array $data) : ?int{
        $sql = "INSERT INTO makers $data";
        $this->mysqli->query($sql);

        $lastInserted = $this
            ->mysqli
            ->query("SELECT LAST_INSERT_ID() id:")
            ->fetch_assoc();

        return $lastInserted["id"];

    }


    public function get(int $id): array{
        $query = "SELECT * FROM makers WHERE id = $id";
        return $this->mysqli->query($query)->fetch_assoc(MYSQLI_ASSOC);
    }

    /*
    public function getByName(string $name):array{
        $query = "SELECT * FROM makers WHERE name = '$name";
        return
    }
     */
    public function getAll(): array{
         $query = "SELECT * FROM makers ORDER BY name";
         return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    public function update(int $id, array $data){
        $query = "UPDATE makers SET $data WHERE id = $id";
        $this->mysqli->query($query);
        return $this->get($id);
    }
    public function delete(int $id){
        $query = "DELETE FROM makers WHERE id = $id";
        return $this->mysqli->query($query);
    }
    public function getAbc(): array{



        $query = "SELECT DISTINCT SUBSTRING(name, 1, 1 ) ch FROM makers";
        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);


    }
    public function getByFirstCh($ch){
        $query = "SELECT * FROM makers WHERE name LIKE '$ch%' ORDER BY name";
        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);

    }
    public function findByName($needle)
    {
        $query = "SELECT * FROM makers WHERE name LIKE '%$needle%' ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    public function truncate()
    {
        $query = "TRUNCATE TABLE makers;";

        return $this->mysqli->query($query);
    }
    public function getCount(): int
    {
        $query = "SELECT COUNT(1) AS cnt FROM makers;";

        $result = $this->mysqli->query($query)->fetch_assoc();

        return $result['cnt'];
    }



}




