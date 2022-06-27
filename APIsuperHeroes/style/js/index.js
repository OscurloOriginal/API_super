let formulario = document.getElementById('form');
let respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    // console.log('Tudo bem bro :)');

    let datos = new FormData(formulario);

    fetch('function/create.php', {
            method: 'POST',
            body: datos,
        })
        .then(res => res.json())
        .then(res => {
        	respuesta.innerHTML = `<div class="col-md-9 ms-sm-auto col-lg-5 px-md-4 alert alert-primary alert-dismissible fade show fixed-bottom" role="alert">
        	${res}
        	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        	</div>`
        }).catch(error =>console.log('error', error));
})