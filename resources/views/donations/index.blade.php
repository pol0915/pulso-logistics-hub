@extends('layouts.app')

@section('title', 'Donations | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | SAMPLE PHYSICAL DONATION RECORDS
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
            'date_received' => 'Sep 9, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Verified',
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
            'date_received' => 'Sep 8, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Allocated',
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
            'date_received' => 'Sep 7, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Added to Inventory',
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
            'date_received' => 'Sep 6, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Pending Verification',
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
            'date_received' => 'Sep 5, 2026',
            'received_by' => 'Paul Roldan',
            'status' => 'Verified',
            'allocation' => 'Unallocated',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    $donationCollection = collect($donations);

    $summary = [
        [
            'label' => 'Received records',
            'value' => $donationCollection->count(),
            'description' => 'Physical donations logged',
            'tone' => 'navy',
            'icon' => 'donation',
        ],
        [
            'label' => 'Pending verification',
            'value' => $donationCollection
                ->where('status', 'Pending Verification')
                ->count(),
            'description' => 'Awaiting inspection',
            'tone' => 'amber',
            'icon' => 'inspect',
        ],
        [
            'label' => 'Verified',
            'value' => $donationCollection
                ->where('status', 'Verified')
                ->count(),
            'description' => 'Accepted and ready to allocate',
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'label' => 'Integrated',
            'value' => $donationCollection
                ->whereIn(
                    'status',
                    [
                        'Allocated',
                        'Added to Inventory',
                    ]
                )
                ->count(),
            'description' => 'Allocated or inventoried',
            'tone' => 'green',
            'icon' => 'inventory',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | STATUS CLASSES
    |--------------------------------------------------------------------------
    */

    $statusClasses = [
        'Pending Verification' => 'pending',
        'Verified' => 'verified',
        'Allocated' => 'allocated',
        'Added to Inventory' => 'inventory',
    ];
@endphp


@push('styles')
<style>
    .donations-page {
        --dn-navy: #10263d;
        --dn-copy: #496580;
        --dn-muted: #71899c;
        --dn-line: #d5e5ee;

        --dn-teal: #007780;
        --dn-pink: #b90c61;
        --dn-blue: #365f8d;
        --dn-red: #ad343d;
        --dn-amber: #895408;
        --dn-green: #2b735d;

        display: grid;
        gap: 23px;

        width: 100%;
        min-width: 0;

        color: var(--dn-navy);

        container-name: donations-page;
        container-type: inline-size;
    }

    .donations-page *,
    .donations-page *::before,
    .donations-page *::after {
        box-sizing: border-box;
    }

    .donations-page [hidden] {
        display: none !important;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .dn-icon {
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

    .dn-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .dn-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 26px;

        min-width: 0;
    }

    .dn-heading-copy {
        min-width: 0;
    }

    .dn-eyebrow {
        margin: 0 0 7px;

        color: var(--dn-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .dn-heading h1 {
        margin: 0;

        color: var(--dn-navy);

        font-size: clamp(30px, 3vw, 42px);
        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.055em;
    }

    .dn-heading-description {
        max-width: 730px;

        margin: 10px 0 0;

        color: var(--dn-copy);

        font-size: 14px;
        line-height: 1.7;
    }

    .dn-heading-actions {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-shrink: 0;
    }

    .dn-heading-note {
        display: flex;
        align-items: center;

        gap: 9px;

        max-width: 285px;

        padding: 10px 13px;

        border: 1px solid rgba(255, 255, 255, .94);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e5f7f8,
                #d6eef1
            );

        color: #42687d;

        box-shadow:
            inset 2px 2px 5px rgba(75, 109, 130, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .7);

        font-size: 10.5px;
        line-height: 1.5;
    }

    .dn-heading-note .dn-icon {
        width: 17px;
        height: 17px;

        color: var(--dn-teal);
    }


    /* ================================================================
       REPORT BUTTON
       ================================================================ */

    .dn-button {
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
            4px 5px 10px rgba(83, 117, 139, .11),
            -3px -3px 8px rgba(255, 255, 255, .82);

        font-size: 10.5px;
        font-weight: 750;

        text-decoration: none;

        transition:
            color 150ms ease,
            transform 150ms ease;
    }

    .dn-button:hover {
        color: var(--dn-teal);

        transform: translateY(-1px);
    }

    .dn-button .dn-icon {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       KPI WRAPPER
       ================================================================ */

    .donations-page > .dn-summary {
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

    .donations-page > .dn-summary::before,
    .donations-page > .dn-summary::after {
        display: none !important;

        width: 0 !important;
        height: 0 !important;

        border: 0 !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    /* ================================================================
       KPI CARDS
       ================================================================ */

    .dn-summary-card {
        --dn-tone: #173b59;

        --dn-tone-fill:
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

    .dn-summary-card::after {
        position: absolute;

        top: 0;
        right: 17px;

        width: 34px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--dn-tone);

        opacity: .5;

        content: "";
    }

    .dn-summary-icon {
        display: grid;
        place-items: center;

        width: 43px;
        height: 43px;

        flex: 0 0 43px;

        border: 1px solid rgba(255, 255, 255, .98);
        border-radius: 14px;

        background: var(--dn-tone-fill);

        color: var(--dn-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }

    .dn-summary-icon .dn-icon {
        width: 18px;
        height: 18px;
    }

    .dn-summary-copy {
        min-width: 0;
    }

    .dn-summary-value {
        display: block;

        color: var(--dn-tone);

        font-size: 26px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.045em;

        font-variant-numeric: tabular-nums;
    }

    .dn-summary-label {
        display: block;

        margin-top: 6px;

        color: #29475f;

        font-size: 11.5px;
        font-weight: 750;
    }

    .dn-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #70889a;

        font-size: 9.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .dn-tone-navy {
        --dn-tone: #173b59;

        --dn-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }

    .dn-tone-teal {
        --dn-tone: #007780;

        --dn-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }

    .dn-tone-amber {
        --dn-tone: #895408;

        --dn-tone-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }

    .dn-tone-green {
        --dn-tone: #2b735d;

        --dn-tone-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    /* ================================================================
       WORKFLOW
       ================================================================ */

    .dn-workflow {
        padding: 17px 19px 19px;

        border: 1px solid rgba(255, 255, 255, .95);
        border-radius: 20px;

        background:
            linear-gradient(
                145deg,
                #f7fbfd,
                #e7f1f5
            );

        box-shadow:
            5px 7px 14px rgba(78, 112, 133, .09),
            -4px -4px 10px rgba(255, 255, 255, .72);
    }

    .dn-workflow-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 13px;
    }

    .dn-workflow-head h2 {
        margin: 0;

        color: #29475f;

        font-size: 13px;
        font-weight: 800;
    }

    .dn-workflow-head span {
        color: #7b91a1;

        font-size: 9px;
    }

    .dn-workflow-grid {
        display: grid;

        grid-template-columns:
            repeat(
                5,
                minmax(0, 1fr)
            );

        gap: 9px;
    }

    .dn-workflow-step {
        display: flex;
        align-items: center;

        gap: 9px;

        min-width: 0;
        min-height: 56px;

        padding: 9px 10px;

        border: 1px solid rgba(255, 255, 255, .88);
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e8f2f6,
                #f0f7f9
            );

        box-shadow:
            inset 2px 2px 5px rgba(77, 112, 133, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .72);
    }

    .dn-workflow-number {
        display: grid;
        place-items: center;

        width: 29px;
        height: 29px;

        flex: 0 0 29px;

        border-radius: 9px;

        background:
            linear-gradient(
                145deg,
                #ddf3f4,
                #cfeaec
            );

        color: var(--dn-teal);

        font-size: 9px;
        font-weight: 850;
    }

    .dn-workflow-copy {
        min-width: 0;
    }

    .dn-workflow-copy strong {
        display: block;

        color: #34546b;

        font-size: 9.5px;
        font-weight: 800;
    }

    .dn-workflow-copy span {
        display: block;

        margin-top: 2px;

        color: #7c92a2;

        font-size: 7.8px;
        line-height: 1.35;
    }


    /* ================================================================
       REGISTER
       ================================================================ */

    .dn-register {
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

    .dn-register-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        padding: 20px 23px 18px;

        border-bottom: 1px solid rgba(207, 226, 236, .82);
    }

    .dn-register-title {
        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;
    }

    .dn-register-icon {
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

        color: var(--dn-teal);

        box-shadow:
            4px 5px 10px rgba(70, 115, 136, .11),
            -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .dn-register-icon .dn-icon {
        width: 18px;
        height: 18px;
    }

    .dn-register-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 780;

        letter-spacing: -.025em;
    }

    .dn-register-title p {
        margin: 4px 0 0;

        color: var(--dn-copy);

        font-size: 11px;
    }

    .dn-register-title p strong {
        color: var(--dn-teal);

        font-weight: 800;
    }

    .dn-register-tag {
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

    .dn-register-tag .dn-icon {
        width: 14px;
        height: 14px;

        color: var(--dn-teal);
    }


    /* ================================================================
       FILTERS
       ================================================================ */

    .dn-filters {
        display: grid;

        grid-template-columns:
            minmax(270px, 1.6fr)
            minmax(170px, .75fr)
            minmax(160px, .7fr)
            auto;

        align-items: end;

        gap: 13px;

        padding: 18px 23px 20px;

        background:
            linear-gradient(
                180deg,
                rgba(233, 243, 248, .46),
                rgba(241, 248, 251, .18)
            );
    }

    .dn-field {
        min-width: 0;
    }

    .dn-field label {
        display: block;

        margin-bottom: 7px;

        color: #3c5a71;

        font-size: 11px;
        font-weight: 750;
    }

    .dn-search {
        position: relative;
    }

    .dn-search > .dn-icon {
        position: absolute;

        top: 50%;
        left: 14px;

        width: 17px;
        height: 17px;

        color: #678398;

        pointer-events: none;

        transform: translateY(-50%);
    }

    .dn-input {
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

        color: var(--dn-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .15),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 12px;
    }

    .dn-search .dn-input {
        padding-left: 41px;
    }

    .dn-input::placeholder {
        color: #7b91a2;
    }

    .dn-input:focus {
        border-color: rgba(0, 126, 137, .48);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .09);
    }

    select.dn-input {
        cursor: pointer;
    }

    .dn-clear {
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
            -3px -3px 8px rgba(255, 255, 255, .82);

        font: inherit;
        font-size: 11px;
        font-weight: 700;

        cursor: pointer;

        white-space: nowrap;
    }

    .dn-clear:hover {
        color: var(--dn-teal);
    }

    .dn-clear .dn-icon {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .dn-table-scroll {
        width: 100%;

        overflow-x: auto;

        border-top: 1px solid var(--dn-line);
        border-bottom: 1px solid var(--dn-line);
    }

    .dn-table {
        width: 100%;
        min-width: 1160px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }

    .dn-table th {
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

    .dn-table td {
        padding: 14px;

        border-bottom: 1px solid rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 11.2px;

        vertical-align: middle;
    }

    .dn-table th:first-child,
    .dn-table td:first-child {
        padding-left: 23px;
    }

    .dn-table th:last-child,
    .dn-table td:last-child {
        padding-right: 23px;
    }

    .dn-table tbody tr:hover {
        background: rgba(255, 255, 255, .46);
    }

    .dn-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* ================================================================
       DONATION RECORD
       ================================================================ */

    .dn-record {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 220px;
    }

    .dn-record-icon {
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

        color: var(--dn-teal);

        box-shadow:
            3px 4px 8px rgba(76, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .78);
    }

    .dn-record-icon .dn-icon {
        width: 17px;
        height: 17px;
    }

    .dn-record-copy {
        min-width: 0;
    }

    .dn-record-id {
        display: block;

        color: #70879a;

        font-size: 9.5px;
        font-weight: 650;
    }

    .dn-record-name {
        display: block;

        max-width: 220px;

        margin-top: 3px;

        overflow: hidden;

        color: #18344c;

        font-size: 11.8px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .dn-secondary {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9.5px;
        line-height: 1.45;
    }


    /* ================================================================
       RESOURCE
       ================================================================ */

    .dn-resource {
        min-width: 190px;
    }

    .dn-resource strong {
        display: block;

        color: #29475f;

        font-size: 10.8px;
        font-weight: 750;
    }

    .dn-resource-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 5px;

        margin-top: 4px;
    }

    .dn-resource-meta span {
        display: inline-flex;
        align-items: center;

        min-height: 23px;

        padding: 3px 7px;

        border-radius: 7px;

        background: #e5f0f4;

        color: #617b8e;

        font-size: 8.5px;
        font-weight: 700;
    }


    /* ================================================================
       STATUS
       ================================================================ */

    .dn-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 28px;

        padding: 5px 10px;

        border: 1px solid transparent;
        border-radius: 9px;

        font-size: 9.5px;
        font-weight: 800;

        white-space: nowrap;
    }

    .dn-status-pending {
        border-color: #efd39a;

        background:
            linear-gradient(
                145deg,
                #fff4d8,
                #f7e1ae
            );

        color: #885704;
    }

    .dn-status-verified {
        border-color: #aedbdc;

        background:
            linear-gradient(
                145deg,
                #dff4f4,
                #cbe8e9
            );

        color: #166e73;
    }

    .dn-status-allocated {
        border-color: #bfd3e7;

        background:
            linear-gradient(
                145deg,
                #e9f1fa,
                #d1e1f0
            );

        color: #315b88;
    }

    .dn-status-inventory {
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
       ALLOCATION
       ================================================================ */

    .dn-allocation {
        display: flex;
        align-items: flex-start;

        gap: 7px;

        min-width: 170px;
    }

    .dn-allocation .dn-icon {
        width: 14px;
        height: 14px;

        margin-top: 1px;

        color: var(--dn-teal);
    }

    .dn-allocation strong {
        display: block;

        color: #365970;

        font-size: 9.8px;
        font-weight: 750;
    }

    .dn-allocation span {
        display: block;

        margin-top: 2px;

        color: #7890a1;

        font-size: 8.7px;
    }


    /* ================================================================
       ACTION
       ================================================================ */

    .dn-action-heading,
    .dn-action-cell {
        min-width: 86px;

        text-align: center;
    }

    .dn-actions {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dn-action {
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

        color: var(--dn-teal);

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76);

        text-decoration: none;

        transition:
            transform 150ms ease,
            background 150ms ease;
    }

    .dn-action:hover {
        background:
            linear-gradient(
                145deg,
                #effcfc,
                #cae9ec
            );

        color: #006c74;

        transform: translateY(-1px);
    }

    .dn-action .dn-icon {
        width: 17px;
        height: 17px;
    }


    /* ================================================================
       EMPTY + FOOTER
       ================================================================ */

    .dn-empty {
        display: none;

        padding: 48px 24px;

        text-align: center;
    }

    .dn-empty.is-visible {
        display: block;
    }

    .dn-empty-symbol {
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
    }

    .dn-empty-symbol .dn-icon {
        width: 23px;
        height: 23px;
    }

    .dn-empty h3 {
        margin: 0;

        color: #29475f;

        font-size: 15px;
    }

    .dn-empty p {
        margin: 6px 0 0;

        color: var(--dn-muted);

        font-size: 11px;
    }

    .dn-register-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 10px 20px;

        padding: 15px 23px;

        color: var(--dn-muted);

        font-size: 10.5px;
    }

    .dn-register-footer p {
        margin: 0;
    }

    .dn-register-footer strong {
        color: #29475f;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container donations-page (max-width: 1000px) {
        .dn-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }

        .dn-heading-actions {
            width: 100%;
        }

        .donations-page > .dn-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .dn-workflow-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }

        .dn-filters {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .dn-search-field {
            grid-column: 1 / -1;
        }

        .dn-clear {
            justify-self: start;
        }
    }

    @container donations-page (max-width: 620px) {
        .donations-page > .dn-summary {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .dn-heading-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);
        }

        .dn-heading-actions > * {
            width: 100%;
        }

        .dn-workflow-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .dn-workflow-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .dn-register-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .dn-filters {
            grid-template-columns:
                minmax(0, 1fr);

            padding: 17px 16px;
        }

        .dn-search-field {
            grid-column: auto;
        }

        .dn-clear {
            width: 100%;
        }

        .dn-register-footer {
            padding: 14px 16px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .dn-action,
        .dn-button {
            transition: none;
        }

        .dn-action:hover,
        .dn-button:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div
    id="donations-page"
    class="donations-page"
>

    {{-- =============================================================
         ICON LIBRARY
         ============================================================= --}}

    <svg
        class="dn-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="dn-icon-donation" viewBox="0 0 24 24">
            <path d="M4 10h16v10H4Z"/>
            <path d="M12 10v10"/>
            <path d="M3 6h18v4H3Z"/>
            <path d="M12 6c-1.2-3-5-3-5 0 0 2 3 2 5 0Z"/>
            <path d="M12 6c1.2-3 5-3 5 0 0 2-3 2-5 0Z"/>
        </symbol>

        <symbol id="dn-icon-inspect" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
            <path d="M8 10.5 10 12l3-4"/>
        </symbol>

        <symbol id="dn-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="dn-icon-inventory" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="dn-icon-info" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </symbol>

        <symbol id="dn-icon-search" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
        </symbol>

        <symbol id="dn-icon-filter" viewBox="0 0 24 24">
            <path d="M4 5h16"/>
            <path d="M7 12h10"/>
            <path d="M10 19h4"/>
            <path d="m5 5 14 14"/>
        </symbol>

        <symbol id="dn-icon-eye" viewBox="0 0 24 24">
            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
            <circle cx="12" cy="12" r="2.5"/>
        </symbol>

        <symbol id="dn-icon-calendar" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="16" rx="2"/>
            <path d="M16 3v4"/>
            <path d="M8 3v4"/>
            <path d="M3 10h18"/>
        </symbol>

        <symbol id="dn-icon-allocate" viewBox="0 0 24 24">
            <path d="M4 6h7v5H4Z"/>
            <path d="M13 13h7v5h-7Z"/>
            <path d="M11 8.5h2a3 3 0 0 1 3 3V13"/>
        </symbol>

        <symbol id="dn-icon-report" viewBox="0 0 24 24">
            <path d="M4 19V5"/>
            <path d="M4 19h16"/>
            <path d="M8 16v-4"/>
            <path d="M12 16V8"/>
            <path d="M16 16v-7"/>
        </symbol>
    </svg>


    {{-- =============================================================
         HEADING
         ============================================================= --}}

    <header class="dn-heading">

        <div class="dn-heading-copy">

            <p class="dn-eyebrow">
                Resource intake
            </p>

            <h1>
                Donations
            </h1>

            <p class="dn-heading-description">
                Record physical resources received from donors,
                verify their quantity and condition, and track whether
                accepted items are allocated to an activity or added
                to the PULSO inventory.
            </p>

        </div>


        <div class="dn-heading-actions">

            <div class="dn-heading-note">

                <svg
                    class="dn-icon"
                    aria-hidden="true"
                >
                    <use href="#dn-icon-info"/>
                </svg>

                <span>
                    This module tracks donated physical resources,
                    not cash contributions or project funding.
                </span>

            </div>


            <a
                href="{{ route('reports.donations') }}"
                class="dn-button"
            >
                <svg
                    class="dn-icon"
                    aria-hidden="true"
                >
                    <use href="#dn-icon-report"/>
                </svg>

                Donation report
            </a>

        </div>

    </header>


    {{-- =============================================================
         SUMMARY
         ============================================================= --}}

    <section
        class="dn-summary"
        aria-label="Donation intake summary"
    >

        @foreach ($summary as $item)

            <article
                class="
                    dn-summary-card
                    dn-tone-{{ $item['tone'] }}
                "
            >

                <span
                    class="dn-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="dn-icon">
                        <use href="#dn-icon-{{ $item['icon'] }}"/>
                    </svg>
                </span>


                <div class="dn-summary-copy">

                    <strong class="dn-summary-value">
                        {{ sprintf('%02d', $item['value']) }}
                    </strong>

                    <span class="dn-summary-label">
                        {{ $item['label'] }}
                    </span>

                    <span class="dn-summary-description">
                        {{ $item['description'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         WORKFLOW
         ============================================================= --}}

    <section class="dn-workflow">

        <div class="dn-workflow-head">

            <h2>
                Donation intake workflow
            </h2>

            <span>
                From receipt to usable PULSO resource
            </span>

        </div>


        <div class="dn-workflow-grid">

            <article class="dn-workflow-step">

                <span class="dn-workflow-number">
                    01
                </span>

                <div class="dn-workflow-copy">

                    <strong>
                        Receive
                    </strong>

                    <span>
                        Log donor and resource details
                    </span>

                </div>

            </article>


            <article class="dn-workflow-step">

                <span class="dn-workflow-number">
                    02
                </span>

                <div class="dn-workflow-copy">

                    <strong>
                        Verify
                    </strong>

                    <span>
                        Inspect quantity and condition
                    </span>

                </div>

            </article>


            <article class="dn-workflow-step">

                <span class="dn-workflow-number">
                    03
                </span>

                <div class="dn-workflow-copy">

                    <strong>
                        Accept
                    </strong>

                    <span>
                        Confirm resource is usable
                    </span>

                </div>

            </article>


            <article class="dn-workflow-step">

                <span class="dn-workflow-number">
                    04
                </span>

                <div class="dn-workflow-copy">

                    <strong>
                        Allocate
                    </strong>

                    <span>
                        Assign to an activity when needed
                    </span>

                </div>

            </article>


            <article class="dn-workflow-step">

                <span class="dn-workflow-number">
                    05
                </span>

                <div class="dn-workflow-copy">

                    <strong>
                        Inventory
                    </strong>

                    <span>
                        Add reusable resources to stock
                    </span>

                </div>

            </article>

        </div>

    </section>


    {{-- =============================================================
         REGISTER
         ============================================================= --}}

    <section
        class="dn-register"
        aria-labelledby="donation-register-title"
    >

        <header class="dn-register-head">

            <div class="dn-register-title">

                <span
                    class="dn-register-icon"
                    aria-hidden="true"
                >
                    <svg class="dn-icon">
                        <use href="#dn-icon-donation"/>
                    </svg>
                </span>


                <div>

                    <h2 id="donation-register-title">
                        Donation register
                    </h2>

                    <p>
                        <strong id="donation-visible-count">
                            {{ count($donations) }}
                        </strong>

                        matching donation records
                    </p>

                </div>

            </div>


            <span class="dn-register-tag">

                <svg
                    class="dn-icon"
                    aria-hidden="true"
                >
                    <use href="#dn-icon-check"/>
                </svg>

                Physical resource intake

            </span>

        </header>


        {{-- =========================================================
             FILTERS
             ========================================================= --}}

        <div
            class="dn-filters"
            role="search"
            aria-label="Search and filter donation records"
        >

            <div class="dn-field dn-search-field">

                <label for="donation-search">
                    Search donations
                </label>

                <div class="dn-search">

                    <svg
                        class="dn-icon"
                        aria-hidden="true"
                    >
                        <use href="#dn-icon-search"/>
                    </svg>

                    <input
                        id="donation-search"
                        class="dn-input"
                        type="search"
                        placeholder="Donation ID, donor, item, category..."
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="dn-field">

                <label for="donation-status-filter">
                    Intake status
                </label>

                <select
                    id="donation-status-filter"
                    class="dn-input"
                >
                    <option value="">
                        All statuses
                    </option>

                    <option value="Pending Verification">
                        Pending Verification
                    </option>

                    <option value="Verified">
                        Verified
                    </option>

                    <option value="Allocated">
                        Allocated
                    </option>

                    <option value="Added to Inventory">
                        Added to Inventory
                    </option>
                </select>

            </div>


            <div class="dn-field">

                <label for="donation-category-filter">
                    Category
                </label>

                <select
                    id="donation-category-filter"
                    class="dn-input"
                >
                    <option value="">
                        All categories
                    </option>

                    <option value="Furniture">
                        Furniture
                    </option>

                    <option value="Cleaning Supplies">
                        Cleaning Supplies
                    </option>

                    <option value="Electrical">
                        Electrical
                    </option>

                    <option value="Storage">
                        Storage
                    </option>
                </select>

            </div>


            <button
                id="clear-donation-filters"
                class="dn-clear"
                type="button"
            >
                <svg
                    class="dn-icon"
                    aria-hidden="true"
                >
                    <use href="#dn-icon-filter"/>
                </svg>

                Clear filters
            </button>

        </div>


        {{-- =========================================================
             TABLE
             ========================================================= --}}

        <div
            class="dn-table-scroll custom-scrollbar"
            role="region"
            aria-label="Donation records"
            tabindex="0"
        >

            <table class="dn-table">

                <caption class="sr-only">
                    Physical donation records showing donors, donated
                    resources, receipt details, status, allocation,
                    and available actions.
                </caption>


                <thead>
                    <tr>

                        <th scope="col">
                            Donation
                        </th>

                        <th scope="col">
                            Donor
                        </th>

                        <th scope="col">
                            Resource
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
                            class="dn-action-heading"
                        >
                            Action
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @foreach ($donations as $donation)

                        <tr
                            data-donation-row
                            data-status="{{ $donation['status'] }}"
                            data-category="{{ $donation['category'] }}"
                            data-search="{{ strtolower(
                                $donation['id']
                                . ' '
                                . $donation['donor']
                                . ' '
                                . $donation['donor_type']
                                . ' '
                                . $donation['item']
                                . ' '
                                . $donation['category']
                                . ' '
                                . $donation['condition']
                                . ' '
                                . $donation['allocation']
                            ) }}"
                        >

                            {{-- DONATION --}}

                            <td>

                                <div class="dn-record">

                                    <span
                                        class="dn-record-icon"
                                        aria-hidden="true"
                                    >
                                        <svg class="dn-icon">
                                            <use href="#dn-icon-donation"/>
                                        </svg>
                                    </span>


                                    <div class="dn-record-copy">

                                        <span class="dn-record-id">
                                            {{ $donation['id'] }}
                                        </span>

                                        <span class="dn-record-name">
                                            {{ $donation['item'] }}
                                        </span>

                                        <span class="dn-secondary">
                                            {{ $donation['category'] }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- DONOR --}}

                            <td>

                                <strong>
                                    {{ $donation['donor'] }}
                                </strong>

                                <span class="dn-secondary">
                                    {{ $donation['donor_type'] }}
                                </span>

                            </td>


                            {{-- RESOURCE --}}

                            <td>

                                <div class="dn-resource">

                                    <strong>
                                        {{ $donation['quantity'] }}

                                        {{ $donation['quantity'] === 1 ? 'unit' : 'units' }}
                                    </strong>


                                    <div class="dn-resource-meta">

                                        <span>
                                            {{ $donation['category'] }}
                                        </span>

                                        <span>
                                            {{ $donation['condition'] }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- RECEIVED --}}

                            <td>

                                <strong>
                                    {{ $donation['date_received'] }}
                                </strong>

                                <span class="dn-secondary">
                                    Received by
                                    {{ $donation['received_by'] }}
                                </span>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                <span
                                    class="
                                        dn-badge
                                        dn-status-{{ $statusClasses[$donation['status']] }}
                                    "
                                >
                                    {{ $donation['status'] }}
                                </span>

                            </td>


                            {{-- ALLOCATION --}}

                            <td>

                                <div class="dn-allocation">

                                    <svg
                                        class="dn-icon"
                                        aria-hidden="true"
                                    >
                                        @if ($donation['allocation'] === 'Inventory')

                                            <use href="#dn-icon-inventory"/>

                                        @else

                                            <use href="#dn-icon-allocate"/>

                                        @endif
                                    </svg>


                                    <div>

                                        <strong>
                                            {{ $donation['allocation'] }}
                                        </strong>


                                        <span>

                                            @if ($donation['allocation'] === 'Unallocated')

                                                Available after verification

                                            @elseif ($donation['allocation'] === 'Inventory')

                                                Added to inventory stock

                                            @else

                                                Assigned activity

                                            @endif

                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- ACTION --}}

                            <td class="dn-action-cell">

                                <div class="dn-actions">

                                    <a
                                        href="{{ route('donations.show', ['id' => $donation['id']]) }}"
                                        class="dn-action"
                                        title="View donation details"
                                        aria-label="View {{ $donation['id'] }}"
                                    >
                                        <svg
                                            class="dn-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#dn-icon-eye"/>
                                        </svg>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- =========================================================
             EMPTY STATE
             ========================================================= --}}

        <div
            id="donation-empty-state"
            class="dn-empty"
        >

            <span
                class="dn-empty-symbol"
                aria-hidden="true"
            >
                <svg class="dn-icon">
                    <use href="#dn-icon-search"/>
                </svg>
            </span>

            <h3>
                No matching donations
            </h3>

            <p>
                Try another search term or clear the current filters.
            </p>

        </div>


        {{-- =========================================================
             FOOTER
             ========================================================= --}}

        <footer class="dn-register-footer">

            <p>
                Showing

                <strong id="donation-visible-range">
                    {{ count($donations) }}
                </strong>

                of

                <strong>
                    {{ count($donations) }}
                </strong>

                donation records.
            </p>


            <span>
                Verified donations may be allocated or added to inventory.
            </span>

        </footer>

    </section>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeDonationsPage = () => {
        const page =
            document.getElementById(
                'donations-page'
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

        const searchInput =
            page.querySelector(
                '#donation-search'
            );


        const statusFilter =
            page.querySelector(
                '#donation-status-filter'
            );


        const categoryFilter =
            page.querySelector(
                '#donation-category-filter'
            );


        const clearFilters =
            page.querySelector(
                '#clear-donation-filters'
            );


        const visibleCount =
            page.querySelector(
                '#donation-visible-count'
            );


        const visibleRange =
            page.querySelector(
                '#donation-visible-range'
            );


        const emptyState =
            page.querySelector(
                '#donation-empty-state'
            );


        const rows =
            Array.from(
                page.querySelectorAll(
                    '[data-donation-row]'
                )
            );


        if (
            !searchInput ||
            !statusFilter ||
            !categoryFilter ||
            !clearFilters ||
            !visibleCount ||
            !visibleRange ||
            !emptyState
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | HELPERS
        |--------------------------------------------------------------------------
        */

        const normalize = (value) => {
            return String(
                value ?? ''
            )
                .trim()
                .toLowerCase();
        };


        /*
        |--------------------------------------------------------------------------
        | FILTERING
        |--------------------------------------------------------------------------
        */

        const applyFilters = () => {
            const search =
                normalize(
                    searchInput.value
                );


            const status =
                normalize(
                    statusFilter.value
                );


            const category =
                normalize(
                    categoryFilter.value
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


                    const rowCategory =
                        normalize(
                            row.dataset.category
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


                    const categoryMatches =
                        !category ||
                        rowCategory ===
                            category;


                    const show =
                        searchMatches &&
                        statusMatches &&
                        categoryMatches;


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


        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener(
            'input',
            applyFilters
        );


        statusFilter.addEventListener(
            'change',
            applyFilters
        );


        categoryFilter.addEventListener(
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


                categoryFilter.value =
                    '';


                applyFilters();


                searchInput.focus();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        applyFilters();
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeDonationsPage,
            {
                once: true
            }
        );
    } else {
        initializeDonationsPage();
    }
})();
</script>
@endpush