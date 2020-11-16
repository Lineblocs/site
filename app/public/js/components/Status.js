(function () {
  // state
  let data = statusData;
  // let activeCountry = 'united states';

  // cache DOM
  const container = document.querySelector(".system-status__container");

  // add Event listeners

  // render on first load
  _render();

  function _render() {
    // for each status in data create a container
    // inside each container add a title and status at the same level
    // inside each container under title and status add 100 bars with a significant class
    data.forEach((status) => {
      // cache DOM
      let statusContent = document.createElement("DIV");
      let statusHeader = document.createElement("DIV");
      let h3 = document.createElement("H3");
      let a = document.createElement("a");
      let p = document.createElement("P");
      let statusPoint = document.createElement("SPAN");
      let barContainer = document.createElement("DIV");

      // add classess
      statusContent.classList = "system-status__content";
      statusHeader.className = "system-status__header";
      h3.className = "system-status__title";
      p.className = "system-status__status";
      statusPoint.className = "system-status__point";
      barContainer.className = "system-status__bars";
      if (status.status === "maintenance") {
        statusPoint.classList.add("system-status--maintenance");
      }
      if (status.status === "downtime") {
        statusPoint.classList.add("system-status--downtime");
      }

      // populate data
      a.textContent = status.title;
      a.href = "/status/" + status.id;
      h3.appendChild(a);
      p.textContent = status.description;

      // create 100 bars to display the different status
      // add default class to each class
      for (i = 0; i < 100; i++) {
        // create bar element
        // create tooltip element
        let bar = document.createElement("DIV");
        let tooltip = document.createElement("SPAN");

        // add classess
        tooltip.className = "system-status__tooltip";
        bar.className = "system-status__bar";

        // add temporary* content to tooltip
        tooltip.textContent = '13 October 2020 r no Downtime'

        // append accordingly
        bar.appendChild(tooltip);
        barContainer.appendChild(bar);
      }

      // Add different classess depending on the status.
      let bars = Array.from(barContainer.children);
      bars.forEach((bar) => {
        if (status.partial_degradation !== null) {
          status.partial_degradation.forEach((deg) => {
            bars[deg].classList.add("system-status--maintenance");
          });
        }
        if (status.downtime !== null) {
          status.downtime.forEach((deg) => {
            bars[deg].classList.add("system-status--downtime");
          });
        }
      });

      // populate DOM with newly created elements
      p.prepend(statusPoint);
      statusHeader.appendChild(h3);
      statusHeader.appendChild(p);
      statusContent.appendChild(statusHeader);
      statusContent.appendChild(barContainer);
      container.appendChild(statusContent);
    });
  }
})(statusData);
