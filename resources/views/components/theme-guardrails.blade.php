<style id="pulso-theme-guardrails">
    /*
    |--------------------------------------------------------------------------
    | PULSO Workspace Visual Guardrails
    |--------------------------------------------------------------------------
    | Central visual layer para manatiling consistent ang neumorphism,
    | colors, cards, forms, tables, buttons, sidebar, at topbar.
    */

    body.hub-workspace {
        --hub-surface-raised:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, 0.96),
                rgba(230, 242, 248, 0.94)
            );

        --hub-surface-soft: #edf6fa;
        --hub-surface-inset: #e9f2f7;

        --hub-border-strong: rgba(255, 255, 255, 0.96);
        --hub-divider: #d5e5ee;

        --hub-copy: #496580;
        --hub-copy-soft: #688297;

        --hub-teal-dark: #007780;
        --hub-pink-dark: #b90c61;

        --hub-shadow-raised:
            7px 8px 18px rgba(101, 138, 163, 0.16),
            -6px -6px 15px rgba(255, 255, 255, 0.82),
            inset 1px 1px 2px rgba(255, 255, 255, 0.92);

        --hub-shadow-raised-soft:
            4px 5px 12px rgba(83, 119, 141, 0.12),
            -3px -3px 9px rgba(255, 255, 255, 0.82),
            inset 1px 1px 1px rgba(255, 255, 255, 0.9);

        --hub-shadow-inset:
            inset 3px 3px 7px rgba(93, 126, 148, 0.16),
            inset -3px -3px 7px rgba(255, 255, 255, 0.92);

        --hub-shadow-pressed:
            inset 3px 3px 7px rgba(63, 96, 118, 0.18),
            inset -2px -2px 5px rgba(255, 255, 255, 0.72);
    }


    /* ================================================================
       PAGE HEADINGS
       ================================================================ */

    .hub-workspace :is(
        .dash-heading,
        .inv-heading,
        .ad-heading,
        .asset-edit-heading,
        .asset-create-heading,
        .br-heading,
        .rq-heading,
        .rd-heading,
        .rc-heading,
        .px-heading,
        .ps-heading,
        .pc-heading,
        .pe-heading,
        .ds-heading,
        .rpt-heading,
        .pd-heading,
        .ar-heading,
        .ir-heading,
        .rr-heading
    ) h1 {
        color: var(--hub-navy);
        font-size: clamp(28px, 2.8vw, 38px);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.045em;
    }


    /* ================================================================
       TOPBAR CONTENT ALIGNMENT
       ================================================================ */

    .hub-workspace .pt-inner {
        width: 100%;
        max-width: 1496px;
        margin-inline: auto;
    }


    /* ================================================================
       ANCHOR OFFSET
       ================================================================ */

    .hub-workspace #donations {
        scroll-margin-top: 112px;
    }


    /* ================================================================
       EYEBROWS
       ================================================================ */

    .hub-workspace :is(
        .dash-eyebrow,
        .inv-eyebrow,
        .ad-eyebrow,
        .asset-edit-eyebrow,
        .asset-create-eyebrow,
        .br-eyebrow,
        .rq-eyebrow,
        .rd-eyebrow,
        .rc-eyebrow,
        .px-eyebrow,
        .ps-eyebrow,
        .pc-eyebrow,
        .pe-eyebrow,
        .ds-eyebrow,
        .rpt-eyebrow,
        .pd-eyebrow,
        .ar-eyebrow,
        .ir-eyebrow,
        .rr-eyebrow
    ) {
        color: var(--hub-teal-ink);
        font-weight: 800;
    }


    /* ================================================================
       PAGE DESCRIPTIONS
       ================================================================ */

    .hub-workspace :is(
        .dash-heading-description,
        .inv-heading-description,
        .asset-edit-description,
        .asset-create-description,
        .br-description,
        .rq-description,
        .rc-description,
        .px-description,
        .ps-description,
        .pc-description,
        .pe-description,
        .ds-description,
        .rpt-description,
        .pd-description,
        .ar-description,
        .ir-description,
        .rr-description
    ) {
        color: var(--hub-copy);
        line-height: 1.65;
    }


    /* ================================================================
       CORE NEUMORPHIC SURFACES
       ================================================================ */

    .hub-workspace :is(
        .dash-card:not(.dash-project-card),
        .dash-stat,
        .inv-summary,
        .ad-card,
        .br-card,
        .br-summary,
        .rq-summary,
        .rd-card,
        .rc-card,
        .ae-card,
        .px-stat,
        .px-panel,
        .ps-card,
        .ps-stat,
        .pc-card,
        .pe-card,
        .ds-card,
        .rpt-stat,
        .rpt-card,
        .pd-stat,
        .pd-card,
        .ar-summary,
        .ar-card,
        .ir-summary,
        .ir-card,
        .rr-summary,
        .rr-card
    ) {
        border-color: var(--hub-border-strong);
        background: var(--hub-surface-raised);
        box-shadow: var(--hub-shadow-raised);
    }


    /* ================================================================
       DASHBOARD PROJECT CARD
       ================================================================ */

    .hub-workspace .dash-project-card {
        border-color: var(--hub-border-strong);

        background:
            linear-gradient(
                145deg,
                rgba(237, 253, 253, 0.97),
                rgba(226, 242, 247, 0.96)
            );

        box-shadow: var(--hub-shadow-raised);
    }


    /* ================================================================
       SECTION DIVIDERS
       ================================================================ */

    .hub-workspace :is(
        .dash-card-head,
        .ad-card-heading,
        .br-card-heading,
        .rd-card-heading,
        .rc-card-heading,
        .ae-card-heading,
        .px-section-heading,
        .ps-card-heading,
        .pc-card-heading,
        .pe-card-heading,
        .ds-card-header,
        .rpt-section-heading,
        .pd-section-heading,
        .ar-section-heading,
        .ir-section-heading,
        .rr-section-heading,
        .br-section-heading
    ) {
        border-bottom-color: var(--hub-divider);
    }


    /* ================================================================
       SECONDARY BUTTONS
       ================================================================ */

    .hub-workspace :is(
        .ad-button,
        .br-button,
        .rd-button,
        .rc-button,
        .ds-button,
        .pd-button,
        .ar-button,
        .ir-button,
        .rr-button,
        .px-button,
        .ps-button,
        .pe-button,
        .pc-button,
        .inv-actions-button
    ):not([class*="primary"]):not([class*="danger"]) {
        border-color: var(--hub-border-strong);

        background:
            linear-gradient(
                145deg,
                #f6fbfe,
                #e6f1f6
            );

        color: #31546d;

        box-shadow: var(--hub-shadow-raised-soft);
    }


    .hub-workspace :is(
        .ad-button,
        .br-button,
        .rd-button,
        .rc-button,
        .ds-button,
        .pd-button,
        .ar-button,
        .ir-button,
        .rr-button,
        .px-button,
        .ps-button,
        .pe-button,
        .pc-button,
        .inv-actions-button
    ):not([class*="primary"]):not([class*="danger"]):hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #fbfdff,
                #dfedf3
            );

        color: var(--hub-teal-dark);

        transform: translateY(-1px);
    }


    .hub-workspace :is(
        .ad-button,
        .br-button,
        .rd-button,
        .rc-button,
        .ds-button,
        .pd-button,
        .ar-button,
        .ir-button,
        .rr-button,
        .px-button,
        .ps-button,
        .pe-button,
        .pc-button,
        .inv-actions-button
    ):not([class*="primary"]):not([class*="danger"]):active:not(:disabled) {
        transform: translateY(0);

        box-shadow: var(--hub-shadow-pressed);
    }


    /* ================================================================
       PRIMARY PULSO BUTTONS
       ================================================================ */

    .hub-workspace :is(
        .ad-button-primary,
        .br-button-primary,
        .rd-button-primary,
        .rc-button-primary,
        .pd-button-primary,
        .ar-button-primary,
        .ir-button-primary,
        .rr-button-primary,
        .px-button-primary,
        .ps-button-primary,
        .pe-button-primary,
        .pc-button-primary,
        .hub-button
    ) {
        border-color: #bff8fa;

        background:
            linear-gradient(
                145deg,
                #00858e,
                #00747f
            );

        color: #ffffff;

        box-shadow:
            4px 5px 11px rgba(0, 126, 139, 0.19),
            -3px -3px 8px rgba(255, 255, 255, 0.7),
            inset 1px 1px 3px rgba(125, 234, 240, 0.62);
    }


    .hub-workspace :is(
        .ad-button-primary,
        .br-button-primary,
        .rd-button-primary,
        .rc-button-primary,
        .pd-button-primary,
        .ar-button-primary,
        .ir-button-primary,
        .rr-button-primary,
        .px-button-primary,
        .ps-button-primary,
        .pe-button-primary,
        .pc-button-primary,
        .hub-button
    ):hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #007b85,
                #006b75
            );

        color: #ffffff;

        transform: translateY(-1px);
    }


    /* ================================================================
       FORM CONTROLS
       ================================================================ */

    .hub-workspace :is(
        .inv-input,
        .br-input,
        .rq-input,
        .rc-input,
        .ae-input,
        .ar-input,
        .px-input,
        .pe-input,
        .pc-input,
        input[type="text"],
        input[type="search"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select,
        textarea
    ) {
        border-color: #cfdfe8;

        background: var(--hub-surface-inset);

        color: var(--hub-navy);

        box-shadow: var(--hub-shadow-inset);
    }


    .hub-workspace :is(
        .inv-input,
        .br-input,
        .rq-input,
        .rc-input,
        .ae-input,
        .ar-input,
        .px-input,
        .pe-input,
        .pc-input,
        input[type="text"],
        input[type="search"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select,
        textarea
    ):focus {
        border-color: rgba(0, 126, 137, 0.5);

        background: #eef7fb;

        box-shadow:
            var(--hub-shadow-inset),
            0 0 0 3px rgba(5, 173, 182, 0.10);
    }


    .hub-workspace ::placeholder {
        color: #7890a4;
        opacity: 1;
    }


    /* ================================================================
       SEARCH / FILTER AREAS
       ================================================================ */

    .hub-workspace :is(
        .inv-filters,
        .br-filters,
        .rq-filters,
        .px-filters,
        .pd-filter-row,
        .ar-filter-area,
        .ar-filter-row,
        .ir-filter-row,
        .rr-filter-row,
        .br-filter-row,
        .pd-table-toolbar,
        .br-table-toolbar,
        .ir-table-toolbar,
        .rr-table-toolbar
    ) {
        border-color: rgba(255, 255, 255, 0.9);
    }


    /* ================================================================
       TABLES
       ================================================================ */

    .hub-workspace :is(
        .dash-table,
        .inv-table,
        .br-table,
        .rq-table,
        .rd-table,
        .px-table,
        .ps-table,
        .pd-table,
        .ar-table,
        .ir-table,
        .rr-table
    ) thead {
        background: rgba(225, 240, 247, 0.72);
    }


    .hub-workspace :is(
        .dash-table,
        .inv-table,
        .br-table,
        .rq-table,
        .rd-table,
        .px-table,
        .ps-table,
        .pd-table,
        .ar-table,
        .ir-table,
        .rr-table
    ) th {
        color: #4f6b82;
        font-weight: 750;
    }


    .hub-workspace :is(
        .dash-table,
        .inv-table,
        .br-table,
        .rq-table,
        .rd-table,
        .px-table,
        .ps-table,
        .pd-table,
        .ar-table,
        .ir-table,
        .rr-table
    ) tbody tr {
        transition:
            background-color 0.16s ease,
            box-shadow 0.16s ease;
    }


    .hub-workspace :is(
        .dash-table,
        .inv-table,
        .br-table,
        .rq-table,
        .rd-table,
        .px-table,
        .ps-table,
        .pd-table,
        .ar-table,
        .ir-table,
        .rr-table
    ) tbody tr:hover {
        background: rgba(255, 255, 255, 0.46);
    }


    /* ================================================================
       REPORT SHORTCUT CARDS
       ================================================================ */

    .hub-workspace .rpt-shortcut {
        border-color: var(--hub-border-strong);

        background:
            linear-gradient(
                145deg,
                #f5fbfe,
                #e5f0f5
            );

        box-shadow: var(--hub-shadow-raised-soft);
    }


    .hub-workspace .rpt-shortcut:hover {
        background:
            linear-gradient(
                145deg,
                #fbfdff,
                #deedf3
            );

        box-shadow:
            5px 7px 14px rgba(83, 119, 141, 0.15),
            -4px -4px 10px rgba(255, 255, 255, 0.88);

        transform: translateY(-2px);
    }


    .hub-workspace .rpt-shortcut:active {
        transform: translateY(0);

        box-shadow: var(--hub-shadow-pressed);
    }


    /* ================================================================
       SIDEBAR
       ================================================================ */

    .hub-workspace #app-sidebar {
        border-right-color: rgba(255, 255, 255, 0.9);

        box-shadow:
            8px 0 22px rgba(67, 103, 126, 0.10),
            inset -1px 0 0 rgba(255, 255, 255, 0.62);
    }


    .hub-workspace #app-sidebar .hub-sidebar-link.is-active {
        box-shadow:
            inset 3px 3px 7px rgba(74, 117, 137, 0.13),
            inset -3px -3px 7px rgba(255, 255, 255, 0.78);
    }


    /* ================================================================
       TOPBAR
       ================================================================ */

    .hub-workspace .pulso-topbar {
        box-shadow:
            0 7px 20px rgba(74, 110, 132, 0.09),
            inset 0 -1px 0 rgba(255, 255, 255, 0.72);
    }


    /* ================================================================
       MOBILE
       ================================================================ */

    @media (max-width: 639px) {
        .hub-workspace :is(
            .dash-card,
            .dash-stat,
            .inv-summary,
            .ad-card,
            .br-card,
            .br-summary,
            .rq-summary,
            .rd-card,
            .rc-card,
            .ae-card,
            .px-stat,
            .px-panel,
            .ps-card,
            .ps-stat,
            .pc-card,
            .pe-card,
            .ds-card,
            .rpt-stat,
            .rpt-card,
            .pd-stat,
            .pd-card,
            .ar-summary,
            .ar-card,
            .ir-summary,
            .ir-card,
            .rr-summary,
            .rr-card
        ) {
            box-shadow:
                5px 6px 14px rgba(101, 138, 163, 0.14),
                -4px -4px 11px rgba(255, 255, 255, 0.78),
                inset 1px 1px 2px rgba(255, 255, 255, 0.88);
        }
    }


    /* ================================================================
       ACCESSIBILITY
       ================================================================ */

    @media (prefers-reduced-motion: reduce) {
        .hub-workspace .rpt-shortcut:hover,

        .hub-workspace :is(
            .ad-button,
            .br-button,
            .rd-button,
            .rc-button,
            .ds-button,
            .pd-button,
            .ar-button,
            .ir-button,
            .rr-button,
            .px-button,
            .ps-button,
            .pe-button,
            .pc-button,
            .inv-actions-button
        ):hover {
            transform: none;
        }
    }
</style>