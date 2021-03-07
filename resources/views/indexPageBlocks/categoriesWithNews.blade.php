@foreach($categories as $category)
<div class="col-sm-12">
	<div class="link-title">
		<span>■</span>
		<a href="{{"/$locale/$category->slug"}}">
		{{$category->name}}
		</a>
	</div>
</div>
@foreach($category->news as $news)
<div class="col-xl-3 col-md-4 col-sm-6">
	<div class="category-news">
		<a href="{{"/$locale/$category->slug/$news->slug"}}">
		<div class="category-img">
			<img src="{{"/storage/$news->cover"}}" class="img-fluid" alt="">
		</div>
		<div class="date">
			<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span>
			</p>
		</div>
		<p>{{$news->title}}</p>
		</a>
	</div>
</div>
@endforeach
@endforeach