// grab all the lists from the comparison section
const allLists = document.querySelectorAll('.comparison-table-dropdown');

// set the default open list
let activeList = 'comparison-drop-1';

// add event listeners to the title
// (which is the top most element, acts like the toggle button)
allLists.forEach(element => {
  element.querySelector('h5').addEventListener('click', event => {
    toggleList(element.dataset.list)
  }) 
});

// toggle list
// active parameter sets the new active open list
function toggleList(active) {
    activeList = active; 
    checkActiveList(allLists, activeList);
}

// run through all the lists 
// find the match to the new activeList add necessary classes to it 
// remove necessary classess from the ones that don't match 
function checkActiveList(lists, activeList) {
  lists.forEach(list => {
    if (list.dataset.list === activeList) {
      list.querySelector('DIV').classList.remove('hide-list')
      list.querySelector('.comparison-table-title svg').classList.add('rotate-arrow');
    } else {
      list.querySelector('DIV').classList.add('hide-list')
      list.querySelector('.comparison-table-title svg').classList.remove('rotate-arrow');
    }
  })
}

checkActiveList(allLists, activeList)