@extends('layouts.app')

@section('title', 'Inventory & Assets Report | PULSO Logistics Hub')

@php
    $assets = [
        [
            'id' => 'PULSO-AUD-001',
            'name' => 'Portable Sound System',
            'category' => 'Audio',
            'location' => 'Equipment Shelf A',
            'quantity' => 1,
            'condition' => 'Good',
            'status' => 'Available',
            'updated' => 'Sep 08, 2026',
        ],
        [
            'id' => 'PULSO-FUR-001',
            'name' => 'Monoblock Chairs',
            'category' => 'Furniture',
            'location' => 'Main Storage',
            'quantity' => 50,
            'condition' => 'Good',
            'status' => 'Available',
            'updated' => 'Sep 08, 2026',
        ],
        [
            'id' => 'PULSO-FUR-002',
            'name' => 'Folding Tables',
            'category' => 'Furniture',
            'location' => 'Main Storage',
            'quantity' => 10,
            'condition' => 'Good',
            'status' => 'Deployed',
            'updated' => 'Sep 07, 2026',
        ],
        [
            'id' => 'PULSO-EQP-001',
            'name' => 'Projector',
            'category' => 'Equipment',
            'location' => 'Equipment Cabinet',
            'quantity' => 1,
            'condition' => 'Excellent',
            'status' => 'Borrowed',
            'updated' => 'Sep 07, 2026',
        ],
        [
            'id' => 'PULSO-ELE-001',
            'name' => 'Extension Cord 20m',
            'category' => 'Electrical',
            'location' => 'Electrical Cabinet',
            'quantity' => 4,
            'condition' => 'Fair',
            'status' => 'Available',
            'updated' => 'Sep 06, 2026',
        ],
        [
            'id' => 'PULSO-AUD-002',
            'name' => 'Wireless Microphone Set',
            'category' => 'Audio',
            'location' => 'Equipment Shelf A',
            'quantity' => 2,
            'condition' => 'Good',
            'status' => 'Available',
            'updated' => 'Sep 06, 2026',
        ],
        [
            'id' => 'PULSO-EVT-001',
            'name' => 'Large Event Tent',
            'category' => 'Event Materials',
            'location' => 'Main Storage',
            'quantity' => 4,
            'condition' => 'Good',
            'status' => 'Deployed',
            'updated' => 'Sep 05, 2026',
        ],
        [
            'id' => 'PULSO-TOL-001',
            'name' => 'Basic Tool Kit',
            'category' => 'Tools',
            'location' => 'Tool Cabinet',
            'quantity' => 2,
            'condition' => 'Good',
            'status' => 'Available',
            'updated' => 'Sep 04, 2026',
        ],
        [
            'id' => 'PULSO-ELE-002',
            'name' => 'Power Strip',
            'category' => 'Electrical',
            'location' => 'Electrical Cabinet',
            'quantity' => 6,
            'condition' => 'Poor',
            'status' => 'Maintenance',
            'updated' => 'Sep 03, 2026',
        ],
        [
            'id' => 'PULSO-EVT-002',
            'name' => 'PULSO Event Banner',
            'category' => 'Event Materials',
            'location' => 'Banner Storage',
            'quantity' => 3,
            'condition' => 'Fair',
            'status' => 'Available',
            'updated' => 'Sep 02, 2026',
        ],
        [
            'id' => 'PULSO-AUD-003',
            'name' => 'XLR Audio Cable',
            'category' => 'Audio',
            'location' => 'Equipment Shelf B',
            'quantity' => 6,
            'condition' => 'Poor',
            'status' => 'Damaged',
            'updated' => 'Sep 01, 2026',
        ],
        [
            'id' => 'PULSO-STO-001',
            'name' => 'Plastic Storage Bin',
            'category' => 'Storage',
            'location' => 'Main Storage',
            'quantity' => 12,
            'condition' => 'Good',
            'status' => 'Available',
            'updated' => 'Aug 30, 2026',
        ],
    ];


    $summary = [
        [
            'label' => 'Total Assets',
            'value' => 148,
            'helper' => 'Registered logistics assets',
            'tone' => 'navy',
            'icon' => 'inventory',
        ],
        [
            'label' => 'Available',
            'value' => 121,
            'helper' => 'Ready for logistics use',
            'tone' => 'teal',
            'icon' => 'available',
        ],
        [
            'label' => 'Borrowed',
            'value' => 9,
            'helper' => 'Currently checked out',
            'tone' => 'pink',
            'icon' => 'borrow',
        ],
        [
            'label' => 'Deployed',
            'value' => 12,
            'helper' => 'Assigned to activities',
            'tone' => 'blue',
            'icon' => 'deployed',
        ],
        [
            'label' => 'Maintenance',
            'value' => 3,
            'helper' => 'Under maintenance',
            'tone' => 'amber',
            'icon' => 'maintenance',
        ],
        [
            'label' => 'Damaged',
            'value' => 3,
            'helper' => 'Requires assessment',
            'tone' => 'red',
            'icon' => 'damaged',
        ],
    ];


    $statusData = [
        [
            'label' => 'Available',
            'value' => 121,
            'tone' => 'teal',
        ],
        [
            'label' => 'Borrowed',
            'value' => 9,
            'tone' => 'pink',
        ],
        [
            'label' => 'Deployed',
            'value' => 12,
            'tone' => 'blue',
        ],
        [
            'label' => 'Maintenance',
            'value' => 3,
            'tone' => 'amber',
        ],
        [
            'label' => 'Damaged',
            'value' => 3,
            'tone' => 'red',
        ],
    ];


    $categoryData = [
        [
            'label' => 'Furniture',
            'value' => 60,
        ],
        [
            'label' => 'Audio',
            'value' => 24,
        ],
        [
            'label' => 'Event Materials',
            'value' => 19,
        ],
        [
            'label' => 'Electrical',
            'value' => 16,
        ],
        [
            'label' => 'Equipment',
            'value' => 11,
        ],
        [
            'label' => 'Storage',
            'value' => 10,
        ],
        [
            'label' => 'Tools',
            'value' => 8,
        ],
    ];


    $lowStock = [
        [
            'name' => 'Extension Cord 20m',
            'quantity' => 4,
            'minimum' => 10,
            'category' => 'Electrical',
        ],
        [
            'name' => 'Wireless Microphone Set',
            'quantity' => 2,
            'minimum' => 5,
            'category' => 'Audio',
        ],
        [
            'name' => 'Basic Tool Kit',
            'quantity' => 2,
            'minimum' => 5,
            'category' => 'Tools',
        ],
        [
            'name' => 'PULSO Event Banner',
            'quantity' => 3,
            'minimum' => 6,
            'category' => 'Event Materials',
        ],
    ];


    $statusTotal = array_sum(
        array_column(
            $statusData,
            'value'
        )
    );

    $categoryTotal = array_sum(
        array_column(
            $categoryData,
            'value'
        )
    );

    $availablePercent = round(
        ($statusData[0]['value'] / $statusTotal) * 100,
        1
    );

    $borrowedPercent = round(
        ($statusData[1]['value'] / $statusTotal) * 100,
        1
    );

    $deployedPercent = round(
        ($statusData[2]['value'] / $statusTotal) * 100,
        1
    );

    $maintenancePercent = round(
        ($statusData[3]['value'] / $statusTotal) * 100,
        1
    );
@endphp


@push('styles')
<style>
    .inventory-report {
        --ir-navy: #10263d;
        --ir-text: #17344e;
        --ir-muted: #496580;
        --ir-soft: #71899c;
        --ir-teal: #007780;
        --ir-pink: #b90c61;
        --ir-blue: #245b99;
        --ir-amber: #895408;
        --ir-red: #ad343d;
        --ir-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--ir-navy);

        container-name: inventory-report;
        container-type: inline-size;
    }


    .inventory-report *,
    .inventory-report *::before,
    .inventory-report *::after {
        box-sizing: border-box;
    }


    .inventory-report [hidden] {
        display: none !important;
    }


    .ir-heading,
    .ir-actions,
    .ir-section-heading,
    .ir-section-title,
    .ir-status-item,
    .ir-category-row,
    .ir-low-stock-item,
    .ir-table-footer,
    .ir-filter-row {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADER
       ================================================================ */

    .ir-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .ir-heading-copy {
        min-width: 0;
    }


    .ir-eyebrow {
        margin: 0 0 7px;

        color: var(--ir-teal);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .ir-heading h1 {
        margin: 0;

        color: var(--ir-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .ir-description {
        max-width: 790px;

        margin: 9px 0 0;

        color: var(--ir-muted);

        font-size: 14px;
        line-height: 1.7;
    }


    .ir-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .ir-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding: 10px 14px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f7fbfd,
                #e4eef3
            );

        color: #31546d;

        box-shadow:
            3px 4px 10px rgba(101, 138, 163, .12),
            -3px -3px 8px rgba(255, 255, 255, .72);

        font: inherit;
        font-size: 11px;
        font-weight: 750;

        text-decoration: none;

        cursor: pointer;

        transition:
            transform 160ms ease,
            color 160ms ease,
            background 160ms ease;
    }


    .ir-button:hover {
        color: var(--ir-teal);

        transform: translateY(-1px);
    }


    .ir-button-primary {
        border-color:
            rgba(
                151,
                235,
                239,
                .8
            );

        background:
            linear-gradient(
                145deg,
                #078b94,
                #00737b
            );

        color: #ffffff;

        box-shadow:
            4px 6px 12px rgba(0, 119, 128, .18),
            inset 1px 1px 3px rgba(135, 239, 244, .25);
    }


    .ir-button-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    .ir-button svg {
        width: 17px;
        height: 17px;

        flex-shrink: 0;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* ================================================================
       KPI SUMMARY
       ================================================================ */

    .inventory-report > .ir-summary-grid {
        display: grid !important;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 11px;

        width: 100%;
        min-width: 0;

        margin: 0 0 20px !important;
        padding: 0 !important;

        border: 0 !important;
        border-radius: 0 !important;

        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;

        box-shadow: none !important;

        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }


    .inventory-report > .ir-summary-grid::before,
    .inventory-report > .ir-summary-grid::after {
        display: none !important;

        width: 0 !important;
        height: 0 !important;

        border: 0 !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .ir-summary {
        --ir-tone: #173b59;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );

        position: relative;

        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;
        min-height: 102px;

        padding: 14px 12px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 18px;

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
    }


    .ir-summary::after {
        position: absolute;

        top: 0;
        right: 15px;

        width: 30px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--ir-tone);

        opacity: .48;

        content: "";
    }


    .ir-summary[data-tone="navy"] {
        --ir-tone: #173b59;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .ir-summary[data-tone="teal"] {
        --ir-tone: #007780;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .ir-summary[data-tone="pink"] {
        --ir-tone: #b90c61;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .ir-summary[data-tone="blue"] {
        --ir-tone: #245b99;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #e8f1fc,
                #dce8f7
            );
    }


    .ir-summary[data-tone="amber"] {
        --ir-tone: #895408;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }


    .ir-summary[data-tone="red"] {
        --ir-tone: #ad343d;

        --ir-tone-fill:
            linear-gradient(
                145deg,
                #fdecef,
                #f4dadd
            );
    }


    .ir-summary-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 12px;

        background: var(--ir-tone-fill);

        color: var(--ir-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .ir-summary-icon svg {
        width: 16px;
        height: 16px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .ir-summary-copy {
        min-width: 0;
    }


    .ir-summary-value {
        display: block;

        color: var(--ir-tone);

        font-size: 22px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .ir-summary-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 9.8px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .ir-summary-helper {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       REPORT CARDS
       ================================================================ */

    .ir-card {
        min-width: 0;

        margin-bottom: 20px;

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


    .ir-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding: 20px 22px;

        border-bottom:
            1px
            solid
            var(--ir-line);
    }


    .ir-section-title {
        gap: 12px;

        min-width: 0;
    }


    .ir-number {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border:
            1px
            solid
            #ffffff;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #ccebed
            );

        color: var(--ir-teal);

        font-size: 13px;
        font-weight: 850;
    }


    .ir-number.pink {
        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--ir-pink);
    }


    .ir-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .ir-section-title p {
        margin: 5px 0 0;

        color: var(--ir-muted);

        font-size: 11px;
        line-height: 1.55;
    }


    .ir-source {
        flex-shrink: 0;

        padding: 7px 10px;

        border:
            1px
            solid
            rgba(255, 255, 255, .85);

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e4eff4
            );

        color: #587388;

        font-size: 9px;
        font-weight: 700;
    }


    /* ================================================================
       ANALYTICS
       ================================================================ */

    .ir-analytics {
        display: grid;

        grid-template-columns:
            minmax(0, .88fr)
            minmax(0, 1.12fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .ir-analytics .ir-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       STATUS DONUT
       ================================================================ */

    .ir-status-wrap {
        display: grid;

        grid-template-columns:
            166px
            minmax(0, 1fr);

        align-items: center;

        gap: 17px;

        min-height: 270px;

        padding: 20px 19px;
    }


    .ir-donut-wrap {
        position: relative;

        display: grid;
        place-items: center;

        width: 166px;
        height: 166px;

        margin: auto;
    }


    .ir-donut {
        position: relative;

        width: 154px;
        height: 154px;

        flex: 0 0 154px;

        border-radius: 50%;

        background:
            conic-gradient(
                #05adb6 0 var(--available),
                #ee1280 var(--available) calc(var(--available) + var(--borrowed)),
                #245b99 calc(var(--available) + var(--borrowed)) calc(var(--available) + var(--borrowed) + var(--deployed)),
                #d39c35 calc(var(--available) + var(--borrowed) + var(--deployed)) calc(var(--available) + var(--borrowed) + var(--deployed) + var(--maintenance)),
                #ad343d calc(var(--available) + var(--borrowed) + var(--deployed) + var(--maintenance)) 100%
            );

        box-shadow:
            0 9px 20px rgba(101, 138, 163, .15);
    }


    .ir-donut::after {
        position: absolute;

        inset: 24%;

        border-radius: 50%;

        background:
            linear-gradient(
                145deg,
                #f8fcfd,
                #e7f1f5
            );

        box-shadow:
            inset 4px 4px 9px rgba(101, 138, 163, .09),
            inset -3px -3px 8px rgba(255, 255, 255, .8);

        content: "";
    }


    .ir-donut-center {
        position: absolute;
        z-index: 3;

        top: 50%;
        left: 50%;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        width: 76px;
        height: 76px;

        padding: 4px;

        transform: translate(-50%, -50%);

        color: var(--ir-navy);

        text-align: center;

        pointer-events: none;
    }


    .ir-donut-center strong {
        display: block;

        margin: 0;

        color: var(--ir-navy);

        font-size: 25px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;
    }


    .ir-donut-center span {
        display: block;

        max-width: 68px;

        margin-top: 4px;

        color: #496580;

        font-size: 7.5px;
        font-weight: 750;
        line-height: 1.15;

        text-align: center;

        white-space: normal;
    }


    /* ================================================================
       STATUS LEGEND
       ================================================================ */

    .ir-legend {
        display: grid;

        min-width: 0;

        gap: 8px;
    }


    .ir-status-item {
        justify-content: space-between;

        gap: 8px;

        min-width: 0;

        padding: 8px 9px;

        border:
            1px
            solid
            rgba(255, 255, 255, .78);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e5f0f4
            );

        box-shadow:
            inset 2px 2px 5px rgba(84, 118, 139, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .62);
    }


    .ir-status-left {
        display: flex;
        align-items: center;

        gap: 7px;

        min-width: 0;
    }


    .ir-dot {
        width: 8px;
        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;
    }


    .ir-dot.teal {
        background: #05adb6;
    }


    .ir-dot.pink {
        background: #ee1280;
    }


    .ir-dot.blue {
        background: #245b99;
    }


    .ir-dot.amber {
        background: #d39c35;
    }


    .ir-dot.red {
        background: #ad343d;
    }


    .ir-status-label {
        min-width: 0;

        color: #31546d;

        font-size: 8.8px;
        font-weight: 700;
        line-height: 1.3;

        overflow-wrap: anywhere;
    }


    .ir-status-value {
        flex-shrink: 0;

        color: var(--ir-navy);

        font-size: 8.7px;
        font-weight: 800;

        white-space: nowrap;

        font-variant-numeric: tabular-nums;
    }


    /* ================================================================
       CATEGORY BREAKDOWN
       ================================================================ */

    .ir-category-list {
        display: grid;
        align-content: center;

        min-height: 270px;

        gap: 15px;

        padding: 20px 22px;
    }


    .ir-category-row {
        justify-content: space-between;

        gap: 13px;
    }


    .ir-category-label {
        width: 108px;

        flex: 0 0 108px;

        color: #31546d;

        font-size: 9.2px;
        font-weight: 700;
    }


    .ir-category-track {
        flex: 1;

        height: 8px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .13);
    }


    .ir-category-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .ir-category-value {
        width: 32px;

        flex: 0 0 32px;

        color: var(--ir-navy);

        font-size: 9.5px;
        font-weight: 800;

        text-align: right;
    }


    /* ================================================================
       LOW STOCK
       ================================================================ */

    .ir-low-stock-grid {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 12px;

        padding: 22px;
    }


    .ir-low-stock-item {
        align-items: flex-start;

        gap: 11px;

        min-width: 0;

        padding: 14px;

        border:
            1px
            solid
            rgba(239, 205, 220, .9);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #fffafd,
                #f7eaf1
            );

        box-shadow:
            inset 2px 2px 5px rgba(136, 84, 107, .04),
            inset -2px -2px 6px rgba(255, 255, 255, .68);
    }


    .ir-warning-icon {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #fbe7f0,
                #efd1df
            );

        color: var(--ir-pink);
    }


    .ir-warning-icon svg {
        width: 16px;
        height: 16px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .ir-low-stock-copy {
        min-width: 0;

        flex: 1;
    }


    .ir-low-stock-copy strong {
        display: block;

        overflow: hidden;

        color: #17344e;

        font-size: 10.5px;
        font-weight: 800;
        line-height: 1.4;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .ir-low-stock-copy span {
        display: block;

        margin-top: 3px;

        color: #688297;

        font-size: 8.5px;
        line-height: 1.45;
    }


    .ir-stock-progress {
        margin-top: 8px;
    }


    .ir-stock-track {
        width: 100%;
        height: 6px;

        overflow: hidden;

        border-radius: 999px;

        background: #e5d9df;

        box-shadow:
            inset 1px 1px 2px rgba(122, 80, 99, .09);
    }


    .ir-stock-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    /* ================================================================
       TABLE TOOLBAR
       ================================================================ */

    .ir-table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        padding: 15px 22px;

        border-bottom:
            1px
            solid
            var(--ir-line);

        background:
            rgba(
                234,
                244,
                248,
                .35
            );
    }


    .ir-filter-row {
        flex-wrap: wrap;

        gap: 7px;
    }


    .ir-filter {
        min-height: 34px;

        padding: 7px 10px;

        border:
            1px
            solid
            #d2e3ea;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #f4fafc,
                #e6f0f4
            );

        color: #587388;

        font: inherit;
        font-size: 9px;
        font-weight: 750;

        cursor: pointer;

        transition:
            border-color 150ms ease,
            background 150ms ease,
            color 150ms ease;
    }


    .ir-filter:hover {
        border-color: #a8d8de;

        color: var(--ir-teal);
    }


    .ir-filter.is-active {
        border-color:
            rgba(
                5,
                173,
                182,
                .26
            );

        background:
            linear-gradient(
                145deg,
                #e3f8f8,
                #d4eeee
            );

        color: var(--ir-teal);

        box-shadow:
            inset 2px 2px 4px rgba(70, 111, 130, .06);
    }


    .ir-visible-count {
        flex-shrink: 0;

        color: var(--ir-muted);

        font-size: 9.5px;

        white-space: nowrap;
    }


    .ir-visible-count strong {
        color: var(--ir-navy);
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .ir-table-wrap {
        width: 100%;

        overflow-x: auto;
    }


    .ir-table {
        width: 100%;
        min-width: 1030px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .ir-table th {
        padding: 12px 14px;

        border-bottom:
            1px
            solid
            #cfdee7;

        background:
            rgba(
                225,
                240,
                247,
                .78
            );

        color: #516d82;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

        white-space: nowrap;
    }


    .ir-table td {
        padding: 13px 14px;

        border-bottom:
            1px
            solid
            rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 10px;

        vertical-align: middle;
    }


    .ir-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .ir-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .4
            );
    }


    .ir-asset-title {
        display: block;

        max-width: 205px;

        color: #18344c;

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;
    }


    .ir-sub {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.4;
    }


    .ir-quantity {
        color: #29475f;

        font-size: 11px;
        font-weight: 850;
    }


    /* ================================================================
       BADGES
       ================================================================ */

    .ir-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 26px;

        padding: 4px 8px;

        border:
            1px
            solid
            rgba(255, 255, 255, .8);

        border-radius: 8px;

        font-size: 8.5px;
        font-weight: 800;

        white-space: nowrap;
    }


    .ir-badge.teal {
        background: #dff4f4;

        color: #007780;
    }


    .ir-badge.pink {
        background: #f8e0eb;

        color: #b90c61;
    }


    .ir-badge.blue {
        background: #e2ecf8;

        color: #245b99;
    }


    .ir-badge.amber {
        background: #fff0d7;

        color: #895408;
    }


    .ir-badge.red {
        background: #fde5e8;

        color: #ad343d;
    }


    .ir-badge.gray {
        background: #edf2f5;

        color: #688297;
    }


    /* ================================================================
       EMPTY STATE
       ================================================================ */

    .ir-table-empty {
        padding: 40px 22px;

        text-align: center;
    }


    .ir-table-empty strong {
        display: block;

        color: #173b59;

        font-size: 14px;
    }


    .ir-table-empty p {
        margin: 6px 0 0;

        color: #688297;

        font-size: 10px;
    }


    /* ================================================================
       TABLE FOOTER
       ================================================================ */

    .ir-table-footer {
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 8px 15px;

        padding: 14px 22px;

        border-top:
            1px
            solid
            var(--ir-line);
    }


    .ir-table-footer p {
        margin: 0;

        color: var(--ir-muted);

        font-size: 9.5px;
    }


    .ir-table-footer strong {
        color: var(--ir-navy);
    }


    .ir-note {
        margin: 4px 0 0;

        color: #71899c;

        font-size: 10px;
        line-height: 1.65;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container inventory-report (max-width: 900px) {
        .inventory-report > .ir-summary-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }


        .ir-low-stock-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container inventory-report (max-width: 820px) {
        .ir-analytics {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .ir-status-wrap {
            grid-template-columns:
                175px
                minmax(0, 1fr);
        }
    }


    @container inventory-report (max-width: 700px) {
        .ir-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .ir-actions {
            width: 100%;
        }


        .ir-actions .ir-button {
            flex: 1;
        }


        .inventory-report > .ir-summary-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .ir-section-heading {
            align-items: flex-start;
        }


        .ir-source {
            display: none;
        }


        .ir-low-stock-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .ir-table-toolbar {
            align-items: flex-start;

            flex-direction: column;
        }


        .ir-table-footer {
            align-items: flex-start;

            flex-direction: column;
        }
    }


    @container inventory-report (max-width: 560px) {
        .ir-status-wrap {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .ir-donut-wrap {
            margin-bottom: 5px;
        }
    }


    @container inventory-report (max-width: 480px) {
        .inventory-report > .ir-summary-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .ir-category-label {
            width: 96px;

            flex-basis: 96px;
        }
    }


    /* ================================================================
       PRINT
       ================================================================ */

    @media print {
        @page {
            size: A4 landscape;

            margin: 12mm;
        }


        body:has(#inventory-report) #app-sidebar,
        body:has(#inventory-report) #sidebar-backdrop,
        body:has(#inventory-report) #pulso-topbar,
        body:has(#inventory-report) .hub-skip-link,
        .inventory-report .ir-no-print {
            display: none !important;
        }


        body:has(#inventory-report) #app-main {
            padding-left: 0 !important;
        }


        body:has(#inventory-report) .hub-content {
            padding: 0 !important;
        }


        .inventory-report {
            container-type: normal;
        }


        .inventory-report > .ir-summary-grid {
            grid-template-columns:
                repeat(
                    6,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .ir-summary {
            min-height: auto;

            padding: 9px;
        }


        .ir-summary-icon {
            display: none;
        }


        .ir-summary,
        .ir-card,
        .ir-status-item,
        .ir-low-stock-item {
            border:
                1px
                solid
                #d6d6d6 !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .ir-card,
        .ir-summary {
            break-inside: avoid;
        }


        .ir-analytics {
            grid-template-columns:
                .88fr
                1.12fr;

            gap: 10px;
        }


        .ir-low-stock-grid {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .ir-table {
            min-width: 0;

            table-layout: fixed;
        }


        .ir-table th,
        .ir-table td {
            padding: 7px 5px;

            overflow-wrap: anywhere;
        }


        .ir-table thead {
            display: table-header-group;
        }


        .ir-table tr {
            break-inside: avoid;
        }


        .ir-badge {
            white-space: normal;
        }
    }
</style>
@endpush


@section('content')
<div
    class="inventory-report"
    id="inventory-report"
>

    <header class="ir-heading">

        <div class="ir-heading-copy">

            <p class="ir-eyebrow">
                Inventory analytics
            </p>

            <h1>
                Inventory &amp; Assets Report
            </h1>

            <p class="ir-description">
                Monitor asset availability, deployment, condition,
                category distribution, and critical stock levels across
                the PULSO Logistics Hub inventory.
            </p>

        </div>


        <div class="ir-actions ir-no-print">

            <a
                class="ir-button"
                href="{{ route('reports.index') }}"
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M19 12H5"/>
                    <path d="m11 6-6 6 6 6"/>
                </svg>

                Reports &amp; History
            </a>


            <button
                class="
                    ir-button
                    ir-button-primary
                "
                id="ir-print"
                type="button"
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M7 8V3h10v5"/>
                    <path d="M7 17H4V9h16v8h-3"/>
                    <path d="M7 14h10v7H7Z"/>
                </svg>

                Print Report
            </button>

        </div>

    </header>


    <section
        class="ir-summary-grid"
        aria-label="Inventory report summary"
    >

        @foreach ($summary as $item)

            <article
                class="ir-summary"
                data-tone="{{ $item['tone'] }}"
            >

                <span
                    class="ir-summary-icon"
                    aria-hidden="true"
                >

                    @if ($item['icon'] === 'inventory')

                        <svg viewBox="0 0 24 24">
                            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                            <path d="M3 8v9l9 5 9-5V8"/>
                            <path d="M12 13v9"/>
                        </svg>

                    @elseif ($item['icon'] === 'available')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                    @elseif ($item['icon'] === 'borrow')

                        <svg viewBox="0 0 24 24">
                            <path d="M4 7h15"/>
                            <path d="m15 3 4 4-4 4"/>
                            <path d="M20 17H5"/>
                            <path d="m9 13-4 4 4 4"/>
                        </svg>

                    @elseif ($item['icon'] === 'deployed')

                        <svg viewBox="0 0 24 24">
                            <path d="M3 7h11v10H3Z"/>
                            <path d="M14 10h4l3 3v4h-7Z"/>
                            <circle
                                cx="7"
                                cy="18"
                                r="2"
                            />
                            <circle
                                cx="18"
                                cy="18"
                                r="2"
                            />
                        </svg>

                    @elseif ($item['icon'] === 'maintenance')

                        <svg viewBox="0 0 24 24">
                            <path d="M14.7 6.3a4 4 0 0 0-5-5L12 3.6 8.4 7.2 6.1 4.9a4 4 0 0 0 5 5"/>
                            <path d="m10.5 9.5-7.8 7.8a2.1 2.1 0 0 0 3 3l7.8-7.8"/>
                        </svg>

                    @else

                        <svg viewBox="0 0 24 24">
                            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>

                    @endif

                </span>


                <div class="ir-summary-copy">

                    <strong class="ir-summary-value">
                        {{ number_format($item['value']) }}
                    </strong>

                    <span class="ir-summary-label">
                        {{ $item['label'] }}
                    </span>

                    <span class="ir-summary-helper">
                        {{ $item['helper'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    <div class="ir-analytics">

        <section class="ir-card">

            <header class="ir-section-heading">

                <div class="ir-section-title">

                    <span class="ir-number">
                        01
                    </span>

                    <div>
                        <h2>
                            Inventory Status
                        </h2>

                        <p>
                            Current distribution of registered assets.
                        </p>
                    </div>

                </div>


                <span class="ir-source">
                    {{ number_format($statusTotal) }} assets
                </span>

            </header>


            <div class="ir-status-wrap">

                <div class="ir-donut-wrap">

                    <div
                        class="ir-donut"
                        style="
                            --available: {{ $availablePercent }}%;
                            --borrowed: {{ $borrowedPercent }}%;
                            --deployed: {{ $deployedPercent }}%;
                            --maintenance: {{ $maintenancePercent }}%;
                        "
                        role="img"
                        aria-label="Inventory status distribution"
                    ></div>


                    <div class="ir-donut-center">

                        <strong>
                            {{ number_format($statusTotal) }}
                        </strong>

                        <span>
                            Tracked Assets
                        </span>

                    </div>

                </div>


                <div class="ir-legend">

                    @foreach ($statusData as $item)

                        @php
                            $percent = round(
                                (
                                    $item['value']
                                    /
                                    $statusTotal
                                ) * 100,
                                1
                            );
                        @endphp


                        <div class="ir-status-item">

                            <div class="ir-status-left">

                                <span
                                    class="
                                        ir-dot
                                        {{ $item['tone'] }}
                                    "
                                ></span>

                                <span class="ir-status-label">
                                    {{ $item['label'] }}
                                </span>

                            </div>


                            <span class="ir-status-value">
                                {{ number_format($item['value']) }}
                                ·
                                {{ $percent }}%
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        <section class="ir-card">

            <header class="ir-section-heading">

                <div class="ir-section-title">

                    <span class="ir-number pink">
                        02
                    </span>

                    <div>
                        <h2>
                            Asset Category Breakdown
                        </h2>

                        <p>
                            Distribution of inventory across resource categories.
                        </p>
                    </div>

                </div>


                <span class="ir-source">
                    {{ count($categoryData) }} categories
                </span>

            </header>


            <div class="ir-category-list">

                @foreach ($categoryData as $item)

                    @php
                        $categoryPercent = round(
                            (
                                $item['value']
                                /
                                $categoryTotal
                            ) * 100,
                            1
                        );
                    @endphp


                    <div class="ir-category-row">

                        <span class="ir-category-label">
                            {{ $item['label'] }}
                        </span>


                        <div
                            class="ir-category-track"
                            title="{{ $categoryPercent }}%"
                        >

                            <div
                                class="ir-category-fill"
                                style="
                                    width:
                                    {{ $categoryPercent }}%;
                                "
                            ></div>

                        </div>


                        <span class="ir-category-value">
                            {{ $item['value'] }}
                        </span>

                    </div>

                @endforeach

            </div>

        </section>

    </div>


    <section class="ir-card">

        <header class="ir-section-heading">

            <div class="ir-section-title">

                <span class="ir-number pink">
                    03
                </span>

                <div>
                    <h2>
                        Low Stock &amp; Critical Resources
                    </h2>

                    <p>
                        Inventory items below their recommended minimum quantity.
                    </p>
                </div>

            </div>


            <span class="ir-source">
                {{ count($lowStock) }}
                critical items
            </span>

        </header>


        <div class="ir-low-stock-grid">

            @foreach ($lowStock as $item)

                @php
                    $stockPercent = min(
                        100,
                        round(
                            (
                                $item['quantity']
                                /
                                $item['minimum']
                            ) * 100,
                            1
                        )
                    );
                @endphp


                <article class="ir-low-stock-item">

                    <span
                        class="ir-warning-icon"
                        aria-hidden="true"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.75 3h14.9a2 2 0 0 0 1.75-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 16h.01"/>
                        </svg>
                    </span>


                    <div class="ir-low-stock-copy">

                        <strong>
                            {{ $item['name'] }}
                        </strong>

                        <span>
                            {{ $item['category'] }}
                            ·
                            {{ $item['quantity'] }}
                            available
                        </span>

                        <span>
                            Preferred minimum:
                            {{ $item['minimum'] }}
                        </span>


                        <div class="ir-stock-progress">

                            <div class="ir-stock-track">

                                <div
                                    class="ir-stock-fill"
                                    style="
                                        width:
                                        {{ $stockPercent }}%;
                                    "
                                ></div>

                            </div>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    </section>


    <section class="ir-card">

        <header class="ir-section-heading">

            <div class="ir-section-title">

                <span class="ir-number">
                    04
                </span>

                <div>
                    <h2>
                        Asset Register
                    </h2>

                    <p>
                        Detailed inventory records for logistics monitoring.
                    </p>
                </div>

            </div>


            <span class="ir-source">
                Sample Records
            </span>

        </header>


        <div class="ir-table-toolbar ir-no-print">

            <div
                class="ir-filter-row"
                role="group"
                aria-label="Filter inventory report"
            >

                <button
                    class="
                        ir-filter
                        is-active
                    "
                    type="button"
                    data-status-filter="all"
                >
                    All
                </button>


                <button
                    class="ir-filter"
                    type="button"
                    data-status-filter="Available"
                >
                    Available
                </button>


                <button
                    class="ir-filter"
                    type="button"
                    data-status-filter="Borrowed"
                >
                    Borrowed
                </button>


                <button
                    class="ir-filter"
                    type="button"
                    data-status-filter="Deployed"
                >
                    Deployed
                </button>


                <button
                    class="ir-filter"
                    type="button"
                    data-status-filter="Maintenance"
                >
                    Maintenance
                </button>


                <button
                    class="ir-filter"
                    type="button"
                    data-status-filter="Damaged"
                >
                    Damaged
                </button>

            </div>


            <span class="ir-visible-count">

                Showing

                <strong id="ir-visible-count">
                    {{ count($assets) }}
                </strong>

                of

                <strong>
                    {{ count($assets) }}
                </strong>

                sample records

            </span>

        </div>


        <div
            class="ir-table-wrap"
            role="region"
            aria-label="Inventory report table"
            tabindex="0"
        >

            <table class="ir-table">

                <thead>
                    <tr>
                        <th scope="col">
                            Asset
                        </th>

                        <th scope="col">
                            Category
                        </th>

                        <th scope="col">
                            Location
                        </th>

                        <th scope="col">
                            Quantity
                        </th>

                        <th scope="col">
                            Condition
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th scope="col">
                            Updated
                        </th>
                    </tr>
                </thead>


                <tbody id="ir-asset-rows">

                    @foreach ($assets as $asset)

                        @php
                            $statusTone = match ($asset['status']) {
                                'Available' => 'teal',
                                'Borrowed' => 'pink',
                                'Deployed' => 'blue',
                                'Maintenance' => 'amber',
                                'Damaged' => 'red',
                                default => 'gray',
                            };

                            $conditionTone = match ($asset['condition']) {
                                'Excellent',
                                'Good' => 'teal',

                                'Fair' => 'amber',

                                'Poor',
                                'Damaged' => 'red',

                                default => 'gray',
                            };
                        @endphp


                        <tr
                            data-asset-row
                            data-asset-status="{{ $asset['status'] }}"
                        >

                            <td>

                                <strong class="ir-asset-title">
                                    {{ $asset['name'] }}
                                </strong>

                                <span class="ir-sub">
                                    {{ $asset['id'] }}
                                </span>

                            </td>


                            <td>
                                {{ $asset['category'] }}
                            </td>


                            <td>
                                {{ $asset['location'] }}
                            </td>


                            <td>
                                <strong class="ir-quantity">
                                    {{ number_format($asset['quantity']) }}
                                </strong>
                            </td>


                            <td>
                                <span
                                    class="
                                        ir-badge
                                        {{ $conditionTone }}
                                    "
                                >
                                    {{ $asset['condition'] }}
                                </span>
                            </td>


                            <td>
                                <span
                                    class="
                                        ir-badge
                                        {{ $statusTone }}
                                    "
                                >
                                    {{ $asset['status'] }}
                                </span>
                            </td>


                            <td>
                                {{ $asset['updated'] }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            <div
                class="ir-table-empty"
                id="ir-empty"
                hidden
            >

                <strong>
                    No assets found for this status
                </strong>

                <p>
                    Select another status filter to display matching records.
                </p>

            </div>

        </div>


        <footer class="ir-table-footer">

            <p>
                Inventory total:

                <strong>
                    {{ number_format($statusTotal) }}
                </strong>

                registered assets
            </p>


            <p>
                Available:

                <strong>
                    {{ number_format($statusData[0]['value']) }}
                </strong>
            </p>


            <p>
                Requiring maintenance or assessment:

                <strong>
                    {{
                        number_format(
                            $statusData[3]['value']
                            +
                            $statusData[4]['value']
                        )
                    }}
                </strong>
            </p>

        </footer>

    </section>


    <p class="ir-note">
        Report values and detailed asset records are currently sample
        front-end data. During backend integration, these sections can
        be connected to the actual inventory database, stock thresholds,
        borrowing records, deployment history, and maintenance records.
    </p>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeInventoryReport = () => {
        const page =
            document.getElementById(
                'inventory-report'
            );


        if (
            !page ||
            page.dataset.initialized ===
                'true'
        ) {
            return;
        }


        page.dataset.initialized =
            'true';


        const filters =
            Array.from(
                page.querySelectorAll(
                    '[data-status-filter]'
                )
            );


        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-asset-row]'
                )
            );


        const empty =
            page.querySelector(
                '#ir-empty'
            );


        const visibleCount =
            page.querySelector(
                '#ir-visible-count'
            );


        const printButton =
            page.querySelector(
                '#ir-print'
            );


        filters.forEach(
            (button) => {
                button.addEventListener(
                    'click',
                    () => {
                        const selected =
                            button.dataset.statusFilter;


                        let visible =
                            0;


                        filters.forEach(
                            (filterButton) => {
                                filterButton.classList.toggle(
                                    'is-active',
                                    filterButton ===
                                        button
                                );
                            }
                        );


                        rows.forEach(
                            (row) => {
                                const matches =
                                    selected ===
                                        'all' ||
                                    row.dataset.assetStatus ===
                                        selected;


                                row.hidden =
                                    !matches;


                                if (
                                    matches
                                ) {
                                    visible +=
                                        1;
                                }
                            }
                        );


                        if (
                            visibleCount
                        ) {
                            visibleCount.textContent =
                                String(
                                    visible
                                );
                        }


                        if (
                            empty
                        ) {
                            empty.hidden =
                                visible !==
                                0;
                        }
                    }
                );
            }
        );


        printButton?.addEventListener(
            'click',
            () => {
                window.print();
            }
        );
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeInventoryReport,
            {
                once: true
            }
        );
    } else {
        initializeInventoryReport();
    }
})();
</script>
@endpush