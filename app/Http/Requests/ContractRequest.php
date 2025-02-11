<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update this if you want to implement authorization
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'landlordName' => 'required|string|max:255',
            'landlordAddress' => 'required|string|max:255',
            'landlordPhone' => 'required|string|max:15',
            'tenantName' => 'required|string|max:255',
            'tenantAddress' => 'required|string|max:255',
            'tenantPhone' => 'required|string|max:15',
            'tenantEmail' => 'required|email|max:255',
            'occupants' => 'required|integer|min:1',
            'premisesAddress' => 'required|string|max:255',
            'propertyType' => 'required|string|max:255',
            'leaseStartDate' => 'required|date',
            'leaseEndDate' => 'required|date|after:leaseStartDate',
            'rentAmount' => 'required|numeric|min:0',
            'rentDueDate' => 'required|date',
            'securityDepositAmount' => 'required|numeric|min:0',
            'includedUtilities' => 'nullable|string',
            'tenantResponsibilities' => 'nullable|string',
            'emergencyContactName' => 'required|string|max:255',
            'emergencyContactPhone' => 'required|string|max:15',
            'emergencyContactAddress' => 'required|string|max:255',
            'buildingSuperintendentName' => 'nullable|string|max:255',
            'buildingSuperintendentAddress' => 'nullable|string|max:255',
            'buildingSuperintendentPhone' => 'nullable|string|max:15',
            'rentIncreaseNoticePeriod' => 'nullable|integer',
            'noticePeriodForTermination' => 'nullable|integer',
            'latePaymentFee' => 'nullable|numeric|min:0',
            'rentalIncentives' => 'nullable|string',
            'additionalTerms' => 'nullable|string',
            'leaseType'=>'required',
            'rentPaymentMethod'=>'required'
        ];
    }
}
