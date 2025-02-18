<?php
namespace App\Interfaces;
use App\Models\Property;
interface PropertyRepositoryInterface
{
    public function all();
    public function byRole($role);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getPropertyImages($property_id);
    public function updatePropertyImages($id, array $data);
    public function deletePropertyImages($id);
}


