@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <div class="text-center">
          <p class="text-center" style="padding-bottom: 15px">お探しのページにアクセスする権限がありません。</p>
          <a href="{{ route('home') }}" class="btn p-5">
            ホームへ戻る
          </a>
        </div>
    </div>
  </div>
@endsection