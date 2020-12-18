function showForm() {
    const fieldset = document.getElementById('checkMedico');
    if (this.checked)
        fieldset.style.display = 'block';
    else
        fieldset.style.display = 'none';
}

function formFuncionario() {
    document.getElementById('selectMedico').addEventListener('change', showForm)
}

function showCep() {

    const inputCep = document.querySelector('input[id="cep"]')
    inputCep.onkeyup = (e) => buscaEndereco(inputCep.value);

}

function buscaEndereco(cep) {
    if (cep.length != 8)
        return;

    let form = document.forms[0];
    let url = '../../php/busca-endereco.php?cep=' + cep;

    fetch(url)
        .then(response => {
            // A requisição finalizou com sucesso.
            if (response.ok) {

                return response.json();
            }
            else {
                return Promise.reject(response);
            }
        })
        .then(endereco => {
            form.bairro.value = endereco.bairro;
            form.cidade.value = endereco.cidade;
            form.logradouro.value = endereco.value;
            form.estado.value = endereco.value;
        })
        .catch(error => {
            form.reset();
            console.warn('Falha inesperada: ', error);
        });
}