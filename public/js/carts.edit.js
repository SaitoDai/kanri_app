//削除用モーダル
const modalBtn = document.querySelectorAll('.modal-btn'); //✖ボタン
const modalBack = document.querySelectorAll('.modal-back'); //モーダル全体の要素を取得
const closeModalBtn = document.querySelectorAll('.close-modal-btn'); //削除ボタン
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


//個数で小計を自動計算
const inputQuantity = document.querySelectorAll('.input-quantity');
const price = document.querySelectorAll('.price')
const subtotal = document.querySelectorAll('.subtotal')

inputQuantity.forEach(function(e, index){
  e.oninput = function(){
    subtotal[index].textContent = '￥' + (inputQuantity[index].value * price[index].getAttribute('value')).toLocaleString();
  }
});


//検索ボックスで注文主を絞る
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


//注文主で商品を絞る
const selectBox = document.getElementsByTagName('select')[0];
const table = document.getElementsByTagName('table')[0];

selectBox.addEventListener('change', function(){
  let optionId = selectBox.selectedOptions[0].value;
  const tdBuyerIds = document.querySelectorAll('.buyer_id') //table上のbuyer_idを取得(tdタグ)
  for(let tdBuyerId of tdBuyerIds){
    console.log(optionId);
    console.log(tdBuyerId.dataset.value);
    if(tdBuyerId.dataset.value === optionId || optionId === 'default'){  //tableのbuyer_idとセレクトボックスのbuyer_idを照合
      tdBuyerId.parentNode.style.display = '';
    } else {
      tdBuyerId.parentNode.style.display = 'none';
    }
  }
})
