w0indow.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navbar").style.top = "0";
    $('.header-content').addClass('fixed-header');
    
  } else {
    document.getElementById("navbar").style.top = "0";
    $('.header-content').removeClass('fixed-header');
  }
}
function patchMaterializeInputs() {
       document.querySelectorAll("input").forEach(function(input) {
        var value = input.value;
        var name = input.getAttribute("id");
        if (value !== '') {
          var label = $("label[for='" + name +  "'");
          $( label ).addClass("active");
        }
      });
}