<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerUser($name, $email, $password)
    {
        $sql = "insert into users (name, email, password_hash) values (:name, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }


    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, password_hash, is_admin) 
                VALUES (:name, :email, :password_hash, :is_admin)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password_hash' => $data['password_hash'],
            ':is_admin' => $data['is_admin'],
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE users SET name = :name, email = :email, is_admin = :is_admin WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':is_admin' => $data['is_admin'],
            ':id' => $id,
        ]);
    }


    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }


    public function searchByNameOrEmail($query)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name LIKE :q OR email LIKE :q");
        $search = '%' . $query . '%';
        $stmt->bindParam(':q', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
