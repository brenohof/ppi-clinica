const singlePageApplication = () => {
    document.querySelectorAll('[prop-spa]').forEach(page => {

        const href = page.getAttribute('prop-spa');

        page.onclick = () => insertPage(href)
    })
}

const specialPage = (prop) => {
    const page = document.querySelector(prop)

    let href = page.getAttribute('form-funcionario')
    page.onclick = () => insertPage(href, () => {
        formFuncionario();
        showCep();
    });
}


function insertPage(href, next) {
    const main = document.getElementById('spa');
    fetch(href)
        .then(response => response.text())
        .then(html => {
            main.innerHTML = html;
        }).then(() => {
            if (!!next) next();
        })
}