(function () {
  // state
  let isBurgerMenuOpen = false;

  //  cache DOM
  const navigation = document.querySelector("#navbar");
  const burger = navigation.querySelector(".burger");
  const closeIcon = navigation.querySelector(".burger-drawer-close");
  const menu = document.querySelector(".burger-drawer");
  const menuItems = Array.from(navigation.querySelectorAll(".menu LI"));

  // add event listeners
  burger.addEventListener("click", toggleMenu);
  closeIcon.addEventListener("click", closeMenu);
  menuItems.forEach((el) => {
    el.addEventListener("click", closeMenu);
  });

  // render on first load
  _render();

  function _render() {
    // if burger menu is open close it
    // remove all classes that open the menu
    // and add the ones that show the burger icon
    if (isBurgerMenuOpen) {
      menu.classList.add("show-drawer");
      closeIcon.classList.add("show-burger-drawer-close");
      burger.classList.remove("show-burger");
    } else {
      menu.classList.remove("show-drawer");
      closeIcon.classList.remove("show-burger-drawer-close");
      burger.classList.add("show-burger");
    }
  }

  function toggleMenu() {
    isBurgerMenuOpen = !isBurgerMenuOpen;
    _render();
  }

  function closeMenu() {
    isBurgerMenuOpen = false;
    _render();
  }
})();