<?php
namespace App\Services\Api;

use App\Contracts\iImageHandler;
use App\Models\BannerWeb;
use Illuminate\Http\UploadedFile;

/**
 * Class BannerWebService
 * @package App\Services\Api
 */
class BannerWebService
{
    /**
     * @var iImageHandler
     */
    private $imageHandler;

    /**
     * BannerWebService constructor.
     * @param iImageHandler $imageHandler
     */
    public function __construct(iImageHandler $imageHandler)
    {
        $this->imageHandler=$imageHandler;
    }

    /**
     * @param array $data
     * @return BannerWeb
     */
    public function create(array $data):BannerWeb{
        $banner=BannerWeb::create([
                'name'=>$data['name'],
                'link'=>$data['link'],
                'serial_number_id'=>$data['serial_number_id'],
                'disposition_id'=>$data['disposition_id'],
                'limit_id'=>$data['limit_id'],
                'date_st'=>$data['date_st'],
                'date_en'=>$data['date_en'],
                'cover' => $this->imageHandler->put('/bannerWeb',$data['cover'])
        ]
        );

        return $banner->load('disposition','limit','serial_number');
    }

    /**
     * @param int $id
     * @param array $data
     * @return BannerWeb
     */
    public function update(int $id, array $data):BannerWeb{
        if(isset($data['updatedCover']) AND $data['updatedCover'] instanceof UploadedFile){
            $this->imageHandler->delete($data['cover']);
            $data['cover']=$this->imageHandler->put('/newspapers/covers',$data['updatedCover']);
        }
        $banner=BannerWeb::find($id);
        $banner->name=$data['name'];
        $banner->link=$data['link'];
        $banner->serial_number_id=$data['serial_number_id'];
        $banner->disposition_id=$data['disposition_id'];
        $banner->limit_id=$data['limit_id'];
        $banner->date_st=$data['date_st'];
        $banner->date_en=$data['date_en'];
        $banner->cover=$data['cover'];
        $banner->save();
        return $banner->load('disposition','limit','serial_number');
    }

    /**
     * @param int $id
     */
    public function delete(int $id):void{
        $banner=BannerWeb::find($id);
        $this->imageHandler->delete($banner->cover);
        BannerWeb::destroy($id);
    }
}


?>
