@extends('layouts.app')

@section('title', 'Projects Report | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | PROJECT LOGISTICS RECORDS
    |--------------------------------------------------------------------------
    */

    $projects = [
        [
            'id' => 'PRJ-2026-0018',
            'request_id' => 'REQ-2026-0047',
            'name' => 'Youth Leadership Summit',
            'committee' => 'Events Committee',
            'coordinator' => 'Maria Santos',
            'date' => 'Sep 12, 2026',
            'venue' => 'PULSO Activity Center',
            'priority' => 'High',
            'status' => 'Resource Allocation',
            'tone' => 'pink',
            'progress' => 58,
            'resources_ready' => 2,
            'resources_total' => 3,
            'issue' => '10 additional chairs are still required.',
        ],
        [
            'id' => 'PRJ-2026-0017',
            'request_id' => 'REQ-2026-0046',
            'name' => 'Medical Mission',
            'committee' => 'Community Outreach',
            'coordinator' => 'Joshua Reyes',
            'date' => 'Sep 13, 2026',
            'venue' => 'Barangay Covered Court',
            'priority' => 'High',
            'status' => 'Ready',
            'tone' => 'teal',
            'progress' => 86,
            'resources_ready' => 4,
            'resources_total' => 4,
            'issue' => null,
        ],
        [
            'id' => 'PRJ-2026-0016',
            'request_id' => 'REQ-2026-0045',
            'name' => 'Coastal Clean-Up Drive',
            'committee' => 'Environment & Health',
            'coordinator' => 'Angela Cruz',
            'date' => 'Sep 10, 2026',
            'venue' => 'Lakeside Community Area',
            'priority' => 'Normal',
            'status' => 'Ongoing',
            'tone' => 'navy',
            'progress' => 72,
            'resources_ready' => 3,
            'resources_total' => 3,
            'issue' => null,
        ],
        [
            'id' => 'PRJ-2026-0015',
            'request_id' => 'REQ-2026-0041',
            'name' => 'PULSO Volunteer Orientation',
            'committee' => 'Volunteer Management',
            'coordinator' => 'Nicole Ramos',
            'date' => 'Sep 7, 2026',
            'venue' => 'PULSO Training Room',
            'priority' => 'Normal',
            'status' => 'Completed',
            'tone' => 'green',
            'progress' => 100,
            'resources_ready' => 2,
            'resources_total' => 2,
            'issue' => null,
        ],
        [
            'id' => 'PRJ-2026-0014',
            'request_id' => 'REQ-2026-0040',
            'name' => 'Student Assistance Orientation',
            'committee' => 'Education Committee',
            'coordinator' => 'Carlo Mendoza',
            'date' => 'Sep 6, 2026',
            'venue' => 'Community Learning Center',
            'priority' => 'Normal',
            'status' => 'Completed',
            'tone' => 'green',
            'progress' => 100,
            'resources_ready' => 1,
            'resources_total' => 1,
            'issue' => null,
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    $totalProjects = count($projects);


    $activeProjects = count(
        array_filter(
            $projects,
            fn ($project) =>
                $project['status'] !== 'Completed'
        )
    );


    $completedProjects = count(
        array_filter(
            $projects,
            fn ($project) =>
                $project['status'] === 'Completed'
        )
    );


    $projectsWithIssues = count(
        array_filter(
            $projects,
            fn ($project) =>
                !empty($project['issue'])
        )
    );


    $totalResourceTypes = array_sum(
        array_column(
            $projects,
            'resources_total'
        )
    );


    $readyResourceTypes = array_sum(
        array_column(
            $projects,
            'resources_ready'
        )
    );


    $resourceReadinessPercent =
        $totalResourceTypes > 0
            ? round(
                (
                    $readyResourceTypes
                    /
                    $totalResourceTypes
                ) * 100
            )
            : 0;


    $summary = [
        [
            'label' => 'Tracked Projects',
            'value' => sprintf(
                '%02d',
                $totalProjects
            ),
            'helper' => 'Project logistics records',
            'tone' => 'teal',
            'icon' => 'projects',
        ],
        [
            'label' => 'Active Projects',
            'value' => sprintf(
                '%02d',
                $activeProjects
            ),
            'helper' => 'Currently being coordinated',
            'tone' => 'navy',
            'icon' => 'activity',
        ],
        [
            'label' => 'Resources Ready',
            'value' =>
                $readyResourceTypes
                . '/'
                . $totalResourceTypes,
            'helper' =>
                $resourceReadinessPercent
                . '% overall readiness',
            'tone' => 'green',
            'icon' => 'check',
        ],
        [
            'label' => 'Needs Attention',
            'value' => sprintf(
                '%02d',
                $projectsWithIssues
            ),
            'helper' => 'Unresolved resource issue',
            'tone' => 'pink',
            'icon' => 'alert',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | STATUS DISTRIBUTION
    |--------------------------------------------------------------------------
    */

    $statusStats = [
        [
            'label' => 'Resource Allocation',
            'value' => count(
                array_filter(
                    $projects,
                    fn ($project) =>
                        $project['status']
                        ===
                        'Resource Allocation'
                )
            ),
            'tone' => 'pink',
        ],
        [
            'label' => 'Ready',
            'value' => count(
                array_filter(
                    $projects,
                    fn ($project) =>
                        $project['status']
                        ===
                        'Ready'
                )
            ),
            'tone' => 'teal',
        ],
        [
            'label' => 'Ongoing',
            'value' => count(
                array_filter(
                    $projects,
                    fn ($project) =>
                        $project['status']
                        ===
                        'Ongoing'
                )
            ),
            'tone' => 'navy',
        ],
        [
            'label' => 'Completed',
            'value' => $completedProjects,
            'tone' => 'green',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | DYNAMIC DONUT BREAKPOINTS
    |--------------------------------------------------------------------------
    */

    $projectStatusTotal = max(
        1,
        array_sum(
            array_column(
                $statusStats,
                'value'
            )
        )
    );


    $allocationEnd =
        (
            $statusStats[0]['value']
            /
            $projectStatusTotal
        ) * 100;


    $readyEnd =
        (
            (
                $statusStats[0]['value']
                +
                $statusStats[1]['value']
            )
            /
            $projectStatusTotal
        ) * 100;


    $ongoingEnd =
        (
            (
                $statusStats[0]['value']
                +
                $statusStats[1]['value']
                +
                $statusStats[2]['value']
            )
            /
            $projectStatusTotal
        ) * 100;


    /*
    |--------------------------------------------------------------------------
    | MONTHLY PROJECT ACTIVITY
    |--------------------------------------------------------------------------
    |
    | Historical sample analytics. These do not represent only the five
    | current project records displayed in the register.
    |
    */

    $monthlyProjects = [
        [
            'month' => 'Apr',
            'created' => 1,
            'completed' => 0,
        ],
        [
            'month' => 'May',
            'created' => 1,
            'completed' => 1,
        ],
        [
            'month' => 'Jun',
            'created' => 2,
            'completed' => 1,
        ],
        [
            'month' => 'Jul',
            'created' => 2,
            'completed' => 1,
        ],
        [
            'month' => 'Aug',
            'created' => 3,
            'completed' => 2,
        ],
        [
            'month' => 'Sep',
            'created' => 3,
            'completed' => 2,
        ],
    ];


    $maxMonthlyProjects = max(
        array_map(
            fn ($month) =>
                max(
                    $month['created'],
                    $month['completed']
                ),
            $monthlyProjects
        )
    );
@endphp


@push('styles')
<style>
    /* ================================================================
       PROJECTS REPORT
       ================================================================ */

    .project-report {
        --pr-navy: #10263d;
        --pr-text: #31546d;
        --pr-muted: #688297;

        --pr-teal: #007780;
        --pr-pink: #b90c61;
        --pr-green: #2b735d;
        --pr-gold: #895408;

        --pr-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--pr-navy);

        container-name: project-report;
        container-type: inline-size;
    }


    .project-report *,
    .project-report *::before,
    .project-report *::after {
        box-sizing: border-box;
    }


    .project-report [hidden] {
        display: none !important;
    }


    .pr-heading,
    .pr-heading-actions,
    .pr-section-heading,
    .pr-section-title,
    .pr-status-row,
    .pr-filter-row,
    .pr-table-footer {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .pr-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .pr-heading-copy {
        min-width: 0;
    }


    .pr-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--pr-teal);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .pr-heading h1 {
        margin: 0;

        color: var(--pr-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .pr-description {
        max-width: 790px;

        margin:
            9px
            0
            0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .pr-heading-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .pr-button {
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


    .pr-button:hover {
        color: var(--pr-teal);

        transform:
            translateY(
                -1px
            );
    }


    .pr-button-primary {
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


    .pr-button-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    .pr-button svg {
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

    .project-report > .pr-summary {
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


    .project-report > .pr-summary::before,
    .project-report > .pr-summary::after {
        display: none !important;

        width: 0 !important;
        height: 0 !important;

        border: 0 !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .pr-stat {
        --pr-tone: #007780;

        --pr-fill:
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


    .pr-stat::after {
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

        background: var(--pr-tone);

        opacity: .5;

        content: "";
    }


    .pr-stat[data-tone="teal"] {
        --pr-tone: #007780;

        --pr-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .pr-stat[data-tone="navy"] {
        --pr-tone: #173b59;

        --pr-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .pr-stat[data-tone="green"] {
        --pr-tone: #2b735d;

        --pr-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    .pr-stat[data-tone="pink"] {
        --pr-tone: #b90c61;

        --pr-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .pr-stat-icon {
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

        background: var(--pr-fill);

        color: var(--pr-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .pr-stat-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .pr-stat-copy {
        min-width: 0;
    }


    .pr-stat-value {
        display: block;

        color: var(--pr-tone);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .pr-stat-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .pr-stat-helper {
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

    .pr-card {
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


    .pr-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding:
            20px
            22px;

        border-bottom:
            1px
            solid
            var(--pr-line);
    }


    .pr-section-title {
        gap: 12px;

        min-width: 0;
    }


    .pr-section-number {
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

        color: var(--pr-teal);

        font-size: 13px;
        font-weight: 850;
    }


    .pr-section-number.pink {
        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--pr-pink);
    }


    .pr-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .pr-section-title p {
        margin:
            5px
            0
            0;

        color: #496580;

        font-size: 11px;
        line-height: 1.55;
    }


    .pr-source {
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

    .pr-analytics {
        display: grid;

        grid-template-columns:
            minmax(0, .92fr)
            minmax(0, 1.08fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .pr-analytics .pr-card {
        height: 100%;

        margin-bottom: 0;
    }


    /* ================================================================
       STATUS DISTRIBUTION
       ================================================================ */

    .pr-status-body {
        display: grid;

        grid-template-columns:
            158px
            minmax(0, 1fr);

        align-items: center;

        gap: 18px;

        min-height: 275px;

        padding: 22px;
    }


    .pr-donut-wrap {
        position: relative;

        display: grid;
        place-items: center;

        width: 158px;
        height: 158px;

        margin: auto;
    }


    .pr-donut {
        position: relative;

        width: 150px;
        height: 150px;

        border-radius: 50%;

        background:
            conic-gradient(
                #b90c61
                0
                var(--allocation-end),

                #05adb6
                var(--allocation-end)
                var(--ready-end),

                #31546d
                var(--ready-end)
                var(--ongoing-end),

                #2b735d
                var(--ongoing-end)
                100%
            );

        box-shadow:
            0 9px 20px rgba(101, 138, 163, .14);
    }


    .pr-donut::after {
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


    .pr-donut-center {
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


    .pr-donut-center strong {
        display: block;

        color: var(--pr-navy);

        font-size: 25px;
        font-weight: 850;
        line-height: 1;
    }


    .pr-donut-center span {
        display: block;

        margin-top: 4px;

        color: #71899c;

        font-size: 7.8px;
        font-weight: 700;
        line-height: 1.1;
    }


    .pr-status-list {
        display: grid;

        min-width: 0;

        gap: 9px;
    }


    .pr-status-row {
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


    .pr-status-label {
        display: flex;
        align-items: center;

        gap: 8px;

        min-width: 0;

        color: #496580;

        font-size: 9.3px;
        font-weight: 700;
    }


    .pr-status-dot {
        width: 8px;
        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;
    }


    .pr-status-dot.pink {
        background: #b90c61;
    }


    .pr-status-dot.teal {
        background: #05adb6;
    }


    .pr-status-dot.navy {
        background: #31546d;
    }


    .pr-status-dot.green {
        background: #2b735d;
    }


    .pr-status-value {
        flex-shrink: 0;

        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    /* ================================================================
       MONTHLY CHART
       ================================================================ */

    .pr-chart-body {
        min-height: 275px;

        padding: 22px;
    }


    .pr-chart {
        display: grid;

        grid-template-columns:
            30px
            minmax(0, 1fr);

        gap: 10px;
    }


    .pr-y-axis {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        height: 210px;

        padding-bottom: 25px;

        color: #7890a2;

        font-size: 8px;

        text-align: right;
    }


    .pr-plot {
        min-width: 0;
    }


    .pr-bars {
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


    .pr-bar-group {
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


    .pr-bar {
        min-height: 5px;

        border-radius:
            6px
            6px
            1px
            1px;
    }


    .pr-bar.created {
        background:
            linear-gradient(
                180deg,
                #05adb6,
                #007780
            );
    }


    .pr-bar.completed {
        background:
            linear-gradient(
                180deg,
                #ee1280,
                #b90c61
            );
    }


    .pr-x-axis {
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


    .pr-chart-legend {
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


    .pr-legend-item {
        display: inline-flex;
        align-items: center;

        gap: 6px;
    }


    .pr-legend-dot {
        width: 8px;
        height: 8px;

        border-radius: 50%;
    }


    .pr-legend-dot.teal {
        background: #05adb6;
    }


    .pr-legend-dot.pink {
        background: #ee1280;
    }


    /* ================================================================
       FILTERS
       ================================================================ */

    .pr-toolbar {
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
            var(--pr-line);

        background:
            rgba(
                234,
                244,
                248,
                .35
            );
    }


    .pr-filter-row {
        flex-wrap: wrap;

        gap: 7px;
    }


    .pr-filter {
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


    .pr-filter:hover {
        border-color: #a8d8de;

        color: var(--pr-teal);
    }


    .pr-filter.is-active {
        border-color:
            rgba(
                5,
                173,
                182,
                .28
            );

        background:
            linear-gradient(
                145deg,
                #e3f8f8,
                #d4eeee
            );

        color: var(--pr-teal);

        box-shadow:
            inset 2px 2px 4px rgba(70, 111, 130, .06);
    }


    .pr-record-count {
        flex-shrink: 0;

        color: #71899c;

        font-size: 9.5px;

        white-space: nowrap;
    }


    .pr-record-count strong {
        color: #29475f;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .pr-table-wrap {
        width: 100%;

        overflow-x: auto;
    }


    .pr-table {
        width: 100%;
        min-width: 1160px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .pr-table th {
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


    .pr-table td {
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


    .pr-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .pr-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .4
            );
    }


    .pr-project-name {
        display: block;

        max-width: 220px;

        color: #18344c;

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;
    }


    .pr-sub {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.4;
    }


    .pr-request {
        color: var(--pr-teal);

        font-size: 9.5px;
        font-weight: 750;
    }


    /* ================================================================
       STATUS BADGE
       ================================================================ */

    .pr-badge {
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


    .pr-badge.pink {
        background: #f8e0eb;

        color: #b90c61;
    }


    .pr-badge.teal {
        background: #dff4f4;

        color: #007780;
    }


    .pr-badge.navy {
        background: #e2ebf2;

        color: #31546d;
    }


    .pr-badge.green {
        background: #e2f0ea;

        color: #2b735d;
    }


    /* ================================================================
       RESOURCE READINESS
       ================================================================ */

    .pr-resource {
        min-width: 125px;
    }


    .pr-resource-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 8px;

        color: #567489;

        font-size: 8.5px;
    }


    .pr-resource-top strong {
        color: #29475f;

        font-size: 9.5px;
    }


    .pr-resource-track {
        width: 100%;
        height: 6px;

        margin-top: 6px;

        overflow: hidden;

        border-radius: 999px;

        background: #dbe8ed;

        box-shadow:
            inset 1px 1px 3px rgba(77, 111, 132, .1);
    }


    .pr-resource-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    /* ================================================================
       PROJECT PROGRESS
       ================================================================ */

    .pr-progress {
        width: 115px;
    }


    .pr-progress-top {
        display: flex;
        justify-content: space-between;

        gap: 8px;

        margin-bottom: 6px;

        color: #71899c;

        font-size: 8.5px;
    }


    .pr-progress-top strong {
        color: #29475f;

        font-size: 9.5px;
    }


    .pr-progress-track {
        height: 6px;

        overflow: hidden;

        border-radius: 999px;

        background: #dce8ed;
    }


    .pr-progress-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #31546d,
                #59809b
            );
    }


    /* ================================================================
       ISSUE
       ================================================================ */

    .pr-issue {
        display: inline-flex;
        align-items: flex-start;

        gap: 6px;

        max-width: 180px;

        color: var(--pr-pink);

        font-size: 9px;
        font-weight: 650;
        line-height: 1.45;
    }


    .pr-issue svg {
        width: 13px;
        height: 13px;

        flex: 0 0 13px;

        margin-top: 1px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .pr-clear {
        color: var(--pr-green);

        font-size: 9px;
        font-weight: 700;
    }


    /* ================================================================
       ACTION
       ================================================================ */

    .pr-view {
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
                #e5f8f8,
                #d4edef
            );

        color: var(--pr-teal);

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76);

        text-decoration: none;

        transition:
            color 150ms ease,
            transform 150ms ease,
            box-shadow 150ms ease;
    }


    .pr-view:hover {
        color: #005f66;

        transform:
            translateY(
                -1px
            );
    }


    .pr-view svg {
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

    .pr-empty {
        display: none;

        padding:
            42px
            20px;

        text-align: center;
    }


    .pr-empty.is-visible {
        display: block;
    }


    .pr-empty strong {
        color: #29475f;

        font-size: 14px;
    }


    .pr-empty p {
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

    .pr-table-footer {
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
            var(--pr-line);

        color: #71899c;

        font-size: 9.5px;
    }


    .pr-table-footer p {
        margin: 0;
    }


    .pr-table-footer strong {
        color: #29475f;
    }


    .pr-note {
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

    @container project-report (max-width: 900px) {
        .project-report > .pr-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container project-report (max-width: 820px) {
        .pr-analytics {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @container project-report (max-width: 700px) {
        .pr-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .pr-heading-actions {
            width: 100%;
        }


        .pr-heading-actions .pr-button {
            flex: 1;
        }


        .pr-status-body {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .pr-toolbar {
            align-items: flex-start;

            flex-direction: column;
        }


        .pr-source {
            display: none;
        }
    }


    @container project-report (max-width: 520px) {
        .project-report > .pr-summary {
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


        body:has(#project-report) #app-sidebar,
        body:has(#project-report) #sidebar-backdrop,
        body:has(#project-report) #pulso-topbar,
        body:has(#project-report) .hub-skip-link,
        .project-report .pr-no-print {
            display: none !important;
        }


        body:has(#project-report) #app-main {
            padding-left: 0 !important;
        }


        body:has(#project-report) .hub-content {
            padding: 0 !important;
        }


        .project-report {
            container-type: normal;
        }


        .project-report > .pr-summary {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap: 6px;
        }


        .pr-stat {
            min-height: auto;

            padding: 9px;
        }


        .pr-stat-icon {
            display: none;
        }


        .pr-stat,
        .pr-card,
        .pr-status-row {
            border:
                1px
                solid
                #d5d5d5 !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .pr-card,
        .pr-stat {
            break-inside: avoid;
        }


        .pr-analytics {
            grid-template-columns:
                .92fr
                1.08fr;

            gap: 10px;
        }


        .pr-table {
            min-width: 0;

            table-layout: fixed;
        }


        .pr-table th,
        .pr-table td {
            padding:
                7px
                5px;

            overflow-wrap: anywhere;
        }


        .pr-table thead {
            display: table-header-group;
        }


        .pr-table tr {
            break-inside: avoid;
        }


        .pr-badge {
            white-space: normal;
        }


        .pr-view {
            display: none;
        }
    }
</style>
@endpush


@section('content')
<div
    class="project-report"
    id="project-report"
>

    {{-- =============================================================
         HEADER
         ============================================================= --}}

    <header class="pr-heading">

        <div class="pr-heading-copy">

            <p class="pr-eyebrow">
                Project logistics analytics
            </p>

            <h1>
                Projects Report
            </h1>

            <p class="pr-description">
                Review project logistics stages, source requests,
                resource readiness, coordination progress, and issues
                affecting tracked PULSO activities.
            </p>

        </div>


        <div class="pr-heading-actions pr-no-print">

            <a
                class="pr-button"
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
                    pr-button
                    pr-button-primary
                "
                id="pr-print"
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
        class="pr-summary"
        aria-label="Project logistics summary"
    >

        @foreach ($summary as $item)

            <article
                class="pr-stat"
                data-tone="{{ $item['tone'] }}"
            >

                <span
                    class="pr-stat-icon"
                    aria-hidden="true"
                >

                    @if ($item['icon'] === 'projects')

                        <svg viewBox="0 0 24 24">
                            <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
                            <path d="M12 11v6"/>
                            <path d="M9 14h6"/>
                        </svg>

                    @elseif ($item['icon'] === 'activity')

                        <svg viewBox="0 0 24 24">
                            <path d="M4 19V9"/>
                            <path d="M10 19V5"/>
                            <path d="M16 19v-7"/>
                            <path d="M22 19V3"/>
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
                            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>

                    @endif

                </span>


                <div class="pr-stat-copy">

                    <strong class="pr-stat-value">
                        {{ $item['value'] }}
                    </strong>

                    <span class="pr-stat-label">
                        {{ $item['label'] }}
                    </span>

                    <span class="pr-stat-helper">
                        {{ $item['helper'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         ANALYTICS
         ============================================================= --}}

    <div class="pr-analytics">

        <section class="pr-card">

            <header class="pr-section-heading">

                <div class="pr-section-title">

                    <span class="pr-section-number">
                        01
                    </span>

                    <div>

                        <h2>
                            Project Status Distribution
                        </h2>

                        <p>
                            Current logistics stage of all tracked projects.
                        </p>

                    </div>

                </div>


                <span class="pr-source">
                    {{ $totalProjects }}
                    Projects
                </span>

            </header>


            <div class="pr-status-body">

                <div class="pr-donut-wrap">

                    <div
                        class="pr-donut"
                        style="
                            --allocation-end: {{ $allocationEnd }}%;
                            --ready-end: {{ $readyEnd }}%;
                            --ongoing-end: {{ $ongoingEnd }}%;
                        "
                        role="img"
                        aria-label="Project status distribution"
                    ></div>


                    <div class="pr-donut-center">

                        <strong>
                            {{ $totalProjects }}
                        </strong>

                        <span>
                            projects
                        </span>

                    </div>

                </div>


                <div class="pr-status-list">

                    @foreach ($statusStats as $status)

                        <div class="pr-status-row">

                            <span class="pr-status-label">

                                <span
                                    class="
                                        pr-status-dot
                                        {{ $status['tone'] }}
                                    "
                                ></span>

                                {{ $status['label'] }}

                            </span>


                            <span class="pr-status-value">
                                {{ $status['value'] }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        <section class="pr-card">

            <header class="pr-section-heading">

                <div class="pr-section-title">

                    <span class="pr-section-number pink">
                        02
                    </span>

                    <div>

                        <h2>
                            Project Activity Trend
                        </h2>

                        <p>
                            Historical project records created and completed.
                        </p>

                    </div>

                </div>


                <span class="pr-source">
                    Apr – Sep 2026
                </span>

            </header>


            <div class="pr-chart-body">

                <div class="pr-chart">

                    <div
                        class="pr-y-axis"
                        aria-hidden="true"
                    >

                        <span>
                            {{ $maxMonthlyProjects }}
                        </span>

                        <span>
                            {{ round($maxMonthlyProjects * .75, 1) }}
                        </span>

                        <span>
                            {{ round($maxMonthlyProjects * .5, 1) }}
                        </span>

                        <span>
                            {{ round($maxMonthlyProjects * .25, 1) }}
                        </span>

                        <span>
                            0
                        </span>

                    </div>


                    <div class="pr-plot">

                        <div class="pr-bars">

                            @foreach ($monthlyProjects as $month)

                                <div
                                    class="pr-bar-group"
                                    title="{{ $month['month'] }}: {{ $month['created'] }} created, {{ $month['completed'] }} completed"
                                >

                                    <div
                                        class="
                                            pr-bar
                                            created
                                        "
                                        style="
                                            height:
                                            {{
                                                max(
                                                    3,
                                                    ($month['created'] / $maxMonthlyProjects) * 100
                                                )
                                            }}%;
                                        "
                                    ></div>


                                    <div
                                        class="
                                            pr-bar
                                            completed
                                        "
                                        style="
                                            height:
                                            {{
                                                max(
                                                    3,
                                                    ($month['completed'] / $maxMonthlyProjects) * 100
                                                )
                                            }}%;
                                        "
                                    ></div>

                                </div>

                            @endforeach

                        </div>


                        <div class="pr-x-axis">

                            @foreach ($monthlyProjects as $month)

                                <span>
                                    {{ $month['month'] }}
                                </span>

                            @endforeach

                        </div>

                    </div>

                </div>


                <div class="pr-chart-legend">

                    <span class="pr-legend-item">

                        <span class="pr-legend-dot teal"></span>

                        Project records

                    </span>


                    <span class="pr-legend-item">

                        <span class="pr-legend-dot pink"></span>

                        Completed

                    </span>

                </div>

            </div>

        </section>

    </div>


    {{-- =============================================================
         PROJECT LOGISTICS REGISTER
         ============================================================= --}}

    <section class="pr-card">

        <header class="pr-section-heading">

            <div class="pr-section-title">

                <span class="pr-section-number">
                    03
                </span>

                <div>

                    <h2>
                        Project Logistics Register
                    </h2>

                    <p>
                        Detailed logistics status and resource readiness
                        for tracked PULSO activities.
                    </p>

                </div>

            </div>


            <span class="pr-source">
                {{ $totalProjects }}
                Records
            </span>

        </header>


        <div class="pr-toolbar pr-no-print">

            <div
                class="pr-filter-row"
                role="group"
                aria-label="Filter project status"
            >

                <button
                    class="
                        pr-filter
                        is-active
                    "
                    type="button"
                    data-project-filter="all"
                >
                    All
                </button>


                <button
                    class="pr-filter"
                    type="button"
                    data-project-filter="Resource Allocation"
                >
                    Resource Allocation
                </button>


                <button
                    class="pr-filter"
                    type="button"
                    data-project-filter="Ready"
                >
                    Ready
                </button>


                <button
                    class="pr-filter"
                    type="button"
                    data-project-filter="Ongoing"
                >
                    Ongoing
                </button>


                <button
                    class="pr-filter"
                    type="button"
                    data-project-filter="Completed"
                >
                    Completed
                </button>

            </div>


            <span class="pr-record-count">

                Showing

                <strong id="pr-visible-count">
                    {{ $totalProjects }}
                </strong>

                of

                <strong>
                    {{ $totalProjects }}
                </strong>

                records

            </span>

        </div>


        <div
            class="pr-table-wrap"
            role="region"
            aria-label="Projects report table"
            tabindex="0"
        >

            <table class="pr-table">

                <thead>

                    <tr>

                        <th scope="col">
                            Project
                        </th>

                        <th scope="col">
                            Source Request
                        </th>

                        <th scope="col">
                            Coordinator
                        </th>

                        <th scope="col">
                            Schedule
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th scope="col">
                            Resource Readiness
                        </th>

                        <th scope="col">
                            Progress
                        </th>

                        <th scope="col">
                            Issue
                        </th>

                        <th
                            scope="col"
                            class="pr-no-print"
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody id="pr-project-rows">

                    @foreach ($projects as $project)

                        @php
                            $readinessPercent =
                                $project['resources_total'] > 0
                                    ? round(
                                        (
                                            $project['resources_ready']
                                            /
                                            $project['resources_total']
                                        ) * 100
                                    )
                                    : 0;
                        @endphp


                        <tr
                            data-project-row
                            data-project-status="{{ $project['status'] }}"
                        >

                            <td>

                                <strong class="pr-project-name">
                                    {{ $project['name'] }}
                                </strong>

                                <span class="pr-sub">
                                    {{ $project['id'] }}
                                    ·
                                    {{ $project['committee'] }}
                                </span>

                            </td>


                            <td>

                                <span class="pr-request">
                                    {{ $project['request_id'] }}
                                </span>

                                <span class="pr-sub">
                                    Source logistics request
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $project['coordinator'] }}
                                </strong>

                                <span class="pr-sub">
                                    {{ $project['priority'] }}
                                    priority
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $project['date'] }}
                                </strong>

                                <span class="pr-sub">
                                    {{ $project['venue'] }}
                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        pr-badge
                                        {{ $project['tone'] }}
                                    "
                                >
                                    {{ $project['status'] }}
                                </span>

                            </td>


                            <td>

                                <div class="pr-resource">

                                    <div class="pr-resource-top">

                                        <span>
                                            Resource types
                                        </span>

                                        <strong>
                                            {{ $project['resources_ready'] }}
                                            /
                                            {{ $project['resources_total'] }}
                                        </strong>

                                    </div>


                                    <div class="pr-resource-track">

                                        <div
                                            class="pr-resource-fill"
                                            style="
                                                width:
                                                {{ $readinessPercent }}%;
                                            "
                                        ></div>

                                    </div>


                                    <span class="pr-sub">
                                        {{ $readinessPercent }}%
                                        ready
                                    </span>

                                </div>

                            </td>


                            <td>

                                <div class="pr-progress">

                                    <div class="pr-progress-top">

                                        <span>
                                            Logistics
                                        </span>

                                        <strong>
                                            {{ $project['progress'] }}%
                                        </strong>

                                    </div>


                                    <div class="pr-progress-track">

                                        <div
                                            class="pr-progress-fill"
                                            style="
                                                width:
                                                {{ $project['progress'] }}%;
                                            "
                                        ></div>

                                    </div>

                                </div>

                            </td>


                            <td>

                                @if ($project['issue'])

                                    <span class="pr-issue">

                                        <svg
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                                            <path d="M12 9v4"/>
                                            <path d="M12 17h.01"/>
                                        </svg>

                                        {{ $project['issue'] }}

                                    </span>

                                @else

                                    <span class="pr-clear">
                                        No unresolved issue
                                    </span>

                                @endif

                            </td>


                            <td class="pr-no-print">

                                <a
                                    class="pr-view"
                                    href="{{ route('projects.show', ['id' => $project['id']]) }}"
                                    title="View project logistics"
                                    aria-label="View {{ $project['name'] }}"
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
                class="pr-empty"
                id="pr-empty"
            >

                <strong>
                    No matching projects
                </strong>

                <p>
                    Select another project status to display records.
                </p>

            </div>

        </div>


        <footer class="pr-table-footer">

            <p>
                Resource readiness:

                <strong>
                    {{ $readyResourceTypes }}
                    /
                    {{ $totalResourceTypes }}
                </strong>

                resource types ready
            </p>


            <p>
                Completed projects:

                <strong>
                    {{ $completedProjects }}
                </strong>
            </p>


            <p>
                Projects requiring attention:

                <strong>
                    {{ $projectsWithIssues }}
                </strong>
            </p>

        </footer>

    </section>


    <p class="pr-note">
        Monthly activity uses historical sample analytics, while project
        status, resource readiness, issues, and the project register reflect
        the current five front-end project logistics records.
    </p>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeProjectsReport = () => {
        const page =
            document.getElementById(
                'project-report'
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
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const filters =
            Array.from(
                page.querySelectorAll(
                    '[data-project-filter]'
                )
            );


        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-project-row]'
                )
            );


        const empty =
            page.querySelector(
                '#pr-empty'
            );


        const visibleCount =
            page.querySelector(
                '#pr-visible-count'
            );


        const printButton =
            page.querySelector(
                '#pr-print'
            );


        /*
        |--------------------------------------------------------------------------
        | FILTERING
        |--------------------------------------------------------------------------
        */

        const applyFilter = (
            selected
        ) => {
            let visible =
                0;


            rows.forEach(
                (row) => {
                    const matches =
                        selected ===
                            'all' ||
                        row.dataset.projectStatus ===
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
                        const selected =
                            button.dataset.projectFilter
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


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

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
            initializeProjectsReport,
            {
                once: true
            }
        );
    } else {
        initializeProjectsReport();
    }
})();
</script>
@endpush