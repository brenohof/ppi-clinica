function checkLogin(event) {
    event.preventDefault();
    const form = document.forms[0]
    const formData = new FormData(form);

    const options = {
        method: 'post',
        body: formData
    }

    fetch('../php/login.php', options)
        .then(response => response.json())
        .then(json => {
            if (!json.success) {
                document.getElementById('alerta').innerHTML = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>${json.message}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`
            } else {
                window.location.replace('./private/index.php');
            }
        })
}

document.getElementById('btn-login').onclick = checkLogin