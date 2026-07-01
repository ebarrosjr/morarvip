(function () {
    const modalElement = document.getElementById('default_modal');
    if (!modalElement) {
        return;
    }

    const modalBody = modalElement.querySelector('.modal-body');
    const getModal = function () {
        if (window.bootstrap && window.bootstrap.Modal) {
            return window.bootstrap.Modal.getOrCreateInstance(modalElement);
        }
        return null;
    };

    const applyModalSize = function () {
        const dialog = modalElement.querySelector('.modal-dialog');
        if (!dialog) {
            return;
        }

        const sizedContent = modalBody.querySelector('[data-modal-size]');
        const size = sizedContent ? sizedContent.dataset.modalSize : '';

        dialog.classList.remove('modal-md', 'modal-lg', 'modal-xl', 'property-submit-modal-dialog');
        if (size === 'xl') {
            dialog.classList.add('modal-xl', 'property-submit-modal-dialog');
        } else if (size === 'lg') {
            dialog.classList.add('modal-lg');
        }

        const modal = getModal();
        if (modal && typeof modal.handleUpdate === 'function') {
            modal.handleUpdate();
        }
    };

    const showModalMessage = function (form, message, type) {
        const messageBox = form.closest('.login-modal-content')?.querySelector('.auth-modal-message');
        if (!messageBox) {
            return;
        }

        messageBox.classList.remove('d-none', 'alert-danger', 'alert-success');
        messageBox.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');
        messageBox.textContent = message;
    };

    const openAuthModal = async function (url) {
        modalBody.innerHTML = '<div class="modal-loading text-center p-4">Carregando...</div>';
        const modal = getModal();
        if (modal) {
            modal.show();
        } else if (window.jQuery) {
            window.jQuery(modalElement).modal('show');
        }

        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        if (response.headers.get('content-type')?.includes('application/json')) {
            const payload = await response.json();
            if (payload.success) {
                if (payload.redirect) {
                    window.location.href = payload.redirect;
                }
                return;
            }
        }

        modalBody.innerHTML = await response.text();
        applyModalSize();
        bindAuthModalContent();
    };

    const bindAuthForm = function (form) {
        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            const messageBox = form.closest('.login-modal-content')?.querySelector('.auth-modal-message');
            if (messageBox) {
                messageBox.classList.add('d-none');
                messageBox.classList.remove('alert-danger', 'alert-success');
                messageBox.textContent = '';
            }

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: new FormData(form)
            });
            const payload = await response.json();

            if (payload.success) {
                if (payload.redirect) {
                    window.location.href = payload.redirect;
                    return;
                }

                showModalMessage(form, payload.message || 'Solicitação enviada com sucesso.', 'success');
                return;
            }

            showModalMessage(form, payload.message || 'Não foi possível processar sua solicitação.', 'danger');
        });
    };

    const bindAuthModalContent = function () {
        applyModalSize();
        modalBody.querySelectorAll('.js-auth-form').forEach(bindAuthForm);
        modalBody.querySelectorAll('.js-auth-modal').forEach(bindAuthLink);
    };

    const bindAuthLink = function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            openAuthModal(link.href).catch(function () {
                window.location.href = link.href;
            });
        });
    };

    document.querySelectorAll('.js-login-modal, .js-auth-modal').forEach(function (link) {
        bindAuthLink(link);
    });
})();
