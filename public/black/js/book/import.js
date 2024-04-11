function validateInputs(values) {
    let errors = [];

    let validatedBookTitle = values[0] && values[0].length <= 50;
    let validatedAuthor = values[1] && validateName(values[1]);
    let validatedBookPublisher = values[2] && values[2].length <= 30;
    let validatedEdition = values[3] && validateNumber(values[3]) && values[3] > 0;
    let validatedVolume = values[4] && validateNumber(values[4]) && values[4] > 0;
    let validatedYear = values[5] && validateNumber(values[5]) && values[5] > 999 && values[5] < 10000;
    let validatedCopies = values[6] && validateNumber(values[6]) && values[6] > 0;
    let validatedReferenceBook = values[7] && validateNumber(values[7]) && values[7] >= 0;
    let validatedIsbn = values[8] && validateIsbn(values[8]);
  
    if (!validatedBookTitle) {
        errors.push('Título do livro não informado ou muito grande;');
    }
  
    if (!validatedAuthor) {
        errors.push('Nome do autor não informado ou inválido;');
    }
  
    if (!validatedBookPublisher) {
        errors.push('Nome da editora não informado ou muito grande;');
    }
  
    if (!validatedEdition) {
        errors.push('Edição não informada ou inválida;');
    }

    if (!validatedVolume) {
        errors.push('Volume não informado ou inválido;');
    }
  
    if (!validatedYear) {
        errors.push('Ano não informado ou inválido;');
    }
  
    if (!validatedCopies) {
        errors.push('Número de cópias inválido;');
    }

    if (!validatedReferenceBook) {
        errors.push('Número de livros de referência inválido;');
    }

    if (values[7] > values[6]) {
        errors.push('Número de cópias deve ser maior ou igual ao número de livros de referência;');
    }
  
    if (!validatedIsbn) {
        errors.push('ISBN inválido ou já está em uso;');
    } else if (values[9].includes(values[8])) {
        errors.push('ISBN já foi informado na importação;');
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
        let rowIndexes = [];
        let errorMessages = [];
        let arrayIsbn = [];

        // Verifica as linhas que contem valores invalidos
        for (let i = 1; i < lines.length - 1; i++) {
            let values = lines[i].split(";");

            values[9] = arrayIsbn;

            let errorMessage = validateInputs(values);

            if (errorMessage) {
                invalidRows.push(i + 1);
                errorMessages.push(errorMessage);
                rowIndexes.push(i - 1);
            } else {
                arrayIsbn.push(values[8]);
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
