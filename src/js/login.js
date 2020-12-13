function checkLogin (e) {
    e.preventDefault();
    fetch('../php/login.php')
        .then(response => response.text())
        .then(json => {
            if (!json.success) {
                console.log(json)
            }
        })
}

document.getElementById('btn-login').onclick = checkLogin