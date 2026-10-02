import './bootstrap';

const initializePulso = () => {
    const body = document.body;

    if (!body || body.dataset.pulsoInitialized === 'true') {
        return;
    }

    body.dataset.pulsoInitialized = 'true';

    const sidebar = document.getElementById('app-sidebar');
    const sidebarBackdrop = document.getElementById('sidebar-backdrop');

    const openSidebarButton = document.getElementById('open-sidebar');
    const closeSidebarButton = document.getElementById('close-sidebar');

    const collapseSidebarButton = document.getElementById(
        'toggle-sidebar-collapse',
    );

    const appMain = document.getElementById('app-main');
    const isDesktop = () => window.innerWidth >= 1024;

    const focusable = (root) =>
        Array.from(
            root.querySelectorAll(
                'a[href], button:not(:disabled), input:not(:disabled), select:not(:disabled), textarea:not(:disabled), [tabindex="0"]',
            ),
        ).filter(
            (element) =>
                element.getClientRects().length &&
                !element.closest('[inert]'),
        );

    const trapFocus = (event, root) => {
        if (event.key !== 'Tab') {
            return;
        }

        const items = focusable(root);
        const first = items[0];
        const last = items.at(-1);

        if (!first) {
            return;
        }

        if (
            !root.contains(document.activeElement) ||
            (event.shiftKey && document.activeElement === first) ||
            (!event.shiftKey && document.activeElement === last)
        ) {
            event.preventDefault();

            (event.shiftKey ? last : first).focus();
        }
    };

    // Desktop sidebar

    let collapsedPreference = false;

    try {
        collapsedPreference =
            localStorage.getItem('pulso-sidebar-collapsed') === 'true';
    } catch {
        // Navigation must still work when browser storage is blocked.
    }

    const applyDesktopSidebarState = () => {
        body.classList.toggle(
            'sidebar-collapsed',
            isDesktop() && collapsedPreference,
        );

        const label = collapsedPreference
            ? 'Expand sidebar'
            : 'Collapse sidebar';

        collapseSidebarButton?.setAttribute('aria-label', label);
        collapseSidebarButton?.setAttribute('title', label);

        collapseSidebarButton?.setAttribute(
            'aria-expanded',
            String(!collapsedPreference),
        );
    };

    collapseSidebarButton?.addEventListener('click', () => {
        if (window.innerWidth < 1280) {
            return;
        }

        collapsedPreference = !collapsedPreference;

        applyDesktopSidebarState();

        try {
            localStorage.setItem(
                'pulso-sidebar-collapsed',
                String(collapsedPreference),
            );
        } catch {
            // Keep the preference for this page if storage is unavailable.
        }
    });

    // Mobile sidebar

    const archiveIsOpen = () => {
        const modal = document.getElementById('archive-asset-modal');

        return modal && !modal.classList.contains('hidden');
    };

    let sidebarOpen = false;
    let sidebarTimer;
    let sidebarFrame;

    const setSidebarOpen = (open, restoreFocus = true) => {
        if (
            !sidebar ||
            !sidebarBackdrop ||
            (open && archiveIsOpen())
        ) {
            return;
        }

        clearTimeout(sidebarTimer);
        cancelAnimationFrame(sidebarFrame);

        sidebarOpen = open && !isDesktop();

        sidebar.classList.toggle(
            '-translate-x-full',
            !isDesktop() && !sidebarOpen,
        );

        sidebar.inert =
            (!isDesktop() && !sidebarOpen) || archiveIsOpen();

        if (appMain) {
            appMain.inert = sidebarOpen || archiveIsOpen();
        }

        openSidebarButton?.setAttribute(
            'aria-expanded',
            String(sidebarOpen),
        );

        openSidebarButton?.setAttribute(
            'aria-controls',
            'app-sidebar',
        );

        body.classList.toggle(
            'overflow-hidden',
            sidebarOpen || archiveIsOpen(),
        );

        sidebarBackdrop.classList.toggle(
            'opacity-100',
            sidebarOpen,
        );

        sidebarBackdrop.classList.toggle(
            'opacity-0',
            !sidebarOpen,
        );

        if (sidebarOpen) {
            sidebarBackdrop.classList.remove('hidden');

            sidebarFrame = requestAnimationFrame(() => {
                closeSidebarButton?.focus();
            });
        } else {
            sidebarTimer = setTimeout(() => {
                sidebarBackdrop.classList.add('hidden');
            }, 200);

            if (restoreFocus && !isDesktop()) {
                openSidebarButton?.focus();
            }
        }
    };

    openSidebarButton?.addEventListener('click', () => {
        setSidebarOpen(true);
    });

    closeSidebarButton?.addEventListener('click', () => {
        setSidebarOpen(false);
    });

    sidebarBackdrop?.addEventListener('click', () => {
        setSidebarOpen(false);
    });

    let wasDesktop = isDesktop();

    window.addEventListener('resize', () => {
        const desktop = isDesktop();

        // Mobile keyboard and address-bar changes should not close the drawer.
        if (desktop !== wasDesktop) {
            const focusWasInSidebar = sidebar?.contains(
                document.activeElement,
            );

            setSidebarOpen(
                false,
                !desktop && focusWasInSidebar,
            );

            if (desktop && focusWasInSidebar) {
                focusable(sidebar)[0]?.focus();
            }

            wasDesktop = desktop;
        }

        applyDesktopSidebarState();
    });

    document.addEventListener('keydown', (event) => {
        if (!sidebarOpen) {
            return;
        }

        if (event.key === 'Escape') {
            event.preventDefault();
            setSidebarOpen(false);
        } else {
            trapFocus(event, sidebar);
        }
    });

    applyDesktopSidebarState();
    setSidebarOpen(false, false);

    // Toast notifications

    const showToast = (message, type = 'success') => {
        let container = document.getElementById(
            'frontend-toast-container',
        );

        if (!container) {
            container = document.createElement('div');
            container.id = 'frontend-toast-container';

            container.className =
                'fixed right-4 top-20 z-[100] flex w-[calc(100%-2rem)] max-w-sm flex-col gap-3 sm:right-6 sm:w-full';

            document.body.appendChild(container);
        }

        const toast = document.createElement('div');

        const accentClass =
            type === 'error'
                ? 'border-l-[#D64545]'
                : 'border-l-[#05ADB6]';

        toast.className = `
            translate-x-4
            rounded-xl
            border
            border-[#E5EAF0]
            border-l-4
            ${accentClass}
            bg-white
            px-4
            py-3
            opacity-0
            shadow-lg
            transition
            duration-200
        `;

        toast.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-[#182230]">
                        ${type === 'error' ? 'Notice' : 'Success'}
                    </p>

                    <p class="mt-1 text-sm leading-5 text-[#667085]"></p>
                </div>

                <button
                    type="button"
                    data-close-toast
                    aria-label="Dismiss notification"
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-[#98A2B3] hover:bg-[#F2F4F7]"
                >
                    ×
                </button>
            </div>
        `;

        toast.setAttribute(
            'role',
            type === 'error' ? 'alert' : 'status',
        );

        toast.querySelector('p.mt-1').textContent = message;

        container.appendChild(toast);

        requestAnimationFrame(() => {
            toast.classList.remove(
                'translate-x-4',
                'opacity-0',
            );
        });

        const removeToast = () => {
            toast.classList.add(
                'translate-x-4',
                'opacity-0',
            );

            setTimeout(() => {
                toast.remove();
            }, 200);
        };

        toast
            .querySelector('[data-close-toast]')
            ?.addEventListener('click', removeToast);

        setTimeout(removeToast, 3500);
    };

    // Inventory filters

    const inventoryTable = document.getElementById(
        'inventory-table',
    );

    let refreshInventoryState = () => {};

    if (inventoryTable) {
        const searchInput = document.getElementById(
            'inventory-search',
        );

        const categoryFilter = document.getElementById(
            'inventory-category-filter',
        );

        const statusFilter = document.getElementById(
            'inventory-status-filter',
        );

        const conditionFilter = document.getElementById(
            'inventory-condition-filter',
        );

        const clearFiltersButton = document.getElementById(
            'clear-inventory-filters',
        );

        const emptyState = document.getElementById(
            'inventory-empty-state',
        );

        const visibleCount = document.getElementById(
            'inventory-visible-count',
        );

        const paginationRange = document.getElementById(
            'inventory-pagination-range',
        );

        const totalCount = document.getElementById(
            'inventory-total-count',
        );

        const getRows = () =>
            Array.from(
                inventoryTable.querySelectorAll(
                    '[data-inventory-row]',
                ),
            );

        const updateInventoryPagination = (
            decrementTotal = false,
        ) => {
            const pageCount = getRows().length;

            if (paginationRange) {
                paginationRange.textContent =
                    pageCount > 0 ? `1–${pageCount}` : '0';
            }

            if (decrementTotal && totalCount) {
                const currentTotal = Number.parseInt(
                    totalCount.textContent,
                    10,
                );

                if (!Number.isNaN(currentTotal)) {
                    totalCount.textContent = String(
                        Math.max(currentTotal - 1, 0),
                    );
                }
            }
        };

        const applyInventoryFilters = () => {
            const searchValue =
                searchInput?.value.trim().toLowerCase() ?? '';

            const categoryValue = categoryFilter?.value ?? '';
            const statusValue = statusFilter?.value ?? '';
            const conditionValue = conditionFilter?.value ?? '';

            let matches = 0;

            getRows().forEach((row) => {
                const searchableText =
                    row.dataset.search?.toLowerCase() ?? '';

                const shouldShow =
                    (!searchValue ||
                        searchableText.includes(searchValue)) &&
                    (!categoryValue ||
                        row.dataset.category === categoryValue) &&
                    (!statusValue ||
                        row.dataset.status === statusValue) &&
                    (!conditionValue ||
                        row.dataset.condition === conditionValue);

                row.classList.toggle('hidden', !shouldShow);

                if (shouldShow) {
                    matches += 1;
                }
            });

            if (visibleCount) {
                visibleCount.textContent = matches;
            }

            emptyState?.classList.toggle(
                'hidden',
                matches !== 0,
            );
        };

        refreshInventoryState = ({
            decrementTotal = false,
        } = {}) => {
            applyInventoryFilters();
            updateInventoryPagination(decrementTotal);
        };

        searchInput?.addEventListener(
            'input',
            applyInventoryFilters,
        );

        categoryFilter?.addEventListener(
            'change',
            applyInventoryFilters,
        );

        statusFilter?.addEventListener(
            'change',
            applyInventoryFilters,
        );

        conditionFilter?.addEventListener(
            'change',
            applyInventoryFilters,
        );

        clearFiltersButton?.addEventListener('click', () => {
            if (searchInput) {
                searchInput.value = '';
            }

            if (categoryFilter) {
                categoryFilter.value = '';
            }

            if (statusFilter) {
                statusFilter.value = '';
            }

            if (conditionFilter) {
                conditionFilter.value = '';
            }

            applyInventoryFilters();
        });

        refreshInventoryState();
    }

    // Asset action menus

    const actionButtons = document.querySelectorAll(
        '[data-asset-menu-button]',
    );

    const actionMenus = document.querySelectorAll(
        '[data-asset-menu]',
    );

    const closeAllAssetMenus = () => {
        actionMenus.forEach((menu) => {
            menu.classList.add('hidden');

            menu.style.removeProperty('top');
            menu.style.removeProperty('left');
        });

        actionButtons.forEach((button) => {
            button.setAttribute('aria-expanded', 'false');
        });
    };

    const positionAssetMenu = (button, menu) => {
        const viewportPadding = 12;
        const menuGap = 8;

        if (menu.parentElement !== document.body) {
            document.body.appendChild(menu);
        }

        menu.classList.remove('hidden');

        menu.style.visibility = 'hidden';
        menu.style.top = '0px';
        menu.style.left = '0px';

        const buttonRect = button.getBoundingClientRect();
        const menuRect = menu.getBoundingClientRect();

        let left = buttonRect.right - menuRect.width;

        left = Math.max(
            viewportPadding,
            Math.min(
                left,
                window.innerWidth -
                    menuRect.width -
                    viewportPadding,
            ),
        );

        let top = buttonRect.bottom + menuGap;

        if (
            top + menuRect.height >
            window.innerHeight - viewportPadding
        ) {
            top = buttonRect.top - menuRect.height - menuGap;
        }

        top = Math.max(viewportPadding, top);

        menu.style.left = `${left}px`;
        menu.style.top = `${top}px`;

        menu.style.removeProperty('visibility');
    };

    actionButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();

            const targetMenu = document.getElementById(
                button.dataset.assetMenuButton,
            );

            const isOpen =
                targetMenu &&
                !targetMenu.classList.contains('hidden');

            closeAllAssetMenus();

            if (targetMenu && !isOpen) {
                positionAssetMenu(button, targetMenu);

                button.setAttribute('aria-expanded', 'true');

                focusable(targetMenu)[0]?.focus();
            }
        });
    });

    actionMenus.forEach((menu) => {
        menu.addEventListener('keydown', (event) => {
            if (
                event.key !== 'Escape' &&
                event.key !== 'Tab'
            ) {
                return;
            }

            const items = focusable(menu);

            if (
                event.key === 'Tab' &&
                !(
                    (event.shiftKey &&
                        document.activeElement === items[0]) ||
                    (!event.shiftKey &&
                        document.activeElement === items.at(-1))
                )
            ) {
                return;
            }

            event.preventDefault();

            const triggers = Array.from(actionButtons).filter(
                (button) =>
                    button.isConnected &&
                    button.getClientRects().length,
            );

            const index = triggers.findIndex(
                (button) =>
                    button.dataset.assetMenuButton === menu.id,
            );

            closeAllAssetMenus();

            const target =
                event.key === 'Tab' && !event.shiftKey
                    ? (
                        triggers[index + 1] ??
                        document.getElementById('inventory-search')
                    )
                    : triggers[index];

            target?.focus();
        });
    });

    document.addEventListener('click', (event) => {
        if (
            !event.target.closest('[data-asset-menu]') &&
            !event.target.closest('[data-asset-menu-button]')
        ) {
            closeAllAssetMenus();
        }
    });

    window.addEventListener(
        'scroll',
        closeAllAssetMenus,
        true,
    );

    window.addEventListener(
        'resize',
        closeAllAssetMenus,
    );

    // Asset archive preview

    const archiveModal = document.getElementById(
        'archive-asset-modal',
    );

    const archiveModalPanel = archiveModal?.querySelector(
        '[data-modal-panel]',
    );

    const archiveAssetName = document.getElementById(
        'archive-asset-name',
    );

    const cancelArchiveButton = document.getElementById(
        'cancel-archive-asset',
    );

    const confirmArchiveButton = document.getElementById(
        'confirm-archive-asset',
    );

    let pendingArchiveRow = null;
    let archiveTriggerButton = null;
    let archiveCloseTimer = null;
    let archiveFrame;
    let archiveClosing = false;
    let archiveBackground = [];
    let archiveHadScrollLock = false;

    const openArchiveModal = (button) => {
        if (!archiveModal || archiveClosing) {
            return;
        }

        pendingArchiveRow = document.getElementById(
            button.dataset.assetRow ?? '',
        );

        if (!pendingArchiveRow) {
            return;
        }

        archiveTriggerButton = pendingArchiveRow.querySelector(
            '[data-asset-menu-button]',
        );

        closeAllAssetMenus();

        archiveAssetName.textContent =
            button.dataset.assetName ?? 'Asset';

        // Isolate the overlay without changing its appearance.
        document.body.appendChild(archiveModal);

        archiveBackground = Array.from(body.children)
            .filter((element) => element !== archiveModal)
            .map((element) => [element, element.inert]);

        archiveBackground.forEach(([element]) => {
            element.inert = true;
        });

        archiveHadScrollLock = body.classList.contains(
            'overflow-hidden',
        );

        confirmArchiveButton.disabled = false;

        archiveModal.classList.remove('hidden');
        body.classList.add('overflow-hidden');

        archiveFrame = requestAnimationFrame(() => {
            archiveModal.classList.replace(
                'opacity-0',
                'opacity-100',
            );

            archiveModalPanel?.classList.remove(
                'scale-95',
                'opacity-0',
            );

            archiveModalPanel?.classList.add(
                'scale-100',
                'opacity-100',
            );

            cancelArchiveButton?.focus();
        });
    };

    const closeArchiveModal = ({
        restoreFocus = true,
    } = {}) => {
        if (
            !archiveModal ||
            archiveClosing ||
            archiveModal.classList.contains('hidden')
        ) {
            return;
        }

        archiveClosing = true;

        cancelAnimationFrame(archiveFrame);

        confirmArchiveButton.disabled = true;

        archiveModal.classList.replace(
            'opacity-100',
            'opacity-0',
        );

        archiveModalPanel?.classList.remove(
            'scale-100',
            'opacity-100',
        );

        archiveModalPanel?.classList.add(
            'scale-95',
            'opacity-0',
        );

        clearTimeout(archiveCloseTimer);

        archiveCloseTimer = setTimeout(() => {
            archiveModal.classList.add('hidden');

            archiveBackground.forEach(([element, inert]) => {
                element.inert = inert;
            });

            body.classList.toggle(
                'overflow-hidden',
                archiveHadScrollLock || sidebarOpen,
            );

            if (sidebar) {
                sidebar.inert = !isDesktop() && !sidebarOpen;
            }

            if (appMain) {
                appMain.inert = sidebarOpen;
            }

            const target =
                restoreFocus && archiveTriggerButton?.isConnected
                    ? archiveTriggerButton
                    : document.getElementById('inventory-search');

            target?.focus();

            pendingArchiveRow = null;
            archiveTriggerButton = null;
            archiveClosing = false;
        }, 150);
    };

    document
        .querySelectorAll('[data-archive-asset]')
        .forEach((button) => {
            button.addEventListener('click', () => {
                openArchiveModal(button);
            });
        });

    cancelArchiveButton?.addEventListener('click', () => {
        closeArchiveModal();
    });

    archiveModal?.addEventListener('click', (event) => {
        if (event.target === archiveModal) {
            closeArchiveModal();
        }
    });

    archiveModal?.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            event.preventDefault();
            closeArchiveModal();
        } else {
            trapFocus(event, archiveModal);
        }
    });

    confirmArchiveButton?.addEventListener('click', () => {
        if (
            archiveClosing ||
            !pendingArchiveRow?.isConnected
        ) {
            return;
        }

        const menuId = pendingArchiveRow
            .querySelector('[data-asset-menu-button]')
            ?.dataset.assetMenuButton;

        document.getElementById(menuId)?.remove();

        pendingArchiveRow.remove();
        pendingArchiveRow = null;

        refreshInventoryState({
            decrementTotal: true,
        });

        closeArchiveModal({
            restoreFocus: false,
        });

        showToast(
            'Asset hidden from this preview. Refresh to restore it. No records were saved.',
        );
    });

    // Shared form validation

    const validateRequiredText = (form) => {
        form
            .querySelectorAll(
                'input[type="text"][required], textarea[required]',
            )
            .forEach((input) => {
                input.setCustomValidity(
                    input.value.trim()
                        ? ''
                        : 'Please enter a value.',
                );
            });

        const invalidField = Array.from(form.elements).find(
            (field) =>
                field.willValidate &&
                !field.validity.valid,
        );

        if (!invalidField) {
            return true;
        }

        const label = invalidField.labels?.[0]?.textContent
            .replace(/\*/g, '')
            .replace(/\s+/g, ' ')
            .trim();

        const message =
            invalidField.validationMessage ||
            'Please check this field.';

        invalidField.setAttribute('aria-invalid', 'true');
        invalidField.focus();

        // Also show a visible notification if the browser popup is absent.
        showToast(
            label ? `${label}: ${message}` : message,
            'error',
        );

        form.reportValidity();

        return false;
    };

    const clearTextError = (event) => {
        const input = event.target;

        if (!(input instanceof Element)) {
            return;
        }

        if (input.matches('input[type="text"], textarea')) {
            input.setCustomValidity('');
        }

        if (input.matches('input, select, textarea')) {
            input.removeAttribute('aria-invalid');
        }
    };

    // Asset form

    const assetForm = document.getElementById('asset-form');

    if (assetForm) {
        // Custom checks run first; reportValidity still checks native rules.
        assetForm.noValidate = true;
    }

    assetForm?.addEventListener(
        'input',
        clearTextError,
    );

    assetForm?.addEventListener(
        'change',
        clearTextError,
    );

    assetForm?.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!validateRequiredText(assetForm)) {
            return;
        }

        showToast(
            'Asset form validated. Preview only; no asset was added or updated.',
        );
    });

    // Asset photo preview

    const photoInput = document.getElementById('asset-photo');

    const photoPreview = document.getElementById(
        'asset-photo-preview',
    );

    const photoPlaceholder = document.getElementById(
        'asset-photo-placeholder',
    );

    let photoVersion = 0;

    const resetPhoto = () => {
        photoVersion += 1;

        photoPreview?.removeAttribute('src');
        photoPreview?.classList.add('hidden');

        photoPlaceholder?.classList.remove('hidden');
    };

    photoInput?.addEventListener('change', () => {
        resetPhoto();

        const file = photoInput.files?.[0];

        if (!file || !photoPreview) {
            return;
        }

        const version = photoVersion;

        const fail = () => {
            if (version !== photoVersion) {
                return;
            }

            photoInput.value = '';
            resetPhoto();

            showToast(
                'Choose a valid JPG, PNG, or WEBP image.',
                'error',
            );
        };

        if (
            ![
                'image/jpeg',
                'image/png',
                'image/webp',
            ].includes(file.type)
        ) {
            fail();
            return;
        }

        const reader = new FileReader();

        reader.onerror = fail;

        reader.onload = () => {
            if (version !== photoVersion) {
                return;
            }

            const candidate = new Image();

            candidate.onerror = fail;

            candidate.onload = () => {
                if (version !== photoVersion) {
                    return;
                }

                photoPreview.src = reader.result;
                photoPreview.classList.remove('hidden');

                photoPlaceholder?.classList.add('hidden');
            };

            candidate.src = reader.result;
        };

        reader.readAsDataURL(file);
    });

    assetForm?.addEventListener('reset', resetPhoto);

    // Logistics request filters

    const requestTable = document.getElementById(
        'requests-table',
    );

    if (requestTable) {
        const requestSearch = document.getElementById(
            'request-search',
        );

        const committeeFilter = document.getElementById(
            'request-committee-filter',
        );

        const statusFilter = document.getElementById(
            'request-status-filter',
        );

        const dateFilter = document.getElementById(
            'request-date-filter',
        );

        const clearButton = document.getElementById(
            'clear-request-filters',
        );

        const rows = Array.from(
            requestTable.querySelectorAll(
                '[data-request-row]',
            ),
        );

        const visibleCount = document.getElementById(
            'request-visible-count',
        );

        const emptyState = document.getElementById(
            'request-empty-state',
        );

        const applyRequestFilters = () => {
            const searchValue =
                requestSearch?.value.trim().toLowerCase() ?? '';

            const committee = committeeFilter?.value ?? '';
            const status = statusFilter?.value ?? '';
            const date = dateFilter?.value ?? '';

            let count = 0;

            rows.forEach((row) => {
                const searchMatches =
                    !searchValue ||
                    (
                        row.dataset.search?.toLowerCase() ?? ''
                    ).includes(searchValue);

                const committeeMatches =
                    !committee ||
                    row.dataset.committee === committee;

                const statusMatches =
                    !status ||
                    row.dataset.status === status;

                const dateMatches =
                    !date ||
                    row.dataset.date === date;

                const matches =
                    searchMatches &&
                    committeeMatches &&
                    statusMatches &&
                    dateMatches;

                row.classList.toggle('hidden', !matches);

                if (matches) {
                    count += 1;
                }
            });

            if (visibleCount) {
                visibleCount.textContent = count;
            }

            emptyState?.classList.toggle(
                'hidden',
                count !== 0,
            );
        };

        requestSearch?.addEventListener(
            'input',
            applyRequestFilters,
        );

        committeeFilter?.addEventListener(
            'change',
            applyRequestFilters,
        );

        statusFilter?.addEventListener(
            'change',
            applyRequestFilters,
        );

        dateFilter?.addEventListener(
            'change',
            applyRequestFilters,
        );

        clearButton?.addEventListener('click', () => {
            if (requestSearch) {
                requestSearch.value = '';
            }

            if (committeeFilter) {
                committeeFilter.value = '';
            }

            if (statusFilter) {
                statusFilter.value = '';
            }

            if (dateFilter) {
                dateFilter.value = '';
            }

            applyRequestFilters();
        });

        applyRequestFilters();
    }

    // Dynamic requested items

    const requestItemsContainer = document.getElementById(
        'request-items-container',
    );

    const requestItemTemplate = document.getElementById(
        'request-item-template',
    );

    const addRequestItemButton = document.getElementById(
        'add-request-item',
    );

    let requestItemNumber =
        requestItemsContainer?.querySelectorAll(
            '[data-request-item-row]',
        ).length ?? 1;

    const updateRemoveButtons = () => {
        const rows = Array.from(
            requestItemsContainer?.querySelectorAll(
                '[data-request-item-row]',
            ) ?? [],
        );

        rows.forEach((row) => {
            const button = row.querySelector(
                '[data-remove-request-item]',
            );

            if (!button) {
                return;
            }

            const isOnlyRow = rows.length === 1;

            button.disabled = isOnlyRow;

            button.setAttribute(
                'aria-disabled',
                String(isOnlyRow),
            );

            button.classList.toggle(
                'opacity-40',
                isOnlyRow,
            );
        });
    };

    const assignRequestItemFieldIds = (row, number) => {
        const resourceLabel = row.querySelector(
            '[data-resource-label]',
        );

        const resourceSelect = row.querySelector(
            '[data-resource-select]',
        );

        const quantityLabel = row.querySelector(
            '[data-quantity-label]',
        );

        const quantityInput = row.querySelector(
            '[data-quantity-input]',
        );

        const resourceId = `request-resource-${number}`;
        const quantityId = `request-quantity-${number}`;

        if (resourceSelect) {
            resourceSelect.id = resourceId;
        }

        if (resourceLabel) {
            resourceLabel.htmlFor = resourceId;
        }

        if (quantityInput) {
            quantityInput.id = quantityId;
        }

        if (quantityLabel) {
            quantityLabel.htmlFor = quantityId;
        }
    };

    const createRequestItemRow = () => {
        if (
            !requestItemsContainer ||
            !(requestItemTemplate instanceof HTMLTemplateElement)
        ) {
            return;
        }

        requestItemNumber += 1;

        const fragment =
            requestItemTemplate.content.cloneNode(true);

        const row = fragment.querySelector(
            '[data-request-item-row]',
        );

        if (!row) {
            return;
        }

        assignRequestItemFieldIds(
            row,
            requestItemNumber,
        );

        requestItemsContainer.appendChild(fragment);

        updateRemoveButtons();

        row.querySelector('[data-resource-select]')?.focus();
    };

    addRequestItemButton?.addEventListener(
        'click',
        createRequestItemRow,
    );

    requestItemsContainer?.addEventListener(
        'click',
        (event) => {
            const button = event.target.closest(
                '[data-remove-request-item]',
            );

            if (!button || button.disabled) {
                return;
            }

            const row = button.closest(
                '[data-request-item-row]',
            );

            row?.remove();

            updateRemoveButtons();

            addRequestItemButton?.focus();
        },
    );

    updateRemoveButtons();

    // Create request form

    const createRequestForm = document.getElementById(
        'create-request-form',
    );

    if (createRequestForm) {
        createRequestForm.noValidate = true;
    }

    createRequestForm?.addEventListener(
        'input',
        clearTextError,
    );

    createRequestForm?.addEventListener(
        'change',
        clearTextError,
    );

    createRequestForm?.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!validateRequiredText(createRequestForm)) {
            return;
        }

        showToast(
            'Request form validated. Preview only; no request was submitted or saved.',
        );
    });

    // Request workflow demo

    const workflowBadge = document.getElementById(
        'request-current-status',
    );

    const workflowLabel = document.getElementById(
        'request-status-heading',
    );

    const workflowActions = document.querySelectorAll(
        '[data-request-workflow-action]',
    );

    const workflowSteps = document.querySelectorAll(
        '[data-workflow-step]',
    );

    const statuses = [
        'Submitted',
        'Under Review',
        'Approved',
        'Preparing',
        'Ready',
        'Released',
        'Returned',
        'Completed',
    ];

    const statusStyles = {
        Submitted:
            'bg-[#D99120]/12 text-[#A76A12]',

        'Under Review':
            'bg-[#D99120]/12 text-[#A76A12]',

        Approved:
            'bg-[#05ADB6]/10 text-[#058D95]',

        Preparing:
            'bg-[#2878C8]/10 text-[#246AAE]',

        Ready:
            'bg-[#2878C8]/10 text-[#246AAE]',

        Released:
            'bg-[#2878C8]/10 text-[#246AAE]',

        Returned:
            'bg-[#168A72]/10 text-[#126E5B]',

        Completed:
            'bg-[#168A72]/10 text-[#126E5B]',

        Rejected:
            'bg-[#D64545]/10 text-[#B73737]',
    };

    const resetWorkflowStep = (step) => {
        const dot = step.querySelector(
            '[data-workflow-dot]',
        );

        const label = step.querySelector(
            '[data-workflow-label]',
        );

        dot?.classList.remove(
            'bg-[#05ADB6]',
            'border-[#05ADB6]',
            'text-white',
        );

        dot?.classList.add(
            'bg-white',
            'border-[#DDE3EA]',
            'text-[#98A2B3]',
        );

        label?.classList.remove('text-[#182230]');
        label?.classList.add('text-[#98A2B3]');
    };

    const renderWorkflow = (status) => {
        if (workflowBadge) {
            workflowBadge.className =
                `inline-flex min-h-[28px] items-center justify-center whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold leading-none ${statusStyles[status] ?? 'bg-[#F2F4F7] text-[#475467]'}`;

            workflowBadge.textContent = status;
        }

        if (workflowLabel) {
            workflowLabel.textContent = status;
        }

        if (status === 'Rejected') {
            workflowSteps.forEach((step) => {
                resetWorkflowStep(step);
            });

            return;
        }

        const currentIndex = statuses.indexOf(status);

        workflowSteps.forEach((step, index) => {
            resetWorkflowStep(step);

            const dot = step.querySelector(
                '[data-workflow-dot]',
            );

            const label = step.querySelector(
                '[data-workflow-label]',
            );

            const active = index <= currentIndex;

            if (active) {
                dot?.classList.remove(
                    'bg-white',
                    'border-[#DDE3EA]',
                    'text-[#98A2B3]',
                );

                dot?.classList.add(
                    'bg-[#05ADB6]',
                    'border-[#05ADB6]',
                    'text-white',
                );

                label?.classList.remove('text-[#98A2B3]');
                label?.classList.add('text-[#182230]');
            }
        });
    };

    workflowActions.forEach((button) => {
        button.addEventListener('click', () => {
            const nextStatus =
                button.dataset.requestWorkflowAction;

            renderWorkflow(nextStatus);

            showToast(
                `Request status changed to ${nextStatus}. Frontend demonstration only.`,
                nextStatus === 'Rejected'
                    ? 'error'
                    : 'success',
            );
        });
    });
};

if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        initializePulso,
        { once: true },
    );
} else {
    initializePulso();
}