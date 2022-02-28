
 (function() {
  let isWidgetOpen = false;

  // cache DOM
  const button = document.querySelector('.support-btn');
  const buttonSvg = button.querySelector(".support-btn img"); 
  const widget = document.querySelector(".support-card");
  const close = widget.querySelector(".support-card-close"); 

  // add event listeners
  button.addEventListener('click', openWidget);
  buttonSvg.addEventListener('click', openWidget);
  close.addEventListener('click', closeWidget);

  // render on first load
  _render();

  // renders the html to the DOM
  function _render() {
    if (isWidgetOpen) {
      widget.classList.remove('hide-widget');
    } else {
      widget.classList.add('hide-widget');
    }
  }

  // closes the support widget 
  function closeWidget() {
    isWidgetOpen = false;
    _render();
  }

  // opens the support widget
  function openWidget() {
    isWidgetOpen = true;
    _render();
  }

})();