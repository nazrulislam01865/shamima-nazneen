(() => {
    'use strict';

    const fallbackText = document.body.dataset.imageFallbackText || 'Image is not available.';
    const showFallback = (image) => {
        if (!image || image.dataset.fallbackApplied === '1') return;
        image.dataset.fallbackApplied = '1';
        image.hidden = true;
        const fallback = document.createElement('span');
        fallback.className = 'admin-image-fallback';
        fallback.textContent = image.dataset.fallbackText || image.alt || fallbackText;
        image.insertAdjacentElement('afterend', fallback);
    };
    document.querySelectorAll('img').forEach((image) => {
        image.addEventListener('error', () => showFallback(image), { once: true });
        if (!image.getAttribute('src') || (image.complete && image.naturalWidth === 0)) showFallback(image);
    });

    const shell = document.querySelector('[data-admin-shell]');
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const setSidebar = (open) => shell?.classList.toggle('sidebar-open', open);
    document.querySelector('[data-sidebar-toggle]')?.addEventListener('click', () => setSidebar(true));
    document.querySelector('[data-sidebar-backdrop]')?.addEventListener('click', () => setSidebar(false));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') setSidebar(false);
    });

    // Keep the sidebar steady between admin page changes so it does not visually flash or jump to the top.
    if (sidebar) {
        const sidebarScrollKey = 'shamimaAdminSidebarScrollTop';
        const restoreSidebarScroll = () => {
            const savedScroll = Number(window.sessionStorage.getItem(sidebarScrollKey) || 0);
            if (Number.isFinite(savedScroll) && savedScroll > 0) sidebar.scrollTop = savedScroll;
        };
        restoreSidebarScroll();
        window.requestAnimationFrame(restoreSidebarScroll);

        let sidebarScrollTimer;
        sidebar.addEventListener('scroll', () => {
            window.clearTimeout(sidebarScrollTimer);
            sidebarScrollTimer = window.setTimeout(() => {
                window.sessionStorage.setItem(sidebarScrollKey, String(sidebar.scrollTop));
            }, 80);
        }, { passive: true });

        document.querySelectorAll('.admin-sidebar a, .admin-nav a').forEach((link) => {
            link.addEventListener('click', () => {
                window.sessionStorage.setItem(sidebarScrollKey, String(sidebar.scrollTop));
            });
        });
    }

    document.querySelectorAll('[data-dismiss-alert]').forEach((button) => {
        button.addEventListener('click', () => button.closest('.admin-alert')?.remove());
    });

    const cssEscape = (value) => {
        if (window.CSS?.escape) return window.CSS.escape(String(value));
        return String(value).replace(/[^a-zA-Z0-9_-]/g, '\\$&');
    };

    const errorFieldId = (name) => String(name || '').replace(/[^A-Za-z0-9_-]+/g, '_');

    const dottedNameToInputName = (name) => {
        const parts = String(name || '').split('.').filter(Boolean);
        if (parts.length <= 1) return String(name || '');
        return `${parts.shift()}${parts.map((part) => `[${part}]`).join('')}`;
    };

    const fieldLabel = (wrapper, field) => {
        const label = wrapper?.querySelector('label')?.textContent || field?.getAttribute('aria-label') || field?.name || 'This field';
        return label.replace('*', '').replace(/\s+/g, ' ').trim() || 'This field';
    };

    const friendlyValidityMessage = (field, wrapper) => {
        const label = fieldLabel(wrapper, field);
        const lowerLabel = label.charAt(0).toLowerCase() + label.slice(1);
        const validity = field.validity;
        if (validity.valueMissing) return `${label} is required.`;
        if (validity.typeMismatch && field.type === 'email') return `Enter a valid email address.`;
        if (validity.typeMismatch && field.type === 'url') return `Enter a valid link for ${lowerLabel}.`;
        if (validity.tooShort) return `${label} is too short.`;
        if (validity.tooLong) return `${label} is too long.`;
        if (validity.rangeUnderflow) return `${label} must be at least ${field.min}.`;
        if (validity.rangeOverflow) return `${label} must be ${field.max} or less.`;
        if (validity.stepMismatch || validity.badInput) return `Enter a valid number for ${lowerLabel}.`;
        if (validity.patternMismatch) return `Enter ${lowerLabel} in the correct format.`;
        return field.validationMessage || `Please check ${lowerLabel}.`;
    };

    const getFieldWrapper = (field) => field?.closest?.('[data-field-wrapper], .form-field, .checkbox-field, label') || null;

    const ensureFieldError = (field) => {
        if (!field) return null;
        const wrapper = getFieldWrapper(field);
        if (!wrapper) return null;
        wrapper.classList.add('has-error');
        field.setAttribute('aria-invalid', 'true');

        let error = wrapper.querySelector('.field-error[data-client-error="true"]') || wrapper.querySelector('.field-error');
        if (!error) {
            error = document.createElement('small');
            error.className = 'field-error';
            error.dataset.clientError = 'true';
            wrapper.appendChild(error);
        }
        if (!error.id) error.id = `${field.id || errorFieldId(field.name || 'field')}_error`;
        field.setAttribute('aria-describedby', error.id);
        if (field.validity && !field.validity.valid) error.textContent = friendlyValidityMessage(field, wrapper);
        return wrapper;
    };

    const clearFieldError = (field) => {
        const wrapper = getFieldWrapper(field);
        if (!wrapper) return;
        if (!field.validity || field.validity.valid) {
            field.removeAttribute('aria-invalid');
            wrapper.querySelector('.field-error[data-client-error="true"]')?.remove();
            if (!wrapper.querySelector('.field-error')) wrapper.classList.remove('has-error');
        }
    };

    const focusInside = (target) => {
        const focusable = target?.matches?.('input:not([type="hidden"]), select, textarea, button, [contenteditable="true"], a[href]')
            ? target
            : target?.querySelector?.('[contenteditable="true"], input:not([type="hidden"]), select, textarea, button, a[href]');
        focusable?.focus?.({ preventScroll: true });
    };

    const scrollToField = (target) => {
        if (!target) return;
        const element = target.closest?.('[data-field-wrapper], .form-field, .checkbox-field, label') || target;
        const top = Math.max(0, element.getBoundingClientRect().top + window.scrollY - 110);
        window.scrollTo({ top, behavior: 'smooth' });
        element.classList.add('error-focus-pulse');
        window.setTimeout(() => element.classList.remove('error-focus-pulse'), 1400);
        focusInside(element);
    };

    const findFieldByErrorName = (name) => {
        if (!name) return null;
        const id = errorFieldId(name);
        return document.getElementById(id)
            || document.querySelector(`[data-field-name="${cssEscape(name)}"]`)
            || document.querySelector(`[name="${cssEscape(name)}"]`)
            || document.querySelector(`[name="${cssEscape(dottedNameToInputName(name))}"]`)
            || document.querySelector(`[id="${cssEscape(id)}"]`);
    };

    const prepareServerErrors = () => {
        document.querySelectorAll('.field-error').forEach((error) => {
            const wrapper = error.closest('[data-field-wrapper], .form-field, .checkbox-field, label');
            if (!wrapper) return;
            wrapper.classList.add('has-error');
            const field = wrapper.querySelector('[contenteditable="true"], input:not([type="hidden"]), select, textarea');
            if (field) {
                field.setAttribute('aria-invalid', 'true');
                if (!error.id) error.id = `${field.id || errorFieldId(field.name || 'field')}_error`;
                field.setAttribute('aria-describedby', error.id);
            }
        });
    };

    const focusFirstServerError = () => {
        const first = document.querySelector('.field-error, [aria-invalid="true"], .has-error');
        if (first) scrollToField(first);
    };

    prepareServerErrors();

    document.querySelectorAll('[data-error-link]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const target = findFieldByErrorName(link.dataset.errorField) || document.querySelector(link.getAttribute('href') || '');
            if (!target) return;
            event.preventDefault();
            scrollToField(target);
        });
    });

    document.addEventListener('invalid', (event) => {
        if (!(event.target instanceof HTMLElement)) return;
        ensureFieldError(event.target);
    }, true);

    document.addEventListener('input', (event) => {
        if (event.target instanceof HTMLElement) clearFieldError(event.target);
    }, true);

    document.addEventListener('change', (event) => {
        if (event.target instanceof HTMLElement) clearFieldError(event.target);
    }, true);

    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) return;
        if (form.checkValidity()) return;
        event.preventDefault();
        const firstInvalid = form.querySelector(':invalid');
        ensureFieldError(firstInvalid);
        scrollToField(firstInvalid);
        firstInvalid?.reportValidity?.();
    }, true);

    window.requestAnimationFrame(() => {
        if (document.querySelector('[data-error-summary]')) focusFirstServerError();
    });

    document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const message = form.dataset.confirmDelete || 'Delete this item permanently?';
            if (!window.confirm(message)) event.preventDefault();
        });
    });

    const bindImageUploadPreview = (wrapper) => {
        if (!wrapper || wrapper.dataset.imageUploadBound === '1') return;
        const input = wrapper.querySelector('[data-image-input]');
        const preview = wrapper.querySelector('[data-image-preview]');
        if (!input || !preview) return;

        wrapper.dataset.imageUploadBound = '1';
        input.addEventListener('change', () => {
            const file = input.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                preview.innerHTML = '';
                const image = document.createElement('img');
                image.src = String(reader.result);
                image.alt = 'Selected image preview';
                preview.appendChild(image);
                preview.classList.add('has-image');
            });
            reader.readAsDataURL(file);
        });
    };

    document.querySelectorAll('[data-image-upload]').forEach(bindImageUploadPreview);

    document.querySelectorAll('[data-rich-editor]').forEach((wrapper) => {
        const editor = wrapper.querySelector('[data-rich-content]');
        const textarea = wrapper.querySelector('textarea');
        if (!editor || !textarea) return;

        const sync = () => {
            textarea.value = editor.innerHTML.trim();
            textarea.dispatchEvent(new Event('input', { bubbles: true }));
        };

        wrapper.querySelectorAll('[data-command]').forEach((button) => {
            button.addEventListener('mousedown', (event) => event.preventDefault());
            button.addEventListener('click', () => {
                const command = button.dataset.command;
                let value = button.dataset.value || null;
                if (command === 'createLink') {
                    value = window.prompt('Enter the complete link URL (https://...)');
                    if (!value) return;
                }
                editor.focus();
                document.execCommand(command, false, value);
                sync();
            });
        });
        const clearClientError = () => {
            wrapper.querySelector('[data-rich-client-error]')?.remove();
            wrapper.classList.remove('has-error');
        };

        let savedRange = null;
        const captureSelection = () => {
            const selection = window.getSelection();
            if (!selection || selection.rangeCount === 0) return;
            const range = selection.getRangeAt(0);
            if (editor.contains(range.commonAncestorContainer)) savedRange = range.cloneRange();
        };

        ['keyup', 'mouseup', 'focus'].forEach((eventName) => editor.addEventListener(eventName, captureSelection));
        editor.addEventListener('input', () => {
            sync();
            captureSelection();
            if (editor.textContent.trim() || editor.querySelector('img')) clearClientError();
        });
        editor.addEventListener('blur', sync);

        const imageButton = wrapper.querySelector('[data-rich-image-button]');
        const imageInput = wrapper.querySelector('[data-rich-image-input]');
        const uploadStatus = wrapper.querySelector('[data-rich-upload-status]');
        if (imageButton && imageInput && wrapper.dataset.richImageUploadUrl) {
            imageButton.addEventListener('mousedown', (event) => event.preventDefault());
            imageButton.addEventListener('click', () => {
                captureSelection();
                imageInput.click();
            });

            imageInput.addEventListener('change', async () => {
                const file = imageInput.files?.[0];
                if (!file) return;

                imageButton.disabled = true;
                if (uploadStatus) uploadStatus.textContent = 'Uploading image…';

                const formData = new FormData();
                formData.append('image', file);

                try {
                    const response = await fetch(wrapper.dataset.richImageUploadUrl, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: formData,
                    });
                    const payload = await response.json().catch(() => ({}));
                    if (!response.ok || !payload.url) {
                        const validationMessage = payload.errors?.image?.[0];
                        throw new Error(validationMessage || payload.message || 'The image could not be uploaded.');
                    }

                    const figure = document.createElement('figure');
                    figure.className = 'content-figure';
                    const image = document.createElement('img');
                    image.src = payload.url;
                    image.alt = file.name.replace(/\.[^.]+$/, '').replace(/[-_]+/g, ' ');
                    image.loading = 'lazy';
                    image.className = 'content-image';
                    figure.appendChild(image);

                    editor.focus();
                    const selection = window.getSelection();
                    if (selection && savedRange && editor.contains(savedRange.commonAncestorContainer)) {
                        selection.removeAllRanges();
                        selection.addRange(savedRange);
                        savedRange.deleteContents();
                        savedRange.insertNode(figure);
                        savedRange.setStartAfter(figure);
                        savedRange.collapse(true);
                        selection.removeAllRanges();
                        selection.addRange(savedRange);
                    } else {
                        editor.appendChild(figure);
                    }

                    sync();
                    if (uploadStatus) uploadStatus.textContent = ''; 
                } catch (error) {
                    if (uploadStatus) uploadStatus.textContent = error.message || 'The image could not be uploaded.';
                } finally {
                    imageButton.disabled = false;
                    imageInput.value = '';
                }
            });
        }

        wrapper.closest('form')?.addEventListener('submit', (event) => {
            sync();
            if (wrapper.dataset.richRequired !== '1' || editor.textContent.trim()) return;

            event.preventDefault();
            wrapper.classList.add('has-error');
            if (!wrapper.querySelector('[data-rich-client-error]')) {
                const error = document.createElement('small');
                error.className = 'field-error';
                error.dataset.richClientError = 'true';
                error.textContent = 'This field must contain readable text.';
                wrapper.appendChild(error);
            }
            editor.focus();
        });
    });

    const updateMediaPanels = (select) => {
        const scope = select.closest('form') || document;
        const current = select.value;
        scope.querySelectorAll('[data-media-panel]').forEach((panel) => {
            panel.hidden = panel.dataset.mediaPanel !== current;
        });
    };
    document.querySelectorAll('[data-media-type]').forEach((select) => {
        updateMediaPanels(select);
        select.addEventListener('change', () => updateMediaPanels(select));
    });

    document.querySelectorAll('form[data-disable-on-submit]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (event.defaultPrevented || !form.checkValidity()) return;
            form.querySelectorAll('[data-submit-button]').forEach((button) => {
                button.disabled = true;
                button.textContent = 'Saving…';
            });
        });
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    const sortableItems = (list) => Array.from(list.querySelectorAll(':scope > [data-sortable-item]'));

    const setSortStatus = (list, message, state = '') => {
        const container = list.closest('.admin-card, .page-group') || document;
        const status = container.querySelector('[data-sort-status]');
        if (!status) return;
        status.classList.remove('is-saving', 'is-saved', 'is-error');
        if (state) status.classList.add(`is-${state}`);
        const text = status.querySelector('span:last-child');
        if (text) text.textContent = message;
    };

    const saveSortOrder = async (list) => {
        const url = list.dataset.reorderUrl;
        if (!url) return;

        const order = sortableItems(list).map((item) => Number(item.dataset.id));
        setSortStatus(list, 'Saving the new sequence…', 'saving');

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ order }),
            });

            const payload = await response.json().catch(() => ({}));
            if (!response.ok) throw new Error(payload.message || 'The sequence could not be saved.');

            setSortStatus(list, 'Sequence saved automatically.', 'saved');
        } catch (error) {
            setSortStatus(list, error.message || 'The sequence could not be saved. Refresh and try again.', 'error');
        }
    };

    document.querySelectorAll('[data-sortable-list]').forEach((list) => {
        let draggedItem = null;

        const moveItem = (item, direction) => {
            const items = sortableItems(list);
            const currentIndex = items.indexOf(item);
            const targetIndex = currentIndex + direction;
            if (currentIndex < 0 || targetIndex < 0 || targetIndex >= items.length) return;

            if (direction < 0) {
                list.insertBefore(item, items[targetIndex]);
            } else {
                list.insertBefore(items[targetIndex], item);
            }

            item.classList.add('sort-just-moved');
            window.setTimeout(() => item.classList.remove('sort-just-moved'), 500);
            item.querySelector('[data-drag-handle]')?.focus();
            saveSortOrder(list);
        };

        sortableItems(list).forEach((item) => {
            const handle = item.querySelector('[data-drag-handle]');
            if (!handle) return;

            handle.addEventListener('dragstart', (event) => {
                draggedItem = item;
                item.classList.add('is-dragging');
                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', String(item.dataset.id));
            });

            handle.addEventListener('dragend', () => {
                if (!draggedItem) return;
                draggedItem.classList.remove('is-dragging');
                draggedItem = null;
                sortableItems(list).forEach((row) => row.classList.remove('drag-over'));
                saveSortOrder(list);
            });

            handle.addEventListener('keydown', (event) => {
                if (event.key === 'ArrowUp') {
                    event.preventDefault();
                    moveItem(item, -1);
                }
                if (event.key === 'ArrowDown') {
                    event.preventDefault();
                    moveItem(item, 1);
                }
            });
        });

        list.addEventListener('dragover', (event) => {
            if (!draggedItem) return;
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';

            const target = event.target.closest('[data-sortable-item]');
            if (!target || target === draggedItem || target.parentElement !== list) return;

            const rect = target.getBoundingClientRect();
            const after = event.clientY > rect.top + rect.height / 2;
            list.insertBefore(draggedItem, after ? target.nextSibling : target);
            sortableItems(list).forEach((row) => row.classList.toggle('drag-over', row === target));
        });

        list.addEventListener('drop', (event) => {
            if (!draggedItem) return;
            event.preventDefault();
            sortableItems(list).forEach((row) => row.classList.remove('drag-over'));
        });
    });


    document.querySelectorAll('[data-media-picker]').forEach((picker) => {
        const input = picker.querySelector('[data-media-picker-input]');
        const cards = Array.from(picker.querySelectorAll('[data-media-picker-card]'));
        const preview = picker.querySelector('[data-media-picker-preview]');
        const title = picker.querySelector('[data-media-picker-preview-title]');
        const clearButton = picker.querySelector('[data-media-picker-clear]');

        const kind = picker.dataset.mediaKind || 'image';

        const renderPreview = (url, name, alt) => {
            if (!preview) return;
            preview.classList.toggle('has-image', Boolean(url));
            preview.querySelector('img, [data-media-picker-empty]')?.remove();

            if (url) {
                const image = document.createElement('img');
                image.src = url;
                image.alt = alt || name || `Selected ${kind}`;
                image.dataset.mediaPickerPreviewImage = 'true';
                preview.prepend(image);
            } else {
                const empty = document.createElement('span');
                empty.dataset.mediaPickerEmpty = 'true';
                empty.textContent = `No ${kind} selected yet.`;
                preview.prepend(empty);
            }

            if (title) title.textContent = name || `No ${kind} selected`;
        };

        const selectCard = (card) => {
            if (!input || !card) return;
            input.value = card.dataset.mediaId || '';
            cards.forEach((item) => {
                const active = item === card;
                item.classList.toggle('is-selected', active);
                item.setAttribute('aria-selected', active ? 'true' : 'false');
            });
            renderPreview(card.dataset.mediaUrl || '', card.dataset.mediaTitle || `Selected ${kind}`, card.dataset.mediaAlt || card.dataset.mediaTitle || `Selected ${kind}`);
        };

        cards.forEach((card) => {
            card.addEventListener('click', () => selectCard(card));
        });

        clearButton?.addEventListener('click', () => {
            if (input) input.value = '';
            cards.forEach((item) => {
                item.classList.remove('is-selected');
                item.setAttribute('aria-selected', 'false');
            });
            const currentUrl = picker.dataset.currentUrl || '';
            const currentTitle = picker.dataset.currentTitle || `No ${kind} selected`;
            renderPreview(currentUrl, currentTitle, picker.dataset.currentAlt || currentTitle);
        });
    });


    document.querySelectorAll('[data-repeatable-links]').forEach((wrapper) => {
        const rows = wrapper.querySelector('[data-repeatable-rows]');
        const template = wrapper.querySelector('template[data-repeatable-template]');
        const addButton = wrapper.querySelector('[data-repeatable-add]');
        const fieldName = wrapper.dataset.repeatableName || 'home_links';
        if (!rows || !template || !addButton) return;

        const bindRemove = (row) => {
            row.querySelector('[data-repeatable-remove]')?.addEventListener('click', () => {
                const allRows = rows.querySelectorAll('[data-repeatable-row]');
                if (allRows.length === 1) {
                    row.querySelectorAll('input, textarea, select').forEach((field) => {
                        if (field.matches('input[type=checkbox], input[type=radio]')) {
                            field.checked = false;
                        } else {
                            field.value = '';
                        }
                    });
                    row.querySelectorAll('[data-image-preview]').forEach((preview) => {
                        preview.innerHTML = '<span>Auto logo will be used</span>';
                        preview.classList.remove('has-image');
                    });
                    return;
                }
                row.remove();
            });
        };

        rows.querySelectorAll('[data-repeatable-row]').forEach(bindRemove);
        addButton.addEventListener('click', () => {
            const index = Number(wrapper.dataset.nextIndex || rows.children.length);
            wrapper.dataset.nextIndex = String(index + 1);
            const fragment = template.content.cloneNode(true);
            const row = fragment.querySelector('[data-repeatable-row]');
            row.querySelectorAll('[data-field]').forEach((input) => {
                const field = input.dataset.field;
                input.name = `${fieldName}[${index}][${field}]`;
                input.id = `${fieldName}_${index}_${field}`;
                input.closest('.form-field')?.querySelector('label')?.setAttribute('for', input.id);
            });
            bindRemove(row);
            rows.appendChild(fragment);
            row.querySelectorAll('[data-image-upload]').forEach(bindImageUploadPreview);
            row.querySelector('input:not([type=hidden]), textarea, select')?.focus();
        });
    });


    const makeAdminButtonBusy = (element) => {
        if (!element || element.dataset.loadingApplied === '1') return;
        element.dataset.loadingApplied = '1';
        element.classList.add('is-loading');
        element.setAttribute('aria-busy', 'true');
        const width = element.getBoundingClientRect().width;
        if (width > 0) element.style.minWidth = `${Math.ceil(width)}px`;
        if (element.matches('button, input[type="submit"]')) element.disabled = true;
    };

    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) return;
        if (event.defaultPrevented || !form.checkValidity()) return;

        const submitter = event.submitter || form.querySelector('button[type="submit"], input[type="submit"], .admin-button[type="submit"]');
        makeAdminButtonBusy(submitter);
    });

    document.querySelectorAll('a.admin-button').forEach((link) => {
        link.addEventListener('click', (event) => {
            if (event.defaultPrevented || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
            if (link.target === '_blank' || link.hasAttribute('download')) return;
            const href = link.getAttribute('href') || '';
            if (!href || href === '#' || href.startsWith('#') || href.startsWith('javascript:')) return;
            makeAdminButtonBusy(link);
        });
    });

})();
