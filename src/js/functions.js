export const $ = (selector, parent = document) => parent.querySelector(selector);
export const $$ = (selector, parent = document) => parent.querySelectorAll(selector);

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