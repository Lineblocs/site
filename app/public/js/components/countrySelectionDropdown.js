(function () {
  // state
  let isCountrySelectionDropdownOpen = false;
  // let activeCountry = 'united states';

  // cache DOM
  const pricingSelection = document.querySelector(".our-pricing-select");
  const button = pricingSelection.querySelector(".our-pricing-select-button");
  const list = pricingSelection.querySelector(".our-pricing-select-list");
  const listElements = Array.from(list.querySelectorAll("LI"));
  // const country = button.querySelector('SPAN');
  const chevron = button.querySelector("IMG");

  // add Event listeners
  button.addEventListener("click", toggleSelection);
  listElements.forEach((el) => {
    el.addEventListener("click", handleSelectedCountry);
  });

  // render on first load
  _render();

  function _render() {
    // country.textContent = activeCountry;
    if (isCountrySelectionDropdownOpen) {
      list.classList.add("show-country-selection-list");
      chevron.classList.add("rotate-country-selection-arrow");
    } else {
      list.classList.remove("show-country-selection-list");
      chevron.classList.remove("rotate-country-selection-arrow");
    }
  }

  function toggleSelection() {
    isCountrySelectionDropdownOpen = !isCountrySelectionDropdownOpen;
    _render();
  }

  function handleSelectedCountry() {
    // activeCountry = event.target.dataset.country;
    toggleSelection();
  }
})();
