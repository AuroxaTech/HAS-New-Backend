<?php
namespace App\Interfaces;

use App\Models\Contract;

interface ContractRepositoryInterface
{
    public function getAll();
    public function findById(int $id);
    public function create(array $data);
    public function update(Contract $contract, array $data);
    public function delete(Contract $contract);
}
