document.addEventListener('DOMContentLoaded', function() {
    const submitSwitch = document.getElementById('submit-switch');
    if (submitSwitch) {
        submitSwitch.addEventListener('click', function() {
            fetch('/labs/cicd-config-management/module-submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
            })
            .then(response => {
                // Force reload regardless of response
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                // Reload even if there's an error since the action succeeded
                window.location.reload();
            });
        });
    }
});