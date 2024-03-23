//削除用モーダル
const modalBtn = document.querySelectorAll('.modal-btn'); //✖ボタン
const modalBack = document.querySelectorAll('.modal-back'); //モーダル全体の要素を取得
const closeModalBtn = document.querySelectorAll('.close-modal-btn'); //削除ボタン
const modalTitle = document.querySelectorAll('.modal-title');
const modalContent = document.querySelectorAll('.modal-content');//モーダル本体の要素を取得

console.log(modalBtn);
modalBtn.forEach(function(e, index){
  e.onclick = function(){
    modalBack[index].style.display = 'block';
  }
});
closeModalBtn.forEach(function(e, index) {
  e.onclick = function(){
    modalBack[index].style.display = 'none'
  }
});
modalTitle.forEach(function(e){
  e.onclick = function(event){
    event.stopPropagation();
  }
});
modalContent.forEach(function(e){
  e.onclick = function(event){
    event.stopPropagation();
  }
});
modalBack.forEach(function(e, index){
  e.onclick = function(){
    modalBack[index].style.display = 'none';
  }
});