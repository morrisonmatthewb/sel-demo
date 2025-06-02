document.querySelectorAll('input, select, textarea').forEach(input => {
    input.addEventListener('change', function() {
        const fieldName = this.name;
        const fieldValue = this.value;

        console.log("Updating field:", fieldName, "with value:", fieldValue);

        fetch('/labs/cost-estimation/form-update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                field: fieldName , 
                value: fieldValue
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response:", data);  // Log the response from the server
        })
        .catch(error => console.error('Error updating field:', error));  // Log any network errors
    });
});
