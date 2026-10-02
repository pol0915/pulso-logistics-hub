@extends('layouts.app')

@section('title', 'Borrowing Details | PULSO Logistics Hub')


@push('styles')
<style>
    .borrow-detail-page {
        --bd-navy: #10263d;
        --bd-copy: #496580;
        --bd-muted: #71899c;
        --bd-line: #d5e5ee;

        --bd-teal: #007780;
        --bd-pink: #b90c61;
        --bd-blue: #365f8d;
        --bd-red: #ad343d;
        --bd-amber: #895408;
        --bd-green: #2b735d;

        display: grid;
        gap: 22px;

        width: 100%;
        min-width: 0;

        color: var(--bd-navy);

        container-name: borrow-detail;
        container-type: inline-size;
    }

    .borrow-detail-page *,
    .borrow-detail-page *::before,
    .borrow-detail-page *::after {
        box-sizing: border-box;
    }

    .borrow-detail-page [hidden] {
        display: none !important;
    }

    .bd-icon {
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

    .bd-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADING
       ================================================================ */

    .bd-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }

    .bd-heading-copy {
        min-width: 0;
    }

    .bd-eyebrow {
        margin: 0 0 7px;

        color: var(--bd-teal);

        font-size: 11px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: .15em;

        text-transform: uppercase;
    }

    .bd-heading h1 {
        margin: 0;

        color: var(--bd-navy);

        font-size: clamp(
            29px,
            3vw,
            40px
        );

        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.05em;

        overflow-wrap: anywhere;
    }

    .bd-reference {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 8px;

        margin: 9px 0 0;

        color: var(--bd-copy);

        font-size: 11px;
        line-height: 1.5;
    }

    .bd-reference strong {
        color: #29475f;

        font-weight: 800;
    }

    .bd-reference-dot {
        width: 4px;
        height: 4px;

        flex: 0 0 4px;

        border-radius: 50%;

        background: #91a7b6;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .bd-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        flex-shrink: 0;

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
            -3px -3px 8px rgba(255, 255, 255, .82),
            inset 1px 1px 2px rgba(255, 255, 255, .9);

        font: inherit;
        font-size: 11px;
        font-weight: 700;

        text-decoration: none;

        cursor: pointer;

        transition:
            color 150ms ease,
            background 150ms ease,
            transform 150ms ease;
    }

    .bd-button:hover {
        color: var(--bd-teal);

        transform: translateY(-1px);
    }

    .bd-button-primary {
        border-color: #70cdd3;

        background:
            linear-gradient(
                145deg,
                #00858f,
                #00727c
            );

        color: #ffffff;

        box-shadow:
            4px 5px 11px rgba(0, 126, 139, .19),
            inset 1px 1px 3px rgba(125, 234, 240, .45);
    }

    .bd-button-primary:hover {
        background:
            linear-gradient(
                145deg,
                #007b84,
                #006872
            );

        color: #ffffff;
    }

    .bd-button:disabled {
        opacity: .42;

        cursor: not-allowed;

        transform: none;
    }

    .bd-button:focus-visible {
        outline: 3px solid rgba(238, 18, 128, .3);
        outline-offset: 4px;
    }

    .bd-button .bd-icon {
        width: 16px;
        height: 16px;
    }


    /* ================================================================
       SNAPSHOT
       ================================================================ */

    .bd-snapshot {
        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 10px;

        padding: 10px 13px;

        border: 1px solid rgba(255, 255, 255, .92);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                rgba(237, 248, 251, .86),
                rgba(222, 240, 245, .82)
            );

        color: #567287;

        box-shadow:
            inset 2px 2px 5px rgba(74, 109, 130, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .68);

        font-size: 9.5px;
        line-height: 1.5;
    }

    .bd-snapshot-main {
        display: flex;
        align-items: center;

        gap: 8px;
    }

    .bd-snapshot-main .bd-icon {
        width: 15px;
        height: 15px;

        color: var(--bd-teal);
    }

    .bd-snapshot strong {
        color: #31546d;

        font-weight: 750;
    }

    .bd-preview-tag {
        display: inline-flex;
        align-items: center;

        min-height: 26px;

        padding: 4px 8px;

        border: 1px solid rgba(255, 255, 255, .8);
        border-radius: 8px;

        background:
            linear-gradient(
                145deg,
                #e1f6f7,
                #d1ecee
            );

        color: var(--bd-teal);

        font-size: 8.5px;
        font-weight: 750;
    }


    /* ================================================================
       MESSAGE
       ================================================================ */

    .bd-message {
        display: flex;
        align-items: center;

        gap: 10px;

        margin: 0;

        padding: 14px 15px;

        border: 1px solid rgba(255, 255, 255, .94);
        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e1edf3
            );

        color: #526f84;

        box-shadow:
            inset 2px 2px 5px rgba(78, 111, 132, .06),
            inset -2px -2px 5px rgba(255, 255, 255, .72);

        font-size: 10.5px;
        line-height: 1.55;
    }

    .bd-message .bd-icon {
        width: 17px;
        height: 17px;

        color: var(--bd-teal);
    }

    .bd-message[role="alert"] {
        border-color: #efbec3;

        background:
            linear-gradient(
                145deg,
                #fde8eb,
                #f3d0d5
            );

        color: #8f303a;
    }


    /* ================================================================
       CONTENT
       ================================================================ */

    .bd-content {
        display: grid;
        gap: 22px;

        min-width: 0;
    }


    /* ================================================================
       KPI SUMMARY
       ================================================================ */

    .bd-summary-grid {
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

    .bd-summary-grid::before,
    .bd-summary-grid::after {
        display: none !important;

        content: none !important;
    }

    .bd-summary-card {
        --bd-tone: #173b59;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );

        position: relative;

        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;
        min-height: 98px;

        padding: 15px;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .97),
                rgba(232, 244, 249, .95)
            );

        box-shadow:
            5px 6px 13px rgba(101, 138, 163, .12),
            -4px -4px 10px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }

    .bd-summary-card::after {
        position: absolute;

        top: 0;
        right: 15px;

        width: 32px;
        height: 3px;

        border-radius: 0 0 999px 999px;

        background: var(--bd-tone);

        opacity: .5;

        content: "";
    }

    .bd-summary-icon {
        display: grid;
        place-items: center;

        width: 41px;
        height: 41px;

        flex: 0 0 41px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 13px;

        background: var(--bd-tone-fill);

        color: var(--bd-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .7);
    }

    .bd-summary-icon .bd-icon {
        width: 17px;
        height: 17px;
    }

    .bd-summary-copy {
        min-width: 0;
    }

    .bd-summary-value {
        display: block;

        color: var(--bd-tone);

        font-size: 24px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }

    .bd-summary-label {
        display: block;

        margin-top: 5px;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 750;
    }

    .bd-summary-description {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .bd-tone-navy {
        --bd-tone: #173b59;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }

    .bd-tone-teal {
        --bd-tone: #007780;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }

    .bd-tone-blue {
        --bd-tone: #365f8d;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #e8f0f8,
                #d7e5f2
            );
    }

    .bd-tone-amber {
        --bd-tone: #895408;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }

    .bd-tone-red {
        --bd-tone: #ad343d;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #fdecee,
                #f5dadd
            );
    }

    .bd-tone-green {
        --bd-tone: #2b735d;

        --bd-tone-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    /* ================================================================
       MAIN GRID
       ================================================================ */

    .bd-main-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.28fr)
            minmax(320px, .72fr);

        align-items: start;

        gap: 20px;

        min-width: 0;
    }

    .bd-main-column,
    .bd-side-column {
        display: grid;

        gap: 20px;

        min-width: 0;
    }


    /* ================================================================
       CARD
       ================================================================ */

    .bd-card {
        min-width: 0;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 21px;

        background:
            linear-gradient(
                145deg,
                rgba(249, 253, 255, .97),
                rgba(230, 242, 248, .95)
            );

        box-shadow:
            7px 8px 18px rgba(101, 138, 163, .13),
            -5px -5px 14px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }

    .bd-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 16px;

        padding: 18px 20px 16px;

        border-bottom: 1px solid var(--bd-line);

        background:
            linear-gradient(
                180deg,
                rgba(244, 251, 253, .52),
                rgba(233, 243, 248, .15)
            );
    }

    .bd-card-title {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;
    }

    .bd-card-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #cfedef
            );

        color: var(--bd-teal);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -2px -2px 6px rgba(255, 255, 255, .68);
    }

    .bd-card-icon-pink {
        background:
            linear-gradient(
                145deg,
                #fce8f2,
                #f2d2e2
            );

        color: var(--bd-pink);
    }

    .bd-card-icon-blue {
        background:
            linear-gradient(
                145deg,
                #eaf2f9,
                #d8e6f2
            );

        color: var(--bd-blue);
    }

    .bd-card-icon .bd-icon {
        width: 16px;
        height: 16px;
    }

    .bd-card-head h2 {
        margin: 0;

        color: #18344c;

        font-size: 15px;
        font-weight: 800;

        letter-spacing: -.025em;
    }

    .bd-card-head p {
        margin: 3px 0 0;

        color: var(--bd-muted);

        font-size: 9px;
        line-height: 1.45;
    }


    /* ================================================================
       STATUS
       ================================================================ */

    .bd-status {
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

    .bd-status-borrowed {
        border-color: #bfd3e7;

        background:
            linear-gradient(
                145deg,
                #e9f1fa,
                #d1e1f0
            );

        color: #315b88;
    }

    .bd-status-due {
        border-color: #efd39a;

        background:
            linear-gradient(
                145deg,
                #fff4d8,
                #f7e1ae
            );

        color: #885704;
    }

    .bd-status-overdue {
        border-color: #edb9bf;

        background:
            linear-gradient(
                145deg,
                #fde7e9,
                #f2ccd1
            );

        color: #a32f39;
    }

    .bd-status-returned {
        border-color: #b4dccb;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;
    }

    .bd-status-partial {
        border-color: #e4bdd1;

        background:
            linear-gradient(
                145deg,
                #fae7f0,
                #f2d5e3
            );

        color: #a1165b;
    }


    /* ================================================================
       BORROW INFORMATION
       ================================================================ */

    .bd-details {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 11px;

        margin: 0;

        padding: 18px 20px 20px;
    }

    .bd-detail-item {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        min-width: 0;

        padding: 11px 12px;

        border: 1px solid rgba(255, 255, 255, .86);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e9f3f7,
                #f1f7fa
            );

        box-shadow:
            inset 2px 2px 5px rgba(82, 116, 138, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .74);
    }

    .bd-detail-icon {
        display: grid;
        place-items: center;

        width: 33px;
        height: 33px;

        flex: 0 0 33px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #e1f6f7,
                #d0ecee
            );

        color: var(--bd-teal);
    }

    .bd-detail-icon .bd-icon {
        width: 14px;
        height: 14px;
    }

    .bd-detail-copy {
        min-width: 0;
    }

    .bd-detail-item dt {
        color: #71899c;

        font-size: 8.5px;
        line-height: 1.4;
    }

    .bd-detail-item dd {
        margin: 3px 0 0;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 700;
        line-height: 1.5;

        overflow-wrap: anywhere;
    }

    .bd-context-note {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        margin: 0 20px 20px;

        padding: 11px 12px;

        border: 1px solid rgba(231, 196, 137, .5);
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #fff2df,
                #f7e5c8
            );

        color: #7b551c;

        font-size: 9px;
        line-height: 1.55;
    }

    .bd-context-note .bd-icon {
        width: 15px;
        height: 15px;

        flex: 0 0 15px;

        margin-top: 1px;

        color: var(--bd-amber);
    }


    /* ================================================================
       RESOURCE REGISTER
       ================================================================ */

    .bd-resource-wrap {
        width: 100%;

        overflow-x: auto;
    }

    .bd-resource-table {
        width: 100%;
        min-width: 760px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }

    .bd-resource-table th {
        padding: 11px 13px;

        border-bottom: 1px solid #d2e2ea;

        background: rgba(227, 240, 247, .68);

        color: #587287;

        font-size: 8.5px;
        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .bd-resource-table td {
        padding: 13px;

        border-bottom: 1px solid rgba(214, 229, 237, .85);

        color: #49657a;

        font-size: 9.8px;
        line-height: 1.45;

        vertical-align: middle;
    }

    .bd-resource-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .bd-resource {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 215px;
    }

    .bd-resource-icon {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border: 1px solid rgba(255, 255, 255, .92);
        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e4f7f8,
                #d1edef
            );

        color: var(--bd-teal);

        box-shadow:
            2px 3px 7px rgba(82, 116, 137, .08);
    }

    .bd-resource-icon .bd-icon {
        width: 15px;
        height: 15px;
    }

    .bd-resource strong {
        display: block;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;
    }

    .bd-resource span {
        display: block;

        margin-top: 2px;

        color: #71899c;

        font-size: 8.5px;
    }

    .bd-resource-number {
        color: #29475f;

        font-size: 10px;
        font-weight: 800;

        font-variant-numeric: tabular-nums;
    }

    .bd-condition-out {
        display: inline-flex;
        align-items: center;

        min-height: 26px;

        padding: 4px 8px;

        border-radius: 8px;

        background:
            linear-gradient(
                145deg,
                #e5f2ed,
                #d7e9e1
            );

        color: #2f725d;

        font-size: 8.5px;
        font-weight: 700;
    }


    /* ================================================================
       RETURN FORM
       ================================================================ */

    .bd-return-body {
        padding: 18px 20px 20px;
    }

    .bd-return-fields {
        display: grid;
        gap: 15px;
    }

    .bd-field {
        min-width: 0;
    }

    .bd-label {
        display: block;

        margin-bottom: 7px;

        color: #31546d;

        font-size: 10px;
        font-weight: 750;
        line-height: 1.4;
    }

    .bd-input {
        display: block;

        width: 100%;
        min-width: 0;
        min-height: 43px;

        padding: 9px 11px;

        border: 1px solid #d0e1e9;
        border-radius: 12px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e7f0f5,
                #eef6f9
            );

        color: var(--bd-navy);

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .13),
            inset -3px -3px 7px rgba(255, 255, 255, .88);

        font: inherit;
        font-size: 10.5px;
        line-height: 1.45;
    }

    .bd-input::placeholder {
        color: #7b91a2;
    }

    .bd-input:focus {
        border-color: rgba(0, 126, 137, .48);

        background: #edf7fa;

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .11),
            inset -3px -3px 7px rgba(255, 255, 255, .9),
            0 0 0 3px rgba(5, 173, 182, .08);
    }

    textarea.bd-input {
        min-height: 86px;

        resize: vertical;
    }

    select.bd-input {
        cursor: pointer;
    }

    .bd-help {
        margin: 7px 0 0;

        color: var(--bd-muted);

        font-size: 8.8px;
        line-height: 1.55;
    }

    .bd-return-guidance {
        display: flex;
        align-items: flex-start;

        gap: 8px;

        margin-top: 15px;

        padding: 10px 11px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e5f3f6,
                #edf7f9
            );

        color: #567287;

        font-size: 8.8px;
        line-height: 1.55;
    }

    .bd-return-guidance .bd-icon {
        width: 14px;
        height: 14px;

        flex: 0 0 14px;

        margin-top: 1px;

        color: var(--bd-teal);
    }

    .bd-error {
        margin: 12px 0 0;

        padding: 9px 10px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #fde8eb,
                #f4d3d8
            );

        color: #9d343e;

        font-size: 9px;
        line-height: 1.5;
    }

    .bd-return-actions {
        display: flex;
        justify-content: flex-end;

        margin-top: 15px;
    }


    /* ================================================================
       COMPLETED
       ================================================================ */

    .bd-completed {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        padding: 13px 14px;

        border: 1px solid #b4dccb;
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #c8e4d8
            );

        color: #286b56;

        font-size: 9.5px;
        line-height: 1.55;
    }

    .bd-completed .bd-icon {
        width: 16px;
        height: 16px;

        margin-top: 1px;
    }

    .bd-completed strong {
        display: block;

        margin-bottom: 2px;

        color: #1e624e;

        font-size: 10px;
    }


    /* ================================================================
       FEEDBACK
       ================================================================ */

    .bd-feedback {
        margin: 0;

        padding: 11px 12px;

        border: 1px solid #afdcd0;
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e5f5ef,
                #d6ece4
            );

        color: #286b57;

        font-size: 9.5px;
        line-height: 1.55;
    }

    .bd-feedback:empty {
        display: none;
    }


    /* ================================================================
       HISTORY
       ================================================================ */

    .bd-history-body {
        padding: 18px 20px 20px;
    }

    .bd-opening {
        display: flex;
        align-items: flex-start;

        gap: 8px;

        margin: 0 0 12px;

        padding: 10px 11px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #edf5f8,
                #e4eef3
            );

        color: #60798d;

        font-size: 9px;
        line-height: 1.55;
    }

    .bd-opening .bd-icon {
        width: 14px;
        height: 14px;

        flex: 0 0 14px;

        margin-top: 1px;

        color: var(--bd-blue);
    }

    .bd-empty-history {
        display: flex;
        align-items: center;

        gap: 9px;

        margin: 0;

        padding: 13px 14px;

        border: 1px dashed #c6dbe5;
        border-radius: 12px;

        color: #71899c;

        font-size: 9.5px;
        line-height: 1.5;
    }

    .bd-empty-history .bd-icon {
        width: 16px;
        height: 16px;

        color: #6d879a;
    }

    .bd-history {
        display: grid;

        gap: 10px;

        margin: 0;
        padding: 0;

        list-style: none;
    }

    .bd-history-item {
        display: grid;

        grid-template-columns:
            35px
            minmax(0, 1fr);

        gap: 11px;

        min-width: 0;
    }

    .bd-history-marker {
        display: grid;
        place-items: center;

        width: 35px;
        height: 35px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #d0eeee
            );

        color: var(--bd-teal);

        box-shadow:
            2px 3px 7px rgba(82, 116, 137, .08);
    }

    .bd-history-marker .bd-icon {
        width: 15px;
        height: 15px;
    }

    .bd-history-entry {
        min-width: 0;

        padding: 10px 11px;

        border: 1px solid rgba(255, 255, 255, .86);
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #edf5f8,
                #e4eef3
            );

        box-shadow:
            inset 2px 2px 5px rgba(78, 111, 132, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .68);
    }

    .bd-history-entry time {
        display: block;

        color: #7a90a1;

        font-size: 8px;
    }

    .bd-history-entry strong {
        display: block;

        margin-top: 3px;

        color: #29475f;

        font-size: 10px;
    }

    .bd-history-entry p {
        margin: 3px 0 0;

        color: #60798d;

        font-size: 8.8px;
        line-height: 1.5;

        overflow-wrap: anywhere;
    }

    .bd-card-footer {
        padding: 13px 20px;

        border-top: 1px solid var(--bd-line);

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.5;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container borrow-detail (max-width: 920px) {
        .bd-heading {
            align-items: flex-start;
            flex-direction: column;

            gap: 16px;
        }

        .bd-summary-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

        .bd-main-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @container borrow-detail (max-width: 650px) {
        .bd-details {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @container borrow-detail (max-width: 460px) {
        .bd-summary-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .bd-snapshot {
            align-items: flex-start;
            flex-direction: column;
        }

        .bd-card-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .bd-status {
            align-self: flex-start;
        }

        .bd-details,
        .bd-return-body,
        .bd-history-body {
            padding: 16px;
        }

        .bd-context-note {
            margin: 0 16px 16px;
        }

        .bd-return-actions .bd-button {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .bd-button {
            transition: none;
        }

        .bd-button:hover {
            transform: none;
        }
    }
</style>
@endpush


@section('content')
<div
    id="borrowing-details-page"
    class="borrow-detail-page"
>

    <svg
        class="bd-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="bd-icon-back" viewBox="0 0 24 24">
            <path d="M19 12H5"/>
            <path d="m11 6-6 6 6 6"/>
        </symbol>

        <symbol id="bd-icon-borrow" viewBox="0 0 24 24">
            <path d="M4 7h12"/>
            <path d="m12 3 4 4-4 4"/>
            <path d="M20 13v2a4 4 0 0 1-4 4H6"/>
        </symbol>

        <symbol id="bd-icon-return" viewBox="0 0 24 24">
            <path d="M20 7H8"/>
            <path d="m12 3-4 4 4 4"/>
            <path d="M4 13v2a4 4 0 0 0 4 4h10"/>
        </symbol>

        <symbol id="bd-icon-box" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="bd-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="bd-icon-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="bd-icon-calendar" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="16" rx="2"/>
            <path d="M16 3v4"/>
            <path d="M8 3v4"/>
            <path d="M3 10h18"/>
        </symbol>

        <symbol id="bd-icon-user" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 21a8 8 0 0 1 16 0"/>
        </symbol>

        <symbol id="bd-icon-group" viewBox="0 0 24 24">
            <circle cx="9" cy="8" r="3"/>
            <circle cx="17" cy="9" r="2"/>
            <path d="M3 20a6 6 0 0 1 12 0"/>
            <path d="M15 15a5 5 0 0 1 6 5"/>
        </symbol>

        <symbol id="bd-icon-project" viewBox="0 0 24 24">
            <path d="M4 7h6l2 2h8v10H4Z"/>
            <path d="M4 7V5h6l2 2"/>
        </symbol>

        <symbol id="bd-icon-info" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </symbol>

        <symbol id="bd-icon-alert" viewBox="0 0 24 24">
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol id="bd-icon-history" viewBox="0 0 24 24">
            <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
            <path d="M3 3v5h5"/>
            <path d="M12 7v5l3 2"/>
        </symbol>
    </svg>


    <header class="bd-heading">

        <div class="bd-heading-copy">

            <p class="bd-eyebrow">
                Resource accountability
            </p>

            <h1 id="bd-title">
                Borrowing details
            </h1>

            <div class="bd-reference">

                <strong id="bd-reference">
                    Select a borrowing record
                </strong>

                <span class="bd-reference-dot"></span>

                <span>
                    Borrow & Return
                </span>

            </div>

        </div>


        <a
            href="{{ route('borrow.index') }}"
            class="bd-button"
        >
            <svg
                class="bd-icon"
                aria-hidden="true"
            >
                <use href="#bd-icon-back"/>
            </svg>

            Back to Borrow & Return
        </a>

    </header>


    <div class="bd-snapshot">

        <div class="bd-snapshot-main">

            <svg
                class="bd-icon"
                aria-hidden="true"
            >
                <use href="#bd-icon-calendar"/>
            </svg>

            <span>
                Due dates evaluated as of

                <strong id="bd-snapshot-date">
                    September 12, 2026
                </strong>
            </span>

        </div>

        <span class="bd-preview-tag">
            Browser preview
        </span>

    </div>


    <p
        id="bd-message"
        class="bd-message"
        role="status"
        tabindex="-1"
    >
        <svg
            class="bd-icon"
            aria-hidden="true"
        >
            <use href="#bd-icon-info"/>
        </svg>

        <span>
            Loading borrowing details…
        </span>
    </p>


    <div
        id="bd-content"
        class="bd-content"
        hidden
    >

        <section
            class="bd-summary-grid"
            aria-label="Borrowing summary"
        >

            <article
                class="
                    bd-summary-card
                    bd-tone-navy
                "
            >
                <span
                    class="bd-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="bd-icon">
                        <use href="#bd-icon-box"/>
                    </svg>
                </span>

                <div class="bd-summary-copy">

                    <strong
                        id="bd-summary-types"
                        class="bd-summary-value"
                    >
                        0
                    </strong>

                    <span class="bd-summary-label">
                        Resource types
                    </span>

                    <span class="bd-summary-description">
                        Different released assets
                    </span>

                </div>
            </article>


            <article
                class="
                    bd-summary-card
                    bd-tone-blue
                "
            >
                <span
                    class="bd-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="bd-icon">
                        <use href="#bd-icon-borrow"/>
                    </svg>
                </span>

                <div class="bd-summary-copy">

                    <strong
                        id="bd-summary-borrowed"
                        class="bd-summary-value"
                    >
                        0
                    </strong>

                    <span class="bd-summary-label">
                        Borrowed units
                    </span>

                    <span class="bd-summary-description">
                        Total released quantity
                    </span>

                </div>
            </article>


            <article
                class="
                    bd-summary-card
                    bd-tone-teal
                "
            >
                <span
                    class="bd-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="bd-icon">
                        <use href="#bd-icon-return"/>
                    </svg>
                </span>

                <div class="bd-summary-copy">

                    <strong
                        id="bd-summary-returned"
                        class="bd-summary-value"
                    >
                        0
                    </strong>

                    <span class="bd-summary-label">
                        Returned units
                    </span>

                    <span class="bd-summary-description">
                        Quantity already received
                    </span>

                </div>
            </article>


            <article
                id="bd-summary-remaining-card"
                class="
                    bd-summary-card
                    bd-tone-amber
                "
            >
                <span
                    class="bd-summary-icon"
                    aria-hidden="true"
                >
                    <svg class="bd-icon">
                        <use href="#bd-icon-clock"/>
                    </svg>
                </span>

                <div class="bd-summary-copy">

                    <strong
                        id="bd-summary-remaining"
                        class="bd-summary-value"
                    >
                        0
                    </strong>

                    <span class="bd-summary-label">
                        Still to return
                    </span>

                    <span class="bd-summary-description">
                        Outstanding units
                    </span>

                </div>
            </article>

        </section>


        <div class="bd-main-grid">

            <div class="bd-main-column">

                <section
                    class="bd-card"
                    aria-labelledby="bd-details-title"
                >

                    <header class="bd-card-head">

                        <div class="bd-card-title">

                            <span
                                class="bd-card-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-borrow"/>
                                </svg>
                            </span>

                            <div>

                                <h2 id="bd-details-title">
                                    Borrowing information
                                </h2>

                                <p id="bd-due-note">
                                    Borrowing transaction details
                                </p>

                            </div>

                        </div>


                        <span
                            id="bd-status"
                            class="
                                bd-status
                                bd-status-borrowed
                            "
                        >
                            Borrowed
                        </span>

                    </header>


                    <dl class="bd-details">

                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-borrow"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Borrow ID
                                </dt>

                                <dd id="bd-borrow-id"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-project"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Request ID
                                </dt>

                                <dd id="bd-request-id"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-user"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Borrower
                                </dt>

                                <dd id="bd-borrower"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-group"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Committee
                                </dt>

                                <dd id="bd-committee"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-project"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Project / Activity
                                </dt>

                                <dd id="bd-project"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-calendar"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Released
                                </dt>

                                <dd id="bd-released"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-clock"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Due date
                                </dt>

                                <dd id="bd-due"></dd>

                            </div>

                        </div>


                        <div class="bd-detail-item">

                            <span
                                class="bd-detail-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-box"/>
                                </svg>
                            </span>

                            <div class="bd-detail-copy">

                                <dt>
                                    Resource types
                                </dt>

                                <dd id="bd-type-count"></dd>

                            </div>

                        </div>

                    </dl>


                    <div
                        id="bd-partial"
                        class="bd-context-note"
                        hidden
                    >
                        <svg
                            class="bd-icon"
                            aria-hidden="true"
                        >
                            <use href="#bd-icon-alert"/>
                        </svg>

                        <span>
                            Some resources have already been returned,
                            but this borrowing still has outstanding
                            quantities.
                        </span>
                    </div>

                </section>


                <section
                    class="bd-card"
                    aria-labelledby="bd-resource-title"
                >

                    <header class="bd-card-head">

                        <div class="bd-card-title">

                            <span
                                class="bd-card-icon"
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-box"/>
                                </svg>
                            </span>

                            <div>

                                <h2 id="bd-resource-title">
                                    Released resources
                                </h2>

                                <p>
                                    Return progress is tracked separately for each resource.
                                </p>

                            </div>

                        </div>

                    </header>


                    <div class="bd-resource-wrap custom-scrollbar">

                        <table class="bd-resource-table">

                            <thead>
                                <tr>
                                    <th>
                                        Resource
                                    </th>

                                    <th>
                                        Borrowed
                                    </th>

                                    <th>
                                        Returned
                                    </th>

                                    <th>
                                        Remaining
                                    </th>

                                    <th>
                                        Condition out
                                    </th>

                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="bd-resource-body"></tbody>

                        </table>

                    </div>

                </section>


                <section
                    class="bd-card"
                    aria-labelledby="bd-history-title"
                >

                    <header class="bd-card-head">

                        <div class="bd-card-title">

                            <span
                                class="
                                    bd-card-icon
                                    bd-card-icon-blue
                                "
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-history"/>
                                </svg>
                            </span>

                            <div>

                                <h2 id="bd-history-title">
                                    Return history
                                </h2>

                                <p>
                                    Return batches are identified by resource.
                                </p>

                            </div>

                        </div>

                    </header>


                    <div class="bd-history-body">

                        <p
                            id="bd-opening"
                            class="bd-opening"
                            hidden
                        >
                            <svg
                                class="bd-icon"
                                aria-hidden="true"
                            >
                                <use href="#bd-icon-info"/>
                            </svg>

                            <span id="bd-opening-copy"></span>
                        </p>


                        <p
                            id="bd-empty-history"
                            class="bd-empty-history"
                        >
                            <svg
                                class="bd-icon"
                                aria-hidden="true"
                            >
                                <use href="#bd-icon-history"/>
                            </svg>

                            <span>
                                No item-level return batches recorded yet.
                            </span>
                        </p>


                        <ul
                            id="bd-history"
                            class="bd-history"
                            aria-label="Return batches"
                            hidden
                        ></ul>

                    </div>


                    <footer class="bd-card-footer">
                        Item-level return entries in this preview are
                        stored in this browser tab only. Inventory
                        availability is not automatically changed.
                    </footer>

                </section>

            </div>


            <aside class="bd-side-column">

                <section
                    id="bd-return-section"
                    class="bd-card"
                    aria-labelledby="bd-return-title"
                >

                    <header class="bd-card-head">

                        <div class="bd-card-title">

                            <span
                                class="
                                    bd-card-icon
                                    bd-card-icon-pink
                                "
                                aria-hidden="true"
                            >
                                <svg class="bd-icon">
                                    <use href="#bd-icon-return"/>
                                </svg>
                            </span>

                            <div>

                                <h2 id="bd-return-title">
                                    Record a return
                                </h2>

                                <p>
                                    Select the exact resource being returned.
                                </p>

                            </div>

                        </div>

                    </header>


                    <div class="bd-return-body">

                        <form id="bd-return-form">

                            <div class="bd-return-fields">

                                <div class="bd-field">

                                    <label
                                        for="bd-resource-select"
                                        class="bd-label"
                                    >
                                        Resource
                                    </label>

                                    <select
                                        id="bd-resource-select"
                                        class="bd-input"
                                        required
                                    >
                                        <option value="">
                                            Select resource
                                        </option>
                                    </select>

                                    <p
                                        id="bd-resource-help"
                                        class="bd-help"
                                    >
                                        Only resources with an outstanding quantity are shown.
                                    </p>

                                </div>


                                <div class="bd-field">

                                    <label
                                        for="bd-quantity"
                                        class="bd-label"
                                    >
                                        Quantity returned now
                                    </label>

                                    <input
                                        id="bd-quantity"
                                        class="bd-input"
                                        type="number"
                                        min="1"
                                        step="1"
                                        placeholder="Select a resource first"
                                        required
                                        disabled
                                    >

                                    <p
                                        id="bd-quantity-help"
                                        class="bd-help"
                                    >
                                        Select a resource first.
                                    </p>

                                </div>


                                <div class="bd-field">

                                    <label
                                        for="bd-condition"
                                        class="bd-label"
                                    >
                                        Condition on return
                                    </label>

                                    <select
                                        id="bd-condition"
                                        class="bd-input"
                                        required
                                    >
                                        <option value="">
                                            Select condition
                                        </option>

                                        <option value="Excellent">
                                            Excellent
                                        </option>

                                        <option value="Good">
                                            Good
                                        </option>

                                        <option value="Fair">
                                            Fair
                                        </option>

                                        <option value="Poor">
                                            Poor
                                        </option>

                                        <option value="Needs maintenance">
                                            Needs maintenance
                                        </option>

                                        <option value="Damaged">
                                            Damaged
                                        </option>
                                    </select>

                                </div>


                                <div class="bd-field">

                                    <label
                                        for="bd-notes"
                                        class="bd-label"
                                    >
                                        Return notes

                                        <span style="font-weight: 500; color: #7b90a0;">
                                            · Optional
                                        </span>
                                    </label>

                                    <textarea
                                        id="bd-notes"
                                        class="bd-input"
                                        rows="3"
                                        maxlength="1000"
                                        placeholder="Record missing accessories, damage, maintenance concerns, or other findings."
                                    ></textarea>

                                </div>

                            </div>


                            <div class="bd-return-guidance">

                                <svg
                                    class="bd-icon"
                                    aria-hidden="true"
                                >
                                    <use href="#bd-icon-info"/>
                                </svg>

                                <span>
                                    If different resources or units have
                                    different conditions, record them as
                                    separate return batches.
                                </span>

                            </div>


                            <p
                                id="bd-error"
                                class="bd-error"
                                role="alert"
                                hidden
                            ></p>


                            <div class="bd-return-actions">

                                <button
                                    id="bd-submit"
                                    class="
                                        bd-button
                                        bd-button-primary
                                    "
                                    type="submit"
                                    disabled
                                >
                                    <svg
                                        class="bd-icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#bd-icon-return"/>
                                    </svg>

                                    <span id="bd-submit-label">
                                        Record return
                                    </span>
                                </button>

                            </div>

                        </form>

                    </div>

                </section>


                <div
                    id="bd-completed"
                    class="bd-completed"
                    hidden
                >
                    <svg
                        class="bd-icon"
                        aria-hidden="true"
                    >
                        <use href="#bd-icon-check"/>
                    </svg>

                    <div>

                        <strong>
                            Borrowing completed
                        </strong>

                        <span>
                            All released resources have been returned.
                            This borrowing has no outstanding quantity.
                        </span>

                    </div>
                </div>


                <p
                    id="bd-feedback"
                    class="bd-feedback"
                    role="status"
                    aria-live="polite"
                    tabindex="-1"
                ></p>

            </aside>

        </div>

    </div>


    <noscript>
        <p class="bd-message">
            Enable JavaScript to view this borrowing record.
        </p>
    </noscript>

</div>
@endsection


@push('scripts')
<script src="{{ asset('js/borrow-store.js') }}"></script>

<script>
(() => {
    const initializeBorrowDetails = () => {
        const page =
            document.getElementById(
                'borrowing-details-page'
            );

        if (
            !page ||
            page.dataset.initialized === 'true'
        ) {
            return;
        }

        page.dataset.initialized =
            'true';


        const find = (id) => {
            return document.getElementById(
                id
            );
        };


        const store =
            window.PulsoBorrowStore;


        const borrowId =
            new URLSearchParams(
                window.location.search
            ).get(
                'id'
            );


        const ITEM_STATE_KEY =
            'pulso-borrow-item-returns-v1';


        const message =
            find(
                'bd-message'
            );

        const content =
            find(
                'bd-content'
            );

        const statusBadge =
            find(
                'bd-status'
            );

        const resourceBody =
            find(
                'bd-resource-body'
            );

        const form =
            find(
                'bd-return-form'
            );

        const resourceSelect =
            find(
                'bd-resource-select'
            );

        const quantity =
            find(
                'bd-quantity'
            );

        const condition =
            find(
                'bd-condition'
            );

        const notes =
            find(
                'bd-notes'
            );

        const submit =
            find(
                'bd-submit'
            );

        const submitLabel =
            find(
                'bd-submit-label'
            );

        const error =
            find(
                'bd-error'
            );

        const feedback =
            find(
                'bd-feedback'
            );

        const history =
            find(
                'bd-history'
            );

        const emptyHistory =
            find(
                'bd-empty-history'
            );

        const opening =
            find(
                'bd-opening'
            );

        const openingCopy =
            find(
                'bd-opening-copy'
            );

        const summaryRemainingCard =
            find(
                'bd-summary-remaining-card'
            );


        const dateFormat =
            new Intl.DateTimeFormat(
                'en-PH',
                {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    timeZone: 'UTC'
                }
            );


        const timeFormat =
            new Intl.DateTimeFormat(
                'en-PH',
                {
                    dateStyle: 'medium',
                    timeStyle: 'short'
                }
            );


        let record =
            null;

        let saving =
            false;


        const escapeHtml = (value) => {
            const div =
                document.createElement(
                    'div'
                );

            div.textContent =
                String(
                    value ?? ''
                );

            return div.innerHTML;
        };


        const setText = (
            id,
            value
        ) => {
            const element =
                find(
                    id
                );

            if (element) {
                element.textContent =
                    value ?? '';
            }
        };


        const formatDate = (value) => {
            return dateFormat.format(
                new Date(
                    `${value}T00:00:00Z`
                )
            );
        };


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

                return (
                    parsed &&
                    typeof parsed === 'object' &&
                    !Array.isArray(parsed)
                )
                    ? parsed
                    : {};
            } catch {
                return {};
            }
        };


        const saveItemState = (state) => {
            window.sessionStorage.setItem(
                ITEM_STATE_KEY,
                JSON.stringify(
                    state
                )
            );
        };


        const getUserEvents = () => {
            const state =
                loadItemState();

            const entries =
                state[
                    borrowId
                ];

            if (
                !Array.isArray(
                    entries
                )
            ) {
                return [];
            }

            return entries.filter(
                (entry) => {
                    return (
                        entry &&
                        typeof entry.asset_id === 'string' &&
                        Number.isSafeInteger(
                            entry.quantity
                        ) &&
                        entry.quantity > 0 &&
                        typeof entry.condition === 'string' &&
                        typeof entry.at === 'string'
                    );
                }
            );
        };


        const addUserEvent = (entry) => {
            const state =
                loadItemState();

            if (
                !Array.isArray(
                    state[
                        borrowId
                    ]
                )
            ) {
                state[
                    borrowId
                ] = [];
            }

            state[
                borrowId
            ].push(
                entry
            );

            saveItemState(
                state
            );
        };


        const getOpeningReturnedMap = () => {
            const map =
                {};

            record.items.forEach(
                (item) => {
                    map[
                        item.asset_id
                    ] = 0;
                }
            );

            let openingReturned =
                Math.max(
                    0,
                    Number(
                        record.openingReturned ??
                        0
                    )
                );

            for (
                const item
                of record.items
            ) {
                if (
                    openingReturned <= 0
                ) {
                    break;
                }

                const amount =
                    Math.min(
                        item.quantity,
                        openingReturned
                    );

                map[
                    item.asset_id
                ] = amount;

                openingReturned -=
                    amount;
            }

            return map;
        };


        const getItemStats = () => {
            const openingMap =
                getOpeningReturnedMap();

            const events =
                getUserEvents();

            return record.items.map(
                (item) => {
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
                                        entry.quantity
                                    );
                                },
                                0
                            );

                    const openingReturned =
                        openingMap[
                            item.asset_id
                        ] ?? 0;

                    const returned =
                        Math.min(
                            item.quantity,
                            openingReturned +
                            eventReturned
                        );

                    const remaining =
                        Math.max(
                            0,
                            item.quantity -
                            returned
                        );

                    let status =
                        'Borrowed';

                    if (
                        remaining === 0
                    ) {
                        status =
                            'Returned';
                    } else if (
                        returned > 0
                    ) {
                        status =
                            'Partial';
                    }

                    return {
                        ...item,
                        openingReturned,
                        returned,
                        remaining,
                        status
                    };
                }
            );
        };


        const getOverallStats = () => {
            const items =
                getItemStats();

            const borrowed =
                items.reduce(
                    (
                        total,
                        item
                    ) => {
                        return (
                            total +
                            item.quantity
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
                borrowed -
                returned;

            const snapshot =
                Date.parse(
                    `${store.snapshotDate}T00:00:00Z`
                );

            const due =
                Date.parse(
                    `${record.due}T00:00:00Z`
                );

            const days =
                Math.round(
                    (
                        due -
                        snapshot
                    ) /
                    86400000
                );

            let status;

            if (
                remaining === 0
            ) {
                status =
                    'Returned';
            } else if (
                days < 0
            ) {
                status =
                    'Overdue';
            } else if (
                days === 0
            ) {
                status =
                    'Due Soon';
            } else {
                status =
                    'Borrowed';
            }

            let dueNote;

            if (
                remaining === 0
            ) {
                dueNote =
                    'No outstanding quantity';
            } else if (
                days < 0
            ) {
                const value =
                    Math.abs(
                        days
                    );

                dueNote =
                    `${value} ${value === 1 ? 'day' : 'days'} overdue`;
            } else if (
                days === 0
            ) {
                dueNote =
                    'Return due today';
            } else if (
                days === 1
            ) {
                dueNote =
                    'Return due tomorrow';
            } else {
                dueNote =
                    `Due in ${days} days`;
            }

            return {
                items,
                borrowed,
                returned,
                remaining,
                status,
                dueNote,
                isPartial:
                    returned > 0 &&
                    remaining > 0
            };
        };


        const statusClass = (status) => {
            if (
                status ===
                'Returned'
            ) {
                return 'bd-status-returned';
            }

            if (
                status ===
                'Overdue'
            ) {
                return 'bd-status-overdue';
            }

            if (
                status ===
                'Due Soon'
            ) {
                return 'bd-status-due';
            }

            if (
                status ===
                'Partial'
            ) {
                return 'bd-status-partial';
            }

            return 'bd-status-borrowed';
        };


        const setStatusBadge = (
            element,
            status
        ) => {
            element.className =
                `bd-status ${statusClass(status)}`;

            element.textContent =
                status;
        };


        const showError = (
            text
        ) => {
            record =
                null;

            content.hidden =
                true;

            message.setAttribute(
                'role',
                'alert'
            );

            message.innerHTML = `
                <svg
                    class="bd-icon"
                    aria-hidden="true"
                >
                    <use href="#bd-icon-alert"></use>
                </svg>

                <span>
                    ${escapeHtml(text)}
                </span>
            `;

            message.hidden =
                false;
        };


        const renderSummary = (
            stats
        ) => {
            setText(
                'bd-summary-types',
                String(
                    stats.items.length
                )
            );

            setText(
                'bd-summary-borrowed',
                String(
                    stats.borrowed
                )
            );

            setText(
                'bd-summary-returned',
                String(
                    stats.returned
                )
            );

            setText(
                'bd-summary-remaining',
                String(
                    stats.remaining
                )
            );

            summaryRemainingCard.classList.remove(
                'bd-tone-amber',
                'bd-tone-red',
                'bd-tone-green'
            );

            if (
                stats.remaining === 0
            ) {
                summaryRemainingCard.classList.add(
                    'bd-tone-green'
                );
            } else if (
                stats.status ===
                'Overdue'
            ) {
                summaryRemainingCard.classList.add(
                    'bd-tone-red'
                );
            } else {
                summaryRemainingCard.classList.add(
                    'bd-tone-amber'
                );
            }
        };


        const renderResources = (
            stats
        ) => {
            resourceBody.innerHTML =
                stats.items
                    .map(
                        (item) => {
                            return `
                                <tr>

                                    <td>
                                        <div class="bd-resource">

                                            <span
                                                class="bd-resource-icon"
                                                aria-hidden="true"
                                            >
                                                <svg class="bd-icon">
                                                    <use href="#bd-icon-box"></use>
                                                </svg>
                                            </span>

                                            <div>
                                                <strong>
                                                    ${escapeHtml(item.name)}
                                                </strong>

                                                <span>
                                                    ${escapeHtml(item.asset_id)}
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <span class="bd-resource-number">
                                            ${item.quantity}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="bd-resource-number">
                                            ${item.returned}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="bd-resource-number">
                                            ${item.remaining}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="bd-condition-out">
                                            ${escapeHtml(item.condition_out)}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="
                                                bd-status
                                                ${statusClass(item.status)}
                                            "
                                        >
                                            ${item.status}
                                        </span>
                                    </td>

                                </tr>
                            `;
                        }
                    )
                    .join(
                        ''
                    );
        };


        const renderResourceSelect = (
            stats
        ) => {
            const selected =
                resourceSelect.value;

            resourceSelect.innerHTML =
                '<option value="">Select resource</option>';

            stats.items
                .filter(
                    (item) => {
                        return (
                            item.remaining >
                            0
                        );
                    }
                )
                .forEach(
                    (item) => {
                        const option =
                            document.createElement(
                                'option'
                            );

                        option.value =
                            item.asset_id;

                        option.textContent =
                            `${item.name} — ${item.remaining} remaining`;

                        resourceSelect.appendChild(
                            option
                        );
                    }
                );

            const canRestore =
                stats.items.some(
                    (item) => {
                        return (
                            item.asset_id ===
                                selected &&
                            item.remaining >
                                0
                        );
                    }
                );

            resourceSelect.value =
                canRestore
                    ? selected
                    : '';

            updateQuantityField(
                stats
            );
        };


        const updateQuantityField = (
            stats = getOverallStats()
        ) => {
            const selectedItem =
                stats.items.find(
                    (item) => {
                        return (
                            item.asset_id ===
                            resourceSelect.value
                        );
                    }
                );

            if (
                !selectedItem ||
                selectedItem.remaining <=
                    0
            ) {
                quantity.value =
                    '';

                quantity.disabled =
                    true;

                quantity.removeAttribute(
                    'max'
                );

                quantity.placeholder =
                    'Select a resource first';

                setText(
                    'bd-quantity-help',
                    'Select a resource first.'
                );

                updateSubmitButton(
                    stats
                );

                return;
            }

            quantity.disabled =
                false;

            quantity.max =
                String(
                    selectedItem.remaining
                );

            quantity.placeholder =
                `1 to ${selectedItem.remaining}`;

            setText(
                'bd-quantity-help',
                `${selectedItem.remaining} ${selectedItem.remaining === 1 ? 'unit remains' : 'units remain'} for ${selectedItem.name}.`
            );

            updateSubmitButton(
                stats
            );
        };


        const updateSubmitButton = (
            stats = getOverallStats()
        ) => {
            const selectedItem =
                stats.items.find(
                    (item) => {
                        return (
                            item.asset_id ===
                            resourceSelect.value
                        );
                    }
                );

            const amount =
                Number(
                    quantity.value
                );

            const validAmount =
                selectedItem &&
                Number.isSafeInteger(
                    amount
                ) &&
                amount > 0 &&
                amount <=
                    selectedItem.remaining;

            submit.disabled =
                saving ||
                !selectedItem ||
                !validAmount ||
                !condition.value;

            if (
                validAmount &&
                amount ===
                    selectedItem.remaining
            ) {
                submitLabel.textContent =
                    'Complete resource return';
            } else if (
                validAmount
            ) {
                submitLabel.textContent =
                    'Record partial return';
            } else {
                submitLabel.textContent =
                    'Record return';
            }
        };


        const renderHistory = (
            stats
        ) => {
            const userEvents =
                getUserEvents();

            opening.hidden =
                Number(
                    record.openingReturned ??
                    0
                ) === 0;

            openingCopy.textContent =
                Number(
                    record.openingReturned ??
                    0
                ) > 0
                    ? `${record.openingReturned} ${
                        record.openingReturned === 1
                            ? 'unit was'
                            : 'units were'
                    } already returned before this item-level preview.`
                    : '';

            history.replaceChildren();

            emptyHistory.hidden =
                userEvents.length >
                0;

            history.hidden =
                userEvents.length ===
                0;

            const chronological =
                [
                    ...userEvents
                ].sort(
                    (
                        first,
                        second
                    ) => {
                        return (
                            Date.parse(
                                first.at
                            ) -
                            Date.parse(
                                second.at
                            )
                        );
                    }
                );

            chronological.forEach(
                (entry) => {
                    const item =
                        stats.items.find(
                            (resource) => {
                                return (
                                    resource.asset_id ===
                                    entry.asset_id
                                );
                            }
                        );

                    if (!item) {
                        return;
                    }

                    const historyItem =
                        document.createElement(
                            'li'
                        );

                    historyItem.className =
                        'bd-history-item';


                    const marker =
                        document.createElement(
                            'span'
                        );

                    marker.className =
                        'bd-history-marker';

                    marker.innerHTML = `
                        <svg
                            class="bd-icon"
                            aria-hidden="true"
                        >
                            <use href="#bd-icon-return"></use>
                        </svg>
                    `;


                    const entryContainer =
                        document.createElement(
                            'div'
                        );

                    entryContainer.className =
                        'bd-history-entry';


                    const time =
                        document.createElement(
                            'time'
                        );

                    time.textContent =
                        timeFormat.format(
                            new Date(
                                entry.at
                            )
                        );


                    const title =
                        document.createElement(
                            'strong'
                        );

                    title.textContent =
                        `${entry.quantity} ${
                            entry.quantity === 1
                                ? 'unit'
                                : 'units'
                        } of ${item.name} returned`;


                    const details =
                        document.createElement(
                            'p'
                        );

                    const parts = [
                        item.asset_id,
                        `Condition: ${entry.condition}`
                    ];

                    if (
                        entry.notes
                    ) {
                        parts.push(
                            entry.notes
                        );
                    }

                    details.textContent =
                        parts.join(
                            ' · '
                        );


                    entryContainer.append(
                        time,
                        title,
                        details
                    );

                    historyItem.append(
                        marker,
                        entryContainer
                    );

                    history.appendChild(
                        historyItem
                    );
                }
            );
        };


        const render = () => {
            try {
                if (!store) {
                    throw new Error(
                        'The borrowing preview could not load. Refresh the page and try again.'
                    );
                }

                if (
                    !borrowId?.trim()
                ) {
                    throw new Error(
                        'No borrowing record was selected. Go back to Borrow & Return and open a record.'
                    );
                }

                record =
                    store.getRecord(
                        borrowId
                    );

                if (!record) {
                    throw new Error(
                        'This borrowing record was not found. Go back to Borrow & Return and select an existing record.'
                    );
                }

                if (
                    !Array.isArray(
                        record.items
                    ) ||
                    record.items.length ===
                        0
                ) {
                    throw new Error(
                        'This borrowing record does not contain resource details.'
                    );
                }


                const stats =
                    getOverallStats();


                document.title =
                    `${record.id} | Borrowing Details | PULSO Logistics Hub`;


                setText(
                    'bd-title',
                    record.project
                );

                setText(
                    'bd-reference',
                    `${record.id} · ${record.request_id}`
                );

                setText(
                    'bd-snapshot-date',
                    formatDate(
                        store.snapshotDate
                    )
                );

                setText(
                    'bd-borrow-id',
                    record.id
                );

                setText(
                    'bd-request-id',
                    record.request_id
                );

                setText(
                    'bd-borrower',
                    record.borrower
                );

                setText(
                    'bd-committee',
                    record.committee
                );

                setText(
                    'bd-project',
                    record.project
                );

                setText(
                    'bd-released',
                    formatDate(
                        record.released
                    )
                );

                setText(
                    'bd-due',
                    formatDate(
                        record.due
                    )
                );

                setText(
                    'bd-type-count',
                    `${stats.items.length} ${
                        stats.items.length === 1
                            ? 'resource type'
                            : 'resource types'
                    }`
                );

                setText(
                    'bd-due-note',
                    stats.dueNote
                );


                setStatusBadge(
                    statusBadge,
                    stats.status
                );


                find(
                    'bd-partial'
                ).hidden =
                    !stats.isPartial;


                find(
                    'bd-return-section'
                ).hidden =
                    stats.remaining ===
                    0;


                find(
                    'bd-completed'
                ).hidden =
                    stats.remaining !==
                    0;


                renderSummary(
                    stats
                );

                renderResources(
                    stats
                );

                renderResourceSelect(
                    stats
                );

                renderHistory(
                    stats
                );


                message.hidden =
                    true;

                content.hidden =
                    false;


                updateSubmitButton(
                    stats
                );


                return true;
            } catch (
                failure
            ) {
                showError(
                    failure.message ||
                    'Unable to load this borrowing record.'
                );

                return false;
            }
        };


        const clearError = () => {
            error.textContent =
                '';

            error.hidden =
                true;

            [
                resourceSelect,
                quantity,
                condition,
                notes
            ].forEach(
                (field) => {
                    field.removeAttribute(
                        'aria-invalid'
                    );
                }
            );
        };


        resourceSelect.addEventListener(
            'change',
            () => {
                clearError();

                feedback.textContent =
                    '';

                quantity.value =
                    '';

                updateQuantityField();
            }
        );


        quantity.addEventListener(
            'input',
            () => {
                clearError();

                feedback.textContent =
                    '';

                updateSubmitButton();
            }
        );


        condition.addEventListener(
            'change',
            () => {
                clearError();

                feedback.textContent =
                    '';

                updateSubmitButton();
            }
        );


        notes.addEventListener(
            'input',
            () => {
                clearError();

                feedback.textContent =
                    '';
            }
        );


        form.addEventListener(
            'submit',
            (event) => {
                event.preventDefault();

                if (
                    !record ||
                    saving
                ) {
                    return;
                }

                clearError();

                const stats =
                    getOverallStats();

                const selectedItem =
                    stats.items.find(
                        (item) => {
                            return (
                                item.asset_id ===
                                resourceSelect.value
                            );
                        }
                    );

                if (!selectedItem) {
                    error.textContent =
                        'Select a resource to return.';

                    error.hidden =
                        false;

                    resourceSelect.setAttribute(
                        'aria-invalid',
                        'true'
                    );

                    resourceSelect.focus();

                    return;
                }


                const amount =
                    Number(
                        quantity.value
                    );


                if (
                    !Number.isSafeInteger(
                        amount
                    ) ||
                    amount < 1 ||
                    amount >
                        selectedItem.remaining
                ) {
                    error.textContent =
                        `Enter a whole number between 1 and ${selectedItem.remaining} for ${selectedItem.name}.`;

                    error.hidden =
                        false;

                    quantity.setAttribute(
                        'aria-invalid',
                        'true'
                    );

                    quantity.focus();

                    return;
                }


                if (
                    !condition.value
                ) {
                    error.textContent =
                        'Select the condition of the returned resource.';

                    error.hidden =
                        false;

                    condition.setAttribute(
                        'aria-invalid',
                        'true'
                    );

                    condition.focus();

                    return;
                }


                if (
                    notes.value.length >
                    1000
                ) {
                    error.textContent =
                        'Return notes must be 1,000 characters or fewer.';

                    error.hidden =
                        false;

                    notes.focus();

                    return;
                }


                saving =
                    true;

                submit.disabled =
                    true;


                try {
                    addUserEvent(
                        {
                            asset_id:
                                selectedItem.asset_id,

                            quantity:
                                amount,

                            condition:
                                condition.value,

                            notes:
                                notes.value.trim(),

                            at:
                                new Date()
                                    .toISOString()
                        }
                    );


                    const returnedResourceName =
                        selectedItem.name;


                    form.reset();

                    quantity.disabled =
                        true;

                    clearError();


                    render();


                    const updatedStats =
                        getOverallStats();

                    const updatedItem =
                        updatedStats.items.find(
                            (item) => {
                                return (
                                    item.asset_id ===
                                    selectedItem.asset_id
                                );
                            }
                        );


                    if (
                        updatedStats.remaining ===
                        0
                    ) {
                        feedback.textContent =
                            `Return complete. All resources under ${record.id} have now been returned.`;
                    } else if (
                        updatedItem?.remaining ===
                        0
                    ) {
                        feedback.textContent =
                            `${returnedResourceName} is now fully returned. ${updatedStats.remaining} total ${updatedStats.remaining === 1 ? 'unit remains' : 'units remain'} across the borrowing.`;
                    } else {
                        feedback.textContent =
                            `${amount} ${
                                amount === 1
                                    ? 'unit'
                                    : 'units'
                            } of ${returnedResourceName} recorded. ${updatedItem?.remaining ?? 0} still to return for this resource.`;
                    }


                    feedback.focus();
                } catch (
                    failure
                ) {
                    error.textContent =
                        failure.message ||
                        'The return could not be recorded.';

                    error.hidden =
                        false;
                } finally {
                    saving =
                        false;

                    updateSubmitButton();
                }
            }
        );


        window.addEventListener(
            'pageshow',
            (event) => {
                if (
                    event.persisted
                ) {
                    render();
                }
            }
        );


        render();
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeBorrowDetails,
            {
                once: true
            }
        );
    } else {
        initializeBorrowDetails();
    }
})();
</script>
@endpush