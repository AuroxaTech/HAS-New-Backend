<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Helpers\ImageUpload;
use Illuminate\Support\Facades\Auth;

class ServiceRepository implements ServiceRepositoryInterface
{
    use ImageUpload;

    public function getAll()
    {
        return Service::with('serviceImages')->get();
    }

    public function getById($id)
    {
        return Service::with('serviceImages')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();

        try {
            // Handle CNIC front image upload
            if (isset($data['cnic_front_pic'])) {
                $cnicFrontPic = $this->uploadImage($data['cnic_front_pic'], 'services/cnic');
                $data['cnic_front_pic'] = $cnicFrontPic['url'];
            }

            // Handle CNIC back image upload
            if (isset($data['cnic_back_pic'])) {
                $cnicBackPic = $this->uploadImage($data['cnic_back_pic'], 'services/cnic');
                $data['cnic_back_pic'] = $cnicBackPic['url'];
            }

            // Handle certification upload
            if (isset($data['certification'])) {
                $certification = $this->uploadImage($data['certification'], 'services/certifications');
                $data['certification'] = $certification['url'];
            }

            // Handle resume upload
            if (isset($data['resume'])) {
                $resume = $this->uploadImage($data['resume'], 'services/resumes');
                $data['resume'] = $resume['url'];
            }

            // Create the service
            $service = Service::create($data);

            // Handle service images if provided
            if (isset($data['service_images']) && is_array($data['service_images'])) {

                foreach ($data['service_images'] as $image) {
                    $uploadedImage = $this->uploadImage($image, 'services/images');
                    ServiceImage::create([
                        'service_id' => $service->id,
                        'image_path' => $uploadedImage['url'],
                    ]);
                }
            }

            return $service;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        $service = Service::findOrFail($id);

        try {
            // Handle CNIC front image upload
            if (isset($data['cnic_front_pic'])) {
                $this->deleteImage(str_replace('/storage/', '', $service->cnic_front_pic)); // Delete old image
                $cnicFrontPic = $this->uploadImage($data['cnic_front_pic'], 'services/cnic');
                $data['cnic_front_pic'] = $cnicFrontPic['url'];
            }

            // Handle CNIC back image upload
            if (isset($data['cnic_back_pic'])) {
                $this->deleteImage(str_replace('/storage/', '', $service->cnic_back_pic)); // Delete old image
                $cnicBackPic = $this->uploadImage($data['cnic_back_pic'], 'services/cnic');
                $data['cnic_back_pic'] = $cnicBackPic['url'];
            }

            // Handle certification upload
            if (isset($data['certification'])) {
                $this->deleteImage(str_replace('/storage/', '', $service->certification)); // Delete old image
                $certification = $this->uploadImage($data['certification'], 'services/certifications');
                $data['certification'] = $certification['url'];
            }

            // Handle resume upload
            if (isset($data['resume'])) {
                $this->deleteImage(str_replace('/storage/', '', $service->resume)); // Delete old image
                $resume = $this->uploadImage($data['resume'], 'services/resumes');
                $data['resume'] = $resume['url'];
            }

            // Update service details
            $service->update($data);

            return $service;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);

        try {
            // Delete CNIC images
            if ($service->cnic_front_pic) {
                $this->deleteImage(str_replace('/storage/', '', $service->cnic_front_pic));
            }
            if ($service->cnic_back_pic) {
                $this->deleteImage(str_replace('/storage/', '', $service->cnic_back_pic));
            }

            // Delete certification and resume
            if ($service->certification) {
                $this->deleteImage(str_replace('/storage/', '', $service->certification));
            }
            if ($service->resume) {
                $this->deleteImage(str_replace('/storage/', '', $service->resume));
            }

            // Delete service images
            if ($service->serviceImages) {
                foreach ($service->serviceImages as $image) {
                    $this->deleteImage(str_replace('/storage/', '', $image->image_path));
                    $image->delete();
                }
            }

            // Delete the service
            $service->delete();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error occurred while deleting the service.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getServiceImages($service_id)
    {
        return ServiceImage::where('service_id', $service_id)->get();
    }
    public function updateServiceImages($id, array $data)
    {
        $serviceImage = ServiceImage::findOrFail($id);
        try {
            if (isset($data['service_images'])) {
                if ($serviceImage->image_path) {
                    $this->deleteImage(str_replace('/storage/', '', $serviceImage->image_path));
                }
                $uploadedImage = $this->uploadImage($data['service_images'], 'services/images');
                $data['image_path'] = $uploadedImage['url'];
            }
            $serviceImage->update(['image_path' => $data['image_path']]);
            return $serviceImage;
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function deleteServiceImages($id)
    {
        $serviceImage = ServiceImage::findOrFail($id);

        try {
            if ($serviceImage->image_path) {
                $this->deleteImage(str_replace('/storage/', '', $serviceImage->image_path));
            }
            $serviceImage->delete();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the property image.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
