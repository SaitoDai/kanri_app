const options = document.querySelectorAll('.option');
const searchBox = document.querySelector('.search-box')
 
searchBox.addEventListener('input', function(){
  for(i = 0; i < options.length; i++){
    let option = options[i];
    let txt = option.textContent || option.innerText;
    if(txt.indexOf(searchBox.value) > -1){
      option.style.display = '';
    } else {
      option.style.display = 'none';
    }
  }
});


//注文主で商品を絞る
const selectBox = document.getElementsByTagName('select')[0];
const table = document.getElementsByTagName('table')[0];

selectBox.addEventListener('change', function(){ 
  let optionId = selectBox.selectedOptions[0].value;
  const tdBuyerIds = document.querySelectorAll('.buyer_id') //table上のbuyer_idを取得(tdタグ)
  for(let tdBuyerId of tdBuyerIds){
    if(tdBuyerId.dataset.value == optionId || optionId == 0){  //tableのbuyer_idとセレクトボックスのbuyer_idを照合
      tdBuyerId.parentNode.style.display = '';
    } else {
      tdBuyerId.parentNode.style.display = 'none';
    }
  }
})




