<?php

namespace App\Services\Api;

use App\Contracts\iImageHandler;
use App\Models\Newspaper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NewspaperService {

    private $imageHandler;

    public function __construct(iImageHandler $imageHandler)
    {
        $this->imageHandler=$imageHandler;
    }

    public function create(array $data):Newspaper{
        $newspaper=Newspaper::create([
            'name'=>$data['name'],
            'release_date' => $data['release_date'],
            'for_all_time_serial_number' => $data['for_all_time_serial_number'],
            'for_year_serial_number' => $data['for_year_serial_number'],
            'cover' => $this->imageHandler->put('/newspapers/covers',$data['cover']),
            'newspaper' => Storage::putFile('newspapers/documents',$data['newspaper'])
        ]);
        return $newspaper;
    }

    public function update(int $id,array $data):void{
        if(isset($data['updatedCover']) AND $data['updatedCover'] instanceof UploadedFile){
            $this->imageHandler->delete($data['cover']);
            $data['cover']=$this->imageHandler->put('/newspapers/covers',$data['updatedCover']);
        }

        if(isset($data['updatedNewspaper']) AND $data['updatedNewspaper'] instanceof UploadedFile){
            Storage::delete($data['newspaper']);
            $data['newspaper'] = Storage::putFile('newspapers/documents',$data['updatedNewspaper']);
        }

        Newspaper::where('id',$id)->update([
            'name'=>$data['name'],
            'release_date' => $data['release_date'],
            'for_all_time_serial_number' => $data['for_all_time_serial_number'],
            'for_year_serial_number' => $data['for_year_serial_number'],
            'cover' => $data['cover'],
            'newspaper' => $data['newspaper']
        ]);
    }

    public function delete(int $id):void{
        $newspaper=Newspaper::find($id);
        $this->imageHandler->delete($newspaper->cover);
        Storage::delete($newspaper->newspaper);
        Newspaper::destroy($id);
    }

}


?>
