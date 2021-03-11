<div class="col-sm-12">
	<div class="main-title wow fadeIn" style="visibility: visible;">
		<h4><a href="/topics.php?id_cat=27">{{$category->name}}</a></h4>
	</div>
</div>

<div class="col-sm-12">
	<div class="main-white-section wow fadeIn" style="visibility: visible;">
		<div class="row">
			<div class="col-xl-6 col-sm-12">
			@if(!$category->news->isEmpty())
				<div class="thematic-news-lg">
					<a href='{{"/$locale/$category->slug/".$category->news[0]->slug}}'>
						<img src="{{"/storage/".$category->news[0]->cover}}" class="img-fluid" alt="">
						<div class="date">
							<p>
							    {{$category->news[0]->date_st}}
							    <span>
							    <img src="images/view-icon.png" alt="">
							        {{$category->news[0]->seen}}
							    </span>
							</p>
						</div>
						<h6>{{$category->news[0]->title}}</h6>
					</a>
				</div>
		    @endif
			</div>
			@foreach($category->news->skip(1) as $news)
			<div class="col-xl-6 col-sm-12">
				<div class="thematic-news-sm">
					<a href="{{"/$locale/$category->slug/$news->slug"}}">
						<div class="thematic-news-sm-img">
							<img src="{{"/storage/$news->cover"}}" style="width: 125px;height: 84px;" alt="">
						</div>
						<div class="text-block">
							<div class="date">
								<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span></p>
							</div>
							<h6>{{$news->title}}</h6>
						</div>
					</a>
				</div>
			</div>
			@endforeach
			<div class="offset-lg-6 col-sm-6">
				<div class="show-more-link">
					<a href="/topics.php?id_cat=27">@lang('list.Показать ещё')</a>
				</div>
			</div>
		</div>
	</div>
</div>