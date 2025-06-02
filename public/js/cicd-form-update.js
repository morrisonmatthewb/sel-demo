document.querySelectorAll('input, select, textarea').forEach(input => {
    input.addEventListener('change', function() {
        const fieldName = this.name;
        const fieldValue = this.value;

        fetch('/labs/cicd-config-management/form-update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                field: fieldName,
                value: fieldValue
            })
        });
    });
});