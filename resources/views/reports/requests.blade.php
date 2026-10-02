@extends('layouts.app')

@section('title', 'Logistics Requests Report | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | KPI SUMMARY
    |--------------------------------------------------------------------------
    */

    $requestStats = [
        [
            'label' => 'Total Requests',
            'value' => 7,
            'helper' => 'Current logistics requests',
            'tone' => 'navy',
            'icon' => 'requests',
        ],
        [
            'label' => 'Needs Resolution',
            'value' => 1,
            'helper' => 'Resource issue to resolve',
            'tone' => 'pink',
            'icon' => 'resolution',
        ],
        [
            'label' => 'Approved',
            'value' => 2,
            'helper' => 'Approved for logistics',
            'tone' => 'teal',
            'icon' => 'approved',
        ],
        [
            'label' => 'Preparing',
            'value' => 2,
            'helper' => 'Resources being prepared',
            'tone' => 'gold',
            'icon' => 'preparing',
        ],
        [
            'label' => 'Completed',
            'value' => 1,
            'helper' => 'Successfully fulfilled',
            'tone' => 'blue',
            'icon' => 'completed',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | STATUS DATA
    |--------------------------------------------------------------------------
    */

    $statusData = [
        [
            'label' => 'Pending',
            'value' => 1,
            'tone' => 'gold',
        ],
        [
            'label' => 'Needs Resolution',
            'value' => 1,
            'tone' => 'pink',
        ],
        [
            'label' => 'Approved',
            'value' => 2,
            'tone' => 'teal',
        ],
        [
            'label' => 'Preparing',
            'value' => 2,
            'tone' => 'navy',
        ],
        [
            'label' => 'Completed',
            'value' => 1,
            'tone' => 'blue',
        ],
        [
            'label' => 'Declined',
            'value' => 0,
            'tone' => 'pink',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | PRIORITY DATA
    |--------------------------------------------------------------------------
    */

    $priorityData = [
        [
            'label' => 'High',
            'value' => 3,
            'tone' => 'pink',
        ],
        [
            'label' => 'Medium',
            'value' => 2,
            'tone' => 'gold',
        ],
        [
            'label' => 'Low',
            'value' => 2,
            'tone' => 'navy',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | MONTHLY REQUEST ACTIVITY
    |--------------------------------------------------------------------------
    |
    | Historical activity sample. This is separate from the seven current
    | request records shown in the current register.
    |
    */

    $monthlyRequests = [
        [
            'month' => 'Apr',
            'count' => 12,
        ],
        [
            'month' => 'May',
            'count' => 17,
        ],
        [
            'month' => 'Jun',
            'count' => 14,
        ],
        [
            'month' => 'Jul',
            'count' => 21,
        ],
        [
            'month' => 'Aug',
            'count' => 25,
        ],
        [
            'month' => 'Sep',
            'count' => 19,
        ],
    ];


    $maxMonthlyRequests = max(
        array_column(
            $monthlyRequests,
            'count'
        )
    );


    /*
    |--------------------------------------------------------------------------
    | CURRENT REQUEST RECORDS
    |--------------------------------------------------------------------------
    */

    $requests = [
        [
            'id' => 'REQ-2026-0047',
            'requester' => 'Maria Santos',
            'committee' => 'Events Committee',
            'project' => 'Youth Leadership Summit',
            'resources' => 3,
            'priority' => 'High',
            'status' => 'Needs Resolution',
            'needed' => 'Sep 12, 2026',
            'submitted' => 'Sep 10, 2026',
        ],
        [
            'id' => 'REQ-2026-0046',
            'requester' => 'Joshua Reyes',
            'committee' => 'Community Outreach',
            'project' => 'Medical Mission',
            'resources' => 5,
            'priority' => 'High',
            'status' => 'Approved',
            'needed' => 'Sep 15, 2026',
            'submitted' => 'Sep 10, 2026',
        ],
        [
            'id' => 'REQ-2026-0045',
            'requester' => 'Angela Cruz',
            'committee' => 'Environment & Health',
            'project' => 'Coastal Clean-Up Drive',
            'resources' => 4,
            'priority' => 'Medium',
            'status' => 'Preparing',
            'needed' => 'Sep 18, 2026',
            'submitted' => 'Sep 09, 2026',
        ],
        [
            'id' => 'REQ-2026-0044',
            'requester' => 'Carlo Mendoza',
            'committee' => 'Education Committee',
            'project' => 'School Supply Distribution',
            'resources' => 6,
            'priority' => 'Medium',
            'status' => 'Approved',
            'needed' => 'Sep 21, 2026',
            'submitted' => 'Sep 09, 2026',
        ],
        [
            'id' => 'REQ-2026-0043',
            'requester' => 'Ramon Garcia',
            'committee' => 'Sports Committee',
            'project' => 'Youth Sports Festival',
            'resources' => 4,
            'priority' => 'Low',
            'status' => 'Pending',
            'needed' => 'Sep 22, 2026',
            'submitted' => 'Sep 08, 2026',
        ],
        [
            'id' => 'REQ-2026-0042',
            'requester' => 'Liza Torres',
            'committee' => 'Community Outreach',
            'project' => 'Community Feeding Program',
            'resources' => 7,
            'priority' => 'High',
            'status' => 'Preparing',
            'needed' => 'Sep 25, 2026',
            'submitted' => 'Sep 08, 2026',
        ],
        [
            'id' => 'REQ-2026-0041',
            'requester' => 'Nicole Ramos',
            'committee' => 'Volunteer Management',
            'project' => 'PULSO Volunteer Orientation',
            'resources' => 3,
            'priority' => 'Low',
            'status' => 'Completed',
            'needed' => 'Sep 28, 2026',
            'submitted' => 'Sep 07, 2026',
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


    $priorityTotal = array_sum(
        array_column(
            $priorityData,
            'value'
        )
    );


    $pendingCount = 1;
    $resolutionCount = 1;
    $approvedCount = 2;
    $preparingCount = 2;
    $completedCount = 1;
    $declinedCount = 0;


    $openCount =
        $statusTotal
        - $completedCount
        - $declinedCount;


    $openRate = round(
        (
            $openCount
            /
            $statusTotal
        ) * 100,
        1
    );


    $resolutionRate = round(
        (
            $resolutionCount
            /
            $statusTotal
        ) * 100,
        1
    );


    $preparingRate = round(
        (
            $preparingCount
            /
            $statusTotal
        ) * 100,
        1
    );


    $completionRate = round(
        (
            $completedCount
            /
            $statusTotal
        ) * 100,
        1
    );
@endphp


@push('styles')
<style>
    /* ================================================================
       REQUESTS REPORT
       ================================================================ */

    .requests-report {
        --rr-navy: #10263d;
        --rr-text: #31546d;
        --rr-muted: #688297;

        --rr-teal: #007780;
        --rr-pink: #b90c61;
        --rr-gold: #895408;
        --rr-blue: #245b99;

        --rr-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--rr-navy);

        container-name: requests-report;
        container-type: inline-size;
    }


    .requests-report *,
    .requests-report *::before,
    .requests-report *::after {
        box-sizing: border-box;
    }


    .requests-report [hidden] {
        display: none !important;
    }


    .rr-heading,
    .rr-actions,
    .rr-section-heading,
    .rr-section-title,
    .rr-filter-row,
    .rr-status-head,
    .rr-table-footer {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADER
       ================================================================ */

    .rr-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .rr-heading-copy {
        min-width: 0;
    }


    .rr-eyebrow {
        margin: 0 0 7px;

        color: var(--rr-teal);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .rr-heading h1 {
        margin: 0;

        color: var(--rr-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .rr-description {
        max-width: 790px;

        margin: 9px 0 0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .rr-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .rr-button {
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


    .rr-button:hover {
        color: var(--rr-teal);

        transform: translateY(-1px);
    }


    .rr-button-primary {
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


    .rr-button-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    .rr-button svg {
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
       EXACT PREVIOUS VISUAL STYLE
       ================================================================ */

    .requests-report > .rr-summary-grid {
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
    }


    .requests-report > .rr-summary-grid::before,
    .requests-report > .rr-summary-grid::after {
        display: none !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .rr-summary {
        --rr-accent: #173b59;

        --rr-icon-bg:
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


    .rr-summary::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 32px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--rr-accent);

        opacity: .5;

        content: "";
    }


    .rr-summary[data-tone="navy"] {
        --rr-accent: #173b59;

        --rr-icon-bg:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .rr-summary[data-tone="gold"] {
        --rr-accent: #895408;

        --rr-icon-bg:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }


    .rr-summary[data-tone="teal"] {
        --rr-accent: #007780;

        --rr-icon-bg:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .rr-summary[data-tone="blue"] {
        --rr-accent: #245b99;

        --rr-icon-bg:
            linear-gradient(
                145deg,
                #e8f1fc,
                #dce8f7
            );
    }


    .rr-summary[data-tone="pink"] {
        --rr-accent: #b90c61;

        --rr-icon-bg:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .rr-summary-icon {
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

        background: var(--rr-icon-bg);

        color: var(--rr-accent);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .rr-summary-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .rr-summary-copy {
        min-width: 0;
    }


    .rr-summary-value {
        display: block;

        color: var(--rr-accent);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .rr-summary-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .rr-summary-helper {
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

    .rr-card {
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


    .rr-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding: 20px 22px;

        border-bottom:
            1px
            solid
            var(--rr-line);
    }


    .rr-section-title {
        gap: 12px;

        min-width: 0;
    }


    .rr-number {
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

        color: var(--rr-teal);

        font-size: 13px;
        font-weight: 850;
    }


    .rr-number.pink {
        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--rr-pink);
    }


    .rr-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .rr-section-title p {
        margin: 5px 0 0;

        color: #496580;

        font-size: 11px;
        line-height: 1.55;
    }


    .rr-source {
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

    .rr-analytics-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.1fr)
            minmax(0, .9fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .rr-analytics-grid .rr-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       MONTHLY REQUEST CHART
       ================================================================ */

    .rr-chart-wrap {
        display: grid;

        grid-template-columns:
            38px
            minmax(0, 1fr);

        gap: 10px;

        min-height: 280px;

        padding: 22px;
    }


    .rr-y-axis {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        padding-bottom: 25px;

        color: #71899c;

        font-size: 8.5px;

        text-align: right;
    }


    .rr-plot {
        position: relative;

        height: 225px;

        border-bottom:
            1px
            solid
            #cfe0e8;

        background-image:
            linear-gradient(
                to bottom,
                rgba(207, 224, 232, .30) 1px,
                transparent 1px
            );

        background-size:
            100%
            25%;
    }


    .rr-bars {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        align-items: end;

        gap: 18px;

        height: 100%;

        padding:
            10px
            7px
            0;
    }


    .rr-bar-column {
        display: flex;
        align-items: flex-end;
        justify-content: center;

        height: 100%;
    }


    .rr-bar {
        position: relative;

        width: min(28px, 58%);

        min-height: 5px;

        border-radius:
            7px
            7px
            2px
            2px;

        background:
            linear-gradient(
                180deg,
                #05adb6,
                #007780
            );

        box-shadow:
            0 4px 8px rgba(0, 119, 128, .08);
    }


    .rr-bar-value {
        position: absolute;

        top: -18px;
        left: 50%;

        color: #557489;

        font-size: 8px;
        font-weight: 750;

        transform: translateX(-50%);
    }


    .rr-x-axis {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 18px;

        padding:
            8px
            7px
            0;

        color: #71899c;

        font-size: 9px;

        text-align: center;
    }


    /* ================================================================
       STATUS BREAKDOWN
       ================================================================ */

    .rr-chart-summary {
        display: grid;
        align-content: center;

        min-height: 280px;

        gap: 14px;

        padding: 22px;
    }


    .rr-status-row {
        width: 100%;
    }


    .rr-status-head {
        justify-content: space-between;

        gap: 15px;
    }


    .rr-status-left {
        display: flex;
        align-items: center;

        gap: 8px;

        min-width: 0;
    }


    .rr-dot {
        width: 9px;
        height: 9px;

        flex: 0 0 9px;

        border-radius: 50%;
    }


    .rr-dot.teal {
        background: #05adb6;
    }


    .rr-dot.pink {
        background: #ee1280;
    }


    .rr-dot.gold {
        background: #c9a94c;
    }


    .rr-dot.blue {
        background: #245b99;
    }


    .rr-dot.navy {
        background: #31546d;
    }


    .rr-status-label {
        color: #31546d;

        font-size: 10px;
        font-weight: 700;
    }


    .rr-status-value {
        flex-shrink: 0;

        color: #10263d;

        font-size: 10px;
        font-weight: 800;

        font-variant-numeric: tabular-nums;
    }


    .rr-status-track {
        width: 100%;
        height: 7px;

        margin-top: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .12);
    }


    .rr-status-fill {
        height: 100%;

        border-radius: inherit;
    }


    .rr-status-fill.teal {
        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .rr-status-fill.pink {
        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .rr-status-fill.gold {
        background:
            linear-gradient(
                90deg,
                #e1c96f,
                #92701d
            );
    }


    .rr-status-fill.blue {
        background:
            linear-gradient(
                90deg,
                #668ec0,
                #245b99
            );
    }


    .rr-status-fill.navy {
        background:
            linear-gradient(
                90deg,
                #66839a,
                #31546d
            );
    }


    /* ================================================================
       SECONDARY ANALYTICS
       ================================================================ */

    .rr-two-column {
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


    .rr-two-column .rr-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       PRIORITY
       ================================================================ */

    .rr-priority-list {
        display: grid;
        align-content: center;

        min-height: 220px;

        gap: 17px;

        padding: 22px;
    }


    .rr-priority-row {
        display: grid;

        grid-template-columns:
            72px
            minmax(0, 1fr)
            36px;

        align-items: center;

        gap: 10px;
    }


    .rr-priority-label {
        color: #31546d;

        font-size: 10px;
        font-weight: 700;
    }


    .rr-priority-track {
        width: 100%;
        height: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #d8e8ee;

        box-shadow:
            inset 1px 1px 3px rgba(101, 138, 163, .12);
    }


    .rr-priority-fill {
        height: 100%;

        border-radius: inherit;
    }


    .rr-priority-fill.pink {
        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .rr-priority-fill.gold {
        background:
            linear-gradient(
                90deg,
                #e1c96f,
                #92701d
            );
    }


    .rr-priority-fill.navy {
        background:
            linear-gradient(
                90deg,
                #66839a,
                #31546d
            );
    }


    .rr-priority-value {
        color: #10263d;

        font-size: 10px;
        font-weight: 850;

        text-align: right;
    }


    /* ================================================================
       PERFORMANCE
       ================================================================ */

    .rr-performance-list {
        display: grid;
        align-content: center;

        min-height: 220px;

        gap: 17px;

        padding: 22px;
    }


    /* ================================================================
       TABLE TOOLBAR
       ================================================================ */

    .rr-table-toolbar {
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
            var(--rr-line);

        background:
            rgba(
                234,
                244,
                248,
                .35
            );
    }


    .rr-filter-row {
        flex-wrap: wrap;

        gap: 7px;
    }


    .rr-filter {
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


    .rr-filter:hover {
        border-color: #a8d8de;

        color: var(--rr-teal);
    }


    .rr-filter.is-active {
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

        color: var(--rr-teal);

        box-shadow:
            inset 2px 2px 4px rgba(70, 111, 130, .06);
    }


    .rr-search {
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


    .rr-search:focus {
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


    .rr-search::placeholder {
        color: #8195a5;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .rr-table-wrap {
        width: 100%;

        overflow-x: auto;
    }


    .rr-table {
        width: 100%;
        min-width: 1110px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .rr-table th {
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


    .rr-table td {
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


    .rr-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .rr-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .4
            );
    }


    .rr-request-id {
        display: block;

        color: #007780;

        font-size: 9.5px;
        font-weight: 800;

        white-space: nowrap;
    }


    .rr-requester {
        display: block;

        max-width: 190px;

        margin-top: 3px;

        color: #18344c;

        font-size: 10.5px;
        font-weight: 750;
        line-height: 1.4;
    }


    .rr-sub {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.45;
    }


    .rr-project {
        display: block;

        max-width: 210px;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 750;
    }


    .rr-resource-count {
        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    /* ================================================================
       BADGES
       ================================================================ */

    .rr-badge {
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


    .rr-badge.teal {
        background: #dff4f4;

        color: #007780;
    }


    .rr-badge.pink {
        background: #f8e0eb;

        color: #b90c61;
    }


    .rr-badge.gold {
        background: #fff0d7;

        color: #895408;
    }


    .rr-badge.blue {
        background: #e0edfc;

        color: #245b99;
    }


    .rr-badge.navy {
        background: #e2e9f2;

        color: #31546d;
    }


    /* ================================================================
       EMPTY STATE
       ================================================================ */

    .rr-empty {
        padding:
            40px
            22px;

        text-align: center;
    }


    .rr-empty strong {
        display: block;

        color: #173b59;

        font-size: 14px;
    }


    .rr-empty p {
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

    .rr-table-footer {
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
            var(--rr-line);
    }


    .rr-table-footer p {
        margin: 0;

        color: #496580;

        font-size: 9.5px;
    }


    .rr-table-footer strong {
        color: #10263d;
    }


    .rr-note {
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

    @container requests-report (max-width: 930px) {
        .requests-report > .rr-summary-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }
    }


    @container requests-report (max-width: 820px) {
        .rr-analytics-grid,
        .rr-two-column {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rr-table-toolbar {
            align-items: flex-start;

            flex-direction: column;
        }


        .rr-search {
            width: 100%;
        }
    }


    @container requests-report (max-width: 650px) {
        .rr-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .rr-actions {
            width: 100%;
        }


        .rr-actions .rr-button {
            flex: 1;
        }


        .requests-report > .rr-summary-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .rr-section-heading {
            align-items: flex-start;
        }


        .rr-source {
            display: none;
        }


        .rr-chart-wrap {
            grid-template-columns:
                32px
                minmax(0, 1fr);

            padding: 17px;
        }


        .rr-bars,
        .rr-x-axis {
            gap: 8px;
        }


        .rr-priority-row {
            grid-template-columns:
                64px
                1fr
                34px;
        }
    }


    @container requests-report (max-width: 450px) {
        .requests-report > .rr-summary-grid {
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


        body:has(#requests-report) #app-sidebar,
        body:has(#requests-report) #sidebar-backdrop,
        body:has(#requests-report) #pulso-topbar,
        body:has(#requests-report) .hub-skip-link,
        .requests-report .rr-no-print {
            display: none !important;
        }


        body:has(#requests-report) #app-main {
            padding-left: 0 !important;
        }


        body:has(#requests-report) .hub-content {
            padding: 0 !important;
        }


        .requests-report {
            container-type: normal;
        }


        .requests-report > .rr-summary-grid {
            grid-template-columns:
                repeat(
                    5,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .rr-summary {
            min-height: auto;

            padding: 9px;
        }


        .rr-summary-icon {
            display: none;
        }


        .rr-card,
        .rr-summary {
            border:
                1px
                solid
                #d6d6d6 !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .rr-card,
        .rr-summary {
            break-inside: avoid;
        }


        .rr-analytics-grid {
            grid-template-columns:
                1.1fr
                .9fr;

            gap: 10px;
        }


        .rr-two-column {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            gap: 10px;
        }


        .rr-table {
            min-width: 0;

            table-layout: fixed;
        }


        .rr-table th,
        .rr-table td {
            padding:
                7px
                5px;

            overflow-wrap: anywhere;
        }


        .rr-table thead {
            display: table-header-group;
        }


        .rr-table tr {
            break-inside: avoid;
        }


        .rr-badge {
            white-space: normal;
        }
    }
</style>
@endpush


@section('content')
<div
    class="requests-report"
    id="requests-report"
>

    {{-- =============================================================
         HEADER
         ============================================================= --}}

    <header class="rr-heading">

        <div class="rr-heading-copy">

            <p class="rr-eyebrow">
                Request analytics
            </p>

            <h1>
                Logistics Requests Report
            </h1>

            <p class="rr-description">
                Monitor current request workload, logistics preparation,
                resource issues, priority levels, and historical request
                activity across PULSO operations.
            </p>

        </div>


        <div class="rr-actions rr-no-print">

            <a
                class="rr-button"
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
                    rr-button
                    rr-button-primary
                "
                id="rr-print"
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
        class="rr-summary-grid"
        aria-label="Logistics request summary"
    >

        @foreach ($requestStats as $stat)

            <article
                class="rr-summary"
                data-tone="{{ $stat['tone'] }}"
            >

                <span
                    class="rr-summary-icon"
                    aria-hidden="true"
                >

                    @if ($stat['icon'] === 'requests')

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

                    @elseif ($stat['icon'] === 'resolution')

                        <svg viewBox="0 0 24 24">
                            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>

                    @elseif ($stat['icon'] === 'approved')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                    @elseif ($stat['icon'] === 'preparing')

                        <svg viewBox="0 0 24 24">
                            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                            <path d="M3 8v9l9 5 9-5V8"/>
                            <path d="M12 13v9"/>
                        </svg>

                    @else

                        <svg viewBox="0 0 24 24">
                            <path d="M4 12.5 9 17l11-11"/>
                            <path d="M4 6h7"/>
                            <path d="M4 10h4"/>
                        </svg>

                    @endif

                </span>


                <div class="rr-summary-copy">

                    <strong class="rr-summary-value">
                        {{ number_format($stat['value']) }}
                    </strong>

                    <span class="rr-summary-label">
                        {{ $stat['label'] }}
                    </span>

                    <span class="rr-summary-helper">
                        {{ $stat['helper'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         MONTHLY ACTIVITY + STATUS
         ============================================================= --}}

    <div class="rr-analytics-grid">

        <section class="rr-card">

            <header class="rr-section-heading">

                <div class="rr-section-title">

                    <span class="rr-number">
                        01
                    </span>

                    <div>

                        <h2>
                            Monthly Request Activity
                        </h2>

                        <p>
                            Historical request volume recorded from April to September.
                        </p>

                    </div>

                </div>


                <span class="rr-source">
                    Apr – Sep 2026
                </span>

            </header>


            <div class="rr-chart-wrap">

                <div
                    class="rr-y-axis"
                    aria-hidden="true"
                >
                    <span>
                        {{ $maxMonthlyRequests }}
                    </span>

                    <span>
                        {{ round($maxMonthlyRequests * .75) }}
                    </span>

                    <span>
                        {{ round($maxMonthlyRequests * .5) }}
                    </span>

                    <span>
                        {{ round($maxMonthlyRequests * .25) }}
                    </span>

                    <span>
                        0
                    </span>
                </div>


                <div>

                    <div class="rr-plot">

                        <div class="rr-bars">

                            @foreach ($monthlyRequests as $month)

                                @php
                                    $height = round(
                                        (
                                            $month['count']
                                            /
                                            $maxMonthlyRequests
                                        ) * 100,
                                        1
                                    );
                                @endphp


                                <div class="rr-bar-column">

                                    <div
                                        class="rr-bar"
                                        style="
                                            height:
                                            {{ $height }}%;
                                        "
                                        title="{{ $month['month'] }}: {{ $month['count'] }} requests"
                                    >

                                        <span class="rr-bar-value">
                                            {{ $month['count'] }}
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    <div class="rr-x-axis">

                        @foreach ($monthlyRequests as $month)

                            <span>
                                {{ $month['month'] }}
                            </span>

                        @endforeach

                    </div>

                </div>

            </div>

        </section>


        <section class="rr-card">

            <header class="rr-section-heading">

                <div class="rr-section-title">

                    <span class="rr-number pink">
                        02
                    </span>

                    <div>

                        <h2>
                            Request Status Breakdown
                        </h2>

                        <p>
                            Current distribution of request statuses.
                        </p>

                    </div>

                </div>


                <span class="rr-source">
                    {{ $statusTotal }}
                    Requests
                </span>

            </header>


            <div class="rr-chart-summary">

                @foreach ($statusData as $status)

                    @php
                        $percentage =
                            $statusTotal > 0
                                ? round(
                                    (
                                        $status['value']
                                        /
                                        $statusTotal
                                    ) * 100,
                                    1
                                )
                                : 0;
                    @endphp


                    <div class="rr-status-row">

                        <div class="rr-status-head">

                            <span class="rr-status-left">

                                <span
                                    class="
                                        rr-dot
                                        {{ $status['tone'] }}
                                    "
                                ></span>

                                <span class="rr-status-label">
                                    {{ $status['label'] }}
                                </span>

                            </span>


                            <strong class="rr-status-value">
                                {{ $status['value'] }}
                                ·
                                {{ $percentage }}%
                            </strong>

                        </div>


                        <div class="rr-status-track">

                            <div
                                class="
                                    rr-status-fill
                                    {{ $status['tone'] }}
                                "
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
         PRIORITY + PERFORMANCE
         ============================================================= --}}

    <div class="rr-two-column">

        <section class="rr-card">

            <header class="rr-section-heading">

                <div class="rr-section-title">

                    <span class="rr-number">
                        03
                    </span>

                    <div>

                        <h2>
                            Request Priority
                        </h2>

                        <p>
                            Current requests grouped by priority level.
                        </p>

                    </div>

                </div>

            </header>


            <div class="rr-priority-list">

                @foreach ($priorityData as $priority)

                    @php
                        $percentage =
                            $priorityTotal > 0
                                ? round(
                                    (
                                        $priority['value']
                                        /
                                        $priorityTotal
                                    ) * 100,
                                    1
                                )
                                : 0;
                    @endphp


                    <div class="rr-priority-row">

                        <span class="rr-priority-label">
                            {{ $priority['label'] }}
                        </span>


                        <div
                            class="rr-priority-track"
                            title="{{ $percentage }}%"
                        >

                            <div
                                class="
                                    rr-priority-fill
                                    {{ $priority['tone'] }}
                                "
                                style="
                                    width:
                                    {{ $percentage }}%;
                                "
                            ></div>

                        </div>


                        <strong class="rr-priority-value">
                            {{ $priority['value'] }}
                        </strong>

                    </div>

                @endforeach

            </div>

        </section>


        <section class="rr-card">

            <header class="rr-section-heading">

                <div class="rr-section-title">

                    <span class="rr-number pink">
                        04
                    </span>

                    <div>

                        <h2>
                            Request Performance
                        </h2>

                        <p>
                            Quick operational indicators.
                        </p>

                    </div>

                </div>

            </header>


            <div class="rr-performance-list">

                <div class="rr-status-row">

                    <div class="rr-status-head">

                        <span class="rr-status-label">
                            Open Requests
                        </span>

                        <strong class="rr-status-value">
                            {{ $openCount }}
                            ·
                            {{ $openRate }}%
                        </strong>

                    </div>


                    <div class="rr-status-track">

                        <div
                            class="
                                rr-status-fill
                                navy
                            "
                            style="
                                width:
                                {{ $openRate }}%;
                            "
                        ></div>

                    </div>

                </div>


                <div class="rr-status-row">

                    <div class="rr-status-head">

                        <span class="rr-status-label">
                            Needs Resolution
                        </span>

                        <strong class="rr-status-value">
                            {{ $resolutionCount }}
                            ·
                            {{ $resolutionRate }}%
                        </strong>

                    </div>


                    <div class="rr-status-track">

                        <div
                            class="
                                rr-status-fill
                                pink
                            "
                            style="
                                width:
                                {{ $resolutionRate }}%;
                            "
                        ></div>

                    </div>

                </div>


                <div class="rr-status-row">

                    <div class="rr-status-head">

                        <span class="rr-status-label">
                            In Preparation
                        </span>

                        <strong class="rr-status-value">
                            {{ $preparingCount }}
                            ·
                            {{ $preparingRate }}%
                        </strong>

                    </div>


                    <div class="rr-status-track">

                        <div
                            class="
                                rr-status-fill
                                gold
                            "
                            style="
                                width:
                                {{ $preparingRate }}%;
                            "
                        ></div>

                    </div>

                </div>


                <div class="rr-status-row">

                    <div class="rr-status-head">

                        <span class="rr-status-label">
                            Completion Rate
                        </span>

                        <strong class="rr-status-value">
                            {{ $completedCount }}
                            ·
                            {{ $completionRate }}%
                        </strong>

                    </div>


                    <div class="rr-status-track">

                        <div
                            class="
                                rr-status-fill
                                blue
                            "
                            style="
                                width:
                                {{ $completionRate }}%;
                            "
                        ></div>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =============================================================
         DETAILED REQUEST RECORDS
         ============================================================= --}}

    <section class="rr-card">

        <header class="rr-section-heading">

            <div class="rr-section-title">

                <span class="rr-number pink">
                    05
                </span>

                <div>

                    <h2>
                        Detailed Request Records
                    </h2>

                    <p>
                        Search and filter the current logistics request register.
                    </p>

                </div>

            </div>


            <span class="rr-source">
                {{ count($requests) }}
                Current Records
            </span>

        </header>


        <div class="rr-table-toolbar rr-no-print">

            <div
                class="rr-filter-row"
                role="group"
                aria-label="Request status filters"
            >

                <button
                    class="
                        rr-filter
                        is-active
                    "
                    type="button"
                    data-status-filter="all"
                >
                    All
                </button>


                <button
                    class="rr-filter"
                    type="button"
                    data-status-filter="Pending"
                >
                    Pending
                </button>


                <button
                    class="rr-filter"
                    type="button"
                    data-status-filter="Needs Resolution"
                >
                    Needs Resolution
                </button>


                <button
                    class="rr-filter"
                    type="button"
                    data-status-filter="Approved"
                >
                    Approved
                </button>


                <button
                    class="rr-filter"
                    type="button"
                    data-status-filter="Preparing"
                >
                    Preparing
                </button>


                <button
                    class="rr-filter"
                    type="button"
                    data-status-filter="Completed"
                >
                    Completed
                </button>


                <button
                    class="rr-filter"
                    type="button"
                    data-status-filter="Declined"
                >
                    Declined
                </button>

            </div>


            <input
                class="rr-search"
                id="rr-search"
                type="search"
                placeholder="Search request..."
                autocomplete="off"
                aria-label="Search requests"
            >

        </div>


        <div
            class="rr-table-wrap custom-scrollbar"
            role="region"
            aria-label="Logistics requests report"
            tabindex="0"
        >

            <table class="rr-table">

                <thead>
                    <tr>

                        <th scope="col">
                            Request
                        </th>

                        <th scope="col">
                            Project / Activity
                        </th>

                        <th scope="col">
                            Needed Date
                        </th>

                        <th scope="col">
                            Resources
                        </th>

                        <th scope="col">
                            Priority
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th scope="col">
                            Submitted
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @foreach ($requests as $request)

                        @php
                            $statusTone = match ($request['status']) {
                                'Pending' => 'gold',
                                'Needs Resolution' => 'pink',
                                'Approved' => 'teal',
                                'Preparing' => 'navy',
                                'Completed' => 'blue',
                                'Declined' => 'pink',
                                default => 'navy',
                            };

                            $priorityTone = match ($request['priority']) {
                                'High' => 'pink',
                                'Medium' => 'gold',
                                'Low' => 'navy',
                                default => 'navy',
                            };
                        @endphp


                        <tr
                            data-request-row
                            data-status="{{ $request['status'] }}"
                            data-search="{{ strtolower(
                                $request['id']
                                . ' '
                                . $request['requester']
                                . ' '
                                . $request['committee']
                                . ' '
                                . $request['project']
                                . ' '
                                . $request['priority']
                                . ' '
                                . $request['status']
                                . ' '
                                . $request['needed']
                            ) }}"
                        >

                            <td>

                                <span class="rr-request-id">
                                    {{ $request['id'] }}
                                </span>

                                <span class="rr-requester">
                                    {{ $request['requester'] }}
                                </span>

                                <span class="rr-sub">
                                    {{ $request['committee'] }}
                                </span>

                            </td>


                            <td>

                                <strong class="rr-project">
                                    {{ $request['project'] }}
                                </strong>

                            </td>


                            <td>

                                <strong>
                                    {{ $request['needed'] }}
                                </strong>

                            </td>


                            <td>

                                <span class="rr-resource-count">
                                    {{ $request['resources'] }}

                                    {{ $request['resources'] === 1 ? 'resource type' : 'resource types' }}
                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        rr-badge
                                        {{ $priorityTone }}
                                    "
                                >
                                    {{ $request['priority'] }}
                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        rr-badge
                                        {{ $statusTone }}
                                    "
                                >
                                    {{ $request['status'] }}
                                </span>

                            </td>


                            <td>
                                {{ $request['submitted'] }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            <div
                class="rr-empty"
                id="rr-empty"
                hidden
            >

                <strong>
                    No matching requests found
                </strong>

                <p>
                    Try another status filter or search keyword.
                </p>

            </div>

        </div>


        <footer class="rr-table-footer">

            <p>
                Showing

                <strong id="rr-visible-count">
                    {{ count($requests) }}
                </strong>

                of

                <strong>
                    {{ count($requests) }}
                </strong>

                request records.
            </p>


            <p>
                Needs action:

                <strong>
                    {{ $pendingCount + $resolutionCount }}
                </strong>
            </p>


            <p>
                Completed:

                <strong>
                    {{ $completedCount }}
                </strong>
            </p>

        </footer>

    </section>


    <p class="rr-note">
        Monthly activity uses historical sample analytics, while the
        KPI summary, status distribution, priority breakdown, performance,
        and detailed register reflect the current seven request records.
    </p>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeRequestsReport = () => {
        const page =
            document.getElementById(
                'requests-report'
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
                    '[data-request-row]'
                )
            );


        const search =
            page.querySelector(
                '#rr-search'
            );


        const empty =
            page.querySelector(
                '#rr-empty'
            );


        const visibleCount =
            page.querySelector(
                '#rr-visible-count'
            );


        const printButton =
            page.querySelector(
                '#rr-print'
            );


        let activeStatus =
            'all';


        const applyFilters = () => {
            const keyword =
                search
                    ? search.value
                        .trim()
                        .toLowerCase()
                    : '';


            let count =
                0;


            rows.forEach((row) => {
                const rowStatus =
                    row.dataset.status ||
                    '';


                const rowSearch =
                    row.dataset.search ||
                    '';


                const matchesStatus =
                    activeStatus ===
                        'all' ||
                    rowStatus ===
                        activeStatus;


                const matchesSearch =
                    !keyword ||
                    rowSearch.includes(
                        keyword
                    );


                const visible =
                    matchesStatus &&
                    matchesSearch;


                row.hidden =
                    !visible;


                if (visible) {
                    count +=
                        1;
                }
            });


            if (visibleCount) {
                visibleCount.textContent =
                    String(
                        count
                    );
            }


            if (empty) {
                empty.hidden =
                    count !==
                    0;
            }
        };


        filters.forEach((button) => {
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
        });


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


        applyFilters();
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeRequestsReport,
            {
                once: true
            }
        );
    } else {
        initializeRequestsReport();
    }
})();
</script>
@endpush