const singlePageApplication = () => {
    document.querySelectorAll('[prop-spa]').forEach(page => {

        const href = page.getAttribute('prop-spa');

        page.onclick = () => insertPage(href)
    })
}

function insertPage(href) {
    const main = document.getElementById('spa');
    fetch(href)
        .then(response => response.text())
        .then(html => {
            main.innerHTML = html;
        })
}

singlePageApplication()
insertPage('./pages/public/home.html')