const addressBtn = document.querySelector('.address-btn');

addressBtn.addEventListener('click', function(){  
  const postal = document.querySelector('[name="postal"]').value; 
  if(postal.length == 0){
    alert('郵便番号を入力してください。')
  } else {
    fetch('../../api/address=' + postal)
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