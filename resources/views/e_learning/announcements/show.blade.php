@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@php ($module = $course->code.': '.$course->title)

@section('content')

<!-- start page title -->
@include('partials.breadcrumb',[
    'page_title'    => '...',
    'menu_group'    => '...',
    'menu_item'     => 'E-Learning',
    'menu_item_url' => '#',
    'current'       => '...'
])
<!-- end page title -->

<!-- Row -->
<div class="row">
    <div class="col-12 col-sm-12 col-md-3">
        <div class="card">
            <div class="card-body">
                @include('e_learning.courses.menu')
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-9">
        <div class="card" id="pages">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">                    
                    @can('view_course_announcements')
                        <li class="nav-item"><a class="nav-link" href="{{ url('e-learning/courses/board/'.$course->id) }}">Notice Board</a></li>
                    @endcan
                    @can('list_el_announcements')
                        <li class="nav-item"><a class="nav-link" href="{{ url('e-learning/courses/announcements/'.$course->id) }}">Announcements</a></li>
                    @endcan
                    @can('add_el_announcements')
                        <li class="nav-item"><a class="nav-link" href="{{ url('e-learning/courses/announcements/'.$course->id.'/create') }}">Post Announcement</a></li>
                    @endcan
                    @can('edit_el_announcements')
                        <li class="nav-item"><a class="nav-link active" href="{{ url()->current() }}">Announcement</a></li>
                    @endcan
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">

                        <h4 class="mt-2">{{ $data->title }}</h4>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card" id="pages">
                                    <div class=" tab-menu-heading">
                                        <div class="tabs-menu1 ">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs">
                                                <li class=""><a href="#tab5" class="active" data-toggle="tab">Audio</a></li>
                                                <li><a href="#tab6" data-toggle="tab" class="">Video</a></li>
                                                <li><a href="#tab7" data-toggle="tab">Slides</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab5">
                                                <audio autoplay loop controls id="playAudio" class="col-12">
                                                    <source src="{{ asset('uploads/courses/'.$data->audio_url) }}">
                                                </audio>
                                            </div>
                                            <div class="tab-pane" id="tab6">
                                                <p> There is no video lecture for this topic</p>
                                            </div>
                                            <div class="tab-pane " id="tab7">
                                                <p>There is no slides lecture for this topic</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                
                            </div>
                        </div>

                        <div class="row profile ng-scope">
                                <div class="col-md-12">
                                    <h4 class="mt-3">Discussions
                                        @can('add_el_lecture_topics')
                                            <a href="{{ url('e-learning/courses/lectures/'.$data->id.'/topics/new') }}" class="btn btn-primary btn-sm float-right">New Discussion Topic</a>
                                        @endcan
                                    </h4>
                                    @if (count($data->discussions) == 0)
                                        <p>This lecture doesn't have any ongoing discussions yet.
                                        @can('add_el_lecture_topics')
                                            &nbsp;You can start a new discussion topic in case you have any doubts or questions about the lecture content.
                                         @endcan</p>
                                    @else
                                        <div class="activities">
                                            @foreach ($data->discussions as $discussion)
                                                <section class="event card border">
                                                    <div class="d-flex">
                                                        <span class="thumb-sm  pull-left mr-sm"><img class="avatar avatar-md brround" src="{{ asset('uploads/profile_pics/default.png') }}" alt="..."></span>
                                                        <div>
                                                            <h4 class="event-heading"><a href="#">{{ $discussion->user->name }}</a><span><small class="text-muted"><a href="#">&nbsp;{{ $data->user->telephone }}</a></small></span></h4>
                                                            <p class="text-xs text-muted ml-2">{{ date('d F Y, h:i A', strtotime($discussion->created_at)) }}</p>
                                                        </div>
                                                        </div>
                                                        <h4>{{ $discussion->subject }}</h4>
                                                        @if (strlen(strip_tags($discussion->description)) != 0)
                                                            <p class="text-sm mb-0">{!! $discussion->description !!}</p>
                                                        @elseif(!is_null($discussion->audio_url))
                                                            <div>
                                                                <audio controls class="col-12 mb-1">
                                                                    <source src="{{ asset('uploads/courses/'.$discussion->audio_url) }}">
                                                                </audio>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <div class="clearfix border-top post-comments">
                                                                <ul class="post-links mt-sm pull-left p-2">
                                                                    <li><a href="#">{{ count($discussion->responses) }} Responses</a></li>
                                                                    <li><a href="#">{{ count($discussion->subscriptions) }} Subscriptions</a></li>
                                                                    <li><a href="#">{{ count($discussion->likes) }} Likes</a></li>
                                                                </ul>
                                                                @can('add_el_lecture_topics')
                                                                    <a href="{{ url('e-learning/courses/lectures/'.$discussion->id.'/topics/show') }}" class="btn btn-success btn-sm float-right mr-2 mt-2">View Discussion Topic</a>
                                                                @endcan                                                        
                                                            </div>
                                                        </div>
                                                    </section>
                                            @endforeach
                                            

                                        </div>
                                    @endif
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
   
@endsection

@section('styles')
@endsection

@section('scripts')
    
    <!-- WYSIWYG Editor js -->
    <script src="{{ asset('assets/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('assets/plugins/wysiwyag/richText1.js') }}"></script>
@endsection