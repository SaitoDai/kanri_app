//オプション未設定時
if(document.querySelector('.btn-outline-secondary') != null){
  const btnOS = document.querySelector('.btn-outline-secondary');
  btnOS.addEventListener('click', function(){
    alert('商品在庫が設定されていません。')
  })
}


//オプション設定後
if(document.getElementsByTagName('select') !== null){
  const selectBox = document.getElementsByTagName('select')[0];

  selectBox.addEventListener('change', function () {
    const quantityInput = document.querySelector('.quantity-input')
    fetch('../public/api/quantity=' + selectBox.selectedOptions[0].value)
    .then((data) => data.json())
    .then((obj) => {
      if(!Object.keys(obj).length){
        alert('エラー：管理者に問い合わせてください。');
      } else {
        console.log(obj.quantity)
        console.log(quantityInput.innerHTML)
        quantityInput.innerHTML = '&ensp;/&ensp;' + obj.quantity; //ビューの在庫表示数を変える
      }
    })
  });
}