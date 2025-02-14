<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Exception;
use Image;

trait UserRegistration
{
    public function saveBill($data) 
    {
        if ($data['electricity _bill']) {
            $electricity_bill = $data['electricity_bill'];
            $billimage = 'ElectricityBill-' . uniqid() . '-' . $electricity_bill->getClientOriginalName();
            $filePath = public_path('/assets/electricity_bill');

            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }

            $billimg = Image::make($electricity_bill->getRealPath());
            $billimg->save($filePath . '/' . $billimage);
            return $billimage;
        } else {
            throw new Exception('Electricity Bill Required');
        }
    }

    public function savePropertyImages($data) 
    {
        if (isset($data['property_images'])) {
            $files = $data['property_images'];
            $file_names = [];

            foreach ($files as $file) {
                $file_image = 'File-' . uniqid() . '-' . $file->getClientOriginalName();
                $filefilePath = public_path('/assets/property_images');

                if (!File::isDirectory($filefilePath)) {
                    File::makeDirectory($filefilePath, 0777, true, true);
                }

                $fileimg = Image::make($file->getRealPath());
                $fileimg->save($filefilePath . '/' . $file_image);
                $file_names[] = $file_image;
            }

            return implode(',', $file_names);
        } else {
            throw new Exception('Property Image Required');
        }
    }

    public function saveCertification($data)
    {
        $certificationfile = $data['file'];
        $certificationfileimage = 'File-' . uniqid() . '-' . $certificationfile->getClientOriginalName();
        $certificationfilefilePath = public_path('/assets/certification_images');

        if (!File::isDirectory($certificationfilefilePath)) {
            File::makeDirectory($certificationfilefilePath, 0777, true, true);
        }

        $certificationfileimg = Image::make($certificationfile->getRealPath()); // Corrected $file to $certificationfile
        $certificationfileimg->save($certificationfilefilePath . '/' . $certificationfileimage);

        return $certificationfileimage;
    }

    public function saveCNIC($data)
    {
        if ($data['cnic_front'] && $data['cnic_back']) {
            // Cnic Front
            $cnic_frontfile = $data['cnic_front'];
            $cnic_frontfileimage = 'File-' . uniqid() . '-' . $cnic_frontfile->getClientOriginalName();
            $cnic_frontfilefilePath = public_path('/assets/cnic');

            if (!File::isDirectory($cnic_frontfilefilePath)) {
                File::makeDirectory($cnic_frontfilefilePath, 0777, true, true);
            }

            $cnic_frontfileimg = Image::make($cnic_frontfile->getRealPath()); // Corrected $file to $cnic_frontfile
            $cnic_frontfileimg->save($cnic_frontfilefilePath . '/' . $cnic_frontfileimage);
            $cnic_front_file_name = $cnic_frontfileimage;

            // Cnic Back
            $cnic_backfile = $data['cnic_back'];
            $cnic_backfileimage = 'File-' . uniqid() . '-' . $cnic_backfile->getClientOriginalName();
            $cnic_backfilefilePath = public_path('/assets/cnic');

            if (!File::isDirectory($cnic_backfilefilePath)) {
                File::makeDirectory($cnic_backfilefilePath, 0777, true, true);
            }

            $cnic_backfileimg = Image::make($cnic_backfile->getRealPath()); // Corrected $file to $cnic_backfile
            $cnic_backfileimg->save($cnic_backfilefilePath . '/' . $cnic_backfileimage);
            $cnic_back_file_name = $cnic_backfileimage;   

            return [
                'cnic_front' => $cnic_front_file_name,
                'cnic_back' => $cnic_back_file_name,
            ];
        } else {
            throw new Exception('CNIC is Required');
        }
    }
}
