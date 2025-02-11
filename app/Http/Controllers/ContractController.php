<?php

// app/Http/Controllers/ContractController.php
namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Interfaces\ContractRepositoryInterface;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContractController extends Controller
{
    protected $contractRepository;

    public function __construct(ContractRepositoryInterface $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }

    // Get all contracts
    public function index(): JsonResponse
    {
        $contracts = $this->contractRepository->getAll();
        return response()->json(['data' => $contracts], 200);
    }

    // Store a new contract
    public function store(ContractRequest $request): JsonResponse
    {
        $contract = $this->contractRepository->create($request->validated());
        return response()->json(['message' => 'Contract created successfully', 'data' => $contract], 201);
    }

    // Show a specific contract
    public function show($id): JsonResponse
    {
        $contract = $this->contractRepository->findById($id);
        return response()->json(['data' => $contract], 200);
    }

    // Update a contract
    public function update(Request $request, $id): JsonResponse
    {
        $contract = $this->contractRepository->findById($id);
        $updatedContract = $this->contractRepository->update($contract, $request->all());
        return response()->json(['message' => 'Contract updated successfully', 'data' => $updatedContract], 200);
    }

    // Delete a contract
    public function destroy($id): JsonResponse
    {
        $contract = $this->contractRepository->findById($id);
        $this->contractRepository->delete($contract);
        return response()->json(['message' => 'Contract deleted successfully'], 200);
    }
}
