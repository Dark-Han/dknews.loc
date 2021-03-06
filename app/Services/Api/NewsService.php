<?php

namespace App\Services\Api;

use App\Contracts\iImageHandler;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Support\Str;

class NewsService
{

    private $imageHandler;

    public function __construct(iImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    public function all()
    {
        return News::with([
            'disposition',
            'limit',
            'category' => function ($query) {
                return $query->select('id', 'name_ru');
            }
        ])
            ->orderBy('id', 'DESC')
            ->paginate(20);
    }

    public function create(array $data): News
    {
        $news = News::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'text' => $data['text'],
            'language_id' => $data['language_id'],
            'disposition_id' => $data['disposition_id'],
            'limit_id' => $data['limit_id'],
            'seen' => $data['seen'],
            'must_seen' => $data['must_seen'],
            'category_id' => $data['category_id'],
            'forever' => $data['forever'],
            'cover' => $data['cover'],
            'date_st' => $data['timestampSt']['date'] . ' ' . $data['timestampSt']['time'],
            'date_en' => $data['timestampEn']['date'] . ' ' . $data['timestampEn']['time']
        ]);
        $news->images()->createMany($data['uploadedImages']);
        return $this->getWithRelations($news);
    }

    public function update(array $data, int $id): News
    {
        $news = News::find($id);
        $news->title = $data['title'];
        $news->text = $data['text'];
        $news->language_id = $data['language_id'];
        $news->disposition_id = $data['disposition_id'];
        $news->limit_id = $data['limit_id'];
        $news->seen = $data['seen'];
        $news->must_seen = $data['must_seen'];
        $news->category_id = $data['category_id'];
        $news->forever = $data['forever'];
        $news->cover = $data['cover'];
        $news->date_st = $data['timestampSt']['date'] . ' ' . $data['timestampSt']['time'];
        $news->date_en = $data['timestampEn']['date'] . ' ' . $data['timestampEn']['time'];
        $news->images()->createMany($data['uploadedImages']);
        $news->save();
        return $this->getWithRelations($news);
    }

    private function getWithRelations($news): News
    {
        return $news->load(
            [
                'disposition',
                'limit',
                'category' => function ($query) {
                    return $query->select('id', 'name_ru');
                }
            ]
        );
    }

    public function uploadImage($image): string
    {
        return $this->imageHandler->put('/news', $image);
    }

    public function deleteUploadedImagesOfNotCreatedNews($images){
        if(!empty($images->uploadedImages)){
            $images=$images->uploadedImages;
            foreach ($images as $image) {
                $this->imageHandler->delete($image->path);
            }
        }
    }

}


?>
