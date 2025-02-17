<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
// use Intervention\Image\ImageManagerStatic as Image;


trait UserRegistration
{
    public function saveBill($data) 
    {
        $electricity_bill = $data['electricity_bill'];
        $billimage = 'ElectricityBill-' . uniqid() . '-' . $electricity_bill->getClientOriginalName();
        $filePath = '/assets/electricity_bill';

        if (!File::isDirectory($filePath)) {
            File::makeDirectory($filePath, 0777, true, true);
        }
        // $manager = new Image();
        // $billimg = $manager->make($electricity_bill->getRealPath());
        // $electricity_bill->storeAs($filePath . '/' . $billimage, 'local');
        $link = Storage::disk('local')->put($filePath, $electricity_bill);
        return asset($link);
    }

    public function savePropertyImages($data) 
    {
        $files = $data['property_images'];
        $file_names = [];

        foreach ($files as $file) {
            $file_image = 'File-' . uniqid() . '-' . $file->getClientOriginalName();
            $filefilePath = public_path('/assets/property_images');

            if (!File::isDirectory($filefilePath)) {
                File::makeDirectory($filefilePath, 0777, true, true);
            }
            $link = Storage::disk('local')->put($filefilePath, $file);
            // $fileimg = Image::make($file->getRealPath());
            // $file->storeAs($filefilePath . '/' . $file_image, 'local');
            $file_names[] = asset($link);
        }

        return implode(',', $file_names);
    }

    public function saveCertification($data)
    {
        $certificationfile = $data['file'];
        $certificationfileimage = 'File-' . uniqid() . '-' . $certificationfile->getClientOriginalName();
        $certificationfilefilePath = public_path('/assets/certification_images');

        if (!File::isDirectory($certificationfilefilePath)) {
            File::makeDirectory($certificationfilefilePath, 0777, true, true);
        }
        $link = Storage::disk('local')->put($certificationfilefilePath, $certificationfile);
        // $certificationfileimg = Image::make($certificationfile->getRealPath()); // Corrected $file to $certificationfile
        // $certificationfileimg->save($certificationfilefilePath . '/' . $certificationfileimage);

        return $link;
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

            // $cnic_frontfileimg = Image::make($cnic_frontfile->getRealPath()); // Corrected $file to $cnic_frontfile
            // $cnic_frontfileimg->save($cnic_frontfilefilePath . '/' . $cnic_frontfileimage);
            $link = Storage::disk('local')->put($cnic_frontfilefilePath, $cnic_frontfile);
            $cnic_front_file_name = $cnic_frontfileimage;

            // Cnic Back
            $cnic_backfile = $data['cnic_back'];
            $cnic_backfileimage = 'File-' . uniqid() . '-' . $cnic_backfile->getClientOriginalName();
            $cnic_backfilefilePath = public_path('/assets/cnic');

            if (!File::isDirectory($cnic_backfilefilePath)) {
                File::makeDirectory($cnic_backfilefilePath, 0777, true, true);
            }

            // $cnic_backfileimg = Image::make($cnic_backfile->getRealPath()); // Corrected $file to $cnic_backfile
            // $cnic_backfileimg->save($cnic_backfilefilePath . '/' . $cnic_backfileimage);
            $link = Storage::disk('local')->put($cnic_backfilefilePath, $cnic_backfile);
            $cnic_back_file_name = $link;   

            return [
                'cnic_front' => $cnic_front_file_name,
                'cnic_back' => $cnic_back_file_name,
            ];
        } else {
            throw new Exception('CNIC is Required');
        }
    }
}
