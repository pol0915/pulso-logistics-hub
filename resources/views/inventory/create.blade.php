@extends('layouts.app')

@section('title', 'Add Asset | PULSO Logistics Hub')


@push('styles')
<style>
    /* ================================================================
       ADD ASSET PAGE
       ================================================================ */

    .asset-create-page {
        --ac-navy: #10263d;
        --ac-copy: #496580;
        --ac-muted: #71899c;
        --ac-teal: #007780;
        --ac-pink: #b90c61;
        --ac-blue: #365f8d;
        --ac-line: #d5e5ee;

        display: grid;

        gap: 20px;

        width: 100%;
        min-width: 0;

        color: var(--ac-navy);

        container-name: asset-create;
        container-type: inline-size;
    }


    .asset-create-page *,
    .asset-create-page *::before,
    .asset-create-page *::after {
        box-sizing: border-box;
    }


    /* ================================================================
       PAGE HEADING
       ================================================================ */

    .asset-create-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }


    .asset-create-heading-copy {
        min-width: 0;
    }


    .asset-create-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--ac-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .asset-create-heading h1 {
        margin: 0;

        color: var(--ac-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .asset-create-description {
        max-width: 720px;

        margin:
            9px
            0
            0;

        color: var(--ac-copy);

        font-size: 14px;
        line-height: 1.7;
    }


    /* ================================================================
       BACK BUTTON
       ================================================================ */

    .asset-create-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        flex-shrink: 0;

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
                #f7fbfd,
                #e4eef3
            );

        color: #31546d;

        box-shadow:
            3px 4px 10px rgba(101, 138, 163, .12),
            -3px -3px 8px rgba(255, 255, 255, .72);

        font-size: 11px;
        font-weight: 750;
        line-height: 1.4;

        text-decoration: none;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease;
    }


    .asset-create-back:hover {
        color: var(--ac-teal);

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


    .asset-create-back:focus-visible {
        outline:
            3px
            solid
            rgba(238, 18, 128, .28);

        outline-offset: 4px;
    }


    .asset-create-back svg {
        width: 16px;
        height: 16px;

        flex-shrink: 0;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* ================================================================
       CONTEXT STRIP
       ================================================================ */

    .asset-create-context {
        display: grid;

        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );

        gap: 12px;

        min-width: 0;
    }


    .asset-create-context-item {
        position: relative;

        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;
        min-height: 70px;

        padding:
            13px
            14px;

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


    .asset-create-context-item::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 30px;
        height: 3px;

        border-radius:
            0
            0
            999px
            999px;

        background: var(--context-tone);

        opacity: .5;

        content: "";
    }


    .asset-create-context-item:nth-child(1) {
        --context-tone: #007780;
        --context-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .asset-create-context-item:nth-child(2) {
        --context-tone: #b90c61;
        --context-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .asset-create-context-item:nth-child(3) {
        --context-tone: #365f8d;
        --context-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .asset-create-context-icon {
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

        background: var(--context-fill);

        color: var(--context-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .asset-create-context-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .asset-create-context-copy {
        min-width: 0;

        flex: 1;
    }


    .asset-create-context-copy strong {
        display: block;

        overflow: hidden;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 800;
        line-height: 1.4;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .asset-create-context-copy span {
        display: block;

        margin-top: 3px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.8px;
        line-height: 1.45;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       FORM WRAPPER
       ================================================================ */

    .asset-create-form {
        width: 100%;
        min-width: 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Shared asset form adjustments
    |--------------------------------------------------------------------------
    | These selectors now match the actual .ae-* classes used by the
    | shared x-asset-form component.
    */

    .asset-create-page .asset-editor {
        width: 100%;
        min-width: 0;
    }


    .asset-create-page .ae-content {
        gap: 20px;
    }


    .asset-create-page .ae-card {
        scroll-margin-top: 112px;
    }


    .asset-create-page .ae-photo-stage {
        max-height: 235px;
    }


    .asset-create-page .ae-photo-preview {
        max-height: 235px;
    }


    /*
    |--------------------------------------------------------------------------
    | Keep Storage and Acquisition balanced
    |--------------------------------------------------------------------------
    */

    .asset-create-page .ae-paired-sections {
        align-items: stretch;
    }


    .asset-create-page
    .ae-paired-sections
    > .ae-card {
        height: 100%;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container asset-create (max-width: 900px) {
        .asset-create-context {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .asset-create-context-item:last-child {
            grid-column:
                1
                / -1;
        }
    }


    @container asset-create (max-width: 700px) {
        .asset-create-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 17px;
        }


        .asset-create-back {
            align-self: flex-start;
        }


        .asset-create-context {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .asset-create-context-item:last-child {
            grid-column: auto;
        }
    }


    @container asset-create (max-width: 520px) {
        .asset-create-page {
            gap: 17px;
        }


        .asset-create-context {
            gap: 10px;
        }


        .asset-create-context-item {
            min-height: 64px;

            padding:
                11px
                12px;
        }


        .asset-create-context-icon {
            width: 36px;
            height: 36px;

            flex-basis: 36px;
        }


        .asset-create-context-copy strong {
            font-size: 10px;
        }


        .asset-create-context-copy span {
            white-space: normal;
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .asset-create-back {
            transition: none;
        }


        .asset-create-back:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div class="asset-create-page">

    {{-- =============================================================
         PAGE HEADING
         ============================================================= --}}

    <header class="asset-create-heading">

        <div class="asset-create-heading-copy">

            <p class="asset-create-eyebrow">
                Resource management
            </p>


            <h1>
                Add new asset
            </h1>


            <p class="asset-create-description">
                Create a reusable asset record with the information
                needed to identify, locate, monitor, and maintain the
                resource.
            </p>

        </div>


        <a
            href="{{ route('inventory.index') }}"
            class="asset-create-back"
        >
            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path d="M19 12H5"/>
                <path d="m11 6-6 6 6 6"/>
            </svg>


            <span>
                Back to inventory
            </span>
        </a>

    </header>


    {{-- =============================================================
         FORM CONTEXT
         ============================================================= --}}

    <section
        class="asset-create-context"
        aria-label="Asset entry reminders"
    >

        <article class="asset-create-context-item">

            <span
                class="asset-create-context-icon"
                aria-hidden="true"
            >
                <svg viewBox="0 0 24 24">
                    <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                    <path d="M3 8v9l9 5 9-5V8"/>
                    <path d="M12 13v9"/>
                </svg>
            </span>


            <div class="asset-create-context-copy">

                <strong>
                    Identify the asset
                </strong>

                <span>
                    Use a clear name, category, and asset ID.
                </span>

            </div>

        </article>


        <article class="asset-create-context-item">

            <span
                class="asset-create-context-icon"
                aria-hidden="true"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M12 21s7-5 7-11a7 7 0 1 0-14 0c0 6 7 11 7 11Z"/>

                    <circle
                        cx="12"
                        cy="10"
                        r="2.2"
                    />
                </svg>
            </span>


            <div class="asset-create-context-copy">

                <strong>
                    Keep location accurate
                </strong>

                <span>
                    Record where logistics staff can find it.
                </span>

            </div>

        </article>


        <article class="asset-create-context-item">

            <span
                class="asset-create-context-icon"
                aria-hidden="true"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M14.7 6.3a4 4 0 0 0-5-5L7 4l3 3-6.7 6.7a2.1 2.1 0 0 0 3 3L13 10a4 4 0 0 0 5-5Z"/>

                    <path d="m13 13 6 6"/>
                </svg>
            </span>


            <div class="asset-create-context-copy">

                <strong>
                    Record current condition
                </strong>

                <span>
                    This supports deployment and maintenance decisions.
                </span>

            </div>

        </article>

    </section>


    {{-- =============================================================
         SHARED ASSET FORM
         ============================================================= --}}

    <div class="asset-create-form">
        <x-asset-form mode="create" />
    </div>

</div>
@endsection