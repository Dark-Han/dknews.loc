@extends('layout')

@section('main')
<div class="main">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-title wow slideInUp">
                    <h4>Главные новости сегодня</h4>
                </div>
                <div class="main-white-section wow fadeIn">
                    <div class="row">
                        <div class="col-xl-9 col-md-9 col-sm-9">
                            <div class="row">
                                @include('indexTopNews',['topNews'=>$topNews,'locale'=>$locale])
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="news-lent-title">
                                <h6>
                                    <a href="https://dknews.kz/topics.php?id_cat=all" style="color:#172f47" target="_blank">Лента новостей</a>
                                </h6>
                            </div>
                            <div class="side-bar-scroll">
                                @foreach ($newsFeedSectionNews as $news)
                                    <div class="news-lent-item">
                                        <div class="date">
                                            <p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span></p>
                                        </div>
                                            <a href="#">{{$news->title}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="all-lent">
                                <a href="topics.php?id_cat=all">Все последние новости</a>
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


                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div id="demo" class="collapse">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" onclick="show_hide('sh_hi')">
                            <div class="show-more" data-toggle="collapse" data-target="#demo">
                                <p id="sh_hi">Показать еще</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection