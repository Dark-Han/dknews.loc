@extends('layout')
@section('main')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumbs wow fadeInLeft">
                    <ul>
                        <li><a href="/{{$locale}}">Главная</a></li>
                        <li>/</li>
                        <li><a href="{{"$locale/$category->slug"}}">{{$category->name}}</a></li>
                        <li>/</li>
                        <li>{{$news->title}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9  col-sm-8 wow fadeIn">
                <div class="main-white-section">
                    <div class="thin-title">
                        <h4>{{$news->title}}</h4>
                    </div>
                    <div class="inner-news">
                        <div class="date">
                            <p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span></p>
                        </div>
                    </div>
                    <div class="inner-text">
                        <p>{!!$news->text!!}</p>
                    </div>
                </div>
            <div>
        </div>
    </div>
</div>
@endsection