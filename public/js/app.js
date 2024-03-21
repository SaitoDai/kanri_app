const topBtn = document.querySelector('.top-btn');

window.addEventListener('scroll', function(){
  var val = window.scrollY;
  if(val > 10){
    topBtn.classList.add('top-btn-active');
  } else {
    topBtn.classList.remove('top-btn-active');
  }
})