const accessDialog = document.querySelector('#access-dialog');
const openAccessButtons = document.querySelectorAll('[data-open-access]');
const closeAccessButton = document.querySelector('[data-close-access]');

let accessTrigger = null;

if (accessDialog) {
    openAccessButtons.forEach((button) => {
        button.addEventListener('click', () => {
            accessTrigger = button;

            if (!accessDialog.open) {
                accessDialog.showModal();
            }
        });
    });

    if (closeAccessButton) {
        closeAccessButton.addEventListener('click', () => {
            accessDialog.close();
        });
    }

    accessDialog.addEventListener('click', (event) => {
        if (event.target !== accessDialog) {
            return;
        }

        const bounds = accessDialog.getBoundingClientRect();

        const clickedOutside =
            event.clientX < bounds.left ||
            event.clientX > bounds.right ||
            event.clientY < bounds.top ||
            event.clientY > bounds.bottom;

        if (clickedOutside) {
            accessDialog.close();
        }
    });

    accessDialog.addEventListener('close', () => {
        if (accessTrigger) {
            accessTrigger.focus();
        }
    });
}