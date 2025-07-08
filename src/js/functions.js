export const $ = document.querySelector.bind(document);
export const $$ = document.querySelectorAll.bind(document);

export function getSrcFromInput(el, input) {
    el.src = input.value.trim();
}

export function confirmSubmit(form, button, str) {
    button.addEventListener('click', (e) => {
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const result = confirm(str);
        if (result) {
            form.submit();
        } else {
            e.preventDefault();
        }
    });
}