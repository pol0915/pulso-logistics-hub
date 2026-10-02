@extends('layouts.app')

@section('title', 'Donations Report | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | CURRENT DONATION RECORDS
    |--------------------------------------------------------------------------
    */

    $donations = [
        [
            'id' => 'DON-2026-0011',
            'donor' => 'Community Partners Association',
            'donor_type' => 'Organization',
            'item' => 'Monoblock Chairs',
            'category' => 'Furniture',
            'quantity' => 20,
            'condition' => 'Good',
            'date' => 'Sep 9, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Verified',
            'tone' => 'teal',
            'allocation' => 'Unallocated',
        ],
        [
            'id' => 'DON-2026-0010',
            'donor' => 'Green Youth Volunteers',
            'donor_type' => 'Organization',
            'item' => 'Cleaning Tool Kits',
            'category' => 'Cleaning Supplies',
            'quantity' => 15,
            'condition' => 'Good',
            'date' => 'Sep 8, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Allocated',
            'tone' => 'navy',
            'allocation' => 'Coastal Clean-Up Drive',
        ],
        [
            'id' => 'DON-2026-0009',
            'donor' => 'PULSO Alumni Circle',
            'donor_type' => 'Organization',
            'item' => 'Folding Tables',
            'category' => 'Furniture',
            'quantity' => 6,
            'condition' => 'Excellent',
            'date' => 'Sep 7, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Added to Inventory',
            'tone' => 'green',
            'allocation' => 'Inventory',
        ],
        [
            'id' => 'DON-2026-0008',
            'donor' => 'Local Business Partners',
            'donor_type' => 'Organization',
            'item' => 'Extension Cords',
            'category' => 'Electrical',
            'quantity' => 8,
            'condition' => 'For Inspection',
            'date' => 'Sep 6, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Pending Verification',
            'tone' => 'pink',
            'allocation' => 'Unallocated',
        ],
        [
            'id' => 'DON-2026-0007',
            'donor' => 'Ramon Villanueva',
            'donor_type' => 'Individual',
            'item' => 'Portable Storage Boxes',
            'category' => 'Storage',
            'quantity' => 10,
            'condition' => 'Good',
            'date' => 'Sep 5, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Verified',
            'tone' => 'teal',
            'allocation' => 'Unallocated',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    $totalDonations = count($donations);


    $pendingDonations = count(
        array_filter(
            $donations,
            fn ($donation) =>
                $donation['status'] ===
                'Pending Verification'
        )
    );


    $verifiedDonations = count(
        array_filter(
            $donations,
            fn ($donation) =>
                $donation['status'] ===
                'Verified'
        )
    );


    $allocatedDonations = count(
        array_filter(
            $donations,
            fn ($donation) =>
                $donation['status'] ===
                'Allocated'
        )
    );


    $inventoryDonations = count(
        array_filter(
            $donations,
            fn ($donation) =>
                $donation['status'] ===
                'Added to Inventory'
        )
    );


    $processedDonations =
        $verifiedDonations
        + $allocatedDonations
        + $inventoryDonations;


    $processedPercent =
        $totalDonations > 0
            ? round(
                (
                    $processedDonations
                    /
                    $totalDonations
                ) * 100
            )
            : 0;


    $totalUnits = array_sum(
        array_column(
            $donations,
            'quantity'
        )
    );


    $summary = [
        [
            'label' => 'Donation Records',
            'value' => sprintf(
                '%02d',
                $totalDonations
            ),
            'helper' => $totalUnits . ' total donated units',
            'tone' => 'teal',
            'icon' => 'donations',
        ],
        [
            'label' => 'Pending Verification',
            'value' => sprintf(
                '%02d',
                $pendingDonations
            ),
            'helper' => 'Awaiting resource inspection',
            'tone' => 'pink',
            'icon' => 'pending',
        ],
        [
            'label' => 'Processed Records',
            'value' => sprintf(
                '%02d',
                $processedDonations
            ),
            'helper' => $processedPercent . '% of donation records',
            'tone' => 'navy',
            'icon' => 'check',
        ],
        [
            'label' => 'Added to Inventory',
            'value' => sprintf(
                '%02d',
                $inventoryDonations
            ),
            'helper' => 'Integrated into reusable stock',
            'tone' => 'green',
            'icon' => 'inventory',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | STATUS DISTRIBUTION
    |--------------------------------------------------------------------------
    */

    $statusStats = [
        [
            'label' => 'Pending Verification',
            'value' => $pendingDonations,
            'tone' => 'pink',
        ],
        [
            'label' => 'Verified',
            'value' => $verifiedDonations,
            'tone' => 'teal',
        ],
        [
            'label' => 'Allocated',
            'value' => $allocatedDonations,
            'tone' => 'navy',
        ],
        [
            'label' => 'Added to Inventory',
            'value' => $inventoryDonations,
            'tone' => 'green',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | DYNAMIC DONUT BREAKPOINTS
    |--------------------------------------------------------------------------
    */

    $statusTotal = max(
        1,
        array_sum(
            array_column(
                $statusStats,
                'value'
            )
        )
    );


    $pendingEnd =
        (
            $statusStats[0]['value']
            /
            $statusTotal
        ) * 100;


    $verifiedEnd =
        (
            (
                $statusStats[0]['value']
                +
                $statusStats[1]['value']
            )
            /
            $statusTotal
        ) * 100;


    $allocatedEnd =
        (
            (
                $statusStats[0]['value']
                +
                $statusStats[1]['value']
                +
                $statusStats[2]['value']
            )
            /
            $statusTotal
        ) * 100;


    /*
    |--------------------------------------------------------------------------
    | CATEGORY DISTRIBUTION
    |--------------------------------------------------------------------------
    */

    $categoryNames = [
        [
            'label' => 'Furniture',
            'tone' => 'teal',
            'icon' => 'furniture',
        ],
        [
            'label' => 'Cleaning Supplies',
            'tone' => 'pink',
            'icon' => 'supplies',
        ],
        [
            'label' => 'Electrical',
            'tone' => 'navy',
            'icon' => 'equipment',
        ],
        [
            'label' => 'Storage',
            'tone' => 'green',
            'icon' => 'storage',
        ],
    ];


    $categoryStats = array_map(
        function ($category) use ($donations) {
            $matchingDonations = array_filter(
                $donations,
                fn ($donation) =>
                    $donation['category']
                    ===
                    $category['label']
            );


            return [
                'label' => $category['label'],
                'value' => count($matchingDonations),
                'units' => array_sum(
                    array_column(
                        $matchingDonations,
                        'quantity'
                    )
                ),
                'tone' => $category['tone'],
                'icon' => $category['icon'],
            ];
        },
        $categoryNames
    );


    /*
    |--------------------------------------------------------------------------
    | HISTORICAL MONTHLY DONATION ACTIVITY
    |--------------------------------------------------------------------------
    |
    | Historical sample analytics. These are separate from the five
    | current donation records shown in the register.
    |
    */

    $monthlyDonations = [
        [
            'month' => 'Apr',
            'received' => 3,
            'processed' => 2,
        ],
        [
            'month' => 'May',
            'received' => 5,
            'processed' => 4,
        ],
        [
            'month' => 'Jun',
            'received' => 4,
            'processed' => 3,
        ],
        [
            'month' => 'Jul',
            'received' => 6,
            'processed' => 5,
        ],
        [
            'month' => 'Aug',
            'received' => 8,
            'processed' => 7,
        ],
        [
            'month' => 'Sep',
            'received' => 5,
            'processed' => 4,
        ],
    ];


    $maxMonthlyDonations = max(
        array_map(
            fn ($month) => max(
                $month['received'],
                $month['processed']
            ),
            $monthlyDonations
        )
    );
@endphp


@push('styles')
<style>
    /* ================================================================
       DONATIONS REPORT
       ================================================================ */

    .donation-report {
        --dr-navy: #10263d;
        --dr-text: #31546d;
        --dr-muted: #688297;

        --dr-teal: #007780;
        --dr-pink: #b90c61;
        --dr-green: #2b735d;
        --dr-gold: #895408;

        --dr-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--dr-navy);

        container-name: donation-report;
        container-type: inline-size;
    }


    .donation-report *,
    .donation-report *::before,
    .donation-report *::after {
        box-sizing: border-box;
    }


    .donation-report [hidden] {
        display: none !important;
    }


    .dr-heading,
    .dr-heading-actions,
    .dr-section-heading,
    .dr-section-title,
    .dr-status-row,
    .dr-category-row,
    .dr-filter-row,
    .dr-table-footer {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .dr-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .dr-heading-copy {
        min-width: 0;
    }


    .dr-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--dr-pink);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .dr-heading h1 {
        margin: 0;

        color: var(--dr-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .dr-description {
        max-width: 790px;

        margin:
            9px
            0
            0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .dr-heading-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .dr-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding:
            10px
            14px;

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


    .dr-button:hover {
        color: var(--dr-pink);

        transform:
            translateY(
                -1px
            );
    }


    .dr-button-primary {
        border-color:
            rgba(
                248,
                179,
                215,
                .8
            );

        background:
            linear-gradient(
                145deg,
                #ca176e,
                #ab0b59
            );

        color: #ffffff;

        box-shadow:
            4px 6px 12px rgba(185, 12, 97, .18),
            inset 1px 1px 3px rgba(255, 196, 225, .28);
    }


    .dr-button-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #d11b73,
                #a40955
            );
    }


    .dr-button svg {
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
       KPI CARDS
       ================================================================ */

    .donation-report > .dr-summary {
        display: grid !important;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 12px;

        width: 100%;
        min-width: 0;

        margin:
            0
            0
            20px !important;

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


    .donation-report > .dr-summary::before,
    .donation-report > .dr-summary::after {
        display: none !important;

        width: 0 !important;
        height: 0 !important;

        border: 0 !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .dr-stat {
        --dr-tone: #007780;

        --dr-fill:
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

        padding:
            15px
            13px;

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


    .dr-stat::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 32px;
        height: 3px;

        border-radius:
            0
            0
            999px
            999px;

        background: var(--dr-tone);

        opacity: .5;

        content: "";
    }


    .dr-stat[data-tone="teal"] {
        --dr-tone: #007780;

        --dr-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .dr-stat[data-tone="pink"] {
        --dr-tone: #b90c61;

        --dr-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .dr-stat[data-tone="navy"] {
        --dr-tone: #173b59;

        --dr-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .dr-stat[data-tone="green"] {
        --dr-tone: #2b735d;

        --dr-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    .dr-stat-icon {
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

        background: var(--dr-fill);

        color: var(--dr-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .dr-stat-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .dr-stat-copy {
        min-width: 0;
    }


    .dr-stat-value {
        display: block;

        color: var(--dr-tone);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .dr-stat-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .dr-stat-helper {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       CARDS
       ================================================================ */

    .dr-card {
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


    .dr-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding:
            20px
            22px;

        border-bottom:
            1px
            solid
            var(--dr-line);
    }


    .dr-section-title {
        gap: 12px;

        min-width: 0;
    }


    .dr-section-number {
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
                #fbe8f1,
                #efd3e0
            );

        color: var(--dr-pink);

        font-size: 13px;
        font-weight: 850;
    }


    .dr-section-number.teal {
        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #ccebed
            );

        color: var(--dr-teal);
    }


    .dr-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .dr-section-title p {
        margin:
            5px
            0
            0;

        color: #496580;

        font-size: 11px;
        line-height: 1.55;
    }


    .dr-source {
        flex-shrink: 0;

        padding:
            7px
            10px;

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

        white-space: nowrap;
    }


    /* ================================================================
       ANALYTICS GRID
       ================================================================ */

    .dr-analytics {
        display: grid;

        grid-template-columns:
            minmax(0, .92fr)
            minmax(0, 1.08fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .dr-analytics .dr-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       STATUS DISTRIBUTION
       ================================================================ */

    .dr-status-body {
        display: grid;

        grid-template-columns:
            158px
            minmax(0, 1fr);

        align-items: center;

        gap: 18px;

        min-height: 275px;

        padding: 22px;
    }


    .dr-donut-wrap {
        position: relative;

        display: grid;
        place-items: center;

        width: 158px;
        height: 158px;

        margin: auto;
    }


    .dr-donut {
        position: relative;

        width: 150px;
        height: 150px;

        border-radius: 50%;

        background:
            conic-gradient(
                #b90c61
                0
                var(--pending-end),

                #05adb6
                var(--pending-end)
                var(--verified-end),

                #31546d
                var(--verified-end)
                var(--allocated-end),

                #2b735d
                var(--allocated-end)
                100%
            );

        box-shadow:
            0 9px 20px rgba(101, 138, 163, .14);
    }


    .dr-donut::after {
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


    .dr-donut-center {
        position: absolute;
        z-index: 2;

        top: 50%;
        left: 50%;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        width: 74px;
        height: 74px;

        transform:
            translate(
                -50%,
                -50%
            );

        text-align: center;

        pointer-events: none;
    }


    .dr-donut-center strong {
        display: block;

        color: var(--dr-navy);

        font-size: 25px;
        font-weight: 850;
        line-height: 1;
    }


    .dr-donut-center span {
        display: block;

        margin-top: 4px;

        color: #71899c;

        font-size: 7.8px;
        font-weight: 700;
        line-height: 1.1;
    }


    .dr-status-list {
        display: grid;

        min-width: 0;

        gap: 9px;
    }


    .dr-status-row {
        justify-content: space-between;

        gap: 10px;

        min-width: 0;

        padding:
            9px
            10px;

        border:
            1px
            solid
            rgba(255, 255, 255, .82);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e5f0f4
            );

        box-shadow:
            inset 2px 2px 5px rgba(84, 118, 139, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .64);
    }


    .dr-status-label {
        display: flex;
        align-items: center;

        gap: 8px;

        min-width: 0;

        color: #496580;

        font-size: 9.3px;
        font-weight: 700;
    }


    .dr-status-dot {
        width: 8px;
        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;
    }


    .dr-status-dot.pink {
        background: #b90c61;
    }


    .dr-status-dot.teal {
        background: #05adb6;
    }


    .dr-status-dot.navy {
        background: #31546d;
    }


    .dr-status-dot.green {
        background: #2b735d;
    }


    .dr-status-value {
        flex-shrink: 0;

        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    /* ================================================================
       MONTHLY CHART
       ================================================================ */

    .dr-chart-body {
        min-height: 275px;

        padding: 22px;
    }


    .dr-chart {
        display: grid;

        grid-template-columns:
            30px
            minmax(0, 1fr);

        gap: 10px;
    }


    .dr-y-axis {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        height: 210px;

        padding-bottom: 25px;

        color: #7890a2;

        font-size: 8px;

        text-align: right;
    }


    .dr-plot {
        min-width: 0;
    }


    .dr-bars {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        align-items: end;

        gap: 14px;

        height: 210px;

        padding:
            12px
            8px
            0;

        border-bottom:
            1px
            solid
            #cedfe7;

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


    .dr-bar-group {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(6px, 1fr)
            );

        align-items: end;

        gap: 5px;

        height: 100%;
    }


    .dr-bar {
        min-height: 5px;

        border-radius:
            6px
            6px
            1px
            1px;
    }


    .dr-bar.received {
        background:
            linear-gradient(
                180deg,
                #ee1280,
                #b90c61
            );
    }


    .dr-bar.processed {
        background:
            linear-gradient(
                180deg,
                #05adb6,
                #007780
            );
    }


    .dr-x-axis {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 14px;

        padding:
            8px
            8px
            0;

        color: #71899c;

        font-size: 9px;

        text-align: center;
    }


    .dr-chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;

        flex-wrap: wrap;

        gap: 20px;

        margin-top: 15px;

        color: #496580;

        font-size: 9px;
        font-weight: 700;
    }


    .dr-legend-item {
        display: inline-flex;
        align-items: center;

        gap: 6px;
    }


    .dr-legend-dot {
        width: 8px;
        height: 8px;

        border-radius: 50%;
    }


    .dr-legend-dot.pink {
        background: #ee1280;
    }


    .dr-legend-dot.teal {
        background: #05adb6;
    }


    /* ================================================================
       CATEGORY SUMMARY
       ================================================================ */

    .dr-category-grid {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 12px;

        padding: 22px;
    }


    .dr-category {
        --dr-category-tone: #007780;

        --dr-category-fill:
            linear-gradient(
                145deg,
                #e3f6f7,
                #d5edef
            );

        display: flex;
        align-items: flex-start;

        gap: 12px;

        min-width: 0;

        padding: 15px;

        border:
            1px
            solid
            rgba(255, 255, 255, .9);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e4f0f4
            );

        box-shadow:
            inset 2px 2px 6px rgba(86, 120, 140, .06),
            inset -2px -2px 6px rgba(255, 255, 255, .66);
    }


    .dr-category[data-tone="pink"] {
        --dr-category-tone: #b90c61;

        --dr-category-fill:
            linear-gradient(
                145deg,
                #f9e7f0,
                #efd4e1
            );
    }


    .dr-category[data-tone="navy"] {
        --dr-category-tone: #31546d;

        --dr-category-fill:
            linear-gradient(
                145deg,
                #e8eff4,
                #dce7ee
            );
    }


    .dr-category[data-tone="green"] {
        --dr-category-tone: #2b735d;

        --dr-category-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    .dr-category-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border:
            1px
            solid
            rgba(255, 255, 255, .82);

        border-radius: 12px;

        background: var(--dr-category-fill);

        color: var(--dr-category-tone);
    }


    .dr-category-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .dr-category-copy {
        min-width: 0;

        flex: 1;
    }


    .dr-category-row {
        justify-content: space-between;

        gap: 10px;
    }


    .dr-category-name {
        min-width: 0;

        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    .dr-category-value {
        flex-shrink: 0;

        color: var(--dr-category-tone);

        font-size: 20px;
        font-weight: 850;
        line-height: 1;
    }


    .dr-category p {
        margin:
            6px
            0
            0;

        color: #71899c;

        font-size: 8.7px;
        line-height: 1.5;
    }


    /* ================================================================
       TOOLBAR
       ================================================================ */

    .dr-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        padding:
            15px
            22px;

        border-bottom:
            1px
            solid
            var(--dr-line);

        background:
            rgba(
                234,
                244,
                248,
                .35
            );
    }


    .dr-filter-row {
        flex-wrap: wrap;

        gap: 7px;
    }


    .dr-filter {
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


    .dr-filter:hover {
        border-color: #e4aac7;

        color: var(--dr-pink);
    }


    .dr-filter.is-active {
        border-color:
            rgba(
                238,
                18,
                128,
                .23
            );

        background:
            linear-gradient(
                145deg,
                #fbeaf2,
                #f3dce7
            );

        color: var(--dr-pink);

        box-shadow:
            inset 2px 2px 4px rgba(118, 63, 91, .05);
    }


    .dr-record-count {
        flex-shrink: 0;

        color: #71899c;

        font-size: 9.5px;

        white-space: nowrap;
    }


    .dr-record-count strong {
        color: #29475f;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .dr-table-wrap {
        width: 100%;

        overflow-x: auto;
    }


    .dr-table {
        width: 100%;
        min-width: 1190px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .dr-table th {
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


    .dr-table td {
        padding:
            13px
            14px;

        border-bottom:
            1px
            solid
            rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 10px;

        vertical-align: middle;
    }


    .dr-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .dr-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .4
            );
    }


    .dr-item-name {
        display: block;

        max-width: 215px;

        color: #18344c;

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;
    }


    .dr-sub {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.4;
    }


    .dr-id {
        color: var(--dr-pink);

        font-size: 9.5px;
        font-weight: 750;
    }


    .dr-quantity {
        color: #29475f;

        font-size: 12px;
        font-weight: 850;
    }


    /* ================================================================
       BADGES
       ================================================================ */

    .dr-badge {
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


    .dr-badge.pink {
        background: #f8e0eb;

        color: #b90c61;
    }


    .dr-badge.teal {
        background: #dff4f4;

        color: #007780;
    }


    .dr-badge.navy {
        background: #e2ebf2;

        color: #31546d;
    }


    .dr-badge.green {
        background: #e2f0ea;

        color: #2b735d;
    }


    .dr-condition {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 25px;

        padding:
            4px
            8px;

        border-radius: 8px;

        background: #edf5f8;

        color: #496580;

        font-size: 8.5px;
        font-weight: 750;
    }


    /* ================================================================
       ALLOCATION
       ================================================================ */

    .dr-allocation {
        display: block;

        max-width: 160px;

        color: #29475f;

        font-size: 9.5px;
        font-weight: 750;
        line-height: 1.4;
    }


    .dr-allocation.is-unallocated {
        color: #8b5a12;
    }


    /* ================================================================
       ACTION
       ================================================================ */

    .dr-view {
        display: inline-grid;
        place-items: center;

        width: 35px;
        height: 35px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #f9e8f1,
                #efd5e2
            );

        color: var(--dr-pink);

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76);

        text-decoration: none;

        transition:
            color 150ms ease,
            transform 150ms ease,
            box-shadow 150ms ease;
    }


    .dr-view:hover {
        color: #95064d;

        transform:
            translateY(
                -1px
            );
    }


    .dr-view svg {
        width: 16px;
        height: 16px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* ================================================================
       EMPTY
       ================================================================ */

    .dr-empty {
        display: none;

        padding:
            42px
            20px;

        text-align: center;
    }


    .dr-empty.is-visible {
        display: block;
    }


    .dr-empty strong {
        color: #29475f;

        font-size: 14px;
    }


    .dr-empty p {
        margin:
            6px
            0
            0;

        color: #71899c;

        font-size: 10px;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .dr-table-footer {
        justify-content: space-between;

        flex-wrap: wrap;

        gap:
            8px
            18px;

        padding:
            14px
            22px;

        border-top:
            1px
            solid
            var(--dr-line);

        color: #71899c;

        font-size: 9.5px;
    }


    .dr-table-footer p {
        margin: 0;
    }


    .dr-table-footer strong {
        color: #29475f;
    }


    .dr-note {
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

    @container donation-report (max-width: 960px) {
        .dr-category-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container donation-report (max-width: 900px) {
        .donation-report > .dr-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container donation-report (max-width: 820px) {
        .dr-analytics {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @container donation-report (max-width: 700px) {
        .dr-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .dr-heading-actions {
            width: 100%;
        }


        .dr-heading-actions .dr-button {
            flex: 1;
        }


        .dr-status-body {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .dr-category-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .dr-toolbar {
            align-items: flex-start;

            flex-direction: column;
        }


        .dr-source {
            display: none;
        }
    }


    @container donation-report (max-width: 520px) {
        .donation-report > .dr-summary {
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


        body:has(#donation-report) #app-sidebar,
        body:has(#donation-report) #sidebar-backdrop,
        body:has(#donation-report) #pulso-topbar,
        body:has(#donation-report) .hub-skip-link,
        .donation-report .dr-no-print {
            display: none !important;
        }


        body:has(#donation-report) #app-main {
            padding-left: 0 !important;
        }


        body:has(#donation-report) .hub-content {
            padding: 0 !important;
        }


        .donation-report {
            container-type: normal;
        }


        .donation-report > .dr-summary {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .dr-stat {
            min-height: auto;

            padding: 9px;
        }


        .dr-stat-icon {
            display: none;
        }


        .dr-stat,
        .dr-card,
        .dr-status-row,
        .dr-category {
            border:
                1px
                solid
                #d5d5d5 !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .dr-card,
        .dr-stat {
            break-inside: avoid;
        }


        .dr-analytics {
            grid-template-columns:
                .92fr
                1.08fr;

            gap: 10px;
        }


        .dr-category-grid {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .dr-category-icon {
            display: none;
        }


        .dr-table {
            min-width: 0;

            table-layout: fixed;
        }


        .dr-table th,
        .dr-table td {
            padding:
                7px
                5px;

            overflow-wrap: anywhere;
        }


        .dr-table thead {
            display: table-header-group;
        }


        .dr-table tr {
            break-inside: avoid;
        }


        .dr-badge {
            white-space: normal;
        }


        .dr-view {
            display: none;
        }
    }
</style>
@endpush


@section('content')
<div
    class="donation-report"
    id="donation-report"
>

    {{-- =============================================================
         HEADER
         ============================================================= --}}

    <header class="dr-heading">

        <div class="dr-heading-copy">

            <p class="dr-eyebrow">
                Physical donation analytics
            </p>

            <h1>
                Donations Report
            </h1>

            <p class="dr-description">
                Review physical resources donated to PULSO, including
                item quantities, verification status, condition,
                project allocation, and resources added to reusable
                logistics inventory.
            </p>

        </div>


        <div class="dr-heading-actions dr-no-print">

            <a
                class="dr-button"
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
                    dr-button
                    dr-button-primary
                "
                id="dr-print"
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
        class="dr-summary"
        aria-label="Donation report summary"
    >

        @foreach ($summary as $item)

            <article
                class="dr-stat"
                data-tone="{{ $item['tone'] }}"
            >

                <span
                    class="dr-stat-icon"
                    aria-hidden="true"
                >

                    @if ($item['icon'] === 'donations')

                        <svg viewBox="0 0 24 24">
                            <path d="M4 10h16v10H4Z"/>
                            <path d="M3 7h18v3H3Z"/>
                            <path d="M12 7v13"/>
                            <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>
                            <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>
                        </svg>

                    @elseif ($item['icon'] === 'pending')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 7v5"/>
                            <path d="m12 12 3 2"/>
                        </svg>

                    @elseif ($item['icon'] === 'check')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                    @else

                        <svg viewBox="0 0 24 24">
                            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                            <path d="M3 8v9l9 5 9-5V8"/>
                            <path d="M12 13v9"/>
                        </svg>

                    @endif

                </span>


                <div class="dr-stat-copy">

                    <strong class="dr-stat-value">
                        {{ $item['value'] }}
                    </strong>

                    <span class="dr-stat-label">
                        {{ $item['label'] }}
                    </span>

                    <span class="dr-stat-helper">
                        {{ $item['helper'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         ANALYTICS
         ============================================================= --}}

    <div class="dr-analytics">

        <section class="dr-card">

            <header class="dr-section-heading">

                <div class="dr-section-title">

                    <span class="dr-section-number">
                        01
                    </span>

                    <div>

                        <h2>
                            Donation Status Distribution
                        </h2>

                        <p>
                            Current processing stage of physical donation records.
                        </p>

                    </div>

                </div>


                <span class="dr-source">
                    {{ $totalDonations }}
                    Records
                </span>

            </header>


            <div class="dr-status-body">

                <div class="dr-donut-wrap">

                    <div
                        class="dr-donut"
                        style="
                            --pending-end: {{ $pendingEnd }}%;
                            --verified-end: {{ $verifiedEnd }}%;
                            --allocated-end: {{ $allocatedEnd }}%;
                        "
                        role="img"
                        aria-label="Donation status distribution"
                    ></div>


                    <div class="dr-donut-center">

                        <strong>
                            {{ $totalDonations }}
                        </strong>

                        <span>
                            records
                        </span>

                    </div>

                </div>


                <div class="dr-status-list">

                    @foreach ($statusStats as $status)

                        <div class="dr-status-row">

                            <span class="dr-status-label">

                                <span
                                    class="
                                        dr-status-dot
                                        {{ $status['tone'] }}
                                    "
                                ></span>

                                {{ $status['label'] }}

                            </span>


                            <span class="dr-status-value">
                                {{ $status['value'] }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        <section class="dr-card">

            <header class="dr-section-heading">

                <div class="dr-section-title">

                    <span class="dr-section-number teal">
                        02
                    </span>

                    <div>

                        <h2>
                            Donation Intake Trend
                        </h2>

                        <p>
                            Historical donation records received and processed.
                        </p>

                    </div>

                </div>


                <span class="dr-source">
                    Apr – Sep 2026
                </span>

            </header>


            <div class="dr-chart-body">

                <div class="dr-chart">

                    <div
                        class="dr-y-axis"
                        aria-hidden="true"
                    >

                        <span>
                            {{ $maxMonthlyDonations }}
                        </span>

                        <span>
                            {{ round($maxMonthlyDonations * .75, 1) }}
                        </span>

                        <span>
                            {{ round($maxMonthlyDonations * .5, 1) }}
                        </span>

                        <span>
                            {{ round($maxMonthlyDonations * .25, 1) }}
                        </span>

                        <span>
                            0
                        </span>

                    </div>


                    <div class="dr-plot">

                        <div class="dr-bars">

                            @foreach ($monthlyDonations as $month)

                                <div
                                    class="dr-bar-group"
                                    title="{{ $month['month'] }}: {{ $month['received'] }} received, {{ $month['processed'] }} processed"
                                >

                                    <div
                                        class="
                                            dr-bar
                                            received
                                        "
                                        style="
                                            height:
                                            {{
                                                max(
                                                    3,
                                                    ($month['received'] / $maxMonthlyDonations) * 100
                                                )
                                            }}%;
                                        "
                                    ></div>


                                    <div
                                        class="
                                            dr-bar
                                            processed
                                        "
                                        style="
                                            height:
                                            {{
                                                max(
                                                    3,
                                                    ($month['processed'] / $maxMonthlyDonations) * 100
                                                )
                                            }}%;
                                        "
                                    ></div>

                                </div>

                            @endforeach

                        </div>


                        <div class="dr-x-axis">

                            @foreach ($monthlyDonations as $month)

                                <span>
                                    {{ $month['month'] }}
                                </span>

                            @endforeach

                        </div>

                    </div>

                </div>


                <div class="dr-chart-legend">

                    <span class="dr-legend-item">

                        <span class="dr-legend-dot pink"></span>

                        Received

                    </span>


                    <span class="dr-legend-item">

                        <span class="dr-legend-dot teal"></span>

                        Processed

                    </span>

                </div>

            </div>

        </section>

    </div>


    {{-- =============================================================
         CATEGORY SUMMARY
         ============================================================= --}}

    <section class="dr-card">

        <header class="dr-section-heading">

            <div class="dr-section-title">

                <span class="dr-section-number">
                    03
                </span>

                <div>

                    <h2>
                        Donated Resource Categories
                    </h2>

                    <p>
                        Breakdown of current donation records by physical resource category.
                    </p>

                </div>

            </div>


            <span class="dr-source">
                {{ count($categoryStats) }}
                Categories
            </span>

        </header>


        <div class="dr-category-grid">

            @foreach ($categoryStats as $category)

                <article
                    class="dr-category"
                    data-tone="{{ $category['tone'] }}"
                >

                    <span
                        class="dr-category-icon"
                        aria-hidden="true"
                    >

                        @if ($category['icon'] === 'furniture')

                            <svg viewBox="0 0 24 24">
                                <path d="M5 11h14"/>
                                <path d="M6 11V6h12v5"/>
                                <path d="M4 11v6h16v-6"/>
                                <path d="M6 17v3"/>
                                <path d="M18 17v3"/>
                            </svg>

                        @elseif ($category['icon'] === 'supplies')

                            <svg viewBox="0 0 24 24">
                                <rect
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="14"
                                    rx="2"
                                />

                                <path d="M8 9h8"/>
                                <path d="M8 13h5"/>
                            </svg>

                        @elseif ($category['icon'] === 'storage')

                            <svg viewBox="0 0 24 24">
                                <path d="M4 7h16v13H4Z"/>
                                <path d="M3 4h18v3H3Z"/>
                                <path d="M9 11h6"/>
                            </svg>

                        @else

                            <svg viewBox="0 0 24 24">
                                <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                                <path d="M3 8v9l9 5 9-5V8"/>
                                <path d="M12 13v9"/>
                            </svg>

                        @endif

                    </span>


                    <div class="dr-category-copy">

                        <div class="dr-category-row">

                            <span class="dr-category-name">
                                {{ $category['label'] }}
                            </span>


                            <strong class="dr-category-value">
                                {{ $category['value'] }}
                            </strong>

                        </div>


                        <p>
                            {{ $category['units'] }}

                            donated

                            {{ $category['units'] === 1 ? 'unit' : 'units' }}

                            recorded in this category.
                        </p>

                    </div>

                </article>

            @endforeach

        </div>

    </section>


    {{-- =============================================================
         DONATION REGISTER
         ============================================================= --}}

    <section class="dr-card">

        <header class="dr-section-heading">

            <div class="dr-section-title">

                <span class="dr-section-number teal">
                    04
                </span>

                <div>

                    <h2>
                        Donation Intake Register
                    </h2>

                    <p>
                        Physical resource donations, verification,
                        condition, and current allocation destination.
                    </p>

                </div>

            </div>


            <span class="dr-source">
                {{ $totalDonations }}
                Records
            </span>

        </header>


        <div class="dr-toolbar dr-no-print">

            <div
                class="dr-filter-row"
                role="group"
                aria-label="Filter donations by status"
            >

                <button
                    class="
                        dr-filter
                        is-active
                    "
                    type="button"
                    data-donation-filter="all"
                >
                    All
                </button>


                <button
                    class="dr-filter"
                    type="button"
                    data-donation-filter="Pending Verification"
                >
                    Pending Verification
                </button>


                <button
                    class="dr-filter"
                    type="button"
                    data-donation-filter="Verified"
                >
                    Verified
                </button>


                <button
                    class="dr-filter"
                    type="button"
                    data-donation-filter="Allocated"
                >
                    Allocated
                </button>


                <button
                    class="dr-filter"
                    type="button"
                    data-donation-filter="Added to Inventory"
                >
                    Added to Inventory
                </button>

            </div>


            <span class="dr-record-count">

                Showing

                <strong id="dr-visible-count">
                    {{ $totalDonations }}
                </strong>

                of

                <strong>
                    {{ $totalDonations }}
                </strong>

                records

            </span>

        </div>


        <div
            class="dr-table-wrap custom-scrollbar"
            role="region"
            aria-label="Donation report table"
            tabindex="0"
        >

            <table class="dr-table">

                <thead>

                    <tr>

                        <th scope="col">
                            Donation
                        </th>

                        <th scope="col">
                            Donor
                        </th>

                        <th scope="col">
                            Category
                        </th>

                        <th scope="col">
                            Quantity
                        </th>

                        <th scope="col">
                            Condition
                        </th>

                        <th scope="col">
                            Received
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th scope="col">
                            Allocation
                        </th>

                        <th
                            scope="col"
                            class="dr-no-print"
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody id="dr-donation-rows">

                    @foreach ($donations as $donation)

                        <tr
                            data-donation-row
                            data-donation-status="{{ $donation['status'] }}"
                        >

                            <td>

                                <strong class="dr-item-name">
                                    {{ $donation['item'] }}
                                </strong>

                                <span class="dr-sub">
                                    {{ $donation['id'] }}
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $donation['donor'] }}
                                </strong>

                                <span class="dr-sub">
                                    {{ $donation['donor_type'] }}
                                </span>

                            </td>


                            <td>
                                {{ $donation['category'] }}
                            </td>


                            <td>

                                <strong class="dr-quantity">
                                    {{ $donation['quantity'] }}
                                </strong>

                                <span class="dr-sub">
                                    units
                                </span>

                            </td>


                            <td>

                                <span class="dr-condition">
                                    {{ $donation['condition'] }}
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $donation['date'] }}
                                </strong>

                                <span class="dr-sub">
                                    By {{ $donation['received_by'] }}
                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        dr-badge
                                        {{ $donation['tone'] }}
                                    "
                                >
                                    {{ $donation['status'] }}
                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        dr-allocation
                                        {{ $donation['allocation'] === 'Unallocated' ? 'is-unallocated' : '' }}
                                    "
                                >
                                    {{ $donation['allocation'] }}
                                </span>

                            </td>


                            <td class="dr-no-print">

                                <a
                                    class="dr-view"
                                    href="{{ route('donations.show', ['id' => $donation['id']]) }}"
                                    title="View donation details"
                                    aria-label="View {{ $donation['id'] }}"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            <div
                class="dr-empty"
                id="dr-empty"
            >

                <strong>
                    No matching donation records
                </strong>

                <p>
                    Select another processing status to display records.
                </p>

            </div>

        </div>


        <footer class="dr-table-footer">

            <p>
                Total donated units:

                <strong>
                    {{ $totalUnits }}
                </strong>
            </p>


            <p>
                Processed records:

                <strong>
                    {{ $processedDonations }}
                    /
                    {{ $totalDonations }}
                </strong>
            </p>


            <p>
                Verified:

                <strong>
                    {{ $verifiedDonations }}
                </strong>
            </p>


            <p>
                Added to inventory:

                <strong>
                    {{ $inventoryDonations }}
                </strong>
            </p>

        </footer>

    </section>


    <p class="dr-note">
        Monthly donation activity uses historical sample analytics,
        while the KPI summary, status distribution, category breakdown,
        and donation register reflect the current five physical donation
        records used by the PULSO Logistics Hub front-end preview.
    </p>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeDonationsReport = () => {
        const page =
            document.getElementById(
                'donation-report'
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
                    '[data-donation-filter]'
                )
            );


        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-donation-row]'
                )
            );


        const empty =
            page.querySelector(
                '#dr-empty'
            );


        const visibleCount =
            page.querySelector(
                '#dr-visible-count'
            );


        const printButton =
            page.querySelector(
                '#dr-print'
            );


        const applyFilter = (
            selected
        ) => {
            let visible =
                0;


            rows.forEach(
                (row) => {
                    const matches =
                        selected ===
                            'all'
                        ||
                        row.dataset.donationStatus ===
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


            empty?.classList.toggle(
                'is-visible',
                visible ===
                    0
            );
        };


        filters.forEach(
            (button) => {
                button.addEventListener(
                    'click',
                    () => {
                        const selected =
                            button.dataset.donationFilter
                            ||
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


                        applyFilter(
                            selected
                        );
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


        applyFilter(
            'all'
        );
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeDonationsReport,
            {
                once: true
            }
        );
    } else {
        initializeDonationsReport();
    }
})();
</script>
@endpush