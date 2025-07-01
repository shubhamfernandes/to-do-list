
//require('./bootstrap');
import '../css/app.css';

// Flash message auto-dismiss
 document.addEventListener('DOMContentLoaded', function () {
        const flashToast = document.getElementById('flashToast');
        if (flashToast) {
            const toast = new bootstrap.Toast(flashToast, { delay: 3000 });
            toast.show();
        }

        const errorToast = document.getElementById('errorToast');
        if (errorToast) {
            const toast = new bootstrap.Toast(errorToast, { delay: 4000 });
            toast.show();
        }
    });

