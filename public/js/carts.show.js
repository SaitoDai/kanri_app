//検索機能
if(document.querySelector('.search-box')){
  const options = document.querySelectorAll('.option');
  const searchBox = document.querySelector('.search-box');

  searchBox.addEventListener('input', function(){
    for(i = 0; i < options.length; i++){
      let option = options[i];
      let txt = option.textContent || option.innerText;
      console.log(txt)
      console.log(searchBox.value.toUpperCase())
      console.log(txt.indexOf(searchBox.value))
      if(txt.indexOf(searchBox.value) > -1){
        option.style.display = '';
      } else {
        option.style.display = 'none';
      }
    }
  })
}

//以下モーダル処理
const modalBtn = document.querySelectorAll('.modal-btn'); //「決済」ボタン
const modalBack = document.querySelectorAll('.modal-back'); //モーダル全体の要素を取得
const closeModalBtn = document.querySelectorAll('.close-modal-btn'); //✖ボタン
const modalTitle = document.querySelectorAll('.modal-title');
const modalContent = document.querySelectorAll('.modal-content');//モーダル本体の要素を取得

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


const btn = document.querySelector('.btn-outline-secondary');
btn.addEventListener('click', function(){
  console.log(btn)
  alert('カート内に商品がありません。')
})