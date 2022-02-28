(function () {
  // state is added as a parameter

  // cache DOM
  const content = document.querySelector(".trunking-networks__content");

  // render on first load
  _render();

  function _render() {
    // for each data entry create a component that holds the necessary data
    trunkingNetworks.forEach((network) => {
      // cache DOM
      const container = document.createElement("DIV");
      const date = document.createElement("P");
      const status = document.createElement("P");
      const dot = document.createElement("SPAN");
      const viewDetailsText = document.createElement("SPAN");
      const seeDetailsLink = document.createElement("A");
      const chevronRight = document.createElement("IMG");

      // add attributes
      seeDetailsLink.href = `${category.id}/${network.id}`;
      seeDetailsLink.target = "_blank";
      chevronRight.src = "/img/chevron-right.svg";
      chevronRight.alt = "chevron right";

      // add classess
      container.className = "trunking-networks__network";
      date.className = "trunking-networks__network-date";
      status.className = "trunking-networks__network-status";
      dot.className = "system-status__point";
      seeDetailsLink.className = "trunking-networks__network-link";
      if (network.status === "maintenance") {
        dot.classList.add("system-status--maintenance");
      }
      if (network.status === "downtime") {
        dot.classList.add("system-status--downtime");
      }

      // populate elements with data
      date.textContent = network.date;
      status.textContent = network.description;
      viewDetailsText.textContent = "View details";

      // populate DOM with newly created elements
      seeDetailsLink.appendChild(viewDetailsText);
      seeDetailsLink.appendChild(chevronRight);
      status.prepend(dot);
      container.appendChild(date);
      container.appendChild(status);
      if ( status.id ) {
        container.appendChild(seeDetailsLink);
      }
      content.appendChild(container);
    });
  }
})(trunkingNetworks);
