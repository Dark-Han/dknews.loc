<div class="col-sm-12">
	<div class="main-title wow slideInUp" style="visibility: visible;">
		<h4><a href="{{"/$locale/$category->slug"}}">{{$category->name}}</a></h4>
	</div>
</div>

<div class="col-sm-12">
	<div class="main-white-section wow fadeIn" style="visibility: visible;">
		<div class="row">
		@foreach($category->news as $news)
			<div class="col-sm-4">
				<div class="category-news">
					<a href="{{"/$locale/$category->slug/$news->slug"}}"
					   style="font:16px 'RCR',sans-serif !important;color: #717171">
						<div class="category-img">
							<img src="{{"/storage/".$news->cover}}" style="margin: 0px;" alt="">
						</div>
					</a>
					<div class="date">
						<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span></p>
					</div>
					<a href="inner-news.php?id_cat=69 &amp;&amp; id=168959"
					   style="font:16px 'RCR',sans-serif !important;color: #717171">
					   {{$news->title}}
					   </a>
				</div>
			</div>
	    @endforeach
			<div class="col-sm-12">
				<div class="show-more-link">
					<a href="{{"/$locale/$category->slug"}}">@lang('list.Показать ещё')</a>
				</div>
			</div>
		</div>
	</div>
</div>