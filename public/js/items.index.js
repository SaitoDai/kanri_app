//検索機能
if(document.querySelector('.search-box')){
  const items = document.querySelectorAll('.item');
  const searchBox = document.querySelector('.search-box');

  searchBox.addEventListener('input', function(){
    for(i = 0; i < items.length; i++){
      let item = items[i];
      let txt = item.textContent || item.innerText;
      if(txt.indexOf(searchBox.value) > -1){
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    }
  })
}


//カテゴリーで商品を絞る
const selectBox = document.getElementsByTagName('select')[0];
const items = document.querySelectorAll('.item');

selectBox.addEventListener('change', function(){ 
  let optionId = selectBox.selectedOptions[0].value;
  for(let item of items){
      if(optionId == item.dataset.value || optionId == 0){
        item.style.display = '';
    } else {
        item.style.display = 'none';
    }
  }
})
