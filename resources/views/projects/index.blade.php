@extends('layouts.app')

@section('title', 'Projects | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | SAMPLE PROJECT LOGISTICS RECORDS
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
            'status' => 'Resource Allocation',
            'priority' => 'High',
            'progress' => 58,
            'resources_total' => 3,
            'resources_ready' => 2,
            'description' => 'Approved youth leadership activity currently undergoing logistics preparation and resource allocation.',
        ],
        [
            'id' => 'PRJ-2026-0017',
            'request_id' => 'REQ-2026-0046',
            'name' => 'Medical Mission',
            'committee' => 'Community Outreach',
            'coordinator' => 'Joshua Reyes',
            'date' => 'Sep 13, 2026',
            'venue' => 'Barangay Covered Court',
            'status' => 'Ready',
            'priority' => 'High',
            'progress' => 86,
            'resources_total' => 4,
            'resources_ready' => 4,
            'description' => 'Confirmed community medical mission with all requested logistics resources prepared for deployment.',
        ],
        [
            'id' => 'PRJ-2026-0016',
            'request_id' => 'REQ-2026-0045',
            'name' => 'Coastal Clean-Up Drive',
            'committee' => 'Environment & Health',
            'coordinator' => 'Angela Cruz',
            'date' => 'Sep 10, 2026',
            'venue' => 'Lakeside Community Area',
            'status' => 'Ongoing',
            'priority' => 'Normal',
            'progress' => 72,
            'resources_total' => 3,
            'resources_ready' => 3,
            'description' => 'Environmental clean-up activity currently in progress with assigned logistics resources already deployed.',
        ],
        [
            'id' => 'PRJ-2026-0015',
            'request_id' => 'REQ-2026-0041',
            'name' => 'Volunteer Orientation',
            'committee' => 'Volunteer Management',
            'coordinator' => 'Nicole Ramos',
            'date' => 'Sep 7, 2026',
            'venue' => 'PULSO Training Room',
            'status' => 'Completed',
            'priority' => 'Normal',
            'progress' => 100,
            'resources_total' => 2,
            'resources_ready' => 2,
            'description' => 'Completed volunteer orientation with all deployed logistics resources already returned and accounted for.',
        ],
        [
            'id' => 'PRJ-2026-0014',
            'request_id' => 'REQ-2026-0040',
            'name' => 'Student Assistance Orientation',
            'committee' => 'Education Committee',
            'coordinator' => 'Carlo Mendoza',
            'date' => 'Sep 6, 2026',
            'venue' => 'Community Learning Center',
            'status' => 'Completed',
            'priority' => 'Normal',
            'progress' => 100,
            'resources_total' => 1,
            'resources_ready' => 1,
            'description' => 'Completed student orientation activity with the assigned projector returned after use.',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | DYNAMIC SUMMARY
    |--------------------------------------------------------------------------
    */

    $projectCollection = collect($projects);

    $activeProjects = $projectCollection
        ->where('status', '!=', 'Completed');

    $resourcesReady = $activeProjects
        ->sum('resources_ready');

    $needsAttention = $activeProjects
        ->filter(function ($project) {
            return $project['resources_ready'] < $project['resources_total'];
        })
        ->count();

    $completedProjects = $projectCollection
        ->where('status', 'Completed')
        ->count();


    $summary = [
        [
            'label' => 'Active projects',
            'value' => $activeProjects->count(),
            'description' => 'Under logistics coordination',
            'tone' => 'navy',
            'icon' => 'project',
        ],
        [
            'label' => 'Resources ready',
            'value' => $resourcesReady,
            'description' => 'Prepared across active projects',
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'label' => 'Needs attention',
            'value' => $needsAttention,
            'description' => 'Unresolved resource gap',
            'tone' => 'pink',
            'icon' => 'alert',
        ],
        [
            'label' => 'Completed',
            'value' => $completedProjects,
            'description' => 'Finished logistics records',
            'tone' => 'green',
            'icon' => 'completed',
        ],
    ];
@endphp


@push('styles')
<style>
    .projects-page {
        --pj-navy: #10263d;
        --pj-copy: #496580;
        --pj-muted: #71899c;
        --pj-line: #d5e5ee;

        --pj-teal: #007780;
        --pj-pink: #b90c61;
        --pj-blue: #365f8d;
        --pj-red: #ad343d;
        --pj-amber: #895408;
        --pj-green: #2b735d;

        display: grid;
        gap: 23px;

        width: 100%;
        min-width: 0;

        color: var(--pj-navy);

        container-name: projects-page;
        container-type: inline-size;
    }

    .projects-page *,
    .projects-page *::before,
    .projects-page *::after {
        box-sizing: border-box;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .pj-icon {
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

    .pj-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .pj-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 26px;

        min-width: 0;
    }

    .pj-heading-copy {
        min-width: 0;
    }

    .pj-eyebrow {
        margin: 0 0 7px;

        color: var(--pj-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .pj-heading h1 {
        margin: 0;

        color: var(--pj-navy);

        font-size: clamp(30px, 3vw, 42px);
        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.055em;
    }

    .pj-heading-description {
        max-width: 760px;

        margin: 10px 0 0;

        color: var(--pj-copy);

        font-size: 14px;
        line-height: 1.7;
    }

    .pj-heading-note {
        display: flex;
        align-items: center;

        gap: 9px;

        flex-shrink: 0;

        max-width: 310px;

        padding: 10px 13px;

        border: 1px solid rgba(255, 255, 255, .94);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e4f6f7,
                #d8eef1
            );

        color: #46687d;

        box-shadow:
            inset 2px 2px 5px rgba(75, 109, 130, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .7);

        font-size: 10.5px;
        line-height: 1.5;
    }

    .pj-heading-note .pj-icon {
        width: 17px;
        height: 17px;

        color: var(--pj-teal);
    }


    /* ================================================================
       KPI WRAPPER
       ================================================================ */

    .projects-page > .pj-summary {
        display: grid !important;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 14px;

        width: 100%;
        min-width: 0;

        margin: 0 !important;
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

    .projects-page > .pj-summary::before,
    .projects-page > .pj-summary::after {
        display: none !important;

        width: 0 !important;
        height: 0 !important;

        border: 0 !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;

        opacity: 0 !important;
    }


    /* ================================================================
       KPI CARDS
       ================================================================ */

    .pj-summary-card {
        --pj-tone: #173b59;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );

        position: relative;

        display: flex;
        align-items: center;

        gap: 14px;

        min-width: 0;
        min-height: 106px;

        padding: 16px;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .97),
                rgba(232, 244, 249, .95)
            );

        box-shadow:
            6px 7px 15px rgba(101, 138, 163, .13),
            -5px -5px 12px rgba(255, 255, 255, .8),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .pj-summary-card::before {
        display: none !important;

        content: none !important;
    }

    .pj-summary-card::after {
        position: absolute;

        top: 0;
        right: 17px;

        width: 34px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--pj-tone);

        opacity: .5;

        content: "";
    }

    .pj-summary-icon {
        display: grid;
        place-items: center;

        width: 43px;
        height: 43px;

        flex: 0 0 43px;

        border: 1px solid rgba(255, 255, 255, .98);
        border-radius: 14px;

        background: var(--pj-tone-fill);

        color: var(--pj-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }

    .pj-summary-icon .pj-icon {
        width: 18px;
        height: 18px;
    }

    .pj-summary-copy {
        min-width: 0;
    }

    .pj-summary-value {
        display: block;

        color: var(--pj-tone);

        font-size: 26px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.045em;

        font-variant-numeric: tabular-nums;
    }

    .pj-summary-label {
        display: block;

        margin-top: 6px;

        color: #29475f;

        font-size: 11.5px;
        font-weight: 750;
    }

    .pj-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #70889a;

        font-size: 9.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       KPI TONES
       ================================================================ */

    .pj-tone-navy {
        --pj-tone: #173b59;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }

    .pj-tone-teal {
        --pj-tone: #007780;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }

    .pj-tone-pink {
        --pj-tone: #b90c61;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }

    .pj-tone-blue {
        --pj-tone: #365f8d;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #e8f0f8,
                #d7e5f2
            );
    }

    .pj-tone-red {
        --pj-tone: #ad343d;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #fdecee,
                #f5dadd
            );
    }

    .pj-tone-amber {
        --pj-tone: #895408;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }

    .pj-tone-green {
        --pj-tone: #2b735d;

        --pj-tone-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    /* ================================================================
       REGISTER
       ================================================================ */

    .pj-register {
        min-width: 0;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 23px;

        background:
            linear-gradient(
                145deg,
                rgba(248, 253, 255, .97),
                rgba(230, 242, 248, .96)
            );

        box-shadow:
            8px 10px 22px rgba(91, 128, 150, .15),
            -6px -6px 16px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .pj-register-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        padding: 20px 23px 18px;

        border-bottom: 1px solid rgba(207, 226, 236, .82);
    }

    .pj-register-title {
        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;
    }

    .pj-register-icon {
        display: grid;
        place-items: center;

        width: 44px;
        height: 44px;

        flex: 0 0 44px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e4fbfc,
                #c9edf0
            );

        color: var(--pj-teal);

        box-shadow:
            4px 5px 10px rgba(70, 115, 136, .11),
            -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .pj-register-icon .pj-icon {
        width: 18px;
        height: 18px;
    }

    .pj-register-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 780;

        letter-spacing: -.025em;
    }

    .pj-register-title p {
        margin: 4px 0 0;

        color: var(--pj-copy);

        font-size: 11px;
    }

    .pj-register-title p strong {
        color: var(--pj-teal);

        font-weight: 800;
    }

    .pj-register-tag {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        padding: 7px 10px;

        border: 1px solid rgba(255, 255, 255, .86);
        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #deedf3
            );

        color: #526f84;

        font-size: 9.5px;
        font-weight: 700;
    }

    .pj-register-tag .pj-icon {
        width: 14px;
        height: 14px;

        color: var(--pj-teal);
    }


    /* ================================================================
       FILTERS
       ================================================================ */

    .pj-filters {
        display: grid;

        grid-template-columns:
            minmax(260px, 1.6fr)
            minmax(155px, .7fr)
            minmax(155px, .7fr)
            auto;

        align-items: end;

        gap: 13px;

        padding: 18px 22px 20px;

        background:
            linear-gradient(
                180deg,
                rgba(233, 243, 248, .46),
                rgba(241, 248, 251, .18)
            );
    }

    .pj-field {
        min-width: 0;
    }

    .pj-field label {
        display: block;

        margin-bottom: 7px;

        color: #3c5a71;

        font-size: 11px;
        font-weight: 750;
    }

    .pj-search {
        position: relative;
    }

    .pj-search > .pj-icon {
        position: absolute;

        top: 50%;
        left: 14px;

        width: 17px;
        height: 17px;

        color: #678398;

        transform: translateY(-50%);

        pointer-events: none;
    }

    .pj-input {
        width: 100%;
        min-width: 0;
        min-height: 44px;

        padding: 9px 12px;

        border: 1px solid #d0e1e9;
        border-radius: 13px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e8f1f6,
                #edf5f9
            );

        color: var(--pj-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .15),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 12px;
    }

    .pj-search .pj-input {
        padding-left: 41px;
    }

    .pj-input::placeholder {
        color: #7b91a2;
    }

    .pj-input:focus {
        border-color: rgba(0, 126, 137, .48);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .09);
    }

    select.pj-input {
        cursor: pointer;
    }

    .pj-clear {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 44px;

        padding: 9px 14px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f6fbfd,
                #e4eef4
            );

        color: #365970;

        box-shadow:
            4px 5px 10px rgba(80, 115, 137, .1),
            -3px -3px 8px rgba(255, 255, 255, .8);

        font: inherit;
        font-size: 11px;
        font-weight: 700;

        cursor: pointer;

        white-space: nowrap;
    }

    .pj-clear:hover {
        color: var(--pj-teal);
    }

    .pj-clear .pj-icon {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .pj-table-scroll {
        width: 100%;

        overflow-x: auto;

        border-top: 1px solid var(--pj-line);
        border-bottom: 1px solid var(--pj-line);
    }

    .pj-table {
        width: 100%;
        min-width: 1190px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }

    .pj-table th {
        padding: 13px 14px;

        border-bottom: 1px solid #cfdee7;

        background: rgba(225, 240, 247, .78);

        color: #516d82;

        font-size: 10px;
        font-weight: 800;

        letter-spacing: .045em;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .pj-table td {
        padding: 14px;

        border-bottom: 1px solid rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 11.2px;

        vertical-align: middle;
    }

    .pj-table th:first-child,
    .pj-table td:first-child {
        padding-left: 22px;
    }

    .pj-table th:last-child,
    .pj-table td:last-child {
        padding-right: 22px;
    }

    .pj-table tbody tr {
        transition: background 150ms ease;
    }

    .pj-table tbody tr:hover {
        background: rgba(255, 255, 255, .46);
    }

    .pj-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* ================================================================
       PROJECT
       ================================================================ */

    .pj-record {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 240px;
    }

    .pj-record-icon {
        display: grid;
        place-items: center;

        width: 39px;
        height: 39px;

        flex: 0 0 39px;

        border: 1px solid rgba(255, 255, 255, .94);
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e4f9fa,
                #d0edef
            );

        color: var(--pj-teal);

        box-shadow:
            3px 4px 8px rgba(76, 112, 133, .09),
            -2px -2px 6px rgba(255, 255, 255, .74);
    }

    .pj-record-icon .pj-icon {
        width: 17px;
        height: 17px;
    }

    .pj-record-copy {
        min-width: 0;
    }

    .pj-record-id {
        display: block;

        color: #70879a;

        font-size: 9.5px;
        font-weight: 650;
    }

    .pj-record-name {
        display: block;

        max-width: 245px;

        margin-top: 3px;

        overflow: hidden;

        color: #18344c;

        font-size: 11.8px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .pj-secondary {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9.5px;
        line-height: 1.45;
    }

    .pj-resource-attention {
        color: #9e3158;
    }

    .pj-resource-ready {
        color: #39765f;
    }


    /* ================================================================
       REQUEST REFERENCE
       ================================================================ */

    .pj-request-reference {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        padding: 6px 8px;

        border: 1px solid rgba(255, 255, 255, .78);
        border-radius: 9px;

        background:
            linear-gradient(
                145deg,
                #edf6f9,
                #e1edf2
            );

        color: #496a80;

        box-shadow:
            inset 1px 1px 3px rgba(79, 112, 132, .04),
            inset -1px -1px 3px rgba(255, 255, 255, .72);

        font-size: 9.5px;
        font-weight: 750;

        white-space: nowrap;
    }

    .pj-request-reference .pj-icon {
        width: 13px;
        height: 13px;

        color: var(--pj-teal);
    }


    /* ================================================================
       STATUS BADGES
       ================================================================ */

    .pj-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 28px;

        padding: 5px 10px;

        border: 1px solid transparent;
        border-radius: 9px;

        font-size: 9.8px;
        font-weight: 800;

        white-space: nowrap;
    }

    .pj-status-allocation {
        border-color: #e4bdd1;

        background:
            linear-gradient(
                145deg,
                #fae7f0,
                #f2d5e3
            );

        color: #a1165b;
    }

    .pj-status-ready {
        border-color: #aedbdc;

        background:
            linear-gradient(
                145deg,
                #dff4f4,
                #cbe8e9
            );

        color: #166e73;
    }

    .pj-status-ongoing {
        border-color: #bfd3e7;

        background:
            linear-gradient(
                145deg,
                #e9f1fa,
                #d1e1f0
            );

        color: #315b88;
    }

    .pj-status-completed {
        border-color: #b4dccb;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;
    }


    /* ================================================================
       PRIORITY
       ================================================================ */

    .pj-priority {
        display: inline-flex;
        align-items: center;

        min-height: 24px;

        margin-top: 5px;

        padding: 4px 8px;

        border: 1px solid transparent;
        border-radius: 8px;

        font-size: 8.7px;
        font-weight: 750;

        white-space: nowrap;
    }

    .pj-priority-high {
        border-color: #efc0c5;

        background:
            linear-gradient(
                145deg,
                #fdebee,
                #f4d4d8
            );

        color: #a3333d;
    }

    .pj-priority-normal {
        border-color: #cfdfe8;

        background:
            linear-gradient(
                145deg,
                #edf4f7,
                #e1ebf0
            );

        color: #5b7386;
    }


    /* ================================================================
       PROGRESS
       ================================================================ */

    .pj-progress {
        width: 125px;
    }

    .pj-progress-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 8px;

        margin-bottom: 6px;

        color: #5f788a;

        font-size: 9px;
    }

    .pj-progress-top strong {
        color: #29475f;

        font-size: 10px;
    }

    .pj-progress-track {
        width: 100%;
        height: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #dce8ed;

        box-shadow:
            inset 2px 2px 4px rgba(86, 119, 139, .11),
            inset -1px -1px 3px rgba(255, 255, 255, .75);
    }

    .pj-progress-fill {
        height: 100%;

        border-radius: inherit;

        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }

    .pj-progress-fill-allocation {
        background:
            linear-gradient(
                90deg,
                #e94494,
                #b90c61
            );
    }

    .pj-progress-fill-ongoing {
        background:
            linear-gradient(
                90deg,
                #5985b3,
                #365f8d
            );
    }

    .pj-progress-fill-completed {
        background:
            linear-gradient(
                90deg,
                #4d9c7f,
                #2b735d
            );
    }


    /* ================================================================
       ACTION
       ================================================================ */

    .pj-action-heading {
        min-width: 90px;

        text-align: center;
    }

    .pj-action-cell {
        min-width: 90px;
    }

    .pj-actions {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;
    }

    .pj-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        padding: 0;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e7fafa,
                #d5eef0
            );

        color: var(--pj-teal);

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76);

        text-decoration: none;

        cursor: pointer;

        transition:
            transform 150ms ease,
            background 150ms ease,
            color 150ms ease;
    }

    .pj-action:hover {
        background:
            linear-gradient(
                145deg,
                #effcfc,
                #cae9ec
            );

        color: #006b73;

        transform: translateY(-1px);
    }

    .pj-action .pj-icon {
        width: 17px;
        height: 17px;
    }


    /* ================================================================
       EMPTY
       ================================================================ */

    .pj-empty {
        display: none;

        padding: 48px 24px;

        text-align: center;
    }

    .pj-empty.is-visible {
        display: block;
    }

    .pj-empty-symbol {
        display: grid;
        place-items: center;

        width: 56px;
        height: 56px;

        margin: 0 auto 14px;

        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                #e7f2f7,
                #d9e8ef
            );

        color: #678398;

        box-shadow:
            inset 3px 3px 7px rgba(90, 121, 141, .1),
            inset -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .pj-empty-symbol .pj-icon {
        width: 23px;
        height: 23px;
    }

    .pj-empty h3 {
        margin: 0;

        color: #29475f;

        font-size: 15px;
    }

    .pj-empty p {
        margin: 6px 0 0;

        color: var(--pj-muted);

        font-size: 11px;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .pj-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 10px 20px;

        padding: 15px 22px;

        color: var(--pj-muted);

        font-size: 10.5px;
    }

    .pj-footer p {
        margin: 0;
    }

    .pj-footer strong {
        color: #29475f;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container projects-page (max-width: 1000px) {
        .pj-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }

        .projects-page > .pj-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .pj-filters {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .pj-search-field {
            grid-column: 1 / -1;
        }

        .pj-clear {
            justify-self: start;
        }
    }

    @container projects-page (max-width: 620px) {
        .projects-page > .pj-summary {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .pj-register-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .pj-filters {
            grid-template-columns:
                minmax(0, 1fr);

            padding: 17px 16px;
        }

        .pj-search-field {
            grid-column: auto;
        }

        .pj-clear {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .pj-action {
            transition: none;
        }

        .pj-action:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div
    id="projects-page"
    class="projects-page"
>

    <svg
        class="pj-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="pj-icon-project" viewBox="0 0 24 24">
            <path d="M4 5h6l2 2h8v12H4Z"/>
            <path d="M8 12h8"/>
            <path d="M12 9v6"/>
        </symbol>

        <symbol id="pj-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="pj-icon-alert" viewBox="0 0 24 24">
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol id="pj-icon-completed" viewBox="0 0 24 24">
            <path d="M4 12.5 9 17l11-11"/>
        </symbol>

        <symbol id="pj-icon-info" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </symbol>

        <symbol id="pj-icon-search" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
        </symbol>

        <symbol id="pj-icon-filter" viewBox="0 0 24 24">
            <path d="M4 5h16"/>
            <path d="M7 12h10"/>
            <path d="M10 19h4"/>
            <path d="m5 5 14 14"/>
        </symbol>

        <symbol id="pj-icon-eye" viewBox="0 0 24 24">
            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
            <circle cx="12" cy="12" r="2.5"/>
        </symbol>

        <symbol id="pj-icon-request" viewBox="0 0 24 24">
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
    </svg>


    <header class="pj-heading">

        <div class="pj-heading-copy">

            <p class="pj-eyebrow">
                Project logistics tracking
            </p>

            <h1>
                Projects
            </h1>

            <p class="pj-heading-description">
                Track approved and confirmed PULSO activities that
                require logistics coordination, including resource
                preparation, readiness, deployment, and completion.
            </p>

        </div>


        <div class="pj-heading-note">

            <svg
                class="pj-icon"
                aria-hidden="true"
            >
                <use href="#pj-icon-info"/>
            </svg>

            <span>
                Project logistics records begin after a request is
                approved or an activity is confirmed.
            </span>

        </div>

    </header>


    <section
        class="pj-summary"
        aria-label="Project logistics summary"
    >

        @foreach ($summary as $item)

            <article
                class="
                    pj-summary-card
                    pj-tone-{{ $item['tone'] }}
                "
            >

                <span
                    class="pj-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="pj-icon">
                        <use href="#pj-icon-{{ $item['icon'] }}"/>
                    </svg>
                </span>


                <div class="pj-summary-copy">

                    <strong class="pj-summary-value">
                        {{ sprintf('%02d', $item['value']) }}
                    </strong>

                    <span class="pj-summary-label">
                        {{ $item['label'] }}
                    </span>

                    <span class="pj-summary-description">
                        {{ $item['description'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    <section
        class="pj-register"
        aria-labelledby="project-register-title"
    >

        <header class="pj-register-head">

            <div class="pj-register-title">

                <span
                    class="pj-register-icon"
                    aria-hidden="true"
                >
                    <svg class="pj-icon">
                        <use href="#pj-icon-project"/>
                    </svg>
                </span>


                <div>

                    <h2 id="project-register-title">
                        Project logistics register
                    </h2>

                    <p>
                        <strong id="project-visible-count">
                            {{ count($projects) }}
                        </strong>

                        matching projects
                    </p>

                </div>

            </div>


            <span class="pj-register-tag">

                <svg
                    class="pj-icon"
                    aria-hidden="true"
                >
                    <use href="#pj-icon-request"/>
                </svg>

                Approved request tracking

            </span>

        </header>


        <div
            class="pj-filters"
            role="search"
            aria-label="Search and filter projects"
        >

            <div class="pj-field pj-search-field">

                <label for="project-search">
                    Search projects
                </label>

                <div class="pj-search">

                    <svg
                        class="pj-icon"
                        aria-hidden="true"
                    >
                        <use href="#pj-icon-search"/>
                    </svg>

                    <input
                        id="project-search"
                        class="pj-input"
                        type="search"
                        placeholder="Project ID, request ID, activity, committee, coordinator..."
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="pj-field">

                <label for="project-status-filter">
                    Logistics status
                </label>

                <select
                    id="project-status-filter"
                    class="pj-input"
                >
                    <option value="">
                        All statuses
                    </option>

                    <option value="Resource Allocation">
                        Resource Allocation
                    </option>

                    <option value="Ready">
                        Ready
                    </option>

                    <option value="Ongoing">
                        Ongoing
                    </option>

                    <option value="Completed">
                        Completed
                    </option>
                </select>

            </div>


            <div class="pj-field">

                <label for="project-priority-filter">
                    Priority
                </label>

                <select
                    id="project-priority-filter"
                    class="pj-input"
                >
                    <option value="">
                        All priorities
                    </option>

                    <option value="High">
                        High
                    </option>

                    <option value="Normal">
                        Normal
                    </option>
                </select>

            </div>


            <button
                id="clear-project-filters"
                type="button"
                class="pj-clear"
            >
                <svg
                    class="pj-icon"
                    aria-hidden="true"
                >
                    <use href="#pj-icon-filter"/>
                </svg>

                Clear filters
            </button>

        </div>


        <div
            class="pj-table-scroll custom-scrollbar"
            role="region"
            aria-label="Project logistics records"
            tabindex="0"
        >

            <table class="pj-table">

                <caption class="sr-only">
                    Project logistics records including source
                    requests, coordinators, schedules, resources,
                    progress, status, and actions.
                </caption>


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
                            Resources
                        </th>

                        <th scope="col">
                            Progress
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th
                            scope="col"
                            class="pj-action-heading"
                        >
                            Action
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @foreach ($projects as $project)

                        @php
                            $resourcesPending = max(
                                0,
                                $project['resources_total']
                                - $project['resources_ready']
                            );

                            $statusClass = match ($project['status']) {
                                'Resource Allocation' => 'allocation',
                                'Ready' => 'ready',
                                'Ongoing' => 'ongoing',
                                'Completed' => 'completed',
                                default => 'ongoing',
                            };

                            $progressClass = match ($project['status']) {
                                'Resource Allocation' => 'pj-progress-fill-allocation',
                                'Ongoing' => 'pj-progress-fill-ongoing',
                                'Completed' => 'pj-progress-fill-completed',
                                default => '',
                            };

                            $priorityClass =
                                strtolower($project['priority']);
                        @endphp


                        <tr
                            data-project-row
                            data-status="{{ $project['status'] }}"
                            data-priority="{{ $project['priority'] }}"
                            data-search="{{ strtolower(
                                $project['id']
                                . ' '
                                . $project['request_id']
                                . ' '
                                . $project['name']
                                . ' '
                                . $project['committee']
                                . ' '
                                . $project['coordinator']
                                . ' '
                                . $project['venue']
                                . ' '
                                . $project['status']
                                . ' '
                                . $project['priority']
                            ) }}"
                        >

                            <td>

                                <div class="pj-record">

                                    <span
                                        class="pj-record-icon"
                                        aria-hidden="true"
                                    >
                                        <svg class="pj-icon">
                                            <use href="#pj-icon-project"/>
                                        </svg>
                                    </span>


                                    <div class="pj-record-copy">

                                        <span class="pj-record-id">
                                            {{ $project['id'] }}
                                        </span>

                                        <span class="pj-record-name">
                                            {{ $project['name'] }}
                                        </span>

                                        <span class="pj-secondary">
                                            {{ $project['committee'] }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="pj-request-reference">

                                    <svg
                                        class="pj-icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#pj-icon-request"/>
                                    </svg>

                                    {{ $project['request_id'] }}

                                </span>

                                <span class="pj-secondary">
                                    Source logistics request
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $project['coordinator'] }}
                                </strong>

                                <span
                                    class="
                                        pj-priority
                                        pj-priority-{{ $priorityClass }}
                                    "
                                >
                                    {{ $project['priority'] }} priority
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $project['date'] }}
                                </strong>

                                <span class="pj-secondary">
                                    {{ $project['venue'] }}
                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $project['resources_ready'] }}
                                    /
                                    {{ $project['resources_total'] }}
                                    ready
                                </strong>


                                @if ($resourcesPending > 0)

                                    <span
                                        class="
                                            pj-secondary
                                            pj-resource-attention
                                        "
                                    >
                                        {{ $resourcesPending }}

                                        {{ $resourcesPending === 1 ? 'resource type needs action' : 'resource types need action' }}
                                    </span>

                                @else

                                    <span
                                        class="
                                            pj-secondary
                                            pj-resource-ready
                                        "
                                    >
                                        All assigned resources prepared
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="pj-progress">

                                    <div class="pj-progress-top">

                                        <span>
                                            Logistics
                                        </span>

                                        <strong>
                                            {{ $project['progress'] }}%
                                        </strong>

                                    </div>


                                    <div
                                        class="pj-progress-track"
                                        role="progressbar"
                                        aria-label="{{ $project['name'] }} logistics progress"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-valuenow="{{ $project['progress'] }}"
                                    >
                                        <div
                                            class="
                                                pj-progress-fill
                                                {{ $progressClass }}
                                            "
                                            style="width: {{ $project['progress'] }}%;"
                                        ></div>
                                    </div>

                                </div>

                            </td>


                            <td>

                                <span
                                    class="
                                        pj-badge
                                        pj-status-{{ $statusClass }}
                                    "
                                >
                                    {{ $project['status'] }}
                                </span>

                            </td>


                            <td class="pj-action-cell">

                                <div class="pj-actions">

                                    <a
                                        href="{{ route('projects.show', ['id' => $project['id']]) }}"
                                        class="pj-action"
                                        title="View project logistics details"
                                        aria-label="View logistics details for {{ $project['name'] }}"
                                    >
                                        <svg
                                            class="pj-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#pj-icon-eye"/>
                                        </svg>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <div
            id="project-empty-state"
            class="pj-empty"
        >

            <span
                class="pj-empty-symbol"
                aria-hidden="true"
            >
                <svg class="pj-icon">
                    <use href="#pj-icon-search"/>
                </svg>
            </span>

            <h3>
                No matching projects
            </h3>

            <p>
                Try another search term or clear the current filters.
            </p>

        </div>


        <footer class="pj-footer">

            <p>
                Showing

                <strong id="project-visible-range">
                    {{ count($projects) }}
                </strong>

                of

                <strong>
                    {{ count($projects) }}
                </strong>

                project logistics records.
            </p>

            <span>
                Projects track logistics coordination after request processing.
            </span>

        </footer>

    </section>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeProjectsPage = () => {
        const page =
            document.getElementById(
                'projects-page'
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


        const searchInput =
            page.querySelector(
                '#project-search'
            );


        const statusFilter =
            page.querySelector(
                '#project-status-filter'
            );


        const priorityFilter =
            page.querySelector(
                '#project-priority-filter'
            );


        const clearFilters =
            page.querySelector(
                '#clear-project-filters'
            );


        const visibleCount =
            page.querySelector(
                '#project-visible-count'
            );


        const visibleRange =
            page.querySelector(
                '#project-visible-range'
            );


        const emptyState =
            page.querySelector(
                '#project-empty-state'
            );


        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-project-row]'
                )
            );


        if (
            !searchInput ||
            !statusFilter ||
            !priorityFilter ||
            !clearFilters ||
            !visibleCount ||
            !visibleRange ||
            !emptyState
        ) {
            return;
        }


        const normalize = (value) => {
            return String(
                value ?? ''
            )
                .trim()
                .toLowerCase();
        };


        const applyFilters = () => {
            const search =
                normalize(
                    searchInput.value
                );


            const status =
                normalize(
                    statusFilter.value
                );


            const priority =
                normalize(
                    priorityFilter.value
                );


            let visible =
                0;


            rows.forEach(
                (row) => {
                    const rowSearch =
                        normalize(
                            row.dataset.search
                        );


                    const rowStatus =
                        normalize(
                            row.dataset.status
                        );


                    const rowPriority =
                        normalize(
                            row.dataset.priority
                        );


                    const searchMatches =
                        !search ||
                        rowSearch.includes(
                            search
                        );


                    const statusMatches =
                        !status ||
                        rowStatus ===
                            status;


                    const priorityMatches =
                        !priority ||
                        rowPriority ===
                            priority;


                    const show =
                        searchMatches &&
                        statusMatches &&
                        priorityMatches;


                    row.hidden =
                        !show;


                    if (show) {
                        visible +=
                            1;
                    }
                }
            );


            visibleCount.textContent =
                String(
                    visible
                );


            visibleRange.textContent =
                String(
                    visible
                );


            emptyState.classList.toggle(
                'is-visible',
                visible ===
                    0
            );
        };


        searchInput.addEventListener(
            'input',
            applyFilters
        );


        statusFilter.addEventListener(
            'change',
            applyFilters
        );


        priorityFilter.addEventListener(
            'change',
            applyFilters
        );


        clearFilters.addEventListener(
            'click',
            () => {
                searchInput.value =
                    '';


                statusFilter.value =
                    '';


                priorityFilter.value =
                    '';


                applyFilters();


                searchInput.focus();
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
            initializeProjectsPage,
            {
                once: true
            }
        );
    } else {
        initializeProjectsPage();
    }
})();
</script>
@endpush