@extends('layouts.app')

@section('title')
  readme
@endsection

@section('content')
<div class="mt-5 mb-5 justify-content-center container mx-auto">
  <div class="row mb-3 justify-content-center">
    <div class="col-10">
      <div class="mt-3 mb-2">
        <p>ご覧くださいましてありがとうございます。齋藤大です。</p>
      </div>
      <div class="mt-5 mb-5">
        <h4>■サイトコンセプト</h4>
        <li>ターゲット：商品の売上げ管理に悩む中小企業</li>
        <li>目的：売上げ管理の向上</li>
        <li>「user（ユーザー）」は実際に使用する企業の社員、「buyer（注文主）」はその企業の顧客、「destination（納品先）」は商品の出荷先をそれぞれ想定</li>
      </div>
      <div class="mb-5">
        <h4>■こだわった点</h4>
        <li>シンプルなUI</li>
        <li>月曜日の朝から張り切って仕事をこなすために、メインカラーをオレンジに</li>
        <li>Laravel Breeze無しで認証機能を実装</li>
        <li>商品の種類をプルダウンで切り替えると、非同期通信で在庫数や商品名が変化する</li>
        <li>カード内一覧のレコードが増えてきたときに便利な「注文主ごとに商品の絞り込みができる機能」を実装</li>
        <li>その他、各レコードが増えてきた場合を想定した絞り込み機能を実装</li>
        <li>「destination（納品先）」を「buyer（注文主）」に紐づけることで、レコードの管理がしやすい</li>
      </div>
      <div class="mb-5">
        <h4>■次回気を付けたい点</h4>
        <li>migrationを途中からDB上で直接行ってしまった。次回はLaravelにファイルを作る形にして残るようにしたい</li>
        <li>ローカルではできた画像のアップロードがデプロイ後はできない。自分では原因不明</li>
      </div>
      <div class="mt-5 mb-5">
        <h4>■プログラミング学習歴	</h4>
        <div class="mb-3">
          <b>＜独学（2023年1月～7月）＞</b>
          <li>Progateを使って独学でプログラミングの勉強を始める</li>
          <li>HTML, CSSでビューの全体的なレイアウトを, php, JavaScriptで変数、配列、関数、クラスなどの基礎を学習する</li>
        </div>
        <div class="mb-3">
          <b>＜スクール（2023年7月～2024年3月）＞</b>
          <li>侍エンジニア塾を受講</li>
          <li>独学で学習したHTML, CSS, php, JavaScriptに加えてLaravel, mySQL, gitを学習し始める</li>
          <li>独学での学習を、より深く学習(Bootstrap, モーダル, Api非同期通信など)</li>
          <li>Laravel Breezeを使わない認証機能の実装</li>
          <li>作成したコードをgithubに上げてインストラクターと共有</li>
          <li>オリジナルWebアプリはherokuでデプロイ</li>
          <li>要件定義書、機能一覧表の作成</li>
          <li>X（旧Twitter）風アプリ、ToDoアプリ、商品管理アプリ（完全オリジナル）を作成</li>
          <li>※ポートフォリオサイトURL：https://kanri-app-e0b6a6d6e512.herokuapp.com/	</li>
        </div>
        <div class="mb-3">
          <b>＜独学（2024年4月～）＞</b>
          <li>現在、書籍「基礎から学ぶLarave（C＆R出版）」を参考にしながら、Linuxでの開発を試みる</li>
        </div>
      </div>
      <div class="d-flex">
        <div class="ms-auto">
          以上
        </div>
      </div>  
    </div>
  </div>  
</div>
@endsection