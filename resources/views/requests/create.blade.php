@extends('layouts.app')

@section('title', 'New Request | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | FORM OPTIONS
    |--------------------------------------------------------------------------
    */

    $committees = [
        'Education Committee',
        'Environment & Health',
        'Community Outreach',
        'Events Committee',
        'Arts & Culture',
        'Sports Committee',
        'Volunteer Management',
    ];

    $resourceOptions = [
        'Portable Sound System',
        'Monoblock Chairs',
        'Folding Tables',
        'Projector',
        'Extension Cord 20m',
        'Wireless Microphone Set',
        'Large Event Tent',
        'Basic Tool Kit',
        'Power Strip',
        'PULSO Event Banner',
        'Plastic Storage Bin',
    ];

    $priorities = [
        'High',
        'Medium',
        'Low',
    ];
@endphp


@push('styles')
<style>
    /* ================================================================
       REQUEST CREATE PAGE
       ================================================================ */

    .request-create-page {
        --rc-navy: #10263d;
        --rc-copy: #496580;
        --rc-muted: #71899c;
        --rc-line: #d5e5ee;

        --rc-teal: #007780;
        --rc-teal-bright: #05adb6;
        --rc-pink: #b90c61;
        --rc-pink-bright: #ee1280;
        --rc-blue: #365f8d;

        display: grid;
        gap: 20px;

        width: 100%;
        min-width: 0;

        color: var(--rc-navy);

        container-name: request-create;
        container-type: inline-size;
    }


    .request-create-page *,
    .request-create-page *::before,
    .request-create-page *::after {
        box-sizing: border-box;
    }


    /* ================================================================
       ICON
       ================================================================ */

    .rc-icon {
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


    /* ================================================================
       PAGE HEADING
       ================================================================ */

    .rc-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }


    .rc-heading-copy {
        min-width: 0;
    }


    .rc-eyebrow {
        margin: 0 0 7px;

        color: var(--rc-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .rc-heading h1 {
        margin: 0;

        color: var(--rc-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .rc-description {
        max-width: 720px;

        margin: 9px 0 0;

        color: var(--rc-copy);

        font-size: 14px;
        line-height: 1.7;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .rc-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 44px;

        flex-shrink: 0;

        padding: 9px 15px;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f7fbfd,
                #e4eff4
            );

        color: #31546d;

        box-shadow:
            4px 5px 10px rgba(83, 117, 139, .11),
            -3px -3px 8px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.4;

        text-decoration: none;

        cursor: pointer;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease,
            box-shadow 160ms ease;
    }


    .rc-button:hover {
        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #dcecf2
            );

        color: var(--rc-teal);

        transform: translateY(-1px);
    }


    .rc-button:active {
        transform: translateY(0);
    }


    .rc-button-primary {
        border-color: #71ced4;

        background:
            linear-gradient(
                145deg,
                #00858f,
                #00717a
            );

        color: #ffffff;

        box-shadow:
            4px 6px 12px rgba(0, 126, 137, .19),
            inset 1px 1px 3px rgba(115, 231, 237, .4);
    }


    .rc-button-primary:hover {
        background:
            linear-gradient(
                145deg,
                #007c85,
                #006771
            );

        color: #ffffff;
    }


    .rc-button-add {
        min-height: 42px;

        border-color: rgba(149, 226, 230, .9);

        background:
            linear-gradient(
                145deg,
                #e0f7f7,
                #cdebed
            );

        color: #00747c;
    }


    .rc-button-add:hover {
        background:
            linear-gradient(
                145deg,
                #e8fbfb,
                #c5e8ea
            );

        color: #00626a;
    }


    .rc-button:focus-visible,
    .rc-remove:focus-visible {
        outline: 3px solid rgba(238, 18, 128, .3);

        outline-offset: 4px;
    }


    /* ================================================================
       PROGRESS
       ================================================================ */

    .rc-progress {
        display: grid;

        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );

        gap: 11px;
    }


    .rc-progress-item {
        --progress-tone: #007780;

        --progress-fill:
            linear-gradient(
                145deg,
                #e1f7f7,
                #d0eeee
            );

        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;
        min-height: 66px;

        padding: 11px 13px;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #eff7fa
            );

        box-shadow:
            4px 5px 10px rgba(82, 115, 136, .08),
            -3px -3px 8px rgba(255, 255, 255, .72),
            inset 1px 1px 2px rgba(255, 255, 255, .88);
    }


    .rc-progress-item[data-tone="pink"] {
        --progress-tone: #b90c61;

        --progress-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d4e3
            );
    }


    .rc-progress-item[data-tone="blue"] {
        --progress-tone: #365f8d;

        --progress-fill:
            linear-gradient(
                145deg,
                #edf4fb,
                #dce8f4
            );
    }


    .rc-progress-number {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 11px;

        background: var(--progress-fill);

        color: var(--progress-tone);

        font-size: 10px;
        font-weight: 850;
    }


    .rc-progress-copy {
        min-width: 0;
    }


    .rc-progress-copy strong {
        display: block;

        color: #29475f;

        font-size: 10px;
        font-weight: 800;
    }


    .rc-progress-copy span {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       FORM
       ================================================================ */

    .rc-form {
        display: grid;

        width: 100%;
        min-width: 0;

        gap: 20px;
    }


    /* ================================================================
       CARDS
       ================================================================ */

    .rc-card {
        position: relative;

        min-width: 0;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 22px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .95),
                rgba(231, 244, 250, .92)
            );

        box-shadow:
            7px 9px 20px rgba(92, 127, 149, .12),
            -5px -5px 14px rgba(255, 255, 255, .76),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }


    .rc-card::before {
        position: absolute;

        top: 0;
        left: 28px;

        width: 48px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background:
            linear-gradient(
                90deg,
                var(--rc-teal-bright),
                var(--rc-pink-bright)
            );

        opacity: .48;

        content: "";
    }


    .rc-card-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 20px 22px;

        border-bottom: 1px solid var(--rc-line);
    }


    .rc-section-title {
        display: flex;
        align-items: center;

        gap: 12px;

        min-width: 0;
    }


    .rc-step {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border: 1px solid #ffffff;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e2f8f8,
                #cff0f2
            );

        color: var(--rc-teal);

        box-shadow:
            3px 4px 8px rgba(118, 156, 172, .11),
            -2px -2px 6px rgba(255, 255, 255, .7);

        font-size: 11px;
        font-weight: 800;
    }


    .rc-step-pink {
        background:
            linear-gradient(
                145deg,
                #fde9f3,
                #f5d4e4
            );

        color: var(--rc-pink);
    }


    .rc-step-blue {
        background:
            linear-gradient(
                145deg,
                #edf4fb,
                #dbe8f4
            );

        color: var(--rc-blue);
    }


    .rc-card-heading h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;
        line-height: 1.35;

        letter-spacing: -.025em;
    }


    .rc-card-heading p {
        margin: 4px 0 0;

        color: var(--rc-copy);

        font-size: 11.5px;
        line-height: 1.5;
    }


    /* ================================================================
       RESOURCE ACTIONS
       ================================================================ */

    .rc-resource-actions {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-shrink: 0;
    }


    .rc-resource-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 4px;

        min-height: 30px;

        padding: 5px 10px;

        border: 1px solid rgba(255, 255, 255, .9);

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #f3f8fb,
                #e2edf3
            );

        color: #60798d;

        font-size: 9px;
        font-weight: 700;
    }


    .rc-resource-count strong {
        color: var(--rc-pink);

        font-size: 11px;
        font-weight: 850;
    }


    /* ================================================================
       FIELDS
       ================================================================ */

    .rc-fields {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 20px 18px;

        padding: 22px;
    }


    .rc-field {
        min-width: 0;
    }


    .rc-full {
        grid-column: 1 / -1;
    }


    .rc-label {
        display: block;

        margin-bottom: 7px;

        color: #29475f;

        font-size: 11px;
        font-weight: 750;
        line-height: 1.4;
    }


    .rc-required {
        margin-left: 2px;

        color: var(--rc-pink);
    }


    .rc-optional {
        margin-left: 4px;

        color: #7b90a0;

        font-size: 9px;
        font-weight: 500;
    }


    .rc-input {
        display: block;

        width: 100%;
        min-width: 0;
        min-height: 45px;

        padding: 10px 12px;

        border: 1px solid #d0e1e9;

        border-radius: 13px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e8f1f6,
                #eef6fa
            );

        color: var(--rc-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .14),
            inset -3px -3px 7px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 12px;
        line-height: 1.4;

        transition:
            border-color 160ms ease,
            box-shadow 160ms ease,
            background 160ms ease;
    }


    .rc-input::placeholder {
        color: #7a91a3;
    }


    .rc-input:focus {
        border-color: rgba(0, 126, 137, .5);

        background: #f0f8fb;

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .11),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .09);
    }


    textarea.rc-input {
        min-height: 104px;

        resize: vertical;
    }


    .rc-help {
        margin: 7px 0 0;

        color: var(--rc-muted);

        font-size: 9.5px;
        line-height: 1.55;
    }


    /* ================================================================
       PRIORITY
       ================================================================ */

    .rc-priority-help {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 10px;

        margin-top: 8px;
    }


    .rc-priority-chip {
        display: inline-flex;
        align-items: center;

        gap: 5px;

        color: #71899c;

        font-size: 9px;
    }


    .rc-priority-dot {
        width: 6px;
        height: 6px;

        flex: 0 0 6px;

        border-radius: 50%;
    }


    .rc-priority-dot-high {
        background: #ad343d;
    }


    .rc-priority-dot-medium {
        background: #b47719;
    }


    .rc-priority-dot-low {
        background: #60798d;
    }


    /* ================================================================
       RESOURCE BUILDER
       ================================================================ */

    .rc-resources-body {
        padding: 20px 22px 22px;
    }


    .rc-resource-list {
        display: grid;

        gap: 12px;
    }


    .rc-resource-row {
        display: grid;

        grid-template-columns:
            40px
            minmax(0, 1fr)
            130px
            42px;

        align-items: end;

        gap: 13px;

        padding: 14px;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                rgba(244, 250, 252, .95),
                rgba(226, 240, 247, .9)
            );

        box-shadow:
            3px 4px 9px rgba(83, 117, 139, .07),
            -2px -2px 7px rgba(255, 255, 255, .56),
            inset 1px 1px 2px rgba(255, 255, 255, .8);
    }


    .rc-resource-number {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        align-self: end;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #fce7f1,
                #f3d2e2
            );

        color: var(--rc-pink);

        box-shadow:
            2px 3px 7px rgba(95, 120, 137, .08);

        font-size: 9px;
        font-weight: 850;
    }


    .rc-resource-number::before {
        content: attr(data-number);
    }


    .rc-remove {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;

        align-self: end;

        padding: 0;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #fcebf1,
                #f5d9e3
            );

        color: #b12c51;

        box-shadow:
            2px 3px 7px rgba(101, 138, 163, .09);

        cursor: pointer;

        transition:
            background 150ms ease,
            opacity 150ms ease,
            transform 150ms ease;
    }


    .rc-remove:hover:not(:disabled) {
        background:
            linear-gradient(
                145deg,
                #fbe2eb,
                #f3ccda
            );

        transform: translateY(-1px);
    }


    .rc-remove:disabled {
        opacity: .35;

        cursor: not-allowed;

        transform: none;
    }


    .rc-remove .rc-icon {
        width: 16px;
        height: 16px;
    }


    .rc-resources-help {
        display: flex;
        align-items: flex-start;

        gap: 7px;

        margin: 13px 0 0;

        color: var(--rc-muted);

        font-size: 9.5px;
        line-height: 1.55;
    }


    .rc-resources-help .rc-icon {
        width: 14px;
        height: 14px;

        margin-top: 1px;

        color: var(--rc-teal);
    }


    /* ================================================================
       FEEDBACK
       ================================================================ */

    .rc-feedback {
        display: flex;
        align-items: flex-start;

        gap: 11px;

        padding: 13px 15px;

        border: 1px solid #aadbd8;

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e4f6f3,
                #d6efec
            );

        color: #286a63;

        box-shadow:
            inset 2px 2px 5px rgba(80, 123, 127, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .66);

        font-size: 11px;
        line-height: 1.55;
    }


    .rc-feedback[hidden] {
        display: none !important;
    }


    .rc-feedback .rc-icon {
        width: 18px;
        height: 18px;

        margin-top: 1px;

        color: var(--rc-teal);
    }


    .rc-feedback strong {
        color: #175a56;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .rc-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 17px 20px;

        border: 1px solid rgba(255, 255, 255, .96);

        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                #f9fdff,
                #eaf5f9
            );

        box-shadow:
            4px 5px 13px rgba(101, 138, 163, .09),
            -3px -3px 8px rgba(255, 255, 255, .58),
            inset 1px 1px 2px rgba(255, 255, 255, .86);
    }


    .rc-footer-copy p {
        margin: 0;

        color: var(--rc-copy);

        font-size: 10px;
        line-height: 1.5;
    }


    .rc-footer-copy p + p {
        margin-top: 3px;

        color: var(--rc-muted);

        font-size: 9px;
    }


    .rc-footer-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 10px;

        flex-shrink: 0;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container request-create (max-width: 760px) {
        .rc-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 16px;
        }


        .rc-progress {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rc-fields {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .rc-full {
            grid-column: auto;
        }


        .rc-card-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 15px;
        }


        .rc-resource-actions {
            width: 100%;

            justify-content: space-between;
        }


        .rc-resource-row {
            grid-template-columns:
                40px
                minmax(0, 1fr)
                110px
                42px;
        }
    }


    @container request-create (max-width: 580px) {
        .rc-resource-row {
            grid-template-columns:
                36px
                minmax(0, 1fr)
                42px;

            align-items: end;
        }


        .rc-resource-number {
            width: 36px;
            height: 36px;
        }


        .rc-resource-field {
            grid-column: 2 / -1;
        }


        .rc-quantity-field {
            grid-column: 2 / 3;
        }


        .rc-remove {
            grid-column: 3 / 4;
        }


        .rc-footer {
            align-items: stretch;
            flex-direction: column;
        }


        .rc-footer-actions {
            justify-content: flex-end;
        }
    }


    @container request-create (max-width: 420px) {
        .rc-card-heading,
        .rc-fields,
        .rc-resources-body,
        .rc-footer {
            padding: 17px;
        }


        .rc-resource-actions {
            align-items: stretch;
            flex-direction: column;
        }


        .rc-resource-actions .rc-button {
            width: 100%;
        }


        .rc-resource-count {
            width: fit-content;
        }


        .rc-footer-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);

            width: 100%;
        }


        .rc-footer-actions .rc-button {
            width: 100%;
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .rc-button,
        .rc-remove {
            transition: none;
        }


        .rc-button:hover,
        .rc-remove:hover:not(:disabled) {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div
    class="request-create-page"
    id="request-create-page"
>

    {{-- =============================================================
         HEADING
         ============================================================= --}}

    <header class="rc-heading">

        <div class="rc-heading-copy">

            <p class="rc-eyebrow">
                Request coordination
            </p>

            <h1>
                New logistics request
            </h1>

            <p class="rc-description">
                Provide the activity details and identify the resources
                the logistics team needs to prepare for the activity.
            </p>

        </div>


        <a
            href="{{ route('requests.index') }}"
            class="rc-button"
        >
            <svg
                class="rc-icon"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path d="M19 12H5"/>
                <path d="m11 6-6 6 6 6"/>
            </svg>

            Back to requests
        </a>

    </header>


    {{-- =============================================================
         PROGRESS
         ============================================================= --}}

    <section
        class="rc-progress"
        aria-label="Request creation steps"
    >

        <article
            class="rc-progress-item"
            data-tone="teal"
        >
            <span class="rc-progress-number">
                01
            </span>

            <div class="rc-progress-copy">
                <strong>
                    Project & schedule
                </strong>

                <span>
                    Activity, date, priority and venue
                </span>
            </div>
        </article>


        <article
            class="rc-progress-item"
            data-tone="pink"
        >
            <span class="rc-progress-number">
                02
            </span>

            <div class="rc-progress-copy">
                <strong>
                    Requested resources
                </strong>

                <span>
                    Equipment, materials and quantities
                </span>
            </div>
        </article>


        <article
            class="rc-progress-item"
            data-tone="blue"
        >
            <span class="rc-progress-number">
                03
            </span>

            <div class="rc-progress-copy">
                <strong>
                    Additional information
                </strong>

                <span>
                    Preparation and handling notes
                </span>
            </div>
        </article>

    </section>


    {{-- =============================================================
         FORM
         ============================================================= --}}

    <form
        id="create-request-form"
        class="rc-form"
    >

        {{-- =========================================================
             01 PROJECT & SCHEDULE
             ========================================================= --}}

        <section
            class="rc-card"
            aria-labelledby="rc-project-title"
        >

            <header class="rc-card-heading">

                <div class="rc-section-title">

                    <span
                        class="rc-step"
                        aria-hidden="true"
                    >
                        01
                    </span>


                    <div>
                        <h2 id="rc-project-title">
                            Project & schedule
                        </h2>

                        <p>
                            Tell the logistics team where and when the
                            resources will be needed.
                        </p>
                    </div>

                </div>

            </header>


            <div class="rc-fields">

                <div class="rc-field">

                    <label
                        for="request-project-name"
                        class="rc-label"
                    >
                        Project / Activity name

                        <span
                            class="rc-required"
                            aria-hidden="true"
                        >
                            *
                        </span>
                    </label>

                    <input
                        id="request-project-name"
                        name="project_name"
                        class="rc-input"
                        type="text"
                        placeholder="e.g. Youth Leadership Summit"
                        autocomplete="off"
                        required
                    >

                </div>


                <div class="rc-field">

                    <label
                        for="request-committee"
                        class="rc-label"
                    >
                        Committee

                        <span
                            class="rc-required"
                            aria-hidden="true"
                        >
                            *
                        </span>
                    </label>

                    <select
                        id="request-committee"
                        name="committee"
                        class="rc-input"
                        required
                    >
                        <option value="">
                            Select committee
                        </option>

                        @foreach ($committees as $committee)
                            <option value="{{ $committee }}">
                                {{ $committee }}
                            </option>
                        @endforeach
                    </select>

                </div>


                <div class="rc-field">

                    <label
                        for="request-activity-date"
                        class="rc-label"
                    >
                        Activity date

                        <span
                            class="rc-required"
                            aria-hidden="true"
                        >
                            *
                        </span>
                    </label>

                    <input
                        id="request-activity-date"
                        name="activity_date"
                        class="rc-input"
                        type="date"
                        required
                    >

                </div>


                <div class="rc-field">

                    <label
                        for="request-needed-date"
                        class="rc-label"
                    >
                        Date resources are needed

                        <span
                            class="rc-required"
                            aria-hidden="true"
                        >
                            *
                        </span>
                    </label>

                    <input
                        id="request-needed-date"
                        name="date_needed"
                        class="rc-input"
                        type="date"
                        aria-describedby="rc-needed-help"
                        required
                    >

                    <p
                        id="rc-needed-help"
                        class="rc-help"
                    >
                        Must be on or before the activity date.
                    </p>

                </div>


                <div class="rc-field">

                    <label
                        for="request-priority"
                        class="rc-label"
                    >
                        Priority

                        <span
                            class="rc-required"
                            aria-hidden="true"
                        >
                            *
                        </span>
                    </label>

                    <select
                        id="request-priority"
                        name="priority"
                        class="rc-input"
                        required
                    >
                        <option value="">
                            Select priority
                        </option>

                        @foreach ($priorities as $priority)
                            <option value="{{ $priority }}">
                                {{ $priority }}
                            </option>
                        @endforeach
                    </select>


                    <div
                        class="rc-priority-help"
                        aria-hidden="true"
                    >

                        <span class="rc-priority-chip">
                            <span
                                class="
                                    rc-priority-dot
                                    rc-priority-dot-high
                                "
                            ></span>

                            High
                        </span>


                        <span class="rc-priority-chip">
                            <span
                                class="
                                    rc-priority-dot
                                    rc-priority-dot-medium
                                "
                            ></span>

                            Medium
                        </span>


                        <span class="rc-priority-chip">
                            <span
                                class="
                                    rc-priority-dot
                                    rc-priority-dot-low
                                "
                            ></span>

                            Low
                        </span>

                    </div>

                </div>


                <div class="rc-field">

                    <label
                        for="request-venue"
                        class="rc-label"
                    >
                        Venue

                        <span
                            class="rc-required"
                            aria-hidden="true"
                        >
                            *
                        </span>
                    </label>

                    <input
                        id="request-venue"
                        name="venue"
                        class="rc-input"
                        type="text"
                        placeholder="Event venue or project location"
                        autocomplete="off"
                        required
                    >

                </div>


                <div class="rc-field rc-full">

                    <label
                        for="request-purpose"
                        class="rc-label"
                    >
                        Purpose

                        <span class="rc-optional">
                            Optional
                        </span>
                    </label>

                    <textarea
                        id="request-purpose"
                        name="purpose"
                        class="rc-input"
                        rows="3"
                        placeholder="Briefly explain how the requested resources will be used."
                    ></textarea>

                </div>

            </div>

        </section>


        {{-- =========================================================
             02 RESOURCES
             ========================================================= --}}

        <section
            class="rc-card"
            aria-labelledby="rc-resources-title"
        >

            <header class="rc-card-heading">

                <div class="rc-section-title">

                    <span
                        class="
                            rc-step
                            rc-step-pink
                        "
                        aria-hidden="true"
                    >
                        02
                    </span>

                    <div>
                        <h2 id="rc-resources-title">
                            Requested resources
                        </h2>

                        <p>
                            Select each resource and specify the required
                            quantity.
                        </p>
                    </div>

                </div>


                <div class="rc-resource-actions">

                    <span class="rc-resource-count">
                        <strong id="request-resource-count">
                            1
                        </strong>

                        <span id="request-resource-count-label">
                            item
                        </span>
                    </span>


                    <button
                        id="add-request-item"
                        class="
                            rc-button
                            rc-button-add
                        "
                        type="button"
                    >
                        <svg
                            class="rc-icon"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>

                        Add item
                    </button>

                </div>

            </header>


            <div class="rc-resources-body">

                <div
                    id="request-items-container"
                    class="rc-resource-list"
                    aria-live="polite"
                    aria-relevant="additions removals"
                >

                    <div
                        class="rc-resource-row"
                        data-request-item-row
                    >

                        <span
                            class="rc-resource-number"
                            data-resource-number
                            data-number="01"
                            aria-hidden="true"
                        ></span>


                        <div
                            class="
                                rc-field
                                rc-resource-field
                            "
                        >

                            <label
                                for="request-resource-1"
                                class="rc-label"
                                data-resource-label
                            >
                                Resource

                                <span
                                    class="rc-required"
                                    aria-hidden="true"
                                >
                                    *
                                </span>
                            </label>

                            <select
                                id="request-resource-1"
                                name="resources[]"
                                class="rc-input"
                                data-resource-select
                                required
                            >
                                <option value="">
                                    Select resource
                                </option>

                                @foreach ($resourceOptions as $resource)
                                    <option value="{{ $resource }}">
                                        {{ $resource }}
                                    </option>
                                @endforeach
                            </select>

                        </div>


                        <div
                            class="
                                rc-field
                                rc-quantity-field
                            "
                        >

                            <label
                                for="request-quantity-1"
                                class="rc-label"
                                data-quantity-label
                            >
                                Quantity

                                <span
                                    class="rc-required"
                                    aria-hidden="true"
                                >
                                    *
                                </span>
                            </label>

                            <input
                                id="request-quantity-1"
                                name="quantities[]"
                                class="rc-input"
                                type="number"
                                min="1"
                                step="1"
                                value="1"
                                inputmode="numeric"
                                data-quantity-input
                                required
                            >

                        </div>


                        <button
                            class="rc-remove"
                            type="button"
                            data-remove-request-item
                            aria-label="Remove requested resource 1"
                            title="Remove item"
                            disabled
                        >
                            <svg
                                class="rc-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M4 7h16"/>
                                <path d="M9 11v6"/>
                                <path d="M15 11v6"/>
                                <path d="M6 7l1 14h10l1-14"/>
                                <path d="M9 7V4h6v3"/>
                            </svg>
                        </button>

                    </div>

                </div>


                <p class="rc-resources-help">

                    <svg
                        class="rc-icon"
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

                    <span>
                        Use one row per resource. Duplicate resources are
                        not allowed, and at least one item must remain in
                        the request.
                    </span>

                </p>

            </div>

        </section>


        {{-- =========================================================
             03 ADDITIONAL INFO
             ========================================================= --}}

        <section
            class="rc-card"
            aria-labelledby="rc-additional-title"
        >

            <header class="rc-card-heading">

                <div class="rc-section-title">

                    <span
                        class="
                            rc-step
                            rc-step-blue
                        "
                        aria-hidden="true"
                    >
                        03
                    </span>

                    <div>
                        <h2 id="rc-additional-title">
                            Additional information
                        </h2>

                        <p>
                            Add preparation, transport, setup, or handling
                            instructions if needed.
                        </p>
                    </div>

                </div>

            </header>


            <div class="rc-fields">

                <div class="rc-field">

                    <label
                        for="request-additional-requirements"
                        class="rc-label"
                    >
                        Additional requirements

                        <span class="rc-optional">
                            Optional
                        </span>
                    </label>

                    <textarea
                        id="request-additional-requirements"
                        name="additional_requirements"
                        class="rc-input"
                        rows="4"
                        placeholder="e.g. Setup assistance or transportation to the venue."
                    ></textarea>

                </div>


                <div class="rc-field">

                    <label
                        for="request-notes"
                        class="rc-label"
                    >
                        Internal notes

                        <span class="rc-optional">
                            Optional
                        </span>
                    </label>

                    <textarea
                        id="request-notes"
                        name="notes"
                        class="rc-input"
                        rows="4"
                        placeholder="Add other details for the logistics team."
                    ></textarea>

                </div>

            </div>

        </section>


        {{-- =========================================================
             FEEDBACK
             ========================================================= --}}

        <div
            id="request-create-feedback"
            class="rc-feedback"
            role="status"
            aria-live="polite"
            hidden
        >
            <svg
                class="rc-icon"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <circle
                    cx="12"
                    cy="12"
                    r="9"
                />

                <path d="m8 12 3 3 5-6"/>
            </svg>

            <div>
                <strong>
                    Request preview validated.
                </strong>

                The form is complete. Once backend submission is
                connected, this request can enter the logistics workflow.
            </div>
        </div>


        {{-- =========================================================
             FOOTER
             ========================================================= --}}

        <footer class="rc-footer">

            <div class="rc-footer-copy">

                <p>
                    Fields marked

                    <span
                        class="rc-required"
                        aria-hidden="true"
                    >
                        *
                    </span>

                    are required.
                </p>

                <p>
                    Front-end preview only. No database record is created yet.
                </p>

            </div>


            <div class="rc-footer-actions">

                <a
                    href="{{ route('requests.index') }}"
                    class="rc-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="
                        rc-button
                        rc-button-primary
                    "
                >
                    <svg
                        class="rc-icon"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="m5 12 4 4L19 6"/>
                    </svg>

                    Submit request
                </button>

            </div>

        </footer>

    </form>


    {{-- =============================================================
         RESOURCE TEMPLATE
         ============================================================= --}}

    <template id="request-item-template">

        <div
            class="rc-resource-row"
            data-request-item-row
        >

            <span
                class="rc-resource-number"
                data-resource-number
                data-number="00"
                aria-hidden="true"
            ></span>


            <div
                class="
                    rc-field
                    rc-resource-field
                "
            >

                <label
                    class="rc-label"
                    data-resource-label
                >
                    Resource

                    <span
                        class="rc-required"
                        aria-hidden="true"
                    >
                        *
                    </span>
                </label>

                <select
                    name="resources[]"
                    class="rc-input"
                    data-resource-select
                    required
                >
                    <option value="">
                        Select resource
                    </option>

                    @foreach ($resourceOptions as $resource)
                        <option value="{{ $resource }}">
                            {{ $resource }}
                        </option>
                    @endforeach
                </select>

            </div>


            <div
                class="
                    rc-field
                    rc-quantity-field
                "
            >

                <label
                    class="rc-label"
                    data-quantity-label
                >
                    Quantity

                    <span
                        class="rc-required"
                        aria-hidden="true"
                    >
                        *
                    </span>
                </label>

                <input
                    name="quantities[]"
                    class="rc-input"
                    type="number"
                    min="1"
                    step="1"
                    value="1"
                    inputmode="numeric"
                    data-quantity-input
                    required
                >

            </div>


            <button
                class="rc-remove"
                type="button"
                data-remove-request-item
                aria-label="Remove requested resource"
                title="Remove item"
            >
                <svg
                    class="rc-icon"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M4 7h16"/>
                    <path d="M9 11v6"/>
                    <path d="M15 11v6"/>
                    <path d="M6 7l1 14h10l1-14"/>
                    <path d="M9 7V4h6v3"/>
                </svg>
            </button>

        </div>

    </template>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeRequestCreate = () => {
        const page =
            document.getElementById(
                'request-create-page'
            );


        if (!page) {
            return;
        }


        if (
            page.dataset.requestCreateInitialized ===
            'true'
        ) {
            return;
        }


        page.dataset.requestCreateInitialized =
            'true';


        const form =
            page.querySelector(
                '#create-request-form'
            );


        let container =
            page.querySelector(
                '#request-items-container'
            );


        const template =
            page.querySelector(
                '#request-item-template'
            );


        const oldAddButton =
            page.querySelector(
                '#add-request-item'
            );


        const activityDate =
            page.querySelector(
                '#request-activity-date'
            );


        const neededDate =
            page.querySelector(
                '#request-needed-date'
            );


        const feedback =
            page.querySelector(
                '#request-create-feedback'
            );


        const resourceCount =
            page.querySelector(
                '#request-resource-count'
            );


        const resourceCountLabel =
            page.querySelector(
                '#request-resource-count-label'
            );


        if (
            !form ||
            !container ||
            !template ||
            !oldAddButton ||
            !activityDate ||
            !neededDate ||
            !feedback ||
            !resourceCount ||
            !resourceCountLabel
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | CLEAN OLD LISTENERS
        |--------------------------------------------------------------------------
        |
        | Clone the resource container and Add Item button so any stale
        | direct listeners attached by older script versions are removed.
        |
        */

        const cleanContainer =
            container.cloneNode(
                true
            );


        container.replaceWith(
            cleanContainer
        );


        container =
            cleanContainer;


        const addButton =
            oldAddButton.cloneNode(
                true
            );


        oldAddButton.replaceWith(
            addButton
        );


        let addLocked =
            false;


        /*
        |--------------------------------------------------------------------------
        | HELPERS
        |--------------------------------------------------------------------------
        */

        const getRows = () => {
            return Array.from(
                container.querySelectorAll(
                    '[data-request-item-row]'
                )
            );
        };


        const getResourceSelects = () => {
            return Array.from(
                container.querySelectorAll(
                    '[data-resource-select]'
                )
            );
        };


        const hideFeedback = () => {
            feedback.hidden =
                true;
        };


        /*
        |--------------------------------------------------------------------------
        | REFRESH RESOURCE STATE
        |--------------------------------------------------------------------------
        */

        const refreshRows = () => {
            const rows =
                getRows();


            resourceCount.textContent =
                String(
                    rows.length
                );


            resourceCountLabel.textContent =
                rows.length === 1
                    ? 'item'
                    : 'items';


            rows.forEach(
                (
                    row,
                    index
                ) => {
                    const number =
                        index + 1;


                    const padded =
                        String(
                            number
                        ).padStart(
                            2,
                            '0'
                        );


                    const numberBadge =
                        row.querySelector(
                            '[data-resource-number]'
                        );


                    const resourceSelect =
                        row.querySelector(
                            '[data-resource-select]'
                        );


                    const quantityInput =
                        row.querySelector(
                            '[data-quantity-input]'
                        );


                    const resourceLabel =
                        row.querySelector(
                            '[data-resource-label]'
                        );


                    const quantityLabel =
                        row.querySelector(
                            '[data-quantity-label]'
                        );


                    const removeButton =
                        row.querySelector(
                            '[data-remove-request-item]'
                        );


                    if (numberBadge) {
                        numberBadge.dataset.number =
                            padded;
                    }


                    if (
                        resourceSelect &&
                        resourceLabel
                    ) {
                        const resourceId =
                            `request-resource-${number}`;


                        resourceSelect.id =
                            resourceId;


                        resourceLabel.setAttribute(
                            'for',
                            resourceId
                        );
                    }


                    if (
                        quantityInput &&
                        quantityLabel
                    ) {
                        const quantityId =
                            `request-quantity-${number}`;


                        quantityInput.id =
                            quantityId;


                        quantityLabel.setAttribute(
                            'for',
                            quantityId
                        );
                    }


                    if (removeButton) {
                        removeButton.disabled =
                            rows.length === 1;


                        removeButton.setAttribute(
                            'aria-label',
                            `Remove requested resource ${number}`
                        );
                    }
                }
            );
        };


        /*
        |--------------------------------------------------------------------------
        | MUTATION OBSERVER
        |--------------------------------------------------------------------------
        |
        | Even if some other script adds/removes a row, this observer
        | immediately re-syncs the numbering and item counter.
        |
        */

        const observer =
            new MutationObserver(
                (mutations) => {
                    const hasRowMutation =
                        mutations.some(
                            (mutation) =>
                                mutation.type ===
                                'childList'
                        );


                    if (hasRowMutation) {
                        refreshRows();

                        validateResources();

                        hideFeedback();
                    }
                }
            );


        observer.observe(
            container,
            {
                childList: true
            }
        );


        /*
        |--------------------------------------------------------------------------
        | RESOURCE VALIDATION
        |--------------------------------------------------------------------------
        */

        const validateResources = () => {
            const selects =
                getResourceSelects();


            const values =
                selects
                    .map(
                        (select) =>
                            select.value.trim()
                    )
                    .filter(Boolean);


            let firstDuplicate =
                null;


            selects.forEach(
                (select) => {
                    select.setCustomValidity(
                        ''
                    );


                    if (!select.value) {
                        return;
                    }


                    const count =
                        values.filter(
                            (value) =>
                                value ===
                                select.value
                        ).length;


                    if (count > 1) {
                        select.setCustomValidity(
                            'This resource has already been added. Use one row per resource.'
                        );


                        if (!firstDuplicate) {
                            firstDuplicate =
                                select;
                        }
                    }
                }
            );


            return firstDuplicate;
        };


        /*
        |--------------------------------------------------------------------------
        | DATE VALIDATION
        |--------------------------------------------------------------------------
        */

        const validateDates = () => {
            neededDate.setCustomValidity(
                ''
            );


            if (
                !activityDate.value ||
                !neededDate.value
            ) {
                return true;
            }


            if (
                neededDate.value >
                activityDate.value
            ) {
                neededDate.setCustomValidity(
                    'The resources-needed date must be on or before the activity date.'
                );


                return false;
            }


            return true;
        };


        /*
        |--------------------------------------------------------------------------
        | ADD RESOURCE
        |--------------------------------------------------------------------------
        */

        const addResourceRow = () => {
            const fragment =
                template.content.cloneNode(
                    true
                );


            container.appendChild(
                fragment
            );


            /*
            |--------------------------------------------------------------------------
            | MutationObserver will call refreshRows automatically.
            |--------------------------------------------------------------------------
            */


            const rows =
                getRows();


            const newestRow =
                rows[
                    rows.length -
                    1
                ];


            newestRow
                ?.querySelector(
                    '[data-resource-select]'
                )
                ?.focus();
        };


        /*
        |--------------------------------------------------------------------------
        | ADD BUTTON
        |--------------------------------------------------------------------------
        */

        addButton.addEventListener(
            'click',
            (event) => {
                event.preventDefault();

                event.stopPropagation();

                event.stopImmediatePropagation();


                if (addLocked) {
                    return;
                }


                addLocked =
                    true;


                addResourceRow();


                window.requestAnimationFrame(
                    () => {
                        addLocked =
                            false;
                    }
                );
            },
            true
        );


        /*
        |--------------------------------------------------------------------------
        | REMOVE RESOURCE
        |--------------------------------------------------------------------------
        |
        | Capture phase is intentional. It prevents older bubble-phase
        | remove handlers from processing the same click.
        |
        */

        container.addEventListener(
            'click',
            (event) => {
                const removeButton =
                    event.target.closest(
                        '[data-remove-request-item]'
                    );


                if (
                    !removeButton ||
                    !container.contains(
                        removeButton
                    )
                ) {
                    return;
                }


                event.preventDefault();

                event.stopPropagation();

                event.stopImmediatePropagation();


                const rows =
                    getRows();


                if (
                    rows.length <=
                    1
                ) {
                    return;
                }


                const row =
                    removeButton.closest(
                        '[data-request-item-row]'
                    );


                if (!row) {
                    return;
                }


                row.remove();


                /*
                |--------------------------------------------------------------------------
                | MutationObserver handles:
                | - count
                | - item/items label
                | - 01, 02, 03 renumbering
                | - disabled state of remaining delete button
                |--------------------------------------------------------------------------
                */
            },
            true
        );


        /*
        |--------------------------------------------------------------------------
        | RESOURCE CHANGE
        |--------------------------------------------------------------------------
        */

        container.addEventListener(
            'change',
            (event) => {
                if (
                    event.target.matches(
                        '[data-resource-select]'
                    )
                ) {
                    validateResources();

                    hideFeedback();
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | DATE EVENTS
        |--------------------------------------------------------------------------
        */

        activityDate.addEventListener(
            'change',
            () => {
                validateDates();

                hideFeedback();
            }
        );


        neededDate.addEventListener(
            'change',
            () => {
                validateDates();

                hideFeedback();
            }
        );


        form.addEventListener(
            'input',
            hideFeedback
        );


        form.addEventListener(
            'change',
            hideFeedback
        );


        /*
        |--------------------------------------------------------------------------
        | SUBMIT PREVIEW
        |--------------------------------------------------------------------------
        */

        form.addEventListener(
            'submit',
            (event) => {
                event.preventDefault();


                validateDates();


                const duplicate =
                    validateResources();


                if (duplicate) {
                    duplicate.reportValidity();

                    duplicate.focus();

                    return;
                }


                if (
                    !form.checkValidity()
                ) {
                    form.reportValidity();

                    return;
                }


                feedback.hidden =
                    false;


                feedback.scrollIntoView(
                    {
                        behavior:
                            window.matchMedia(
                                '(prefers-reduced-motion: reduce)'
                            ).matches
                                ? 'auto'
                                : 'smooth',

                        block:
                            'nearest'
                    }
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        refreshRows();

        validateDates();

        validateResources();
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeRequestCreate,
            {
                once: true
            }
        );
    } else {
        initializeRequestCreate();
    }
})();
</script>
@endpush