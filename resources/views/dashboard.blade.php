@extends('layouts.app')

@section('title', 'Dashboard | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | ASSET STATUS
    |--------------------------------------------------------------------------
    */

    $assetStatuses = [
        [
            'label' => 'Available',
            'value' => 121,
            'color' => '#007780',
        ],
        [
            'label' => 'Borrowed',
            'value' => 9,
            'color' => '#b90c61',
        ],
        [
            'label' => 'Deployed',
            'value' => 12,
            'color' => '#31546d',
        ],
        [
            'label' => 'Maintenance',
            'value' => 3,
            'color' => '#895408',
        ],
        [
            'label' => 'Damaged',
            'value' => 3,
            'color' => '#ad343d',
        ],
    ];

    $totalAssets = array_sum(
        array_column(
            $assetStatuses,
            'value'
        )
    );


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD KPI
    |--------------------------------------------------------------------------
    */

    $summaryCards = [
        [
            'label' => 'Total Assets',
            'value' => 148,
            'description' => 'Registered logistics assets',
            'icon' => 'box',
            'tone' => 'teal',
            'href' => route('inventory.index'),
        ],
        [
            'label' => 'Available Assets',
            'value' => 121,
            'description' => 'Ready for logistics use',
            'icon' => 'check',
            'tone' => 'green',
            'href' => route('inventory.index'),
        ],
        [
            'label' => 'Borrowed Assets',
            'value' => 9,
            'description' => 'Assets currently borrowed',
            'icon' => 'exchange',
            'tone' => 'pink',
            'href' => route('inventory.index'),
        ],
        [
            'label' => 'Active Borrowings',
            'value' => 12,
            'description' => 'Open borrowing transactions',
            'icon' => 'borrow',
            'tone' => 'navy',
            'href' => route('borrow.index'),
        ],
        [
            'label' => 'Pending Requests',
            'value' => 8,
            'description' => 'Requests waiting for action',
            'icon' => 'requests',
            'tone' => 'pink',
            'href' => route('requests.index'),
        ],
        [
            'label' => 'Active Projects',
            'value' => 3,
            'description' => 'Under logistics coordination',
            'icon' => 'projects',
            'tone' => 'gold',
            'href' => route('projects.index'),
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | RECENT REQUESTS
    |--------------------------------------------------------------------------
    */

    $recentRequests = [
        [
            'id' => 'REQ-2026-0042',
            'committee' => 'Events Committee',
            'project' => 'Youth Leadership Summit',
            'date' => 'Sep 12, 2026',
            'status' => 'Approved',
            'tone' => 'approved',
        ],
        [
            'id' => 'REQ-2026-0039',
            'committee' => 'Community Outreach',
            'project' => 'Medical Mission',
            'date' => 'Sep 13, 2026',
            'status' => 'Approved',
            'tone' => 'approved',
        ],
        [
            'id' => 'REQ-2026-0035',
            'committee' => 'Environment & Health',
            'project' => 'Coastal Clean-Up Drive',
            'date' => 'Sep 10, 2026',
            'status' => 'Completed',
            'tone' => 'completed',
        ],
        [
            'id' => 'REQ-2026-0031',
            'committee' => 'Volunteer Management',
            'project' => 'Volunteer Orientation',
            'date' => 'Sep 7, 2026',
            'status' => 'Completed',
            'tone' => 'completed',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | RECENT ACTIVITY
    |--------------------------------------------------------------------------
    */

    $activities = [
        [
            'title' => 'Project logistics completed',
            'description' => 'PRJ-2026-0015 · Volunteer Orientation',
            'time' => 'Sep 13 · 3:40 PM',
            'icon' => 'projects',
            'tone' => 'gold',
        ],
        [
            'title' => 'Donated resource added',
            'description' => 'DON-2026-0009 · Extension Cords 20m',
            'time' => 'Sep 13 · 2:00 PM',
            'icon' => 'box',
            'tone' => 'teal',
        ],
        [
            'title' => 'Donation allocated',
            'description' => 'DON-2026-0010 · Medical Mission',
            'time' => 'Sep 13 · 10:20 AM',
            'icon' => 'donations',
            'tone' => 'green',
        ],
        [
            'title' => 'Folding tables returned',
            'description' => 'BRW-2026-009 · School Supply Distribution',
            'time' => 'Sep 12 · 4:18 PM',
            'icon' => 'exchange',
            'tone' => 'navy',
        ],
        [
            'title' => 'Project marked ready',
            'description' => 'PRJ-2026-0017 · Medical Mission',
            'time' => 'Sep 12 · 11:30 AM',
            'icon' => 'check',
            'tone' => 'teal',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | ACTIVE PROJECTS
    |--------------------------------------------------------------------------
    */

    $projects = [
        [
            'day' => '12',
            'name' => 'Youth Leadership Summit',
            'venue' => 'PULSO Activity Center',
            'resources' => '2 of 3 resource types ready',
            'status' => 'Resource Allocation',
            'tone' => 'pink',
        ],
        [
            'day' => '13',
            'name' => 'Medical Mission',
            'venue' => 'Barangay Covered Court',
            'resources' => '4 of 4 resource types ready',
            'status' => 'Ready',
            'tone' => 'teal',
        ],
        [
            'day' => '10',
            'name' => 'Coastal Clean-Up Drive',
            'venue' => 'Lakeside Community Area',
            'resources' => '3 of 3 resource types ready',
            'status' => 'Ongoing',
            'tone' => 'navy',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | LOW STOCK
    |--------------------------------------------------------------------------
    */

    $stocks = [
        [
            'name' => 'Extension Cord 20m',
            'remaining' => '4 remaining · preferred minimum 10',
            'status' => 'Critical',
            'tone' => 'critical',
        ],
        [
            'name' => 'Wireless Microphone Set',
            'remaining' => '2 remaining · preferred minimum 5',
            'status' => 'Critical',
            'tone' => 'critical',
        ],
        [
            'name' => 'Basic Tool Kit',
            'remaining' => '2 remaining · preferred minimum 5',
            'status' => 'Low',
            'tone' => 'low',
        ],
        [
            'name' => 'PULSO Event Banner',
            'remaining' => '3 remaining · preferred minimum 6',
            'status' => 'Low',
            'tone' => 'low',
        ],
    ];


    $pendingRequests = 8;
    $attentionAssets = 6;


    /*
    |--------------------------------------------------------------------------
    | MONTHLY LOGISTICS ACTIVITY
    |--------------------------------------------------------------------------
    */

    $months = [
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
    ];


    $chartSeries = [
        [
            'label' => 'Requests',
            'values' => [12, 17, 14, 21, 25, 19],
            'color' => '#007780',
            'dash' => '',
        ],
        [
            'label' => 'Borrowings',
            'values' => [6, 8, 7, 10, 12, 9],
            'color' => '#b90c61',
            'dash' => '7 5',
        ],
        [
            'label' => 'Returns',
            'values' => [5, 7, 6, 9, 10, 8],
            'color' => '#31546d',
            'dash' => '2 5',
        ],
        [
            'label' => 'Donations',
            'values' => [3, 5, 4, 6, 8, 5],
            'color' => '#895408',
            'dash' => '10 5 2 5',
        ],
    ];


    $chartWidth = 680;
    $chartHeight = 260;

    $chartLeft = 48;
    $chartRight = 24;
    $chartTop = 20;
    $chartBottom = 42;

    $chartMax = 30;

    $plotWidth =
        $chartWidth
        - $chartLeft
        - $chartRight;

    $plotHeight =
        $chartHeight
        - $chartTop
        - $chartBottom;


    foreach ($chartSeries as $index => $series) {
        $points = [];
        $coordinates = [];

        foreach ($series['values'] as $monthIndex => $value) {
            $x =
                $chartLeft
                + (
                    $plotWidth
                    / (count($months) - 1)
                )
                * $monthIndex;

            $y =
                $chartTop
                + $plotHeight
                - (
                    $value
                    / $chartMax
                )
                * $plotHeight;

            $points[] = [
                'x' => round($x, 2),
                'y' => round($y, 2),
                'value' => $value,
                'month' => $months[$monthIndex],
            ];

            $coordinates[] =
                round($x, 2)
                . ','
                . round($y, 2);
        }

        $chartSeries[$index]['points'] = $points;

        $chartSeries[$index]['polyline'] =
            implode(
                ' ',
                $coordinates
            );
    }
@endphp


@push('styles')
<style>
    /* ================================================================
       DASHBOARD
       ================================================================ */

    .dash {
        --dash-navy: #10263d;
        --dash-text: #31546d;
        --dash-muted: #688297;
        --dash-teal: #007780;
        --dash-pink: #b90c61;
        --dash-green: #2b735d;
        --dash-gold: #895408;
        --dash-red: #ad343d;
        --dash-line: #d5e5ee;

        display: grid;

        gap: 20px;

        width: 100%;
        min-width: 0;

        color: var(--dash-navy);

        container-name: logistics-dashboard;
        container-type: inline-size;
    }


    .dash *,
    .dash *::before,
    .dash *::after {
        box-sizing: border-box;
    }


    .dash svg.dash-icon {
        width: 20px;
        height: 20px;

        flex-shrink: 0;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .dash-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       PAGE HEADING
       ================================================================ */

    .dash-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;

        margin-bottom: 4px;
    }


    .dash-heading-copy {
        min-width: 0;
    }


    .dash-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--dash-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .dash-heading h1 {
        margin: 0;

        color: var(--dash-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .dash-heading-description {
        max-width: 720px;

        margin:
            9px
            0
            0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .dash-heading-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;

        gap: 8px;

        flex-shrink: 0;
    }


    .dash-sample-label {
        color: #71899c;

        font-size: 9.5px;
        line-height: 1.5;
    }


    /* ================================================================
       SUMMARY
       ================================================================ */

    .dash-summary {
        display: grid;

        grid-template-columns:
            repeat(
                6,
                minmax(0, 1fr)
            );

        gap: 11px;

        min-width: 0;
    }


    .dash-stat {
        --dash-tone: #007780;

        --dash-icon-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );

        position: relative;

        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;
        min-height: 102px;

        padding:
            14px
            12px;

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
                #f6fafc 52%,
                #edf5f8
            );

        color: inherit;

        box-shadow:
            4px 5px 10px rgba(78, 111, 132, .07),
            -4px -4px 9px rgba(255, 255, 255, .64),
            inset 1px 1px 2px rgba(255, 255, 255, .92);

        text-decoration: none;

        transition:
            transform 160ms ease,
            box-shadow 160ms ease;
    }


    .dash-stat::after {
        position: absolute;

        top: 0;
        right: 15px;

        width: 30px;
        height: 3px;

        border-radius:
            0
            0
            999px
            999px;

        background: var(--dash-tone);

        opacity: .55;

        content: "";
    }


    .dash-stat:hover {
        transform:
            translateY(
                -2px
            );

        box-shadow:
            7px 8px 15px rgba(78, 111, 132, .10),
            -4px -4px 9px rgba(255, 255, 255, .7),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }


    .dash-stat[data-tone="teal"] {
        --dash-tone: #007780;

        --dash-icon-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .dash-stat[data-tone="green"] {
        --dash-tone: #2b735d;

        --dash-icon-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    .dash-stat[data-tone="pink"] {
        --dash-tone: #b90c61;

        --dash-icon-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .dash-stat[data-tone="navy"] {
        --dash-tone: #173b59;

        --dash-icon-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .dash-stat[data-tone="gold"] {
        --dash-tone: #895408;

        --dash-icon-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }


    .dash-stat-icon {
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

        background: var(--dash-icon-fill);

        color: var(--dash-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .dash-stat-icon .dash-icon {
        width: 17px;
        height: 17px;
    }


    .dash-stat-copy {
        min-width: 0;

        flex: 1;
    }


    .dash-stat-value {
        display: block;

        color: var(--dash-tone);

        font-size: 22px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .dash-stat h2 {
        margin:
            6px
            0
            0;

        overflow: hidden;

        color: #29475f;

        font-size: 9.5px;
        font-weight: 750;
        line-height: 1.3;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .dash-stat p {
        margin:
            2px
            0
            0;

        overflow: hidden;

        color: #71899c;

        font-size: 8px;
        line-height: 1.35;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       GRID
       ================================================================ */

    .dash-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.45fr)
            minmax(300px, .78fr);

        align-items: stretch;

        gap: 20px;

        min-width: 0;
    }


    .dash-card {
        min-width: 0;

        padding: 21px;

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
       CARD HEADER
       ================================================================ */

    .dash-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        min-width: 0;

        margin-bottom: 18px;

        padding-bottom: 15px;

        border-bottom:
            1px
            solid
            var(--dash-line);
    }


    .dash-card-title {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;
    }


    .dash-section-number {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border:
            1px
            solid
            rgba(255, 255, 255, .9);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--dash-pink);

        font-size: 12px;
        font-weight: 850;
        line-height: 1;
    }


    .dash-card h2 {
        margin: 0;

        color: #18344c;

        font-size: 16px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: -.025em;
    }


    .dash-link {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        flex-shrink: 0;

        color: var(--dash-teal);

        font-size: 9.5px;
        font-weight: 750;

        text-decoration: none;
    }


    .dash-link:hover {
        color: #005f66;
    }


    .dash-link .dash-icon {
        width: 14px !important;
        height: 14px !important;

        transition:
            transform 150ms ease;
    }


    .dash-link:hover .dash-icon {
        transform:
            translateX(
                2px
            );
    }


    /* ================================================================
       FEATURED PROJECT
       ================================================================ */

    .dash-project-card {
        position: relative;

        background:
            radial-gradient(
                circle at 92% 10%,
                rgba(5, 173, 182, .10),
                transparent 25%
            ),
            linear-gradient(
                145deg,
                rgba(248, 253, 254, .96),
                rgba(230, 243, 248, .94)
            );
    }


    .dash-project-main {
        display: grid;

        grid-template-columns:
            64px
            minmax(0, 1fr);

        align-items: flex-start;

        gap: 17px;
    }


    .dash-date-tile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        width: 64px;
        min-height: 72px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #e6f9fa,
                #d2edef
            );

        box-shadow:
            4px 5px 11px rgba(70, 118, 137, .10),
            -3px -3px 8px rgba(255, 255, 255, .8);
    }


    .dash-date-tile span {
        color: var(--dash-teal);

        font-size: 9px;
        font-weight: 850;

        letter-spacing: .12em;
    }


    .dash-date-tile strong {
        margin-top: 4px;

        color: var(--dash-navy);

        font-size: 24px;
        font-weight: 850;
        line-height: 1;
    }


    .dash-project-main h3 {
        margin:
            1px
            0
            6px;

        color: var(--dash-navy);

        font-size: clamp(
            20px,
            2vw,
            26px
        );

        font-weight: 850;
        line-height: 1.2;

        letter-spacing: -.04em;
    }


    .dash-project-main p {
        margin: 0;

        color: var(--dash-muted);

        font-size: 11px;
        line-height: 1.55;
    }


    .dash-project-main p + p {
        margin-top: 2px;
    }


    .dash-project-ref {
        display: inline-flex;

        margin-top: 7px;

        color: var(--dash-teal);

        font-size: 9px;
        font-weight: 750;
    }


    .dash-resource-label {
        margin:
            20px
            0
            9px;

        color: #567084;

        font-size: 9px;
        font-weight: 750;
    }


    .dash-resource-tags {
        display: flex;
        flex-wrap: wrap;

        gap: 7px;
    }


    .dash-resource-tags span {
        display: inline-flex;
        align-items: center;

        min-height: 31px;

        padding:
            6px
            10px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #f8fdff,
                #e8f2f6
            );

        color: #3f6177;

        box-shadow:
            3px 4px 8px rgba(86, 119, 140, .07),
            -2px -2px 6px rgba(255, 255, 255, .7);

        font-size: 9.5px;
    }


    .dash-project-progress {
        margin-top: 18px;

        padding:
            13px
            14px;

        border:
            1px
            solid
            rgba(255, 255, 255, .85);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e4eff4
            );

        box-shadow:
            inset 2px 2px 5px rgba(84, 118, 139, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .65);
    }


    .dash-project-progress-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        margin-bottom: 8px;
    }


    .dash-project-progress-head span {
        color: #567489;

        font-size: 9px;
        font-weight: 700;
    }


    .dash-project-progress-head strong {
        color: var(--dash-pink);

        font-size: 9.5px;
        font-weight: 850;
    }


    .dash-project-progress-track {
        height: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #dce8ed;

        box-shadow:
            inset 1px 1px 3px rgba(77, 111, 132, .1);
    }


    .dash-project-progress-fill {
        width: 58%;
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .dash-project-issue {
        display: flex;
        align-items: flex-start;

        gap: 7px;

        margin-top: 10px;

        color: #9d235c;

        font-size: 9px;
        font-weight: 650;
        line-height: 1.5;
    }


    .dash-project-issue .dash-icon {
        width: 14px;
        height: 14px;

        margin-top: 1px;
    }


    .dash-project-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        margin-top: 18px;

        padding-top: 16px;

        border-top:
            1px
            solid
            rgba(204, 225, 234, .8);
    }


    /* ================================================================
       ATTENTION
       ================================================================ */

    .dash-attention-list {
        display: grid;

        gap: 10px;
    }


    .dash-attention-item {
        display: flex;
        align-items: center;

        gap: 12px;

        min-height: 64px;

        padding:
            11px
            12px;

        border:
            1px
            solid
            rgba(255, 255, 255, .94);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #eef7fa,
                #e3eef4
            );

        color: inherit;

        box-shadow:
            inset 2px 2px 5px rgba(79, 117, 138, .08),
            inset -2px -2px 5px rgba(255, 255, 255, .72);

        text-decoration: none;

        transition:
            transform 150ms ease,
            background 150ms ease;
    }


    .dash-attention-item:hover {
        background:
            linear-gradient(
                145deg,
                #f4fbfc,
                #dcecf1
            );

        transform:
            translateY(
                -1px
            );
    }


    .dash-attention-number {
        min-width: 33px;

        color: var(--dash-pink);

        font-size: 22px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;
    }


    .dash-attention-copy {
        min-width: 0;

        flex: 1;
    }


    .dash-attention-copy strong {
        display: block;

        color: #243f56;

        font-size: 10.5px;
        font-weight: 750;
    }


    .dash-attention-copy span {
        display: block;

        margin-top: 3px;

        color: var(--dash-muted);

        font-size: 8.8px;
        line-height: 1.4;
    }


    .dash-attention-item > .dash-icon {
        width: 15px;
        height: 15px;

        color: #688397;
    }


    /* ================================================================
       CHART
       ================================================================ */

    .dash-chart-description {
        margin:
            -5px
            0
            15px;

        color: var(--dash-muted);

        font-size: 10px;
        line-height: 1.55;
    }


    .dash-chart-shell {
        padding:
            13px
            13px
            7px;

        border:
            1px
            solid
            rgba(255, 255, 255, .88);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #eaf3f7,
                #f2f8fb
            );

        box-shadow:
            inset 3px 3px 7px rgba(87, 119, 141, .11),
            inset -3px -3px 7px rgba(255, 255, 255, .86);
    }


    .dash-chart-scroll {
        width: 100%;

        overflow-x: auto;
    }


    .dash-chart {
        display: block;

        width: 100%;
        min-width: 500px;
        height: auto;
    }


    .dash-chart text {
        fill: #6b8296;

        font-family: inherit;
        font-size: 10px;
    }


    .dash-chart-legend {
        display: flex;
        flex-wrap: wrap;

        gap:
            9px
            16px;

        margin-top: 12px;
    }


    .dash-chart-legend span {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        color: #536e82;

        font-size: 9.5px;
    }


    .dash-chart-legend i {
        display: inline-block;

        width: 20px;
        height: 0;

        border-top:
            3px
            solid;
    }


    .dash-chart-data {
        margin-top: 13px;
    }


    .dash-chart-data summary {
        width: fit-content;

        padding:
            5px
            0;

        color: var(--dash-teal);

        font-size: 9.5px;
        font-weight: 750;

        cursor: pointer;
    }


    /* ================================================================
       ASSET STATUS
       ================================================================ */

    .dash-status-list {
        display: grid;

        gap: 15px;
    }


    .dash-status-label {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        margin-bottom: 7px;
    }


    .dash-status-label span {
        color: #36546a;

        font-size: 10px;
        font-weight: 650;
    }


    .dash-status-label strong {
        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    .dash-status-label small {
        margin-right: 6px;

        color: #70879a;

        font-size: 8.5px;
        font-weight: 500;
    }


    .dash-status-track {
        height: 8px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(211, 226, 235, .8);

        border-radius: 999px;

        background: #e2edf3;

        box-shadow:
            inset 2px 2px 5px rgba(77, 111, 133, .13);
    }


    .dash-status-fill {
        height: 100%;

        border-radius: inherit;
    }


    .dash-status-note {
        margin:
            17px
            0
            0;

        padding:
            10px
            12px;

        border-radius: 12px;

        background:
            rgba(
                227,
                240,
                246,
                .7
            );

        color: #617b90;

        font-size: 9px;
        line-height: 1.55;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .dash-table-scroll {
        width: 100%;

        overflow-x: auto;

        border-radius: 14px;
    }


    .dash-table {
        width: 100%;
        min-width: 650px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .dash-table th {
        padding:
            10px
            11px;

        border-bottom:
            1px
            solid
            #cfdee7;

        background:
            rgba(
                225,
                240,
                247,
                .74
            );

        color: #526d82;

        font-size: 8.5px;
        font-weight: 800;

        letter-spacing: .03em;

        text-transform: uppercase;

        white-space: nowrap;
    }


    .dash-table td {
        padding:
            11px
            11px;

        border-bottom:
            1px
            solid
            rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 9.5px;
        line-height: 1.45;

        vertical-align: middle;
    }


    .dash-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .dash-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .42
            );
    }


    .dash-request-id {
        display: block;

        color: #19364e;

        font-size: 9px;
        font-weight: 800;

        white-space: nowrap;
    }


    .dash-request-project {
        display: block;

        margin-top: 3px;

        color: #627b8f;

        font-size: 8.7px;
    }


    .dash-date-text {
        white-space: nowrap;
    }


    /* ================================================================
       BADGES
       ================================================================ */

    .dash-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 25px;

        padding:
            4px
            8px;

        border:
            1px
            solid
            rgba(255, 255, 255, .65);

        border-radius: 8px;

        font-size: 8px;
        font-weight: 800;

        white-space: nowrap;
    }


    .dash-badge--review,
    .dash-badge--pink {
        background: #f8e0eb;

        color: #b90c61;
    }


    .dash-badge--approved,
    .dash-badge--completed,
    .dash-badge--teal {
        background: #dff4f4;

        color: #007780;
    }


    .dash-badge--preparing,
    .dash-badge--navy {
        background: #e2ebf2;

        color: #31546d;
    }


    .dash-badge--gold {
        background: #f6ecd9;

        color: #895408;
    }


    .dash-badge--critical {
        background: #f8dfe5;

        color: #a52d49;
    }


    .dash-badge--low {
        background: #f5e9d4;

        color: #835917;
    }


    /* ================================================================
       ACTIVITY
       ================================================================ */

    .dash-activity-list {
        display: grid;
    }


    .dash-activity-item {
        display: flex;
        align-items: flex-start;

        gap: 11px;

        padding:
            12px
            0;

        border-bottom:
            1px
            solid
            rgba(210, 226, 235, .84);
    }


    .dash-activity-item:first-child {
        padding-top: 0;
    }


    .dash-activity-item:last-child {
        padding-bottom: 0;

        border-bottom: 0;
    }


    .dash-activity-icon {
        --activity-tone: #007780;
        --activity-fill: #dff4f4;

        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border:
            1px
            solid
            rgba(255, 255, 255, .9);

        border-radius: 11px;

        background: var(--activity-fill);

        color: var(--activity-tone);
    }


    .dash-activity-icon[data-tone="pink"] {
        --activity-tone: #b90c61;
        --activity-fill: #f8e0eb;
    }


    .dash-activity-icon[data-tone="navy"] {
        --activity-tone: #31546d;
        --activity-fill: #e2ebf2;
    }


    .dash-activity-icon[data-tone="gold"] {
        --activity-tone: #895408;
        --activity-fill: #f6ecd9;
    }


    .dash-activity-icon[data-tone="green"] {
        --activity-tone: #2b735d;
        --activity-fill: #e2f0ea;
    }


    .dash-activity-icon .dash-icon {
        width: 16px;
        height: 16px;
    }


    .dash-activity-copy {
        min-width: 0;

        flex: 1;
    }


    .dash-activity-item strong {
        display: block;

        color: #29465d;

        font-size: 10px;
        font-weight: 750;
    }


    .dash-activity-item p {
        margin:
            3px
            0
            0;

        color: #60798d;

        font-size: 8.7px;
        line-height: 1.45;
    }


    .dash-activity-item small {
        display: block;

        margin-top: 4px;

        color: #7b91a1;

        font-size: 8px;
    }


    /* ================================================================
       PROJECT LIST
       ================================================================ */

    .dash-project-list,
    .dash-stock-list {
        display: grid;
    }


    .dash-project-row {
        display: grid;

        grid-template-columns:
            50px
            minmax(0, 1fr)
            auto;

        align-items: center;

        gap: 13px;

        padding:
            13px
            0;

        border-bottom:
            1px
            solid
            rgba(210, 226, 235, .84);
    }


    .dash-project-row:first-child {
        padding-top: 0;
    }


    .dash-project-row:last-child {
        padding-bottom: 0;

        border-bottom: 0;
    }


    .dash-project-row .dash-date-tile {
        width: 50px;
        min-height: 56px;

        border-radius: 12px;
    }


    .dash-project-row .dash-date-tile span {
        font-size: 8px;
    }


    .dash-project-row .dash-date-tile strong {
        font-size: 19px;
    }


    .dash-project-row h3 {
        margin: 0;

        color: #2c485f;

        font-size: 10.5px;
        font-weight: 750;
    }


    .dash-project-row p {
        margin:
            3px
            0
            0;

        color: #647d91;

        font-size: 8.6px;
        line-height: 1.45;
    }


    /* ================================================================
       STOCK
       ================================================================ */

    .dash-stock-row {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        padding:
            12px
            0;

        border-bottom:
            1px
            solid
            rgba(210, 226, 235, .84);
    }


    .dash-stock-row:first-child {
        padding-top: 0;
    }


    .dash-stock-row:last-child {
        padding-bottom: 0;

        border-bottom: 0;
    }


    .dash-stock-main {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;
    }


    .dash-stock-warning {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #f9e4ee,
                #efd0df
            );

        color: var(--dash-pink);
    }


    .dash-stock-warning .dash-icon {
        width: 15px;
        height: 15px;
    }


    .dash-stock-row strong {
        display: block;

        color: #2d4a61;

        font-size: 10px;
        font-weight: 750;
    }


    .dash-stock-row p {
        margin:
            3px
            0
            0;

        color: #647d91;

        font-size: 8.5px;
        line-height: 1.4;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .dash-footer-note {
        margin:
            -2px
            0
            0;

        padding:
            3px
            2px;

        color: #748b9d;

        font-size: 9px;
        line-height: 1.6;
    }


    #dash-status,
    #dash-stock {
        scroll-margin-top: 112px;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container logistics-dashboard (max-width: 1120px) {
        .dash-summary {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }
    }


    @container logistics-dashboard (max-width: 820px) {
        .dash-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @container logistics-dashboard (max-width: 700px) {
        .dash-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }


        .dash-heading-actions {
            align-items: flex-start;
        }


        .dash-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container logistics-dashboard (max-width: 520px) {
        .dash-summary {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .dash-card {
            padding:
                18px
                16px;

            border-radius: 19px;
        }


        .dash-card-head {
            align-items: flex-start;
            flex-wrap: wrap;
        }


        .dash-project-main {
            grid-template-columns:
                56px
                minmax(0, 1fr);
        }


        .dash-date-tile {
            width: 56px;
            min-height: 65px;
        }


        .dash-project-footer {
            align-items: flex-start;
            flex-direction: column;
        }


        .dash-project-row {
            grid-template-columns:
                50px
                minmax(0, 1fr);
        }


        .dash-project-row .dash-badge {
            grid-column: 2;
            justify-self: flex-start;
        }


        .dash-stock-row {
            align-items: flex-start;
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .dash-stat,
        .dash-attention-item,
        .dash-link .dash-icon {
            transition: none;
        }


        .dash-stat:hover,
        .dash-attention-item:hover {
            transform: none;
        }


        .dash-link:hover .dash-icon {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div class="dash">

    {{-- =============================================================
         ICON LIBRARY
         ============================================================= --}}

    <svg
        class="dash-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol
            id="dash-icon-box"
            viewBox="0 0 24 24"
        >
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>


        <symbol
            id="dash-icon-check"
            viewBox="0 0 24 24"
        >
            <circle
                cx="12"
                cy="12"
                r="9"
            />

            <path d="m8 12 3 3 5-6"/>
        </symbol>


        <symbol
            id="dash-icon-exchange"
            viewBox="0 0 24 24"
        >
            <path d="M4 7h15"/>
            <path d="m15 3 4 4-4 4"/>
            <path d="M20 17H5"/>
            <path d="m9 13-4 4 4 4"/>
        </symbol>


        <symbol
            id="dash-icon-borrow"
            viewBox="0 0 24 24"
        >
            <path d="M4 7h15"/>
            <path d="m15 3 4 4-4 4"/>
            <path d="M20 17H5"/>
            <path d="m9 13-4 4 4 4"/>
        </symbol>


        <symbol
            id="dash-icon-projects"
            viewBox="0 0 24 24"
        >
            <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
            <path d="M12 11v6"/>
            <path d="M9 14h6"/>
        </symbol>


        <symbol
            id="dash-icon-requests"
            viewBox="0 0 24 24"
        >
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
        </symbol>


        <symbol
            id="dash-icon-donations"
            viewBox="0 0 24 24"
        >
            <path d="M4 10h16v10H4Z"/>
            <path d="M3 7h18v3H3Z"/>
            <path d="M12 7v13"/>
            <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>
            <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>
        </symbol>


        <symbol
            id="dash-icon-warning"
            viewBox="0 0 24 24"
        >
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>


        <symbol
            id="dash-icon-arrow"
            viewBox="0 0 24 24"
        >
            <path d="M4 12h16"/>
            <path d="m14 6 6 6-6 6"/>
        </symbol>


        <symbol
            id="dash-icon-plus"
            viewBox="0 0 24 24"
        >
            <path d="M12 5v14"/>
            <path d="M5 12h14"/>
        </symbol>
    </svg>


    {{-- =============================================================
         HEADING
         ============================================================= --}}

    <header class="dash-heading">

        <div class="dash-heading-copy">

            <p class="dash-eyebrow">
                Daily operations
            </p>

            <h1>
                The hub, at a glance.
            </h1>

            <p class="dash-heading-description">
                Monitor logistics assets, requests, borrowing activity,
                project readiness, and resource conditions from one workspace.
            </p>

        </div>


        <div class="dash-heading-actions">

            <a
                class="hub-button"
                href="{{ route('inventory.create') }}"
            >
                <svg
                    class="dash-icon"
                    aria-hidden="true"
                >
                    <use href="#dash-icon-plus"/>
                </svg>

                <span>
                    Add asset
                </span>
            </a>


            <span class="dash-sample-label">
                Sample data · September 2026
            </span>

        </div>

    </header>


    {{-- =============================================================
         KPI SUMMARY
         ============================================================= --}}

    <section
        class="dash-summary"
        aria-label="Logistics overview"
    >

        @foreach ($summaryCards as $card)

            <a
                class="dash-stat"
                data-tone="{{ $card['tone'] }}"
                href="{{ $card['href'] }}"
            >

                <span
                    class="dash-stat-icon"
                    aria-hidden="true"
                >
                    <svg class="dash-icon">
                        <use
                            href="#dash-icon-{{ $card['icon'] }}"
                        />
                    </svg>
                </span>


                <span class="dash-stat-copy">

                    <strong class="dash-stat-value">
                        {{ number_format($card['value']) }}
                    </strong>

                    <h2>
                        {{ $card['label'] }}
                    </h2>

                    <p>
                        {{ $card['description'] }}
                    </p>

                </span>

            </a>

        @endforeach

    </section>


    {{-- =============================================================
         FEATURED PROJECT + ATTENTION
         ============================================================= --}}

    <div class="dash-grid">

        <section
            class="dash-card dash-project-card"
            aria-labelledby="featured-project-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        01
                    </span>

                    <h2 id="featured-project-title">
                        Project logistics focus
                    </h2>

                </div>


                <span class="dash-sample-label">
                    Sep 12, 2026
                </span>

            </div>


            <div class="dash-project-main">

                <div
                    class="dash-date-tile"
                    aria-label="September 12"
                >
                    <span>
                        SEP
                    </span>

                    <strong>
                        12
                    </strong>
                </div>


                <div>

                    <h3>
                        Youth Leadership Summit
                    </h3>

                    <p>
                        PULSO Activity Center
                    </p>

                    <p>
                        Events Committee · High priority
                    </p>

                    <span class="dash-project-ref">
                        PRJ-2026-0018 · REQ-2026-0042
                    </span>

                </div>

            </div>


            <p class="dash-resource-label">
                Required resources
            </p>


            <div class="dash-resource-tags">
                <span>Sound System</span>
                <span>Projector</span>
                <span>Monoblock Chairs</span>
            </div>


            <div class="dash-project-progress">

                <div class="dash-project-progress-head">

                    <span>
                        Logistics progress
                    </span>

                    <strong>
                        58%
                    </strong>

                </div>


                <div class="dash-project-progress-track">

                    <div class="dash-project-progress-fill"></div>

                </div>


                <div class="dash-project-issue">

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-warning"/>
                    </svg>

                    <span>
                        10 additional chairs are still required.
                    </span>

                </div>

            </div>


            <div class="dash-project-footer">

                <span class="dash-badge dash-badge--pink">
                    Resource Allocation
                </span>


                <a
                    class="dash-link"
                    href="{{ route('projects.show') }}"
                >
                    <span>
                        View project
                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>

        </section>


        <section
            class="dash-card"
            aria-labelledby="attention-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        02
                    </span>

                    <h2 id="attention-title">
                        Needs attention
                    </h2>

                </div>

            </div>


            <div class="dash-attention-list">

                <a
                    class="dash-attention-item"
                    href="{{ route('requests.index') }}"
                >
                    <span class="dash-attention-number">
                        {{ sprintf('%02d', $pendingRequests) }}
                    </span>

                    <span class="dash-attention-copy">

                        <strong>
                            Pending requests
                        </strong>

                        <span>
                            Requests waiting for logistics action
                        </span>

                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>


                <a
                    class="dash-attention-item"
                    href="#dash-stock"
                >
                    <span class="dash-attention-number">
                        {{ sprintf('%02d', count($stocks)) }}
                    </span>

                    <span class="dash-attention-copy">

                        <strong>
                            Resource alerts
                        </strong>

                        <span>
                            Stock below preferred minimum
                        </span>

                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>


                <a
                    class="dash-attention-item"
                    href="#dash-status"
                >
                    <span class="dash-attention-number">
                        {{ sprintf('%02d', $attentionAssets) }}
                    </span>

                    <span class="dash-attention-copy">

                        <strong>
                            Assets needing care
                        </strong>

                        <span>
                            3 maintenance · 3 damaged
                        </span>

                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>

        </section>

    </div>


    {{-- =============================================================
         CHART + ASSET STATUS
         ============================================================= --}}

    <div class="dash-grid">

        <section
            class="dash-card"
            aria-labelledby="activity-chart-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        03
                    </span>

                    <h2 id="activity-chart-title">
                        Monthly logistics activity
                    </h2>

                </div>


                <span class="dash-sample-label">
                    Apr–Sep 2026
                </span>

            </div>


            <p class="dash-chart-description">
                Monthly requests, borrowing transactions, returns,
                and donation intake recorded by the logistics hub.
            </p>


            <div class="dash-chart-shell">

                <div class="dash-chart-scroll">

                    <svg
                        class="dash-chart"
                        viewBox="0 0 {{ $chartWidth }} {{ $chartHeight }}"
                        role="img"
                        aria-labelledby="chart-svg-title chart-svg-description"
                    >

                        <title id="chart-svg-title">
                            Monthly logistics activity
                        </title>

                        <desc id="chart-svg-description">
                            Requests, borrowings, returns, and donations
                            from April through September 2026.
                        </desc>


                        @foreach ([0, 5, 10, 15, 20, 25, 30] as $tick)

                            @php
                                $gridY =
                                    $chartTop
                                    + $plotHeight
                                    - (
                                        $tick
                                        / $chartMax
                                    )
                                    * $plotHeight;
                            @endphp

                            <line
                                x1="{{ $chartLeft }}"
                                y1="{{ $gridY }}"
                                x2="{{ $chartWidth - $chartRight }}"
                                y2="{{ $gridY }}"
                                stroke="#C9DCE6"
                                stroke-dasharray="3 6"
                            />

                            <text
                                x="{{ $chartLeft - 12 }}"
                                y="{{ $gridY + 4 }}"
                                text-anchor="end"
                            >
                                {{ $tick }}
                            </text>

                        @endforeach


                        @foreach ($months as $index => $month)

                            @php
                                $monthX =
                                    $chartLeft
                                    + (
                                        $plotWidth
                                        / (count($months) - 1)
                                    )
                                    * $index;
                            @endphp

                            <text
                                x="{{ $monthX }}"
                                y="{{ $chartHeight - 13 }}"
                                text-anchor="middle"
                            >
                                {{ $month }}
                            </text>

                        @endforeach


                        @foreach ($chartSeries as $series)

                            <polyline
                                points="{{ $series['polyline'] }}"
                                fill="none"
                                stroke="{{ $series['color'] }}"
                                stroke-width="2.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-dasharray="{{ $series['dash'] }}"
                            />


                            @foreach ($series['points'] as $point)

                                <circle
                                    cx="{{ $point['x'] }}"
                                    cy="{{ $point['y'] }}"
                                    r="3.8"
                                    fill="#EDF6FA"
                                    stroke="{{ $series['color'] }}"
                                    stroke-width="2"
                                >
                                    <title>
                                        {{ $point['month'] }}:
                                        {{ $point['value'] }}
                                        {{ strtolower($series['label']) }}
                                    </title>
                                </circle>

                            @endforeach

                        @endforeach

                    </svg>

                </div>

            </div>


            <div
                class="dash-chart-legend"
                aria-label="Chart legend"
            >

                @foreach ($chartSeries as $series)

                    <span>

                        <i
                            style="
                                border-color:
                                    {{ $series['color'] }};
                            "
                            aria-hidden="true"
                        ></i>

                        {{ $series['label'] }}

                    </span>

                @endforeach

            </div>


            <details class="dash-chart-data">

                <summary>
                    View chart data
                </summary>


                <div class="dash-table-scroll">

                    <table class="dash-table">

                        <caption class="sr-only">
                            Monthly logistics activity from April
                            through September 2026
                        </caption>

                        <thead>
                            <tr>
                                <th scope="col">
                                    Month
                                </th>

                                @foreach ($chartSeries as $series)

                                    <th scope="col">
                                        {{ $series['label'] }}
                                    </th>

                                @endforeach
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($months as $index => $month)

                                <tr>

                                    <th scope="row">
                                        {{ $month }}
                                    </th>

                                    @foreach ($chartSeries as $series)

                                        <td>
                                            {{ $series['values'][$index] }}
                                        </td>

                                    @endforeach

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </details>

        </section>


        <section
            class="dash-card"
            id="dash-status"
            aria-labelledby="asset-status-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        04
                    </span>

                    <h2 id="asset-status-title">
                        Asset status
                    </h2>

                </div>


                <a
                    class="dash-link"
                    href="{{ route('inventory.index') }}"
                >
                    <span>
                        Inventory
                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>


            <div class="dash-status-list">

                @foreach ($assetStatuses as $status)

                    @php
                        $percentage =
                            (
                                $status['value']
                                /
                                $totalAssets
                            )
                            * 100;
                    @endphp

                    <div>

                        <div class="dash-status-label">

                            <span>
                                {{ $status['label'] }}
                            </span>

                            <strong>
                                <small>
                                    {{ number_format($percentage, 1) }}%
                                </small>

                                {{ $status['value'] }}
                            </strong>

                        </div>


                        <div
                            class="dash-status-track"
                            aria-hidden="true"
                        >
                            <div
                                class="dash-status-fill"
                                style="
                                    width:
                                        {{ $percentage }}%;

                                    background:
                                        {{ $status['color'] }};
                                "
                            ></div>
                        </div>

                    </div>

                @endforeach

            </div>


            <p class="dash-status-note">
                All
                <strong>{{ $totalAssets }}</strong>
                registered assets are represented in the five
                current inventory statuses.
            </p>

        </section>

    </div>


    {{-- =============================================================
         RECENT REQUESTS + ACTIVITY
         ============================================================= --}}

    <div class="dash-grid">

        <section
            class="dash-card"
            aria-labelledby="recent-requests-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        05
                    </span>

                    <h2 id="recent-requests-title">
                        Recent requests
                    </h2>

                </div>


                <a
                    class="dash-link"
                    href="{{ route('requests.index') }}"
                >
                    <span>
                        View all
                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>


            <div class="dash-table-scroll">

                <table class="dash-table">

                    <caption class="sr-only">
                        Recent logistics requests
                    </caption>

                    <thead>
                        <tr>
                            <th scope="col">
                                Request / Project
                            </th>

                            <th scope="col">
                                Committee
                            </th>

                            <th scope="col">
                                Date
                            </th>

                            <th scope="col">
                                Status
                            </th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach ($recentRequests as $item)

                            <tr>

                                <td>
                                    <span class="dash-request-id">
                                        {{ $item['id'] }}
                                    </span>

                                    <span class="dash-request-project">
                                        {{ $item['project'] }}
                                    </span>
                                </td>


                                <td>
                                    {{ $item['committee'] }}
                                </td>


                                <td class="dash-date-text">
                                    {{ $item['date'] }}
                                </td>


                                <td>
                                    <span
                                        class="
                                            dash-badge
                                            dash-badge--{{ $item['tone'] }}
                                        "
                                    >
                                        {{ $item['status'] }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </section>


        <section
            class="dash-card"
            aria-labelledby="recent-activity-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        06
                    </span>

                    <h2 id="recent-activity-title">
                        Recent activity
                    </h2>

                </div>


                <a
                    class="dash-link"
                    href="{{ route('reports.activity') }}"
                >
                    <span>
                        View history
                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>


            <div class="dash-activity-list">

                @foreach ($activities as $activity)

                    <article class="dash-activity-item">

                        <span
                            class="dash-activity-icon"
                            data-tone="{{ $activity['tone'] }}"
                            aria-hidden="true"
                        >
                            <svg class="dash-icon">
                                <use
                                    href="#dash-icon-{{ $activity['icon'] }}"
                                />
                            </svg>
                        </span>


                        <div class="dash-activity-copy">

                            <strong>
                                {{ $activity['title'] }}
                            </strong>

                            <p>
                                {{ $activity['description'] }}
                            </p>

                            <small>
                                {{ $activity['time'] }}
                            </small>

                        </div>

                    </article>

                @endforeach

            </div>

        </section>

    </div>


    {{-- =============================================================
         ACTIVE PROJECTS + ALERTS
         ============================================================= --}}

    <div class="dash-grid">

        <section
            class="dash-card"
            aria-labelledby="scheduled-projects-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        07
                    </span>

                    <h2 id="scheduled-projects-title">
                        Active project logistics
                    </h2>

                </div>


                <a
                    class="dash-link"
                    href="{{ route('projects.index') }}"
                >
                    <span>
                        View projects
                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>


            <div class="dash-project-list">

                @foreach ($projects as $project)

                    <div class="dash-project-row">

                        <div
                            class="dash-date-tile"
                            aria-hidden="true"
                        >
                            <span>
                                SEP
                            </span>

                            <strong>
                                {{ $project['day'] }}
                            </strong>
                        </div>


                        <div>

                            <h3>
                                {{ $project['name'] }}
                            </h3>

                            <p>
                                {{ $project['venue'] }}
                            </p>

                            <p>
                                {{ $project['resources'] }}
                            </p>

                        </div>


                        <span
                            class="
                                dash-badge
                                dash-badge--{{ $project['tone'] }}
                            "
                        >
                            {{ $project['status'] }}
                        </span>

                    </div>

                @endforeach

            </div>

        </section>


        <section
            class="dash-card"
            id="dash-stock"
            aria-labelledby="resource-alerts-title"
        >

            <div class="dash-card-head">

                <div class="dash-card-title">

                    <span
                        class="dash-section-number"
                        aria-hidden="true"
                    >
                        08
                    </span>

                    <h2 id="resource-alerts-title">
                        Resource alerts
                    </h2>

                </div>


                <a
                    class="dash-link"
                    href="{{ route('reports.inventory') }}"
                >
                    <span>
                        Inventory report
                    </span>

                    <svg
                        class="dash-icon"
                        aria-hidden="true"
                    >
                        <use href="#dash-icon-arrow"/>
                    </svg>
                </a>

            </div>


            <div class="dash-stock-list">

                @foreach ($stocks as $stock)

                    <div class="dash-stock-row">

                        <div class="dash-stock-main">

                            <span
                                class="dash-stock-warning"
                                aria-hidden="true"
                            >
                                <svg class="dash-icon">
                                    <use href="#dash-icon-warning"/>
                                </svg>
                            </span>


                            <div>

                                <strong>
                                    {{ $stock['name'] }}
                                </strong>

                                <p>
                                    {{ $stock['remaining'] }}
                                </p>

                            </div>

                        </div>


                        <span
                            class="
                                dash-badge
                                dash-badge--{{ $stock['tone'] }}
                            "
                        >
                            {{ $stock['status'] }}
                        </span>

                    </div>

                @endforeach

            </div>

        </section>

    </div>


    <p class="dash-footer-note">
        Workspace preview · Figures, schedules, and activity entries
        are sample front-end data and are not live database records.
    </p>

</div>
@endsection