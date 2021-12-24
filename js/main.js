/*JS do botão voltar ao topo*/

$(document).ready(function(){
    $('body').append('<div id="toTop" class="btn btn-info"><i class="fas fa-angle-up"></i></div>');
    $(window).scroll(function () {
    if ($(this).scrollTop() != 0) {
      $('#toTop').fadeIn();
    } else {
      $('#toTop').fadeOut();
    }
  }); 
  $('#toTop').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 800);
      return false;
  });
});
