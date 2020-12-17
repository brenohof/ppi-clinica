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