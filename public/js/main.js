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