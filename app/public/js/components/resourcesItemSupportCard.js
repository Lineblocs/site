
 (function() {
  let isWidgetOpen = false;

  // cache DOM
  const button = document.querySelector('.support-btn');
  const buttonSvg = button.querySelector(".support-btn img"); 
  const widget = document.querySelector(".support-card");
  const close = widget.querySelector(".support-card-close"); 

  button.addEventListener('click', openWidget);
  buttonSvg.addEventListener('click', openWidget);
  close.addEventListener('click', closeWidget);

  _render();

  function _render() {
    if (isWidgetOpen) {
      widget.classList.remove('hide-widget');
    } else {
      widget.classList.add('hide-widget');
    }
  }


  function closeWidget() {
    isWidgetOpen = false;
    _render();
  }

  function openWidget() {
    isWidgetOpen = true;
    _render();
  }

})();