//Delete button
const scores = document.getElementById('scores');

if(scores){
    scores.addEventListener('click', (e) => {
        if(e.target.className === 'btn btn-danger delete-score'){
            if(confirm('Are you sure?')){
                const id = e.target.getAttribute('data-id');

                fetch(`/score/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload())
            }
        }
    })
}

//Position numbers on table
var table = document.getElementsByTagName('table')[0],
rows = table.getElementsByTagName('tr'),
text = 'textContent' in document ? 'textContent' : 'innerText';

for (var i = 1, len = rows.length; i < len; i++) {
    rows[i].children[0][text] = i + '' + rows[i].children[0][text];
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("scores");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function sortTableDifficulty() {
  var table, rows, switching, i, current, next, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("scores");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      current = rows[i].getElementsByTagName("TD")[2];
      next = rows[i + 1].getElementsByTagName("TD")[2];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */

      //console.log("Current: " + current.innerHTML + " Next: " + next.innerHTML);
      if (dir == "asc") {
        if (current.innerHTML == "Hard" && next.innerHTML == "Medium") {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
        if (current.innerHTML == "Hard" && next.innerHTML == "Easy") {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
        if (current.innerHTML == "Medium" && next.innerHTML == "Easy") {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (current.innerHTML == "Easy" && next.innerHTML == "Medium") {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
        if (current.innerHTML == "Easy" && next.innerHTML == "Hard") {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
        if (current.innerHTML == "Medium" && next.innerHTML == "Hard") {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function sortTableScore() {
  var table, rows, switching, i, current, next, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("scores");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      current = parseInt(rows[i].getElementsByTagName("TD")[3].innerHTML);
      next = parseInt(rows[i + 1].getElementsByTagName("TD")[3].innerHTML);

      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        //console.log("[ASC] Current: " + current + " Next: " + next);
        if (current > next) {
          // If so, mark as a switch and break the loop:
          //console.log("switch");
          shouldSwitch = true;
          break;
        }
        else
        {
          console.log("no need to switch");
        }
      } else if (dir == "desc") {
        //console.log("[DESC] Current: " + current + " Next: " + next);
        if (current < next) {
          // If so, mark as a switch and break the loop:
          //console.log("switch");
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}