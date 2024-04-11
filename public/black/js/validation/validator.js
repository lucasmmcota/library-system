// Funcao para verificar valor vazio
function isEmpty(value) {
    return (value === null || value === undefined) || (typeof value === 'string' && value.trim() === '') ?
        true : false;
}

// Funcao para verificar se valor e um numero
function validateNumber(number) {
    return !isNaN(number);
}

// Funcao para validar o nome
function validateName(name) {
    let regex = /^\D*$/;
    return regex.test(name) && name.length <= 50;
}

// Funcao para validar tipo do membro
function validateMemberType(memberType) {
    let registeredMemberType = JSON.parse(document.getElementById("array-member-type").value);
    return registeredMemberType.includes(parseInt(memberType));
}

// Funcao para validar o formato do e-mail
function validateEmail(email) {
    let registeredEmail = JSON.parse(document.getElementById("array-email").value);
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return !registeredEmail.includes(email) && regex.test(email);
}

// Funcao para validar o formato do telefone (1 a 11 dígitos)
function validatePhone(phone) {
    let registeredPhone = JSON.parse(document.getElementById("array-phone").value);
    let regex = /^\d{1,11}$/;

    return !registeredPhone.includes(phone) && regex.test(phone);
}  

// Funcao para validar o formato do CPF (11 dígitos)
function validateCpf(cpf) {
    let registeredCpf = JSON.parse(document.getElementById("array-cpf").value);
    let regex = /^\d{11}$/;

    return !registeredCpf.includes(cpf) && regex.test(cpf);
}

// Funcao para validar codigo ISBN
function validateIsbn(isbn) {
    let registeredIsbn = JSON.parse(document.getElementById("array-isbn").value);
    let regex = /^\d{10,13}$/;

    return !registeredIsbn.includes(isbn) && regex.test(isbn);
}  