@extends('layouts.app')

@section('title', 'Borrow & Return | PULSO Logistics Hub')

@php
    $borrowRecords = [
        [
            'id' => 'BRW-2026-0028',
            'request_id' => 'REQ-2026-0047',
            'borrower' => 'Maria Santos',
            'committee' => 'Events Committee',
            'project' => 'Youth Leadership Summit',
            'released' => 'Sep 12, 2026 · 7:15 AM',
            'due' => 'Sep 12, 2026 · 6:00 PM',
            'due_date' => '2026-09-12',
            'status' => 'Due Soon',
            'items' => [
                [
                    'asset_id' => 'PULSO-AUD-001',
                    'name' => 'Portable Sound System',
                    'quantity' => 1,
                    'condition_out' => 'Good',
                ],
                [
                    'asset_id' => 'PULSO-EQP-001',
                    'name' => 'Projector',
                    'quantity' => 1,
                    'condition_out' => 'Good',
                ],
                [
                    'asset_id' => 'PULSO-FUR-001',
                    'name' => 'Monoblock Chairs',
                    'quantity' => 60,
                    'condition_out' => 'Good',
                ],
            ],
        ],
        [
            'id' => 'BRW-2026-0027',
            'request_id' => 'REQ-2026-0045',
            'borrower' => 'Angela Cruz',
            'committee' => 'Environment & Health',
            'project' => 'Coastal Clean-Up Drive',
            'released' => 'Sep 10, 2026 · 6:40 AM',
            'due' => 'Sep 10, 2026 · 5:00 PM',
            'due_date' => '2026-09-10',
            'status' => 'Overdue',
            'items' => [
                [
                    'asset_id' => 'PULSO-EVT-001',
                    'name' => 'Large Event Tent',
                    'quantity' => 2,
                    'condition_out' => 'Good',
                ],
                [
                    'asset_id' => 'PULSO-ELE-001',
                    'name' => 'Extension Cord 20m',
                    'quantity' => 3,
                    'condition_out' => 'Good',
                ],
            ],
        ],
        [
            'id' => 'BRW-2026-0026',
            'request_id' => 'REQ-2026-0046',
            'borrower' => 'Joshua Reyes',
            'committee' => 'Community Outreach',
            'project' => 'Medical Mission',
            'released' => 'Sep 11, 2026 · 8:00 AM',
            'due' => 'Sep 13, 2026 · 5:00 PM',
            'due_date' => '2026-09-13',
            'status' => 'Borrowed',
            'items' => [
                [
                    'asset_id' => 'PULSO-FUR-002',
                    'name' => 'Folding Tables',
                    'quantity' => 8,
                    'condition_out' => 'Good',
                ],
                [
                    'asset_id' => 'PULSO-ELE-002',
                    'name' => 'Power Strip',
                    'quantity' => 4,
                    'condition_out' => 'Excellent',
                ],
            ],
        ],
        [
            'id' => 'BRW-2026-0025',
            'request_id' => 'REQ-2026-0041',
            'borrower' => 'Nicole Ramos',
            'committee' => 'Volunteer Management',
            'project' => 'PULSO Volunteer Orientation',
            'released' => 'Sep 7, 2026 · 8:20 AM',
            'due' => 'Sep 7, 2026 · 6:00 PM',
            'due_date' => '2026-09-07',
            'returned' => 'Sep 7, 2026 · 5:36 PM',
            'status' => 'Returned',
            'items' => [
                [
                    'asset_id' => 'PULSO-AUD-002',
                    'name' => 'Wireless Microphone Set',
                    'quantity' => 1,
                    'condition_out' => 'Good',
                    'returned_quantity' => 1,
                    'condition_in' => 'Good',
                ],
                [
                    'asset_id' => 'PULSO-EVT-002',
                    'name' => 'PULSO Event Banner',
                    'quantity' => 2,
                    'condition_out' => 'Good',
                    'returned_quantity' => 2,
                    'condition_in' => 'Good',
                ],
            ],
        ],
        [
            'id' => 'BRW-2026-0024',
            'request_id' => 'REQ-2026-0040',
            'borrower' => 'Carlo Mendoza',
            'committee' => 'Education Committee',
            'project' => 'Student Assistance Orientation',
            'released' => 'Sep 6, 2026 · 7:40 AM',
            'due' => 'Sep 6, 2026 · 5:30 PM',
            'due_date' => '2026-09-06',
            'returned' => 'Sep 6, 2026 · 5:15 PM',
            'status' => 'Returned',
            'items' => [
                [
                    'asset_id' => 'PULSO-EQP-001',
                    'name' => 'Projector',
                    'quantity' => 1,
                    'condition_out' => 'Good',
                    'returned_quantity' => 1,
                    'condition_in' => 'Good',
                ],
            ],
        ],
    ];

    $activeBorrowings = collect($borrowRecords)
        ->where('status', '!=', 'Returned')
        ->count();

    $dueSoonBorrowings = collect($borrowRecords)
        ->where('status', 'Due Soon')
        ->count();

    $overdueBorrowings = collect($borrowRecords)
        ->where('status', 'Overdue')
        ->count();

    $returnedBorrowings = collect($borrowRecords)
        ->where('status', 'Returned')
        ->count();

    $summary = [
        [
            'key' => 'active-borrowings',
            'label' => 'Active borrowings',
            'value' => $activeBorrowings,
            'description' => 'Resources still outside',
            'tone' => 'navy',
            'icon' => 'borrow',
        ],
        [
            'key' => 'due-soon',
            'label' => 'Due soon',
            'value' => $dueSoonBorrowings,
            'description' => 'Return expected soon',
            'tone' => 'amber',
            'icon' => 'clock',
        ],
        [
            'key' => 'overdue',
            'label' => 'Overdue',
            'value' => $overdueBorrowings,
            'description' => 'Past expected return',
            'tone' => 'red',
            'icon' => 'alert',
        ],
        [
            'key' => 'returned',
            'label' => 'Returned',
            'value' => $returnedBorrowings,
            'description' => 'Completed records shown',
            'tone' => 'green',
            'icon' => 'return',
        ],
    ];

    $statusClassMap = [
        'Borrowed' => 'borrowed',
        'Due Soon' => 'due',
        'Overdue' => 'overdue',
        'Returned' => 'returned',
    ];
@endphp


@push('styles')
<style>
    .borrow-page {
        --br-navy: #10263d;
        --br-copy: #496580;
        --br-muted: #71899c;
        --br-line: #d5e5ee;

        --br-teal: #007780;
        --br-pink: #b90c61;
        --br-blue: #365f8d;
        --br-red: #ad343d;
        --br-amber: #895408;
        --br-green: #2b735d;

        display: grid;
        gap: 23px;

        width: 100%;
        min-width: 0;

        color: var(--br-navy);

        container-name: borrow-page;
        container-type: inline-size;
    }

    .borrow-page *,
    .borrow-page *::before,
    .borrow-page *::after {
        box-sizing: border-box;
    }

    .br-icon {
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

    .br-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .br-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 26px;

        min-width: 0;
    }

    .br-heading-copy {
        min-width: 0;
    }

    .br-eyebrow {
        margin: 0 0 7px;

        color: var(--br-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .br-heading h1 {
        margin: 0;

        color: var(--br-navy);

        font-size: clamp(30px, 3vw, 42px);
        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.055em;
    }

    .br-heading-description {
        max-width: 700px;

        margin: 10px 0 0;

        color: var(--br-copy);

        font-size: 14px;
        line-height: 1.7;
    }

    .br-heading-note {
        display: flex;
        align-items: center;

        gap: 9px;

        flex-shrink: 0;

        max-width: 265px;

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

    .br-heading-note .br-icon {
        width: 17px;
        height: 17px;

        color: var(--br-teal);
    }


    /* ================================================================
       SUMMARY
       ================================================================ */

    .borrow-page > .br-summary {
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

    .borrow-page > .br-summary::before,
    .borrow-page > .br-summary::after {
        display: none !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    /* ================================================================
       SUMMARY CARD
       ================================================================ */

    .br-summary-card {
        --br-tone: #173b59;

        --br-tone-fill:
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

        transition:
            transform 160ms ease,
            box-shadow 160ms ease;
    }

    .br-summary-card::after {
        position: absolute;

        top: 0;
        right: 17px;

        width: 34px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--br-tone);

        opacity: .52;

        content: "";
    }

    .br-summary-card:hover {
        transform: translateY(-2px);
    }

    .br-summary-icon {
        display: grid;
        place-items: center;

        width: 43px;
        height: 43px;

        flex: 0 0 43px;

        border: 1px solid rgba(255, 255, 255, .98);
        border-radius: 14px;

        background: var(--br-tone-fill);

        color: var(--br-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }

    .br-summary-icon .br-icon {
        width: 18px;
        height: 18px;
    }

    .br-summary-copy {
        min-width: 0;
    }

    .br-summary-value {
        display: block;

        color: var(--br-tone);

        font-size: 26px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.045em;

        font-variant-numeric: tabular-nums;
    }

    .br-summary-label {
        display: block;

        margin-top: 6px;

        color: #29475f;

        font-size: 11.5px;
        font-weight: 750;
    }

    .br-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #70889a;

        font-size: 9.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .br-tone-navy {
        --br-tone: #173b59;

        --br-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }

    .br-tone-teal {
        --br-tone: #007780;

        --br-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }

    .br-tone-blue {
        --br-tone: #365f8d;

        --br-tone-fill:
            linear-gradient(
                145deg,
                #e8f0f8,
                #d7e5f2
            );
    }

    .br-tone-red {
        --br-tone: #ad343d;

        --br-tone-fill:
            linear-gradient(
                145deg,
                #fdecee,
                #f5dadd
            );
    }

    .br-tone-amber {
        --br-tone: #895408;

        --br-tone-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }

    .br-tone-green {
        --br-tone: #2b735d;

        --br-tone-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    /* ================================================================
       FEEDBACK
       ================================================================ */

    .br-feedback {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        padding: 12px 14px;

        border: 1px solid #afdcd0;
        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e5f5ef,
                #d6ece4
            );

        color: #286b57;

        box-shadow:
            inset 2px 2px 5px rgba(72, 116, 100, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .7);

        font-size: 10.5px;
        line-height: 1.55;
    }

    .br-feedback[hidden] {
        display: none !important;
    }

    .br-feedback .br-icon {
        width: 17px;
        height: 17px;

        margin-top: 1px;
    }

    .br-feedback strong {
        display: block;

        margin-bottom: 2px;

        color: #1f614e;
    }


    /* ================================================================
       REGISTER
       ================================================================ */

    .br-register {
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

    .br-register-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        padding: 20px 23px 18px;

        border-bottom: 1px solid rgba(207, 226, 236, .82);
    }

    .br-register-title {
        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;
    }

    .br-register-icon {
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

        color: var(--br-teal);

        box-shadow:
            4px 5px 10px rgba(70, 115, 136, .11),
            -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .br-register-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 780;

        letter-spacing: -.025em;
    }

    .br-register-title p {
        margin: 4px 0 0;

        color: var(--br-copy);

        font-size: 11px;
    }

    .br-register-title p strong {
        color: var(--br-teal);

        font-weight: 800;
    }

    .br-register-tag {
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

    .br-register-tag .br-icon {
        width: 14px;
        height: 14px;

        color: var(--br-teal);
    }


    /* ================================================================
       FILTERS
       ================================================================ */

    .br-filters {
        display: grid;

        grid-template-columns:
            minmax(260px, 1.7fr)
            minmax(150px, .7fr)
            minmax(150px, .7fr)
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

    .br-field {
        min-width: 0;
    }

    .br-field label {
        display: block;

        margin-bottom: 7px;

        color: #3c5a71;

        font-size: 11px;
        font-weight: 750;
    }

    .br-search {
        position: relative;
    }

    .br-search > .br-icon {
        position: absolute;

        top: 50%;
        left: 14px;

        width: 17px;
        height: 17px;

        color: #678398;

        pointer-events: none;

        transform: translateY(-50%);
    }

    .br-input {
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

        color: var(--br-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .15),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 12px;
    }

    .br-search .br-input {
        padding-left: 41px;
    }

    .br-input::placeholder {
        color: #7b91a2;
    }

    .br-input:focus {
        border-color: rgba(0, 126, 137, .48);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .09);
    }

    select.br-input {
        cursor: pointer;
    }

    .br-clear {
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

    .br-clear:hover {
        color: var(--br-teal);
    }

    .br-clear .br-icon {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .br-table-scroll {
        width: 100%;

        overflow-x: auto;

        border-top: 1px solid var(--br-line);
        border-bottom: 1px solid var(--br-line);

        background: rgba(240, 248, 251, .34);
    }

    .br-table {
        width: 100%;
        min-width: 1080px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }

    .br-table th {
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

    .br-table td {
        padding: 14px;

        border-bottom: 1px solid rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 11.2px;

        vertical-align: middle;
    }

    .br-table th:first-child,
    .br-table td:first-child {
        padding-left: 23px;
    }

    .br-table th:last-child,
    .br-table td:last-child {
        padding-right: 23px;
    }

    .br-table tbody tr:hover {
        background: rgba(255, 255, 255, .46);
    }

    .br-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* ================================================================
       RECORD
       ================================================================ */

    .br-record {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 235px;
    }

    .br-record-icon {
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

        color: var(--br-teal);

        box-shadow:
            3px 4px 8px rgba(76, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .78);
    }

    .br-record-icon .br-icon {
        width: 17px;
        height: 17px;
    }

    .br-record-copy {
        min-width: 0;
    }

    .br-record-id {
        display: block;

        color: #70879a;

        font-size: 9.5px;
        font-weight: 650;
    }

    .br-record-name {
        display: block;

        max-width: 230px;

        margin-top: 3px;

        overflow: hidden;

        color: #18344c;

        font-size: 11.8px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .br-secondary {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9.5px;
    }

    .br-items {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        color: #47677d;

        font-size: 10.5px;
        font-weight: 700;

        white-space: nowrap;
    }

    .br-items .br-icon {
        width: 14px;
        height: 14px;

        color: var(--br-teal);
    }

    .br-resource-progress {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9px;
        line-height: 1.45;

        white-space: nowrap;
    }

    .br-resource-progress strong {
        color: #48677d;

        font-weight: 800;
    }


    /* ================================================================
       DATE
       ================================================================ */

    .br-date {
        min-width: 140px;

        white-space: nowrap;
    }

    .br-date strong {
        display: block;

        color: #29475f;

        font-size: 10.7px;
        font-weight: 700;
    }

    .br-date span {
        display: inline-flex;
        align-items: center;

        gap: 5px;

        margin-top: 4px;

        color: #71899c;

        font-size: 9.5px;
    }

    .br-date span::before {
        width: 5px;
        height: 5px;

        border-radius: 50%;

        background: #8399a9;

        content: "";
    }

    .br-date-due span {
        color: #895408;
    }

    .br-date-due span::before {
        background: #c7861e;
    }

    .br-date-overdue strong,
    .br-date-overdue span {
        color: #a2343e;
    }

    .br-date-overdue span::before {
        background: #c44a54;
    }

    .br-date-returned span {
        color: #2b735d;
    }

    .br-date-returned span::before {
        background: #439476;
    }


    /* ================================================================
       STATUS
       ================================================================ */

    .br-badge {
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

    .br-status-borrowed {
        border-color: #bfd3e7;

        background:
            linear-gradient(
                145deg,
                #e9f1fa,
                #d1e1f0
            );

        color: #315b88;
    }

    .br-status-due {
        border-color: #efd39a;

        background:
            linear-gradient(
                145deg,
                #fff4d8,
                #f7e1ae
            );

        color: #885704;
    }

    .br-status-overdue {
        border-color: #edb9bf;

        background:
            linear-gradient(
                145deg,
                #fde7e9,
                #f2ccd1
            );

        color: #a32f39;
    }

    .br-status-returned {
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
       ACTIONS
       ================================================================ */

    .br-action-heading,
    .br-action-cell {
        min-width: 105px;

        text-align: center;
    }

    .br-actions {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;
    }

    .br-action {
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

        color: var(--br-teal);

        box-shadow:
            3px 4px 8px rgba(79, 112, 133, .1),
            -2px -2px 6px rgba(255, 255, 255, .76);

        text-decoration: none;

        cursor: pointer;

        transition:
            transform 150ms ease,
            background 150ms ease;
    }

    .br-action:hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #effcfc,
                #cae9ec
            );

        color: #006c74;

        transform: translateY(-1px);
    }

    .br-action .br-icon {
        width: 17px;
        height: 17px;
    }

    .br-action-return {
        background:
            linear-gradient(
                145deg,
                #fff0f7,
                #f4d7e5
            );

        color: var(--br-pink);
    }

    .br-action-return:hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #fff5fa,
                #f1cede
            );

        color: var(--br-pink);
    }

    .br-action:disabled {
        opacity: .38;

        cursor: not-allowed;

        transform: none;
    }


    /* ================================================================
       EMPTY + FOOTER
       ================================================================ */

    .br-empty {
        display: none;

        padding: 48px 24px;

        text-align: center;
    }

    .br-empty.is-visible {
        display: block;
    }

    .br-empty-symbol {
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

    .br-empty-symbol .br-icon {
        width: 23px;
        height: 23px;
    }

    .br-empty h3 {
        margin: 0;

        color: #29475f;

        font-size: 15px;
    }

    .br-empty p {
        margin: 6px 0 0;

        color: var(--br-muted);

        font-size: 11px;
    }

    .br-register-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 10px 20px;

        padding: 15px 23px;

        color: var(--br-muted);

        font-size: 10.5px;
    }

    .br-register-footer p {
        margin: 0;
    }

    .br-register-footer strong {
        color: #29475f;
    }


    /* ================================================================
       RETURN MODAL
       ================================================================ */

    .br-modal {
        position: fixed;
        inset: 0;
        z-index: 110;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 20px;

        background: rgba(16, 38, 61, .54);

        backdrop-filter: blur(5px);
    }

    .br-modal.is-open {
        display: flex;
    }

    .br-modal-panel {
        width: min(100%, 760px);
        max-height: calc(100vh - 40px);

        overflow-y: auto;

        border: 1px solid rgba(255, 255, 255, .98);
        border-radius: 21px;

        background:
            linear-gradient(
                145deg,
                #f8fcfe,
                #e5f0f5
            );

        box-shadow:
            12px 16px 36px rgba(38, 66, 84, .27),
            -5px -5px 15px rgba(255, 255, 255, .65);
    }

    .br-modal-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 18px;

        padding: 20px 21px 17px;

        border-bottom: 1px solid var(--br-line);
    }

    .br-modal-title-wrap {
        display: flex;
        align-items: center;

        gap: 12px;

        min-width: 0;
    }

    .br-modal-symbol {
        display: grid;
        place-items: center;

        width: 43px;
        height: 43px;

        flex: 0 0 43px;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #caecef
            );

        color: var(--br-teal);
    }

    .br-modal-symbol .br-icon {
        width: 18px;
        height: 18px;
    }

    .br-modal-head h2 {
        margin: 0;

        color: #18344c;

        font-size: 18px;
        font-weight: 800;
    }

    .br-modal-head p {
        margin: 4px 0 0;

        color: var(--br-muted);

        font-size: 10px;
    }

    .br-modal-close {
        display: grid;
        place-items: center;

        width: 35px;
        height: 35px;

        flex: 0 0 35px;

        padding: 0;

        border: 1px solid rgba(255, 255, 255, .92);
        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #f3f8fa,
                #e0eaef
            );

        color: #60798d;

        cursor: pointer;
    }

    .br-modal-close .br-icon {
        width: 15px;
        height: 15px;
    }

    .br-modal-body {
        padding: 20px 21px;
    }

    .br-return-intro {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        margin-bottom: 17px;

        padding: 11px 12px;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e4f4f6,
                #edf7f9
            );

        color: #567287;

        font-size: 10px;
        line-height: 1.55;
    }

    .br-return-intro .br-icon {
        width: 16px;
        height: 16px;

        flex: 0 0 16px;

        margin-top: 1px;

        color: var(--br-teal);
    }

    .br-return-row {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr)
            105px
            155px;

        align-items: end;

        gap: 12px;

        padding: 13px;

        border: 1px solid rgba(255, 255, 255, .88);
        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #eaf3f7,
                #f1f7f9
            );

        box-shadow:
            inset 2px 2px 5px rgba(80, 113, 134, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .72);
    }

    .br-return-row + .br-return-row {
        margin-top: 10px;
    }

    .br-return-row.is-complete {
        opacity: .66;
    }

    .br-return-item {
        min-width: 0;
    }

    .br-return-item strong {
        display: block;

        color: #29475f;

        font-size: 10.8px;
    }

    .br-return-item span {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 9px;
        line-height: 1.5;
    }

    .br-return-item-progress {
        color: #49677d !important;

        font-weight: 700;
    }

    .br-return-field label {
        display: block;

        margin-bottom: 5px;

        color: #526f84;

        font-size: 9px;
        font-weight: 700;
    }

    .br-return-input,
    .br-return-select,
    .br-return-notes {
        width: 100%;

        border: 1px solid #cedfe8;
        border-radius: 11px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e5eef3,
                #edf5f8
            );

        color: var(--br-navy);

        box-shadow:
            inset 3px 3px 6px rgba(91, 125, 147, .12),
            inset -3px -3px 6px rgba(255, 255, 255, .82);

        font: inherit;
        font-size: 10px;
    }

    .br-return-input,
    .br-return-select {
        min-height: 38px;

        padding: 7px 9px;
    }

    .br-return-input:disabled,
    .br-return-select:disabled {
        opacity: .6;

        cursor: not-allowed;
    }

    .br-return-notes {
        min-height: 80px;

        padding: 9px 10px;

        resize: vertical;
    }

    .br-return-warning {
        display: none;
        align-items: flex-start;

        gap: 7px;

        grid-column: 1 / -1;

        padding: 8px 10px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #fff0e4,
                #f7e0c8
            );

        color: #8a570b;

        font-size: 9px;
        line-height: 1.5;
    }

    .br-return-warning.is-visible {
        display: flex;
    }

    .br-return-warning .br-icon {
        width: 14px;
        height: 14px;

        flex: 0 0 14px;

        margin-top: 1px;
    }

    .br-return-complete {
        display: inline-flex;
        align-items: center;

        gap: 5px;

        min-height: 29px;

        padding: 5px 8px;

        border-radius: 9px;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;

        font-size: 8.5px;
        font-weight: 800;
    }

    .br-return-complete .br-icon {
        width: 13px;
        height: 13px;
    }

    .br-notes-field {
        margin-top: 15px;
    }

    .br-notes-field label {
        display: block;

        margin-bottom: 6px;

        color: #3f6077;

        font-size: 10px;
        font-weight: 750;
    }

    .br-modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 10px;

        padding: 16px 21px 20px;

        border-top: 1px solid var(--br-line);
    }

    .br-modal-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 42px;

        padding: 9px 14px;

        border-radius: 12px;

        font: inherit;
        font-size: 10.5px;
        font-weight: 750;

        cursor: pointer;
    }

    .br-modal-cancel {
        border: 1px solid rgba(255, 255, 255, .94);

        background:
            linear-gradient(
                145deg,
                #f4f9fb,
                #e2edf2
            );

        color: #48667b;
    }

    .br-modal-primary {
        border: 1px solid #bff8fa;

        background:
            linear-gradient(
                145deg,
                #00858e,
                #00747f
            );

        color: #ffffff;
    }

    .br-modal-primary:disabled {
        opacity: .45;

        cursor: not-allowed;
    }

    .br-modal-button .br-icon {
        width: 15px;
        height: 15px;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container borrow-page (max-width: 1000px) {
        .br-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }

        .borrow-page > .br-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .br-filters {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .br-search-field {
            grid-column: 1 / -1;
        }

        .br-clear {
            justify-self: start;
        }
    }

    @container borrow-page (max-width: 700px) {
        .br-return-row {
            grid-template-columns:
                minmax(0, 1fr)
                minmax(100px, .6fr);
        }

        .br-return-item {
            grid-column: 1 / -1;
        }
    }

    @container borrow-page (max-width: 600px) {
        .borrow-page > .br-summary {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .br-register-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .br-filters {
            grid-template-columns:
                minmax(0, 1fr);

            padding: 17px 16px;
        }

        .br-search-field {
            grid-column: auto;
        }

        .br-clear {
            width: 100%;
        }

        .br-register-footer {
            padding: 14px 16px;
        }

        .br-return-row {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .br-return-item,
        .br-return-warning {
            grid-column: auto;
        }

        .br-modal-footer {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);

            padding: 15px 16px 18px;
        }

        .br-modal-button {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')
<div
    id="borrow-page"
    class="borrow-page"
>

    <svg
        class="br-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="br-icon-borrow" viewBox="0 0 24 24">
            <path d="M4 7h12"/>
            <path d="m12 3 4 4-4 4"/>
            <path d="M20 13v2a4 4 0 0 1-4 4H6"/>
        </symbol>

        <symbol id="br-icon-return" viewBox="0 0 24 24">
            <path d="M20 7H8"/>
            <path d="m12 3-4 4 4 4"/>
            <path d="M4 13v2a4 4 0 0 0 4 4h10"/>
        </symbol>

        <symbol id="br-icon-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="br-icon-alert" viewBox="0 0 24 24">
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol id="br-icon-search" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
        </symbol>

        <symbol id="br-icon-filter" viewBox="0 0 24 24">
            <path d="M4 5h16"/>
            <path d="M7 12h10"/>
            <path d="M10 19h4"/>
            <path d="m5 5 14 14"/>
        </symbol>

        <symbol id="br-icon-box" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="br-icon-eye" viewBox="0 0 24 24">
            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
            <circle cx="12" cy="12" r="2.5"/>
        </symbol>

        <symbol id="br-icon-x" viewBox="0 0 24 24">
            <path d="m6 6 12 12"/>
            <path d="m18 6-12 12"/>
        </symbol>

        <symbol id="br-icon-info" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </symbol>

        <symbol id="br-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="br-icon-empty" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
        </symbol>
    </svg>


    <header class="br-heading">

        <div class="br-heading-copy">

            <p class="br-eyebrow">
                Resource accountability
            </p>

            <h1>
                Borrow & Return
            </h1>

            <p class="br-heading-description">
                Track released equipment and reusable resources,
                monitor expected return schedules, and record the
                condition of items when they are returned.
            </p>

        </div>


        <div class="br-heading-note">

            <svg
                class="br-icon"
                aria-hidden="true"
            >
                <use href="#br-icon-info"/>
            </svg>

            <span>
                Records begin after resources are released.
            </span>

        </div>

    </header>


    <section
        class="br-summary"
        aria-label="Borrow and return summary"
    >

        @foreach ($summary as $item)

            <article
                class="
                    br-summary-card
                    br-tone-{{ $item['tone'] }}
                "
            >

                <span
                    class="br-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="br-icon">
                        <use href="#br-icon-{{ $item['icon'] }}"/>
                    </svg>
                </span>


                <div class="br-summary-copy">

                    <strong
                        class="br-summary-value"
                        data-summary="{{ $item['key'] }}"
                    >
                        {{ sprintf('%02d', $item['value']) }}
                    </strong>

                    <span class="br-summary-label">
                        {{ $item['label'] }}
                    </span>

                    <span class="br-summary-description">
                        {{ $item['description'] }}
                    </span>

                </div>

            </article>

        @endforeach

    </section>


    <div
        id="borrow-feedback"
        class="br-feedback"
        role="status"
        aria-live="polite"
        hidden
    >
        <svg
            class="br-icon"
            aria-hidden="true"
        >
            <use href="#br-icon-check"/>
        </svg>

        <div>
            <strong id="borrow-feedback-title">
                Return recorded.
            </strong>

            <span id="borrow-feedback-message">
                The borrowing record has been updated in this browser preview.
            </span>
        </div>
    </div>


    <section
        class="br-register"
        aria-labelledby="borrow-register-title"
    >

        <header class="br-register-head">

            <div class="br-register-title">

                <span
                    class="br-register-icon"
                    aria-hidden="true"
                >
                    <svg class="br-icon">
                        <use href="#br-icon-borrow"/>
                    </svg>
                </span>

                <div>

                    <h2 id="borrow-register-title">
                        Borrowing register
                    </h2>

                    <p>
                        <strong id="borrow-visible-count">
                            {{ count($borrowRecords) }}
                        </strong>

                        matching records
                    </p>

                </div>

            </div>


            <span class="br-register-tag">

                <svg
                    class="br-icon"
                    aria-hidden="true"
                >
                    <use href="#br-icon-clock"/>
                </svg>

                Return monitoring

            </span>

        </header>


        <div
            class="br-filters"
            role="search"
            aria-label="Search and filter borrowing records"
        >

            <div class="br-field br-search-field">

                <label for="borrow-search">
                    Search records
                </label>

                <div class="br-search">

                    <svg
                        class="br-icon"
                        aria-hidden="true"
                    >
                        <use href="#br-icon-search"/>
                    </svg>

                    <input
                        id="borrow-search"
                        class="br-input"
                        type="search"
                        placeholder="Borrow ID, project, borrower, committee..."
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="br-field">

                <label for="borrow-status-filter">
                    Status
                </label>

                <select
                    id="borrow-status-filter"
                    class="br-input"
                >
                    <option value="">
                        All statuses
                    </option>

                    <option value="Borrowed">
                        Borrowed
                    </option>

                    <option value="Due Soon">
                        Due Soon
                    </option>

                    <option value="Overdue">
                        Overdue
                    </option>

                    <option value="Returned">
                        Returned
                    </option>
                </select>

            </div>


            <div class="br-field">

                <label for="borrow-state-filter">
                    Record type
                </label>

                <select
                    id="borrow-state-filter"
                    class="br-input"
                >
                    <option value="">
                        All records
                    </option>

                    <option value="active">
                        Active
                    </option>

                    <option value="returned">
                        Returned
                    </option>
                </select>

            </div>


            <button
                id="clear-borrow-filters"
                class="br-clear"
                type="button"
            >
                <svg
                    class="br-icon"
                    aria-hidden="true"
                >
                    <use href="#br-icon-filter"/>
                </svg>

                Clear filters
            </button>

        </div>


        <div
            class="br-table-scroll custom-scrollbar"
            role="region"
            aria-label="Borrowing records"
            tabindex="0"
        >

            <table class="br-table">

                <caption class="sr-only">
                    Borrowing records showing projects, borrowers,
                    resources, release dates, expected returns,
                    statuses, and actions.
                </caption>

                <thead>
                    <tr>
                        <th scope="col">
                            Borrow record
                        </th>

                        <th scope="col">
                            Borrower
                        </th>

                        <th scope="col">
                            Resources
                        </th>

                        <th scope="col">
                            Released
                        </th>

                        <th scope="col">
                            Due / Returned
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th
                            scope="col"
                            class="br-action-heading"
                        >
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($borrowRecords as $index => $record)

                        @php
                            $isReturned =
                                $record['status'] === 'Returned';

                            $itemCount =
                                collect($record['items'])
                                    ->sum('quantity');

                            $dateClass = match ($record['status']) {
                                'Due Soon' => 'br-date-due',
                                'Overdue' => 'br-date-overdue',
                                'Returned' => 'br-date-returned',
                                default => '',
                            };
                        @endphp

                        <tr
                            data-borrow-row
                            data-record-index="{{ $index }}"
                            data-record-id="{{ $record['id'] }}"
                            data-status="{{ $record['status'] }}"
                            data-state="{{ $isReturned ? 'returned' : 'active' }}"
                            data-search="{{ strtolower(
                                $record['id']
                                . ' '
                                . $record['request_id']
                                . ' '
                                . $record['project']
                                . ' '
                                . $record['borrower']
                                . ' '
                                . $record['committee']
                            ) }}"
                        >

                            <td>

                                <div class="br-record">

                                    <span
                                        class="br-record-icon"
                                        aria-hidden="true"
                                    >
                                        <svg class="br-icon">
                                            <use href="#br-icon-borrow"/>
                                        </svg>
                                    </span>

                                    <div class="br-record-copy">

                                        <span class="br-record-id">
                                            {{ $record['id'] }}
                                            ·
                                            {{ $record['request_id'] }}
                                        </span>

                                        <span class="br-record-name">
                                            {{ $record['project'] }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <strong>
                                    {{ $record['borrower'] }}
                                </strong>

                                <span class="br-secondary">
                                    {{ $record['committee'] }}
                                </span>

                            </td>


                            <td data-record-resource-cell>

                                <span class="br-items">

                                    <svg
                                        class="br-icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#br-icon-box"/>
                                    </svg>

                                    <span data-total-units>
                                        {{ $itemCount }}
                                    </span>

                                    {{ $itemCount === 1 ? 'unit' : 'units' }}

                                </span>

                                <span
                                    class="br-resource-progress"
                                    data-record-resource-progress
                                >
                                    {{ count($record['items']) }}

                                    {{ count($record['items']) === 1 ? 'resource type' : 'resource types' }}
                                </span>

                            </td>


                            <td>

                                <div class="br-date">

                                    <strong>
                                        {{ $record['released'] }}
                                    </strong>

                                    <span>
                                        Released
                                    </span>

                                </div>

                            </td>


                            <td data-record-date-cell>

                                <div
                                    class="
                                        br-date
                                        {{ $dateClass }}
                                    "
                                >

                                    @if ($isReturned)

                                        <strong>
                                            {{ $record['returned'] }}
                                        </strong>

                                        <span>
                                            Returned
                                        </span>

                                    @else

                                        <strong>
                                            {{ $record['due'] }}
                                        </strong>

                                        <span>
                                            {{ $record['status'] === 'Overdue' ? 'Past expected return' : 'Expected return' }}
                                        </span>

                                    @endif

                                </div>

                            </td>


                            <td>

                                <span
                                    class="
                                        br-badge
                                        br-status-{{ $statusClassMap[$record['status']] }}
                                    "
                                    data-record-status
                                >
                                    {{ $record['status'] }}
                                </span>

                            </td>


                            <td class="br-action-cell">

                                <div class="br-actions">

                                    <a
                                        href="{{ route('borrow.show', ['id' => $record['id']]) }}"
                                        class="br-action"
                                        title="View borrowing details"
                                        aria-label="View {{ $record['id'] }}"
                                    >
                                        <svg
                                            class="br-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#br-icon-eye"/>
                                        </svg>
                                    </a>


                                    <button
                                        type="button"
                                        class="
                                            br-action
                                            br-action-return
                                        "
                                        data-return-borrow="{{ $index }}"
                                        title="{{ $isReturned ? 'Already returned' : 'Process return' }}"
                                        aria-label="Process return for {{ $record['id'] }}"
                                        @disabled($isReturned)
                                    >
                                        <svg
                                            class="br-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#br-icon-return"/>
                                        </svg>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <div
            id="borrow-empty-state"
            class="br-empty"
        >

            <span
                class="br-empty-symbol"
                aria-hidden="true"
            >
                <svg class="br-icon">
                    <use href="#br-icon-empty"/>
                </svg>
            </span>

            <h3>
                No matching records
            </h3>

            <p>
                Try another search term or clear the current filters.
            </p>

        </div>


        <footer class="br-register-footer">

            <p>
                Showing

                <strong id="borrow-visible-range">
                    {{ count($borrowRecords) }}
                </strong>

                of

                <strong>
                    {{ count($borrowRecords) }}
                </strong>

                sample records.
            </p>

            <span>
                Return actions are front-end previews.
            </span>

        </footer>

    </section>


    <div
        id="borrow-return-modal"
        class="br-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="borrow-return-title"
        aria-hidden="true"
    >

        <div
            class="
                br-modal-panel
                custom-scrollbar
            "
        >

            <header class="br-modal-head">

                <div class="br-modal-title-wrap">

                    <span
                        class="br-modal-symbol"
                        aria-hidden="true"
                    >
                        <svg class="br-icon">
                            <use href="#br-icon-return"/>
                        </svg>
                    </span>

                    <div>

                        <h2 id="borrow-return-title">
                            Process return
                        </h2>

                        <p id="borrow-return-subtitle">
                            Inspect resources before confirming
                        </p>

                    </div>

                </div>


                <button
                    id="close-return-modal"
                    type="button"
                    class="br-modal-close"
                    aria-label="Close"
                >
                    <svg
                        class="br-icon"
                        aria-hidden="true"
                    >
                        <use href="#br-icon-x"/>
                    </svg>
                </button>

            </header>


            <div class="br-modal-body">

                <div class="br-return-intro">

                    <svg
                        class="br-icon"
                        aria-hidden="true"
                    >
                        <use href="#br-icon-info"/>
                    </svg>

                    <span>
                        Enter the quantity received in this return batch.
                        Resources that are already fully returned are locked.
                        Any remaining quantity will stay assigned to the borrower.
                    </span>

                </div>


                <div id="return-item-list"></div>


                <div class="br-notes-field">

                    <label for="return-notes">
                        Return notes
                    </label>

                    <textarea
                        id="return-notes"
                        class="br-return-notes"
                        maxlength="1000"
                        placeholder="Add inspection findings, damage details, missing items, or other return remarks."
                    ></textarea>

                </div>

            </div>


            <footer class="br-modal-footer">

                <button
                    id="cancel-return"
                    type="button"
                    class="
                        br-modal-button
                        br-modal-cancel
                    "
                >
                    Cancel
                </button>


                <button
                    id="confirm-return"
                    type="button"
                    class="
                        br-modal-button
                        br-modal-primary
                    "
                >
                    <svg
                        class="br-icon"
                        aria-hidden="true"
                    >
                        <use href="#br-icon-check"/>
                    </svg>

                    Record return
                </button>

            </footer>

        </div>

    </div>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeBorrowPage = () => {
        const page =
            document.getElementById(
                'borrow-page'
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


        const records =
            @json($borrowRecords);


        /*
        |--------------------------------------------------------------------------
        | SHARED RETURN STORAGE
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | This is the same storage key used by the dedicated
        | borrow/show.blade.php page.
        |
        | Because both pages use the same item-level return events,
        | returns recorded on either page stay synchronized.
        |
        */

        const ITEM_STATE_KEY =
            'pulso-borrow-item-returns-v1';


        const SNAPSHOT_DATE =
            '2026-09-12';


        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const searchInput =
            page.querySelector(
                '#borrow-search'
            );


        const statusFilter =
            page.querySelector(
                '#borrow-status-filter'
            );


        const stateFilter =
            page.querySelector(
                '#borrow-state-filter'
            );


        const clearFilters =
            page.querySelector(
                '#clear-borrow-filters'
            );


        const visibleCount =
            page.querySelector(
                '#borrow-visible-count'
            );


        const visibleRange =
            page.querySelector(
                '#borrow-visible-range'
            );


        const emptyState =
            page.querySelector(
                '#borrow-empty-state'
            );


        const feedback =
            page.querySelector(
                '#borrow-feedback'
            );


        const feedbackTitle =
            page.querySelector(
                '#borrow-feedback-title'
            );


        const feedbackMessage =
            page.querySelector(
                '#borrow-feedback-message'
            );


        const returnModal =
            page.querySelector(
                '#borrow-return-modal'
            );


        const returnSubtitle =
            page.querySelector(
                '#borrow-return-subtitle'
            );


        const returnItemList =
            page.querySelector(
                '#return-item-list'
            );


        const returnNotes =
            page.querySelector(
                '#return-notes'
            );


        const closeReturnButton =
            page.querySelector(
                '#close-return-modal'
            );


        const cancelReturn =
            page.querySelector(
                '#cancel-return'
            );


        const confirmReturn =
            page.querySelector(
                '#confirm-return'
            );


        if (
            !searchInput ||
            !statusFilter ||
            !stateFilter ||
            !clearFilters ||
            !visibleCount ||
            !visibleRange ||
            !emptyState ||
            !feedback ||
            !feedbackTitle ||
            !feedbackMessage ||
            !returnModal ||
            !returnSubtitle ||
            !returnItemList ||
            !returnNotes ||
            !closeReturnButton ||
            !cancelReturn ||
            !confirmReturn
        ) {
            return;
        }


        let selectedRecordIndex =
            null;


        let lastFocusedElement =
            null;


        let previousBodyOverflow =
            '';


        /*
        |--------------------------------------------------------------------------
        | BASIC HELPERS
        |--------------------------------------------------------------------------
        */

        const normalize = (value) => {
            return String(
                value ?? ''
            )
                .trim()
                .toLowerCase();
        };


        const escapeHtml = (value) => {
            const container =
                document.createElement(
                    'div'
                );


            container.textContent =
                String(
                    value ?? ''
                );


            return container.innerHTML;
        };


        const getRows = () => {
            return Array.from(
                page.querySelectorAll(
                    '[data-borrow-row]'
                )
            );
        };


        const getRecord = (index) => {
            return records[
                Number(
                    index
                )
            ];
        };


        const showFeedback = (
            title,
            message
        ) => {
            feedbackTitle.textContent =
                title;


            feedbackMessage.textContent =
                message;


            feedback.hidden =
                false;
        };


        /*
        |--------------------------------------------------------------------------
        | SHARED STORAGE
        |--------------------------------------------------------------------------
        */

        const loadItemState = () => {
            try {
                const raw =
                    window.sessionStorage.getItem(
                        ITEM_STATE_KEY
                    );


                if (!raw) {
                    return {};
                }


                const parsed =
                    JSON.parse(
                        raw
                    );


                if (
                    !parsed ||
                    typeof parsed !==
                        'object' ||
                    Array.isArray(
                        parsed
                    )
                ) {
                    return {};
                }


                return parsed;
            } catch {
                return {};
            }
        };


        const saveItemState = (state) => {
            try {
                window.sessionStorage.setItem(
                    ITEM_STATE_KEY,
                    JSON.stringify(
                        state
                    )
                );
            } catch {
                throw new Error(
                    'The return could not be saved in this browser tab.'
                );
            }
        };


        const getEventsForRecord = (
            recordId
        ) => {
            const state =
                loadItemState();


            const events =
                state[
                    recordId
                ];


            if (
                !Array.isArray(
                    events
                )
            ) {
                return [];
            }


            return events.filter(
                (entry) => {
                    return (
                        entry &&
                        typeof entry.asset_id ===
                            'string' &&
                        Number.isSafeInteger(
                            entry.quantity
                        ) &&
                        entry.quantity > 0 &&
                        typeof entry.condition ===
                            'string' &&
                        typeof entry.at ===
                            'string'
                    );
                }
            );
        };


        const appendReturnEvents = (
            recordId,
            events
        ) => {
            const state =
                loadItemState();


            if (
                !Array.isArray(
                    state[
                        recordId
                    ]
                )
            ) {
                state[
                    recordId
                ] = [];
            }


            state[
                recordId
            ].push(
                ...events
            );


            saveItemState(
                state
            );


            window.dispatchEvent(
                new CustomEvent(
                    'pulso:borrow-item-returns-updated',
                    {
                        detail: {
                            recordId
                        }
                    }
                )
            );
        };


        /*
        |--------------------------------------------------------------------------
        | ITEM + RECORD CALCULATIONS
        |--------------------------------------------------------------------------
        */

        const getItemStats = (
            record
        ) => {
            const events =
                getEventsForRecord(
                    record.id
                );


            return record.items.map(
                (item) => {
                    const openingReturned =
                        Math.min(
                            Number(
                                item.quantity
                            ),
                            Math.max(
                                0,
                                Number(
                                    item.returned_quantity ??
                                    0
                                )
                            )
                        );


                    const eventReturned =
                        events
                            .filter(
                                (entry) => {
                                    return (
                                        entry.asset_id ===
                                        item.asset_id
                                    );
                                }
                            )
                            .reduce(
                                (
                                    total,
                                    entry
                                ) => {
                                    return (
                                        total +
                                        Number(
                                            entry.quantity
                                        )
                                    );
                                },
                                0
                            );


                    const returned =
                        Math.min(
                            Number(
                                item.quantity
                            ),
                            openingReturned +
                            eventReturned
                        );


                    const remaining =
                        Math.max(
                            0,
                            Number(
                                item.quantity
                            ) -
                            returned
                        );


                    return {
                        ...item,

                        openingReturned,

                        eventReturned,

                        returned,

                        remaining,

                        isComplete:
                            remaining ===
                            0
                    };
                }
            );
        };


        const getRecordStats = (
            record
        ) => {
            const items =
                getItemStats(
                    record
                );


            const borrowed =
                items.reduce(
                    (
                        total,
                        item
                    ) => {
                        return (
                            total +
                            Number(
                                item.quantity
                            )
                        );
                    },
                    0
                );


            const returned =
                items.reduce(
                    (
                        total,
                        item
                    ) => {
                        return (
                            total +
                            item.returned
                        );
                    },
                    0
                );


            const remaining =
                Math.max(
                    0,
                    borrowed -
                    returned
                );


            const dueDate =
                record.due_date;


            const dueTime =
                Date.parse(
                    `${dueDate}T00:00:00Z`
                );


            const snapshotTime =
                Date.parse(
                    `${SNAPSHOT_DATE}T00:00:00Z`
                );


            let status;


            if (
                remaining ===
                0
            ) {
                status =
                    'Returned';
            } else if (
                dueTime <
                snapshotTime
            ) {
                status =
                    'Overdue';
            } else if (
                dueTime ===
                snapshotTime
            ) {
                status =
                    'Due Soon';
            } else {
                status =
                    'Borrowed';
            }


            const events =
                getEventsForRecord(
                    record.id
                );


            return {
                items,

                borrowed,

                returned,

                remaining,

                status,

                isReturned:
                    remaining ===
                    0,

                hasPreviewReturns:
                    events.length >
                    0,

                returnedResourceTypes:
                    items.filter(
                        (item) => {
                            return (
                                item.remaining ===
                                0
                            );
                        }
                    ).length
            };
        };


        /*
        |--------------------------------------------------------------------------
        | STATUS HELPERS
        |--------------------------------------------------------------------------
        */

        const getStatusClass = (
            status
        ) => {
            if (
                status ===
                'Returned'
            ) {
                return 'br-status-returned';
            }


            if (
                status ===
                'Overdue'
            ) {
                return 'br-status-overdue';
            }


            if (
                status ===
                'Due Soon'
            ) {
                return 'br-status-due';
            }


            return 'br-status-borrowed';
        };


        const getDateClass = (
            status
        ) => {
            if (
                status ===
                'Returned'
            ) {
                return 'br-date-returned';
            }


            if (
                status ===
                'Overdue'
            ) {
                return 'br-date-overdue';
            }


            if (
                status ===
                'Due Soon'
            ) {
                return 'br-date-due';
            }


            return '';
        };


        /*
        |--------------------------------------------------------------------------
        | ROW RENDERING
        |--------------------------------------------------------------------------
        */

        const updateRecordRow = (
            record,
            index
        ) => {
            const row =
                page.querySelector(
                    `[data-record-index="${index}"]`
                );


            if (!row) {
                return;
            }


            const stats =
                getRecordStats(
                    record
                );


            row.dataset.status =
                stats.status;


            row.dataset.state =
                stats.isReturned
                    ? 'returned'
                    : 'active';


            const statusBadge =
                row.querySelector(
                    '[data-record-status]'
                );


            if (
                statusBadge
            ) {
                statusBadge.textContent =
                    stats.status;


                statusBadge.className =
                    `br-badge ${getStatusClass(stats.status)}`;


                statusBadge.setAttribute(
                    'data-record-status',
                    ''
                );
            }


            const progress =
                row.querySelector(
                    '[data-record-resource-progress]'
                );


            if (
                progress
            ) {
                const typeCount =
                    stats.items.length;


                const typeLabel =
                    typeCount === 1
                        ? 'resource type'
                        : 'resource types';


                if (
                    stats.remaining ===
                    0
                ) {
                    progress.innerHTML =
                        `${typeCount} ${typeLabel} · <strong>all returned</strong>`;
                } else if (
                    stats.returned >
                    0
                ) {
                    progress.innerHTML =
                        `${typeCount} ${typeLabel} · <strong>${stats.remaining} remaining</strong>`;
                } else {
                    progress.textContent =
                        `${typeCount} ${typeLabel}`;
                }
            }


            const dateCell =
                row.querySelector(
                    '[data-record-date-cell]'
                );


            if (
                dateCell
            ) {
                const dateClass =
                    getDateClass(
                        stats.status
                    );


                if (
                    stats.isReturned
                ) {
                    const returnedLabel =
                        stats.hasPreviewReturns
                            ? 'Browser preview'
                            : (
                                record.returned ??
                                'Returned'
                            );


                    dateCell.innerHTML = `
                        <div
                            class="
                                br-date
                                ${dateClass}
                            "
                        >
                            <strong>
                                ${escapeHtml(returnedLabel)}
                            </strong>

                            <span>
                                Returned
                            </span>
                        </div>
                    `;
                } else {
                    dateCell.innerHTML = `
                        <div
                            class="
                                br-date
                                ${dateClass}
                            "
                        >
                            <strong>
                                ${escapeHtml(record.due)}
                            </strong>

                            <span>
                                ${
                                    stats.status ===
                                    'Overdue'
                                        ? 'Past expected return'
                                        : 'Expected return'
                                }
                            </span>
                        </div>
                    `;
                }
            }


            const returnButton =
                row.querySelector(
                    '[data-return-borrow]'
                );


            if (
                returnButton
            ) {
                returnButton.disabled =
                    stats.isReturned;


                returnButton.title =
                    stats.isReturned
                        ? 'Already returned'
                        : 'Process return';


                returnButton.setAttribute(
                    'aria-label',
                    stats.isReturned
                        ? `${record.id} already returned`
                        : `Process return for ${record.id}`
                );
            }
        };


        const refreshRecords = () => {
            records.forEach(
                (
                    record,
                    index
                ) => {
                    updateRecordRow(
                        record,
                        index
                    );
                }
            );


            updateSummary();

            applyFilters();
        };


        /*
        |--------------------------------------------------------------------------
        | KPI UPDATE
        |--------------------------------------------------------------------------
        */

        const updateSummary = () => {
            const stats =
                records.map(
                    (record) => {
                        return getRecordStats(
                            record
                        );
                    }
                );


            const values = {
                'active-borrowings':
                    stats.filter(
                        (recordStats) => {
                            return (
                                !recordStats.isReturned
                            );
                        }
                    ).length,

                'due-soon':
                    stats.filter(
                        (recordStats) => {
                            return (
                                recordStats.status ===
                                'Due Soon'
                            );
                        }
                    ).length,

                'overdue':
                    stats.filter(
                        (recordStats) => {
                            return (
                                recordStats.status ===
                                'Overdue'
                            );
                        }
                    ).length,

                'returned':
                    stats.filter(
                        (recordStats) => {
                            return (
                                recordStats.status ===
                                'Returned'
                            );
                        }
                    ).length
            };


            Object.entries(
                values
            ).forEach(
                (
                    [
                        key,
                        value
                    ]
                ) => {
                    const element =
                        page.querySelector(
                            `[data-summary="${key}"]`
                        );


                    if (
                        element
                    ) {
                        element.textContent =
                            String(
                                value
                            ).padStart(
                                2,
                                '0'
                            );
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
            const search =
                normalize(
                    searchInput.value
                );


            const status =
                normalize(
                    statusFilter.value
                );


            const state =
                normalize(
                    stateFilter.value
                );


            let visible =
                0;


            getRows().forEach(
                (row) => {
                    const matchesSearch =
                        !search ||
                        normalize(
                            row.dataset.search
                        ).includes(
                            search
                        );


                    const matchesStatus =
                        !status ||
                        normalize(
                            row.dataset.status
                        ) ===
                        status;


                    const matchesState =
                        !state ||
                        normalize(
                            row.dataset.state
                        ) ===
                        state;


                    const show =
                        matchesSearch &&
                        matchesStatus &&
                        matchesState;


                    row.hidden =
                        !show;


                    if (
                        show
                    ) {
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
        | MODAL OPEN / CLOSE
        |--------------------------------------------------------------------------
        */

        const openReturnModal = () => {
            lastFocusedElement =
                document.activeElement;


            previousBodyOverflow =
                document.body.style.overflow;


            returnModal.classList.add(
                'is-open'
            );


            returnModal.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.style.overflow =
                'hidden';


            window.requestAnimationFrame(
                () => {
                    closeReturnButton.focus();
                }
            );
        };


        const closeReturnModal = () => {
            returnModal.classList.remove(
                'is-open'
            );


            returnModal.setAttribute(
                'aria-hidden',
                'true'
            );


            document.body.style.overflow =
                previousBodyOverflow;


            selectedRecordIndex =
                null;


            if (
                lastFocusedElement instanceof
                HTMLElement
            ) {
                lastFocusedElement.focus();
            }
        };


        /*
        |--------------------------------------------------------------------------
        | RETURN MODAL RENDER
        |--------------------------------------------------------------------------
        */

        const renderReturnModal = (
            index
        ) => {
            const record =
                getRecord(
                    index
                );


            if (
                !record
            ) {
                return;
            }


            const stats =
                getRecordStats(
                    record
                );


            if (
                stats.isReturned
            ) {
                return;
            }


            selectedRecordIndex =
                Number(
                    index
                );


            returnSubtitle.textContent =
                `${record.id} · ${record.project}`;


            returnItemList.innerHTML =
                stats.items
                    .map(
                        (
                            item,
                            itemIndex
                        ) => {
                            if (
                                item.remaining ===
                                0
                            ) {
                                return `
                                    <div
                                        class="
                                            br-return-row
                                            is-complete
                                        "
                                        data-return-item="${itemIndex}"
                                        data-asset-id="${escapeHtml(item.asset_id)}"
                                        data-item-complete="true"
                                    >

                                        <div class="br-return-item">

                                            <strong>
                                                ${escapeHtml(item.name)}
                                            </strong>

                                            <span>
                                                ${escapeHtml(item.asset_id)}
                                                · Released ${item.quantity}
                                            </span>

                                            <span class="br-return-item-progress">
                                                ${item.returned}/${item.quantity} returned
                                            </span>

                                        </div>


                                        <div>
                                            <span class="br-return-complete">

                                                <svg
                                                    class="br-icon"
                                                    aria-hidden="true"
                                                >
                                                    <use href="#br-icon-check"></use>
                                                </svg>

                                                Fully returned

                                            </span>
                                        </div>


                                        <div></div>

                                    </div>
                                `;
                            }


                            const selectedCondition =
                                [
                                    'Excellent',
                                    'Good',
                                    'Fair',
                                    'Poor',
                                    'Needs maintenance',
                                    'Damaged'
                                ].includes(
                                    item.condition_out
                                )
                                    ? item.condition_out
                                    : 'Good';


                            return `
                                <div
                                    class="br-return-row"
                                    data-return-item="${itemIndex}"
                                    data-asset-id="${escapeHtml(item.asset_id)}"
                                    data-item-complete="false"
                                >

                                    <div class="br-return-item">

                                        <strong>
                                            ${escapeHtml(item.name)}
                                        </strong>

                                        <span>
                                            ${escapeHtml(item.asset_id)}
                                            · Released ${item.quantity}
                                        </span>

                                        <span class="br-return-item-progress">
                                            ${item.returned} returned · ${item.remaining} remaining
                                        </span>

                                    </div>


                                    <div class="br-return-field">

                                        <label
                                            for="return-quantity-${itemIndex}"
                                        >
                                            Return now
                                        </label>


                                        <input
                                            id="return-quantity-${itemIndex}"
                                            class="br-return-input"
                                            type="number"
                                            min="0"
                                            max="${item.remaining}"
                                            step="1"
                                            value="${item.remaining}"
                                            data-return-quantity
                                            data-remaining-quantity="${item.remaining}"
                                        >

                                    </div>


                                    <div class="br-return-field">

                                        <label
                                            for="return-condition-${itemIndex}"
                                        >
                                            Condition
                                        </label>


                                        <select
                                            id="return-condition-${itemIndex}"
                                            class="br-return-select"
                                            data-return-condition
                                        >
                                            <option
                                                value="Excellent"
                                                ${selectedCondition === 'Excellent' ? 'selected' : ''}
                                            >
                                                Excellent
                                            </option>

                                            <option
                                                value="Good"
                                                ${selectedCondition === 'Good' ? 'selected' : ''}
                                            >
                                                Good
                                            </option>

                                            <option
                                                value="Fair"
                                                ${selectedCondition === 'Fair' ? 'selected' : ''}
                                            >
                                                Fair
                                            </option>

                                            <option
                                                value="Poor"
                                                ${selectedCondition === 'Poor' ? 'selected' : ''}
                                            >
                                                Poor
                                            </option>

                                            <option
                                                value="Needs maintenance"
                                                ${selectedCondition === 'Needs maintenance' ? 'selected' : ''}
                                            >
                                                Needs maintenance
                                            </option>

                                            <option
                                                value="Damaged"
                                                ${selectedCondition === 'Damaged' ? 'selected' : ''}
                                            >
                                                Damaged
                                            </option>
                                        </select>

                                    </div>


                                    <div
                                        class="br-return-warning"
                                        data-return-warning
                                    >
                                        <svg
                                            class="br-icon"
                                            aria-hidden="true"
                                        >
                                            <use href="#br-icon-alert"/>
                                        </svg>

                                        <span data-warning-copy></span>
                                    </div>

                                </div>
                            `;
                        }
                    )
                    .join(
                        ''
                    );


            returnNotes.value =
                '';


            updateReturnWarnings();

            updateConfirmButton();


            openReturnModal();
        };


        /*
        |--------------------------------------------------------------------------
        | RETURN MODAL STATE
        |--------------------------------------------------------------------------
        */

        const getReturnRows = () => {
            return Array.from(
                returnItemList.querySelectorAll(
                    '[data-return-item]'
                )
            );
        };


        const updateReturnWarnings = () => {
            getReturnRows().forEach(
                (row) => {
                    if (
                        row.dataset.itemComplete ===
                        'true'
                    ) {
                        return;
                    }


                    const quantityInput =
                        row.querySelector(
                            '[data-return-quantity]'
                        );


                    const warning =
                        row.querySelector(
                            '[data-return-warning]'
                        );


                    const warningCopy =
                        row.querySelector(
                            '[data-warning-copy]'
                        );


                    if (
                        !quantityInput ||
                        !warning ||
                        !warningCopy
                    ) {
                        return;
                    }


                    const remaining =
                        Number(
                            quantityInput
                                .dataset
                                .remainingQuantity
                        );


                    const returning =
                        Number(
                            quantityInput.value
                        );


                    if (
                        Number.isFinite(
                            returning
                        ) &&
                        returning >=
                            0 &&
                        returning <
                            remaining
                    ) {
                        const outstanding =
                            remaining -
                            returning;


                        warning.classList.add(
                            'is-visible'
                        );


                        warningCopy.textContent =
                            returning ===
                            0
                                ? `No units from this resource will be recorded in this batch. ${remaining} will remain outstanding.`
                                : `${outstanding} ${outstanding === 1 ? 'unit will' : 'units will'} remain outstanding after this batch.`;
                    } else {
                        warning.classList.remove(
                            'is-visible'
                        );


                        warningCopy.textContent =
                            '';
                    }
                }
            );
        };


        const updateConfirmButton = () => {
            const hasReturn =
                getReturnRows().some(
                    (row) => {
                        if (
                            row.dataset.itemComplete ===
                            'true'
                        ) {
                            return false;
                        }


                        const input =
                            row.querySelector(
                                '[data-return-quantity]'
                            );


                        const value =
                            Number(
                                input?.value
                            );


                        return (
                            Number.isSafeInteger(
                                value
                            ) &&
                            value >
                                0
                        );
                    }
                );


            confirmReturn.disabled =
                !hasReturn;
        };


        /*
        |--------------------------------------------------------------------------
        | COMPLETE RETURN
        |--------------------------------------------------------------------------
        */

        const completeReturn = () => {
            if (
                selectedRecordIndex ===
                null
            ) {
                return;
            }


            const record =
                getRecord(
                    selectedRecordIndex
                );


            if (
                !record
            ) {
                return;
            }


            const stats =
                getRecordStats(
                    record
                );


            const statsMap =
                new Map(
                    stats.items.map(
                        (item) => {
                            return [
                                item.asset_id,
                                item
                            ];
                        }
                    )
                );


            const newEvents =
                [];


            let invalidField =
                null;


            getReturnRows().forEach(
                (row) => {
                    if (
                        row.dataset.itemComplete ===
                        'true'
                    ) {
                        return;
                    }


                    const assetId =
                        row.dataset.assetId;


                    const item =
                        statsMap.get(
                            assetId
                        );


                    const quantityInput =
                        row.querySelector(
                            '[data-return-quantity]'
                        );


                    const conditionField =
                        row.querySelector(
                            '[data-return-condition]'
                        );


                    if (
                        !item ||
                        !quantityInput ||
                        !conditionField
                    ) {
                        return;
                    }


                    const amount =
                        Number(
                            quantityInput.value
                        );


                    if (
                        !Number.isSafeInteger(
                            amount
                        ) ||
                        amount <
                            0 ||
                        amount >
                            item.remaining
                    ) {
                        invalidField =
                            invalidField ||
                            quantityInput;


                        return;
                    }


                    if (
                        amount ===
                        0
                    ) {
                        return;
                    }


                    const condition =
                        String(
                            conditionField.value ??
                            ''
                        ).trim();


                    if (
                        !condition
                    ) {
                        invalidField =
                            invalidField ||
                            conditionField;


                        return;
                    }


                    newEvents.push(
                        {
                            asset_id:
                                item.asset_id,

                            quantity:
                                amount,

                            condition,

                            notes:
                                returnNotes.value
                                    .trim(),

                            at:
                                new Date()
                                    .toISOString()
                        }
                    );
                }
            );


            if (
                invalidField
            ) {
                invalidField.focus();

                invalidField.reportValidity?.();

                return;
            }


            if (
                newEvents.length ===
                0
            ) {
                showFeedback(
                    'No return recorded.',
                    'Enter at least one returned quantity greater than zero.'
                );


                return;
            }


            try {
                appendReturnEvents(
                    record.id,
                    newEvents
                );
            } catch (
                failure
            ) {
                showFeedback(
                    'Return could not be saved.',
                    failure.message ||
                    'Browser storage is unavailable.'
                );


                return;
            }


            const returnedNow =
                newEvents.reduce(
                    (
                        total,
                        entry
                    ) => {
                        return (
                            total +
                            entry.quantity
                        );
                    },
                    0
                );


            closeReturnModal();


            refreshRecords();


            const updated =
                getRecordStats(
                    record
                );


            if (
                updated.remaining ===
                0
            ) {
                showFeedback(
                    `${record.id} return completed.`,
                    `All ${updated.borrowed} released units are now accounted for.`
                );
            } else {
                showFeedback(
                    `${record.id} partial return recorded.`,
                    `${returnedNow} ${returnedNow === 1 ? 'unit was' : 'units were'} recorded in this batch. ${updated.remaining} ${updated.remaining === 1 ? 'unit remains' : 'units remain'} outstanding.`
                );
            }
        };


        /*
        |--------------------------------------------------------------------------
        | FILTER EVENTS
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


        stateFilter.addEventListener(
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


                stateFilter.value =
                    '';


                applyFilters();


                searchInput.focus();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | RETURN BUTTON
        |--------------------------------------------------------------------------
        */

        page.addEventListener(
            'click',
            (event) => {
                const returnButton =
                    event.target.closest(
                        '[data-return-borrow]'
                    );


                if (
                    !returnButton ||
                    returnButton.disabled
                ) {
                    return;
                }


                renderReturnModal(
                    returnButton
                        .dataset
                        .returnBorrow
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | RETURN INPUTS
        |--------------------------------------------------------------------------
        */

        returnItemList.addEventListener(
            'input',
            (event) => {
                if (
                    event.target.matches(
                        '[data-return-quantity]'
                    )
                ) {
                    updateReturnWarnings();

                    updateConfirmButton();
                }
            }
        );


        returnItemList.addEventListener(
            'change',
            () => {
                updateConfirmButton();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | MODAL EVENTS
        |--------------------------------------------------------------------------
        */

        closeReturnButton.addEventListener(
            'click',
            closeReturnModal
        );


        cancelReturn.addEventListener(
            'click',
            closeReturnModal
        );


        confirmReturn.addEventListener(
            'click',
            completeReturn
        );


        returnModal.addEventListener(
            'click',
            (event) => {
                if (
                    event.target ===
                    returnModal
                ) {
                    closeReturnModal();
                }
            }
        );


        document.addEventListener(
            'keydown',
            (event) => {
                if (
                    event.key ===
                        'Escape' &&
                    returnModal.classList.contains(
                        'is-open'
                    )
                ) {
                    closeReturnModal();
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | SHARED DATA UPDATE EVENT
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            'pulso:borrow-item-returns-updated',
            refreshRecords
        );


        /*
        |--------------------------------------------------------------------------
        | BACK / FORWARD CACHE
        |--------------------------------------------------------------------------
        |
        | If the user records a return on Borrowing Details and then
        | presses Back, the list immediately reads the same session data.
        |
        */

        window.addEventListener(
            'pageshow',
            () => {
                refreshRecords();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        refreshRecords();
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeBorrowPage,
            {
                once: true
            }
        );
    } else {
        initializeBorrowPage();
    }
})();
</script>
@endpush