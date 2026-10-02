@extends('layouts.app')

@section('title', 'Edit Portable Sound System | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | SAMPLE ASSET
    |--------------------------------------------------------------------------
    | Front-end preview data only.
    */

    $asset = [
        'id' => 'PULSO-AUD-001',
        'name' => 'Portable Sound System',
        'category' => 'Audio',
        'description' => 'Main portable sound system used for PULSO events and community activities.',
        'quantity' => 1,
        'location' => 'Equipment Shelf A',
        'condition' => 'Good',
        'status' => 'Available',
        'source' => 'Purchased',
        'date_acquired' => '2026-02-14',
        'estimated_value' => '18500.00',
        'notes' => 'Keep inside protective carrying case when not in use.',
    ];

    $overviewItems = [
        [
            'label' => 'Current Status',
            'value' => $asset['status'],
            'tone' => 'teal',
            'icon' => 'check',
        ],
        [
            'label' => 'Condition',
            'value' => $asset['condition'],
            'tone' => 'pink',
            'icon' => 'tools',
        ],
        [
            'label' => 'Storage Location',
            'value' => $asset['location'],
            'tone' => 'blue',
            'icon' => 'location',
        ],
    ];
@endphp


@push('styles')
<style>
    /* ================================================================
       EDIT ASSET PAGE
       ================================================================ */

    .asset-edit-page {
        --ae-page-navy: #10263d;
        --ae-page-copy: #496580;
        --ae-page-muted: #71899c;
        --ae-page-teal: #007780;
        --ae-page-pink: #b90c61;
        --ae-page-blue: #365f8d;
        --ae-page-line: #d5e5ee;

        display: grid;

        gap: 20px;

        width: 100%;
        min-width: 0;

        color: var(--ae-page-navy);

        container-name: asset-edit-page;
        container-type: inline-size;
    }


    .asset-edit-page *,
    .asset-edit-page *::before,
    .asset-edit-page *::after {
        box-sizing: border-box;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .asset-edit-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }


    .asset-edit-heading-copy {
        min-width: 0;
    }


    .asset-edit-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--ae-page-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .asset-edit-heading h1 {
        margin: 0;

        color: var(--ae-page-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .asset-edit-description {
        max-width: 720px;

        margin:
            9px
            0
            0;

        color: var(--ae-page-copy);

        font-size: 14px;
        line-height: 1.7;
    }


    /* ================================================================
       HEADING ACTIONS
       ================================================================ */

    .asset-edit-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 9px;

        flex-shrink: 0;
    }


    .asset-edit-action {
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
        line-height: 1.4;

        text-decoration: none;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }


    .asset-edit-action:hover {
        color: var(--ae-page-teal);

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #dcecf2
            );

        transform:
            translateY(
                -1px
            );
    }


    .asset-edit-action:focus-visible {
        outline:
            3px
            solid
            rgba(238, 18, 128, .28);

        outline-offset: 4px;
    }


    .asset-edit-action svg {
        width: 16px;
        height: 16px;

        flex-shrink: 0;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .asset-edit-action-primary {
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


    .asset-edit-action-primary:hover {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    /* ================================================================
       CURRENT RECORD CARD
       ================================================================ */

    .asset-edit-record {
        position: relative;

        display: flex;
        align-items: center;

        gap: 14px;

        min-width: 0;

        padding:
            16px
            17px;

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
                #f0f7fa
            );

        box-shadow:
            4px 5px 10px rgba(78, 111, 132, .07),
            -4px -4px 9px rgba(255, 255, 255, .64),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }


    .asset-edit-record::after {
        position: absolute;

        top: 0;
        right: 18px;

        width: 34px;
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

        opacity: .55;

        content: "";
    }


    .asset-edit-record-icon {
        display: grid;
        place-items: center;

        width: 44px;
        height: 44px;

        flex: 0 0 44px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );

        color: var(--ae-page-teal);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .asset-edit-record-icon svg {
        width: 19px;
        height: 19px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .asset-edit-record-copy {
        min-width: 0;

        flex: 1;
    }


    .asset-edit-record-label {
        display: block;

        color: #71899c;

        font-size: 8.5px;
        font-weight: 800;

        letter-spacing: .08em;

        text-transform: uppercase;
    }


    .asset-edit-record-name {
        display: block;

        margin-top: 3px;

        color: #29475f;

        font-size: 12.5px;
        font-weight: 800;
        line-height: 1.45;
    }


    .asset-edit-record-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 7px;

        margin-top: 4px;

        color: #607c90;

        font-size: 9.5px;
    }


    .asset-edit-meta-dot {
        width: 4px;
        height: 4px;

        flex: 0 0 4px;

        border-radius: 50%;

        background: #94a9b7;
    }


    /* ================================================================
       OVERVIEW
       ================================================================ */

    .asset-edit-overview {
        display: grid;

        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );

        gap: 12px;
    }


    .asset-edit-overview-card {
        --overview-tone: #007780;
        --overview-fill:
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
        min-height: 76px;

        padding:
            12px
            13px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #f2f8fa
            );

        box-shadow:
            4px 5px 10px rgba(78, 111, 132, .07),
            -4px -4px 9px rgba(255, 255, 255, .64),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }


    .asset-edit-overview-card::after {
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

        background: var(--overview-tone);

        opacity: .5;

        content: "";
    }


    .asset-edit-overview-card[data-tone="teal"] {
        --overview-tone: #007780;

        --overview-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .asset-edit-overview-card[data-tone="pink"] {
        --overview-tone: #b90c61;

        --overview-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .asset-edit-overview-card[data-tone="blue"] {
        --overview-tone: #365f8d;

        --overview-fill:
            linear-gradient(
                145deg,
                #edf4fb,
                #dce8f4
            );
    }


    .asset-edit-overview-icon {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 11px;

        background: var(--overview-fill);

        color: var(--overview-tone);

        box-shadow:
            3px 4px 7px rgba(78, 111, 132, .07),
            -2px -2px 5px rgba(255, 255, 255, .68);
    }


    .asset-edit-overview-icon svg {
        width: 16px;
        height: 16px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .asset-edit-overview-copy {
        min-width: 0;

        flex: 1;
    }


    .asset-edit-overview-copy span {
        display: block;

        color: #71899c;

        font-size: 8.5px;
        font-weight: 650;
    }


    .asset-edit-overview-copy strong {
        display: block;

        margin-top: 4px;

        overflow: hidden;

        color: var(--overview-tone);

        font-size: 11px;
        font-weight: 800;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       EDIT CONTEXT
       ================================================================ */

    .asset-edit-context {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        padding:
            11px
            13px;

        border:
            1px
            solid
            rgba(255, 255, 255, .9);

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e6f4f6,
                #edf7f9
            );

        color: #526f84;

        box-shadow:
            inset 2px 2px 5px rgba(75, 111, 132, .08),
            inset -2px -2px 5px rgba(255, 255, 255, .72);
    }


    .asset-edit-context svg {
        width: 16px;
        height: 16px;

        flex: 0 0 16px;

        margin-top: 1px;

        fill: none;

        color: var(--ae-page-teal);

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .asset-edit-context p {
        margin: 0;

        font-size: 10px;
        line-height: 1.6;
    }


    .asset-edit-context strong {
        color: #29475f;

        font-weight: 750;
    }


    /* ================================================================
       FORM WRAPPER
       ================================================================ */

    .asset-edit-form {
        width: 100%;
        min-width: 0;
    }


    .asset-edit-page .asset-editor {
        width: 100%;
        min-width: 0;
    }


    .asset-edit-page .ae-content {
        gap: 20px;
    }


    .asset-edit-page .ae-card {
        scroll-margin-top: 112px;
    }


    /*
    |--------------------------------------------------------------------------
    | The page already identifies the edited record above.
    | Keep the shared component's own mode strip visible but compact.
    |--------------------------------------------------------------------------
    */

    .asset-edit-page .ae-mode-strip {
        min-height: 66px;

        padding:
            11px
            13px;
    }


    .asset-edit-page .ae-mode-strip-icon {
        width: 38px;
        height: 38px;

        flex-basis: 38px;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container asset-edit-page (max-width: 820px) {
        .asset-edit-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }


        .asset-edit-overview {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .asset-edit-overview-card:last-child {
            grid-column:
                1
                / -1;
        }
    }


    @container asset-edit-page (max-width: 620px) {
        .asset-edit-actions {
            width: 100%;
        }


        .asset-edit-action {
            flex: 1;
        }


        .asset-edit-overview {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .asset-edit-overview-card:last-child {
            grid-column: auto;
        }
    }


    @container asset-edit-page (max-width: 440px) {
        .asset-edit-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);
        }


        .asset-edit-action {
            width: 100%;
        }


        .asset-edit-record {
            align-items: flex-start;
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .asset-edit-action {
            transition: none;
        }


        .asset-edit-action:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div class="asset-edit-page">

    {{-- =============================================================
         PAGE HEADING
         ============================================================= --}}

    <header class="asset-edit-heading">

        <div class="asset-edit-heading-copy">

            <p class="asset-edit-eyebrow">
                Resource management
            </p>


            <h1>
                Edit asset
            </h1>


            <p class="asset-edit-description">
                Update the identification, storage, condition, status,
                acquisition details, and internal notes of this inventory
                record.
            </p>

        </div>


        <div class="asset-edit-actions">

            <a
                href="{{ route('inventory.index') }}"
                class="asset-edit-action"
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M19 12H5"/>
                    <path d="m11 6-6 6 6 6"/>
                </svg>


                <span>
                    Inventory
                </span>
            </a>


            <a
                href="{{ route('inventory.show') }}"
                class="
                    asset-edit-action
                    asset-edit-action-primary
                "
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


                <span>
                    View asset
                </span>
            </a>

        </div>

    </header>


    {{-- =============================================================
         CURRENT RECORD
         ============================================================= --}}

    <section
        class="asset-edit-record"
        aria-label="Asset being edited"
    >

        <span
            class="asset-edit-record-icon"
            aria-hidden="true"
        >
            <svg viewBox="0 0 24 24">
                <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                <path d="M3 8v9l9 5 9-5V8"/>
                <path d="M12 13v9"/>
            </svg>
        </span>


        <div class="asset-edit-record-copy">

            <span class="asset-edit-record-label">
                Editing record
            </span>


            <strong class="asset-edit-record-name">
                {{ $asset['name'] }}
            </strong>


            <div class="asset-edit-record-meta">

                <span>
                    {{ $asset['id'] }}
                </span>


                <span
                    class="asset-edit-meta-dot"
                    aria-hidden="true"
                ></span>


                <span>
                    {{ $asset['category'] }}
                </span>

            </div>

        </div>

    </section>


    {{-- =============================================================
         CURRENT STATE
         ============================================================= --}}

    <section
        class="asset-edit-overview"
        aria-label="Current asset state"
    >

        @foreach ($overviewItems as $item)

            <article
                class="asset-edit-overview-card"
                data-tone="{{ $item['tone'] }}"
            >

                <span
                    class="asset-edit-overview-icon"
                    aria-hidden="true"
                >

                    @if ($item['icon'] === 'check')

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                    @elseif ($item['icon'] === 'tools')

                        <svg viewBox="0 0 24 24">
                            <path d="M14.7 6.3a4 4 0 0 0-5-5L7 4l3 3-6.7 6.7a2.1 2.1 0 0 0 3 3L13 10a4 4 0 0 0 5-5Z"/>

                            <path d="m13 13 6 6"/>
                        </svg>

                    @else

                        <svg viewBox="0 0 24 24">
                            <path d="M12 21s7-5 7-11a7 7 0 1 0-14 0c0 6 7 11 7 11Z"/>

                            <circle
                                cx="12"
                                cy="10"
                                r="2.2"
                            />
                        </svg>

                    @endif

                </span>


                <div class="asset-edit-overview-copy">

                    <span>
                        {{ $item['label'] }}
                    </span>


                    <strong>
                        {{ $item['value'] }}
                    </strong>

                </div>

            </article>

        @endforeach

    </section>


    {{-- =============================================================
         EDIT NOTICE
         ============================================================= --}}

    <div
        class="asset-edit-context"
        role="note"
    >

        <svg
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <circle
                cx="12"
                cy="12"
                r="9"
            />

            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </svg>


        <p>
            You are editing the existing record for

            <strong>
                {{ $asset['name'] }}
            </strong>.

            The asset ID remains system-managed. This is still a
            front-end preview, so Save Changes will validate the form
            but will not update the database yet.
        </p>

    </div>


    {{-- =============================================================
         SHARED ASSET FORM
         ============================================================= --}}

    <div class="asset-edit-form">

        <x-asset-form
            mode="edit"
            :asset="$asset"
        />

    </div>

</div>
@endsection