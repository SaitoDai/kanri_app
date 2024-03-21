<!DOCTYPE html>
<html lang="jp">
  <head>
    <title>
      @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
    <header class="header">
      <div class="header-content">
        <p class="header-title">管理アプリ</p>
          <div class="d-flex">
              <!-- ヘッダー左 -->
            @auth
              <a href="{{ route('items.index') }}">TOP</a>
              @if(Auth::user()->role->id == 1)
                <a class="ms-3" href="{{ route('users.index') }}">ユーザー</a>
              @else
                <a class="ms-3" href="{{ route('users.show', Auth::id()) }}">プロフィール</a>
              @endif
              <a class="ms-3" href="{{ route('buyers.index') }}">注文主</a>
              <a class="ms-3" href="{{ route('carts.index') }}">カート</a>
              <a class="ms-3" href="{{ route('orders.index') }}">注文履歴</a>
              <!-- ヘッダー右 -->
              <a class="ms-auto" href="{{ route('users.logout', Auth::id()) }}">ログアウト</a>
            @endauth
            @if(Auth::id() != NULL && Auth::user()->role->id == 1)
              <a class="ms-3" href="{{ route('items.create') }}">商品登録</a>
            @endif
          </div>
      </header-content>
    </header>
    @if(Auth::id() != NULL && Auth::user()->role->id == 1)
      <div class="auth-line"></div>
    @endif
    <header class="lowwer-header mb-3">
      @auth
        <h5>@yield('title')</h5>
      @endauth
      @if(session('flash_message'))
        <p>{{ session('flash_message') }}</P>
      @endif 
    </header class="lowwer-header">
    <body>
      <main>
        @yield('content')
      </main>
    </body>
    <footer>
      @auth
        <a class="top-btn d-flex align-items-center justify-content-center" href="http://localhost/kanri_app/public/">      
          <div>
            TOP
          </div>
        </a>
      @endauth
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
