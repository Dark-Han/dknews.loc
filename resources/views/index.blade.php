@extends('layout')

@section('main')
<div class="main">

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-title wow slideInUp">
					<h4>@lang('list.Главные новости сегодня')</h4>
				</div>
				<div class="main-white-section wow fadeIn">
					<div class="row">
						<div class="col-xl-9 col-md-9 col-sm-9">
							<div class="row">
								@include('indexPageBlocks.topNews',['topNews'=>$topNews,'locale'=>$locale])
							</div>
						</div>

						<div class="col-sm-3">
							<div class="news-lent-title">
								<h6>
									<a href="https://dknews.kz/topics.php?id_cat=all" style="color:#172f47"
									   target="_blank">
										@lang('list.Лента новостей')
									</a>
								</h6>
							</div>
							<div class="side-bar-scroll">
								@foreach ($newsFeedSectionNews as $news)
								<div class="news-lent-item">
									<div class="date">
										<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span>
										</p>
									</div>
									<a href="#">{{$news->title}}</a>
								</div>
								@endforeach
							</div>
						</div>
						<div class="col-sm-12">
							<div class="all-lent">
								<a href="topics.php?id_cat=all">@lang('list.Все последние новости')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="main-white-section wow fadeIn popular_sections">
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
                              @include('indexPageBlocks.categoriesWithNews',['categories'=>$categories->take(4)])
							</div>
						</div>
						<div class="col-sm-12">
							<div id="demo" class="collapse">
								<div class="row">
                                   @include('indexPageBlocks.categoriesWithNews',['categories'=>$categories->skip(4)])
								</div>
							</div>
						</div>
						<div class="col-sm-12" onclick="show_hide('sh_hi')">
							<div class="show-more" data-toggle="collapse" data-target="#demo">
								<p id="sh_hi">@lang('list.Показать ещё')</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			@foreach($specificCategories as $category)
                @include('indexPageBlocks.specificCategory');
            @endforeach

            @include('indexPageBlocks.silkRoadWithJournals');
            
            @foreach($mediaCategories as $category)
                @include('indexPageBlocks.mediaCategory');
            @endforeach

            @include('indexPageBlocks.infographicsNews');

            @include('indexPageBlocks.mediaPartners');

			@endsection