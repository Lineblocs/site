(function () {
  // state is added as a parameter
  const benefits = landingData.benefits;
  const features = landingData.features;

  // cache DOM
  const content = document.querySelector(".landing");
  const benefitsSection = content.querySelector(".landing__benefits");
  const featuresSection = content.querySelector(".landing__features-row");

  // render on first load
  _render();

  function _render() {
    // render benefits inside benefits section
    benefits.forEach((benefit, i) => {
      // cache DOM
      const container = document.createElement("DIV");
      const colImg = document.createElement("DIV");
      const colText = document.createElement("DIV");
      const img = document.createElement("IMG");
      const title = document.createElement("h2");
      const description = document.createElement("P");

      // add attributes
      img.alt = "benefit image";

      // add classess
      if (i === 1) {
        container.className = "landing__benefits-row-reverse";
      } else {
        container.className = "landing__benefits-row";
      }
      colImg.className = "landing__benefits-col";
      colText.className = "landing__benefits-col";

      // populate elements with data
      if (benefits.img !== null) {
        img.src = benefit.img;
      }
      title.textContent = benefit.title;
      description.textContent = benefit.description;

      // populate DOM with newly created elements
      colImg.appendChild(img);
      colText.appendChild(title);
      colText.appendChild(description);
      container.appendChild(colImg);
      container.appendChild(colText);
      benefitsSection.appendChild(container);
    });

    // render features into features section
    features.forEach((feature) => {
      // cache DOM
      const container = document.createElement("DIV");
      const colImg = document.createElement("DIV");
      const colText = document.createElement("DIV");
      const img = document.createElement("IMG");
      const title = document.createElement("h3");
      const description = document.createElement("P");

      // add attributes
      img.alt = "feature image";

      // add classess
      container.className = "landing__features-content";
      colImg.className = "margin-none";

      // populate elements with data
      if (feature.img !== null) {
        img.src = feature.img;
      }
      title.textContent = feature.title;
      description.textContent = feature.description;

      // populate DOM with newly created elements
      colImg.appendChild(img);
      colText.appendChild(title);
      colText.appendChild(description);
      container.appendChild(colImg);
      container.appendChild(colText);
      featuresSection.appendChild(container);
    });
  }
})(landingData);
