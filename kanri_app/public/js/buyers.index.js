const buyers = document.querySelectorAll('[data-buyer="buyer"]');
const searchBox = document.querySelector('.search-box')

searchBox.addEventListener('input', function(){
  for(i = 0; i < buyers.length; i++){
    let trBuyer = buyers[i];
    let txt = trBuyer.textContent || trBuyer.innerText;
    console.log(trBuyer);
    if(txt.indexOf(searchBox.value) > -1){
      trBuyer.style.display = '';
    } else {
      trBuyer.style.display = 'none';
    }
  }
});
