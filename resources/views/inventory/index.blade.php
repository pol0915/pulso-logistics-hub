@extends('layouts.app')

@section('title', 'Inventory & Assets | PULSO Logistics Hub')

@php
    $assetRows = [
        [
            'PULSO-AUD-001',
            'Portable Sound System',
            'Audio',
            'Equipment Shelf A',
            1,
            'Good',
            'Available',
            'Sep 08, 2026',
        ],
        [
            'PULSO-FUR-001',
            'Monoblock Chairs',
            'Furniture',
            'Main Storage',
            50,
            'Good',
            'Available',
            'Sep 08, 2026',
        ],
        [
            'PULSO-FUR-002',
            'Folding Tables',
            'Furniture',
            'Main Storage',
            10,
            'Good',
            'Deployed',
            'Sep 07, 2026',
        ],
        [
            'PULSO-EQP-001',
            'Projector',
            'Equipment',
            'Equipment Cabinet',
            1,
            'Excellent',
            'Borrowed',
            'Sep 07, 2026',
        ],
        [
            'PULSO-ELE-001',
            'Extension Cord 20m',
            'Electrical',
            'Electrical Cabinet',
            4,
            'Fair',
            'Available',
            'Sep 06, 2026',
        ],
        [
            'PULSO-AUD-002',
            'Wireless Microphone Set',
            'Audio',
            'Equipment Shelf A',
            2,
            'Good',
            'Available',
            'Sep 06, 2026',
        ],
        [
            'PULSO-EVT-001',
            'Large Event Tent',
            'Event Materials',
            'Main Storage',
            4,
            'Good',
            'Deployed',
            'Sep 05, 2026',
        ],
        [
            'PULSO-TOL-001',
            'Basic Tool Kit',
            'Tools',
            'Tool Cabinet',
            2,
            'Good',
            'Available',
            'Sep 04, 2026',
        ],
        [
            'PULSO-ELE-002',
            'Power Strip',
            'Electrical',
            'Electrical Cabinet',
            6,
            'Poor',
            'Maintenance',
            'Sep 03, 2026',
        ],
        [
            'PULSO-EVT-002',
            'PULSO Event Banner',
            'Event Materials',
            'Banner Storage',
            3,
            'Fair',
            'Available',
            'Sep 02, 2026',
        ],
        [
            'PULSO-AUD-003',
            'XLR Audio Cable',
            'Audio',
            'Equipment Shelf B',
            6,
            'Poor',
            'Damaged',
            'Sep 01, 2026',
        ],
        [
            'PULSO-STO-001',
            'Plastic Storage Bin',
            'Storage',
            'Main Storage',
            12,
            'Good',
            'Available',
            'Aug 30, 2026',
        ],
    ];

    $assets = array_map(
        fn ($row) => array_combine(
            [
                'id',
                'name',
                'category',
                'location',
                'quantity',
                'condition',
                'status',
                'updated',
            ],
            $row
        ),
        $assetRows
    );

    $summaries = [
        [
            'label' => 'Total Assets',
            'value' => 148,
            'description' => 'Registered resources',
            'tone' => 'navy',
            'icon' => 'inventory',
        ],
        [
            'label' => 'Available',
            'value' => 121,
            'description' => 'Ready for use',
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'label' => 'Borrowed',
            'value' => 9,
            'description' => 'Assets currently borrowed',
            'tone' => 'pink',
            'icon' => 'exchange',
        ],
        [
            'label' => 'Deployed',
            'value' => 12,
            'description' => 'Assigned to projects',
            'tone' => 'blue',
            'icon' => 'projects',
        ],
        [
            'label' => 'Maintenance',
            'value' => 3,
            'description' => 'Under servicing',
            'tone' => 'amber',
            'icon' => 'tools',
        ],
        [
            'label' => 'Damaged',
            'value' => 3,
            'description' => 'Needs assessment',
            'tone' => 'red',
            'icon' => 'alert',
        ],
    ];

    $statusTones = [
        'Available' => 'teal',
        'Borrowed' => 'pink',
        'Deployed' => 'blue',
        'Maintenance' => 'amber',
        'Damaged' => 'red',
    ];

    $conditionTones = [
        'Excellent' => 'teal',
        'Good' => 'navy',
        'Fair' => 'amber',
        'Poor' => 'red',
        'Damaged' => 'red',
    ];

    $categories = [
        'Audio',
        'Electrical',
        'Equipment',
        'Event Materials',
        'Furniture',
        'Storage',
        'Tools',
    ];
@endphp


@push('styles')
<style>
    .inventory-page {
        --inv-navy: #10263d;
        --inv-copy: #496580;
        --inv-muted: #688297;
        --inv-line: #d5e5ee;
        --inv-teal: #007780;
        --inv-pink: #b90c61;

        display: grid;
        gap: 20px;

        width: 100%;
        min-width: 0;

        color: var(--inv-navy);

        container-name: inventory-page;
        container-type: inline-size;
    }

    .inventory-page *,
    .inventory-page *::before,
    .inventory-page *::after {
        box-sizing: border-box;
    }

    .inventory-page [hidden] {
        display: none !important;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .inv-icon {
        display: block;

        width: 20px;
        height: 20px;

        flex-shrink: 0;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .inv-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .inv-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }

    .inv-heading-copy {
        min-width: 0;
    }

    .inv-eyebrow {
        margin: 0 0 7px;

        color: var(--inv-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .inv-heading h1 {
        margin: 0;

        color: var(--inv-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }

    .inv-heading-description {
        max-width: 680px;

        margin: 9px 0 0;

        color: var(--inv-copy);

        font-size: 14px;
        line-height: 1.7;
    }

    .inv-add {
        flex-shrink: 0;

        text-decoration: none;
    }


    /* ================================================================
       OVERVIEW
       ================================================================ */

    .inv-overview {
        display: grid;

        gap: 12px;
    }

    .inv-overview-caption {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        padding: 0 2px;
    }

    .inv-overview-title {
        display: flex;
        align-items: center;

        gap: 8px;

        color: #29475f;

        font-size: 11px;
        font-weight: 750;
    }

    .inv-overview-title::before {
        width: 7px;
        height: 7px;

        border-radius: 50%;

        background: #05adb6;

        box-shadow:
            0 0 0 4px rgba(5, 173, 182, .09);

        content: "";
    }

    .inv-overview-caption > span {
        color: var(--inv-muted);

        font-size: 10px;
    }


    /* ================================================================
       SUMMARY
       ================================================================ */

    .inv-summary-grid {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 12px;

        min-width: 0;
    }

    .inv-summary {
        --tone-ink: #173b59;
        --tone-fill: #e7eff6;

        position: relative;

        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;
        min-height: 104px;

        padding: 15px 13px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #f7fbfd 50%,
                #f0f7fa
            );

        box-shadow:
            4px 5px 10px rgba(78, 111, 132, .07),
            -4px -4px 9px rgba(255, 255, 255, .64),
            inset 1px 1px 2px rgba(255, 255, 255, .92);

        transition:
            transform 160ms ease,
            box-shadow 160ms ease;
    }

    .inv-summary::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 32px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--tone-ink);

        opacity: .5;

        content: "";
    }

    .inv-summary:hover {
        transform: translateY(-2px);

        box-shadow:
            7px 8px 15px rgba(78, 111, 132, .10),
            -4px -4px 9px rgba(255, 255, 255, .70),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .inv-summary-icon {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        flex: 0 0 40px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 13px;

        background: var(--tone-fill);

        color: var(--tone-ink);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }

    .inv-summary-icon .inv-icon {
        width: 17px;
        height: 17px;
    }

    .inv-summary-copy {
        min-width: 0;
    }

    .inv-summary-value {
        display: block;

        color: var(--tone-ink);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }

    .inv-summary-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .inv-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       TONES
       ================================================================ */

    .inv-tone-navy {
        --tone-ink: #173b59;
        --tone-fill: #e4eef7;
    }

    .inv-tone-teal {
        --tone-ink: #007780;
        --tone-fill: #d6f3f4;
    }

    .inv-tone-pink {
        --tone-ink: #b90c61;
        --tone-fill: #fbe0ef;
    }

    .inv-tone-blue {
        --tone-ink: #245b99;
        --tone-fill: #e0edfc;
    }

    .inv-tone-amber {
        --tone-ink: #895408;
        --tone-fill: #fff0d7;
    }

    .inv-tone-red {
        --tone-ink: #ad343d;
        --tone-fill: #fde5e8;
    }


    /* ================================================================
       REGISTER
       ================================================================ */

    .inv-register {
        min-width: 0;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 22px;

        background:
            linear-gradient(
                145deg,
                rgba(255, 255, 255, .88),
                rgba(233, 246, 252, .84)
            );

        box-shadow:
            6px 8px 20px rgba(101, 138, 163, .11),
            -4px -4px 14px rgba(255, 255, 255, .6),
            inset 1px 1px 1px #ffffff;
    }


    /* ================================================================
       REGISTER HEADER
       ================================================================ */

    .inv-register-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        padding: 20px 22px;

        border-bottom:
            1px
            solid
            var(--inv-line);
    }

    .inv-register-title {
        display: flex;
        align-items: center;

        gap: 12px;

        min-width: 0;
    }

    .inv-register-icon {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        flex: 0 0 40px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e4fbfc,
                #c9edf0
            );

        color: var(--inv-teal);

        box-shadow:
            3px 4px 8px rgba(70, 115, 136, .09),
            -3px -3px 7px rgba(255, 255, 255, .7);
    }

    .inv-register-heading h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }

    .inv-register-heading p {
        margin: 4px 0 0;

        color: var(--inv-copy);

        font-size: 11px;
    }

    .inv-register-heading p strong {
        color: var(--inv-teal);

        font-weight: 800;
    }


    /* ================================================================
       EXPORT
       ================================================================ */

    .inv-export {
        display: flex;
        align-items: center;

        gap: 9px;

        min-height: 40px;

        padding: 7px 11px;

        border:
            1px
            solid
            rgba(255, 255, 255, .86);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #edf4f7,
                #e3edf2
            );

        color: #8396a5;

        box-shadow:
            inset 2px 2px 5px rgba(87, 119, 140, .09),
            inset -2px -2px 5px rgba(255, 255, 255, .68);

        font: inherit;

        cursor: not-allowed;

        opacity: .8;
    }

    .inv-export .inv-icon {
        width: 17px;
        height: 17px;
    }

    .inv-export-copy {
        display: grid;

        gap: 1px;

        text-align: left;
    }

    .inv-export-copy strong {
        font-size: 11px;
        font-weight: 700;
    }

    .inv-export-copy small {
        font-size: 9px;
    }


    /* ================================================================
       FILTER AREA
       ================================================================ */

    .inv-filters {
        display: grid;

        /*
         * Desktop:
         * Search | Category | Status | Condition | Clear filters
         */
        grid-template-columns:
            minmax(220px, 1.55fr)
            minmax(130px, .8fr)
            minmax(130px, .8fr)
            minmax(130px, .8fr)
            auto;

        align-items: end;

        gap: 11px;

        padding: 16px 22px 18px;

        background:
            linear-gradient(
                180deg,
                rgba(233, 243, 248, .46),
                rgba(241, 248, 251, .18)
            );
    }

    .inv-field {
        min-width: 0;
    }

    .inv-field label {
        display: block;

        margin-bottom: 6px;

        color: #3c5a71;

        font-size: 9.5px;
        font-weight: 750;
    }

    .inv-search-wrap {
        position: relative;
    }

    .inv-search-wrap > .inv-icon {
        position: absolute;

        top: 50%;
        left: 13px;

        width: 17px;
        height: 17px;

        color: #678398;

        pointer-events: none;

        transform: translateY(-50%);
    }

    .inv-input {
        width: 100%;
        min-width: 0;
        height: 42px;

        padding: 8px 11px;

        border:
            1px
            solid
            #d0e1e9;

        border-radius: 12px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e8f1f6,
                #edf5f9
            );

        color: var(--inv-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .15),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 10.5px;

        transition:
            border-color 160ms ease,
            box-shadow 160ms ease,
            background 160ms ease;
    }

    select.inv-input {
        cursor: pointer;
    }

    .inv-search-wrap .inv-input {
        padding-left: 38px;
    }

    .inv-input::placeholder {
        color: #7b91a2;
    }

    .inv-input:focus {
        border-color:
            rgba(0, 126, 137, .48);

        background: #edf6fa;

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .09);
    }


    /* ================================================================
       CLEAR FILTERS
       ================================================================ */

    .inv-clear {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 42px;

        padding: 8px 12px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #f6fbfd,
                #e4eef4
            );

        color: #365970;

        box-shadow:
            4px 5px 10px rgba(80, 115, 137, .11),
            -3px -3px 8px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 10px;
        font-weight: 700;

        white-space: nowrap;

        cursor: pointer;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }

    .inv-clear:hover {
        color: var(--inv-teal);

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #dcecf2
            );

        transform: translateY(-1px);
    }

    .inv-clear:active {
        transform: none;
    }

    .inv-clear .inv-icon {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .inv-table-scroll {
        width: 100%;

        overflow-x: auto;

        border-top:
            1px
            solid
            var(--inv-line);

        border-bottom:
            1px
            solid
            var(--inv-line);

        background:
            rgba(240, 248, 251, .36);
    }

    .inv-table {
        width: 100%;
        min-width: 1160px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }

    .inv-table th {
        padding: 12px 14px;

        border-bottom:
            1px
            solid
            #cfdee7;

        background:
            rgba(225, 240, 247, .78);

        color: #516d82;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .inv-table th:first-child,
    .inv-table td:first-child {
        padding-left: 22px;
    }

    .inv-table th:last-child,
    .inv-table td:last-child {
        padding-right: 22px;
    }

    .inv-table td {
        padding: 13px 14px;

        border-bottom:
            1px
            solid
            rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 10px;
        line-height: 1.5;

        vertical-align: middle;
    }

    .inv-table tbody tr {
        transition:
            background-color 150ms ease;
    }

    .inv-table tbody tr:hover {
        background:
            rgba(255, 255, 255, .46);
    }

    .inv-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* ================================================================
       ASSET CELL
       ================================================================ */

    .inv-asset {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 220px;
    }

    .inv-asset-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e7fafa,
                #d1edf0
            );

        color: #007d86;

        box-shadow:
            3px 4px 8px rgba(76, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .78);
    }

    .inv-asset-icon .inv-icon {
        width: 17px;
        height: 17px;
    }

    .inv-asset-copy {
        min-width: 0;
    }

    .inv-asset-name {
        display: block;

        color: var(--inv-navy);

        font-size: 10.5px;
        font-weight: 750;
        line-height: 1.4;

        text-decoration: none;
    }

    a.inv-asset-name:hover {
        color: var(--inv-teal);
    }

    .inv-asset-id {
        display: block;

        margin-top: 3px;

        color: #70879a;

        font-size: 8.5px;
        font-weight: 550;

        letter-spacing: .025em;
    }


    /* ================================================================
       QUANTITY
       ================================================================ */

    .inv-table .inv-quantity {
        color: var(--inv-navy);

        font-weight: 750;

        text-align: center;

        font-variant-numeric: tabular-nums;
    }


    /* ================================================================
       CONDITION
       ================================================================ */

    .inv-condition {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        color: var(--tone-ink);

        font-size: 9.5px;
        font-weight: 650;

        white-space: nowrap;
    }

    .inv-condition::before {
        width: 6px;
        height: 6px;

        flex-shrink: 0;

        border-radius: 50%;

        background: var(--tone-ink);

        opacity: .75;

        content: "";
    }


    /* ================================================================
       STATUS
       ================================================================ */

    .inv-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 26px;

        padding: 4px 8px;

        border:
            1px
            solid
            rgba(255, 255, 255, .7);

        border-radius: 8px;

        background: var(--tone-fill);

        color: var(--tone-ink);

        font-size: 8.5px;
        font-weight: 800;

        white-space: nowrap;
    }

    .inv-updated {
        color: #60798d;

        font-size: 9px;

        white-space: nowrap;
    }


    /* ================================================================
       ACTIONS
       ================================================================ */

    .inv-action-heading,
    .inv-action-cell {
        min-width: 150px;

        text-align: center;
    }

    .inv-action-group {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;
    }

    .inv-action-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: 35px;
        height: 35px;

        flex: 0 0 35px;

        margin: 0;
        padding: 0;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #f6fbfd,
                #e4eef4
            );

        color: #496b81;

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76);

        font: inherit;

        text-decoration: none;

        cursor: pointer;

        transition:
            color 150ms ease,
            background 150ms ease,
            border-color 150ms ease,
            box-shadow 150ms ease,
            transform 150ms ease;
    }

    .inv-action-icon .inv-icon {
        width: 16px;
        height: 16px;
    }

    .inv-action-view {
        color: var(--inv-teal);
    }

    .inv-action-view:hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #e7fbfc,
                #d1eef0
            );

        color: #00646c;

        transform: translateY(-1px);
    }

    .inv-action-edit {
        color: #365f8d;
    }

    .inv-action-edit:hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #eef5fc,
                #dae8f4
            );

        color: #28517f;

        transform: translateY(-1px);
    }

    .inv-action-archive {
        color: #b43d49;

        background:
            linear-gradient(
                145deg,
                #fff3f5,
                #f6dfe3
            );
    }

    .inv-action-archive:hover {
        background:
            linear-gradient(
                145deg,
                #ffe8ec,
                #f2ccd3
            );

        color: #9c2d39;

        transform: translateY(-1px);
    }

    .inv-action-icon:disabled,
    .inv-action-icon.is-disabled {
        color: #9baab5;

        background:
            linear-gradient(
                145deg,
                #edf3f6,
                #e2ebf0
            );

        box-shadow:
            inset 2px 2px 5px rgba(83, 114, 134, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .64);

        cursor: not-allowed;

        opacity: .58;

        transform: none;
    }


    /* ================================================================
       EMPTY
       ================================================================ */

    .inv-empty {
        padding: 48px 22px;

        text-align: center;
    }

    .inv-empty-icon {
        display: grid;
        place-items: center;

        width: 54px;
        height: 54px;

        margin: 0 auto 13px;

        border:
            1px
            solid
            rgba(255, 255, 255, .95);

        border-radius: 17px;

        background:
            linear-gradient(
                145deg,
                #edf7fa,
                #dfeef4
            );

        color: #68849a;
    }

    .inv-empty h3 {
        margin: 0;

        color: #29475f;

        font-size: 14px;
        font-weight: 750;
    }

    .inv-empty p {
        margin: 6px 0 0;

        color: var(--inv-muted);

        font-size: 10px;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .inv-register-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 10px 20px;

        padding: 14px 22px;

        color: var(--inv-muted);

        font-size: 9.5px;
    }

    .inv-register-footer p {
        margin: 0;
    }

    .inv-register-footer strong {
        color: #29475f;
    }

    .inv-footer-right {
        display: flex;
        align-items: center;

        gap: 11px;
    }

    .inv-pagination-note {
        color: #748c9e;
    }

    .inv-preview-tag {
        display: inline-flex;
        align-items: center;

        min-height: 27px;

        padding: 5px 9px;

        border:
            1px
            solid
            rgba(255, 255, 255, .75);

        border-radius: 9px;

        background:
            linear-gradient(
                145deg,
                #e3f6f7,
                #d3edef
            );

        color: var(--inv-teal);

        font-size: 9px;
        font-weight: 700;
    }


    /* ================================================================
       ARCHIVE MODAL
       ================================================================ */

    .inv-archive-panel {
        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        background:
            linear-gradient(
                145deg,
                #f7fcfe,
                #e4eff4
            );

        color: var(--inv-navy);

        box-shadow:
            12px 16px 36px rgba(38, 66, 84, .25),
            -5px -5px 15px rgba(255, 255, 255, .7),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }

    .inv-archive-panel h2 {
        color: var(--inv-navy);
    }

    .inv-archive-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 44px;

        padding: 10px 17px;

        border:
            1px
            solid
            rgba(255, 255, 255, .5);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #bd4651,
                #a2323d
            );

        color: #ffffff;

        font: inherit;
        font-size: 11px;
        font-weight: 700;

        cursor: pointer;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    /*
     * Keep the complete filter bar in one row for normal desktop
     * workspace widths. Only start wrapping when the content area
     * actually becomes narrow.
     */
    @container inventory-page (max-width: 860px) {
        .inv-filters {
            grid-template-columns:
                minmax(220px, 1.5fr)
                repeat(
                    2,
                    minmax(125px, 1fr)
                );
        }

        .inv-search-field {
            grid-column: span 2;
        }

        .inv-clear {
            width: 100%;
        }
    }


    @container inventory-page (max-width: 900px) {
        .inv-summary-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }
    }


    @container inventory-page (max-width: 700px) {
        .inv-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }

        .inv-summary-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .inv-register-heading {
            align-items: flex-start;

            padding: 19px 18px 16px;
        }

        .inv-filters {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            padding: 16px 18px 18px;
        }

        .inv-search-field {
            grid-column: 1 / -1;
        }

        .inv-clear {
            width: 100%;
        }

        .inv-register-footer {
            padding: 14px 18px;
        }
    }


    @container inventory-page (max-width: 560px) {
        .inv-register {
            border-radius: 19px;
        }

        .inv-register-heading {
            flex-direction: column;

            gap: 13px;
        }

        .inv-export {
            width: 100%;
        }

        .inv-filters {
            grid-template-columns:
                minmax(0, 1fr);

            gap: 11px;
        }

        .inv-search-field {
            grid-column: auto;
        }

        .inv-footer-right {
            width: 100%;

            justify-content: space-between;
        }
    }


    @container inventory-page (max-width: 480px) {
        .inv-summary-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .inv-summary,
        .inv-clear,
        .inv-action-icon,
        .inv-archive-danger {
            transition: none;
        }
    }
</style>
@endpush


@section('content')
<div
    class="inventory-page"
    id="inventory-page"
>

    <svg
        class="inv-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol
            id="inv-icon-inventory"
            viewBox="0 0 24 24"
        >
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol
            id="inv-icon-check"
            viewBox="0 0 24 24"
        >
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol
            id="inv-icon-exchange"
            viewBox="0 0 24 24"
        >
            <path d="M4 7h15"/>
            <path d="m15 3 4 4-4 4"/>
            <path d="M20 17H5"/>
            <path d="m9 13-4 4 4 4"/>
        </symbol>

        <symbol
            id="inv-icon-projects"
            viewBox="0 0 24 24"
        >
            <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
            <path d="M12 11v6"/>
            <path d="M9 14h6"/>
        </symbol>

        <symbol
            id="inv-icon-tools"
            viewBox="0 0 24 24"
        >
            <path d="M14.7 6.3a4 4 0 0 0-5-5L7 4l3 3-6.7 6.7a2.1 2.1 0 0 0 3 3L13 10a4 4 0 0 0 5-5Z"/>
            <path d="m13 13 6 6"/>
        </symbol>

        <symbol
            id="inv-icon-alert"
            viewBox="0 0 24 24"
        >
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol
            id="inv-icon-search"
            viewBox="0 0 24 24"
        >
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
        </symbol>

        <symbol
            id="inv-icon-plus"
            viewBox="0 0 24 24"
        >
            <path d="M12 5v14"/>
            <path d="M5 12h14"/>
        </symbol>

        <symbol
            id="inv-icon-filter-off"
            viewBox="0 0 24 24"
        >
            <path d="M4 5h16"/>
            <path d="M7 12h10"/>
            <path d="M10 19h4"/>
            <path d="m5 5 14 14"/>
        </symbol>

        <symbol
            id="inv-icon-export"
            viewBox="0 0 24 24"
        >
            <path d="M12 3v12"/>
            <path d="m7 8 5-5 5 5"/>
            <path d="M5 21h14"/>
            <path d="M5 17v4"/>
            <path d="M19 17v4"/>
        </symbol>

        <symbol
            id="inv-icon-empty"
            viewBox="0 0 24 24"
        >
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M8 16h8"/>
        </symbol>

        <symbol
            id="inv-icon-eye"
            viewBox="0 0 24 24"
        >
            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
            <circle cx="12" cy="12" r="2.5"/>
        </symbol>

        <symbol
            id="inv-icon-pen"
            viewBox="0 0 24 24"
        >
            <path d="M12 20h9"/>
            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"/>
        </symbol>

        <symbol
            id="inv-icon-trash"
            viewBox="0 0 24 24"
        >
            <path d="M3 6h18"/>
            <path d="M8 6V4h8v2"/>
            <path d="m19 6-1 14H6L5 6"/>
            <path d="M10 10v6"/>
            <path d="M14 10v6"/>
        </symbol>
    </svg>


    <header class="inv-heading">

        <div class="inv-heading-copy">

            <p class="inv-eyebrow">
                Resource management
            </p>

            <h1>
                Inventory &amp; Assets
            </h1>

            <p class="inv-heading-description">
                Track reusable equipment, monitor availability and
                condition, and keep logistics resources organized.
            </p>

        </div>


        <a
            class="hub-button inv-add"
            href="{{ route('inventory.create') }}"
        >
            <svg
                class="inv-icon"
                aria-hidden="true"
            >
                <use href="#inv-icon-plus"/>
            </svg>

            <span>
                Add asset
            </span>
        </a>

    </header>


    <section
        class="inv-overview"
        aria-label="Organization inventory overview"
    >

        <div class="inv-overview-caption">

            <div class="inv-overview-title">
                Organization overview
            </div>

            <span>
                Sample snapshot · September 2026
            </span>

        </div>


        <div class="inv-summary-grid">

            @foreach ($summaries as $summary)

                <article
                    class="
                        inv-summary
                        inv-tone-{{ $summary['tone'] }}
                    "
                >

                    <span
                        class="inv-summary-icon"
                        aria-hidden="true"
                    >
                        <svg class="inv-icon">
                            <use href="#inv-icon-{{ $summary['icon'] }}"/>
                        </svg>
                    </span>


                    <div class="inv-summary-copy">

                        <strong class="inv-summary-value">
                            {{ number_format($summary['value']) }}
                        </strong>

                        <span class="inv-summary-label">
                            {{ $summary['label'] }}
                        </span>

                        <span class="inv-summary-description">
                            {{ $summary['description'] }}
                        </span>

                    </div>

                </article>

            @endforeach

        </div>

    </section>


    <section
        class="inv-register"
        aria-labelledby="inventory-register-title"
    >

        <header class="inv-register-heading">

            <div class="inv-register-title">

                <span
                    class="inv-register-icon"
                    aria-hidden="true"
                >
                    <svg class="inv-icon">
                        <use href="#inv-icon-inventory"/>
                    </svg>
                </span>


                <div>

                    <h2 id="inventory-register-title">
                        Asset Register
                    </h2>

                    <p
                        role="status"
                        aria-live="polite"
                    >
                        <strong id="inventory-visible-count">
                            {{ count($assets) }}
                        </strong>

                        matching sample records
                    </p>

                </div>

            </div>


            <button
                class="inv-export"
                type="button"
                disabled
            >
                <svg
                    class="inv-icon"
                    aria-hidden="true"
                >
                    <use href="#inv-icon-export"/>
                </svg>

                <span class="inv-export-copy">
                    <strong>Export</strong>
                    <small>Coming soon</small>
                </span>
            </button>

        </header>


        <div
            class="inv-filters"
            role="search"
            aria-label="Search and filter assets"
        >

            <div class="inv-field inv-search-field">

                <label for="inventory-search">
                    Search assets
                </label>

                <div class="inv-search-wrap">

                    <svg
                        class="inv-icon"
                        aria-hidden="true"
                    >
                        <use href="#inv-icon-search"/>
                    </svg>

                    <input
                        class="inv-input"
                        id="inventory-search"
                        type="search"
                        placeholder="Name, asset ID, or location"
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="inv-field">

                <label for="inventory-category-filter">
                    Category
                </label>

                <select
                    class="inv-input"
                    id="inventory-category-filter"
                >
                    <option value="">
                        All categories
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category }}">
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

            </div>


            <div class="inv-field">

                <label for="inventory-status-filter">
                    Status
                </label>

                <select
                    class="inv-input"
                    id="inventory-status-filter"
                >
                    <option value="">
                        All statuses
                    </option>

                    @foreach (array_keys($statusTones) as $status)
                        <option value="{{ $status }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

            </div>


            <div class="inv-field">

                <label for="inventory-condition-filter">
                    Condition
                </label>

                <select
                    class="inv-input"
                    id="inventory-condition-filter"
                >
                    <option value="">
                        All conditions
                    </option>

                    @foreach (array_keys($conditionTones) as $condition)
                        <option value="{{ $condition }}">
                            {{ $condition }}
                        </option>
                    @endforeach
                </select>

            </div>


            <button
                class="inv-clear"
                id="clear-inventory-filters"
                type="button"
            >
                <svg
                    class="inv-icon"
                    aria-hidden="true"
                >
                    <use href="#inv-icon-filter-off"/>
                </svg>

                Clear filters
            </button>

        </div>


        <div
            class="inv-table-scroll custom-scrollbar"
            id="inventory-table-wrap"
            role="region"
            aria-label="Asset table"
            tabindex="0"
        >

            <table
                class="inv-table"
                id="inventory-table"
            >

                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Category</th>
                        <th>Location</th>

                        <th class="inv-quantity">
                            Qty
                        </th>

                        <th>Condition</th>
                        <th>Status</th>
                        <th>Updated</th>

                        <th class="inv-action-heading">
                            Action
                        </th>
                    </tr>
                </thead>


                <tbody>

                    @foreach ($assets as $index => $asset)

                        @php
                            $hasDetailPreview =
                                $asset['id'] ===
                                'PULSO-AUD-001';
                        @endphp


                        <tr
                            id="inventory-row-{{ $index }}"
                            data-inventory-row
                            data-search="{{ $asset['id'] }} {{ $asset['name'] }} {{ $asset['category'] }} {{ $asset['location'] }}"
                            data-category="{{ $asset['category'] }}"
                            data-status="{{ $asset['status'] }}"
                            data-condition="{{ $asset['condition'] }}"
                            data-archived="false"
                        >

                            <td>

                                <div class="inv-asset">

                                    <span
                                        class="inv-asset-icon"
                                        aria-hidden="true"
                                    >
                                        <svg class="inv-icon">
                                            <use href="#inv-icon-inventory"/>
                                        </svg>
                                    </span>


                                    <div class="inv-asset-copy">

                                        @if ($hasDetailPreview)

                                            <a
                                                class="inv-asset-name"
                                                href="{{ route('inventory.show') }}"
                                            >
                                                {{ $asset['name'] }}
                                            </a>

                                        @else

                                            <span class="inv-asset-name">
                                                {{ $asset['name'] }}
                                            </span>

                                        @endif


                                        <span class="inv-asset-id">
                                            {{ $asset['id'] }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $asset['category'] }}
                            </td>


                            <td>
                                {{ $asset['location'] }}
                            </td>


                            <td class="inv-quantity">
                                {{ $asset['quantity'] }}
                            </td>


                            <td>
                                <span
                                    class="
                                        inv-condition
                                        inv-tone-{{ $conditionTones[$asset['condition']] }}
                                    "
                                >
                                    {{ $asset['condition'] }}
                                </span>
                            </td>


                            <td>
                                <span
                                    class="
                                        inv-badge
                                        inv-tone-{{ $statusTones[$asset['status']] }}
                                    "
                                >
                                    {{ $asset['status'] }}
                                </span>
                            </td>


                            <td>
                                <span class="inv-updated">
                                    {{ $asset['updated'] }}
                                </span>
                            </td>


                            <td class="inv-action-cell">

                                <div class="inv-action-group">

                                    @if ($hasDetailPreview)

                                        <a
                                            class="
                                                inv-action-icon
                                                inv-action-view
                                            "
                                            href="{{ route('inventory.show') }}"
                                            title="View"
                                        >
                                            <svg
                                                class="inv-icon"
                                                aria-hidden="true"
                                            >
                                                <use href="#inv-icon-eye"/>
                                            </svg>
                                        </a>

                                    @else

                                        <button
                                            class="
                                                inv-action-icon
                                                inv-action-view
                                            "
                                            type="button"
                                            disabled
                                            title="View preview unavailable"
                                        >
                                            <svg
                                                class="inv-icon"
                                                aria-hidden="true"
                                            >
                                                <use href="#inv-icon-eye"/>
                                            </svg>
                                        </button>

                                    @endif


                                    @if ($hasDetailPreview)

                                        <a
                                            class="
                                                inv-action-icon
                                                inv-action-edit
                                            "
                                            href="{{ route('inventory.edit') }}"
                                            title="Edit"
                                        >
                                            <svg
                                                class="inv-icon"
                                                aria-hidden="true"
                                            >
                                                <use href="#inv-icon-pen"/>
                                            </svg>
                                        </a>

                                    @else

                                        <button
                                            class="
                                                inv-action-icon
                                                inv-action-edit
                                            "
                                            type="button"
                                            disabled
                                            title="Edit preview unavailable"
                                        >
                                            <svg
                                                class="inv-icon"
                                                aria-hidden="true"
                                            >
                                                <use href="#inv-icon-pen"/>
                                            </svg>
                                        </button>

                                    @endif


                                    <button
                                        class="
                                            inv-action-icon
                                            inv-action-archive
                                        "
                                        type="button"
                                        data-archive-asset
                                        data-asset-row="inventory-row-{{ $index }}"
                                        data-asset-name="{{ $asset['name'] }}"
                                        title="Archive"
                                    >
                                        <svg
                                            class="inv-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#inv-icon-trash"/>
                                        </svg>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <div
            class="inv-empty"
            id="inventory-empty-state"
            hidden
        >

            <span
                class="inv-empty-icon"
                aria-hidden="true"
            >
                <svg class="inv-icon">
                    <use href="#inv-icon-empty"/>
                </svg>
            </span>

            <h3>
                No matching assets
            </h3>

            <p>
                Try another search term or clear the current filters.
            </p>

        </div>


        <footer class="inv-register-footer">

            <p>
                Showing

                <strong id="inventory-pagination-range">
                    1–{{ count($assets) }}
                </strong>

                of

                <strong id="inventory-total-count">
                    {{ count($assets) }}
                </strong>

                sample records.
            </p>


            <div class="inv-footer-right">

                <span class="inv-pagination-note">
                    Filters apply instantly
                </span>

                <span class="inv-preview-tag">
                    Inventory preview
                </span>

            </div>

        </footer>

    </section>


    <div
        class="fixed inset-0 z-[90] hidden flex items-center justify-center bg-[#10263D]/55 p-4 opacity-0 backdrop-blur-sm transition-opacity duration-150"
        id="archive-asset-modal"
        role="dialog"
        aria-modal="true"
        aria-hidden="true"
    >

        <div
            class="inv-archive-panel w-full max-w-md max-h-[90svh] overflow-y-auto scale-95 rounded-3xl p-6 opacity-0 transition duration-150"
            data-modal-panel
        >

            <span class="inv-badge inv-tone-pink">
                Preview action
            </span>

            <h2 class="mt-4 text-xl font-bold tracking-tight">
                Archive this asset?
            </h2>

            <p class="mt-3 text-sm leading-6 text-[#496580]">
                <strong
                    class="text-[#10263D]"
                    id="archive-asset-name"
                >
                    Asset
                </strong>

                will be hidden from this sample inventory list.
                Refreshing the page restores the record because
                this preview does not save changes yet.
            </p>


            <div class="mt-6 flex flex-wrap justify-end gap-3">

                <button
                    class="inv-clear"
                    id="cancel-archive-asset"
                    type="button"
                >
                    Cancel
                </button>

                <button
                    class="inv-archive-danger"
                    id="confirm-archive-asset"
                    type="button"
                >
                    Archive asset
                </button>

            </div>

        </div>

    </div>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeInventoryPage = () => {
        const page =
            document.getElementById(
                'inventory-page'
            );

        if (
            !page ||
            page.dataset.initialized === 'true'
        ) {
            return;
        }

        page.dataset.initialized = 'true';

        const search =
            page.querySelector(
                '#inventory-search'
            );

        const categoryFilter =
            page.querySelector(
                '#inventory-category-filter'
            );

        const statusFilter =
            page.querySelector(
                '#inventory-status-filter'
            );

        const conditionFilter =
            page.querySelector(
                '#inventory-condition-filter'
            );

        const clearButton =
            page.querySelector(
                '#clear-inventory-filters'
            );

        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-inventory-row]'
                )
            );

        const tableWrap =
            page.querySelector(
                '#inventory-table-wrap'
            );

        const emptyState =
            page.querySelector(
                '#inventory-empty-state'
            );

        const visibleCount =
            page.querySelector(
                '#inventory-visible-count'
            );

        const paginationRange =
            page.querySelector(
                '#inventory-pagination-range'
            );

        const totalCount =
            page.querySelector(
                '#inventory-total-count'
            );

        const modal =
            page.querySelector(
                '#archive-asset-modal'
            );

        const modalPanel =
            modal?.querySelector(
                '[data-modal-panel]'
            );

        const archiveName =
            page.querySelector(
                '#archive-asset-name'
            );

        const cancelArchive =
            page.querySelector(
                '#cancel-archive-asset'
            );

        const confirmArchive =
            page.querySelector(
                '#confirm-archive-asset'
            );

        const archiveButtons =
            Array.from(
                page.querySelectorAll(
                    '[data-archive-asset]'
                )
            );

        let archiveRow = null;
        let archiveTrigger = null;
        let previousBodyOverflow = '';

        const normalize = (value) => {
            return String(
                value ?? ''
            )
                .trim()
                .toLowerCase();
        };

        const getActiveRows = () => {
            return rows.filter(
                (row) =>
                    row.dataset.archived !== 'true'
            );
        };

        const applyFilters = () => {
            const query =
                normalize(
                    search?.value
                );

            const category =
                categoryFilter?.value ?? '';

            const status =
                statusFilter?.value ?? '';

            const condition =
                conditionFilter?.value ?? '';

            let visible = 0;

            rows.forEach((row) => {
                const archived =
                    row.dataset.archived === 'true';

                const matchesSearch =
                    !query ||
                    normalize(
                        row.dataset.search
                    ).includes(
                        query
                    );

                const matchesCategory =
                    !category ||
                    row.dataset.category === category;

                const matchesStatus =
                    !status ||
                    row.dataset.status === status;

                const matchesCondition =
                    !condition ||
                    row.dataset.condition === condition;

                const matches =
                    !archived &&
                    matchesSearch &&
                    matchesCategory &&
                    matchesStatus &&
                    matchesCondition;

                row.hidden = !matches;

                if (matches) {
                    visible += 1;
                }
            });

            const activeTotal =
                getActiveRows().length;

            if (visibleCount) {
                visibleCount.textContent =
                    String(
                        visible
                    );
            }

            if (totalCount) {
                totalCount.textContent =
                    String(
                        activeTotal
                    );
            }

            if (paginationRange) {
                paginationRange.textContent =
                    visible > 0
                        ? `1–${visible}`
                        : '0';
            }

            if (emptyState) {
                emptyState.hidden =
                    visible !== 0;
            }

            if (tableWrap) {
                tableWrap.hidden =
                    visible === 0;
            }
        };


        clearButton?.addEventListener(
            'click',
            () => {
                search.value = '';
                categoryFilter.value = '';
                statusFilter.value = '';
                conditionFilter.value = '';

                applyFilters();

                search.focus();
            }
        );

        search?.addEventListener(
            'input',
            applyFilters
        );

        categoryFilter?.addEventListener(
            'change',
            applyFilters
        );

        statusFilter?.addEventListener(
            'change',
            applyFilters
        );

        conditionFilter?.addEventListener(
            'change',
            applyFilters
        );


        const openArchiveModal = (trigger) => {
            if (
                !modal ||
                !modalPanel
            ) {
                return;
            }

            const rowId =
                trigger.dataset.assetRow;

            const row =
                rowId
                    ? document.getElementById(
                        rowId
                    )
                    : null;

            if (!row) {
                return;
            }

            archiveRow = row;
            archiveTrigger = trigger;

            if (archiveName) {
                archiveName.textContent =
                    trigger.dataset.assetName ||
                    'Asset';
            }

            previousBodyOverflow =
                document.body.style.overflow;

            document.body.style.overflow =
                'hidden';

            modal.classList.remove(
                'hidden'
            );

            modal.setAttribute(
                'aria-hidden',
                'false'
            );

            requestAnimationFrame(() => {
                modal.classList.remove(
                    'opacity-0'
                );

                modalPanel.classList.remove(
                    'scale-95',
                    'opacity-0'
                );

                confirmArchive?.focus();
            });
        };


        const closeArchiveModal = (
            returnFocus = true
        ) => {
            if (
                !modal ||
                !modalPanel
            ) {
                return;
            }

            modal.classList.add(
                'opacity-0'
            );

            modalPanel.classList.add(
                'scale-95',
                'opacity-0'
            );

            modal.setAttribute(
                'aria-hidden',
                'true'
            );

            window.setTimeout(
                () => {
                    modal.classList.add(
                        'hidden'
                    );

                    document.body.style.overflow =
                        previousBodyOverflow;

                    if (
                        returnFocus &&
                        archiveTrigger &&
                        archiveTrigger.isConnected
                    ) {
                        archiveTrigger.focus();
                    }

                    archiveRow = null;
                    archiveTrigger = null;
                },
                160
            );
        };


        archiveButtons.forEach((button) => {
            button.addEventListener(
                'click',
                () => {
                    openArchiveModal(
                        button
                    );
                }
            );
        });


        cancelArchive?.addEventListener(
            'click',
            () => {
                closeArchiveModal(
                    true
                );
            }
        );


        confirmArchive?.addEventListener(
            'click',
            () => {
                if (!archiveRow) {
                    return;
                }

                archiveRow.dataset.archived =
                    'true';

                closeArchiveModal(
                    false
                );

                applyFilters();

                window.setTimeout(
                    () => {
                        search?.focus();
                    },
                    180
                );
            }
        );


        modal?.addEventListener(
            'click',
            (event) => {
                if (
                    event.target === modal
                ) {
                    closeArchiveModal(
                        true
                    );
                }
            }
        );


        document.addEventListener(
            'keydown',
            (event) => {
                if (
                    event.key !== 'Escape' ||
                    !modal ||
                    modal.classList.contains(
                        'hidden'
                    )
                ) {
                    return;
                }

                closeArchiveModal(
                    true
                );
            }
        );

        applyFilters();
    };


    if (
        document.readyState === 'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeInventoryPage,
            {
                once: true
            }
        );
    } else {
        initializeInventoryPage();
    }
})();
</script>
@endpush