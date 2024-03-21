const modalBtn = document.querySelectorAll('.modal-btn'); //✖ボタン
const modalBack = document.querySelectorAll('.modal-back'); //モーダル全体の要素を取得
const closeModalBtn = document.querySelectorAll('.close-modal-btn'); //削除ボタン
const modalContent = document.querySelectorAll('.modal-content');//モーダル本体の要素を取得


modalBtn.forEach(function(e){
  e.onclick = function(){
    console.log(modalBack);
    modalBack[0].style.display = 'block';
  }
});
closeModalBtn.forEach(function(e) {
  e.onclick = function(){
    modalBack[0].style.display = 'none'
  }
});
modalContent.forEach(function(e){
  e.onclick = function(event){
    event.stopPropagation();
  }
});
modalTitle.forEach(function(e){
  e.onclick = function(event){
    event.stopPropagation();
  }
});
modalBack.forEach(function(e){
  e.onclick = function(){
    modalBack[0].style.display = 'none';
  }
});