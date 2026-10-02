@extends('layouts.app')

@section('title', 'Portable Sound System | PULSO Logistics Hub')

@php
    $asset = [
        'id' => 'PULSO-AUD-001',
        'name' => 'Portable Sound System',
        'category' => 'Audio',
        'description' => 'Main portable sound system used for PULSO events and community activities.',
        'quantity' => 1,
        'location' => 'Equipment Shelf A',
        'condition' => 'Good',
        'status' => 'Available',
        'date_acquired' => 'February 14, 2026',
        'source' => 'Purchased',
        'estimated_value' => '₱18,500.00',
        'last_updated' => 'September 8, 2026 · 9:42 AM',
        'notes' => 'Keep inside the protective carrying case when not in use. Inspect cables and power connections before deployment.',
    ];

    $quantities = [
        [
            'label' => 'Total Quantity',
            'value' => 1,
            'tone' => 'navy',
            'icon' => 'box',
        ],
        [
            'label' => 'Available',
            'value' => 1,
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'label' => 'Borrowed',
            'value' => 0,
            'tone' => 'pink',
            'icon' => 'exchange',
        ],
        [
            'label' => 'Deployed',
            'value' => 0,
            'tone' => 'blue',
            'icon' => 'deploy',
        ],
    ];

    $inventoryDetails = [
        [
            'label' => 'Asset ID',
            'value' => $asset['id'],
            'icon' => 'tag',
        ],
        [
            'label' => 'Category',
            'value' => $asset['category'],
            'icon' => 'category',
        ],
        [
            'label' => 'Storage Location',
            'value' => $asset['location'],
            'icon' => 'location',
        ],
        [
            'label' => 'Condition',
            'value' => $asset['condition'],
            'icon' => 'condition',
        ],
    ];

    $acquisitionDetails = [
        [
            'label' => 'Date Acquired',
            'value' => $asset['date_acquired'],
            'icon' => 'calendar',
        ],
        [
            'label' => 'Acquisition Source',
            'value' => $asset['source'],
            'icon' => 'source',
        ],
        [
            'label' => 'Estimated Value',
            'value' => $asset['estimated_value'],
            'icon' => 'value',
        ],
        [
            'label' => 'Last Updated',
            'value' => $asset['last_updated'],
            'icon' => 'clock',
        ],
    ];

    $history = [
        [
            'date' => 'September 8, 2026',
            'datetime' => '2026-09-08',
            'title' => 'Condition inspected',
            'description' => 'Routine post-use inspection completed. Asset remained in Good condition and was returned to its assigned storage location.',
            'person' => 'Recorded by Logistics Team',
            'tone' => 'teal',
            'icon' => 'condition',
        ],
        [
            'date' => 'September 7, 2026',
            'datetime' => '2026-09-07',
            'title' => 'Asset returned',
            'description' => 'Returned after use during the Volunteer Orientation activity.',
            'person' => 'Received by Logistics Team',
            'tone' => 'teal',
            'icon' => 'return',
        ],
        [
            'date' => 'September 7, 2026',
            'datetime' => '2026-09-07',
            'title' => 'Asset released',
            'description' => 'Released for logistics use during the Volunteer Orientation activity.',
            'person' => 'Released by Paul Roldan',
            'tone' => 'blue',
            'icon' => 'release',
        ],
        [
            'date' => 'August 22, 2026',
            'datetime' => '2026-08-22',
            'title' => 'Condition inspected',
            'description' => 'Asset was inspected and recorded in Good working condition.',
            'person' => 'Recorded by Logistics Team',
            'tone' => 'teal',
            'icon' => 'condition',
        ],
        [
            'date' => 'July 19, 2026',
            'datetime' => '2026-07-19',
            'title' => 'Asset deployed',
            'description' => 'Used during a Community Outreach activity and returned after the event.',
            'person' => 'Events Committee',
            'tone' => 'pink',
            'icon' => 'deploy',
        ],
    ];
@endphp


@push('styles')
<style>
    .asset-details-page {
        --ad-navy: #10263d;
        --ad-copy: #496580;
        --ad-muted: #71899c;
        --ad-line: #d5e5ee;

        --ad-teal: #007780;
        --ad-pink: #b90c61;
        --ad-blue: #365f8d;
        --ad-red: #a93642;

        display: grid;

        gap: 20px;

        width: 100%;
        min-width: 0;

        color: var(--ad-navy);

        container-name: asset-details;
        container-type: inline-size;
    }

    .asset-details-page *,
    .asset-details-page *::before,
    .asset-details-page *::after {
        box-sizing: border-box;
    }

    .ad-icon {
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

    .ad-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .ad-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }

    .ad-heading-copy {
        min-width: 0;
    }

    .ad-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--ad-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .ad-heading h1 {
        margin: 0;

        color: var(--ad-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }

    .ad-reference {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 8px;

        margin:
            9px
            0
            0;

        color: var(--ad-copy);

        font-size: 11px;
    }

    .ad-reference-id {
        color: #29475f;

        font-weight: 800;
    }

    .ad-reference-dot {
        width: 4px;
        height: 4px;

        flex: 0 0 4px;

        border-radius: 50%;

        background: #91a7b6;
    }


    /* ================================================================
       ACTIONS
       ================================================================ */

    .ad-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 9px;

        flex-shrink: 0;
    }

    .ad-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding:
            9px
            14px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

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
        font-weight: 750;

        text-decoration: none;

        cursor: pointer;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }

    .ad-button .ad-icon {
        width: 16px;
        height: 16px;
    }

    .ad-button:hover {
        color: var(--ad-teal);

        transform:
            translateY(
                -1px
            );
    }

    .ad-button-primary {
        border-color: #bff8fa;

        background:
            linear-gradient(
                145deg,
                #00858e,
                #00747f
            );

        color: #ffffff;

        box-shadow:
            4px 5px 11px rgba(0, 126, 139, .19),
            -3px -3px 8px rgba(255, 255, 255, .64),
            inset 1px 1px 3px rgba(125, 234, 240, .58);
    }

    .ad-button-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #007b85,
                #006a74
            );
    }

    .ad-button-danger {
        background:
            linear-gradient(
                145deg,
                #fff0f3,
                #f3d8dd
            );

        color: var(--ad-red);
    }

    .ad-button-danger:hover {
        color: #922c37;

        background:
            linear-gradient(
                145deg,
                #ffe4e9,
                #efccd2
            );
    }


    /* ================================================================
       CONTENT
       ================================================================ */

    .ad-content {
        display: grid;

        gap: 20px;

        min-width: 0;
    }

    .ad-card {
        position: relative;

        min-width: 0;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .97);

        border-radius: 22px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .97),
                rgba(230, 242, 248, .96)
            );

        box-shadow:
            6px 8px 18px rgba(101, 138, 163, .13),
            -5px -5px 14px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }

    .ad-card::after {
        position: absolute;

        top: 0;
        right: 22px;

        width: 38px;
        height: 3px;

        border-radius:
            0
            0
            999px
            999px;

        background:
            linear-gradient(
                90deg,
                #05adb6,
                #ee1280
            );

        opacity: .42;

        content: "";
    }


    /* ================================================================
       SUMMARY
       ================================================================ */

    .ad-summary {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr);

        gap: 17px;

        padding:
            21px
            22px;
    }

    .ad-summary-main {
        display: flex;
        align-items: center;

        gap: 16px;

        min-width: 0;
    }

    .ad-asset-symbol {
        display: grid;
        place-items: center;

        width: 64px;
        height: 64px;

        flex: 0 0 64px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                #e4fbfc,
                #c6ebee
            );

        color: var(--ad-teal);

        box-shadow:
            5px 6px 13px rgba(72, 112, 134, .13),
            -4px -4px 10px rgba(255, 255, 255, .82);
    }

    .ad-asset-symbol .ad-icon {
        width: 27px;
        height: 27px;
    }

    .ad-summary-copy {
        min-width: 0;

        flex: 1;
    }

    .ad-status-line {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 9px;
    }

    .ad-status {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        min-height: 27px;

        padding:
            4px
            9px;

        border:
            1px
            solid
            rgba(255, 255, 255, .8);

        border-radius: 8px;

        background:
            linear-gradient(
                145deg,
                #ddf5f5,
                #caedef
            );

        color: var(--ad-teal);

        font-size: 9.5px;
        font-weight: 800;
    }

    .ad-status .ad-icon {
        width: 14px;
        height: 14px;
    }

    .ad-condition {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        color: #526f84;

        font-size: 9.5px;
        font-weight: 650;
    }

    .ad-condition::before {
        width: 6px;
        height: 6px;

        flex: 0 0 6px;

        border-radius: 50%;

        background: var(--ad-teal);

        content: "";
    }

    .ad-summary-copy h2 {
        margin:
            10px
            0
            0;

        color: #18344c;

        font-size: 16px;
        font-weight: 800;
    }

    .ad-description {
        max-width: 780px;

        margin:
            5px
            0
            0;

        color: var(--ad-copy);

        font-size: 11px;
        line-height: 1.65;
    }

    .ad-location {
        display: flex;
        align-items: center;

        gap: 7px;

        margin-top: 10px;

        color: #607b90;

        font-size: 10px;
    }

    .ad-location .ad-icon {
        width: 14px;
        height: 14px;

        color: var(--ad-pink);
    }

    .ad-location strong {
        color: #365970;
    }


    /* ================================================================
       KPI ROW
       ================================================================ */

    .ad-quantities {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 11px;

        width: 100%;

        margin: 0;

        padding-top: 17px;

        border-top:
            1px
            solid
            rgba(205, 225, 234, .88);
    }

    .ad-quantity {
        --quantity-ink: #173b59;
        --quantity-fill: #e7eff6;

        position: relative;

        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;
        min-height: 70px;

        padding:
            11px
            13px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #f8fcfd,
                #e7f1f5
            );

        box-shadow:
            4px 5px 10px rgba(78, 111, 132, .08),
            -3px -3px 8px rgba(255, 255, 255, .68),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }

    .ad-quantity::after {
        position: absolute;

        top: 0;
        right: 14px;

        width: 28px;
        height: 3px;

        border-radius:
            0
            0
            999px
            999px;

        background: var(--quantity-ink);

        opacity: .55;

        content: "";
    }

    .ad-quantity-icon {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 11px;

        background: var(--quantity-fill);

        color: var(--quantity-ink);

        box-shadow:
            3px 4px 7px rgba(78, 111, 132, .07),
            -2px -2px 5px rgba(255, 255, 255, .68);
    }

    .ad-quantity-icon .ad-icon {
        width: 16px;
        height: 16px;
    }

    .ad-quantity-copy {
        min-width: 0;

        flex: 1;
    }

    .ad-quantity dd {
        margin: 0;

        color: var(--quantity-ink);

        font-size: 22px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }

    .ad-quantity dt {
        margin-top: 5px;

        overflow: hidden;

        color: #60798d;

        font-size: 8.5px;
        font-weight: 650;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .ad-quantity--navy {
        --quantity-ink: #173b59;
        --quantity-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }

    .ad-quantity--teal {
        --quantity-ink: #007780;
        --quantity-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }

    .ad-quantity--pink {
        --quantity-ink: #b90c61;
        --quantity-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }

    .ad-quantity--blue {
        --quantity-ink: #365f8d;
        --quantity-fill:
            linear-gradient(
                145deg,
                #edf4fb,
                #dce8f4
            );
    }


    /* ================================================================
       INFORMATION GRID
       ================================================================ */

    .ad-information-grid {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        align-items: stretch;

        gap: 20px;

        min-width: 0;
    }

    .ad-information-grid > .ad-card {
        height: 100%;
    }

    .ad-card-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        padding:
            18px
            20px
            16px;

        border-bottom:
            1px
            solid
            var(--ad-line);
    }

    .ad-section-title {
        display: flex;
        align-items: center;

        gap: 10px;
    }

    .ad-section-number {
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
                #f9e4ef,
                #efd0df
            );

        color: var(--ad-pink);

        font-size: 11px;
        font-weight: 850;
    }

    .ad-card-heading h2 {
        margin: 0;

        color: #18344c;

        font-size: 16px;
        font-weight: 800;
    }

    .ad-history-caption {
        color: var(--ad-muted);

        font-size: 9.5px;
    }


    /* ================================================================
       METADATA
       ================================================================ */

    .ad-metadata {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 12px;

        margin: 0;
        padding: 20px;
    }

    .ad-metadata-item {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        min-width: 0;

        padding: 12px;

        border:
            1px
            solid
            rgba(255, 255, 255, .88);

        border-radius: 13px;

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

    .ad-metadata-icon {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #e3f7f8,
                #d1ecef
            );

        color: var(--ad-teal);
    }

    .ad-metadata-icon .ad-icon {
        width: 15px;
        height: 15px;
    }

    .ad-metadata-copy {
        min-width: 0;
    }

    .ad-metadata dt {
        margin: 0;

        color: #6a8295;

        font-size: 9px;
        font-weight: 650;
    }

    .ad-metadata dd {
        margin:
            4px
            0
            0;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 750;

        overflow-wrap: anywhere;
    }


    /* ================================================================
       NOTES
       ================================================================ */

    .ad-notes {
        display: flex;
        align-items: flex-start;

        gap: 13px;

        padding:
            16px
            18px;

        border:
            1px
            solid
            rgba(255, 255, 255, .94);

        border-radius: 17px;

        background:
            linear-gradient(
                145deg,
                #e5f4f6,
                #edf7fa
            );

        box-shadow:
            inset 3px 3px 7px rgba(78, 113, 134, .08),
            inset -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .ad-notes-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e0f7f8,
                #cbecef
            );

        color: var(--ad-teal);
    }

    .ad-notes-icon .ad-icon {
        width: 17px;
        height: 17px;
    }

    .ad-notes h2 {
        margin: 0;

        color: #29475f;

        font-size: 12px;
        font-weight: 800;
    }

    .ad-notes p {
        margin:
            4px
            0
            0;

        color: var(--ad-copy);

        font-size: 10.5px;
        line-height: 1.65;
    }


    /* ================================================================
       HISTORY
       ================================================================ */

    .ad-history {
        margin: 0;
        padding: 0;

        list-style: none;
    }

    .ad-history-item {
        display: grid;

        grid-template-columns:
            130px
            minmax(0, 1fr)
            minmax(150px, .5fr);

        align-items: start;

        gap: 18px;

        padding:
            17px
            20px;
    }

    .ad-history-item + .ad-history-item {
        border-top:
            1px
            solid
            rgba(216, 231, 238, .88);
    }

    .ad-history-date {
        padding-top: 7px;

        color: #617b8f;

        font-size: 9.5px;
        font-weight: 650;
    }

    .ad-history-event {
        display: flex;
        align-items: flex-start;

        gap: 11px;

        min-width: 0;
    }

    .ad-history-marker {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #ddf6f7,
                #c8eaed
            );

        color: var(--ad-teal);
    }

    .ad-history-marker--blue {
        background:
            linear-gradient(
                145deg,
                #edf5fc,
                #d8e7f4
            );

        color: var(--ad-blue);
    }

    .ad-history-marker--pink {
        background:
            linear-gradient(
                145deg,
                #fff0f7,
                #f3d4e4
            );

        color: var(--ad-pink);
    }

    .ad-history-marker .ad-icon {
        width: 16px;
        height: 16px;
    }

    .ad-history-event h3 {
        margin:
            2px
            0
            0;

        color: #29475f;

        font-size: 11px;
        font-weight: 800;
    }

    .ad-history-event p {
        margin:
            3px
            0
            0;

        color: var(--ad-copy);

        font-size: 10px;
        line-height: 1.55;
    }

    .ad-history-person {
        margin:
            7px
            0
            0;

        color: #647d91;

        font-size: 9.5px;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .ad-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap:
            12px
            20px;
    }

    .ad-footer > p {
        margin: 0;

        color: #71899c;

        font-size: 9.5px;
    }

    .ad-future-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 9px;
    }

    .ad-future-action {
        min-height: 36px;

        padding:
            7px
            10px;

        border:
            1px
            solid
            rgba(255, 255, 255, .84);

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #e8f0f4,
                #edf5f8
            );

        color: #8193a1;

        font: inherit;
        font-size: 9.5px;
        font-weight: 650;

        cursor: not-allowed;
    }

    .ad-future-action span {
        margin-left: 4px;

        color: #99a7b1;

        font-size: 8px;
    }


    /* ================================================================
       FEEDBACK
       ================================================================ */

    .ad-feedback {
        padding:
            11px
            13px;

        border:
            1px
            solid
            #e5bfd0;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #fbeaf2,
                #f3dce7
            );

        color: #9d235c;

        font-size: 10px;
        font-weight: 700;
    }

    .ad-feedback[hidden] {
        display: none !important;
    }


    /* ================================================================
       MODAL
       ================================================================ */

    .ad-modal {
        position: fixed;
        inset: 0;
        z-index: 100;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 20px;

        background:
            rgba(
                16,
                38,
                61,
                .54
            );

        backdrop-filter:
            blur(
                5px
            );
    }

    .ad-modal.is-open {
        display: flex;
    }

    .ad-modal-panel {
        width: min(
            100%,
            440px
        );

        padding: 23px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 21px;

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

    .ad-modal-icon {
        display: grid;
        place-items: center;

        width: 48px;
        height: 48px;

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #fff0f2,
                #f3d5da
            );

        color: var(--ad-red);
    }

    .ad-modal-icon .ad-icon {
        width: 21px;
        height: 21px;
    }

    .ad-modal h2 {
        margin:
            17px
            0
            0;

        color: var(--ad-navy);

        font-size: 19px;
        font-weight: 800;
    }

    .ad-modal p {
        margin:
            8px
            0
            0;

        color: var(--ad-copy);

        font-size: 11px;
        line-height: 1.7;
    }

    .ad-modal-note {
        margin-top: 15px !important;

        padding:
            10px
            11px;

        border-radius: 11px;

        background: #e8f2f6;

        font-size: 9.5px !important;
    }

    .ad-modal-actions {
        display: flex;
        justify-content: flex-end;

        gap: 10px;

        margin-top: 21px;
    }

    .ad-confirm-archive {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding:
            9px
            15px;

        border: 0;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #bd4651,
                #a2323d
            );

        color: #ffffff;

        font: inherit;
        font-size: 11px;
        font-weight: 700;

        cursor: pointer;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container asset-details (max-width: 900px) {
        .ad-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }

        .ad-quantities {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );
        }
    }

    @container asset-details (max-width: 720px) {
        .ad-information-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .ad-quantities {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .ad-history-item {
            grid-template-columns:
                115px
                minmax(0, 1fr);

            gap:
                10px
                16px;
        }

        .ad-history-person {
            grid-column: 2;

            padding-left: 47px;
        }
    }

    @container asset-details (max-width: 560px) {
        .ad-actions {
            width: 100%;
        }

        .ad-button {
            flex: 1;
        }

        .ad-summary {
            padding:
                18px
                16px;
        }

        .ad-summary-main {
            align-items: flex-start;
            flex-direction: column;
        }

        .ad-metadata {
            grid-template-columns:
                minmax(0, 1fr);

            padding:
                17px
                16px;
        }

        .ad-history-item {
            grid-template-columns:
                minmax(0, 1fr);

            padding: 16px;
        }

        .ad-history-person {
            grid-column: auto;

            padding-left: 47px;
        }
    }

    @container asset-details (max-width: 420px) {
        .ad-quantities {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .ad-actions {
            display: grid;

            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .ad-actions .ad-button:first-child {
            grid-column:
                1
                / -1;
        }

        .ad-modal-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .ad-button {
            transition: none;
        }

        .ad-button:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div
    class="asset-details-page"
    id="asset-details-page"
>

    <svg
        class="ad-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >

        <symbol
            id="ad-icon-box"
            viewBox="0 0 24 24"
        >
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>


        <symbol
            id="ad-icon-check"
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
            id="ad-icon-exchange"
            viewBox="0 0 24 24"
        >
            <path d="M4 7h15"/>
            <path d="m15 3 4 4-4 4"/>
            <path d="M20 17H5"/>
            <path d="m9 13-4 4 4 4"/>
        </symbol>


        <symbol
            id="ad-icon-back"
            viewBox="0 0 24 24"
        >
            <path d="M19 12H5"/>
            <path d="m11 6-6 6 6 6"/>
        </symbol>


        <symbol
            id="ad-icon-edit"
            viewBox="0 0 24 24"
        >
            <path d="M12 20h9"/>
            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"/>
        </symbol>


        <symbol
            id="ad-icon-trash"
            viewBox="0 0 24 24"
        >
            <path d="M3 6h18"/>
            <path d="M8 6V4h8v2"/>
            <path d="m19 6-1 14H6L5 6"/>
            <path d="M10 10v6"/>
            <path d="M14 10v6"/>
        </symbol>


        <symbol
            id="ad-icon-location"
            viewBox="0 0 24 24"
        >
            <path d="M12 21s7-5 7-11a7 7 0 1 0-14 0c0 6 7 11 7 11Z"/>

            <circle
                cx="12"
                cy="10"
                r="2.2"
            />
        </symbol>


        <symbol
            id="ad-icon-tag"
            viewBox="0 0 24 24"
        >
            <path d="M20 13 13 20l-9-9V4h7Z"/>

            <circle
                cx="8.5"
                cy="8.5"
                r="1"
            />
        </symbol>


        <symbol
            id="ad-icon-category"
            viewBox="0 0 24 24"
        >
            <rect
                x="3"
                y="3"
                width="7"
                height="7"
                rx="2"
            />

            <rect
                x="14"
                y="3"
                width="7"
                height="7"
                rx="2"
            />

            <rect
                x="3"
                y="14"
                width="7"
                height="7"
                rx="2"
            />

            <rect
                x="14"
                y="14"
                width="7"
                height="7"
                rx="2"
            />
        </symbol>


        <symbol
            id="ad-icon-condition"
            viewBox="0 0 24 24"
        >
            <path d="M14.7 6.3a4 4 0 0 0-5-5L7 4l3 3-6.7 6.7a2.1 2.1 0 0 0 3 3L13 10a4 4 0 0 0 5-5Z"/>
            <path d="m13 13 6 6"/>
        </symbol>


        <symbol
            id="ad-icon-calendar"
            viewBox="0 0 24 24"
        >
            <rect
                x="3"
                y="5"
                width="18"
                height="16"
                rx="2"
            />

            <path d="M16 3v4"/>
            <path d="M8 3v4"/>
            <path d="M3 10h18"/>
        </symbol>


        <symbol
            id="ad-icon-source"
            viewBox="0 0 24 24"
        >
            <path d="M12 3v18"/>
            <path d="M5 8h14"/>
            <path d="M7 16h10"/>
        </symbol>


        <symbol
            id="ad-icon-value"
            viewBox="0 0 24 24"
        >
            <circle
                cx="12"
                cy="12"
                r="9"
            />

            <path d="M12 5v14"/>
        </symbol>


        <symbol
            id="ad-icon-clock"
            viewBox="0 0 24 24"
        >
            <circle
                cx="12"
                cy="12"
                r="9"
            />

            <path d="M12 7v5l3 2"/>
        </symbol>


        <symbol
            id="ad-icon-notes"
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
            id="ad-icon-return"
            viewBox="0 0 24 24"
        >
            <path d="M20 7H8"/>
            <path d="m12 3-4 4 4 4"/>
            <path d="M4 13v2a4 4 0 0 0 4 4h10"/>
        </symbol>


        <symbol
            id="ad-icon-release"
            viewBox="0 0 24 24"
        >
            <path d="M4 7h12"/>
            <path d="m12 3 4 4-4 4"/>
            <path d="M20 13v2a4 4 0 0 1-4 4H6"/>
        </symbol>


        <symbol
            id="ad-icon-deploy"
            viewBox="0 0 24 24"
        >
            <path d="M4 7h16v11H4Z"/>
            <path d="M9 7V5h6v2"/>
            <path d="M8 12h8"/>
        </symbol>

    </svg>


    <header class="ad-heading">

        <div class="ad-heading-copy">

            <p class="ad-eyebrow">
                Resource management
            </p>

            <h1>
                {{ $asset['name'] }}
            </h1>

            <div class="ad-reference">

                <span class="ad-reference-id">
                    {{ $asset['id'] }}
                </span>

                <span
                    class="ad-reference-dot"
                    aria-hidden="true"
                ></span>

                <span>
                    {{ $asset['category'] }}
                </span>

            </div>

        </div>


        <div class="ad-actions">

            <a
                href="{{ route('inventory.index') }}"
                class="ad-button"
            >
                <svg
                    class="ad-icon"
                    aria-hidden="true"
                >
                    <use href="#ad-icon-back"/>
                </svg>

                Back to inventory
            </a>


            <a
                href="{{ route('inventory.edit') }}"
                class="
                    ad-button
                    ad-button-primary
                "
            >
                <svg
                    class="ad-icon"
                    aria-hidden="true"
                >
                    <use href="#ad-icon-edit"/>
                </svg>

                Edit asset
            </a>


            <button
                id="open-asset-archive-modal"
                type="button"
                class="
                    ad-button
                    ad-button-danger
                "
            >
                <svg
                    class="ad-icon"
                    aria-hidden="true"
                >
                    <use href="#ad-icon-trash"/>
                </svg>

                Archive
            </button>

        </div>

    </header>


    <div class="ad-content">

        <section
            class="
                ad-card
                ad-summary
            "
            aria-label="Current asset status"
        >

            <div class="ad-summary-main">

                <span
                    class="ad-asset-symbol"
                    aria-hidden="true"
                >
                    <svg class="ad-icon">
                        <use href="#ad-icon-box"/>
                    </svg>
                </span>


                <div class="ad-summary-copy">

                    <div class="ad-status-line">

                        <span class="ad-status">

                            <svg
                                class="ad-icon"
                                aria-hidden="true"
                            >
                                <use href="#ad-icon-check"/>
                            </svg>

                            {{ $asset['status'] }}

                        </span>


                        <span class="ad-condition">
                            {{ $asset['condition'] }}
                            condition
                        </span>

                    </div>


                    <h2>
                        Ready for logistics use
                    </h2>


                    <p class="ad-description">
                        {{ $asset['description'] }}
                    </p>


                    <div class="ad-location">

                        <svg
                            class="ad-icon"
                            aria-hidden="true"
                        >
                            <use href="#ad-icon-location"/>
                        </svg>

                        <span>
                            Stored at

                            <strong>
                                {{ $asset['location'] }}
                            </strong>
                        </span>

                    </div>

                </div>

            </div>


            <dl class="ad-quantities">

                @foreach ($quantities as $quantity)

                    <div
                        class="
                            ad-quantity
                            ad-quantity--{{ $quantity['tone'] }}
                        "
                    >

                        <span
                            class="ad-quantity-icon"
                            aria-hidden="true"
                        >
                            <svg class="ad-icon">
                                <use href="#ad-icon-{{ $quantity['icon'] }}"/>
                            </svg>
                        </span>


                        <div class="ad-quantity-copy">

                            <dd>
                                {{ $quantity['value'] }}
                            </dd>

                            <dt>
                                {{ $quantity['label'] }}
                            </dt>

                        </div>

                    </div>

                @endforeach

            </dl>

        </section>


        <div class="ad-information-grid">

            <section class="ad-card">

                <header class="ad-card-heading">

                    <div class="ad-section-title">

                        <span class="ad-section-number">
                            01
                        </span>

                        <h2>
                            Inventory details
                        </h2>

                    </div>

                </header>


                <dl class="ad-metadata">

                    @foreach ($inventoryDetails as $detail)

                        <div class="ad-metadata-item">

                            <span
                                class="ad-metadata-icon"
                                aria-hidden="true"
                            >
                                <svg class="ad-icon">
                                    <use href="#ad-icon-{{ $detail['icon'] }}"/>
                                </svg>
                            </span>


                            <div class="ad-metadata-copy">

                                <dt>
                                    {{ $detail['label'] }}
                                </dt>

                                <dd>
                                    {{ $detail['value'] }}
                                </dd>

                            </div>

                        </div>

                    @endforeach

                </dl>

            </section>


            <section class="ad-card">

                <header class="ad-card-heading">

                    <div class="ad-section-title">

                        <span class="ad-section-number">
                            02
                        </span>

                        <h2>
                            Acquisition details
                        </h2>

                    </div>

                </header>


                <dl class="ad-metadata">

                    @foreach ($acquisitionDetails as $detail)

                        <div class="ad-metadata-item">

                            <span
                                class="ad-metadata-icon"
                                aria-hidden="true"
                            >
                                <svg class="ad-icon">
                                    <use href="#ad-icon-{{ $detail['icon'] }}"/>
                                </svg>
                            </span>


                            <div class="ad-metadata-copy">

                                <dt>
                                    {{ $detail['label'] }}
                                </dt>

                                <dd>
                                    {{ $detail['value'] }}
                                </dd>

                            </div>

                        </div>

                    @endforeach

                </dl>

            </section>

        </div>


        <section class="ad-notes">

            <span
                class="ad-notes-icon"
                aria-hidden="true"
            >
                <svg class="ad-icon">
                    <use href="#ad-icon-notes"/>
                </svg>
            </span>


            <div>

                <h2>
                    Internal notes
                </h2>

                <p>
                    {{ $asset['notes'] }}
                </p>

            </div>

        </section>


        <section class="ad-card">

            <header class="ad-card-heading">

                <div class="ad-section-title">

                    <span class="ad-section-number">
                        03
                    </span>

                    <h2>
                        Asset history
                    </h2>

                </div>


                <span class="ad-history-caption">
                    {{ count($history) }}
                    sample entries · Newest first
                </span>

            </header>


            <ol class="ad-history">

                @foreach ($history as $item)

                    <li class="ad-history-item">

                        <time
                            class="ad-history-date"
                            datetime="{{ $item['datetime'] }}"
                        >
                            {{ $item['date'] }}
                        </time>


                        <div class="ad-history-event">

                            <span
                                class="
                                    ad-history-marker
                                    ad-history-marker--{{ $item['tone'] }}
                                "
                                aria-hidden="true"
                            >
                                <svg class="ad-icon">
                                    <use href="#ad-icon-{{ $item['icon'] }}"/>
                                </svg>
                            </span>


                            <div>

                                <h3>
                                    {{ $item['title'] }}
                                </h3>

                                <p>
                                    {{ $item['description'] }}
                                </p>

                            </div>

                        </div>


                        <p class="ad-history-person">
                            {{ $item['person'] }}
                        </p>

                    </li>

                @endforeach

            </ol>

        </section>


        <div
            class="ad-feedback"
            id="asset-archive-feedback"
            role="status"
            aria-live="polite"
            hidden
        >
            Archive preview completed. No database record was changed.
        </div>


        <footer class="ad-footer">

            <p>
                Sample asset record · September 2026
            </p>


            <div class="ad-future-actions">

                <button
                    class="ad-future-action"
                    type="button"
                    disabled
                >
                    Record borrowing

                    <span>
                        Coming soon
                    </span>
                </button>


                <button
                    class="ad-future-action"
                    type="button"
                    disabled
                >
                    Report maintenance

                    <span>
                        Coming soon
                    </span>
                </button>

            </div>

        </footer>

    </div>


    <div
        id="asset-archive-modal"
        class="ad-modal"
        role="dialog"
        aria-modal="true"
        aria-hidden="true"
    >

        <div class="ad-modal-panel">

            <span
                class="ad-modal-icon"
                aria-hidden="true"
            >
                <svg class="ad-icon">
                    <use href="#ad-icon-trash"/>
                </svg>
            </span>


            <h2>
                Archive this asset?
            </h2>


            <p>
                <strong>
                    {{ $asset['name'] }}
                </strong>

                will be removed from the active inventory list when
                backend archive handling is connected.
            </p>


            <p class="ad-modal-note">
                This is currently a front-end preview. No database
                record will be permanently modified.
            </p>


            <div class="ad-modal-actions">

                <button
                    id="cancel-asset-archive"
                    type="button"
                    class="ad-button"
                >
                    Cancel
                </button>


                <button
                    id="confirm-asset-archive"
                    type="button"
                    class="ad-confirm-archive"
                >
                    Archive asset
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
            'asset-details-page'
        );

    if (
        !page ||
        page.dataset.initialized === 'true'
    ) {
        return;
    }

    page.dataset.initialized = 'true';

    const modal =
        page.querySelector(
            '#asset-archive-modal'
        );

    const openButton =
        page.querySelector(
            '#open-asset-archive-modal'
        );

    const cancelButton =
        page.querySelector(
            '#cancel-asset-archive'
        );

    const confirmButton =
        page.querySelector(
            '#confirm-asset-archive'
        );

    const feedback =
        page.querySelector(
            '#asset-archive-feedback'
        );

    let previousBodyOverflow = '';

    const openModal = () => {
        previousBodyOverflow =
            document.body.style.overflow;

        document.body.style.overflow =
            'hidden';

        modal.classList.add(
            'is-open'
        );

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        cancelButton.focus();
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

        openButton.focus();
    };

    openButton?.addEventListener(
        'click',
        openModal
    );

    cancelButton?.addEventListener(
        'click',
        closeModal
    );

    modal?.addEventListener(
        'click',
        (event) => {
            if (
                event.target === modal
            ) {
                closeModal();
            }
        }
    );

    document.addEventListener(
        'keydown',
        (event) => {
            if (
                event.key === 'Escape' &&
                modal?.classList.contains(
                    'is-open'
                )
            ) {
                closeModal();
            }
        }
    );

    confirmButton?.addEventListener(
        'click',
        () => {
            closeModal();

            if (feedback) {
                feedback.hidden = false;
            }
        }
    );
})();
</script>
@endpush