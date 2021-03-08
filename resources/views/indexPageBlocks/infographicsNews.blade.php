<div class="col-sm-12">
	<div class="main-title wow slideInUp" style="visibility: visible;">
		<h4><a href="{{"/$locale/$category->slug"}}">{{$category->name}}</a></h4>
	</div>
</div>

<div class="col-sm-12">
	<div class="main-white-section wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
		<div class="row">
			<div class="col-sm-5">
				<img src="https://dknews.kz/images/diagrama.jpg" class="img-fluid diagram-img" alt="">
			</div>
			<div class="col-sm-7">
			@foreach($category->news as $news)
				<div class="diagram-news">
					<a href="{{"/$locale/$category->slug/$news->slug"}}">
						<div class="date">
							<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span></p>
						</div>
						<h6>{{$news->title}}</h6>
					</a>
				</div>
		    @endforeach
			</div>
			<div class="offset-lg-5 col-sm-6">
				<div class="show-more-link">
					<a href="{{"/$locale/$category->slug"}}">@lang('list.Показать ещё')</a>
				</div>
			</div>
		</div>
	</div>
</div>