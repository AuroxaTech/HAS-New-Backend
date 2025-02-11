<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    
     
    protected $fillable = [
        'user_id',
        'property_id',
        'landlordName',
        'landlordAddress',
        'landlordPhone',
        'tenantName',
        'tenantAddress',
        'tenantPhone',
        'tenantEmail',
        'occupants',
        'premisesAddress',
        'propertyType',
        'leaseStartDate',
        'leaseEndDate',
        'leaseType',
        'rentAmount',
        'rentDueDate',
        'rentPaymentMethod',
        'securityDepositAmount',
        'includedUtilities',
        'tenantResponsibilities',
        'emergencyContactName',
        'emergencyContactPhone',
        'emergencyContactAddress',
        'buildingSuperintendentName',
        'buildingSuperintendentAddress',
        'buildingSuperintendentPhone',
        'rentIncreaseNoticePeriod',
        'noticePeriodForTermination',
        'latePaymentFee',
        'rentalIncentives',
        'additionalTerms',
    ];
    
    public function property(){
        return $this->belongsTo(Property::class,'property_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
   
    
        
}
