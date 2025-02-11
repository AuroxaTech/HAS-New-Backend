<?php 
namespace App\Repositories;
use App\Interfaces\ContractRepositoryInterface;
use App\Models\Contract;

class ContractRepository implements ContractRepositoryInterface
{
    public function getAll()
    {
        return Contract::all();
    }

    public function findById(int $id)
    {
        return Contract::findOrFail($id);
    }

    public function create(array $data)
    {
        return Contract::create($data);
    }

    public function update(Contract $contract, array $data)
    {
        $contract->update($data);
        return $contract;
    }

    public function delete(Contract $contract)
    {
        $contract->delete();
    }
}
