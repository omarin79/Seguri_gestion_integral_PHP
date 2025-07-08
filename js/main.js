// C:\xampp\htdocs\securigestion\js\main.js

document.addEventListener('DOMContentLoaded', () => {

    // --- LÓGICA DE AUTOCOMPLETAR ---
    const autocompleteInputs = document.querySelectorAll('input[data-autocomplete-nombre]');
    
    autocompleteInputs.forEach(inputCedula => {
        const idInputNombre = inputCedula.dataset.autocompleteNombre;
        const inputNombre = document.getElementById(idInputNombre);
        
        const resultsContainer = document.createElement('div');
        resultsContainer.className = 'autocomplete-results';
        inputCedula.parentNode.style.position = 'relative';
        inputCedula.parentNode.appendChild(resultsContainer);

        inputCedula.addEventListener('input', async () => {
            const term = inputCedula.value;
            resultsContainer.innerHTML = '';
            
            if (term.length < 2) return;

            try {
                const response = await fetch(`actions/autocomplete_action.php?term=${term}`);
                if (!response.ok) return;
                
                const suggestions = await response.json();

                suggestions.forEach(suggestion => {
                    const suggestionDiv = document.createElement('div');
                    suggestionDiv.className = 'autocomplete-suggestion';
                    suggestionDiv.textContent = suggestion.label;
                    
                    suggestionDiv.addEventListener('click', () => {
                        inputCedula.value = suggestion.value;
                        if (inputNombre) {
                            inputNombre.value = suggestion.nombre;
                        }
                        resultsContainer.innerHTML = '';
                    });

                    resultsContainer.appendChild(suggestionDiv);
                });
            } catch (error) {
                console.error("Error en autocompletar:", error);
            }
        });

        document.addEventListener('click', (e) => {
            if (e.target !== inputCedula) {
                resultsContainer.innerHTML = '';
            }
        });
    });
});