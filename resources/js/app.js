require('./bootstrap');

var confirmDelete = document.querySelectorAll('.confirm-delete-post') ;
confirmDelete.forEach((element)=> {
    element.addEventListener('submit', function(e) {
        const response = confirm('Vuoi cancellare il post?');
        if(!response) {
            e.preventDefault();
        }
    })
});