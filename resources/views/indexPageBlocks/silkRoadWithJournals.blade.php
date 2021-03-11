<div class="col-xl-12">
	<div class="main-title">
		<h4><a href="/topics.php?id_cat=20">@lang('list.Шёлковый путь')</a></h4>
	</div>
</div>

<div class="col-sm-12">
	<div class="main-white-section wow fadeIn" style="visibility: visible;">
		<div class="row">
			<div class="col-xl-6 col-sm-12">
			    @if(!$silkAndRoadNews->news->isEmpty())
				<div class="thematic-news-lg">
					<a href="{{ "/$locale/$silkAndRoadNews->slug/".$silkAndRoadNews->news[0]->slug }}">
						<img src="/storage/{{$silkAndRoadNews->news[0]->cover}}" class="img-fluid" alt="">
						<div class="date">
							<p>{{$silkAndRoadNews->news[0]->date_st}}<span><img src="images/view-icon.png" alt="">{{$silkAndRoadNews->news[0]->seen}}</span></p>
						</div>
						<h6>{{$silkAndRoadNews->news[0]->title}}</h6>
					</a>
				</div>
				@endif
			</div>
			<div class="col-xl-6 col-sm-12">
			    @foreach($silkAndRoadNews->news->skip(1) as $i=>$news)
				<div class="thematic-news-sm">
					<a href="{{"/$locale/$silkAndRoadNews->slug/$news->slug"}}">
						<div class="thematic-news-sm-img">
							<img src="/storage/{{$news->cover}}" style="width: 125px;height: 84px;">
						</div>
						<div class="text-block">
							<div class="date">
								<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span></p>
							</div>
							<h6>{{$news->title}}</h6>
						</div>
					</a>
				</div>
				@endforeach
				<div class="show-more-link">
					<a href="{{"/$locale/$silkAndRoadNews->slug"}}">@lang('list.Показать ещё')</a>
				</div>
			</div>
			<!-- Журнал -->
			<div class="col-lg-6">
				<div class="thematic-news-sm thematic-journale">
					<div class="thematic-card">
						<div class="thematic-news-sm-img">
							<img src="/storage/{{$silkAndRoadJournal->cover}}" style="width: 125px;">
							<a href="/storage/{{$silkAndRoadJournal->journal}}" target="_blank">@lang('list.СКАЧАТЬ PDF')</a>
						</div>

						<div class="link-right-thematic">
							<div>
								<img src="images/logo-j2.jpg" class="theamtic-logo" alt="">
								<p>@lang('list.ЕЖЕМЕСЯЧНЫЙ ЖУРНАЛ')</p>
							</div>
							<div class="thematic-down-pdf">
								<a href="https://dknews.kz/journals.php?type=silk-road" target="_blank" class="link-j">@lang('list.АРХИВ ЖУРНАЛА')</a>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-6">
				<div class="thematic-news-sm thematic-journale">
					<div class="thematic-card">
						<div class="thematic-news-sm-img">
							<img src="/storage/{{$beltAndRoadJournal->cover}}" style="width: 125px;">
                            <a href="/storage/{{$beltAndRoadJournal->journal}}" target="_blank">@lang('list.СКАЧАТЬ PDF')</a>
						</div>

						<div class="link-right-thematic">
							<div>
								<img src="images/logo-j.jpg" class="theamtic-logo" alt="">
								<p>@lang('list.ЕЖЕМЕСЯЧНЫЙ ЖУРНАЛ')</p>
							</div>
							<div class="thematic-down-pdf">
								<a href="https://dknews.kz/journals.php?type=belt-and-road" target="_blank" class="link-j">@lang('list.АРХИВ ЖУРНАЛА')</a>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>