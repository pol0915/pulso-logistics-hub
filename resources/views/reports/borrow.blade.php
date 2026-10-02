@extends('layouts.app')

@section('title', 'Borrow & Return Report | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | CURRENT BORROWING RECORDS
    |--------------------------------------------------------------------------
    */

    $borrowRecords = [
        [
            'id' => 'BRW-2026-0028',
            'request_id' => 'REQ-2026-0047',

            'borrower' => 'Maria Santos',
            'committee' => 'Events Committee',
            'activity' => 'Youth Leadership Summit',

            'released' => 'Sep 12, 2026 · 7:15 AM',
            'due' => 'Sep 12, 2026 · 6:00 PM',
            'due_date' => '2026-09-12',

            'status' => 'Due Soon',

            'items' => [
                [
                    'asset_id' => 'PULSO-AUD-001',
                    'name' => 'Portable Sound System',
                    'category' => 'Audio',
                    'quantity' => 1,
                    'opening_returned' => 0,
                ],
                [
                    'asset_id' => 'PULSO-EQP-001',
                    'name' => 'Projector',
                    'category' => 'Equipment',
                    'quantity' => 1,
                    'opening_returned' => 0,
                ],
                [
                    'asset_id' => 'PULSO-FUR-001',
                    'name' => 'Monoblock Chairs',
                    'category' => 'Furniture',
                    'quantity' => 60,
                    'opening_returned' => 0,
                ],
            ],
        ],

        [
            'id' => 'BRW-2026-0027',
            'request_id' => 'REQ-2026-0045',

            'borrower' => 'Angela Cruz',
            'committee' => 'Environment & Health',
            'activity' => 'Coastal Clean-Up Drive',

            'released' => 'Sep 10, 2026 · 8:30 AM',
            'due' => 'Sep 10, 2026 · 5:30 PM',
            'due_date' => '2026-09-10',

            'status' => 'Overdue',

            'items' => [
                [
                    'asset_id' => 'PULSO-EVT-001',
                    'name' => 'Large Event Tent',
                    'category' => 'Event Materials',
                    'quantity' => 2,
                    'opening_returned' => 0,
                ],
                [
                    'asset_id' => 'PULSO-ELE-001',
                    'name' => 'Extension Cord 20m',
                    'category' => 'Electrical',
                    'quantity' => 3,
                    'opening_returned' => 0,
                ],
            ],
        ],

        [
            'id' => 'BRW-2026-0026',
            'request_id' => 'REQ-2026-0046',

            'borrower' => 'Joshua Reyes',
            'committee' => 'Community Outreach',
            'activity' => 'Medical Mission',

            'released' => 'Sep 11, 2026 · 9:10 AM',
            'due' => 'Sep 13, 2026 · 6:00 PM',
            'due_date' => '2026-09-13',

            'status' => 'Borrowed',

            'items' => [
                [
                    'asset_id' => 'PULSO-FUR-002',
                    'name' => 'Folding Tables',
                    'category' => 'Furniture',
                    'quantity' => 8,
                    'opening_returned' => 0,
                ],
                [
                    'asset_id' => 'PULSO-ELE-002',
                    'name' => 'Power Strip',
                    'category' => 'Electrical',
                    'quantity' => 4,
                    'opening_returned' => 0,
                ],
            ],
        ],

        [
            'id' => 'BRW-2026-0025',
            'request_id' => 'REQ-2026-0041',

            'borrower' => 'Nicole Ramos',
            'committee' => 'Volunteer Management',
            'activity' => 'PULSO Volunteer Orientation',

            'released' => 'Sep 7, 2026 · 8:20 AM',
            'due' => 'Sep 7, 2026 · 5:00 PM',
            'due_date' => '2026-09-07',

            'status' => 'Returned',

            'items' => [
                [
                    'asset_id' => 'PULSO-AUD-002',
                    'name' => 'Wireless Microphone Set',
                    'category' => 'Audio',
                    'quantity' => 1,
                    'opening_returned' => 1,
                ],
                [
                    'asset_id' => 'PULSO-EVT-002',
                    'name' => 'PULSO Event Banner',
                    'category' => 'Event Materials',
                    'quantity' => 2,
                    'opening_returned' => 2,
                ],
            ],
        ],

        [
            'id' => 'BRW-2026-0024',
            'request_id' => 'REQ-2026-0040',

            'borrower' => 'Carlo Mendoza',
            'committee' => 'Education Committee',
            'activity' => 'Student Assistance Orientation',

            'released' => 'Sep 6, 2026 · 8:45 AM',
            'due' => 'Sep 6, 2026 · 4:30 PM',
            'due_date' => '2026-09-06',

            'status' => 'Returned',

            'items' => [
                [
                    'asset_id' => 'PULSO-EQP-001',
                    'name' => 'Projector',
                    'category' => 'Equipment',
                    'quantity' => 1,
                    'opening_returned' => 1,
                ],
            ],
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | CURRENT SUMMARY
    |--------------------------------------------------------------------------
    */

    $summary = [
        [
            'key' => 'total',
            'label' => 'Total Borrowings',
            'value' => 5,
            'helper' => 'Current borrowing records',
            'tone' => 'navy',
            'icon' => 'borrow',
        ],
        [
            'key' => 'active',
            'label' => 'Active Borrowings',
            'value' => 3,
            'helper' => 'Resources still outside',
            'tone' => 'pink',
            'icon' => 'active',
        ],
        [
            'key' => 'returned',
            'label' => 'Returned',
            'value' => 2,
            'helper' => 'Fully returned records',
            'tone' => 'teal',
            'icon' => 'returned',
        ],
        [
            'key' => 'due-soon',
            'label' => 'Due Soon',
            'value' => 1,
            'helper' => 'Due on preview date',
            'tone' => 'gold',
            'icon' => 'due',
        ],
        [
            'key' => 'overdue',
            'label' => 'Overdue',
            'value' => 1,
            'helper' => 'Needs immediate follow-up',
            'tone' => 'red',
            'icon' => 'overdue',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | CURRENT STATUS DATA
    |--------------------------------------------------------------------------
    */

    $statusData = [
        [
            'key' => 'borrowed',
            'label' => 'Borrowed',
            'value' => 1,
            'tone' => 'pink',
        ],
        [
            'key' => 'returned',
            'label' => 'Returned',
            'value' => 2,
            'tone' => 'teal',
        ],
        [
            'key' => 'due-soon',
            'label' => 'Due Soon',
            'value' => 1,
            'tone' => 'gold',
        ],
        [
            'key' => 'overdue',
            'label' => 'Overdue',
            'value' => 1,
            'tone' => 'red',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | RESOURCE CATEGORY USAGE
    |--------------------------------------------------------------------------
    |
    | Based on borrowed units across the five current records.
    |
    */

    $categoryData = [
        [
            'label' => 'Furniture',
            'value' => 68,
        ],
        [
            'label' => 'Electrical',
            'value' => 7,
        ],
        [
            'label' => 'Event Materials',
            'value' => 4,
        ],
        [
            'label' => 'Audio',
            'value' => 2,
        ],
        [
            'label' => 'Equipment',
            'value' => 2,
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | HISTORICAL MONTHLY ACTIVITY
    |--------------------------------------------------------------------------
    */

    $monthlyBorrowings = [
        [
            'month' => 'Apr',
            'borrowings' => 6,
            'returns' => 5,
        ],
        [
            'month' => 'May',
            'borrowings' => 8,
            'returns' => 7,
        ],
        [
            'month' => 'Jun',
            'borrowings' => 7,
            'returns' => 6,
        ],
        [
            'month' => 'Jul',
            'borrowings' => 10,
            'returns' => 9,
        ],
        [
            'month' => 'Aug',
            'borrowings' => 12,
            'returns' => 10,
        ],
        [
            'month' => 'Sep',
            'borrowings' => 9,
            'returns' => 8,
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | COMPUTED VALUES
    |--------------------------------------------------------------------------
    */

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


    $maxMonthly = max(
        array_map(
            fn ($item) => max(
                $item['borrowings'],
                $item['returns']
            ),
            $monthlyBorrowings
        )
    );


    $returnRate = round(
        (2 / 5) * 100,
        1
    );


    $activeRate = round(
        (3 / 5) * 100,
        1
    );


    $attentionRate = round(
        (2 / 5) * 100,
        1
    );
@endphp


@push('styles')
<style>
    /* ================================================================
       BORROW REPORT
       ================================================================ */

    .borrow-report {
        --br-navy: #10263d;
        --br-text: #31546d;
        --br-muted: #688297;

        --br-teal: #007780;
        --br-pink: #b90c61;
        --br-gold: #895408;
        --br-red: #ad343d;
        --br-blue: #245b99;

        --br-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--br-navy);

        container-name: borrow-report;
        container-type: inline-size;
    }


    .borrow-report *,
    .borrow-report *::before,
    .borrow-report *::after {
        box-sizing: border-box;
    }


    .borrow-report [hidden] {
        display: none !important;
    }


    .br-heading,
    .br-actions,
    .br-section-heading,
    .br-section-title,
    .br-filter-row,
    .br-status-head,
    .br-table-footer,
    .br-performance-head {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADER
       ================================================================ */

    .br-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .br-heading-copy {
        min-width: 0;
    }


    .br-eyebrow {
        margin: 0 0 7px;

        color: var(--br-teal);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .br-heading h1 {
        margin: 0;

        color: var(--br-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .br-description {
        max-width: 790px;

        margin: 9px 0 0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .br-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .br-button {
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
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }


    .br-button:hover {
        color: var(--br-teal);

        transform: translateY(-1px);
    }


    .br-button-primary {
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


    .br-button-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    .br-button svg {
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
       PREVIOUS VISUAL STYLE
       ================================================================ */

    .borrow-report > .br-summary-grid {
        display: grid !important;

        grid-template-columns:
            repeat(
                5,
                minmax(0, 1fr)
            );

        gap: 12px;

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


    .borrow-report > .br-summary-grid::before,
    .borrow-report > .br-summary-grid::after {
        display: none !important;

        width: 0 !important;
        height: 0 !important;

        border: 0 !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .br-summary {
        --br-accent: #173b59;

        --br-icon-bg:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );

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
    }


    .br-summary::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 32px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--br-accent);

        opacity: .5;

        content: "";
    }


    .br-summary[data-tone="navy"] {
        --br-accent: #173b59;

        --br-icon-bg:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .br-summary[data-tone="pink"] {
        --br-accent: #b90c61;

        --br-icon-bg:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .br-summary[data-tone="teal"] {
        --br-accent: #007780;

        --br-icon-bg:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .br-summary[data-tone="gold"] {
        --br-accent: #895408;

        --br-icon-bg:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }


    .br-summary[data-tone="red"] {
        --br-accent: #ad343d;

        --br-icon-bg:
            linear-gradient(
                145deg,
                #fdecef,
                #f4dadd
            );
    }


    .br-summary-icon {
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

        background: var(--br-icon-bg);

        color: var(--br-accent);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .br-summary-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .br-summary-copy {
        min-width: 0;
    }


    .br-summary-value {
        display: block;

        color: var(--br-accent);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .br-summary-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .br-summary-helper {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       REPORT CARDS
       ================================================================ */

    .br-card {
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


    .br-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding: 20px 22px;

        border-bottom:
            1px
            solid
            var(--br-line);
    }


    .br-section-title {
        gap: 12px;

        min-width: 0;
    }


    .br-number {
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

        color: var(--br-teal);

        font-size: 13px;
        font-weight: 850;
    }


    .br-number.pink {
        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--br-pink);
    }


    .br-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .br-section-title p {
        margin: 5px 0 0;

        color: #496580;

        font-size: 11px;
        line-height: 1.55;
    }


    .br-source {
        flex-shrink: 0;

        padding: 7px 10px;

        border:
            1px
            solid
            rgba(255, 255, 255, .86);

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
       PRIMARY ANALYTICS
       ================================================================ */

    .br-analytics {
        display: grid;

        grid-template-columns:
            minmax(0, 1.15fr)
            minmax(0, .85fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .br-analytics .br-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       BORROWING ACTIVITY CHART
       ================================================================ */

    .br-chart {
        display: grid;

        grid-template-columns:
            36px
            minmax(0, 1fr);

        gap: 10px;

        min-height: 268px;

        padding:
            20px
            22px
            10px;
    }


    .br-y-axis {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        padding-bottom: 25px;

        color: #71899c;

        font-size: 8.5px;

        text-align: right;
    }


    .br-plot {
        height: 215px;

        border-bottom:
            1px
            solid
            #cfe0e8;

        background-image:
            linear-gradient(
                to bottom,
                rgba(207, 224, 232, .3) 1px,
                transparent 1px
            );

        background-size:
            100%
            25%;
    }


    .br-bars {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        align-items: end;

        gap: 16px;

        height: 100%;

        padding:
            10px
            6px
            0;
    }


    .br-bar-group {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(5px, 1fr)
            );

        align-items: end;

        gap: 4px;

        height: 100%;
    }


    .br-bar {
        min-height: 5px;

        border-radius:
            6px
            6px
            2px
            2px;
    }


    .br-bar.borrowed {
        background:
            linear-gradient(
                180deg,
                #ee1280,
                #b90c61
            );
    }


    .br-bar.returned {
        background:
            linear-gradient(
                180deg,
                #05adb6,
                #007780
            );
    }


    .br-x-axis {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 16px;

        padding:
            8px
            6px
            0;

        color: #71899c;

        font-size: 9px;

        text-align: center;
    }


    .br-chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 20px;

        padding:
            0
            22px
            20px;
    }


    .br-legend-item {
        display: flex;
        align-items: center;

        gap: 7px;

        color: #496580;

        font-size: 9px;
        font-weight: 700;
    }


    .br-legend-dot {
        width: 8px;
        height: 8px;

        border-radius: 50%;
    }


    .br-legend-dot.pink {
        background: #ee1280;
    }


    .br-legend-dot.teal {
        background: #05adb6;
    }


    /* ================================================================
       STATUS
       ================================================================ */

    .br-status-list {
        display: grid;
        align-content: center;

        min-height: 312px;

        gap: 16px;

        padding: 22px;
    }


    .br-status-row {
        width: 100%;
    }


    .br-status-head {
        justify-content: space-between;

        gap: 15px;
    }


    .br-status-left {
        display: flex;
        align-items: center;

        gap: 8px;

        min-width: 0;
    }


    .br-dot {
        width: 9px;
        height: 9px;

        flex: 0 0 9px;

        border-radius: 50%;
    }


    .br-dot.pink {
        background: #ee1280;
    }


    .br-dot.teal {
        background: #05adb6;
    }


    .br-dot.gold {
        background: #c9a94c;
    }


    .br-dot.red {
        background: #ad343d;
    }


    .br-status-label {
        color: #31546d;

        font-size: 10px;
        font-weight: 700;
    }


    .br-status-value {
        color: #10263d;

        font-size: 10px;
        font-weight: 850;

        font-variant-numeric: tabular-nums;
    }


    .br-status-track {
        width: 100%;
        height: 7px;

        margin-top: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .12);
    }


    .br-status-fill {
        height: 100%;

        border-radius: inherit;
    }


    .br-status-fill.pink {
        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .br-status-fill.teal {
        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .br-status-fill.gold {
        background:
            linear-gradient(
                90deg,
                #e1c96f,
                #92701d
            );
    }


    .br-status-fill.red {
        background:
            linear-gradient(
                90deg,
                #db7279,
                #ad343d
            );
    }


    /* ================================================================
       SECONDARY ANALYTICS
       ================================================================ */

    .br-two-column {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr)
            minmax(0, 1fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .br-two-column .br-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       EQUIPMENT USAGE
       ================================================================ */

    .br-category-list {
        display: grid;
        align-content: center;

        min-height: 275px;

        gap: 17px;

        padding: 22px;
    }


    .br-category-row {
        display: grid;

        grid-template-columns:
            112px
            minmax(0, 1fr)
            38px;

        align-items: center;

        gap: 10px;
    }


    .br-category-label {
        color: #31546d;

        font-size: 9.5px;
        font-weight: 700;
    }


    .br-category-track {
        width: 100%;
        height: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .12);
    }


    .br-category-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .br-category-value {
        color: #10263d;

        font-size: 10px;
        font-weight: 850;

        text-align: right;
    }


    /* ================================================================
       ATTENTION MONITORING
       ================================================================ */

    .br-alert-list {
        display: grid;
        align-content: center;

        min-height: 275px;

        gap: 10px;

        padding: 18px 22px;
    }


    .br-alert {
        padding:
            11px
            13px;

        border:
            1px
            solid
            #efd7e1;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #fffafd,
                #f8edf2
            );
    }


    .br-alert.overdue {
        border-color: #efc8cc;

        background:
            linear-gradient(
                145deg,
                #fffafa,
                #f9e9eb
            );
    }


    .br-alert-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;
    }


    .br-alert-title {
        color: #17344e;

        font-size: 10.5px;
        font-weight: 800;
    }


    .br-alert-badge {
        display: inline-flex;
        align-items: center;

        min-height: 22px;

        padding:
            4px
            7px;

        border-radius: 8px;

        font-size: 8px;
        font-weight: 800;

        white-space: nowrap;
    }


    .br-alert-badge.due {
        background: #fff0d7;

        color: #895408;
    }


    .br-alert-badge.overdue {
        background: #fde5e8;

        color: #ad343d;
    }


    .br-alert-text {
        margin: 4px 0 0;

        color: #688297;

        font-size: 8.8px;
        line-height: 1.5;
    }


    .br-alert-empty {
        display: grid;
        place-items: center;

        min-height: 170px;

        color: #71899c;

        font-size: 10px;

        text-align: center;
    }


    /* ================================================================
       PERFORMANCE
       ================================================================ */

    .br-performance {
        display: grid;

        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );

        gap: 12px;

        padding: 22px;
    }


    .br-performance-item {
        min-width: 0;

        padding: 14px;

        border:
            1px
            solid
            rgba(255, 255, 255, .85);

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e5f0f4
            );

        box-shadow:
            inset 2px 2px 5px rgba(84, 118, 139, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .64);
    }


    .br-performance-head {
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 8px;
    }


    .br-performance-label {
        color: #31546d;

        font-size: 9px;
        font-weight: 750;
    }


    .br-performance-value {
        color: #10263d;

        font-size: 10px;
        font-weight: 850;
    }


    .br-performance-track {
        width: 100%;
        height: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .12);
    }


    .br-performance-fill {
        height: 100%;

        border-radius: inherit;
    }


    .br-performance-fill.teal {
        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .br-performance-fill.pink {
        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .br-performance-fill.gold {
        background:
            linear-gradient(
                90deg,
                #e1c96f,
                #92701d
            );
    }


    /* ================================================================
       TABLE TOOLBAR
       ================================================================ */

    .br-table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        padding:
            15px
            22px;

        border-bottom:
            1px
            solid
            var(--br-line);

        background:
            rgba(
                234,
                244,
                248,
                .35
            );
    }


    .br-filter-row {
        flex-wrap: wrap;

        gap: 7px;
    }


    .br-filter {
        min-height: 34px;

        padding:
            7px
            10px;

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
            color 150ms ease,
            background 150ms ease;
    }


    .br-filter:hover {
        border-color: #a8d8de;

        color: var(--br-teal);
    }


    .br-filter.is-active {
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

        color: var(--br-teal);

        box-shadow:
            inset 2px 2px 4px rgba(70, 111, 130, .06);
    }


    .br-search {
        width: 230px;
        min-height: 38px;

        padding:
            8px
            12px;

        border:
            1px
            solid
            #d0e1e9;

        border-radius: 11px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e8f1f6,
                #edf5f9
            );

        color: #10263d;

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .12),
            inset -3px -3px 7px rgba(255, 255, 255, .85);

        font: inherit;
        font-size: 10px;
    }


    .br-search:focus {
        border-color:
            rgba(
                0,
                126,
                137,
                .48
            );

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .11),
            inset -3px -3px 7px rgba(255, 255, 255, .85),
            0 0 0 3px rgba(5, 173, 182, .08);
    }


    .br-search::placeholder {
        color: #8195a5;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .br-table-wrap {
        width: 100%;

        overflow-x: auto;
    }


    .br-table {
        width: 100%;
        min-width: 1240px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .br-table th {
        padding:
            12px
            14px;

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


    .br-table td {
        padding:
            13px
            14px;

        border-bottom:
            1px
            solid
            rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 10px;
        line-height: 1.5;

        vertical-align: middle;
    }


    .br-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .br-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .4
            );
    }


    .br-record-id {
        display: block;

        color: #007780;

        font-size: 9.5px;
        font-weight: 800;

        white-space: nowrap;
    }


    .br-record-name {
        display: block;

        max-width: 200px;

        margin-top: 3px;

        color: #18344c;

        font-size: 10.5px;
        font-weight: 750;
        line-height: 1.4;
    }


    .br-sub {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.4;
    }


    .br-units {
        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    /* ================================================================
       BADGES
       ================================================================ */

    .br-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 26px;

        padding:
            4px
            8px;

        border:
            1px
            solid
            rgba(255, 255, 255, .8);

        border-radius: 8px;

        font-size: 8.5px;
        font-weight: 800;

        white-space: nowrap;
    }


    .br-badge.pink {
        background: #f8e0eb;

        color: #b90c61;
    }


    .br-badge.teal {
        background: #dff4f4;

        color: #007780;
    }


    .br-badge.gold {
        background: #fff0d7;

        color: #895408;
    }


    .br-badge.red {
        background: #fde5e8;

        color: #ad343d;
    }


    /* ================================================================
       EMPTY STATE
       ================================================================ */

    .br-empty {
        padding:
            40px
            22px;

        text-align: center;
    }


    .br-empty strong {
        display: block;

        color: #173b59;

        font-size: 14px;
    }


    .br-empty p {
        margin:
            6px
            0
            0;

        color: #688297;

        font-size: 10px;
    }


    /* ================================================================
       TABLE FOOTER
       ================================================================ */

    .br-table-footer {
        justify-content: space-between;

        flex-wrap: wrap;

        gap:
            8px
            15px;

        padding:
            14px
            22px;

        border-top:
            1px
            solid
            var(--br-line);
    }


    .br-table-footer p {
        margin: 0;

        color: #496580;

        font-size: 9.5px;
    }


    .br-table-footer strong {
        color: #10263d;
    }


    .br-note {
        margin:
            4px
            0
            0;

        color: #71899c;

        font-size: 10px;
        line-height: 1.65;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container borrow-report (max-width: 930px) {
        .borrow-report > .br-summary-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }
    }


    @container borrow-report (max-width: 820px) {
        .br-analytics,
        .br-two-column {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .br-table-toolbar {
            align-items: flex-start;

            flex-direction: column;
        }


        .br-search {
            width: 100%;
        }


        .br-performance {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @container borrow-report (max-width: 650px) {
        .br-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .br-actions {
            width: 100%;
        }


        .br-actions .br-button {
            flex: 1;
        }


        .borrow-report > .br-summary-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .br-section-heading {
            align-items: flex-start;
        }


        .br-source {
            display: none;
        }


        .br-chart {
            grid-template-columns:
                31px
                minmax(0, 1fr);

            padding:
                17px
                16px
                10px;
        }


        .br-bars,
        .br-x-axis {
            gap: 8px;
        }


        .br-category-row {
            grid-template-columns:
                98px
                minmax(0, 1fr)
                32px;
        }
    }


    @container borrow-report (max-width: 450px) {
        .borrow-report > .br-summary-grid {
            grid-template-columns:
                minmax(0, 1fr);
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


        body:has(#borrow-report) #app-sidebar,
        body:has(#borrow-report) #sidebar-backdrop,
        body:has(#borrow-report) #pulso-topbar,
        body:has(#borrow-report) .hub-skip-link,
        .borrow-report .br-no-print {
            display: none !important;
        }


        body:has(#borrow-report) #app-main {
            padding-left: 0 !important;
        }


        body:has(#borrow-report) .hub-content {
            padding: 0 !important;
        }


        .borrow-report {
            container-type: normal;
        }


        .borrow-report > .br-summary-grid {
            grid-template-columns:
                repeat(
                    5,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .br-summary {
            min-height: auto;

            padding: 9px;
        }


        .br-summary-icon {
            display: none;
        }


        .br-summary,
        .br-card,
        .br-alert,
        .br-performance-item {
            border:
                1px
                solid
                #d6d6d6 !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .br-summary,
        .br-card {
            break-inside: avoid;
        }


        .br-analytics {
            grid-template-columns:
                1.15fr
                .85fr;

            gap: 10px;
        }


        .br-two-column {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            gap: 10px;
        }


        .br-performance {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .br-table {
            min-width: 0;

            table-layout: fixed;
        }


        .br-table th,
        .br-table td {
            padding:
                7px
                5px;

            overflow-wrap: anywhere;
        }


        .br-table thead {
            display: table-header-group;
        }


        .br-table tr {
            break-inside: avoid;
        }


        .br-badge {
            white-space: normal;
        }
    }
</style>
@endpush


@section('content')
<div
    class="borrow-report"
    id="borrow-report"
>

    {{-- =============================================================
         HEADER
         ============================================================= --}}

    <header class="br-heading">

        <div class="br-heading-copy">

            <p class="br-eyebrow">
                Borrowing analytics
            </p>

            <h1>
                Borrow &amp; Return Report
            </h1>

            <p class="br-description">
                Monitor released reusable resources, active custody,
                return progress, due dates, overdue borrowing records,
                and equipment usage across PULSO activities.
            </p>

        </div>


        <div class="br-actions br-no-print">

            <a
                class="br-button"
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
                    br-button
                    br-button-primary
                "
                id="br-print"
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


    {{-- =============================================================
         KPI SUMMARY
         ============================================================= --}}

    <section
        class="br-summary-grid"
        aria-label="Borrow and return summary"
    >

        @foreach ($summary as $stat)

            <article
                class="br-summary"
                data-tone="{{ $stat['tone'] }}"
            >

                <span
                    class="br-summary-icon"
                    aria-hidden="true"
                >

                    @if ($stat['icon'] === 'borrow')

                        <svg viewBox="0 0 24 24">
                            <path d="M4 7h15"/>
                            <path d="m15 3 4 4-4 4"/>
                            <path d="M20 17H5"/>
                            <path d="m9 13-4 4 4 4"/>
                        </svg>

                    @elseif ($stat['icon'] === 'active')

                        <svg viewBox="0 0 24 24">
                            <path d="M4 8h12"/>
                            <path d="m13 5 3 3-3 3"/>
                            <path d="M4 16h5"/>
                            <path d="M12 16h8"/>
                        </svg>

                    @elseif ($stat['icon'] === 'returned')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                    @elseif ($stat['icon'] === 'due')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 7v5"/>
                            <path d="m12 12 3 2"/>
                        </svg>

                    @else

                        <svg viewBox="0 0 24 24">
                            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>

                    @endif

                </span>


                <div class="br-summary-copy">

                    <strong
                        class="br-summary-value"
                        data-kpi="{{ $stat['key'] }}"
                    >
                        {{ number_format($stat['value']) }}
                    </strong>

                    <span class="br-summary-label">
                        {{ $stat['label'] }}
                    </span>

                    <span class="br-summary-helper">
                        {{ $stat['helper'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         01 ACTIVITY + 02 STATUS
         ============================================================= --}}

    <div class="br-analytics">

        <section class="br-card">

            <header class="br-section-heading">

                <div class="br-section-title">

                    <span class="br-number">
                        01
                    </span>

                    <div>
                        <h2>
                            Borrowing Activity
                        </h2>

                        <p>
                            Historical borrowing and return volume.
                        </p>
                    </div>

                </div>


                <span class="br-source">
                    Apr – Sep 2026
                </span>

            </header>


            <div class="br-chart">

                <div
                    class="br-y-axis"
                    aria-hidden="true"
                >

                    <span>
                        {{ $maxMonthly }}
                    </span>

                    <span>
                        {{ round($maxMonthly * .75) }}
                    </span>

                    <span>
                        {{ round($maxMonthly * .5) }}
                    </span>

                    <span>
                        {{ round($maxMonthly * .25) }}
                    </span>

                    <span>
                        0
                    </span>

                </div>


                <div>

                    <div class="br-plot">

                        <div class="br-bars">

                            @foreach ($monthlyBorrowings as $month)

                                <div
                                    class="br-bar-group"
                                    title="{{ $month['month'] }}: {{ $month['borrowings'] }} borrowings, {{ $month['returns'] }} returns"
                                >

                                    <div
                                        class="
                                            br-bar
                                            borrowed
                                        "
                                        style="
                                            height:
                                            {{
                                                max(
                                                    2,
                                                    ($month['borrowings'] / $maxMonthly) * 100
                                                )
                                            }}%;
                                        "
                                    ></div>


                                    <div
                                        class="
                                            br-bar
                                            returned
                                        "
                                        style="
                                            height:
                                            {{
                                                max(
                                                    2,
                                                    ($month['returns'] / $maxMonthly) * 100
                                                )
                                            }}%;
                                        "
                                    ></div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    <div class="br-x-axis">

                        @foreach ($monthlyBorrowings as $month)

                            <span>
                                {{ $month['month'] }}
                            </span>

                        @endforeach

                    </div>

                </div>

            </div>


            <div class="br-chart-legend">

                <span class="br-legend-item">

                    <span class="br-legend-dot pink"></span>

                    Borrowings

                </span>


                <span class="br-legend-item">

                    <span class="br-legend-dot teal"></span>

                    Returns

                </span>

            </div>

        </section>


        <section class="br-card">

            <header class="br-section-heading">

                <div class="br-section-title">

                    <span class="br-number pink">
                        02
                    </span>

                    <div>
                        <h2>
                            Borrowing Status
                        </h2>

                        <p>
                            Current state of the borrowing register.
                        </p>
                    </div>

                </div>


                <span class="br-source">
                    <span id="br-status-total">
                        {{ $statusTotal }}
                    </span>

                    Records
                </span>

            </header>


            <div class="br-status-list">

                @foreach ($statusData as $status)

                    @php
                        $percentage = round(
                            (
                                $status['value']
                                /
                                $statusTotal
                            ) * 100,
                            1
                        );
                    @endphp


                    <div
                        class="br-status-row"
                        data-status-summary="{{ $status['key'] }}"
                    >

                        <div class="br-status-head">

                            <span class="br-status-left">

                                <span
                                    class="
                                        br-dot
                                        {{ $status['tone'] }}
                                    "
                                ></span>


                                <span class="br-status-label">
                                    {{ $status['label'] }}
                                </span>

                            </span>


                            <strong
                                class="br-status-value"
                                data-status-value
                            >
                                {{ $status['value'] }}
                                ·
                                {{ $percentage }}%
                            </strong>

                        </div>


                        <div class="br-status-track">

                            <div
                                class="
                                    br-status-fill
                                    {{ $status['tone'] }}
                                "
                                data-status-fill
                                style="
                                    width:
                                    {{ $percentage }}%;
                                "
                            ></div>

                        </div>

                    </div>

                @endforeach

            </div>

        </section>

    </div>


    {{-- =============================================================
         03 EQUIPMENT USAGE + 04 ATTENTION
         ============================================================= --}}

    <div class="br-two-column">

        <section class="br-card">

            <header class="br-section-heading">

                <div class="br-section-title">

                    <span class="br-number">
                        03
                    </span>

                    <div>
                        <h2>
                            Equipment Usage
                        </h2>

                        <p>
                            Borrowed units grouped by resource category.
                        </p>
                    </div>

                </div>


                <span class="br-source">
                    {{ $categoryTotal }}
                    Borrowed Units
                </span>

            </header>


            <div class="br-category-list">

                @foreach ($categoryData as $category)

                    @php
                        $percentage = round(
                            (
                                $category['value']
                                /
                                $categoryTotal
                            ) * 100,
                            1
                        );
                    @endphp


                    <div class="br-category-row">

                        <span class="br-category-label">
                            {{ $category['label'] }}
                        </span>


                        <div
                            class="br-category-track"
                            title="{{ $percentage }}%"
                        >

                            <div
                                class="br-category-fill"
                                style="
                                    width:
                                    {{ $percentage }}%;
                                "
                            ></div>

                        </div>


                        <strong class="br-category-value">
                            {{ $category['value'] }}
                        </strong>

                    </div>

                @endforeach

            </div>

        </section>


        <section class="br-card">

            <header class="br-section-heading">

                <div class="br-section-title">

                    <span class="br-number pink">
                        04
                    </span>

                    <div>
                        <h2>
                            Due &amp; Overdue Monitoring
                        </h2>

                        <p>
                            Active borrowings currently requiring follow-up.
                        </p>
                    </div>

                </div>


                <span class="br-source">

                    <span id="br-attention-count">
                        2
                    </span>

                    Attention Records

                </span>

            </header>


            <div
                class="br-alert-list"
                id="br-attention-list"
            >

                <article class="br-alert">

                    <div class="br-alert-top">

                        <span class="br-alert-title">
                            Youth Leadership Summit
                        </span>

                        <span
                            class="
                                br-alert-badge
                                due
                            "
                        >
                            DUE SOON
                        </span>

                    </div>


                    <p class="br-alert-text">
                        BRW-2026-0028 · Maria Santos ·
                        62 borrowed units due September 12, 2026.
                    </p>

                </article>


                <article class="br-alert overdue">

                    <div class="br-alert-top">

                        <span class="br-alert-title">
                            Coastal Clean-Up Drive
                        </span>

                        <span
                            class="
                                br-alert-badge
                                overdue
                            "
                        >
                            OVERDUE
                        </span>

                    </div>


                    <p class="br-alert-text">
                        BRW-2026-0027 · Angela Cruz ·
                        5 borrowed units were due September 10, 2026.
                    </p>

                </article>

            </div>

        </section>

    </div>


    {{-- =============================================================
         05 PERFORMANCE
         ============================================================= --}}

    <section class="br-card">

        <header class="br-section-heading">

            <div class="br-section-title">

                <span class="br-number">
                    05
                </span>

                <div>
                    <h2>
                        Borrowing Performance
                    </h2>

                    <p>
                        Current indicators based on the borrowing register.
                    </p>
                </div>

            </div>

        </header>


        <div class="br-performance">

            <article class="br-performance-item">

                <div class="br-performance-head">

                    <span class="br-performance-label">
                        Return Completion
                    </span>

                    <strong
                        class="br-performance-value"
                        id="br-return-rate"
                    >
                        {{ $returnRate }}%
                    </strong>

                </div>


                <div class="br-performance-track">

                    <div
                        class="
                            br-performance-fill
                            teal
                        "
                        id="br-return-fill"
                        style="
                            width:
                            {{ $returnRate }}%;
                        "
                    ></div>

                </div>

            </article>


            <article class="br-performance-item">

                <div class="br-performance-head">

                    <span class="br-performance-label">
                        Active Borrowings
                    </span>

                    <strong
                        class="br-performance-value"
                        id="br-active-rate"
                    >
                        {{ $activeRate }}%
                    </strong>

                </div>


                <div class="br-performance-track">

                    <div
                        class="
                            br-performance-fill
                            pink
                        "
                        id="br-active-fill"
                        style="
                            width:
                            {{ $activeRate }}%;
                        "
                    ></div>

                </div>

            </article>


            <article class="br-performance-item">

                <div class="br-performance-head">

                    <span class="br-performance-label">
                        Needs Follow-up
                    </span>

                    <strong
                        class="br-performance-value"
                        id="br-attention-rate"
                    >
                        {{ $attentionRate }}%
                    </strong>

                </div>


                <div class="br-performance-track">

                    <div
                        class="
                            br-performance-fill
                            gold
                        "
                        id="br-attention-fill"
                        style="
                            width:
                            {{ $attentionRate }}%;
                        "
                    ></div>

                </div>

            </article>

        </div>

    </section>


    {{-- =============================================================
         06 BORROWING REGISTER
         ============================================================= --}}

    <section class="br-card">

        <header class="br-section-heading">

            <div class="br-section-title">

                <span class="br-number pink">
                    06
                </span>

                <div>
                    <h2>
                        Borrow &amp; Return Records
                    </h2>

                    <p>
                        Search and filter current resource custody records.
                    </p>
                </div>

            </div>


            <span class="br-source">
                {{ count($borrowRecords) }}
                Current Records
            </span>

        </header>


        <div class="br-table-toolbar br-no-print">

            <div
                class="br-filter-row"
                role="group"
                aria-label="Borrow status filters"
            >

                <button
                    class="
                        br-filter
                        is-active
                    "
                    type="button"
                    data-status-filter="all"
                >
                    All
                </button>


                <button
                    class="br-filter"
                    type="button"
                    data-status-filter="Borrowed"
                >
                    Borrowed
                </button>


                <button
                    class="br-filter"
                    type="button"
                    data-status-filter="Returned"
                >
                    Returned
                </button>


                <button
                    class="br-filter"
                    type="button"
                    data-status-filter="Due Soon"
                >
                    Due Soon
                </button>


                <button
                    class="br-filter"
                    type="button"
                    data-status-filter="Overdue"
                >
                    Overdue
                </button>

            </div>


            <input
                class="br-search"
                id="br-search"
                type="search"
                placeholder="Search borrowing record..."
                autocomplete="off"
                aria-label="Search borrowing records"
            >

        </div>


        <div
            class="br-table-wrap custom-scrollbar"
            role="region"
            aria-label="Borrowing report table"
            tabindex="0"
        >

            <table class="br-table">

                <thead>
                    <tr>

                        <th scope="col">
                            Borrowing
                        </th>

                        <th scope="col">
                            Borrower
                        </th>

                        <th scope="col">
                            Activity
                        </th>

                        <th scope="col">
                            Borrowed Units
                        </th>

                        <th scope="col">
                            Returned
                        </th>

                        <th scope="col">
                            Remaining
                        </th>

                        <th scope="col">
                            Released
                        </th>

                        <th scope="col">
                            Due
                        </th>

                        <th scope="col">
                            Status
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @foreach ($borrowRecords as $record)

                        @php
                            $borrowedUnits = collect(
                                $record['items']
                            )->sum('quantity');

                            $returnedUnits = collect(
                                $record['items']
                            )->sum('opening_returned');

                            $remainingUnits =
                                $borrowedUnits
                                - $returnedUnits;

                            $resourceNames = collect(
                                $record['items']
                            )
                                ->pluck('name')
                                ->implode(', ');

                            $statusTone = match ($record['status']) {
                                'Borrowed' => 'pink',
                                'Returned' => 'teal',
                                'Due Soon' => 'gold',
                                'Overdue' => 'red',
                                default => 'pink',
                            };
                        @endphp


                        <tr
                            data-borrow-row
                            data-borrow-id="{{ $record['id'] }}"
                            data-status="{{ $record['status'] }}"
                            data-search="{{ strtolower(
                                $record['id']
                                . ' '
                                . $record['request_id']
                                . ' '
                                . $record['borrower']
                                . ' '
                                . $record['committee']
                                . ' '
                                . $record['activity']
                                . ' '
                                . $resourceNames
                                . ' '
                                . $record['status']
                            ) }}"
                        >

                            <td>

                                <span class="br-record-id">
                                    {{ $record['id'] }}
                                </span>

                                <span class="br-record-name">
                                    {{ $record['request_id'] }}
                                </span>

                                <span class="br-sub">
                                    {{ count($record['items']) }}

                                    {{ count($record['items']) === 1 ? 'resource type' : 'resource types' }}
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $record['borrower'] }}
                                </strong>

                                <span class="br-sub">
                                    {{ $record['committee'] }}
                                </span>

                            </td>


                            <td>

                                <strong class="br-record-name">
                                    {{ $record['activity'] }}
                                </strong>

                                <span class="br-sub">
                                    {{ $resourceNames }}
                                </span>

                            </td>


                            <td>

                                <strong class="br-units">
                                    {{ $borrowedUnits }}
                                </strong>

                            </td>


                            <td>

                                <strong
                                    class="br-units"
                                    data-returned-units
                                >
                                    {{ $returnedUnits }}
                                </strong>

                            </td>


                            <td>

                                <strong
                                    class="br-units"
                                    data-remaining-units
                                >
                                    {{ $remainingUnits }}
                                </strong>

                            </td>


                            <td>
                                {{ $record['released'] }}
                            </td>


                            <td>
                                {{ $record['due'] }}
                            </td>


                            <td>

                                <span
                                    class="
                                        br-badge
                                        {{ $statusTone }}
                                    "
                                    data-status-badge
                                >
                                    {{ $record['status'] }}
                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            <div
                class="br-empty"
                id="br-empty"
                hidden
            >

                <strong>
                    No borrowing records found
                </strong>

                <p>
                    Try another status filter or search keyword.
                </p>

            </div>

        </div>


        <footer class="br-table-footer">

            <p>
                Showing

                <strong id="br-visible-count">
                    {{ count($borrowRecords) }}
                </strong>

                of

                <strong>
                    {{ count($borrowRecords) }}
                </strong>

                borrowing records.
            </p>


            <p>
                Active:

                <strong id="br-footer-active">
                    3
                </strong>
            </p>


            <p>
                Returned:

                <strong id="br-footer-returned">
                    2
                </strong>
            </p>

        </footer>

    </section>


    <p class="br-note">
        Monthly activity remains historical sample analytics. Current
        KPIs, borrowing statuses, return progress, attention monitoring,
        and the register use the five current front-end borrowing records
        and synchronize with the shared Borrow &amp; Return preview state.
    </p>


    <script
        id="br-report-data"
        type="application/json"
    >@json($borrowRecords)</script>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeBorrowReport = () => {
        const page =
            document.getElementById(
                'borrow-report'
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


        /*
        |--------------------------------------------------------------------------
        | CONSTANTS
        |--------------------------------------------------------------------------
        */

        const ITEM_STATE_KEY =
            'pulso-borrow-item-returns-v1';


        const SNAPSHOT_DATE =
            '2026-09-12';


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        const dataElement =
            page.querySelector(
                '#br-report-data'
            );


        let records =
            [];


        try {
            records =
                JSON.parse(
                    dataElement?.textContent ||
                    '[]'
                );
        } catch (error) {
            records =
                [];
        }


        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const filters =
            Array.from(
                page.querySelectorAll(
                    '[data-status-filter]'
                )
            );


        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-borrow-row]'
                )
            );


        const rowMap =
            new Map(
                rows.map(
                    (row) => [
                        row.dataset.borrowId,
                        row
                    ]
                )
            );


        const search =
            page.querySelector(
                '#br-search'
            );


        const empty =
            page.querySelector(
                '#br-empty'
            );


        const visibleCount =
            page.querySelector(
                '#br-visible-count'
            );


        const printButton =
            page.querySelector(
                '#br-print'
            );


        const attentionList =
            page.querySelector(
                '#br-attention-list'
            );


        const attentionCount =
            page.querySelector(
                '#br-attention-count'
            );


        const statusTotal =
            page.querySelector(
                '#br-status-total'
            );


        const footerActive =
            page.querySelector(
                '#br-footer-active'
            );


        const footerReturned =
            page.querySelector(
                '#br-footer-returned'
            );


        let activeStatus =
            'all';


        /*
        |--------------------------------------------------------------------------
        | STORAGE
        |--------------------------------------------------------------------------
        */

        const loadItemState = () => {
            try {
                const parsed =
                    JSON.parse(
                        sessionStorage.getItem(
                            ITEM_STATE_KEY
                        ) ||
                        '{}'
                    );


                return (
                    parsed &&
                    typeof parsed ===
                        'object' &&
                    !Array.isArray(
                        parsed
                    )
                )
                    ? parsed
                    : {};
            } catch (error) {
                return {};
            }
        };


        /*
        |--------------------------------------------------------------------------
        | RECORD STATS
        |--------------------------------------------------------------------------
        */

        const getRecordEvents = (
            state,
            recordId
        ) => {
            const events =
                state[recordId];


            return Array.isArray(
                events
            )
                ? events
                : [];
        };


        const getRecordStats = (
            record,
            state
        ) => {
            const events =
                getRecordEvents(
                    state,
                    record.id
                );


            let borrowed =
                0;


            let returned =
                0;


            record.items.forEach(
                (item) => {
                    const quantity =
                        Number(
                            item.quantity
                        ) || 0;


                    const openingReturned =
                        Number(
                            item.opening_returned
                        ) || 0;


                    const userReturned =
                        events
                            .filter(
                                (event) =>
                                    event.asset_id ===
                                    item.asset_id
                            )
                            .reduce(
                                (
                                    total,
                                    event
                                ) =>
                                    total +
                                    (
                                        Number(
                                            event.quantity
                                        ) || 0
                                    ),
                                0
                            );


                    borrowed +=
                        quantity;


                    returned +=
                        Math.min(
                            quantity,
                            openingReturned +
                                userReturned
                        );
                }
            );


            returned =
                Math.min(
                    borrowed,
                    returned
                );


            const remaining =
                Math.max(
                    0,
                    borrowed -
                        returned
                );


            let status =
                'Borrowed';


            if (
                remaining ===
                0
            ) {
                status =
                    'Returned';
            } else if (
                record.due_date <
                SNAPSHOT_DATE
            ) {
                status =
                    'Overdue';
            } else if (
                record.due_date ===
                SNAPSHOT_DATE
            ) {
                status =
                    'Due Soon';
            }


            return {
                borrowed,
                returned,
                remaining,
                status
            };
        };


        /*
        |--------------------------------------------------------------------------
        | STATUS APPEARANCE
        |--------------------------------------------------------------------------
        */

        const statusTone = (
            status
        ) => {
            switch (
                status
            ) {
                case 'Returned':
                    return 'teal';

                case 'Due Soon':
                    return 'gold';

                case 'Overdue':
                    return 'red';

                default:
                    return 'pink';
            }
        };


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        const setKpi = (
            key,
            value
        ) => {
            const element =
                page.querySelector(
                    `[data-kpi="${key}"]`
                );


            if (
                element
            ) {
                element.textContent =
                    String(
                        value
                    );
            }
        };


        const setPerformance = (
            valueElement,
            fillElement,
            percentage
        ) => {
            if (
                valueElement
            ) {
                valueElement.textContent =
                    `${percentage}%`;
            }


            if (
                fillElement
            ) {
                fillElement.style.width =
                    `${percentage}%`;
            }
        };


        /*
        |--------------------------------------------------------------------------
        | STATUS BREAKDOWN
        |--------------------------------------------------------------------------
        */

        const refreshStatusSummary = (
            counts
        ) => {
            const total =
                counts.total;


            const map = {
                borrowed:
                    counts.borrowed,

                returned:
                    counts.returned,

                'due-soon':
                    counts.dueSoon,

                overdue:
                    counts.overdue
            };


            Object.entries(
                map
            ).forEach(
                ([key, value]) => {
                    const row =
                        page.querySelector(
                            `[data-status-summary="${key}"]`
                        );


                    if (
                        !row
                    ) {
                        return;
                    }


                    const percentage =
                        total > 0
                            ? (
                                (
                                    value /
                                    total
                                ) *
                                100
                            ).toFixed(
                                1
                            )
                            : '0.0';


                    const valueElement =
                        row.querySelector(
                            '[data-status-value]'
                        );


                    const fill =
                        row.querySelector(
                            '[data-status-fill]'
                        );


                    if (
                        valueElement
                    ) {
                        valueElement.textContent =
                            `${value} · ${percentage}%`;
                    }


                    if (
                        fill
                    ) {
                        fill.style.width =
                            `${percentage}%`;
                    }
                }
            );


            if (
                statusTotal
            ) {
                statusTotal.textContent =
                    String(
                        total
                    );
            }
        };


        /*
        |--------------------------------------------------------------------------
        | ATTENTION LIST
        |--------------------------------------------------------------------------
        */

        const formatDueDate = (
            value
        ) => {
            const date =
                new Date(
                    `${value}T00:00:00`
                );


            if (
                Number.isNaN(
                    date.getTime()
                )
            ) {
                return value;
            }


            return new Intl.DateTimeFormat(
                'en-US',
                {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                }
            ).format(
                date
            );
        };


        const refreshAttentionList = (
            calculatedRecords
        ) => {
            if (
                !attentionList
            ) {
                return;
            }


            const attention =
                calculatedRecords.filter(
                    (item) =>
                        item.stats.status ===
                            'Due Soon' ||
                        item.stats.status ===
                            'Overdue'
                );


            if (
                attentionCount
            ) {
                attentionCount.textContent =
                    String(
                        attention.length
                    );
            }


            if (
                attention.length ===
                0
            ) {
                attentionList.innerHTML = `
                    <div class="br-alert-empty">
                        No due-soon or overdue borrowing records
                        require follow-up.
                    </div>
                `;


                return;
            }


            attentionList.innerHTML =
                attention.map(
                    ({
                        record,
                        stats
                    }) => {
                        const overdue =
                            stats.status ===
                            'Overdue';


                        const badgeClass =
                            overdue
                                ? 'overdue'
                                : 'due';


                        const badgeLabel =
                            overdue
                                ? 'OVERDUE'
                                : 'DUE SOON';


                        const verb =
                            overdue
                                ? 'were due'
                                : 'are due';


                        return `
                            <article
                                class="
                                    br-alert
                                    ${overdue ? 'overdue' : ''}
                                "
                            >
                                <div class="br-alert-top">

                                    <span class="br-alert-title">
                                        ${record.activity}
                                    </span>

                                    <span
                                        class="
                                            br-alert-badge
                                            ${badgeClass}
                                        "
                                    >
                                        ${badgeLabel}
                                    </span>

                                </div>

                                <p class="br-alert-text">
                                    ${record.id}
                                    ·
                                    ${record.borrower}
                                    ·
                                    ${stats.remaining}
                                    ${
                                        stats.remaining === 1
                                            ? 'unit remains'
                                            : 'units remain'
                                    }
                                    and ${verb}
                                    ${formatDueDate(record.due_date)}.
                                </p>
                            </article>
                        `;
                    }
                ).join(
                    ''
                );
        };


        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        const refreshRows = (
            calculatedRecords
        ) => {
            calculatedRecords.forEach(
                ({
                    record,
                    stats
                }) => {
                    const row =
                        rowMap.get(
                            record.id
                        );


                    if (
                        !row
                    ) {
                        return;
                    }


                    row.dataset.status =
                        stats.status;


                    const returned =
                        row.querySelector(
                            '[data-returned-units]'
                        );


                    const remaining =
                        row.querySelector(
                            '[data-remaining-units]'
                        );


                    const badge =
                        row.querySelector(
                            '[data-status-badge]'
                        );


                    if (
                        returned
                    ) {
                        returned.textContent =
                            String(
                                stats.returned
                            );
                    }


                    if (
                        remaining
                    ) {
                        remaining.textContent =
                            String(
                                stats.remaining
                            );
                    }


                    if (
                        badge
                    ) {
                        badge.className =
                            `br-badge ${statusTone(stats.status)}`;


                        badge.textContent =
                            stats.status;
                    }
                }
            );
        };


        /*
        |--------------------------------------------------------------------------
        | FILTERING
        |--------------------------------------------------------------------------
        */

        const applyFilters = () => {
            const keyword =
                search
                    ? search.value
                        .trim()
                        .toLowerCase()
                    : '';


            let count =
                0;


            rows.forEach(
                (row) => {
                    const status =
                        row.dataset.status ||
                        '';


                    const searchableText =
                        row.dataset.search ||
                        '';


                    const matchesStatus =
                        activeStatus ===
                            'all' ||
                        status ===
                            activeStatus;


                    const matchesSearch =
                        !keyword ||
                        searchableText.includes(
                            keyword
                        );


                    const isVisible =
                        matchesStatus &&
                        matchesSearch;


                    row.hidden =
                        !isVisible;


                    if (
                        isVisible
                    ) {
                        count +=
                            1;
                    }
                }
            );


            if (
                visibleCount
            ) {
                visibleCount.textContent =
                    String(
                        count
                    );
            }


            if (
                empty
            ) {
                empty.hidden =
                    count !==
                    0;
            }
        };


        /*
        |--------------------------------------------------------------------------
        | REFRESH CURRENT DATA
        |--------------------------------------------------------------------------
        */

        const refreshReport = () => {
            const state =
                loadItemState();


            const calculatedRecords =
                records.map(
                    (record) => ({
                        record,
                        stats:
                            getRecordStats(
                                record,
                                state
                            )
                    })
                );


            const counts = {
                total:
                    calculatedRecords.length,

                borrowed:
                    calculatedRecords.filter(
                        ({ stats }) =>
                            stats.status ===
                            'Borrowed'
                    ).length,

                returned:
                    calculatedRecords.filter(
                        ({ stats }) =>
                            stats.status ===
                            'Returned'
                    ).length,

                dueSoon:
                    calculatedRecords.filter(
                        ({ stats }) =>
                            stats.status ===
                            'Due Soon'
                    ).length,

                overdue:
                    calculatedRecords.filter(
                        ({ stats }) =>
                            stats.status ===
                            'Overdue'
                    ).length
            };


            counts.active =
                counts.total -
                counts.returned;


            counts.attention =
                counts.dueSoon +
                counts.overdue;


            setKpi(
                'total',
                counts.total
            );


            setKpi(
                'active',
                counts.active
            );


            setKpi(
                'returned',
                counts.returned
            );


            setKpi(
                'due-soon',
                counts.dueSoon
            );


            setKpi(
                'overdue',
                counts.overdue
            );


            if (
                footerActive
            ) {
                footerActive.textContent =
                    String(
                        counts.active
                    );
            }


            if (
                footerReturned
            ) {
                footerReturned.textContent =
                    String(
                        counts.returned
                    );
            }


            const returnRate =
                counts.total > 0
                    ? Number(
                        (
                            (
                                counts.returned /
                                counts.total
                            ) *
                            100
                        ).toFixed(
                            1
                        )
                    )
                    : 0;


            const activeRate =
                counts.total > 0
                    ? Number(
                        (
                            (
                                counts.active /
                                counts.total
                            ) *
                            100
                        ).toFixed(
                            1
                        )
                    )
                    : 0;


            const attentionRate =
                counts.total > 0
                    ? Number(
                        (
                            (
                                counts.attention /
                                counts.total
                            ) *
                            100
                        ).toFixed(
                            1
                        )
                    )
                    : 0;


            setPerformance(
                page.querySelector(
                    '#br-return-rate'
                ),
                page.querySelector(
                    '#br-return-fill'
                ),
                returnRate
            );


            setPerformance(
                page.querySelector(
                    '#br-active-rate'
                ),
                page.querySelector(
                    '#br-active-fill'
                ),
                activeRate
            );


            setPerformance(
                page.querySelector(
                    '#br-attention-rate'
                ),
                page.querySelector(
                    '#br-attention-fill'
                ),
                attentionRate
            );


            refreshStatusSummary(
                counts
            );


            refreshRows(
                calculatedRecords
            );


            refreshAttentionList(
                calculatedRecords
            );


            applyFilters();
        };


        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        filters.forEach(
            (button) => {
                button.addEventListener(
                    'click',
                    () => {
                        activeStatus =
                            button.dataset.statusFilter ||
                            'all';


                        filters.forEach(
                            (filterButton) => {
                                filterButton.classList.toggle(
                                    'is-active',
                                    filterButton ===
                                        button
                                );
                            }
                        );


                        applyFilters();
                    }
                );
            }
        );


        search?.addEventListener(
            'input',
            applyFilters
        );


        printButton?.addEventListener(
            'click',
            () => {
                window.print();
            }
        );


        window.addEventListener(
            'pageshow',
            refreshReport
        );


        window.addEventListener(
            'storage',
            refreshReport
        );


        window.addEventListener(
            'pulso:borrow-item-returns-updated',
            refreshReport
        );


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        refreshReport();
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeBorrowReport,
            {
                once: true
            }
        );
    } else {
        initializeBorrowReport();
    }
})();
</script>
@endpush