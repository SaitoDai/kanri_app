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


//郵便番号自動入力
const addressBtn = document.querySelector('.address-btn');

addressBtn.addEventListener('click', function(){ 
  const postal = document.querySelector('[name="postal"]').value;
  if(postal.length == 0){
    alert('郵便番号を入力してください。')
  } else {
    fetch('../api/address=' + postal)
    .then((data) => data.json())
    .then((obj) => {
        if(!Object.keys(obj).length){
          alert('住所が存在しません。')
        } else {
          const prefecture = document.querySelector('[name="prefecture"]');
          const address = document.querySelector('[name="address"');
        
          prefecture.value = obj.prefecture;
          address.value = obj.address1 + obj.address2;;
        }
    })
  }
})