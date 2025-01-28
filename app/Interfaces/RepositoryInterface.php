<?php
namespace App\Interfaces;
interface RepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function delete($id);
}
