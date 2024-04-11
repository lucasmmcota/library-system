// Atualiza nome do arquivo importado
function updateFileName(input) {
    let fileName = input.files[0].name;
    let label = input.previousElementSibling;
    label.textContent = fileName;
}

// Validacao ao submter formulario
document.getElementById("import-form").addEventListener("submit", function(event) {
    let fileInput = document.getElementById("csv-file");
    if (!fileInput.files[0]) {
        alert("Por favor selecione um arquivo.");
        event.preventDefault();
        return;
    }
    
    if (!fileInput.files[0].name.endsWith(".csv")) {
        alert("Por favor selecione um arquivo CSV válido.");
        event.preventDefault();
    }
});