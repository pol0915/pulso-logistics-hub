@extends('layouts.app')

@section('title', 'Reports & History | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | CURRENT MODULE SNAPSHOT
    |--------------------------------------------------------------------------
    |
    | These values are aligned with the current sample records used across:
    |
    | Inventory & Assets
    | Logistics Requests
    | Borrow & Return
    | Projects
    | Donations
    |
    */

    $overview = [
        [
            'label' => 'Total Assets',
            'value' => 148,
            'helper' => 'Registered logistics assets',
            'tone' => 'teal',
            'icon' => 'inventory',
        ],
        [
            'label' => 'Active Borrowings',
            'value' => 3,
            'helper' => 'Resources still outside',
            'tone' => 'navy',
            'icon' => 'borrow',
        ],
        [
            'label' => 'Open Requests',
            'value' => 6,
            'helper' => 'Current requests not completed',
            'tone' => 'pink',
            'icon' => 'requests',
        ],
        [
            'label' => 'Active Projects',
            'value' => 3,
            'helper' => 'Under logistics coordination',
            'tone' => 'gold',
            'icon' => 'projects',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | REPORT CENTER
    |--------------------------------------------------------------------------
    */

    $reportLinks = [
        [
            'title' => 'Inventory & Assets Report',
            'description' => 'Asset availability, condition, deployment, maintenance, and stock monitoring.',
            'href' => route('reports.inventory'),
            'tone' => 'teal',
            'icon' => 'inventory',
        ],
        [
            'title' => 'Logistics Requests Report',
            'description' => 'Request volume, approval status, preparation progress, completion, and issues.',
            'href' => route('reports.requests'),
            'tone' => 'pink',
            'icon' => 'requests',
        ],
        [
            'title' => 'Borrow & Return Report',
            'description' => 'Active borrowings, expected returns, completed returns, and overdue records.',
            'href' => route('reports.borrow'),
            'tone' => 'navy',
            'icon' => 'borrow',
        ],
        [
            'title' => 'Projects Report',
            'description' => 'Project logistics readiness, resource coordination, deployment, and completion.',
            'href' => route('reports.projects'),
            'tone' => 'gold',
            'icon' => 'projects',
        ],
        [
            'title' => 'Donations Report',
            'description' => 'Physical donation intake, verification, allocation, and inventory integration.',
            'href' => route('reports.donations'),
            'tone' => 'pink',
            'icon' => 'donations',
        ],
        [
            'title' => 'Activity History',
            'description' => 'Central timeline of logistics actions, updates, and transactions.',
            'href' => route('reports.activity'),
            'tone' => 'navy',
            'icon' => 'history',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | MONTHLY LOGISTICS ACTIVITY
    |--------------------------------------------------------------------------
    |
    | Historical sample activity volume. These are not the same as the
    | current register totals shown in the KPI snapshot above.
    |
    */

    $monthlyActivity = [
        [
            'month' => 'Apr',
            'requests' => 12,
            'borrowings' => 6,
            'returns' => 5,
            'donations' => 3,
        ],
        [
            'month' => 'May',
            'requests' => 17,
            'borrowings' => 8,
            'returns' => 7,
            'donations' => 5,
        ],
        [
            'month' => 'Jun',
            'requests' => 14,
            'borrowings' => 7,
            'returns' => 6,
            'donations' => 4,
        ],
        [
            'month' => 'Jul',
            'requests' => 21,
            'borrowings' => 10,
            'returns' => 9,
            'donations' => 6,
        ],
        [
            'month' => 'Aug',
            'requests' => 25,
            'borrowings' => 12,
            'returns' => 10,
            'donations' => 8,
        ],
        [
            'month' => 'Sep',
            'requests' => 19,
            'borrowings' => 9,
            'returns' => 8,
            'donations' => 5,
        ],
    ];


    $maxActivity = max(
        array_map(
            fn ($item) => max(
                $item['requests'],
                $item['borrowings'],
                $item['returns'],
                $item['donations']
            ),
            $monthlyActivity
        )
    );


    /*
    |--------------------------------------------------------------------------
    | CURRENT REQUEST STATUS
    |--------------------------------------------------------------------------
    |
    | Matches the current seven sample requests:
    |
    | Pending           1
    | Needs Resolution  1
    | Approved          2
    | Preparing         2
    | Completed         1
    |
    */

    $requestStats = [
        [
            'label' => 'Pending',
            'value' => 1,
            'tone' => 'gold',
        ],
        [
            'label' => 'Needs Resolution',
            'value' => 1,
            'tone' => 'red',
        ],
        [
            'label' => 'Approved',
            'value' => 2,
            'tone' => 'teal',
        ],
        [
            'label' => 'Preparing',
            'value' => 2,
            'tone' => 'blue',
        ],
        [
            'label' => 'Completed',
            'value' => 1,
            'tone' => 'green',
        ],
    ];


    $requestTotal = array_sum(
        array_column(
            $requestStats,
            'value'
        )
    );


    /*
    |--------------------------------------------------------------------------
    | INVENTORY STATUS
    |--------------------------------------------------------------------------
    */

    $inventoryStats = [
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
            'tone' => 'gold',
        ],
        [
            'label' => 'Damaged',
            'value' => 3,
            'tone' => 'red',
        ],
    ];


    $inventoryTotal = array_sum(
        array_column(
            $inventoryStats,
            'value'
        )
    );


    /*
    |--------------------------------------------------------------------------
    | BORROW & RETURN SNAPSHOT
    |--------------------------------------------------------------------------
    */

    $borrowSummary = [
        'total' => 5,
        'active' => 3,
        'borrowed' => 1,
        'dueSoon' => 1,
        'overdue' => 1,
        'returned' => 2,
    ];


    /*
    |--------------------------------------------------------------------------
    | PROJECT LOGISTICS SUMMARY
    |--------------------------------------------------------------------------
    */

    $projectSummary = [
        'total' => 5,
        'active' => 3,
        'resourceAllocation' => 1,
        'ready' => 1,
        'ongoing' => 1,
        'completed' => 2,
        'needsAttention' => 1,
    ];


    /*
    |--------------------------------------------------------------------------
    | DONATION INTAKE SUMMARY
    |--------------------------------------------------------------------------
    |
    | Current donation register:
    |
    | DON-0011 Verified
    | DON-0010 Allocated
    | DON-0009 Added to Inventory
    | DON-0008 Pending Verification
    | DON-0007 Verified
    |
    */

    $donationSummary = [
        'total' => 5,
        'pending' => 1,
        'verified' => 2,
        'allocated' => 1,
        'inventory' => 1,
    ];


    $processedDonations =
        $donationSummary['verified']
        + $donationSummary['allocated']
        + $donationSummary['inventory'];


    $donationProcessedPercent = round(
        (
            $processedDonations
            /
            $donationSummary['total']
        ) * 100,
        1
    );


    /*
    |--------------------------------------------------------------------------
    | LOW STOCK / CRITICAL ITEMS
    |--------------------------------------------------------------------------
    */

    $lowStock = [
        [
            'name' => 'Extension Cord 20m',
            'remaining' => 4,
            'minimum' => 10,
            'helper' => 'Electrical reserve is below the preferred minimum.',
        ],
        [
            'name' => 'Wireless Microphone Set',
            'remaining' => 2,
            'minimum' => 5,
            'helper' => 'Additional units may be needed for upcoming activities.',
        ],
        [
            'name' => 'Basic Tool Kit',
            'remaining' => 2,
            'minimum' => 5,
            'helper' => 'Available tool kits are below the recommended reserve.',
        ],
        [
            'name' => 'PULSO Event Banner',
            'remaining' => 3,
            'minimum' => 6,
            'helper' => 'Current banner inventory is below the preferred quantity.',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | RECENT ACTIVITY
    |--------------------------------------------------------------------------
    |
    | References and descriptions match the current module sample data.
    |
    */

    $recentActivities = [
        [
            'date' => 'Sep 12, 2026',
            'time' => '07:15 AM',
            'title' => 'Resources released',
            'reference' => 'BRW-2026-0028',
            'module' => 'Borrow & Return',
            'description' => 'Resources for the Youth Leadership Summit were released to Maria Santos.',
            'tone' => 'navy',
        ],
        [
            'date' => 'Sep 11, 2026',
            'time' => '02:15 PM',
            'title' => 'Project marked ready',
            'reference' => 'PRJ-2026-0017',
            'module' => 'Projects',
            'description' => 'Medical Mission logistics resources passed preparation and readiness checks.',
            'tone' => 'gold',
        ],
        [
            'date' => 'Sep 10, 2026',
            'time' => '08:00 AM',
            'title' => 'Project activity started',
            'reference' => 'PRJ-2026-0016',
            'module' => 'Projects',
            'description' => 'Coastal Clean-Up Drive moved to the Ongoing logistics stage.',
            'tone' => 'gold',
        ],
        [
            'date' => 'Sep 9, 2026',
            'time' => '03:10 PM',
            'title' => 'Donation allocated',
            'reference' => 'DON-2026-0010',
            'module' => 'Donations',
            'description' => 'Cleaning Tool Kits were allocated to the Coastal Clean-Up Drive.',
            'tone' => 'pink',
        ],
        [
            'date' => 'Sep 9, 2026',
            'time' => '02:10 PM',
            'title' => 'Donation verified',
            'reference' => 'DON-2026-0011',
            'module' => 'Donations',
            'description' => 'Twenty donated Monoblock Chairs were inspected and accepted for logistics use.',
            'tone' => 'teal',
        ],
        [
            'date' => 'Sep 7, 2026',
            'time' => '05:36 PM',
            'title' => 'Project logistics completed',
            'reference' => 'PRJ-2026-0015',
            'module' => 'Projects',
            'description' => 'Volunteer Orientation was completed and its reusable resources were accounted for.',
            'tone' => 'gold',
        ],
        [
            'date' => 'Sep 7, 2026',
            'time' => '03:05 PM',
            'title' => 'Donated resources inventoried',
            'reference' => 'DON-2026-0009',
            'module' => 'Donations',
            'description' => 'Six donated Folding Tables were added to the general logistics inventory.',
            'tone' => 'teal',
        ],
    ];
@endphp


@push('styles')
<style>
    /* ================================================================
       REPORTS & HISTORY
       ================================================================ */

    .reports-dashboard {
        --rpt-navy: #10263d;
        --rpt-text: #31546d;
        --rpt-muted: #688297;

        --rpt-teal: #007780;
        --rpt-pink: #b90c61;
        --rpt-blue: #245b99;
        --rpt-gold: #895408;
        --rpt-red: #ad343d;
        --rpt-green: #2b735d;

        --rpt-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--rpt-navy);

        container-name: reports-dashboard;
        container-type: inline-size;
    }


    .reports-dashboard *,
    .reports-dashboard *::before,
    .reports-dashboard *::after {
        box-sizing: border-box;
    }


    .reports-dashboard [hidden] {
        display: none !important;
    }


    .rpt-heading,
    .rpt-heading-actions,
    .rpt-section-heading,
    .rpt-section-title,
    .rpt-shortcut,
    .rpt-status-row,
    .rpt-activity-item,
    .rpt-activity-meta,
    .rpt-section-link,
    .rpt-chart-legend-row {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADER
       ================================================================ */

    .rpt-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .rpt-heading-copy {
        min-width: 0;
    }


    .rpt-eyebrow {
        margin: 0 0 7px;

        color: var(--rpt-teal);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .rpt-heading h1 {
        margin: 0;

        color: var(--rpt-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .rpt-description {
        max-width: 800px;

        margin: 9px 0 0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .rpt-heading-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .rpt-action {
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


    .rpt-action:hover {
        color: var(--rpt-teal);

        transform: translateY(-1px);
    }


    .rpt-action-primary {
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


    .rpt-action-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    .rpt-action svg {
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

    .reports-dashboard > .rpt-stat-grid {
        display: grid !important;

        grid-template-columns:
            repeat(
                4,
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


    .reports-dashboard > .rpt-stat-grid::before,
    .reports-dashboard > .rpt-stat-grid::after {
        display: none !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .rpt-stat {
        --rpt-tone: #007780;

        --rpt-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
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


    .rpt-stat::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 32px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--rpt-tone);

        opacity: .5;

        content: "";
    }


    .rpt-stat[data-tone="teal"] {
        --rpt-tone: #007780;

        --rpt-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .rpt-stat[data-tone="navy"] {
        --rpt-tone: #173b59;

        --rpt-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .rpt-stat[data-tone="pink"] {
        --rpt-tone: #b90c61;

        --rpt-tone-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .rpt-stat[data-tone="gold"] {
        --rpt-tone: #895408;

        --rpt-tone-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }


    .rpt-stat-icon {
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

        background: var(--rpt-tone-fill);

        color: var(--rpt-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .rpt-stat-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .rpt-stat-copy {
        min-width: 0;
    }


    .rpt-stat-value {
        display: block;

        color: var(--rpt-tone);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .rpt-stat-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .rpt-stat-helper {
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

    .rpt-card {
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


    .rpt-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding: 20px 22px;

        border-bottom:
            1px
            solid
            var(--rpt-line);
    }


    .rpt-section-title {
        gap: 12px;

        min-width: 0;
    }


    .rpt-section-number {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border: 1px solid #ffffff;
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #ccebed
            );

        color: var(--rpt-teal);

        font-size: 13px;
        font-weight: 850;
    }


    .rpt-section-number.pink {
        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--rpt-pink);
    }


    .rpt-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .rpt-section-title p {
        margin: 5px 0 0;

        color: #496580;

        font-size: 11px;
        line-height: 1.55;
    }


    .rpt-section-link {
        flex-shrink: 0;

        gap: 6px;

        color: var(--rpt-teal);

        font-size: 9.5px;
        font-weight: 750;

        text-decoration: none;
    }


    .rpt-section-link:hover {
        color: #005f66;
    }


    .rpt-section-link svg {
        width: 14px;
        height: 14px;

        fill: none;

        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* ================================================================
       REPORT CENTER
       ================================================================ */

    .rpt-shortcuts {
        display: grid;

        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );

        gap: 12px;

        padding: 20px 22px 22px;
    }


    .rpt-shortcut {
        gap: 12px;

        min-width: 0;
        min-height: 98px;

        padding: 15px;

        border: 1px solid #d9e8ef;
        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e5f1f5
            );

        color: inherit;

        box-shadow:
            inset 2px 2px 6px rgba(101, 138, 163, .08),
            inset -2px -2px 6px rgba(255, 255, 255, .74);

        text-decoration: none;

        transition:
            border-color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }


    .rpt-shortcut:hover {
        border-color: #a9dbe1;

        background:
            linear-gradient(
                145deg,
                #f1fafb,
                #deeff3
            );

        transform: translateY(-1px);
    }


    .rpt-shortcut-icon {
        display: grid;
        place-items: center;

        width: 42px;
        height: 42px;

        flex: 0 0 42px;

        border:
            1px
            solid
            rgba(255, 255, 255, .84);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e1f6f7,
                #ccebed
            );

        color: #007780;
    }


    .rpt-shortcut-icon.pink {
        background:
            linear-gradient(
                145deg,
                #fae7f0,
                #efd3df
            );

        color: #b90c61;
    }


    .rpt-shortcut-icon.navy {
        background:
            linear-gradient(
                145deg,
                #e8eef4,
                #d9e4ee
            );

        color: #31546d;
    }


    .rpt-shortcut-icon.gold {
        background:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );

        color: #895408;
    }


    .rpt-shortcut-icon svg {
        width: 19px;
        height: 19px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .rpt-shortcut-copy {
        min-width: 0;

        flex: 1;
    }


    .rpt-shortcut-title {
        display: block;

        color: #10263d;

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;
    }


    .rpt-shortcut-description {
        display: block;

        margin-top: 4px;

        color: #688297;

        font-size: 9px;
        line-height: 1.5;
    }


    .rpt-shortcut-arrow {
        flex-shrink: 0;

        color: #007780;
    }


    .rpt-shortcut-arrow svg {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       LOGISTICS ACTIVITY
       ================================================================ */

    .rpt-chart-card {
        display: grid;

        grid-template-columns:
            minmax(0, 1.6fr)
            minmax(215px, .58fr);

        align-items: stretch;

        gap: 0;
    }


    .rpt-chart-main {
        min-width: 0;
    }


    .rpt-chart-area {
        min-width: 0;

        padding: 22px;
    }


    .rpt-chart {
        display: grid;

        grid-template-columns:
            38px
            minmax(0, 1fr);

        gap: 10px;

        min-width: 0;
    }


    .rpt-y-axis {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        padding-bottom: 27px;

        color: #71899c;

        font-size: 8.5px;

        text-align: right;
    }


    .rpt-plot {
        position: relative;

        min-width: 0;
        height: 240px;

        border-bottom:
            1px
            solid
            #cfe0e8;

        background-image:
            linear-gradient(
                to bottom,
                rgba(207, 224, 232, .27) 1px,
                transparent 1px
            );

        background-size:
            100%
            25%;
    }


    .rpt-bars {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        align-items: end;

        gap: 14px;

        height: 100%;

        padding: 10px 5px 0;
    }


    .rpt-bar-group {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(3px, 1fr)
            );

        align-items: end;

        gap: 3px;

        height: 100%;
    }


    .rpt-bar {
        min-height: 5px;

        border-radius: 5px 5px 1px 1px;
    }


    .rpt-bar.teal {
        background:
            linear-gradient(
                180deg,
                #05adb6,
                #007780
            );
    }


    .rpt-bar.pink {
        background:
            linear-gradient(
                180deg,
                #ee1280,
                #b90c61
            );
    }


    .rpt-bar.navy {
        background:
            linear-gradient(
                180deg,
                #66839a,
                #31546d
            );
    }


    .rpt-bar.gold {
        background:
            linear-gradient(
                180deg,
                #e1c96f,
                #92701d
            );
    }


    .rpt-x-axis {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 14px;

        padding: 8px 5px 0;

        color: #71899c;

        font-size: 9px;

        text-align: center;
    }


    .rpt-chart-legend {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 8px;

        margin-top: 16px;
    }


    .rpt-chart-legend-row {
        justify-content: center;

        gap: 6px;

        color: #496580;

        font-size: 9px;
        font-weight: 700;
    }


    .rpt-legend-dot {
        width: 8px;
        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;
    }


    .rpt-legend-dot.teal {
        background: #05adb6;
    }


    .rpt-legend-dot.pink {
        background: #ee1280;
    }


    .rpt-legend-dot.navy {
        background: #31546d;
    }


    .rpt-legend-dot.gold {
        background: #c9a94c;
    }


    .rpt-chart-side {
        display: flex;
        flex-direction: column;
        justify-content: center;

        padding: 22px;

        border-left:
            1px
            solid
            var(--rpt-line);

        background:
            rgba(
                237,
                246,
                250,
                .5
            );
    }


    .rpt-mini-title {
        margin: 0 0 15px;

        color: #10263d;

        font-size: 12px;
        font-weight: 800;
    }


    .rpt-side-summary {
        display: grid;

        gap: 10px;
    }


    .rpt-side-row {
        display: flex;
        justify-content: space-between;

        gap: 10px;

        padding-bottom: 9px;

        border-bottom:
            1px
            solid
            var(--rpt-line);
    }


    .rpt-side-row:last-child {
        padding-bottom: 0;

        border-bottom: 0;
    }


    .rpt-side-row span {
        color: #496580;

        font-size: 9px;
    }


    .rpt-side-row strong {
        color: #10263d;

        font-size: 10px;
        font-weight: 800;

        text-align: right;

        font-variant-numeric: tabular-nums;
    }


    /* ================================================================
       SPLIT SECTIONS
       ================================================================ */

    .rpt-split-grid {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .rpt-split-grid .rpt-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       STATUS BREAKDOWN
       ================================================================ */

    .rpt-breakdown {
        display: grid;
        align-content: center;

        min-height: 220px;

        gap: 15px;

        padding: 22px;
    }


    .rpt-breakdown-item {
        width: 100%;
    }


    .rpt-status-row {
        justify-content: space-between;

        gap: 15px;
    }


    .rpt-status-label {
        display: flex;
        align-items: center;

        gap: 8px;

        min-width: 0;
    }


    .rpt-status-dot {
        width: 8px;
        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;
    }


    .rpt-status-dot.teal {
        background: #05adb6;
    }


    .rpt-status-dot.pink {
        background: #ee1280;
    }


    .rpt-status-dot.navy {
        background: #31546d;
    }


    .rpt-status-dot.blue {
        background: #245b99;
    }


    .rpt-status-dot.gold {
        background: #c9a94c;
    }


    .rpt-status-dot.red {
        background: #ad343d;
    }


    .rpt-status-dot.green {
        background: #2b735d;
    }


    .rpt-status-name {
        color: #31546d;

        font-size: 9.5px;
        font-weight: 700;
    }


    .rpt-status-value {
        flex-shrink: 0;

        color: #10263d;

        font-size: 9.5px;
        font-weight: 800;
    }


    .rpt-status-track {
        width: 100%;
        height: 7px;

        margin-top: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #d9e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .13);
    }


    .rpt-status-fill {
        height: 100%;

        border-radius: inherit;
    }


    .rpt-status-fill.teal {
        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .rpt-status-fill.pink {
        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .rpt-status-fill.navy {
        background:
            linear-gradient(
                90deg,
                #66839a,
                #31546d
            );
    }


    .rpt-status-fill.blue {
        background:
            linear-gradient(
                90deg,
                #668ec0,
                #245b99
            );
    }


    .rpt-status-fill.gold {
        background:
            linear-gradient(
                90deg,
                #e1c96f,
                #92701d
            );
    }


    .rpt-status-fill.red {
        background:
            linear-gradient(
                90deg,
                #db7279,
                #ad343d
            );
    }


    .rpt-status-fill.green {
        background:
            linear-gradient(
                90deg,
                #56a689,
                #2b735d
            );
    }


    /* ================================================================
       PROJECT / DONATION SUMMARIES
       ================================================================ */

    .rpt-module-summary {
        display: grid;

        grid-template-columns:
            minmax(145px, .62fr)
            minmax(0, 1fr);

        align-items: stretch;

        gap: 14px;

        min-height: 270px;

        padding: 22px;
    }


    .rpt-module-primary {
        display: flex;
        flex-direction: column;
        justify-content: center;

        min-height: 145px;

        padding: 17px;

        border:
            1px
            solid
            rgba(255, 255, 255, .78);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e5f0f4
            );

        box-shadow:
            inset 3px 3px 8px rgba(101, 138, 163, .09),
            inset -2px -2px 6px rgba(255, 255, 255, .67);
    }


    .rpt-module-primary.is-pink {
        background:
            linear-gradient(
                145deg,
                #f9edf3,
                #f1e0e8
            );
    }


    .rpt-module-primary-label {
        display: block;

        color: #688297;

        font-size: 8.5px;
        font-weight: 800;

        letter-spacing: .08em;

        text-transform: uppercase;
    }


    .rpt-module-primary-value {
        display: block;

        margin-top: 8px;

        color: #007780;

        font-size: 29px;
        font-weight: 850;
        line-height: 1;
    }


    .rpt-module-primary.is-pink .rpt-module-primary-value {
        color: #b90c61;
    }


    .rpt-module-primary-helper {
        display: block;

        margin-top: 7px;

        color: #688297;

        font-size: 9px;
        line-height: 1.5;
    }


    .rpt-module-list {
        display: grid;
        align-content: center;

        gap: 8px;
    }


    .rpt-module-row {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        padding: 9px 11px;

        border:
            1px
            solid
            rgba(255, 255, 255, .72);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #edf5f8,
                #e6f0f4
            );

        box-shadow:
            inset 2px 2px 5px rgba(84, 118, 139, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .64);
    }


    .rpt-module-row span {
        color: #567489;

        font-size: 9px;
    }


    .rpt-module-row strong {
        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    .rpt-module-row.is-alert strong {
        color: #b90c61;
    }


    .rpt-donation-progress {
        grid-column: 1 / -1;

        margin-top: 2px;
    }


    .rpt-donation-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        margin-bottom: 7px;
    }


    .rpt-donation-head span {
        color: #31546d;

        font-size: 9px;
        font-weight: 750;
    }


    .rpt-donation-head strong {
        color: #007780;

        font-size: 9px;
        font-weight: 850;
    }


    .rpt-donation-track {
        width: 100%;
        height: 8px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(90, 121, 141, .11);
    }


    .rpt-donation-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .rpt-donation-footer {
        display: flex;
        justify-content: space-between;

        gap: 12px;

        margin-top: 6px;

        color: #688297;

        font-size: 8px;
    }


    /* ================================================================
       LOW STOCK
       ================================================================ */

    .rpt-low-stock {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 12px;

        padding: 22px;
    }


    .rpt-low-item {
        position: relative;

        display: flex;
        align-items: flex-start;

        gap: 12px;

        min-width: 0;

        padding: 15px;

        overflow: hidden;

        border: 1px solid #efbfd5;
        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e2
            );

        box-shadow:
            5px 6px 14px rgba(150, 61, 104, .10),
            -3px -3px 9px rgba(255, 255, 255, .60),
            inset 1px 1px 2px rgba(255, 255, 255, .62);

        transition:
            transform 160ms ease,
            box-shadow 160ms ease;
    }


    .rpt-low-item:hover {
        transform: translateY(-2px);

        box-shadow:
            7px 8px 16px rgba(150, 61, 104, .13),
            -3px -3px 9px rgba(255, 255, 255, .64),
            inset 1px 1px 2px rgba(255, 255, 255, .68);
    }


    .rpt-low-item::after {
        position: absolute;

        top: 0;
        right: 18px;

        width: 34px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: #b90c61;

        opacity: .7;

        content: "";
    }


    .rpt-low-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border:
            1px
            solid
            rgba(255, 255, 255, .72);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #c91970,
                #a90b59
            );

        color: #ffffff;

        box-shadow:
            3px 4px 8px rgba(125, 27, 75, .16),
            inset 1px 1px 2px rgba(255, 255, 255, .22);
    }


    .rpt-low-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.9;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .rpt-low-content {
        min-width: 0;

        flex: 1;
    }


    .rpt-low-item-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 10px;
    }


    .rpt-low-name {
        min-width: 0;

        color: #522039;

        font-size: 10.5px;
        font-weight: 800;
        line-height: 1.4;
    }


    .rpt-low-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 23px;

        flex-shrink: 0;

        padding: 4px 7px;

        border:
            1px
            solid
            rgba(255, 255, 255, .55);

        border-radius: 8px;

        background:
            rgba(
                185,
                12,
                97,
                .11
            );

        color: #b90c61;

        font-size: 8px;
        font-weight: 850;

        white-space: nowrap;
    }


    .rpt-low-helper {
        margin: 7px 0 0;

        color: #7a4660;

        font-size: 8.5px;
        line-height: 1.5;
    }


    .rpt-low-minimum {
        display: block;

        margin-top: 8px;

        color: #98647d;

        font-size: 8px;
        font-weight: 650;
    }


    /* ================================================================
       RECENT ACTIVITY
       ================================================================ */

    .rpt-activity-list {
        padding: 4px 22px 7px;
    }


    .rpt-activity-item {
        align-items: flex-start;

        gap: 14px;

        padding: 15px 0;

        border-bottom:
            1px
            solid
            #d9e8ef;
    }


    .rpt-activity-item:last-child {
        border-bottom: 0;
    }


    .rpt-activity-dot {
        position: relative;

        width: 9px;
        height: 9px;

        flex: 0 0 9px;

        margin-top: 4px;

        border-radius: 50%;

        background: #05adb6;
    }


    .rpt-activity-dot.pink {
        background: #ee1280;
    }


    .rpt-activity-dot.navy {
        background: #31546d;
    }


    .rpt-activity-dot.gold {
        background: #c9a94c;
    }


    .rpt-activity-dot.teal {
        background: #05adb6;
    }


    .rpt-activity-dot::after {
        position: absolute;

        top: 12px;
        left: 4px;

        width: 1px;
        height: 45px;

        background: #d5e5ee;

        content: "";
    }


    .rpt-activity-item:last-child .rpt-activity-dot::after {
        display: none;
    }


    .rpt-activity-copy {
        min-width: 0;

        flex: 1;
    }


    .rpt-activity-title {
        display: block;

        color: #10263d;

        font-size: 10.5px;
        font-weight: 800;
    }


    .rpt-activity-description {
        margin: 4px 0 0;

        color: #688297;

        font-size: 9px;
        line-height: 1.5;
    }


    .rpt-activity-meta {
        justify-content: flex-start;
        flex-wrap: wrap;

        gap: 5px 10px;

        margin-top: 5px;

        color: #496580;

        font-size: 8.5px;
    }


    .rpt-activity-reference {
        color: #007780;

        font-weight: 750;
    }


    .rpt-activity-time {
        flex-shrink: 0;

        color: #688297;

        font-size: 8.5px;
    }


    .rpt-note {
        margin: 4px 0 0;

        color: #71899c;

        font-size: 10px;
        line-height: 1.65;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container reports-dashboard (max-width: 980px) {
        .rpt-shortcuts {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .rpt-low-stock {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container reports-dashboard (max-width: 880px) {
        .reports-dashboard > .rpt-stat-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container reports-dashboard (max-width: 820px) {
        .rpt-chart-card {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rpt-chart-side {
            border-top:
                1px
                solid
                var(--rpt-line);

            border-left: 0;
        }


        .rpt-split-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rpt-module-summary {
            min-height: 0;
        }
    }


    @container reports-dashboard (max-width: 700px) {
        .rpt-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .rpt-heading-actions {
            width: 100%;
        }


        .rpt-heading-actions .rpt-action {
            flex: 1;
        }


        .rpt-shortcuts,
        .rpt-low-stock {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rpt-module-summary {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rpt-chart {
            grid-template-columns:
                32px
                minmax(0, 1fr);

            gap: 8px;
        }


        .rpt-bars,
        .rpt-x-axis {
            gap: 7px;
        }


        .rpt-chart-legend {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .rpt-section-heading {
            align-items: flex-start;
        }


        .rpt-section-link {
            display: none;
        }
    }


    @container reports-dashboard (max-width: 520px) {
        .reports-dashboard > .rpt-stat-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rpt-activity-item {
            display: grid;

            grid-template-columns:
                9px
                minmax(0, 1fr);
        }


        .rpt-activity-time {
            grid-column: 2;
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


        body:has(#reports-dashboard) #app-sidebar,
        body:has(#reports-dashboard) #sidebar-backdrop,
        body:has(#reports-dashboard) #pulso-topbar,
        body:has(#reports-dashboard) .hub-skip-link,
        .reports-dashboard .rpt-no-print {
            display: none !important;
        }


        body:has(#reports-dashboard) #app-main {
            padding-left: 0 !important;
        }


        body:has(#reports-dashboard) .hub-content {
            padding: 0 !important;
        }


        .reports-dashboard {
            container-type: normal;
        }


        .reports-dashboard > .rpt-stat-grid {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .rpt-stat {
            min-height: auto;

            padding: 9px;
        }


        .rpt-stat-icon {
            display: none;
        }


        .rpt-card,
        .rpt-stat,
        .rpt-shortcut,
        .rpt-module-primary,
        .rpt-module-row,
        .rpt-low-item {
            border:
                1px
                solid
                #dddddd !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .rpt-low-icon {
            border:
                1px
                solid
                #cccccc !important;

            background:
                #ffffff !important;

            color: #b90c61 !important;

            box-shadow:
                none !important;
        }


        .rpt-card,
        .rpt-stat {
            break-inside: avoid;
        }


        .rpt-shortcuts {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .rpt-chart-card {
            grid-template-columns:
                1.6fr
                .58fr;
        }


        .rpt-chart-side {
            border-top: 0;

            border-left:
                1px
                solid
                #dddddd;
        }


        .rpt-split-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            gap: 8px;
        }


        .rpt-low-stock {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }
    }
</style>
@endpush


@section('content')
<div
    class="reports-dashboard"
    id="reports-dashboard"
>

    {{-- =============================================================
         HEADER
         ============================================================= --}}

    <header class="rpt-heading">

        <div class="rpt-heading-copy">

            <p class="rpt-eyebrow">
                Logistics analytics
            </p>

            <h1>
                Reports &amp; History
            </h1>

            <p class="rpt-description">
                Review current logistics performance, inventory
                conditions, request activity, borrowing records,
                project readiness, physical donation intake, and
                recent system activity.
            </p>

        </div>


        <div class="rpt-heading-actions rpt-no-print">

            <button
                class="
                    rpt-action
                    rpt-action-primary
                "
                id="rpt-print"
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
        class="rpt-stat-grid"
        aria-label="Reports overview"
    >

        @foreach ($overview as $stat)

            <article
                class="rpt-stat"
                data-tone="{{ $stat['tone'] }}"
            >

                <span
                    class="rpt-stat-icon"
                    aria-hidden="true"
                >

                    @if ($stat['icon'] === 'inventory')

                        <svg viewBox="0 0 24 24">
                            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                            <path d="M3 8v9l9 5 9-5V8"/>
                            <path d="M12 13v9"/>
                        </svg>

                    @elseif ($stat['icon'] === 'borrow')

                        <svg viewBox="0 0 24 24">
                            <path d="M4 7h15"/>
                            <path d="m15 3 4 4-4 4"/>
                            <path d="M20 17H5"/>
                            <path d="m9 13-4 4 4 4"/>
                        </svg>

                    @elseif ($stat['icon'] === 'requests')

                        <svg viewBox="0 0 24 24">
                            <rect
                                x="5"
                                y="3"
                                width="14"
                                height="18"
                                rx="2"
                            />

                            <path d="M9 8h6"/>
                            <path d="M9 12h6"/>
                            <path d="M9 16h4"/>
                        </svg>

                    @else

                        <svg viewBox="0 0 24 24">
                            <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
                            <path d="M12 11v6"/>
                            <path d="M9 14h6"/>
                        </svg>

                    @endif

                </span>


                <div class="rpt-stat-copy">

                    <strong class="rpt-stat-value">
                        {{ number_format($stat['value']) }}
                    </strong>

                    <span class="rpt-stat-label">
                        {{ $stat['label'] }}
                    </span>

                    <span class="rpt-stat-helper">
                        {{ $stat['helper'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         01 REPORT CENTER
         ============================================================= --}}

    <section class="rpt-card">

        <header class="rpt-section-heading">

            <div class="rpt-section-title">

                <span class="rpt-section-number">
                    01
                </span>

                <div>
                    <h2>
                        Report Center
                    </h2>

                    <p>
                        Open a detailed report for each logistics module.
                    </p>
                </div>

            </div>

        </header>


        <div class="rpt-shortcuts">

            @foreach ($reportLinks as $report)

                <a
                    class="rpt-shortcut"
                    href="{{ $report['href'] }}"
                >

                    <span
                        class="
                            rpt-shortcut-icon
                            {{ $report['tone'] }}
                        "
                        aria-hidden="true"
                    >

                        @if ($report['icon'] === 'inventory')

                            <svg viewBox="0 0 24 24">
                                <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                                <path d="M3 8v9l9 5 9-5V8"/>
                                <path d="M12 13v9"/>
                            </svg>

                        @elseif ($report['icon'] === 'requests')

                            <svg viewBox="0 0 24 24">
                                <rect
                                    x="5"
                                    y="3"
                                    width="14"
                                    height="18"
                                    rx="2"
                                />

                                <path d="M9 8h6"/>
                                <path d="M9 12h6"/>
                                <path d="M9 16h4"/>
                            </svg>

                        @elseif ($report['icon'] === 'borrow')

                            <svg viewBox="0 0 24 24">
                                <path d="M4 7h15"/>
                                <path d="m15 3 4 4-4 4"/>
                                <path d="M20 17H5"/>
                                <path d="m9 13-4 4 4 4"/>
                            </svg>

                        @elseif ($report['icon'] === 'projects')

                            <svg viewBox="0 0 24 24">
                                <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
                                <path d="M12 11v6"/>
                                <path d="M9 14h6"/>
                            </svg>

                        @elseif ($report['icon'] === 'donations')

                            <svg viewBox="0 0 24 24">
                                <path d="M4 10h16v10H4Z"/>
                                <path d="M3 7h18v3H3Z"/>
                                <path d="M12 7v13"/>
                                <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>
                                <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>
                            </svg>

                        @else

                            <svg viewBox="0 0 24 24">
                                <path d="M4 5h16"/>
                                <path d="M4 12h16"/>
                                <path d="M4 19h16"/>

                                <circle
                                    cx="8"
                                    cy="5"
                                    r="1.5"
                                    fill="currentColor"
                                    stroke="none"
                                />

                                <circle
                                    cx="15"
                                    cy="12"
                                    r="1.5"
                                    fill="currentColor"
                                    stroke="none"
                                />

                                <circle
                                    cx="11"
                                    cy="19"
                                    r="1.5"
                                    fill="currentColor"
                                    stroke="none"
                                />
                            </svg>

                        @endif

                    </span>


                    <span class="rpt-shortcut-copy">

                        <span class="rpt-shortcut-title">
                            {{ $report['title'] }}
                        </span>

                        <span class="rpt-shortcut-description">
                            {{ $report['description'] }}
                        </span>

                    </span>


                    <span
                        class="rpt-shortcut-arrow"
                        aria-hidden="true"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </span>

                </a>

            @endforeach

        </div>

    </section>


    {{-- =============================================================
         02 LOGISTICS ACTIVITY
         ============================================================= --}}

    <section class="rpt-card rpt-chart-card">

        <div class="rpt-chart-main">

            <header class="rpt-section-heading">

                <div class="rpt-section-title">

                    <span class="rpt-section-number pink">
                        02
                    </span>

                    <div>
                        <h2>
                            Logistics Activity Overview
                        </h2>

                        <p>
                            Historical monthly activity across requests,
                            borrowings, returns, and physical donations.
                        </p>
                    </div>

                </div>

            </header>


            <div class="rpt-chart-area">

                <div class="rpt-chart">

                    <div
                        class="rpt-y-axis"
                        aria-hidden="true"
                    >
                        <span>
                            {{ $maxActivity }}
                        </span>

                        <span>
                            {{ round($maxActivity * .75) }}
                        </span>

                        <span>
                            {{ round($maxActivity * .5) }}
                        </span>

                        <span>
                            {{ round($maxActivity * .25) }}
                        </span>

                        <span>
                            0
                        </span>
                    </div>


                    <div>

                        <div class="rpt-plot">

                            <div class="rpt-bars">

                                @foreach ($monthlyActivity as $activity)

                                    <div
                                        class="rpt-bar-group"
                                        title="{{ $activity['month'] }}: {{ $activity['requests'] }} requests, {{ $activity['borrowings'] }} borrowings, {{ $activity['returns'] }} returns, {{ $activity['donations'] }} donations"
                                    >

                                        <div
                                            class="rpt-bar teal"
                                            style="
                                                height:
                                                {{
                                                    max(
                                                        2,
                                                        ($activity['requests'] / $maxActivity) * 100
                                                    )
                                                }}%;
                                            "
                                        ></div>


                                        <div
                                            class="rpt-bar pink"
                                            style="
                                                height:
                                                {{
                                                    max(
                                                        2,
                                                        ($activity['borrowings'] / $maxActivity) * 100
                                                    )
                                                }}%;
                                            "
                                        ></div>


                                        <div
                                            class="rpt-bar navy"
                                            style="
                                                height:
                                                {{
                                                    max(
                                                        2,
                                                        ($activity['returns'] / $maxActivity) * 100
                                                    )
                                                }}%;
                                            "
                                        ></div>


                                        <div
                                            class="rpt-bar gold"
                                            style="
                                                height:
                                                {{
                                                    max(
                                                        2,
                                                        ($activity['donations'] / $maxActivity) * 100
                                                    )
                                                }}%;
                                            "
                                        ></div>

                                    </div>

                                @endforeach

                            </div>

                        </div>


                        <div class="rpt-x-axis">

                            @foreach ($monthlyActivity as $activity)

                                <span>
                                    {{ $activity['month'] }}
                                </span>

                            @endforeach

                        </div>

                    </div>

                </div>


                <div class="rpt-chart-legend">

                    <div class="rpt-chart-legend-row">
                        <span class="rpt-legend-dot teal"></span>
                        Requests
                    </div>


                    <div class="rpt-chart-legend-row">
                        <span class="rpt-legend-dot pink"></span>
                        Borrowings
                    </div>


                    <div class="rpt-chart-legend-row">
                        <span class="rpt-legend-dot navy"></span>
                        Returns
                    </div>


                    <div class="rpt-chart-legend-row">
                        <span class="rpt-legend-dot gold"></span>
                        Donations
                    </div>

                </div>

            </div>

        </div>


        <aside class="rpt-chart-side">

            <h3 class="rpt-mini-title">
                Current Register Snapshot
            </h3>


            <div class="rpt-side-summary">

                <div class="rpt-side-row">
                    <span>
                        Request Records
                    </span>

                    <strong>
                        {{ $requestTotal }}
                    </strong>
                </div>


                <div class="rpt-side-row">
                    <span>
                        Active Borrowings
                    </span>

                    <strong>
                        {{ $borrowSummary['active'] }}
                    </strong>
                </div>


                <div class="rpt-side-row">
                    <span>
                        Returned Borrowings
                    </span>

                    <strong>
                        {{ $borrowSummary['returned'] }}
                    </strong>
                </div>


                <div class="rpt-side-row">
                    <span>
                        Overdue Borrowings
                    </span>

                    <strong>
                        {{ $borrowSummary['overdue'] }}
                    </strong>
                </div>


                <div class="rpt-side-row">
                    <span>
                        Active Projects
                    </span>

                    <strong>
                        {{ $projectSummary['active'] }}
                    </strong>
                </div>


                <div class="rpt-side-row">
                    <span>
                        Donation Records
                    </span>

                    <strong>
                        {{ $donationSummary['total'] }}
                    </strong>
                </div>


                <div class="rpt-side-row">
                    <span>
                        Peak Historical Activity
                    </span>

                    <strong>
                        August
                    </strong>
                </div>

            </div>

        </aside>

    </section>


    {{-- =============================================================
         03 REQUEST STATUS + 04 INVENTORY STATUS
         ============================================================= --}}

    <div class="rpt-split-grid">

        <section class="rpt-card">

            <header class="rpt-section-heading">

                <div class="rpt-section-title">

                    <span class="rpt-section-number">
                        03
                    </span>

                    <div>
                        <h2>
                            Request Status
                        </h2>

                        <p>
                            Current distribution of the seven sample logistics requests.
                        </p>
                    </div>

                </div>


                <a
                    class="rpt-section-link"
                    href="{{ route('reports.requests') }}"
                >
                    View Requests Report

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>

            </header>


            <div class="rpt-breakdown">

                @foreach ($requestStats as $request)

                    @php
                        $requestPercent = round(
                            (
                                $request['value']
                                /
                                $requestTotal
                            ) * 100,
                            1
                        );
                    @endphp


                    <div class="rpt-breakdown-item">

                        <div class="rpt-status-row">

                            <span class="rpt-status-label">

                                <span
                                    class="
                                        rpt-status-dot
                                        {{ $request['tone'] }}
                                    "
                                ></span>

                                <span class="rpt-status-name">
                                    {{ $request['label'] }}
                                </span>

                            </span>


                            <span class="rpt-status-value">
                                {{ $request['value'] }}
                                ·
                                {{ $requestPercent }}%
                            </span>

                        </div>


                        <div class="rpt-status-track">

                            <div
                                class="
                                    rpt-status-fill
                                    {{ $request['tone'] }}
                                "
                                style="
                                    width:
                                    {{ $requestPercent }}%;
                                "
                            ></div>

                        </div>

                    </div>

                @endforeach

            </div>

        </section>


        <section class="rpt-card">

            <header class="rpt-section-heading">

                <div class="rpt-section-title">

                    <span class="rpt-section-number pink">
                        04
                    </span>

                    <div>
                        <h2>
                            Inventory Status
                        </h2>

                        <p>
                            Current state of all 148 registered logistics assets.
                        </p>
                    </div>

                </div>


                <a
                    class="rpt-section-link"
                    href="{{ route('reports.inventory') }}"
                >
                    View Inventory Report

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>

            </header>


            <div class="rpt-breakdown">

                @foreach ($inventoryStats as $inventory)

                    @php
                        $inventoryPercent = round(
                            (
                                $inventory['value']
                                /
                                $inventoryTotal
                            ) * 100,
                            1
                        );
                    @endphp


                    <div class="rpt-breakdown-item">

                        <div class="rpt-status-row">

                            <span class="rpt-status-label">

                                <span
                                    class="
                                        rpt-status-dot
                                        {{ $inventory['tone'] }}
                                    "
                                ></span>

                                <span class="rpt-status-name">
                                    {{ $inventory['label'] }}
                                </span>

                            </span>


                            <span class="rpt-status-value">
                                {{ $inventory['value'] }}
                                ·
                                {{ $inventoryPercent }}%
                            </span>

                        </div>


                        <div class="rpt-status-track">

                            <div
                                class="
                                    rpt-status-fill
                                    {{ $inventory['tone'] }}
                                "
                                style="
                                    width:
                                    {{ $inventoryPercent }}%;
                                "
                            ></div>

                        </div>

                    </div>

                @endforeach

            </div>

        </section>

    </div>


    {{-- =============================================================
         05 PROJECTS + 06 DONATIONS
         ============================================================= --}}

    <div class="rpt-split-grid">

        <section class="rpt-card">

            <header class="rpt-section-heading">

                <div class="rpt-section-title">

                    <span class="rpt-section-number">
                        05
                    </span>

                    <div>
                        <h2>
                            Project Logistics Summary
                        </h2>

                        <p>
                            Readiness and coordination status of tracked projects.
                        </p>
                    </div>

                </div>


                <a
                    class="rpt-section-link"
                    href="{{ route('reports.projects') }}"
                >
                    Projects Report

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>

            </header>


            <div class="rpt-module-summary">

                <div class="rpt-module-primary">

                    <span class="rpt-module-primary-label">
                        Active Projects
                    </span>

                    <strong class="rpt-module-primary-value">
                        {{ $projectSummary['active'] }}
                    </strong>

                    <span class="rpt-module-primary-helper">
                        Of {{ $projectSummary['total'] }} tracked project logistics records.
                    </span>

                </div>


                <div class="rpt-module-list">

                    <div class="rpt-module-row">
                        <span>
                            Resource Allocation
                        </span>

                        <strong>
                            {{ $projectSummary['resourceAllocation'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row">
                        <span>
                            Ready
                        </span>

                        <strong>
                            {{ $projectSummary['ready'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row">
                        <span>
                            Ongoing
                        </span>

                        <strong>
                            {{ $projectSummary['ongoing'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row">
                        <span>
                            Completed
                        </span>

                        <strong>
                            {{ $projectSummary['completed'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row is-alert">
                        <span>
                            Resource Issues
                        </span>

                        <strong>
                            {{ $projectSummary['needsAttention'] }}
                        </strong>
                    </div>

                </div>

            </div>

        </section>


        <section class="rpt-card">

            <header class="rpt-section-heading">

                <div class="rpt-section-title">

                    <span class="rpt-section-number pink">
                        06
                    </span>

                    <div>
                        <h2>
                            Donation Intake Summary
                        </h2>

                        <p>
                            Verification and allocation status of physical donated resources.
                        </p>
                    </div>

                </div>


                <a
                    class="rpt-section-link"
                    href="{{ route('reports.donations') }}"
                >
                    Donations Report

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>

            </header>


            <div class="rpt-module-summary">

                <div class="rpt-module-primary is-pink">

                    <span class="rpt-module-primary-label">
                        Donation Records
                    </span>

                    <strong class="rpt-module-primary-value">
                        {{ $donationSummary['total'] }}
                    </strong>

                    <span class="rpt-module-primary-helper">
                        Physical resource donation intake records currently shown.
                    </span>

                </div>


                <div class="rpt-module-list">

                    <div class="rpt-module-row is-alert">
                        <span>
                            Pending Verification
                        </span>

                        <strong>
                            {{ $donationSummary['pending'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row">
                        <span>
                            Verified
                        </span>

                        <strong>
                            {{ $donationSummary['verified'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row">
                        <span>
                            Allocated to Project
                        </span>

                        <strong>
                            {{ $donationSummary['allocated'] }}
                        </strong>
                    </div>


                    <div class="rpt-module-row">
                        <span>
                            Added to Inventory
                        </span>

                        <strong>
                            {{ $donationSummary['inventory'] }}
                        </strong>
                    </div>

                </div>


                <div class="rpt-donation-progress">

                    <div class="rpt-donation-head">

                        <span>
                            Processed Donation Records
                        </span>

                        <strong>
                            {{ $donationProcessedPercent }}%
                        </strong>

                    </div>


                    <div class="rpt-donation-track">

                        <div
                            class="rpt-donation-fill"
                            style="
                                width:
                                {{ $donationProcessedPercent }}%;
                            "
                        ></div>

                    </div>


                    <div class="rpt-donation-footer">

                        <span>
                            {{ $processedDonations }}
                            of
                            {{ $donationSummary['total'] }}
                            processed
                        </span>

                        <span>
                            {{ $donationSummary['pending'] }}
                            pending
                        </span>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =============================================================
         07 LOW STOCK
         ============================================================= --}}

    <section class="rpt-card">

        <header class="rpt-section-heading">

            <div class="rpt-section-title">

                <span class="rpt-section-number">
                    07
                </span>

                <div>
                    <h2>
                        Low Stock / Critical Resources
                    </h2>

                    <p>
                        Resources below their recommended minimum quantity.
                    </p>
                </div>

            </div>


            <a
                class="rpt-section-link"
                href="{{ route('reports.inventory') }}"
            >
                View Inventory Report

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </a>

        </header>


        <div class="rpt-low-stock">

            @foreach ($lowStock as $item)

                <article class="rpt-low-item">

                    <span
                        class="rpt-low-icon"
                        aria-hidden="true"
                    >
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M10.3 3.7 2.8 17a2 2 0 0 0 1.75 3h14.9a2 2 0 0 0 1.75-3L13.7 3.7a2 2 0 0 0-3.4 0Z"
                            />

                            <path d="M12 9v4"/>

                            <path d="M12 16h.01"/>
                        </svg>
                    </span>


                    <div class="rpt-low-content">

                        <div class="rpt-low-item-top">

                            <span class="rpt-low-name">
                                {{ $item['name'] }}
                            </span>


                            <span class="rpt-low-count">
                                {{ $item['remaining'] }}
                                left
                            </span>

                        </div>


                        <p class="rpt-low-helper">
                            {{ $item['helper'] }}
                        </p>


                        <span class="rpt-low-minimum">
                            Preferred minimum:
                            {{ $item['minimum'] }}
                        </span>

                    </div>

                </article>

            @endforeach

        </div>

    </section>


    {{-- =============================================================
         08 RECENT ACTIVITY
         ============================================================= --}}

    <section class="rpt-card">

        <header class="rpt-section-heading">

            <div class="rpt-section-title">

                <span class="rpt-section-number pink">
                    08
                </span>

                <div>
                    <h2>
                        Recent Activity
                    </h2>

                    <p>
                        Latest logistics actions from the current sample records.
                    </p>
                </div>

            </div>


            <a
                class="rpt-section-link"
                href="{{ route('reports.activity') }}"
            >
                View Activity History

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </a>

        </header>


        <div class="rpt-activity-list">

            @foreach ($recentActivities as $activity)

                <article class="rpt-activity-item">

                    <span
                        class="
                            rpt-activity-dot
                            {{ $activity['tone'] }}
                        "
                    ></span>


                    <div class="rpt-activity-copy">

                        <strong class="rpt-activity-title">
                            {{ $activity['title'] }}
                        </strong>


                        <p class="rpt-activity-description">
                            {{ $activity['description'] }}
                        </p>


                        <div class="rpt-activity-meta">

                            <span class="rpt-activity-reference">
                                {{ $activity['reference'] }}
                            </span>

                            <span>
                                {{ $activity['module'] }}
                            </span>

                            <span>
                                {{ $activity['date'] }}
                            </span>

                        </div>

                    </div>


                    <span class="rpt-activity-time">
                        {{ $activity['time'] }}
                    </span>

                </article>

            @endforeach

        </div>

    </section>


    <p class="rpt-note">
        Report values currently use coordinated front-end sample data.
        During backend integration, these summaries can be generated
        automatically from Laravel models and the actual logistics database.
    </p>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeReportsDashboard = () => {
        const page =
            document.getElementById(
                'reports-dashboard'
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


        const printButton =
            page.querySelector(
                '#rpt-print'
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
            initializeReportsDashboard,
            {
                once: true
            }
        );
    } else {
        initializeReportsDashboard();
    }
})();
</script>
@endpush