<?php

namespace App\Services\Api;
use App\Contracts\iImageHandler;
use App\Models\Category;

class CategoryService {

    private $imageHandler;

    public function __construct(iImageHandler $imageHandler)
    {
        $this->imageHandler=$imageHandler;
    }

    public function create(array $data):Category{
        $data['cover']=$this->imageHandler->put('/categories/covers',$data['cover']);
        $category=Category::create([
            'name_ru' => $data['name_ru'],
            'name_kz' => $data['name_kz'],
            'name_en' => $data['name_en'],
            'name_cn' => $data['name_cn'],
            'serial_number_web'=>$data['serial_number_web'],
            'serial_number_mob'=>$data['serial_number_mob'],
            'cover'=>$data['cover']
        ]);
        return $category;
    }

    public function update(int $id,array $data):void{
        if(isset($data['updatedCover'])){
            $this->imageHandler->delete($data['cover']);
            $data['cover']=$this->imageHandler->put('/categories/covers',$data['updatedCover']);
        }
        Category::where('id',$id)->update([
            'name_ru' => $data['name_ru'],
            'name_kz' => $data['name_kz'],
            'name_en' => $data['name_en'],
            'name_cn' => $data['name_cn'],
            'serial_number_web'=>$data['serial_number_web'],
            'serial_number_mob'=>$data['serial_number_mob'],
            'cover'=>$data['cover']
        ]);
    }

    public function delete($id,$data):void{
           $this->imageHandler->delete($data['cover']);
           Category::destroy($id);
    }
}

?>
