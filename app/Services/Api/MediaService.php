<?php

namespace App\Services\Api;

use App\Contracts\iImageHandler;
use App\Models\Media;

/**
 * Class MediaService
 * @package App\Services\Api
 */
class MediaService{

    /**
     * @var iImageHandler
     */
    private $imageHandler;

    /**
     * MediaService constructor.
     * @param iImageHandler $imageHandler
     */
    public function __construct(iImageHandler $imageHandler)
    {
        $this->imageHandler=$imageHandler;
    }

    /**
     * @param array $data
     * @return Media
     */
    public function create(array $data):Media{
        $media=Media::create([
            'name'=>$data['name'],
            'size_id'=>$data['size_id'],
            'link_count_id'=>$data['link_count_id'],
            'link_name1'=>$data['link_name1'],
            'link1'=>$data['link1'],
            'link_name2'=>$data['link_name2'],
            'link2'=>$data['link2'],
            'link_name3'=>$data['link_name3'],
            'link3'=>$data['link3'],
            'cover'=>$this->imageHandler->put('/medias/',$data['cover'])
        ]);
        return $media;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Media
     */
    public function update(int $id, array $data):Media{
        if(isset($data['updatedCover'])){
            $this->imageHandler->delete($data['cover']);
            $data['cover']=$this->imageHandler->put('/categories/covers',$data['updatedCover']);
        }

        $media=Media::find($id);
        $media->size_id=$data['size_id'];
        $media->link_count_id=$data['link_count_id'];
        $media->link_name1=$data['link_name1'];
        $media->link1=$data['link1'];
        $media->link_name2=$data['link_name2'];
        $media->link2=$data['link2'];
        $media->link_name3=$data['link_name3'];
        $media->link3=$data['link3'];
        $media->link3=$data['link3'];
        $media->cover=$data['cover'];
        $media->save();

        return $media;
    }


    /**
     * @param $id
     */
    public function delete($id):void{
        $media=Media::find($id);
        $this->imageHandler->delete($media->cover);
        Media::destroy($id);
    }
}


?>
