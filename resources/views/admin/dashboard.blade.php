@extends('admin.master')

@section('content')
    <div class="right_col" role="main">
          @if(Auth::user()->is_admin===1)

              @include('admin.content')

          @endif    
    </div>
@endsection