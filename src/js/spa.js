const singlePageApplication = () => {
    document.querySelectorAll('[prop-spa]').forEach(page => {

        const href = page.getAttribute('prop-spa');
        const main = document.getElementById('spa');

        page.onclick = function () {
            fetch(href)
                .then(response => response.text())
                .then(html => {
                    main.innerHTML = html;
                })
        }
    })
}

singlePageApplication()