<?php
namespace App\Repositories;

use App\Interfaces\PropertyRepositoryInterface;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Helpers\ImageUpload;
use Auth;

class PropertyRepository implements PropertyRepositoryInterface
{
    use ImageUpload;

    public function all()
    {
        return Property::with('propertyImages')->get();
    }

    public function byRole($role)
    {
        return Property::with('propertyImages')->whereHas('user', function($query) use($role) {
            $query->where('role', $role)
                ->where('user_id', auth()->id());
        })->get();
    }

    public function find($id)
    {
        return Property::with('propertyImages')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        try {
            if (isset($data['electricity_bill_image'])) {
                $billImage = $this->uploadImage($data['electricity_bill_image'], 'properties/electricity_bills');
                $data['electricity_bill_image'] = $billImage['url'];
            }
            $property = Property::create($data);
            if (isset($data['property_images']) && is_array($data['property_images'])) {
                foreach ($data['property_images'] as $image) {
                    $propertyImage = $this->uploadImage($image, 'properties/images');
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $propertyImage['url'],
                    ]);
                }
            }


            return $property;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        $property = Property::findOrFail($id);

        try {
            if (isset($data['electricity_bill_image'])) {
                if ($property->electricity_bill_image) {
                    $this->deleteImage(str_replace('/storage/', '', $property->electricity_bill_image));
                }
                $billImage = $this->uploadImage($data['electricity_bill_image'], 'properties/electricity_bills');
                $data['electricity_bill_image'] = $billImage['url'];
            } else {
                $data['electricity_bill_image'] = $property->electricity_bill_image;
            }
            $property->update($data);

            return $property;
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function delete($id)
    {
        $property = Property::findOrFail($id);

        try {
            if ($property->electricity_bill_image) {
                $this->deleteImage(str_replace('/storage/', '', $property->electricity_bill_image));
            }
            if ($property->propertyImages) {
                foreach ($property->propertyImages as $image) {
                    $this->deleteImage(str_replace('/storage/', '', $image->image_path));
                    $image->delete();
                }
            }
            $property->delete();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the property.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPropertyImages($property_id)
    {
        return PropertyImage::where('property_id', $property_id)->get();
    }
    public function updatePropertyImages($id, array $data)
    {
        $propertyImage = PropertyImage::findOrFail($id);
        try {
            if (isset($data['property_images'])) {
                if ($propertyImage->image_path) {
                    $this->deleteImage(str_replace('/storage/', '', $propertyImage->image_path));
                }
                $uploadedImage = $this->uploadImage($data['property_images'], 'properties/images');
                $data['image_path'] = $uploadedImage['url'];
            }
            $propertyImage->update(['image_path' => $data['image_path']]);
            return $propertyImage;
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function deletePropertyImages($id)
    {
        $propertyImage = PropertyImage::findOrFail($id);

        try {
            if ($propertyImage->image_path) {
                $this->deleteImage(str_replace('/storage/', '', $propertyImage->image_path));
            }
            $propertyImage->delete();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the property image.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }





}
