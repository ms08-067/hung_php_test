@section('sidebar')
<div class="quick-rules intype-jobs">
    <ul class="nav tr-list">

        <li class="nav-item @if(Route::currentRouteName() == 'user.postArticle') active @endif">
            <a class="nav-link" href="{{ route('user.postArticle') }}">
              <i class="material-icons">library_books</i>
              <p>Post Article</p>
            </a>
        </li>

        <li class="nav-item @if(Route::currentRouteName() == 'user.myAccount') active @endif">
            <a class="nav-link" href="{{ route('user.myAccount') }}">
              <i class="material-icons">library_books</i>
              <p>My Post</p>
            </a>
        </li>
    </ul>
</div>
@stop