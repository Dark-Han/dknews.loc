<?php

namespace App\Services\Api;

use App\Contracts\iImageHandler;
use App\Models\Journal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class JournalService {

    private $imageHandler;

    public function __construct(iImageHandler $imageHandler)
    {
        $this->imageHandler=$imageHandler;
    }

    public function create(array $data):Journal{
         $journal=Journal::create([
            'name'=>$data['name'],
            'journal_type_id'=>$data['journal_type_id'],
            'release_date'=>$data['release_date'],
            'cover'=>$this->imageHandler->put('/journals/covers',$data['cover']),
            'journal'=>Storage::putFile('journals/documents',$data['journal']),
            'for_year_serial_number'=>$data['for_year_serial_number'],
            'for_all_time_serial_number'=>$data['for_all_time_serial_number']
        ]);
         return $journal->load('journalTypes');
    }

    public function update(array $data,int $id):Journal{
        if(isset($data['updatedCover']) AND $data['updatedCover'] instanceof UploadedFile){
            $this->imageHandler->delete($data['cover']);
            $data['cover']=$this->imageHandler->put('/newspapers/covers',$data['updatedCover']);
        }

        if(isset($data['updatedJournal']) AND $data['updatedJournal'] instanceof UploadedFile){
            Storage::delete($data['journal']);
            $data['journal'] = Storage::putFile('journals/documents',$data['updatedJournal']);
        }

        $journal=Journal::find($id);
        $journal->name=$data['name'];
        $journal->journal_type_id=$data['journal_type_id'];
        $journal->release_date=$data['release_date'];
        $journal->for_all_time_serial_number=$data['for_all_time_serial_number'];
        $journal->for_year_serial_number=$data['for_year_serial_number'];
        $journal->cover=$data['cover'];
        $journal->journal=$data['journal'];
        $journal->save();

        $journal->load('journalTypes');
        return $journal;
    }

    public function delete(int $id):void{
        $journal=Journal::find($id);
        $this->imageHandler->delete($journal->cover);
        Storage::delete($journal->journal);
        Journal::destroy($id);
    }

}

?>
