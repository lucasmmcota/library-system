function validateInputs(values) {
    let errors = [];

    let validatedName = values[0] && validateName(values[0]);
    let validatedIdMembeType = validateMemberType(values[1]);
    let validatedEmail = isEmpty(values[2]) ? true : validateEmail(values[2]);
    let validatedPhone = isEmpty(values[3]) ? true : validatePhone(values[3]);
    let validatedCpf = isEmpty(values[4]) ? true : validateCpf(values[4]);
  
    if (!validatedName) {
        errors.push('Nome não informado ou inválido');
    }
  
    if (!validatedIdMembeType) {
        errors.push('Código do tipo de membro não informado ou inválido;');
    }
  
    if (!validatedEmail) {
        errors.push('E-mail inválido ou já está em uso;');
    } else if (values[5].includes(values[2])) {
        errors.push('E-mail já foi informado na importação;');
    }
  
    if (!validatedPhone) {
        errors.push('Telefone inválido ou já está em uso;');
    } else if (values[6].includes(values[3])) {
        errors.push('Telefone já foi informado na importação;');
    }
  
    if (!validatedCpf) {
        errors.push('CPF inválido ou já está em uso;');
    } else if (values[7].includes(values[4])) {
        errors.push('CPF já foi informado na importação;');
    }
  
    return errors.join(' ');
}

document.getElementById("csv-file").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (!file?.name?.endsWith(".csv")) {
        alert("Por favor selecione um arquivo CSV válido.");
        return;
    }

    // Le o conteudo do arquivo CSV
    let reader = new FileReader();
    reader.onload = function(event) {
        let csv = event.target.result;
        let lines = csv.split(/\r?\n/);
        let invalidRows = [];
        let errorMessages = [];
        let rowIndexes = [];
        let arrayEmail = [];
        let arrayPhone = [];
        let arrayCpf = [];

        // Verifica as linhas que contem valores invalidos
        for (let i = 1; i < lines.length - 1; i++) {
            let values = lines[i].split(";");
            
            values[5] = arrayEmail;
            values[6] = arrayPhone;
            values[7] = arrayCpf;

            let errorMessage = validateInputs(values);

            if (errorMessage) {
                invalidRows.push(i + 1);
                errorMessages.push(errorMessage);
                rowIndexes.push(i - 1);
            } else {
                arrayEmail.push(values[2]);
                arrayPhone.push(values[3]);
                arrayCpf.push(values[4]);
            }
        }

        // Exibe as linhas com valores invalidos
        let rowsDiv = document.getElementById("csv-rows");
        rowsDiv.innerHTML = "";

        if (invalidRows.length > 0) {
            let message = "<p style='color: white;'>As seguintes linhas possuem valores inválidos e não serão"
                + " incluídas: </p><ul>";
            let i = 0;
            for (const row of invalidRows) {
                message += "<li>Linha " + row + ": " + errorMessages[i] + "</li>";
                i++;
            }
            message += "</ul>";
            rowsDiv.innerHTML = message;
        }

        let invalidRowsInput = document.getElementById("invalid-rows");
        invalidRowsInput.value = JSON.stringify(rowIndexes);
    };
    reader.readAsText(file);
});
