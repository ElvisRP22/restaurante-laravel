import './bootstrap';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

const notyf = new Notyf({
    duration: 3000,
    position: {
        x: 'right',
        y: 'top'
    }
});

if (window.errorMessage) {
    notyf.error(window.errorMessage);
}

if (window.successMessage) {
    notyf.success(window.successMessage);
}

if (window.infoMessage) {
    notyf.info(window.infoMessage);
}

if (window.warningMessage) {
    notyf.warning(window.warningMessage);
}