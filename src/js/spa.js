const singlePageApplication = () => {
    document.querySelectorAll('[prop-spa]').forEach(page => {
        
        const href = page.getAttribute('prop-spa');

        page.onclick = () => insertPage(href)
    })
}

const specialPage = (prop) => {
    const page = document.querySelector(prop)
    if (prop === '[agendamento]') {
        let href = page.getAttribute('agendamento');
        page.onclick = () => insertPage(href, agendamento);
    } else if (prop === '[form-funcionario]') {
        let href = page.getAttribute('form-funcionario')
        page.onclick = () => insertPage(href, formFuncionario);
    }
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