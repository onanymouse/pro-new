<?php

class Customer extends Model
{
    protected $table = 'customers';

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCollector($collectorId)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE collector_id = ?");
        $stmt->execute([$collectorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} 
            (name,email,phone,pppoe_username,pppoe_password,mikrotik_router_id,role,created_by)
            VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['pppoe_username'],
            password_hash($data['pppoe_password'], PASSWORD_DEFAULT),
            $data['mikrotik_router_id'],
            $data['role'],
            $data['created_by']
        ]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET 
            name=?, email=?, phone=?, pppoe_username=?, pppoe_password=?, mikrotik_router_id=?
            WHERE id=?");
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['pppoe_username'],
            password_hash($data['pppoe_password'], PASSWORD_DEFAULT),
            $data['mikrotik_router_id'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
    }

    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}