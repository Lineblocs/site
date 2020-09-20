// chache DOM
const burger = document.querySelector(".burger");
const drawer = document.querySelector(".burger-drawer");
const mainBody = document.querySelector("body");
const closeIcon = document.querySelector(".burger-drawer-close");

// control navbar on mobile version
// the methods display the drawer and hide it.
class Navbar {
  constructor() {
    this.isActive = false;
  }

  toggleNavbar() {
    this.isActive = !this.isActive;
  }

  showDrawer(el) {
    el.classList.remove("hide-drawer");
    el.classList.add("show-drawer");
  }

  hideDrawer(el) {
    el.classList.remove("show-drawer");
    el.classList.add("hide-drawer");
  }

  addScroll(el) {
    el.classList.remove("no-scroll");
  }

  removeScroll(el) {
    el.classList.add("no-scroll");
  }
}

let navigation = new Navbar();

// when drawer is open and window gets resized
// remove drawer when window size is bigger than 768px
window.addEventListener("resize", function (e) {
  if (e.target.innerWidth > 768) {
    if (navigation.isActive) {
      navigation.toggleNavbar();
      navigation.hideDrawer(drawer);
      closeIcon.classList.remove("show");
      closeIcon.classList.add("hide");
      burger.classList.add("show");
      burger.classList.remove("hide");
    }
  }
});

// open drawer when burger icon is clicked on
burger.addEventListener("click", function (e) {
  // check if navigation.isActive
  // this property keeps track of the menu being open or closed on mobile
  if (!navigation.isActive) {
    // when clicking on the bars
    // when clicking on the bars also triger the menu toggle
    if (e.target.parentElement.id !== "navbar") {
      e.target.parentElement.classList.add("hide");
      e.target.parentElement.classList.remove("show");
    }
    closeIcon.classList.add("show");
    closeIcon.classList.remove("hide");
    navigation.toggleNavbar();
    navigation.removeScroll(mainBody);
    // once you show drawer jump out of function
    return navigation.showDrawer(drawer);
  }
  // if isActive is true close mobile menu
  // whats happening here is just adding and removing
  // classes that show and hide the menu.
  e.target.parentElement.classList.remove("hide");
  e.target.parentElement.classList.add("show");
  closeIcon.classList.remove("show");
  closeIcon.classList.add("hide");
  e.target.parentElement.classList.remove("hide");
  e.target.parentElement.classList.add("show");
  navigation.addScroll(mainBody);
  navigation.toggleNavbar();
  navigation.hideDrawer(drawer);
});

// add event listener and functionality to 
// close icon button
closeIcon.addEventListener("click", function (e) {
  e.target.classList.add("hide");
  e.target.classList.remove("show");
  burger.classList.add("show");
  burger.classList.remove("hide");
  navigation.addScroll(mainBody);
  navigation.toggleNavbar();
  navigation.hideDrawer(drawer);
});
