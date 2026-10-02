@extends('layouts.app')

@section('title', 'Logistics Requests | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | SAMPLE REQUESTS
    |--------------------------------------------------------------------------
    */

    $requests = [
        [
            'id' => 'REQ-2026-0047',
            'project' => 'Youth Leadership Summit',
            'committee' => 'Events Committee',
            'requester' => 'Maria Santos',
            'date_needed' => 'Sep 12, 2026',
            'items' => 3,
            'status' => 'Needs Resolution',
            'priority' => 'High',
            'updated' => 'Sep 10, 2026',
        ],
        [
            'id' => 'REQ-2026-0046',
            'project' => 'Medical Mission',
            'committee' => 'Community Outreach',
            'requester' => 'Joshua Reyes',
            'date_needed' => 'Sep 15, 2026',
            'items' => 5,
            'status' => 'Approved',
            'priority' => 'High',
            'updated' => 'Sep 10, 2026',
        ],
        [
            'id' => 'REQ-2026-0045',
            'project' => 'Coastal Clean-Up Drive',
            'committee' => 'Environment & Health',
            'requester' => 'Angela Cruz',
            'date_needed' => 'Sep 18, 2026',
            'items' => 4,
            'status' => 'Preparing',
            'priority' => 'Medium',
            'updated' => 'Sep 09, 2026',
        ],
        [
            'id' => 'REQ-2026-0044',
            'project' => 'School Supply Distribution',
            'committee' => 'Education Committee',
            'requester' => 'Carlo Mendoza',
            'date_needed' => 'Sep 21, 2026',
            'items' => 6,
            'status' => 'Approved',
            'priority' => 'Medium',
            'updated' => 'Sep 09, 2026',
        ],
        [
            'id' => 'REQ-2026-0043',
            'project' => 'Youth Sports Festival',
            'committee' => 'Sports Committee',
            'requester' => 'Ramon Garcia',
            'date_needed' => 'Sep 22, 2026',
            'items' => 4,
            'status' => 'Pending',
            'priority' => 'Low',
            'updated' => 'Sep 08, 2026',
        ],
        [
            'id' => 'REQ-2026-0042',
            'project' => 'Community Feeding Program',
            'committee' => 'Community Outreach',
            'requester' => 'Liza Torres',
            'date_needed' => 'Sep 25, 2026',
            'items' => 7,
            'status' => 'Preparing',
            'priority' => 'High',
            'updated' => 'Sep 08, 2026',
        ],
        [
            'id' => 'REQ-2026-0041',
            'project' => 'PULSO Volunteer Orientation',
            'committee' => 'Volunteer Management',
            'requester' => 'Nicole Ramos',
            'date_needed' => 'Sep 28, 2026',
            'items' => 3,
            'status' => 'Completed',
            'priority' => 'Low',
            'updated' => 'Sep 07, 2026',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    $summary = [
        [
            'label' => 'Total requests',
            'value' => count($requests),
            'description' => 'All sample requests',
            'tone' => 'navy',
            'icon' => 'requests',
        ],
        [
            'label' => 'Needs resolution',
            'value' => collect($requests)->where('status', 'Needs Resolution')->count(),
            'description' => 'Resource issue to resolve',
            'tone' => 'red',
            'icon' => 'alert',
        ],
        [
            'label' => 'Approved',
            'value' => collect($requests)->where('status', 'Approved')->count(),
            'description' => 'Ready to prepare',
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'label' => 'Preparing',
            'value' => collect($requests)->where('status', 'Preparing')->count(),
            'description' => 'Resources being arranged',
            'tone' => 'blue',
            'icon' => 'prepare',
        ],
        [
            'label' => 'Completed',
            'value' => collect($requests)->where('status', 'Completed')->count(),
            'description' => 'Finished requests',
            'tone' => 'green',
            'icon' => 'complete',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | STATUS TONES
    |--------------------------------------------------------------------------
    */

    $statusTones = [
        'Pending' => 'pending',
        'Under Review' => 'review',
        'Needs Resolution' => 'resolution',
        'Approved' => 'approved',
        'Preparing' => 'preparing',
        'Completed' => 'completed',
        'Declined' => 'declined',
    ];


    /*
    |--------------------------------------------------------------------------
    | PRIORITY TONES
    |--------------------------------------------------------------------------
    */

    $priorityTones = [
        'High' => 'red',
        'Medium' => 'amber',
        'Low' => 'muted',
    ];


    /*
    |--------------------------------------------------------------------------
    | FILTER OPTIONS
    |--------------------------------------------------------------------------
    */

    $statuses = [
        'Pending',
        'Under Review',
        'Needs Resolution',
        'Approved',
        'Preparing',
        'Completed',
    ];


    $priorities = [
        'High',
        'Medium',
        'Low',
    ];
@endphp


@push('styles')
<style>
    .requests-page {
        --rq-navy: #10263d;
        --rq-copy: #496580;
        --rq-muted: #71899c;
        --rq-line: #d5e5ee;

        --rq-teal: #007780;
        --rq-pink: #b90c61;
        --rq-blue: #365f8d;

        display: grid;
        gap: 24px;

        width: 100%;
        min-width: 0;

        color: var(--rq-navy);
    }

    .requests-page *,
    .requests-page *::before,
    .requests-page *::after {
        box-sizing: border-box;
    }

    .rq-icon {
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

    .rq-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .rq-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 26px;

        min-width: 0;
    }

    .rq-heading-copy {
        min-width: 0;
    }

    .rq-eyebrow {
        margin: 0 0 7px;

        color: var(--rq-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .rq-heading h1 {
        margin: 0;

        color: var(--rq-navy);

        font-size: clamp(30px, 3vw, 42px);
        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.055em;
    }

    .rq-heading-description {
        max-width: 680px;

        margin: 10px 0 0;

        color: var(--rq-copy);

        font-size: 14px;
        line-height: 1.7;
    }

    .rq-heading-side {
        display: flex;
        flex-direction: column;
        align-items: flex-end;

        gap: 10px;

        flex-shrink: 0;
    }

    .rq-new-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 44px;

        padding: 10px 16px;

        border: 1px solid #64cbd1;
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #00858f,
                #00727c
            );

        color: #ffffff;

        box-shadow:
            4px 5px 12px rgba(0, 126, 137, .19),
            -3px -3px 8px rgba(255, 255, 255, .55),
            inset 1px 1px 3px rgba(126, 235, 240, .5);

        font-size: 12px;
        font-weight: 750;
        line-height: 1.4;

        text-decoration: none;

        transition:
            background 160ms ease,
            box-shadow 160ms ease,
            transform 160ms ease;
    }

    .rq-new-button:hover {
        background:
            linear-gradient(
                145deg,
                #007b84,
                #006771
            );

        color: #ffffff;

        transform: translateY(-1px);
    }

    .rq-new-button:active {
        transform: translateY(0);
    }

    .rq-new-button:focus-visible {
        outline: 3px solid rgba(238, 18, 128, .32);
        outline-offset: 4px;
    }

    .rq-new-button .rq-icon {
        width: 17px;
        height: 17px;
    }

    .rq-heading-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-end;

        gap: 5px;
    }

    .rq-heading-meta strong {
        color: #29475f;

        font-size: 11.5px;
        font-weight: 750;
    }

    .rq-heading-meta span {
        color: var(--rq-muted);

        font-size: 10.5px;
    }


    /* ================================================================
       OVERVIEW
       ================================================================ */

    .rq-overview {
        display: grid;
        gap: 13px;
    }

    .rq-overview-caption {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        padding: 0 2px;
    }

    .rq-overview-title {
        display: flex;
        align-items: center;

        gap: 8px;

        color: #29475f;

        font-size: 12px;
        font-weight: 750;
    }

    .rq-overview-title::before {
        width: 7px;
        height: 7px;

        border-radius: 50%;

        background: #05adb6;

        box-shadow:
            0
            0
            0
            4px
            rgba(5, 173, 182, .09);

        content: "";
    }

    .rq-overview-caption > span {
        color: var(--rq-muted);

        font-size: 10.5px;
    }


    /* ================================================================
       SUMMARY
       ================================================================ */

    .rq-summary-grid {
        display: grid;

        grid-template-columns:
            repeat(
                5,
                minmax(0, 1fr)
            );

        gap: 14px;
    }

    .rq-summary-card {
        --rq-tone: #173b59;
        --rq-tone-fill: #e6eef5;

        position: relative;

        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;
        min-height: 108px;

        padding: 16px 15px;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .96),
                rgba(230, 242, 248, .95)
            );

        box-shadow:
            6px 7px 15px rgba(101, 138, 163, .14),
            -5px -5px 12px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .92);

        transition:
            transform 160ms ease,
            box-shadow 160ms ease;
    }

    .rq-summary-card::after {
        position: absolute;

        top: 0;
        right: 15px;

        width: 34px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--rq-tone);

        opacity: .5;

        content: "";
    }

    .rq-summary-card:hover {
        transform: translateY(-2px);

        box-shadow:
            8px 10px 20px rgba(91, 128, 150, .17),
            -6px -6px 14px rgba(255, 255, 255, .86),
            inset 1px 1px 2px rgba(255, 255, 255, .94);
    }

    .rq-summary-icon {
        display: grid;
        place-items: center;

        width: 42px;
        height: 42px;

        flex: 0 0 42px;

        border: 1px solid rgba(255, 255, 255, .94);
        border-radius: 14px;

        background: var(--rq-tone-fill);

        color: var(--rq-tone);

        box-shadow:
            3px 4px 9px rgba(83, 117, 139, .11),
            -3px -3px 7px rgba(255, 255, 255, .76),
            inset 1px 1px 2px rgba(255, 255, 255, .86);
    }

    .rq-summary-icon .rq-icon {
        width: 18px;
        height: 18px;
    }

    .rq-summary-copy {
        min-width: 0;
    }

    .rq-summary-value {
        display: block;

        color: var(--rq-tone);

        font-size: 26px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.045em;

        font-variant-numeric: tabular-nums;
    }

    .rq-summary-label {
        display: block;

        margin-top: 6px;

        color: #29475f;

        font-size: 11.5px;
        font-weight: 750;
        line-height: 1.35;
    }

    .rq-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #70889a;

        font-size: 9.5px;
        line-height: 1.4;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       TONES
       ================================================================ */

    .rq-tone-navy {
        --rq-tone: #173b59;
        --rq-tone-fill: #e4eef7;
    }

    .rq-tone-teal {
        --rq-tone: #007780;
        --rq-tone-fill: #d6f3f4;
    }

    .rq-tone-pink {
        --rq-tone: #b90c61;
        --rq-tone-fill: #f9deec;
    }

    .rq-tone-blue {
        --rq-tone: #365f8d;
        --rq-tone-fill: #e0eaf5;
    }

    .rq-tone-green {
        --rq-tone: #2b735d;
        --rq-tone-fill: #dcefe8;
    }

    .rq-tone-amber {
        --rq-tone: #895408;
        --rq-tone-fill: #fff0d7;
    }

    .rq-tone-red {
        --rq-tone: #ad343d;
        --rq-tone-fill: #fde5e8;
    }

    .rq-tone-muted {
        --rq-tone: #60798d;
        --rq-tone-fill: #e6eef3;
    }


    /* ================================================================
       REGISTER
       ================================================================ */

    .rq-register {
        min-width: 0;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 23px;

        background:
            linear-gradient(
                145deg,
                rgba(248, 253, 255, .96),
                rgba(230, 242, 248, .95)
            );

        box-shadow:
            8px 10px 22px rgba(91, 128, 150, .16),
            -6px -6px 16px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .rq-register-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        padding: 21px 24px 18px;

        border-bottom: 1px solid rgba(207, 226, 236, .82);
    }

    .rq-register-title {
        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;
    }

    .rq-register-icon {
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

        color: var(--rq-teal);

        box-shadow:
            4px 5px 10px rgba(70, 115, 136, .11),
            -3px -3px 7px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }

    .rq-register-heading h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 780;
        line-height: 1.4;

        letter-spacing: -.025em;
    }

    .rq-register-heading p {
        margin: 4px 0 0;

        color: var(--rq-copy);

        font-size: 11.5px;
        line-height: 1.5;
    }

    .rq-register-heading p strong {
        color: var(--rq-teal);

        font-weight: 800;
    }

    .rq-register-note {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        flex-shrink: 0;

        padding: 7px 10px;

        border: 1px solid rgba(255, 255, 255, .88);
        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #e4f5f7,
                #d7edef
            );

        color: var(--rq-teal);

        box-shadow:
            inset 1px 1px 2px rgba(255, 255, 255, .7);

        font-size: 9.5px;
        font-weight: 700;
    }

    .rq-register-note .rq-icon {
        width: 14px;
        height: 14px;
    }


    /* ================================================================
       FILTERS
       ================================================================ */

    .rq-filters {
        display: grid;

        grid-template-columns:
            minmax(260px, 1.8fr)
            repeat(
                2,
                minmax(145px, .7fr)
            )
            auto;

        align-items: end;

        gap: 13px;

        padding: 19px 24px 21px;

        background:
            linear-gradient(
                180deg,
                rgba(233, 243, 248, .46),
                rgba(241, 248, 251, .18)
            );
    }

    .rq-field {
        min-width: 0;
    }

    .rq-field label {
        display: block;

        margin-bottom: 7px;

        color: #3c5a71;

        font-size: 11px;
        font-weight: 750;
        line-height: 1.4;
    }

    .rq-search {
        position: relative;
    }

    .rq-search > .rq-icon {
        position: absolute;

        top: 50%;
        left: 14px;

        width: 18px;
        height: 18px;

        color: #678398;

        pointer-events: none;

        transform: translateY(-50%);
    }

    .rq-input {
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

        color: var(--rq-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .15),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 12px;
        line-height: 1.4;

        transition:
            border-color 160ms ease,
            background 160ms ease,
            box-shadow 160ms ease;
    }

    .rq-search .rq-input {
        padding-left: 41px;
    }

    select.rq-input {
        cursor: pointer;
    }

    .rq-input::placeholder {
        color: #7b91a2;
    }

    .rq-input:focus {
        border-color: rgba(0, 126, 137, .48);

        background: #edf6fa;

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .09);
    }

    .rq-clear {
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
            4px 5px 10px rgba(80, 115, 137, .11),
            -3px -3px 8px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 11.5px;
        font-weight: 700;

        white-space: nowrap;

        cursor: pointer;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }

    .rq-clear:hover {
        color: var(--rq-teal);

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #dcecf2
            );

        transform: translateY(-1px);
    }

    .rq-clear .rq-icon {
        width: 16px;
        height: 16px;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .rq-table-scroll {
        width: 100%;

        overflow-x: auto;

        border-top: 1px solid var(--rq-line);
        border-bottom: 1px solid var(--rq-line);

        background: rgba(240, 248, 251, .36);
    }

    .rq-table {
        width: 100%;
        min-width: 1120px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }

    .rq-table th {
        padding: 13px 14px;

        border-bottom: 1px solid #cfdee7;

        background: rgba(225, 240, 247, .78);

        color: #516d82;

        font-size: 10px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .045em;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .rq-table td {
        padding: 14px;

        border-bottom: 1px solid rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 11.5px;
        line-height: 1.5;

        vertical-align: middle;
    }

    .rq-table th:first-child,
    .rq-table td:first-child {
        padding-left: 24px;
    }

    .rq-table th:last-child,
    .rq-table td:last-child {
        padding-right: 24px;
    }

    .rq-table tbody tr {
        transition: background 150ms ease;
    }

    .rq-table tbody tr:hover {
        background: rgba(255, 255, 255, .46);
    }

    .rq-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .rq-request {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 235px;
    }

    .rq-request-icon {
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
                #e5f9fa,
                #d0edef
            );

        color: var(--rq-teal);

        box-shadow:
            3px 4px 8px rgba(76, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .78);
    }

    .rq-request-icon .rq-icon {
        width: 17px;
        height: 17px;
    }

    .rq-request-copy {
        min-width: 0;
    }

    .rq-request-id {
        display: block;

        color: #70879a;

        font-size: 9.5px;
        font-weight: 650;
        line-height: 1.4;

        letter-spacing: .025em;
    }

    .rq-request-name {
        display: block;

        margin-top: 3px;

        max-width: 230px;

        overflow: hidden;

        color: #18344c;

        font-size: 11.8px;
        font-weight: 750;
        line-height: 1.45;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .rq-secondary {
        display: block;

        margin-top: 2px;

        color: #71899c;

        font-size: 9.8px;
        line-height: 1.4;
    }

    .rq-date {
        white-space: nowrap;
    }

    .rq-date strong {
        display: block;

        color: #29475f;

        font-size: 11px;
        font-weight: 700;
    }

    .rq-date span {
        display: block;

        margin-top: 2px;

        color: #71899c;

        font-size: 9.5px;
    }

    .rq-items {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        color: #49677d;

        font-size: 10.5px;
        font-weight: 650;

        white-space: nowrap;
    }

    .rq-items .rq-icon {
        width: 14px;
        height: 14px;

        color: var(--rq-teal);
    }


    /* ================================================================
       PRIORITY
       ================================================================ */

    .rq-priority {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        color: var(--rq-tone);

        font-size: 10.5px;
        font-weight: 700;

        white-space: nowrap;
    }

    .rq-priority::before {
        width: 6px;
        height: 6px;

        flex: 0 0 6px;

        border-radius: 50%;

        background: var(--rq-tone);

        content: "";
    }


    /* ================================================================
       STATUS
       ================================================================ */

    .rq-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 28px;

        padding: 5px 10px;

        border: 1px solid transparent;
        border-radius: 9px;

        font-size: 9.8px;
        font-weight: 800;
        line-height: 1.4;

        white-space: nowrap;

        box-shadow:
            inset 1px 1px 2px rgba(255, 255, 255, .7);
    }

    .rq-status-pending {
        border-color: #efd39a;

        background:
            linear-gradient(
                145deg,
                #fff4d8,
                #f7e1ae
            );

        color: #885704;
    }

    .rq-status-review {
        border-color: #eeb6cf;

        background:
            linear-gradient(
                145deg,
                #fde7f1,
                #f3cddd
            );

        color: #a20c54;
    }

    .rq-status-resolution {
        border-color: #efbec3;

        background:
            linear-gradient(
                145deg,
                #fde8eb,
                #f3d0d5
            );

        color: #a42f3b;
    }

    .rq-status-approved {
        border-color: #a7dfe0;

        background:
            linear-gradient(
                145deg,
                #ddf5f5,
                #c4e8e9
            );

        color: #006c73;
    }

    .rq-status-preparing {
        border-color: #bfd3e7;

        background:
            linear-gradient(
                145deg,
                #e9f1fa,
                #d1e1f0
            );

        color: #315b88;
    }

    .rq-status-completed {
        border-color: #b4dccb;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;
    }

    .rq-status-declined {
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
       ACTION
       ================================================================ */

    .rq-action-heading,
    .rq-action-cell {
        min-width: 90px;

        text-align: center;
    }

    .rq-action-group {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rq-action-button {
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

        color: var(--rq-teal);

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76),
            inset 1px 1px 2px rgba(255, 255, 255, .88);

        text-decoration: none;

        transition:
            background 150ms ease,
            color 150ms ease,
            transform 150ms ease;
    }

    .rq-action-button:hover {
        background:
            linear-gradient(
                145deg,
                #effcfc,
                #cae9ec
            );

        color: #00636b;

        transform: translateY(-1px);
    }

    .rq-action-button .rq-icon {
        width: 17px;
        height: 17px;
    }


    /* ================================================================
       EMPTY
       ================================================================ */

    .rq-empty {
        display: none;

        padding: 52px 24px;

        text-align: center;
    }

    .rq-empty.is-visible {
        display: block;
    }

    .rq-empty-icon {
        display: grid;
        place-items: center;

        width: 56px;
        height: 56px;

        margin: 0 auto 14px;

        border: 1px solid rgba(255, 255, 255, .95);
        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                #edf7fa,
                #dfeef4
            );

        color: #68849a;

        box-shadow:
            inset 3px 3px 7px rgba(90, 121, 141, .1),
            inset -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .rq-empty-icon .rq-icon {
        width: 23px;
        height: 23px;
    }

    .rq-empty h3 {
        margin: 0;

        color: #29475f;

        font-size: 15px;
        font-weight: 750;
    }

    .rq-empty p {
        margin: 6px 0 0;

        color: var(--rq-muted);

        font-size: 11.5px;
        line-height: 1.6;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .rq-register-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 10px 20px;

        padding: 15px 24px;

        color: var(--rq-muted);

        font-size: 10.5px;
        line-height: 1.55;
    }

    .rq-register-footer p {
        margin: 0;
    }

    .rq-register-footer strong {
        color: #29475f;

        font-weight: 750;
    }

    .rq-footer-meta {
        display: flex;
        align-items: center;

        gap: 10px;
    }

    .rq-preview-tag {
        display: inline-flex;
        align-items: center;

        min-height: 27px;

        padding: 5px 9px;

        border: 1px solid rgba(255, 255, 255, .75);
        border-radius: 9px;

        background:
            linear-gradient(
                145deg,
                #e3f6f7,
                #d3edef
            );

        color: var(--rq-teal);

        font-size: 9.8px;
        font-weight: 700;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @media (max-width: 1279px) {
        .rq-summary-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }
    }

    @media (max-width: 1000px) {
        .rq-filters {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .rq-search-field {
            grid-column: 1 / -1;
        }

        .rq-clear {
            justify-self: start;
        }
    }

    @media (max-width: 767px) {
        .rq-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }

        .rq-heading-side {
            align-items: flex-start;
        }

        .rq-heading-meta {
            align-items: flex-start;
        }

        .rq-summary-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            gap: 12px;
        }

        .rq-register-heading {
            align-items: flex-start;

            padding: 19px 18px 16px;
        }

        .rq-filters {
            padding: 18px;
        }

        .rq-register-footer {
            padding: 14px 18px;
        }
    }

    @media (max-width: 560px) {
        .requests-page {
            gap: 19px;
        }

        .rq-new-button {
            width: 100%;
        }

        .rq-heading-side {
            width: 100%;
        }

        .rq-summary-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .rq-summary-card {
            min-height: auto;
        }

        .rq-register {
            border-radius: 19px;
        }

        .rq-register-heading {
            flex-direction: column;

            gap: 12px;
        }

        .rq-register-note {
            align-self: flex-start;
        }

        .rq-filters {
            grid-template-columns:
                minmax(0, 1fr);

            gap: 12px;
        }

        .rq-search-field {
            grid-column: auto;
        }

        .rq-clear {
            width: 100%;
        }

        .rq-footer-meta {
            width: 100%;

            justify-content: space-between;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .rq-new-button,
        .rq-summary-card,
        .rq-clear,
        .rq-action-button {
            transition: none;
        }

        .rq-new-button:hover,
        .rq-summary-card:hover,
        .rq-clear:hover,
        .rq-action-button:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div class="requests-page">

    <svg
        class="rq-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="rq-icon-requests" viewBox="0 0 24 24">
            <rect x="5" y="3" width="14" height="18" rx="2"/>
            <path d="M9 8h6"/>
            <path d="M9 12h6"/>
            <path d="M9 16h4"/>
        </symbol>

        <symbol id="rq-icon-review" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"/>
            <path d="m20 20-4-4"/>
            <path d="M11 8v3"/>
            <path d="M11 14h.01"/>
        </symbol>

        <symbol id="rq-icon-alert" viewBox="0 0 24 24">
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol id="rq-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="rq-icon-prepare" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="rq-icon-complete" viewBox="0 0 24 24">
            <path d="M5 12.5 9.5 17 19 7.5"/>
        </symbol>

        <symbol id="rq-icon-plus" viewBox="0 0 24 24">
            <path d="M12 5v14"/>
            <path d="M5 12h14"/>
        </symbol>

        <symbol id="rq-icon-search" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
        </symbol>

        <symbol id="rq-icon-filter" viewBox="0 0 24 24">
            <path d="M4 5h16"/>
            <path d="M7 12h10"/>
            <path d="M10 19h4"/>
            <path d="m5 5 14 14"/>
        </symbol>

        <symbol id="rq-icon-items" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
        </symbol>

        <symbol id="rq-icon-eye" viewBox="0 0 24 24">
            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
            <circle cx="12" cy="12" r="2.5"/>
        </symbol>

        <symbol id="rq-icon-info" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </symbol>

        <symbol id="rq-icon-empty" viewBox="0 0 24 24">
            <rect x="5" y="3" width="14" height="18" rx="2"/>
            <path d="M9 9h6"/>
            <path d="M9 13h6"/>
        </symbol>
    </svg>


    <header class="rq-heading">

        <div class="rq-heading-copy">

            <p class="rq-eyebrow">
                Request coordination
            </p>

            <h1>
                Logistics Requests
            </h1>

            <p class="rq-heading-description">
                Review resource requirements, monitor request progress,
                and prepare logistics support for upcoming PULSO
                projects and activities.
            </p>

        </div>


        <div class="rq-heading-side">

            <a
                href="{{ route('requests.create') }}"
                class="rq-new-button"
            >
                <svg
                    class="rq-icon"
                    aria-hidden="true"
                >
                    <use href="#rq-icon-plus"/>
                </svg>

                New Request
            </a>


            <div class="rq-heading-meta">

                <strong>
                    September 2026
                </strong>

                <span>
                    Front-end workflow preview
                </span>

            </div>

        </div>

    </header>


    <section
        class="rq-overview"
        aria-label="Request overview"
    >

        <div class="rq-overview-caption">

            <div class="rq-overview-title">
                Request overview
            </div>

            <span>
                Current activity
            </span>

        </div>


        <div class="rq-summary-grid">

            @foreach ($summary as $item)

                <article
                    class="
                        rq-summary-card
                        rq-tone-{{ $item['tone'] }}
                    "
                >

                    <span
                        class="rq-summary-icon"
                        aria-hidden="true"
                    >
                        <svg class="rq-icon">
                            <use href="#rq-icon-{{ $item['icon'] }}"/>
                        </svg>
                    </span>


                    <div class="rq-summary-copy">

                        <strong class="rq-summary-value">
                            {{ sprintf('%02d', $item['value']) }}
                        </strong>

                        <span class="rq-summary-label">
                            {{ $item['label'] }}
                        </span>

                        <span class="rq-summary-description">
                            {{ $item['description'] }}
                        </span>

                    </div>

                </article>

            @endforeach

        </div>

    </section>


    <section
        class="rq-register"
        aria-labelledby="request-register-title"
    >

        <header class="rq-register-heading">

            <div class="rq-register-title">

                <span
                    class="rq-register-icon"
                    aria-hidden="true"
                >
                    <svg class="rq-icon">
                        <use href="#rq-icon-requests"/>
                    </svg>
                </span>


                <div>

                    <h2 id="request-register-title">
                        Request register
                    </h2>

                    <p>
                        <strong id="request-visible-count">
                            {{ count($requests) }}
                        </strong>

                        matching sample requests
                    </p>

                </div>

            </div>


            <span class="rq-register-note">

                <svg
                    class="rq-icon"
                    aria-hidden="true"
                >
                    <use href="#rq-icon-info"/>
                </svg>

                Updated Sep 2026

            </span>

        </header>


        <div
            class="rq-filters"
            role="search"
            aria-label="Search and filter logistics requests"
        >

            <div class="rq-field rq-search-field">

                <label for="request-search">
                    Search requests
                </label>

                <div class="rq-search">

                    <svg
                        class="rq-icon"
                        aria-hidden="true"
                    >
                        <use href="#rq-icon-search"/>
                    </svg>

                    <input
                        id="request-search"
                        class="rq-input"
                        type="search"
                        placeholder="Request ID, project, committee, or requester"
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="rq-field">

                <label for="request-status-filter">
                    Status
                </label>

                <select
                    id="request-status-filter"
                    class="rq-input"
                >
                    <option value="">
                        All statuses
                    </option>

                    @foreach ($statuses as $status)
                        <option value="{{ $status }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

            </div>


            <div class="rq-field">

                <label for="request-priority-filter">
                    Priority
                </label>

                <select
                    id="request-priority-filter"
                    class="rq-input"
                >
                    <option value="">
                        All priorities
                    </option>

                    @foreach ($priorities as $priority)
                        <option value="{{ $priority }}">
                            {{ $priority }}
                        </option>
                    @endforeach
                </select>

            </div>


            <button
                id="clear-request-filters"
                class="rq-clear"
                type="button"
            >
                <svg
                    class="rq-icon"
                    aria-hidden="true"
                >
                    <use href="#rq-icon-filter"/>
                </svg>

                Clear filters
            </button>

        </div>


        <div
            class="rq-table-scroll custom-scrollbar"
            role="region"
            aria-label="Logistics request table"
            tabindex="0"
        >

            <table
                id="request-table"
                class="rq-table"
            >

                <caption class="sr-only">
                    Logistics requests with project, committee,
                    requested date, number of resources, priority,
                    status, and available action.
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
                            Date needed
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
                            Updated
                        </th>

                        <th
                            scope="col"
                            class="rq-action-heading"
                        >
                            Action
                        </th>
                    </tr>

                </thead>


                <tbody>

                    @foreach ($requests as $request)

                        <tr
                            data-request-row
                            data-search="{{ strtolower(
                                $request['id']
                                . ' '
                                . $request['project']
                                . ' '
                                . $request['committee']
                                . ' '
                                . $request['requester']
                            ) }}"
                            data-status="{{ $request['status'] }}"
                            data-priority="{{ $request['priority'] }}"
                        >

                            <td>

                                <div class="rq-request">

                                    <span
                                        class="rq-request-icon"
                                        aria-hidden="true"
                                    >
                                        <svg class="rq-icon">
                                            <use href="#rq-icon-requests"/>
                                        </svg>
                                    </span>


                                    <div class="rq-request-copy">

                                        <span class="rq-request-id">
                                            {{ $request['id'] }}
                                        </span>

                                        <span class="rq-request-name">
                                            {{ $request['project'] }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <strong>
                                    {{ $request['committee'] }}
                                </strong>

                                <span class="rq-secondary">
                                    {{ $request['requester'] }}
                                </span>

                            </td>


                            <td>

                                <div class="rq-date">

                                    <strong>
                                        {{ $request['date_needed'] }}
                                    </strong>

                                    <span>
                                        Scheduled need
                                    </span>

                                </div>

                            </td>


                            <td>

                                <span class="rq-items">

                                    <svg
                                        class="rq-icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#rq-icon-items"/>
                                    </svg>

                                    {{ $request['items'] }}

                                    {{ $request['items'] === 1 ? 'item' : 'items' }}

                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        rq-priority
                                        rq-tone-{{ $priorityTones[$request['priority']] }}
                                    "
                                >
                                    {{ $request['priority'] }}
                                </span>

                            </td>


                            <td>

                                <span
                                    class="
                                        rq-badge
                                        rq-status-{{ $statusTones[$request['status']] }}
                                    "
                                >
                                    {{ $request['status'] }}
                                </span>

                            </td>


                            <td>
                                {{ $request['updated'] }}
                            </td>


                            <td class="rq-action-cell">

                                <div class="rq-action-group">

                                    <a
                                        href="{{ route('requests.show') }}"
                                        class="rq-action-button"
                                        aria-label="View {{ $request['id'] }}"
                                        title="View request"
                                    >
                                        <svg
                                            class="rq-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#rq-icon-eye"/>
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
            id="request-empty-state"
            class="rq-empty"
        >

            <span
                class="rq-empty-icon"
                aria-hidden="true"
            >
                <svg class="rq-icon">
                    <use href="#rq-icon-empty"/>
                </svg>
            </span>

            <h3>
                No matching requests
            </h3>

            <p>
                Try another search term or clear the current filters.
            </p>

        </div>


        <footer class="rq-register-footer">

            <p>
                Showing

                <strong id="request-visible-range">
                    {{ count($requests) }}
                </strong>

                of

                <strong>
                    {{ count($requests) }}
                </strong>

                sample requests.
            </p>


            <div class="rq-footer-meta">

                <span>
                    Filters apply instantly
                </span>

                <span class="rq-preview-tag">
                    Request preview
                </span>

            </div>

        </footer>

    </section>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeRequestFilters = () => {
        const searchInput =
            document.getElementById(
                'request-search'
            );

        const statusFilter =
            document.getElementById(
                'request-status-filter'
            );

        const priorityFilter =
            document.getElementById(
                'request-priority-filter'
            );

        const clearButton =
            document.getElementById(
                'clear-request-filters'
            );

        const visibleCount =
            document.getElementById(
                'request-visible-count'
            );

        const visibleRange =
            document.getElementById(
                'request-visible-range'
            );

        const emptyState =
            document.getElementById(
                'request-empty-state'
            );

        const rows =
            Array.from(
                document.querySelectorAll(
                    '[data-request-row]'
                )
            );


        if (
            !searchInput ||
            !statusFilter ||
            !priorityFilter ||
            !clearButton ||
            !visibleCount ||
            !visibleRange ||
            !emptyState ||
            rows.length === 0
        ) {
            return;
        }


        const normalize = (value) => {
            return String(value ?? '')
                .trim()
                .toLowerCase();
        };


        const applyFilters = () => {
            const searchValue =
                normalize(
                    searchInput.value
                );

            const statusValue =
                normalize(
                    statusFilter.value
                );

            const priorityValue =
                normalize(
                    priorityFilter.value
                );

            let visible = 0;


            rows.forEach((row) => {
                const searchable =
                    normalize(
                        row.dataset.search
                    );

                const status =
                    normalize(
                        row.dataset.status
                    );

                const priority =
                    normalize(
                        row.dataset.priority
                    );

                const matchesSearch =
                    !searchValue ||
                    searchable.includes(
                        searchValue
                    );

                const matchesStatus =
                    !statusValue ||
                    status === statusValue;

                const matchesPriority =
                    !priorityValue ||
                    priority === priorityValue;

                const shouldShow =
                    matchesSearch &&
                    matchesStatus &&
                    matchesPriority;

                row.hidden =
                    !shouldShow;

                if (shouldShow) {
                    visible += 1;
                }
            });


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
                visible === 0
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

        clearButton.addEventListener(
            'click',
            () => {
                searchInput.value = '';
                statusFilter.value = '';
                priorityFilter.value = '';

                applyFilters();

                searchInput.focus();
            }
        );


        applyFilters();
    };


    if (
        document.readyState === 'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeRequestFilters,
            {
                once: true
            }
        );
    } else {
        initializeRequestFilters();
    }
})();
</script>
@endpush