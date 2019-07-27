<?php


namespace App\Repositories;


interface DocumentRepositoryInterface
{
    public function save(array $data);
    public function findBy(array $data);
    public function findById($id);
    public function update(array $data, $id);
    public function delete($id);
}