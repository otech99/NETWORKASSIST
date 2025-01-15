function getErrorHtml(elemErrors) {
    if ((typeof (elemErrors) === 'undefined') || (elemErrors.length < 1))
        return;
    var out = '<ul class="errors">';
    for (var i = 0; i < elemErrors.length; i++) {
        out += '<li>' + elemErrors[i] + '</li>';
    }
    out += '</ul>';
    return out;
}

function doElemValidation(id, actionUrl, formId) {

    var formElems;

    function addFormToken() {
        var tokenVal = $("#" + formId + " input[name=_token]").val();
        formElems.append('_token', tokenVal);
    }

    function sendAjaxReq() {
        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formElems,
            dataType: "json",
            error: function (data) {
                if (data.status === 422) {
                    var errMsgs = JSON.parse(data.responseText);
                    $("#" + id).parent().find('.errors').html(' ');
                    $("#" + id).after(getErrorHtml(errMsgs[id]));
                }
            },
            contentType: false,
            processData: false
        });
    }
    
    var elem = $("#" + id);
    if (elem.attr('type') === 'file') {
    // elemento di input type=file valorizzato
        if (elem.val() !== '') {
            inputVal = elem.get(0).files[0];
        } else {
            inputVal = new File([""], "");
        }
    } else {
        // elemento di input type != file
        inputVal = elem.val();
    }
    formElems = new FormData();
    formElems.append(id, inputVal);
    addFormToken();
    sendAjaxReq();

}

function doFormValidation(actionUrl, formId) {

    var form = new FormData(document.getElementById(formId));
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form,
        dataType: "json",
        error: function (data) {
            if (data.status === 422) {
                var errMsgs = JSON.parse(data.responseText);
                $.each(errMsgs, function (id) {
                    $("#" + id).parent().find('.errors').html(' ');
                    $("#" + id).after(getErrorHtml(errMsgs[id]));
                });
            }
        },
        success: function (data) {
            window.location.replace(data.redirect);
        },
        contentType: false,
        processData: false
    });
}
document.getElementById('telefono').addEventListener('input', function (e) {
    const value = e.target.value;
    if (isNaN(value)) {
        alert('Inserisci solo numeri nel campo telefono!');
        e.target.value = value.replace(/\D/g, ''); // Rimuove i caratteri non numerici
    }
});
function searchTable() {
    // Prendi l'input della ricerca
    let input = document.getElementById("cerca");
    let filter = input.value.toLowerCase();

    // Cerca nei tecnici
    let tecniciTable = document.getElementById("tecnici-table");
    let tecniciRows = tecniciTable.getElementsByTagName("tr");

    for (let i = 1; i < tecniciRows.length; i++) {
        let row = tecniciRows[i];
        let cells = row.getElementsByTagName("td");
        let match = false;
        for (let j = 0; j < 3; j++) {
            if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        row.style.display = match ? "" : "none";
    }

    // Cerca nello staff
    let staffTable = document.getElementById("staff-table");
    let staffRows = staffTable.getElementsByTagName("tr");

    for (let i = 1; i < staffRows.length; i++) {
        let row = staffRows[i];
        let cells = row.getElementsByTagName("td");
        let match = false;
        for (let j = 0; j < 3; j++) {
            if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        row.style.display = match ? "" : "none";
    }
}
function searchMalfunctions() {
    // Ottieni il valore del campo di input
    const input = document.getElementById("search-malfunction");
    const filter = input.value.toLowerCase();

    // Ottieni solo la tabella dei malfunzionamenti
    const table = document.getElementById("malfunction-table");
    const rows = table.getElementsByTagName("tr");

    // Itera attraverso le righe della tabella dei malfunzionamenti
    for (let i = 0; i < rows.length; i++) {
        const malfunctionCell = rows[i].getElementsByTagName("td")[0]; // Prima colonna (Malfunzionamento)
        if (malfunctionCell) {
            const textValue = malfunctionCell.textContent || malfunctionCell.innerText;
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = ""; // Mostra la riga
            } else {
                rows[i].style.display = "none"; // Nascondi la riga
            }
        }
    }
}function searchProducts() {
    // Ottieni il termine di ricerca
    const searchTerm = document.getElementById("search").value.toLowerCase().trim();

    // Ottieni la tabella dei prodotti e tutte le righe
    const table = document.getElementById("prodottiTabella");
    const rows = Array.from(table.getElementsByTagName("tr")); // Converti le righe in un array

    let hasMatch = false; // Flag per verificare se ci sono corrispondenze

    // Rimuovi eventuale messaggio "Prodotto non trovato"
    table.querySelectorAll(".no-results").forEach(el => el.remove());

    // Itera attraverso tutte le righe della tabella
    rows.forEach(row => {
        const idCell = row.getElementsByTagName("td")[1]; // Colonna Prodotto (ID)
        const descriptionCell = row.getElementsByTagName("td")[2]; // Colonna Descrizione

        // Ottieni il testo delle celle
        const idText = idCell ? idCell.textContent.toLowerCase() : '';
        const descriptionText = descriptionCell ? descriptionCell.textContent.toLowerCase() : '';

        // Gestione del carattere jolly `*`
        const isMatch =
            searchTerm === '*' || // Se l'utente inserisce *, mostra tutto
            idText.includes(searchTerm.replace('*', '')) || // Cerca nell'ID
            descriptionText.includes(searchTerm.replace('*', '')); // Cerca nella Descrizione

        // Mostra o nascondi la riga in base alla corrispondenza
        row.style.display = isMatch ? "" : "none";

        if (isMatch) hasMatch = true; // Aggiorna il flag se esiste almeno una corrispondenza
    });

    // Se non ci sono corrispondenze, aggiungi una riga con "Prodotto non trovato"
    if (!hasMatch) {
        const noResultsRow = document.createElement("tr");
        noResultsRow.classList.add("no-results");
        noResultsRow.innerHTML = `
            <td colspan="6" style="text-align: center;">Prodotto non trovato</td>
        `;
        table.appendChild(noResultsRow);
    }
}

