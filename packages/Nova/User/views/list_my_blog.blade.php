@section('content')
<div class="content-grids">
<div ui-view="">
    <div class="air-card m-0-top-bottom p-0-top-bottom">

        @if(count($listBlog))
        <div class="ats-tile-list" style="">
            @foreach($listBlog as $k => $blog)
            <section class="air-card-hover air-card-hover-escape">
                <div class="highlight-search-result tile-air-card">

                    <div class="" style="">
                        <article class="row  m-sm-top">
                            <div class="col-md-12">
                         
                                <div class="row m-0-bottom">
                                    <div class="col-md-9">
                                       
                                        <a class="freelancer-tile-name" href="{{ route('user.detailPost',[$blog->id]) }}"><span>{{ $blog->title }}</span></a>
                                    </div>
                            <div class="col-md-3 p-0-right">
                                <div style="margin-top: -8px;" class="no-wrap freelancer-tile-location ellipsis">
                                    <a href="{{ route('user.postArticle',[$blog->id]) }}" style="font-size: 20px;"><i class="fa fa-pencil-square-o freelancer-tile-name" aria-hidden="true"></i></a>
                                </div>
                            </div>
                    </div>

                    <div class="indetailb">
                        <span><strong class="js-type">Author: {{ user($blog->user_id)->name() }}.</strong>
                        </span>

                        <span>
                            <span class="js-contractor-tier"> - {{ !empty($blog->published_at) && ($blog->published_at != "0000-00-00 00:00:00") ? "Published: ".date("M d Y, H:i",strtotime($blog->published_at)) : ""  }}</br>
                            </span>
                        </span>
                    </div>
                    

                    <div class="row m-sm-top m-0-bottom">
                        <div class="col-md-12">
                            <p class="p-0-left m-0">
                                <?php $intro_txt = trim(strip_tags($blog->intro_txt));?>
                                {{ (strlen($intro_txt) > 400) ? substr($intro_txt,0,400)."..." : $intro_txt }}
                            </p>                                                
                        </div>
                    </div>

                    <div>
                       
                        <a data-item="{{json_encode($blog)}}" rel="{{$blog->id}}" style="margin-left: -12px;" class="btn btn-link" href="{{ route('user.detailPost',[$blog->id]) }}">View more ...</a>
                    </div>
                </div>
                </article>
                </div>
                
                </div>
            </section>
            @endforeach
            <div class="pagenation">
                {{ $listBlog->links() }}
            </div>
        </div>
        @else
         <div class="ats-tile-list" style="">
                <section class="air-card-hover air-card-hover-escape">
                    <div class="highlight-search-result tile-air-card">
                        <div class="row m-sm-top m-0-bottom">
                            <div class="col-md-12">
                                <p class="p-0-left m-0 center">
                                    Whoops! You have no article ...
                                </p>
                                <p class="center"><a class="btn btn-small btn-primary" href="{{ route('user.postArticle') }}">Post An Article</a></p>                                                
                            </div>
                        </div>
                    </div>
                </section>    
         </div>   
        @endif          
</div>
</div>

</div>
@stop

@section('css')
@parent
<style type="text/css">
.box {
    padding-top:0px;
    padding-bottom: 0px;
}
</style>
@stop
