@extends('layouts.app')

@section('title', 'REQ-2026-0047 | PULSO Logistics Hub')

@php
    $requestData = [
        'id' => 'REQ-2026-0047',
        'project' => 'Youth Leadership Summit',
        'committee' => 'Events Committee',
        'requester' => 'Maria Santos',
        'requester_role' => 'Events Committee Head',
        'contact' => '0917 123 4567',
        'email' => 'maria.santos@example.com',
        'venue' => 'PULSO Activity Center',
        'date_needed' => 'September 12, 2026',
        'time_needed' => '8:00 AM – 5:00 PM',
        'submitted' => 'September 9, 2026 · 2:35 PM',
        'priority' => 'High',
        'status' => 'Needs Resolution',
        'purpose' => 'Logistics support for the Youth Leadership Summit, including presentation equipment, sound reinforcement, and seating for participants.',
        'notes' => 'Please prepare the requested equipment one day before the activity for testing and venue setup.',
    ];

    $resources = [
        [
            'name' => 'Portable Sound System',
            'category' => 'Audio',
            'requested' => 1,
            'available' => 1,
            'status' => 'Available',
            'tone' => 'teal',
            'asset_id' => 'PULSO-AUD-001',
        ],
        [
            'name' => 'Projector',
            'category' => 'Equipment',
            'requested' => 1,
            'available' => 1,
            'status' => 'Available',
            'tone' => 'teal',
            'asset_id' => 'PULSO-EQP-001',
        ],
        [
            'name' => 'Monoblock Chairs',
            'category' => 'Furniture',
            'requested' => 60,
            'available' => 50,
            'status' => 'Partial',
            'tone' => 'amber',
            'asset_id' => 'PULSO-FUR-001',
        ],
    ];

    $availableResources = collect($resources)
        ->where('status', 'Available')
        ->count();

    $resourcesNeedingAction = collect($resources)
        ->where('status', '!=', 'Available')
        ->count();

    $summary = [
        [
            'key' => 'resources',
            'label' => 'Resources',
            'value' => count($resources),
            'description' => 'Requested item types',
            'tone' => 'navy',
            'icon' => 'box',
        ],
        [
            'key' => 'available',
            'label' => 'Available',
            'value' => $availableResources,
            'description' => 'Fully available',
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'key' => 'action',
            'label' => 'Needs action',
            'value' => $resourcesNeedingAction,
            'description' => 'Partial availability',
            'tone' => 'pink',
            'icon' => 'alert',
        ],
        [
            'key' => 'priority',
            'label' => 'Priority',
            'value' => $requestData['priority'],
            'description' => 'Upcoming activity',
            'tone' => 'red',
            'icon' => 'priority',
        ],
    ];

    $timeline = [
        [
            'date' => 'Sep 9 · 2:35 PM',
            'title' => 'Request submitted',
            'description' => 'Events Committee submitted the logistics request.',
            'tone' => 'teal',
            'icon' => 'submit',
        ],
        [
            'date' => 'Sep 9 · 3:10 PM',
            'title' => 'Request received',
            'description' => 'Request entered the Logistics Hub review queue.',
            'tone' => 'blue',
            'icon' => 'receive',
        ],
        [
            'date' => 'Sep 10 · 8:40 AM',
            'title' => 'Availability checked',
            'description' => 'Two resource types are fully available; chairs require resolution.',
            'tone' => 'pink',
            'icon' => 'review',
        ],
    ];

    $workflowSteps = [
        [
            'key' => 'Submitted',
            'label' => 'Submitted',
            'icon' => 'submit',
        ],
        [
            'key' => 'Under Review',
            'label' => 'Under Review',
            'icon' => 'review',
        ],
        [
            'key' => 'Needs Resolution',
            'label' => 'Needs Resolution',
            'icon' => 'alert',
        ],
        [
            'key' => 'Approved',
            'label' => 'Approved',
            'icon' => 'check',
        ],
        [
            'key' => 'Preparing',
            'label' => 'Preparing',
            'icon' => 'tools',
        ],
        [
            'key' => 'Ready for Release',
            'label' => 'Ready',
            'icon' => 'ready',
        ],
        [
            'key' => 'Released / Deployed',
            'label' => 'Released',
            'icon' => 'release',
        ],
        [
            'key' => 'For Return',
            'label' => 'For Return',
            'icon' => 'return',
        ],
        [
            'key' => 'Completed',
            'label' => 'Completed',
            'icon' => 'check',
        ],
    ];
@endphp


@push('styles')
<style>
    .request-detail-page {
        --rd-navy: #10263d;
        --rd-copy: #496580;
        --rd-muted: #71899c;
        --rd-line: #d5e5ee;

        --rd-teal: #007780;
        --rd-pink: #b90c61;
        --rd-blue: #365f8d;
        --rd-red: #a93642;
        --rd-amber: #895408;
        --rd-green: #2b735d;

        display: grid;
        gap: 22px;

        width: 100%;
        min-width: 0;

        color: var(--rd-navy);

        container-name: request-detail;
        container-type: inline-size;
    }

    .request-detail-page *,
    .request-detail-page *::before,
    .request-detail-page *::after {
        box-sizing: border-box;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .rd-icon {
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

    .rd-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .rd-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 26px;

        min-width: 0;
    }

    .rd-heading-copy {
        min-width: 0;
    }

    .rd-eyebrow {
        margin: 0 0 7px;

        color: var(--rd-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .rd-heading h1 {
        margin: 0;

        color: var(--rd-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;

        overflow-wrap: anywhere;
    }

    .rd-heading-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 8px;

        margin-top: 10px;

        color: var(--rd-copy);

        font-size: 11px;
        line-height: 1.5;
    }

    .rd-heading-meta strong {
        color: #29475f;

        font-weight: 750;
    }

    .rd-heading-dot {
        width: 4px;
        height: 4px;

        border-radius: 50%;

        background: #91a7b6;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .rd-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding: 9px 14px;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f6fbfd,
                #e4eef4
            );

        color: #31546d;

        box-shadow:
            4px 5px 10px rgba(83, 117, 139, .12),
            -3px -3px 8px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 11px;
        font-weight: 700;

        text-decoration: none;

        cursor: pointer;

        transition:
            transform 160ms ease,
            color 160ms ease,
            background 160ms ease;
    }

    .rd-button .rd-icon {
        width: 16px;
        height: 16px;
    }

    .rd-button:hover {
        color: var(--rd-teal);

        transform: translateY(-1px);
    }


    /* ================================================================
       STATUS BADGES
       ================================================================ */

    .rd-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 27px;

        padding: 4px 9px;

        border: 1px solid transparent;
        border-radius: 9px;

        font-size: 9.5px;
        font-weight: 800;

        white-space: nowrap;
    }

    .rd-status-pending {
        border-color: #efd39a;

        background:
            linear-gradient(
                145deg,
                #fff4d8,
                #f7e1ae
            );

        color: #885704;
    }

    .rd-status-review {
        border-color: #eeb6cf;

        background:
            linear-gradient(
                145deg,
                #fde7f1,
                #f3cddd
            );

        color: #a20c54;
    }

    .rd-status-resolution {
        border-color: #efbec3;

        background:
            linear-gradient(
                145deg,
                #fde8eb,
                #f3d0d5
            );

        color: #a42f3b;
    }

    .rd-status-approved {
        border-color: #a7dfe0;

        background:
            linear-gradient(
                145deg,
                #ddf5f5,
                #c4e8e9
            );

        color: #006c73;
    }

    .rd-status-preparing {
        border-color: #bfd3e7;

        background:
            linear-gradient(
                145deg,
                #e9f1fa,
                #d1e1f0
            );

        color: #315b88;
    }

    .rd-status-ready {
        border-color: #b4dccb;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;
    }

    .rd-status-released {
        border-color: #c1d1df;

        background:
            linear-gradient(
                145deg,
                #e8f0f6,
                #d8e4ee
            );

        color: #244b6b;
    }

    .rd-status-return {
        border-color: #efd39a;

        background:
            linear-gradient(
                145deg,
                #fff4d8,
                #f7e1ae
            );

        color: #885704;
    }

    .rd-status-completed {
        border-color: #b4dccb;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;
    }

    .rd-status-declined {
        border-color: #edb9bf;

        background:
            linear-gradient(
                145deg,
                #fde7e9,
                #f2ccd1
            );

        color: #a32f39;
    }


    /* ================================================================
       GENERAL TONES
       ================================================================ */

    .rd-tone-navy {
        --rd-tone: #173b59;
        --rd-tone-fill: #e4eef7;
    }

    .rd-tone-teal {
        --rd-tone: #007780;
        --rd-tone-fill: #d6f3f4;
    }

    .rd-tone-pink {
        --rd-tone: #b90c61;
        --rd-tone-fill: #f9deec;
    }

    .rd-tone-blue {
        --rd-tone: #365f8d;
        --rd-tone-fill: #e0eaf5;
    }

    .rd-tone-red {
        --rd-tone: #ad343d;
        --rd-tone-fill: #fde5e8;
    }

    .rd-tone-amber {
        --rd-tone: #895408;
        --rd-tone-fill: #fff0d7;
    }

    .rd-tone-green {
        --rd-tone: #2b735d;
        --rd-tone-fill: #dcefe8;
    }


    /* ================================================================
       WORKFLOW
       ================================================================ */

    .rd-workflow-card {
        padding: 18px 20px 20px;

        border: 1px solid rgba(255, 255, 255, .97);

        border-radius: 20px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .97),
                rgba(230, 242, 248, .96)
            );

        box-shadow:
            7px 8px 18px rgba(101, 138, 163, .14),
            -6px -6px 15px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .rd-workflow-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 16px;

        margin-bottom: 17px;
    }

    .rd-workflow-title strong {
        display: block;

        color: #29475f;

        font-size: 12px;
        font-weight: 800;
    }

    .rd-workflow-title span {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9px;
    }

    .rd-workflow-current {
        color: #71899c;

        font-size: 9px;
    }

    .rd-workflow-scroll {
        overflow-x: auto;

        padding-bottom: 5px;
    }

    .rd-workflow {
        position: relative;

        display: grid;

        grid-template-columns:
            repeat(
                9,
                minmax(92px, 1fr)
            );

        gap: 7px;

        min-width: 900px;
    }

    .rd-workflow-step {
        position: relative;

        display: flex;
        flex-direction: column;
        align-items: center;

        gap: 7px;

        min-width: 0;

        text-align: center;
    }

    .rd-workflow-step:not(:last-child)::after {
        position: absolute;

        top: 17px;
        left: calc(50% + 20px);

        width: calc(100% - 40px);
        height: 2px;

        background: #cfdee6;

        content: "";
    }

    .rd-workflow-node {
        position: relative;
        z-index: 2;

        display: grid;
        place-items: center;

        width: 35px;
        height: 35px;

        border: 1px solid rgba(255, 255, 255, .9);
        border-radius: 50%;

        background:
            linear-gradient(
                145deg,
                #e9f1f5,
                #dce7ed
            );

        color: #7b909f;

        box-shadow:
            2px 3px 7px rgba(80, 112, 131, .09),
            -2px -2px 5px rgba(255, 255, 255, .72);
    }

    .rd-workflow-node .rd-icon {
        width: 15px;
        height: 15px;
    }

    .rd-workflow-step > span:last-child {
        color: #748a9b;

        font-size: 8.5px;
        font-weight: 650;
        line-height: 1.35;
    }

    .rd-workflow-step.is-complete .rd-workflow-node {
        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #cdecef
            );

        color: var(--rd-teal);
    }

    .rd-workflow-step.is-complete:not(:last-child)::after {
        background:
            linear-gradient(
                90deg,
                #19a5ad,
                #8bcdd1
            );
    }

    .rd-workflow-step.is-current .rd-workflow-node {
        background:
            linear-gradient(
                145deg,
                #fff0f8,
                #f2d2e2
            );

        color: var(--rd-pink);

        box-shadow:
            0 0 0 4px rgba(185, 12, 97, .07),
            3px 4px 8px rgba(93, 75, 91, .1),
            -2px -2px 6px rgba(255, 255, 255, .74);
    }

    .rd-workflow-step.is-current > span:last-child {
        color: #9a1457;

        font-weight: 800;
    }


    /* ================================================================
       SUMMARY
       ================================================================ */

    .rd-summary {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 13px;
    }

    .rd-summary-card {
        --rd-tone: #173b59;
        --rd-tone-fill: #e4eef7;

        position: relative;

        display: flex;
        align-items: center;

        gap: 12px;

        min-width: 0;
        min-height: 92px;

        padding: 14px;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .96),
                rgba(230, 242, 248, .95)
            );

        box-shadow:
            5px 6px 13px rgba(101, 138, 163, .12),
            -4px -4px 10px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .rd-summary-card::after {
        position: absolute;

        top: 0;
        right: 14px;

        width: 30px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--rd-tone);

        opacity: .48;

        content: "";
    }

    .rd-summary-icon {
        display: grid;
        place-items: center;

        width: 39px;
        height: 39px;

        flex: 0 0 39px;

        border-radius: 12px;

        background: var(--rd-tone-fill);

        color: var(--rd-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .09),
            -3px -3px 7px rgba(255, 255, 255, .72);
    }

    .rd-summary-icon .rd-icon {
        width: 17px;
        height: 17px;
    }

    .rd-summary-copy {
        min-width: 0;
    }

    .rd-summary-value {
        display: block;

        color: var(--rd-tone);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        font-variant-numeric: tabular-nums;
    }

    .rd-summary-value--text {
        font-size: 17px;
    }

    .rd-summary-label {
        display: block;

        margin-top: 5px;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 750;
    }

    .rd-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       MAIN GRID
       ================================================================ */

    .rd-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.3fr)
            minmax(300px, .7fr);

        align-items: start;

        gap: 20px;
    }

    .rd-main,
    .rd-side {
        display: grid;

        gap: 20px;

        min-width: 0;
    }


    /* ================================================================
       CARDS
       ================================================================ */

    .rd-card,
    .rd-review {
        min-width: 0;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .97);

        border-radius: 21px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .97),
                rgba(230, 242, 248, .96)
            );

        box-shadow:
            7px 8px 18px rgba(101, 138, 163, .14),
            -6px -6px 15px rgba(255, 255, 255, .8),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .rd-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        padding: 17px 19px 15px;

        border-bottom: 1px solid var(--rd-line);

        background:
            linear-gradient(
                180deg,
                rgba(244, 251, 253, .55),
                rgba(233, 243, 248, .18)
            );
    }

    .rd-card-title {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;
    }

    .rd-number {
        display: grid;
        place-items: center;

        width: 32px;
        height: 32px;

        flex: 0 0 32px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #f9e4ef,
                #efd0df
            );

        color: var(--rd-pink);

        box-shadow:
            3px 4px 8px rgba(85, 118, 138, .08),
            -2px -2px 6px rgba(255, 255, 255, .7);

        font-size: 9px;
        font-weight: 850;
    }

    .rd-card-head h2 {
        margin: 0;

        color: #18344c;

        font-size: 14px;
        font-weight: 800;
    }

    .rd-card-caption {
        color: var(--rd-muted);

        font-size: 9px;

        text-align: right;
    }


    /* ================================================================
       REQUEST INFORMATION
       ================================================================ */

    .rd-info-grid {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 12px;

        margin: 0;

        padding: 19px;
    }

    .rd-info-item {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        min-width: 0;

        padding: 11px 12px;

        border: 1px solid rgba(255, 255, 255, .88);
        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e9f3f7,
                #f2f8fa
            );

        box-shadow:
            inset 2px 2px 5px rgba(82, 116, 138, .08),
            inset -2px -2px 5px rgba(255, 255, 255, .78);
    }

    .rd-info-icon {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #d0ecef
            );

        color: var(--rd-teal);
    }

    .rd-info-icon .rd-icon {
        width: 15px;
        height: 15px;
    }

    .rd-info-item dt {
        color: #6c8497;

        font-size: 9px;
    }

    .rd-info-item dd {
        margin: 4px 0 0;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 700;

        overflow-wrap: anywhere;
    }


    /* ================================================================
       PURPOSE
       ================================================================ */

    .rd-purpose {
        padding: 0 19px 19px;
    }

    .rd-purpose-box {
        padding: 13px 14px;

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e5f3f6,
                #edf7f9
            );

        box-shadow:
            inset 3px 3px 7px rgba(78, 113, 134, .08),
            inset -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .rd-purpose-label {
        display: block;

        margin-bottom: 6px;

        color: #31546d;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .05em;

        text-transform: uppercase;
    }

    .rd-purpose-box p {
        margin: 0;

        color: var(--rd-copy);

        font-size: 10.5px;
        line-height: 1.65;
    }


    /* ================================================================
       RESOURCE TABLE
       ================================================================ */

    .rd-resource-table-wrap {
        width: 100%;

        overflow-x: auto;
    }

    .rd-resource-table {
        width: 100%;
        min-width: 690px;

        border-collapse: separate;
        border-spacing: 0;
    }

    .rd-resource-table th {
        padding: 11px 13px;

        border-bottom: 1px solid #d1e1e9;

        background: rgba(226, 240, 247, .7);

        color: #526d82;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .04em;

        text-align: left;
        text-transform: uppercase;
    }

    .rd-resource-table td {
        padding: 13px;

        border-bottom: 1px solid rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 10.5px;

        vertical-align: middle;
    }

    .rd-resource-table th:first-child,
    .rd-resource-table td:first-child {
        padding-left: 19px;
    }

    .rd-resource-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .rd-resource {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 210px;
    }

    .rd-resource-icon {
        display: grid;
        place-items: center;

        width: 37px;
        height: 37px;

        flex: 0 0 37px;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e5fafa,
                #d0edef
            );

        color: var(--rd-teal);

        box-shadow:
            3px 4px 8px rgba(76, 112, 133, .09),
            -2px -2px 6px rgba(255, 255, 255, .72);
    }

    .rd-resource-icon .rd-icon {
        width: 16px;
        height: 16px;
    }

    .rd-resource-copy strong {
        display: block;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 750;
    }

    .rd-resource-copy span {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
    }

    .rd-number-cell {
        color: #29475f;

        font-weight: 750;

        text-align: center;
    }

    .rd-availability {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 26px;

        padding: 4px 9px;

        border: 1px solid rgba(255, 255, 255, .75);
        border-radius: 8px;

        background: var(--rd-tone-fill);

        color: var(--rd-tone);

        font-size: 9px;
        font-weight: 750;

        white-space: nowrap;
    }


    /* ================================================================
       SHORTAGE
       ================================================================ */

    .rd-shortage {
        display: flex;
        align-items: flex-start;

        gap: 11px;

        margin: 13px 19px 19px;

        padding: 12px 13px;

        border: 1px solid rgba(231, 196, 137, .5);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #fff1e1,
                #f6e7d1
            );

        color: #76501b;

        box-shadow:
            inset 2px 2px 5px rgba(121, 91, 49, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .68);
    }

    .rd-shortage.is-resolved {
        display: none;
    }

    .rd-shortage .rd-icon {
        width: 17px;
        height: 17px;

        flex: 0 0 17px;

        margin-top: 1px;

        color: #9a640e;
    }

    .rd-shortage strong {
        display: block;

        font-size: 10px;
    }

    .rd-shortage p {
        margin: 3px 0 0;

        font-size: 9.5px;
        line-height: 1.55;
    }


    /* ================================================================
       REQUESTER
       ================================================================ */

    .rd-requester {
        padding: 19px;
    }

    .rd-requester-main {
        display: flex;
        align-items: center;

        gap: 12px;

        padding-bottom: 15px;

        border-bottom: 1px solid var(--rd-line);
    }

    .rd-avatar {
        display: grid;
        place-items: center;

        width: 46px;
        height: 46px;

        flex: 0 0 46px;

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #fff0f8,
                #f3d4e4
            );

        color: var(--rd-pink);

        box-shadow:
            3px 4px 9px rgba(80, 113, 134, .1),
            -2px -2px 6px rgba(255, 255, 255, .74);

        font-size: 11px;
        font-weight: 850;
    }

    .rd-requester-copy {
        min-width: 0;
    }

    .rd-requester-copy strong {
        display: block;

        color: #29475f;

        font-size: 11.5px;
    }

    .rd-requester-copy span {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9px;
    }

    .rd-contact {
        display: grid;

        gap: 10px;

        margin-top: 14px;
    }

    .rd-contact-row {
        display: flex;
        align-items: center;

        gap: 9px;

        color: #526f84;

        font-size: 9.5px;

        overflow-wrap: anywhere;
    }

    .rd-contact-row .rd-icon {
        width: 14px;
        height: 14px;

        color: var(--rd-teal);
    }


    /* ================================================================
       TIMELINE
       ================================================================ */

    .rd-timeline {
        margin: 0;

        padding: 3px 19px 19px;

        list-style: none;
    }

    .rd-timeline-item {
        position: relative;

        display: flex;
        align-items: flex-start;

        gap: 11px;

        padding-top: 15px;
    }

    .rd-timeline-item:not(:last-child)::after {
        position: absolute;

        top: 48px;
        bottom: -15px;
        left: 17px;

        width: 1px;

        background: #cddfe7;

        content: "";
    }

    .rd-timeline-marker {
        display: grid;
        place-items: center;

        width: 35px;
        height: 35px;

        flex: 0 0 35px;

        border-radius: 11px;

        background: var(--rd-tone-fill);

        color: var(--rd-tone);

        box-shadow:
            3px 4px 8px rgba(76, 111, 133, .09),
            -2px -2px 6px rgba(255, 255, 255, .72);
    }

    .rd-timeline-marker .rd-icon {
        width: 15px;
        height: 15px;
    }

    .rd-timeline-copy time {
        display: block;

        color: #7890a1;

        font-size: 8.5px;
    }

    .rd-timeline-copy strong {
        display: block;

        margin-top: 3px;

        color: #29475f;

        font-size: 10.5px;
    }

    .rd-timeline-copy p {
        margin: 3px 0 0;

        color: #647d91;

        font-size: 9px;
        line-height: 1.5;
    }


    /* ================================================================
       ACTION PANEL
       ================================================================ */

    .rd-review-body {
        padding: 19px;
    }

    .rd-review-status {
        display: flex;
        align-items: flex-start;

        gap: 11px;
    }

    .rd-review-icon {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        flex: 0 0 40px;

        border: 1px solid rgba(255, 255, 255, .9);
        border-radius: 13px;

        background: var(--rd-tone-fill);

        color: var(--rd-tone);

        box-shadow:
            3px 4px 9px rgba(77, 112, 133, .09),
            -2px -2px 6px rgba(255, 255, 255, .72);
    }

    .rd-review-icon .rd-icon {
        width: 17px;
        height: 17px;
    }

    .rd-review-copy strong {
        display: block;

        color: #29475f;

        font-size: 11.5px;
    }

    .rd-review-copy p {
        margin: 4px 0 0;

        color: #60798d;

        font-size: 9.5px;
        line-height: 1.55;
    }

    .rd-review-note {
        margin-top: 15px;
    }

    .rd-review-note label {
        display: block;

        margin-bottom: 7px;

        color: #31546d;

        font-size: 10px;
        font-weight: 750;
    }

    .rd-review-note textarea {
        width: 100%;
        min-height: 82px;

        padding: 10px 11px;

        border: 1px solid #cfdfe8;
        border-radius: 12px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e7f0f5,
                #edf5f9
            );

        color: var(--rd-navy);

        box-shadow:
            inset 3px 3px 7px rgba(93, 126, 148, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 10px;

        resize: vertical;
    }

    .rd-review-note textarea:focus {
        border-color: rgba(0, 119, 128, .45);

        box-shadow:
            inset 3px 3px 7px rgba(93, 126, 148, .12),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .08);
    }

    .rd-review-actions {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 9px;

        margin-top: 14px;
    }

    .rd-action-primary,
    .rd-action-danger,
    .rd-action-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 42px;

        padding: 8px 11px;

        border-radius: 12px;

        font: inherit;
        font-size: 9.5px;
        font-weight: 750;

        cursor: pointer;

        transition:
            transform 150ms ease,
            background 150ms ease;
    }

    .rd-action-primary {
        border: 1px solid #bff8fa;

        background:
            linear-gradient(
                145deg,
                #00858e,
                #00747f
            );

        color: #ffffff;

        box-shadow:
            4px 5px 11px rgba(0, 126, 139, .19),
            inset 1px 1px 3px rgba(125, 234, 240, .48);
    }

    .rd-action-danger {
        border: 1px solid rgba(255, 255, 255, .9);

        background:
            linear-gradient(
                145deg,
                #fff1f3,
                #f2d8dc
            );

        color: var(--rd-red);

        box-shadow:
            3px 4px 9px rgba(145, 43, 51, .1),
            -2px -2px 6px rgba(255, 255, 255, .72);
    }

    .rd-action-secondary {
        border: 1px solid rgba(255, 255, 255, .92);

        background:
            linear-gradient(
                145deg,
                #f5fafc,
                #e3edf2
            );

        color: #3f6177;

        box-shadow:
            3px 4px 9px rgba(77, 111, 132, .1),
            -2px -2px 6px rgba(255, 255, 255, .72);
    }

    .rd-action-primary:hover,
    .rd-action-danger:hover,
    .rd-action-secondary:hover {
        transform: translateY(-1px);
    }

    .rd-action-primary .rd-icon,
    .rd-action-danger .rd-icon,
    .rd-action-secondary .rd-icon {
        width: 14px;
        height: 14px;
    }

    .rd-full-action {
        grid-column: 1 / -1;
    }


    /* ================================================================
       REQUESTER NOTE
       ================================================================ */

    .rd-note {
        display: flex;
        align-items: flex-start;

        gap: 11px;

        padding: 13px 14px;

        border: 1px solid rgba(255, 255, 255, .86);
        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #e4f3f6,
                #edf7f9
            );

        box-shadow:
            inset 3px 3px 7px rgba(78, 113, 134, .08),
            inset -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .rd-note-icon {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e1f7f8,
                #ccecef
            );

        color: var(--rd-teal);
    }

    .rd-note-icon .rd-icon {
        width: 15px;
        height: 15px;
    }

    .rd-note strong {
        display: block;

        color: #29475f;

        font-size: 10.5px;
    }

    .rd-note p {
        margin: 4px 0 0;

        color: #60798d;

        font-size: 9.5px;
        line-height: 1.6;
    }


    /* ================================================================
       MODAL
       ================================================================ */

    .rd-modal {
        position: fixed;
        inset: 0;
        z-index: 100;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 20px;

        background: rgba(16, 38, 61, .54);

        backdrop-filter: blur(5px);
    }

    .rd-modal.is-open {
        display: flex;
    }

    .rd-modal-panel {
        width: min(100%, 430px);

        padding: 22px;

        border: 1px solid rgba(255, 255, 255, .95);
        border-radius: 20px;

        background:
            linear-gradient(
                145deg,
                #f8fcfe,
                #e5f0f5
            );

        box-shadow:
            12px 16px 36px rgba(38, 66, 84, .26),
            -5px -5px 15px rgba(255, 255, 255, .65);
    }

    .rd-modal-symbol {
        display: grid;
        place-items: center;

        width: 47px;
        height: 47px;

        border-radius: 14px;

        background: var(--rd-tone-fill);

        color: var(--rd-tone);
    }

    .rd-modal h2 {
        margin: 16px 0 0;

        color: #18344c;

        font-size: 18px;
    }

    .rd-modal p {
        margin: 7px 0 0;

        color: var(--rd-copy);

        font-size: 11px;
        line-height: 1.65;
    }

    .rd-modal-actions {
        display: flex;
        justify-content: flex-end;

        gap: 10px;

        margin-top: 20px;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container request-detail (max-width: 1000px) {
        .rd-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .rd-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .rd-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @container request-detail (max-width: 680px) {
        .rd-info-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @container request-detail (max-width: 520px) {
        .rd-summary {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .rd-shortage {
            margin: 12px 15px 16px;
        }

        .rd-review-actions {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .rd-full-action {
            grid-column: auto;
        }

        .rd-modal-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);
        }

        .rd-modal-actions > * {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .rd-button,
        .rd-action-primary,
        .rd-action-danger,
        .rd-action-secondary {
            transition: none;
        }

        .rd-button:hover,
        .rd-action-primary:hover,
        .rd-action-danger:hover,
        .rd-action-secondary:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div
    id="request-detail-page"
    class="request-detail-page"
    data-request-status="{{ $requestData['status'] }}"
>

    <svg
        class="rd-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="rd-icon-back" viewBox="0 0 24 24">
            <path d="M19 12H5"/>
            <path d="m11 6-6 6 6 6"/>
        </symbol>

        <symbol id="rd-icon-box" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="rd-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="rd-icon-alert" viewBox="0 0 24 24">
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol id="rd-icon-priority" viewBox="0 0 24 24">
            <path d="M5 21V4"/>
            <path d="M5 5h11l-2 4 2 4H5"/>
        </symbol>

        <symbol id="rd-icon-calendar" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="16" rx="2"/>
            <path d="M16 3v4"/>
            <path d="M8 3v4"/>
            <path d="M3 10h18"/>
        </symbol>

        <symbol id="rd-icon-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="rd-icon-location" viewBox="0 0 24 24">
            <path d="M12 21s7-5 7-11a7 7 0 1 0-14 0c0 6 7 11 7 11Z"/>
            <circle cx="12" cy="10" r="2.2"/>
        </symbol>

        <symbol id="rd-icon-phone" viewBox="0 0 24 24">
            <path d="M5 4h3l2 5-2 2a15 15 0 0 0 5 5l2-2 5 2v3a2 2 0 0 1-2 2A15 15 0 0 1 3 6a2 2 0 0 1 2-2Z"/>
        </symbol>

        <symbol id="rd-icon-mail" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <path d="m4 7 8 6 8-6"/>
        </symbol>

        <symbol id="rd-icon-submit" viewBox="0 0 24 24">
            <path d="m4 12 16-8-6 16-3-6Z"/>
            <path d="m11 14 4-5"/>
        </symbol>

        <symbol id="rd-icon-receive" viewBox="0 0 24 24">
            <rect x="5" y="3" width="14" height="18" rx="2"/>
            <path d="M9 8h6"/>
            <path d="M9 12h6"/>
            <path d="M9 16h4"/>
        </symbol>

        <symbol id="rd-icon-review" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"/>
            <path d="m20 20-4-4"/>
        </symbol>

        <symbol id="rd-icon-note" viewBox="0 0 24 24">
            <rect x="5" y="3" width="14" height="18" rx="2"/>
            <path d="M9 8h6"/>
            <path d="M9 12h6"/>
            <path d="M9 16h4"/>
        </symbol>

        <symbol id="rd-icon-x" viewBox="0 0 24 24">
            <path d="m6 6 12 12"/>
            <path d="m18 6-12 12"/>
        </symbol>

        <symbol id="rd-icon-tools" viewBox="0 0 24 24">
            <path d="M14.7 6.3a4 4 0 0 0-5-5L7 4l3 3-6.7 6.7a2.1 2.1 0 0 0 3 3L13 10a4 4 0 0 0 5-5Z"/>
            <path d="m13 13 6 6"/>
        </symbol>

        <symbol id="rd-icon-ready" viewBox="0 0 24 24">
            <path d="M5 12.5 9.5 17 19 7.5"/>
        </symbol>

        <symbol id="rd-icon-release" viewBox="0 0 24 24">
            <path d="M4 7h12"/>
            <path d="m12 3 4 4-4 4"/>
            <path d="M20 13v2a4 4 0 0 1-4 4H6"/>
        </symbol>

        <symbol id="rd-icon-return" viewBox="0 0 24 24">
            <path d="M20 7H8"/>
            <path d="m12 3-4 4 4 4"/>
            <path d="M4 13v2a4 4 0 0 0 4 4h10"/>
        </symbol>
    </svg>


    {{-- HEADING --}}

    <header class="rd-heading">

        <div class="rd-heading-copy">

            <p class="rd-eyebrow">
                Request coordination
            </p>

            <h1>
                {{ $requestData['project'] }}
            </h1>

            <div class="rd-heading-meta">

                <strong>
                    {{ $requestData['id'] }}
                </strong>

                <span class="rd-heading-dot"></span>

                <span>
                    {{ $requestData['committee'] }}
                </span>

                <span class="rd-heading-dot"></span>

                <span
                    id="request-status-badge"
                    class="
                        rd-status
                        rd-status-resolution
                    "
                >
                    {{ $requestData['status'] }}
                </span>

            </div>

        </div>


        <a
            href="{{ route('requests.index') }}"
            class="rd-button"
        >
            <svg class="rd-icon">
                <use href="#rd-icon-back"/>
            </svg>

            Back to requests
        </a>

    </header>


    {{-- WORKFLOW --}}

    <section class="rd-workflow-card">

        <div class="rd-workflow-head">

            <div class="rd-workflow-title">
                <strong>
                    Request workflow
                </strong>

                <span>
                    Track this request from submission to completion.
                </span>
            </div>


            <span
                id="workflow-current-label"
                class="rd-workflow-current"
            >
                Current: {{ $requestData['status'] }}
            </span>

        </div>


        <div class="rd-workflow-scroll custom-scrollbar">

            <div class="rd-workflow">

                @foreach ($workflowSteps as $index => $step)

                    <div
                        class="
                            rd-workflow-step

                            @if ($index < 2)
                                is-complete
                            @endif

                            @if ($step['key'] === $requestData['status'])
                                is-current
                            @endif
                        "
                        data-workflow-step="{{ $step['key'] }}"
                    >

                        <span class="rd-workflow-node">
                            <svg class="rd-icon">
                                <use href="#rd-icon-{{ $step['icon'] }}"/>
                            </svg>
                        </span>

                        <span>
                            {{ $step['label'] }}
                        </span>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- SUMMARY --}}

    <section class="rd-summary">

        @foreach ($summary as $item)

            <article
                class="
                    rd-summary-card
                    rd-tone-{{ $item['tone'] }}
                "
            >

                <span class="rd-summary-icon">
                    <svg class="rd-icon">
                        <use href="#rd-icon-{{ $item['icon'] }}"/>
                    </svg>
                </span>


                <div class="rd-summary-copy">

                    <strong
                        @if ($item['key'] === 'available')
                            id="summary-available-value"
                        @elseif ($item['key'] === 'action')
                            id="summary-action-value"
                        @endif

                        class="
                            rd-summary-value

                            @if (!is_numeric($item['value']))
                                rd-summary-value--text
                            @endif
                        "
                    >
                        {{ $item['value'] }}
                    </strong>


                    <span class="rd-summary-label">
                        {{ $item['label'] }}
                    </span>


                    <span
                        @if ($item['key'] === 'available')
                            id="summary-available-description"
                        @elseif ($item['key'] === 'action')
                            id="summary-action-description"
                        @endif

                        class="rd-summary-description"
                    >
                        {{ $item['description'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    <div class="rd-grid">

        {{-- MAIN --}}

        <div class="rd-main">

            {{-- REQUEST INFORMATION --}}

            <section class="rd-card">

                <div class="rd-card-head">

                    <div class="rd-card-title">

                        <span class="rd-number">
                            01
                        </span>

                        <h2>
                            Request information
                        </h2>

                    </div>


                    <span class="rd-card-caption">
                        Submitted {{ $requestData['submitted'] }}
                    </span>

                </div>


                <dl class="rd-info-grid">

                    <div class="rd-info-item">

                        <span class="rd-info-icon">
                            <svg class="rd-icon">
                                <use href="#rd-icon-calendar"/>
                            </svg>
                        </span>

                        <div>
                            <dt>
                                Date needed
                            </dt>

                            <dd>
                                {{ $requestData['date_needed'] }}
                            </dd>
                        </div>

                    </div>


                    <div class="rd-info-item">

                        <span class="rd-info-icon">
                            <svg class="rd-icon">
                                <use href="#rd-icon-clock"/>
                            </svg>
                        </span>

                        <div>
                            <dt>
                                Time needed
                            </dt>

                            <dd>
                                {{ $requestData['time_needed'] }}
                            </dd>
                        </div>

                    </div>


                    <div class="rd-info-item">

                        <span class="rd-info-icon">
                            <svg class="rd-icon">
                                <use href="#rd-icon-location"/>
                            </svg>
                        </span>

                        <div>
                            <dt>
                                Venue
                            </dt>

                            <dd>
                                {{ $requestData['venue'] }}
                            </dd>
                        </div>

                    </div>


                    <div class="rd-info-item">

                        <span class="rd-info-icon">
                            <svg class="rd-icon">
                                <use href="#rd-icon-priority"/>
                            </svg>
                        </span>

                        <div>
                            <dt>
                                Priority
                            </dt>

                            <dd>
                                {{ $requestData['priority'] }}
                            </dd>
                        </div>

                    </div>

                </dl>


                <div class="rd-purpose">

                    <div class="rd-purpose-box">

                        <span class="rd-purpose-label">
                            Purpose
                        </span>

                        <p>
                            {{ $requestData['purpose'] }}
                        </p>

                    </div>

                </div>

            </section>


            {{-- RESOURCES --}}

            <section class="rd-card">

                <div class="rd-card-head">

                    <div class="rd-card-title">

                        <span class="rd-number">
                            02
                        </span>

                        <h2>
                            Requested resources
                        </h2>

                    </div>


                    <span class="rd-card-caption">
                        Availability check
                    </span>

                </div>


                <div class="rd-resource-table-wrap custom-scrollbar">

                    <table class="rd-resource-table">

                        <thead>
                            <tr>
                                <th>
                                    Resource
                                </th>

                                <th>
                                    Requested
                                </th>

                                <th>
                                    Available
                                </th>

                                <th>
                                    Availability
                                </th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($resources as $resource)

                                <tr>

                                    <td>

                                        <div class="rd-resource">

                                            <span class="rd-resource-icon">
                                                <svg class="rd-icon">
                                                    <use href="#rd-icon-box"/>
                                                </svg>
                                            </span>


                                            <div class="rd-resource-copy">

                                                <strong>
                                                    {{ $resource['name'] }}
                                                </strong>

                                                <span>
                                                    {{ $resource['asset_id'] }}
                                                    ·
                                                    {{ $resource['category'] }}
                                                </span>

                                            </div>

                                        </div>

                                    </td>


                                    <td class="rd-number-cell">
                                        {{ $resource['requested'] }}
                                    </td>


                                    <td
                                        class="rd-number-cell"

                                        @if ($resource['status'] === 'Partial')
                                            id="shortage-available-count"
                                        @endif
                                    >
                                        {{ $resource['available'] }}
                                    </td>


                                    <td>

                                        <span
                                            @if ($resource['status'] === 'Partial')
                                                id="shortage-status-badge"
                                            @endif

                                            class="
                                                rd-availability
                                                rd-tone-{{ $resource['tone'] }}
                                            "
                                        >
                                            {{ $resource['status'] }}
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                <div
                    id="resource-shortage-alert"
                    class="rd-shortage"
                >

                    <svg class="rd-icon">
                        <use href="#rd-icon-alert"/>
                    </svg>


                    <div>

                        <strong>
                            Chair availability needs resolution
                        </strong>

                        <p>
                            60 chairs were requested, but only 50 are
                            currently available. The remaining 10 must be
                            sourced, substituted, or adjusted before final
                            approval.
                        </p>

                    </div>

                </div>

            </section>


            {{-- REQUESTER NOTE --}}

            <section class="rd-note">

                <span class="rd-note-icon">
                    <svg class="rd-icon">
                        <use href="#rd-icon-note"/>
                    </svg>
                </span>


                <div>

                    <strong>
                        Requester note
                    </strong>

                    <p>
                        {{ $requestData['notes'] }}
                    </p>

                </div>

            </section>

        </div>


        {{-- SIDE --}}

        <aside class="rd-side">

            {{-- REQUESTER --}}

            <section class="rd-card">

                <div class="rd-card-head">

                    <div class="rd-card-title">

                        <span class="rd-number">
                            03
                        </span>

                        <h2>
                            Requester
                        </h2>

                    </div>

                </div>


                <div class="rd-requester">

                    <div class="rd-requester-main">

                        <span class="rd-avatar">
                            MS
                        </span>


                        <div class="rd-requester-copy">

                            <strong>
                                {{ $requestData['requester'] }}
                            </strong>

                            <span>
                                {{ $requestData['requester_role'] }}
                            </span>

                            <span>
                                {{ $requestData['committee'] }}
                            </span>

                        </div>

                    </div>


                    <div class="rd-contact">

                        <div class="rd-contact-row">

                            <svg class="rd-icon">
                                <use href="#rd-icon-phone"/>
                            </svg>

                            {{ $requestData['contact'] }}

                        </div>


                        <div class="rd-contact-row">

                            <svg class="rd-icon">
                                <use href="#rd-icon-mail"/>
                            </svg>

                            {{ $requestData['email'] }}

                        </div>

                    </div>

                </div>

            </section>


            {{-- TIMELINE --}}

            <section class="rd-card">

                <div class="rd-card-head">

                    <div class="rd-card-title">

                        <span class="rd-number">
                            04
                        </span>

                        <h2>
                            Request timeline
                        </h2>

                    </div>

                </div>


                <ol
                    id="request-timeline"
                    class="rd-timeline"
                >

                    @foreach ($timeline as $item)

                        <li class="rd-timeline-item">

                            <span
                                class="
                                    rd-timeline-marker
                                    rd-tone-{{ $item['tone'] }}
                                "
                            >
                                <svg class="rd-icon">
                                    <use href="#rd-icon-{{ $item['icon'] }}"/>
                                </svg>
                            </span>


                            <div class="rd-timeline-copy">

                                <time>
                                    {{ $item['date'] }}
                                </time>

                                <strong>
                                    {{ $item['title'] }}
                                </strong>

                                <p>
                                    {{ $item['description'] }}
                                </p>

                            </div>

                        </li>

                    @endforeach

                </ol>

            </section>


            {{-- ACTION --}}

            <section class="rd-review">

                <div class="rd-card-head">

                    <div class="rd-card-title">

                        <span class="rd-number">
                            05
                        </span>

                        <h2>
                            Request action
                        </h2>

                    </div>

                </div>


                <div class="rd-review-body">

                    <div class="rd-review-status">

                        <span
                            id="workflow-action-icon"
                            class="
                                rd-review-icon
                                rd-tone-red
                            "
                        >
                            <svg class="rd-icon">
                                <use
                                    id="workflow-action-icon-use"
                                    href="#rd-icon-alert"
                                />
                            </svg>
                        </span>


                        <div class="rd-review-copy">

                            <strong id="workflow-action-title">
                                Needs resolution
                            </strong>

                            <p id="workflow-action-description">
                                Resolve the resource shortage before this
                                request can proceed to final approval.
                            </p>

                        </div>

                    </div>


                    <div class="rd-review-note">

                        <label for="request-review-note">
                            Logistics note
                        </label>

                        <textarea
                            id="request-review-note"
                            placeholder="Record resource adjustments, preparation notes, or logistics remarks."
                        ></textarea>

                    </div>


                    <div
                        id="workflow-actions"
                        class="rd-review-actions"
                    >

                        <button
                            id="secondary-workflow-action"
                            type="button"
                            class="rd-action-danger"
                        >
                            <svg class="rd-icon">
                                <use
                                    id="secondary-action-icon"
                                    href="#rd-icon-x"
                                />
                            </svg>

                            <span id="secondary-action-label">
                                Decline request
                            </span>
                        </button>


                        <button
                            id="primary-workflow-action"
                            type="button"
                            class="rd-action-primary"
                        >
                            <svg class="rd-icon">
                                <use
                                    id="primary-action-icon"
                                    href="#rd-icon-tools"
                                />
                            </svg>

                            <span id="primary-action-label">
                                Resolve resources
                            </span>
                        </button>

                    </div>

                </div>

            </section>

        </aside>

    </div>


    {{-- MODAL --}}

    <div
        id="request-action-modal"
        class="rd-modal"
        role="dialog"
        aria-modal="true"
        aria-hidden="true"
        aria-labelledby="modal-title"
    >

        <div class="rd-modal-panel">

            <span
                id="modal-symbol"
                class="
                    rd-modal-symbol
                    rd-tone-teal
                "
            >
                <svg class="rd-icon">
                    <use
                        id="modal-icon-use"
                        href="#rd-icon-check"
                    />
                </svg>
            </span>


            <h2 id="modal-title">
                Confirm action
            </h2>


            <p id="modal-message">
                Confirm this request workflow action.
            </p>


            <div class="rd-modal-actions">

                <button
                    id="modal-cancel"
                    type="button"
                    class="rd-button"
                >
                    Cancel
                </button>


                <button
                    id="modal-confirm"
                    type="button"
                    class="rd-action-primary"
                >
                    Confirm
                </button>

            </div>

        </div>

    </div>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const page =
        document.getElementById(
            'request-detail-page'
        );


    if (
        !page ||
        page.dataset.initialized === 'true'
    ) {
        return;
    }


    page.dataset.initialized =
        'true';


    const statusBadge =
        document.getElementById(
            'request-status-badge'
        );

    const workflowCurrentLabel =
        document.getElementById(
            'workflow-current-label'
        );

    const primaryAction =
        document.getElementById(
            'primary-workflow-action'
        );

    const secondaryAction =
        document.getElementById(
            'secondary-workflow-action'
        );

    const primaryActionLabel =
        document.getElementById(
            'primary-action-label'
        );

    const primaryActionIcon =
        document.getElementById(
            'primary-action-icon'
        );

    const secondaryActionLabel =
        document.getElementById(
            'secondary-action-label'
        );

    const secondaryActionIcon =
        document.getElementById(
            'secondary-action-icon'
        );

    const actionTitle =
        document.getElementById(
            'workflow-action-title'
        );

    const actionDescription =
        document.getElementById(
            'workflow-action-description'
        );

    const actionIcon =
        document.getElementById(
            'workflow-action-icon'
        );

    const actionIconUse =
        document.getElementById(
            'workflow-action-icon-use'
        );

    const reviewNote =
        document.getElementById(
            'request-review-note'
        );

    const shortageAlert =
        document.getElementById(
            'resource-shortage-alert'
        );

    const shortageAvailableCount =
        document.getElementById(
            'shortage-available-count'
        );

    const shortageStatusBadge =
        document.getElementById(
            'shortage-status-badge'
        );

    const summaryAvailableValue =
        document.getElementById(
            'summary-available-value'
        );

    const summaryActionValue =
        document.getElementById(
            'summary-action-value'
        );

    const summaryAvailableDescription =
        document.getElementById(
            'summary-available-description'
        );

    const summaryActionDescription =
        document.getElementById(
            'summary-action-description'
        );

    const timeline =
        document.getElementById(
            'request-timeline'
        );

    const modal =
        document.getElementById(
            'request-action-modal'
        );

    const modalTitle =
        document.getElementById(
            'modal-title'
        );

    const modalMessage =
        document.getElementById(
            'modal-message'
        );

    const modalIconUse =
        document.getElementById(
            'modal-icon-use'
        );

    const modalSymbol =
        document.getElementById(
            'modal-symbol'
        );

    const modalCancel =
        document.getElementById(
            'modal-cancel'
        );

    const modalConfirm =
        document.getElementById(
            'modal-confirm'
        );


    if (
        !statusBadge ||
        !workflowCurrentLabel ||
        !primaryAction ||
        !secondaryAction ||
        !primaryActionLabel ||
        !primaryActionIcon ||
        !secondaryActionLabel ||
        !secondaryActionIcon ||
        !actionTitle ||
        !actionDescription ||
        !actionIcon ||
        !actionIconUse ||
        !reviewNote ||
        !timeline ||
        !modal ||
        !modalTitle ||
        !modalMessage ||
        !modalIconUse ||
        !modalSymbol ||
        !modalCancel ||
        !modalConfirm
    ) {
        return;
    }


    const workflowOrder = [
        'Submitted',
        'Under Review',
        'Needs Resolution',
        'Approved',
        'Preparing',
        'Ready for Release',
        'Released / Deployed',
        'For Return',
        'Completed'
    ];


    const statusClasses = [
        'rd-status-pending',
        'rd-status-review',
        'rd-status-resolution',
        'rd-status-approved',
        'rd-status-preparing',
        'rd-status-ready',
        'rd-status-released',
        'rd-status-return',
        'rd-status-completed',
        'rd-status-declined'
    ];


    const toneClasses = [
        'rd-tone-navy',
        'rd-tone-teal',
        'rd-tone-pink',
        'rd-tone-blue',
        'rd-tone-red',
        'rd-tone-amber',
        'rd-tone-green'
    ];


    const statusConfig = {
        'Submitted': {
            statusClass: 'rd-status-pending',
            tone: 'rd-tone-navy',
            title: 'Request submitted',
            description:
                'The request is waiting to enter logistics review.',
            icon: '#rd-icon-submit',
            primaryLabel: 'Start review',
            primaryIcon: '#rd-icon-review',
            primaryAction: 'review',
            secondaryLabel: 'Decline request',
            secondaryIcon: '#rd-icon-x',
            secondaryAction: 'decline'
        },

        'Under Review': {
            statusClass: 'rd-status-review',
            tone: 'rd-tone-pink',
            title: 'Under review',
            description:
                'Review the request details and confirm that all requested resources can be supported.',
            icon: '#rd-icon-review',
            primaryLabel: 'Approve request',
            primaryIcon: '#rd-icon-check',
            primaryAction: 'approve',
            secondaryLabel: 'Decline request',
            secondaryIcon: '#rd-icon-x',
            secondaryAction: 'decline'
        },

        'Needs Resolution': {
            statusClass: 'rd-status-resolution',
            tone: 'rd-tone-red',
            title: 'Needs resolution',
            description:
                'Resolve the resource shortage before this request can proceed to final approval.',
            icon: '#rd-icon-alert',
            primaryLabel: 'Resolve resources',
            primaryIcon: '#rd-icon-tools',
            primaryAction: 'resolve',
            secondaryLabel: 'Decline request',
            secondaryIcon: '#rd-icon-x',
            secondaryAction: 'decline'
        },

        'Approved': {
            statusClass: 'rd-status-approved',
            tone: 'rd-tone-teal',
            title: 'Request approved',
            description:
                'The request is authorized. Logistics can now begin preparing the approved resources.',
            icon: '#rd-icon-check',
            primaryLabel: 'Start preparation',
            primaryIcon: '#rd-icon-tools',
            primaryAction: 'prepare',
            secondaryLabel: 'Back to requests',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: 'back'
        },

        'Preparing': {
            statusClass: 'rd-status-preparing',
            tone: 'rd-tone-blue',
            title: 'Resources are being prepared',
            description:
                'Gather, inspect, count, and organize the approved resources before release.',
            icon: '#rd-icon-tools',
            primaryLabel: 'Mark as ready',
            primaryIcon: '#rd-icon-ready',
            primaryAction: 'ready',
            secondaryLabel: 'Back to requests',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: 'back'
        },

        'Ready for Release': {
            statusClass: 'rd-status-ready',
            tone: 'rd-tone-green',
            title: 'Resources ready for release',
            description:
                'Preparation is complete. Confirm release when the resources leave logistics custody.',
            icon: '#rd-icon-ready',
            primaryLabel: 'Release resources',
            primaryIcon: '#rd-icon-release',
            primaryAction: 'release',
            secondaryLabel: 'Back to requests',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: 'back'
        },

        'Released / Deployed': {
            statusClass: 'rd-status-released',
            tone: 'rd-tone-navy',
            title: 'Resources deployed',
            description:
                'The approved resources are currently assigned to the project or activity.',
            icon: '#rd-icon-release',
            primaryLabel: 'Mark for return',
            primaryIcon: '#rd-icon-return',
            primaryAction: 'return',
            secondaryLabel: 'Back to requests',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: 'back'
        },

        'For Return': {
            statusClass: 'rd-status-return',
            tone: 'rd-tone-amber',
            title: 'Awaiting return',
            description:
                'Receive reusable resources and confirm their condition before closing the request.',
            icon: '#rd-icon-return',
            primaryLabel: 'Confirm return',
            primaryIcon: '#rd-icon-check',
            primaryAction: 'complete',
            secondaryLabel: 'Back to requests',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: 'back'
        },

        'Completed': {
            statusClass: 'rd-status-completed',
            tone: 'rd-tone-green',
            title: 'Request completed',
            description:
                'All logistics activities are complete and reusable resources have been accounted for.',
            icon: '#rd-icon-check',
            primaryLabel: 'Back to requests',
            primaryIcon: '#rd-icon-back',
            primaryAction: 'back',
            secondaryLabel: '',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: null
        },

        'Declined': {
            statusClass: 'rd-status-declined',
            tone: 'rd-tone-red',
            title: 'Request declined',
            description:
                'This request was declined and no further logistics preparation will continue.',
            icon: '#rd-icon-x',
            primaryLabel: 'Back to requests',
            primaryIcon: '#rd-icon-back',
            primaryAction: 'back',
            secondaryLabel: '',
            secondaryIcon: '#rd-icon-back',
            secondaryAction: null
        }
    };


    let currentStatus =
        page.dataset.requestStatus ||
        'Needs Resolution';


    let pendingAction =
        null;


    let lastFocusedElement =
        null;


    let previousBodyOverflow =
        '';


    const updateWorkflow = () => {
        const config =
            statusConfig[
                currentStatus
            ];


        if (!config) {
            return;
        }


        page.dataset.requestStatus =
            currentStatus;


        statusBadge.textContent =
            currentStatus;


        statusBadge.classList.remove(
            ...statusClasses
        );


        statusBadge.classList.add(
            config.statusClass
        );


        workflowCurrentLabel.textContent =
            `Current: ${currentStatus}`;


        actionTitle.textContent =
            config.title;


        actionDescription.textContent =
            config.description;


        actionIconUse.setAttribute(
            'href',
            config.icon
        );


        actionIcon.classList.remove(
            ...toneClasses
        );


        actionIcon.classList.add(
            config.tone
        );


        primaryActionLabel.textContent =
            config.primaryLabel;


        primaryActionIcon.setAttribute(
            'href',
            config.primaryIcon
        );


        primaryAction.dataset.action =
            config.primaryAction;


        secondaryActionLabel.textContent =
            config.secondaryLabel ||
            '';


        secondaryActionIcon.setAttribute(
            'href',
            config.secondaryIcon
        );


        secondaryAction.dataset.action =
            config.secondaryAction ||
            '';


        secondaryAction.hidden =
            !config.secondaryAction;


        primaryAction.classList.toggle(
            'rd-full-action',
            !config.secondaryAction
        );


        const currentIndex =
            workflowOrder.indexOf(
                currentStatus
            );


        document
            .querySelectorAll(
                '[data-workflow-step]'
            )
            .forEach(
                (step) => {
                    const status =
                        step.dataset.workflowStep;


                    const index =
                        workflowOrder.indexOf(
                            status
                        );


                    step.classList.remove(
                        'is-complete',
                        'is-current'
                    );


                    if (
                        currentStatus ===
                        'Declined'
                    ) {
                        if (
                            index >= 0 &&
                            index <= 1
                        ) {
                            step.classList.add(
                                'is-complete'
                            );
                        }

                        return;
                    }


                    if (
                        index >= 0 &&
                        index <
                        currentIndex
                    ) {
                        step.classList.add(
                            'is-complete'
                        );
                    }


                    if (
                        status ===
                        currentStatus
                    ) {
                        step.classList.add(
                            'is-current'
                        );
                    }


                    if (
                        currentStatus ===
                        'Completed' &&
                        index <
                        workflowOrder.length - 1
                    ) {
                        step.classList.add(
                            'is-complete'
                        );
                    }
                }
            );
    };


    const addTimelineEntry = (
        title,
        description,
        tone = 'teal',
        icon = 'check'
    ) => {
        const item =
            document.createElement(
                'li'
            );


        item.className =
            'rd-timeline-item';


        const now =
            new Date();


        const time =
            now.toLocaleTimeString(
                [],
                {
                    hour: 'numeric',
                    minute: '2-digit'
                }
            );


        const safeTitle =
            String(
                title
            );


        const safeDescription =
            String(
                description
            );


        item.innerHTML = `
            <span
                class="
                    rd-timeline-marker
                    rd-tone-${tone}
                "
            >
                <svg class="rd-icon">
                    <use href="#rd-icon-${icon}"></use>
                </svg>
            </span>

            <div class="rd-timeline-copy">
                <time>
                    Preview · ${time}
                </time>

                <strong></strong>

                <p></p>
            </div>
        `;


        item.querySelector(
            'strong'
        ).textContent =
            safeTitle;


        item.querySelector(
            'p'
        ).textContent =
            safeDescription;


        timeline.appendChild(
            item
        );
    };


    const openModal = (
        action,
        title,
        message,
        icon,
        tone
    ) => {
        pendingAction =
            action;


        lastFocusedElement =
            document.activeElement;


        modalTitle.textContent =
            title;


        modalMessage.textContent =
            message;


        modalIconUse.setAttribute(
            'href',
            icon
        );


        modalSymbol.classList.remove(
            ...toneClasses
        );


        modalSymbol.classList.add(
            tone
        );


        modal.classList.add(
            'is-open'
        );


        modal.setAttribute(
            'aria-hidden',
            'false'
        );


        previousBodyOverflow =
            document.body.style.overflow;


        document.body.style.overflow =
            'hidden';


        modalCancel.focus();
    };


    const closeModal = () => {
        modal.classList.remove(
            'is-open'
        );


        modal.setAttribute(
            'aria-hidden',
            'true'
        );


        document.body.style.overflow =
            previousBodyOverflow;


        pendingAction =
            null;


        if (
            lastFocusedElement instanceof
            HTMLElement
        ) {
            lastFocusedElement.focus();
        }
    };


    const getModalData = (
        action
    ) => {
        const actions = {
            review: {
                title:
                    'Start reviewing this request?',
                message:
                    'The request will move into the logistics review stage.',
                icon:
                    '#rd-icon-review',
                tone:
                    'rd-tone-pink'
            },

            resolve: {
                title:
                    'Mark resource shortage as resolved?',
                message:
                    'For this front-end preview, the missing 10 chairs will be treated as sourced and all requested resources will become available.',
                icon:
                    '#rd-icon-tools',
                tone:
                    'rd-tone-red'
            },

            approve: {
                title:
                    'Approve this request?',
                message:
                    'Approval authorizes the Logistics Team to begin preparing the requested resources.',
                icon:
                    '#rd-icon-check',
                tone:
                    'rd-tone-teal'
            },

            prepare: {
                title:
                    'Start resource preparation?',
                message:
                    'The request will move to Preparing while logistics gathers, checks, and organizes the resources.',
                icon:
                    '#rd-icon-tools',
                tone:
                    'rd-tone-blue'
            },

            ready: {
                title:
                    'Mark resources as ready?',
                message:
                    'Use this once all approved items are prepared, inspected, and ready for release.',
                icon:
                    '#rd-icon-ready',
                tone:
                    'rd-tone-green'
            },

            release: {
                title:
                    'Release these resources?',
                message:
                    'This records that the resources have left logistics custody and are now deployed to the project.',
                icon:
                    '#rd-icon-release',
                tone:
                    'rd-tone-navy'
            },

            return: {
                title:
                    'Move request to For Return?',
                message:
                    'Use this when the activity has ended and reusable resources should now be returned.',
                icon:
                    '#rd-icon-return',
                tone:
                    'rd-tone-amber'
            },

            complete: {
                title:
                    'Confirm resource return?',
                message:
                    'Confirm that reusable resources were returned and accounted for. The request will then be completed.',
                icon:
                    '#rd-icon-check',
                tone:
                    'rd-tone-green'
            }
        };


        return actions[
            action
        ] ||
        null;
    };


    primaryAction.addEventListener(
        'click',
        () => {
            const action =
                primaryAction.dataset.action;


            if (
                action ===
                'back'
            ) {
                window.location.href =
                    @json(route('requests.index'));

                return;
            }


            const data =
                getModalData(
                    action
                );


            if (!data) {
                return;
            }


            openModal(
                action,
                data.title,
                data.message,
                data.icon,
                data.tone
            );
        }
    );


    secondaryAction.addEventListener(
        'click',
        () => {
            const action =
                secondaryAction.dataset.action;


            if (
                action ===
                'back'
            ) {
                window.location.href =
                    @json(route('requests.index'));

                return;
            }


            if (
                action ===
                'decline'
            ) {
                openModal(
                    'decline',
                    'Decline this request?',
                    'Declining will stop this request from progressing to resource preparation.',
                    '#rd-icon-x',
                    'rd-tone-red'
                );
            }
        }
    );


    modalConfirm.addEventListener(
        'click',
        () => {
            if (
                !pendingAction
            ) {
                return;
            }


            const note =
                reviewNote.value.trim();


            switch (
                pendingAction
            ) {
                case 'review':
                    currentStatus =
                        'Under Review';


                    addTimelineEntry(
                        'Review started',
                        note ||
                        'Logistics started reviewing the request and resource requirements.',
                        'pink',
                        'review'
                    );

                    break;


                case 'resolve':
                    shortageAlert?.classList.add(
                        'is-resolved'
                    );


                    if (
                        shortageAvailableCount
                    ) {
                        shortageAvailableCount.textContent =
                            '60';
                    }


                    if (
                        shortageStatusBadge
                    ) {
                        shortageStatusBadge.textContent =
                            'Available';


                        shortageStatusBadge.classList.remove(
                            'rd-tone-amber'
                        );


                        shortageStatusBadge.classList.add(
                            'rd-tone-teal'
                        );
                    }


                    if (
                        summaryAvailableValue
                    ) {
                        summaryAvailableValue.textContent =
                            '3';
                    }


                    if (
                        summaryActionValue
                    ) {
                        summaryActionValue.textContent =
                            '0';
                    }


                    if (
                        summaryAvailableDescription
                    ) {
                        summaryAvailableDescription.textContent =
                            'All resource types';
                    }


                    if (
                        summaryActionDescription
                    ) {
                        summaryActionDescription.textContent =
                            'No availability issues';
                    }


                    currentStatus =
                        'Under Review';


                    addTimelineEntry(
                        'Resource shortage resolved',
                        note ||
                        'Additional chairs were sourced or the quantity was adjusted. All requested resources are now available.',
                        'teal',
                        'check'
                    );

                    break;


                case 'approve':
                    currentStatus =
                        'Approved';


                    addTimelineEntry(
                        'Request approved',
                        note ||
                        'Logistics approved the request for resource preparation.',
                        'teal',
                        'check'
                    );

                    break;


                case 'prepare':
                    currentStatus =
                        'Preparing';


                    addTimelineEntry(
                        'Preparation started',
                        note ||
                        'Logistics began gathering and checking the approved resources.',
                        'blue',
                        'tools'
                    );

                    break;


                case 'ready':
                    currentStatus =
                        'Ready for Release';


                    addTimelineEntry(
                        'Resources ready',
                        note ||
                        'All approved resources were prepared and are ready for release.',
                        'green',
                        'ready'
                    );

                    break;


                case 'release':
                    currentStatus =
                        'Released / Deployed';


                    addTimelineEntry(
                        'Resources released',
                        note ||
                        'Resources were released for use in the project.',
                        'navy',
                        'release'
                    );

                    break;


                case 'return':
                    currentStatus =
                        'For Return';


                    addTimelineEntry(
                        'Return requested',
                        note ||
                        'The activity has ended and reusable resources are expected back at logistics.',
                        'amber',
                        'return'
                    );

                    break;


                case 'complete':
                    currentStatus =
                        'Completed';


                    addTimelineEntry(
                        'Request completed',
                        note ||
                        'Reusable resources were returned and the logistics request was closed.',
                        'green',
                        'check'
                    );

                    break;


                case 'decline':
                    currentStatus =
                        'Declined';


                    addTimelineEntry(
                        'Request declined',
                        note ||
                        'The logistics request was declined during review.',
                        'red',
                        'x'
                    );

                    break;
            }


            reviewNote.value =
                '';


            closeModal();

            updateWorkflow();
        }
    );


    modalCancel.addEventListener(
        'click',
        closeModal
    );


    modal.addEventListener(
        'click',
        (event) => {
            if (
                event.target ===
                modal
            ) {
                closeModal();
            }
        }
    );


    document.addEventListener(
        'keydown',
        (event) => {
            if (
                event.key ===
                    'Escape' &&
                modal.classList.contains(
                    'is-open'
                )
            ) {
                closeModal();
            }
        }
    );


    updateWorkflow();
})();
</script>
@endpush