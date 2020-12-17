function checkLogin (e) {
    e.preventDefault();
    fetch('../php/login.php')
        .then(response => response.json())
        .then(json => {
            if (!json.success) {
                console.log(json)
            }
        })
}

document.getElementById('btn-login').onclick = checkLogin