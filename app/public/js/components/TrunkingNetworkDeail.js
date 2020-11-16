(function () {
  // state is coming from parameter

  // cache DOM
  const container = document.querySelector(".trunking-networks-detail");
  const date = container.querySelector(".trunking-networks-detail__date");
  const title = container.querySelector(".trunking-networks-detail__title");
  const description = container.querySelector(
    ".trunking-networks-detail__description"
  );

  // add Event listeners
  $(document).ready(() => {
    activateDropdown();
  });

  // render on first load
  _render();

  function _render() {
    // populate element data
    date.textContent = trunkingNetworkDetail.date;
    title.textContent = trunkingNetworkDetail.title;
    description.innerHTML = trunkingNetworkDetail.description;
    console.log(title);

    // add attributes

    // add classess
    if (trunkingNetworkDetail.status === "maintenance") {
      title.className = "trunking-networks-detail--maintenance";
    } else if (trunkingNetworkDetail.status === "downtime") {
      title.className = "trunking-networks-detail--downtime";
    } else {
      title.className = "trunking-networks-detail--upwork";
    }

    // append to html
  }

  // methods

  // material dropdown activation
  function activateDropdown() {
    $(".dropdown-trigger").dropdown();
  }
})(trunkingNetworkDetail);
