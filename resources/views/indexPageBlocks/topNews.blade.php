@if(isset($topNews[0]))
<div class="col-xl-8 col-sm-12 main-banner-img">
	<div class="big-img-news">
		<a href="{{$locale."/".$topNews[0]->categorySlug."/".$topNews[0]->slug}}">
		<img src="{{asset('storage/'.$topNews[0]->cover)}}" alt="" class="img-top-news"
		     style="width: 100% !important;height:100%">
		<div class="big-news-caption">
			<p>Финансы <span><img src="images/view-icon-white.png" alt="">{{$topNews[0]->seen}}</span></p>
			<h5>{{$topNews[0]->title}}</h5>
		</div>
		</a>
	</div>
</div>
@endif

@if(isset($topNews[1],$topNews[2]))
<div class="col-xl-4 col-md-12 top-img">
	@for($i=1;$i<=2;$i++)
	<div class="small-img-news">
		<a href="{{$locale."/".$topNews[$i]->categorySlug."/".$topNews[$i]->slug}}">
		<img src="{{asset('storage/'.$topNews[$i]->cover)}}" alt="" class="img-top-news"
		     style="width: 100% !important;height:100%">
		<div class="big-news-caption">
			<p>Общество <span><img src="images/view-icon-white.png" alt="">{{$topNews[$i]->seen}}</span></p>
			<h5>{{$topNews[$i]->title}}</h5>
		</div>
		</a>
	</div>
	@endfor
</div>
@endif

@if(isset($topNews[3]))
@for($i=3;$i<$topNews->count();$i++)
<div class="col-xl-4 col-md-6">
	<div class="small-img-news">
		<a href="{{$locale."/".$topNews[$i]->categorySlug."/".$topNews[$i]->slug}}">
		<img src="{{asset('storage/'.$topNews[$i]->cover)}}" alt="" class="img-top-news"
		     style="width: 100% !important;height:100%">
		<div class="big-news-caption">
			<p>Есть мнение! <span><img src="images/view-icon-white.png" alt="">{{$topNews[$i]->seen}}</span></p>
			<h5>{{$topNews[$i]->title}}</h5>
		</div>
		</a>
	</div>
</div>
@endfor
@endif