@extends('layouts.app')

@section('title', 'Activity History | PULSO Logistics Hub')

@push('styles')
<style>
    /* ================================================================
       ACTIVITY HISTORY
       ================================================================ */

    .activity-history {
        --ah-navy: #10263d;
        --ah-copy: #31546d;
        --ah-muted: #688297;

        --ah-teal: #007780;
        --ah-pink: #b90c61;
        --ah-blue: #31546d;
        --ah-gold: #895408;
        --ah-green: #2b735d;

        --ah-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--ah-navy);

        container-name: activity-history;
        container-type: inline-size;
    }


    .activity-history *,
    .activity-history *::before,
    .activity-history *::after {
        box-sizing: border-box;
    }


    .activity-history [hidden] {
        display: none !important;
    }


    .ah-heading,
    .ah-heading-actions,
    .ah-section-heading,
    .ah-section-title,
    .ah-filter-footer,
    .ah-pagination,
    .ah-pagination-actions,
    .ah-stat,
    .ah-bar-top {
        display: flex;
        align-items: center;
    }


    /* ================================================================
       HEADER
       ================================================================ */

    .ah-heading {
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }


    .ah-heading-copy {
        min-width: 0;
    }


    .ah-eyebrow {
        margin:
            0
            0
            7px;

        color: var(--ah-teal);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .15em;

        text-transform: uppercase;
    }


    .ah-heading h1 {
        margin: 0;

        color: var(--ah-navy);

        font-size: clamp(
            28px,
            2.8vw,
            38px
        );

        font-weight: 850;
        line-height: 1.1;

        letter-spacing: -.045em;
    }


    .ah-description {
        max-width: 820px;

        margin:
            9px
            0
            0;

        color: #496580;

        font-size: 14px;
        line-height: 1.7;
    }


    .ah-heading-actions {
        flex-shrink: 0;

        gap: 10px;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .ah-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding:
            10px
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


    .ah-button:hover:not(:disabled) {
        color: var(--ah-teal);

        transform: translateY(-1px);
    }


    .ah-button-primary {
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


    .ah-button-primary:hover:not(:disabled) {
        color: #ffffff;

        background:
            linear-gradient(
                145deg,
                #07939b,
                #006d75
            );
    }


    .ah-button:disabled {
        opacity: .48;

        cursor: not-allowed;

        box-shadow: none;
    }


    .ah-button svg {
        width: 17px;
        height: 17px;

        flex-shrink: 0;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* ================================================================
       KPI CARDS
       ================================================================ */

    .activity-history > .ah-summary {
        display: grid !important;

        grid-template-columns:
            repeat(
                5,
                minmax(0, 1fr)
            );

        gap: 12px;

        width: 100%;
        min-width: 0;

        margin:
            0
            0
            20px !important;

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


    .activity-history > .ah-summary::before,
    .activity-history > .ah-summary::after {
        display: none !important;

        background: none !important;

        box-shadow: none !important;

        content: none !important;
    }


    .ah-stat {
        --ah-tone: #007780;

        --ah-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );

        position: relative;

        gap: 11px;

        min-width: 0;
        min-height: 104px;

        padding:
            15px
            13px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                #fbfeff,
                #f7fbfd 50%,
                #f0f7fa
            );

        box-shadow:
            4px 5px 10px rgba(78, 111, 132, .07),
            -4px -4px 9px rgba(255, 255, 255, .64),
            inset 1px 1px 2px rgba(255, 255, 255, .92);
    }


    .ah-stat::after {
        position: absolute;

        top: 0;
        right: 16px;

        width: 32px;
        height: 3px;

        border-radius:
            0
            0
            999px
            999px;

        background: var(--ah-tone);

        opacity: .5;

        content: "";
    }


    .ah-stat[data-tone="teal"] {
        --ah-tone: #007780;

        --ah-fill:
            linear-gradient(
                145deg,
                #e2f8f8,
                #d0eeee
            );
    }


    .ah-stat[data-tone="pink"] {
        --ah-tone: #b90c61;

        --ah-fill:
            linear-gradient(
                145deg,
                #fce8f2,
                #f3d3e3
            );
    }


    .ah-stat[data-tone="navy"] {
        --ah-tone: #173b59;

        --ah-fill:
            linear-gradient(
                145deg,
                #edf4f9,
                #dfeaf2
            );
    }


    .ah-stat[data-tone="gold"] {
        --ah-tone: #895408;

        --ah-fill:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );
    }


    .ah-stat[data-tone="green"] {
        --ah-tone: #2b735d;

        --ah-fill:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );
    }


    .ah-stat-icon {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        flex: 0 0 40px;

        border:
            1px
            solid
            rgba(255, 255, 255, .98);

        border-radius: 13px;

        background: var(--ah-fill);

        color: var(--ah-tone);

        box-shadow:
            3px 4px 8px rgba(83, 117, 139, .08),
            -3px -3px 7px rgba(255, 255, 255, .68);
    }


    .ah-stat-icon svg {
        width: 17px;
        height: 17px;

        fill: none;

        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    .ah-stat-copy {
        min-width: 0;
    }


    .ah-stat-value {
        display: block;

        color: var(--ah-tone);

        font-size: 23px;
        font-weight: 850;
        line-height: 1;

        letter-spacing: -.04em;

        font-variant-numeric: tabular-nums;
    }


    .ah-stat-label {
        display: block;

        margin-top: 6px;

        overflow: hidden;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .ah-stat-helper {
        display: block;

        margin-top: 2px;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       CARDS
       ================================================================ */

    .ah-card {
        min-width: 0;

        margin-bottom: 20px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 22px;

        background:
            linear-gradient(
                145deg,
                rgba(255, 255, 255, .88),
                rgba(233, 246, 252, .84)
            );

        box-shadow:
            6px 8px 20px rgba(101, 138, 163, .11),
            -4px -4px 14px rgba(255, 255, 255, .6),
            inset 1px 1px 1px #ffffff;
    }


    .ah-section-heading {
        justify-content: space-between;

        gap: 15px;

        padding:
            20px
            22px;

        border-bottom:
            1px
            solid
            var(--ah-line);
    }


    .ah-section-title {
        gap: 12px;

        min-width: 0;
    }


    .ah-section-number {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border:
            1px
            solid
            #ffffff;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e2f7f8,
                #ccebed
            );

        color: var(--ah-teal);

        font-size: 13px;
        font-weight: 850;
    }


    .ah-section-number.pink {
        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: var(--ah-pink);
    }


    .ah-section-title h2 {
        margin: 0;

        color: #18344c;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: -.025em;
    }


    .ah-section-title p {
        margin:
            5px
            0
            0;

        color: #496580;

        font-size: 11px;
        line-height: 1.55;
    }


    .ah-source {
        flex-shrink: 0;

        padding:
            7px
            10px;

        border:
            1px
            solid
            rgba(255, 255, 255, .86);

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #edf6fa,
                #e4eff4
            );

        color: #587388;

        font-size: 9px;
        font-weight: 700;

        white-space: nowrap;
    }


    /* ================================================================
       FILTERS
       ================================================================ */

    .ah-filters {
        display: grid;

        grid-template-columns:
            minmax(210px, 1.45fr)
            minmax(170px, 1fr)
            minmax(145px, .78fr)
            minmax(145px, .78fr);

        gap: 14px;

        padding:
            20px
            22px;
    }


    .ah-field {
        min-width: 0;
    }


    .ah-label {
        display: block;

        margin-bottom: 7px;

        color: #31546d;

        font-size: 10px;
        font-weight: 750;
    }


    .ah-input {
        display: block;

        width: 100%;
        height: 42px;

        padding:
            9px
            11px;

        border:
            1px
            solid
            #cfe1ea;

        border-radius: 12px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e8f1f6,
                #edf5f9
            );

        color: #10263d;

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .11),
            inset -3px -3px 7px rgba(255, 255, 255, .82);

        font: inherit;
        font-size: 10px;
    }


    .ah-input:focus {
        border-color:
            rgba(
                0,
                119,
                128,
                .48
            );

        box-shadow:
            inset 3px 3px 7px rgba(91, 125, 147, .1),
            inset -3px -3px 7px rgba(255, 255, 255, .82),
            0 0 0 3px rgba(5, 173, 182, .08);
    }


    .ah-input::placeholder {
        color: #8195a5;
    }


    .ah-filter-footer {
        justify-content: space-between;

        gap: 14px;

        padding:
            0
            22px
            20px;
    }


    .ah-filter-footer p {
        margin: 0;

        color: #688297;

        font-size: 9.5px;
        line-height: 1.6;
    }


    .ah-error {
        margin:
            0
            22px
            16px;

        padding:
            10px
            12px;

        border:
            1px
            solid
            #efd0da;

        border-radius: 11px;

        background: #fff2f7;

        color: #a3225a;

        font-size: 10px;
        line-height: 1.55;
    }


    /* ================================================================
       ANALYTICS
       ================================================================ */

    .ah-analytics {
        display: grid;

        grid-template-columns:
            minmax(0, 1.55fr)
            minmax(0, .75fr);

        align-items: stretch;

        gap: 20px;

        margin-bottom: 20px;
    }


    .ah-analytics .ah-card {
        height: 100%;

        margin-bottom: 0;
    }


    .ah-chart-body {
        min-height: 310px;

        padding: 21px 22px;
    }


    .ah-chart-summary {
        display: flex;
        align-items: baseline;

        flex-wrap: wrap;

        gap: 8px;

        margin-bottom: 13px;

        color: #688297;

        font-size: 9.5px;
    }


    .ah-chart-summary strong {
        color: #10263d;

        font-size: 27px;
        font-weight: 850;
        line-height: 1;
    }


    .ah-chart-scroll {
        width: 100%;

        overflow-x: auto;
    }


    .ah-trend-svg {
        display: block;

        width: 100%;
        min-width: 500px;
        height: auto;
    }


    .ah-chart-hint,
    .ah-chart-note {
        margin:
            10px
            0
            0;

        color: #688297;

        font-size: 9px;
        line-height: 1.55;
    }


    .ah-chart-hint {
        min-height: 18px;

        color: #007780;

        font-weight: 700;
    }


    .ah-chart-values {
        margin-top: 12px;

        color: #31546d;

        font-size: 9.5px;
    }


    .ah-chart-values summary {
        cursor: pointer;

        font-weight: 750;
    }


    .ah-chart-values table {
        width: 100%;

        margin-top: 9px;

        border-collapse: collapse;
    }


    .ah-chart-values th,
    .ah-chart-values td {
        padding:
            7px
            6px;

        border-bottom:
            1px
            solid
            #d5e5ee;

        text-align: left;

        font-size: 9px;
    }


    /* ================================================================
       MODULE BREAKDOWN
       ================================================================ */

    .ah-module-bars {
        display: grid;

        gap: 10px;
    }


    .ah-bar-button {
        width: 100%;

        padding:
            11px
            12px;

        border:
            1px
            solid
            #d5e5ee;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f5fbfd,
                #eaf4f7
            );

        color: #10263d;

        font: inherit;

        text-align: left;

        cursor: pointer;

        transition:
            border-color 150ms ease,
            background 150ms ease,
            transform 150ms ease;
    }


    .ah-bar-button:hover {
        transform: translateY(-1px);
    }


    .ah-bar-button[aria-pressed="true"] {
        border-color:
            rgba(
                0,
                119,
                128,
                .45
            );

        background:
            linear-gradient(
                145deg,
                #e6f7f8,
                #d8edef
            );
    }


    .ah-bar-top {
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 8px;

        color: #31546d;

        font-size: 9px;
        font-weight: 750;
    }


    .ah-bar-top strong {
        flex-shrink: 0;

        color: #10263d;

        font-size: 9px;

        font-variant-numeric: tabular-nums;
    }


    .ah-bar-track {
        display: block;

        width: 100%;
        height: 7px;

        overflow: hidden;

        border-radius: 999px;

        background: #dceaf1;

        box-shadow:
            inset 1px 2px 3px rgba(101, 138, 163, .1);
    }


    .ah-bar-fill {
        display: block;

        width: 0;
        height: 100%;

        border-radius: inherit;
    }


    .ah-bar-fill[data-module="inventory"] {
        background:
            linear-gradient(
                90deg,
                #05adb6,
                #007780
            );
    }


    .ah-bar-fill[data-module="requests"] {
        background:
            linear-gradient(
                90deg,
                #ee1280,
                #b90c61
            );
    }


    .ah-bar-fill[data-module="borrow"] {
        background:
            linear-gradient(
                90deg,
                #66839a,
                #31546d
            );
    }


    .ah-bar-fill[data-module="projects"] {
        background:
            linear-gradient(
                90deg,
                #e1c96f,
                #92701d
            );
    }


    .ah-bar-fill[data-module="donations"] {
        background:
            linear-gradient(
                90deg,
                #56a689,
                #2b735d
            );
    }


    /* ================================================================
       TABLE
       ================================================================ */

    .ah-result-count {
        flex-shrink: 0;

        color: #688297;

        font-size: 9.5px;
        font-weight: 700;

        white-space: nowrap;
    }


    .ah-table-wrap {
        width: 100%;

        overflow-x: auto;
    }


    .ah-table {
        width: 100%;
        min-width: 1020px;

        border-collapse: separate;
        border-spacing: 0;

        text-align: left;
    }


    .ah-table th {
        padding:
            12px
            14px;

        border-bottom:
            1px
            solid
            #cfdee7;

        background:
            rgba(
                225,
                240,
                247,
                .78
            );

        color: #516d82;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

        white-space: nowrap;
    }


    .ah-table td {
        padding:
            14px
            14px;

        border-bottom:
            1px
            solid
            rgba(215, 230, 238, .86);

        color: #405d72;

        font-size: 10px;
        line-height: 1.5;

        vertical-align: top;
    }


    .ah-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .ah-table tbody tr:hover {
        background:
            rgba(
                255,
                255,
                255,
                .42
            );
    }


    .ah-date {
        display: block;

        color: #29475f;

        font-size: 10px;
        font-weight: 750;

        white-space: nowrap;
    }


    .ah-sub {
        display: block;

        margin-top: 3px;

        color: #71899c;

        font-size: 8.5px;
        line-height: 1.45;

        overflow-wrap: anywhere;
    }


    .ah-activity-title {
        display: block;

        min-width: 175px;

        color: #18344c;

        font-size: 10.5px;
        font-weight: 800;
        line-height: 1.45;
    }


    .ah-activity-detail {
        max-width: 320px;
    }


    .ah-reference {
        display: block;

        color: #007780;

        font-size: 9.5px;
        font-weight: 800;

        white-space: nowrap;
    }


    /* ================================================================
       MODULE BADGES
       ================================================================ */

    .ah-module {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 26px;

        padding:
            4px
            8px;

        border:
            1px
            solid
            rgba(255, 255, 255, .8);

        border-radius: 8px;

        font-size: 8.5px;
        font-weight: 800;

        white-space: nowrap;
    }


    .ah-module[data-module="inventory"] {
        background: #dff4f4;

        color: #007780;
    }


    .ah-module[data-module="requests"] {
        background: #f8e0eb;

        color: #b90c61;
    }


    .ah-module[data-module="borrow"] {
        background: #e2ebf2;

        color: #31546d;
    }


    .ah-module[data-module="projects"] {
        background: #fff0d7;

        color: #895408;
    }


    .ah-module[data-module="donations"] {
        background: #e2f0ea;

        color: #2b735d;
    }


    /* ================================================================
       EMPTY
       ================================================================ */

    .ah-empty {
        padding:
            42px
            22px;

        text-align: center;
    }


    .ah-empty strong {
        display: block;

        color: #29475f;

        font-size: 14px;
    }


    .ah-empty p {
        margin:
            6px
            0
            0;

        color: #71899c;

        font-size: 10px;
    }


    /* ================================================================
       PAGINATION
       ================================================================ */

    .ah-pagination {
        justify-content: space-between;

        gap: 14px;

        padding:
            14px
            22px;

        border-top:
            1px
            solid
            var(--ah-line);
    }


    .ah-pagination p {
        margin: 0;

        color: #688297;

        font-size: 9.5px;
    }


    .ah-pagination-actions {
        gap: 9px;
    }


    .ah-page-label {
        min-width: 78px;

        color: #496580;

        font-size: 9.5px;

        text-align: center;
    }


    /* ================================================================
       NOTES
       ================================================================ */

    .ah-footnote,
    .ah-feedback {
        margin:
            10px
            0
            0;

        color: #71899c;

        font-size: 10px;
        line-height: 1.7;
    }


    .ah-feedback {
        color: #007780;

        font-weight: 700;
    }


    .ah-print-only {
        display: none;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container activity-history (max-width: 1020px) {
        .activity-history > .ah-summary {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }


        .ah-filters {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }


    @container activity-history (max-width: 850px) {
        .ah-analytics {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @container activity-history (max-width: 700px) {
        .ah-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .ah-heading-actions {
            width: 100%;

            flex-wrap: wrap;
        }


        .ah-heading-actions .ah-button {
            flex: 1;
        }


        .activity-history > .ah-summary {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }


        .ah-section-heading,
        .ah-filter-footer,
        .ah-pagination {
            align-items: flex-start;

            flex-direction: column;
        }


        .ah-source {
            display: none;
        }
    }


    @container activity-history (max-width: 520px) {
        .activity-history > .ah-summary,
        .ah-filters {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .ah-pagination-actions {
            width: 100%;

            flex-wrap: wrap;
        }
    }


    /* ================================================================
       PRINT
       ================================================================ */

    @media print {
        @page {
            size: A4 landscape;

            margin: 12mm;
        }


        body:has(#activity-history) #app-sidebar,
        body:has(#activity-history) #sidebar-backdrop,
        body:has(#activity-history) #pulso-topbar,
        body:has(#activity-history) .hub-skip-link,
        .activity-history .ah-no-print {
            display: none !important;
        }


        body:has(#activity-history) #app-main {
            padding-left: 0 !important;
        }


        body:has(#activity-history) .hub-content {
            padding: 0 !important;
        }


        .activity-history {
            container-type: normal;
        }


        .activity-history .ah-print-only {
            display: block;
        }


        .activity-history > .ah-summary {
            grid-template-columns:
                repeat(
                    5,
                    minmax(0, 1fr)
                );

            gap: 7px;
        }


        .ah-stat {
            min-height: auto;

            padding: 9px;
        }


        .ah-stat-icon {
            display: none;
        }


        .ah-stat,
        .ah-card,
        .ah-bar-button {
            border:
                1px
                solid
                #cccccc !important;

            background:
                #ffffff !important;

            box-shadow:
                none !important;
        }


        .ah-card,
        .ah-stat {
            break-inside: avoid;
        }


        .ah-analytics {
            grid-template-columns:
                1.55fr
                .75fr;

            gap: 8px;

            break-inside: avoid;
        }


        .ah-chart-body {
            min-height: auto;

            padding: 12px;
        }


        .ah-chart-scroll {
            overflow: visible;
        }


        .ah-trend-svg {
            min-width: 0;
        }


        .ah-chart-hint,
        .ah-chart-values {
            display: none;
        }


        .ah-table {
            min-width: 0;

            table-layout: fixed;

            font-size: 8px;
        }


        .ah-table th,
        .ah-table td {
            padding:
                8px
                6px;

            overflow-wrap: anywhere;
        }


        .ah-table thead {
            display: table-header-group;
        }


        .ah-table tr {
            break-inside: avoid;
        }


        .ah-module,
        .ah-reference,
        .ah-date {
            white-space: normal;
        }
    }
</style>
@endpush


@section('content')
<div
    class="activity-history"
    id="activity-history"
>

    {{-- =============================================================
         HEADER
         ============================================================= --}}

    <header class="ah-heading">

        <div class="ah-heading-copy">

            <p class="ah-eyebrow">
                Records &amp; accountability
            </p>

            <h1>
                Activity History
            </h1>

            <p class="ah-description">
                Review recorded logistics actions across inventory,
                requests, borrowing and returns, project logistics, and
                physical donation intake in one searchable history.
            </p>

        </div>


        <div class="ah-heading-actions ah-no-print">

            <a
                class="ah-button"
                href="{{ route('reports.index') }}"
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M19 12H5"/>
                    <path d="m11 6-6 6 6 6"/>
                </svg>

                Reports &amp; History
            </a>


            <button
                class="ah-button"
                id="ah-print"
                type="button"
                disabled
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M7 8V3h10v5"/>
                    <path d="M7 17H4V9h16v8h-3"/>
                    <path d="M7 14h10v7H7Z"/>
                </svg>

                Print Report
            </button>


            <button
                class="
                    ah-button
                    ah-button-primary
                "
                id="ah-export"
                type="button"
                disabled
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M12 3v12"/>
                    <path d="m8 11 4 4 4-4"/>
                    <path d="M5 17v4h14v-4"/>
                </svg>

                Export CSV
            </button>

        </div>

    </header>


    <p
        class="
            ah-print-only
            ah-footnote
        "
        id="ah-print-context"
    ></p>


    {{-- =============================================================
         KPI SUMMARY
         ============================================================= --}}

    <section
        class="ah-summary"
        aria-label="Activity totals by module"
    >

        <article
            class="ah-stat"
            data-tone="teal"
        >
            <span class="ah-stat-icon">
                <svg viewBox="0 0 24 24">
                    <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                    <path d="M3 8v9l9 5 9-5V8"/>
                    <path d="M12 13v9"/>
                </svg>
            </span>

            <div class="ah-stat-copy">
                <strong
                    class="ah-stat-value"
                    id="ah-inventory-count"
                >
                    0
                </strong>

                <span class="ah-stat-label">
                    Inventory
                </span>

                <span class="ah-stat-helper">
                    Matching inventory actions
                </span>
            </div>
        </article>


        <article
            class="ah-stat"
            data-tone="pink"
        >
            <span class="ah-stat-icon">
                <svg viewBox="0 0 24 24">
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
                </svg>
            </span>

            <div class="ah-stat-copy">
                <strong
                    class="ah-stat-value"
                    id="ah-requests-count"
                >
                    0
                </strong>

                <span class="ah-stat-label">
                    Requests
                </span>

                <span class="ah-stat-helper">
                    Matching request actions
                </span>
            </div>
        </article>


        <article
            class="ah-stat"
            data-tone="navy"
        >
            <span class="ah-stat-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 7h15"/>
                    <path d="m15 3 4 4-4 4"/>
                    <path d="M20 17H5"/>
                    <path d="m9 13-4 4 4 4"/>
                </svg>
            </span>

            <div class="ah-stat-copy">
                <strong
                    class="ah-stat-value"
                    id="ah-borrow-count"
                >
                    0
                </strong>

                <span class="ah-stat-label">
                    Borrow &amp; Return
                </span>

                <span class="ah-stat-helper">
                    Matching custody actions
                </span>
            </div>
        </article>


        <article
            class="ah-stat"
            data-tone="gold"
        >
            <span class="ah-stat-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
                    <path d="M12 11v6"/>
                    <path d="M9 14h6"/>
                </svg>
            </span>

            <div class="ah-stat-copy">
                <strong
                    class="ah-stat-value"
                    id="ah-projects-count"
                >
                    0
                </strong>

                <span class="ah-stat-label">
                    Projects
                </span>

                <span class="ah-stat-helper">
                    Matching project actions
                </span>
            </div>
        </article>


        <article
            class="ah-stat"
            data-tone="green"
        >
            <span class="ah-stat-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 10h16v10H4Z"/>
                    <path d="M3 7h18v3H3Z"/>
                    <path d="M12 7v13"/>
                    <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>
                    <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>
                </svg>
            </span>

            <div class="ah-stat-copy">
                <strong
                    class="ah-stat-value"
                    id="ah-donations-count"
                >
                    0
                </strong>

                <span class="ah-stat-label">
                    Donations
                </span>

                <span class="ah-stat-helper">
                    Matching donation actions
                </span>
            </div>
        </article>

    </section>


    {{-- =============================================================
         01 FILTERS
         ============================================================= --}}

    <section
        class="
            ah-card
            ah-no-print
        "
        aria-labelledby="ah-filter-title"
    >

        <header class="ah-section-heading">

            <div class="ah-section-title">

                <span class="ah-section-number">
                    01
                </span>

                <div>
                    <h2 id="ah-filter-title">
                        Activity Filters
                    </h2>

                    <p>
                        Search and narrow activity by module or date.
                    </p>
                </div>

            </div>


            <span class="ah-source">
                Sample activity · September 2026
            </span>

        </header>


        <form id="ah-filter-form">

            <div class="ah-filters">

                <div class="ah-field">

                    <label
                        class="ah-label"
                        for="ah-search"
                    >
                        Search activity
                    </label>

                    <input
                        class="ah-input"
                        id="ah-search"
                        type="search"
                        placeholder="Activity, reference, person..."
                        autocomplete="off"
                    >

                </div>


                <div class="ah-field">

                    <label
                        class="ah-label"
                        for="ah-module"
                    >
                        Module
                    </label>

                    <select
                        class="ah-input"
                        id="ah-module"
                    >
                        <option value="">
                            All modules
                        </option>

                        <option value="inventory">
                            Inventory &amp; Assets
                        </option>

                        <option value="requests">
                            Logistics Requests
                        </option>

                        <option value="borrow">
                            Borrow &amp; Return
                        </option>

                        <option value="projects">
                            Projects
                        </option>

                        <option value="donations">
                            Donations
                        </option>
                    </select>

                </div>


                <div class="ah-field">

                    <label
                        class="ah-label"
                        for="ah-from"
                    >
                        From date
                    </label>

                    <input
                        class="ah-input"
                        id="ah-from"
                        type="date"
                        value="2026-09-01"
                    >

                </div>


                <div class="ah-field">

                    <label
                        class="ah-label"
                        for="ah-to"
                    >
                        To date
                    </label>

                    <input
                        class="ah-input"
                        id="ah-to"
                        type="date"
                        value="2026-09-30"
                    >

                </div>

            </div>


            <p
                class="ah-error"
                id="ah-filter-error"
                role="alert"
                hidden
            ></p>


            <div class="ah-filter-footer">

                <p>
                    Filters apply automatically. Dates and times use Philippine time.
                </p>


                <button
                    class="ah-button"
                    id="ah-reset"
                    type="button"
                >
                    Reset Filters
                </button>

            </div>

        </form>

    </section>


    {{-- =============================================================
         02 TREND + 03 MODULE BREAKDOWN
         ============================================================= --}}

    <div class="ah-analytics">

        <section
            class="ah-card"
            aria-labelledby="ah-trend-title"
        >

            <header class="ah-section-heading">

                <div class="ah-section-title">

                    <span class="ah-section-number pink">
                        02
                    </span>

                    <div>
                        <h2 id="ah-trend-title">
                            Activity Trend
                        </h2>

                        <p id="ah-trend-period">
                            Matching logistics activity over time.
                        </p>
                    </div>

                </div>

            </header>


            <div class="ah-chart-body">

                <div class="ah-chart-summary">

                    <strong id="ah-trend-total">
                        0
                    </strong>

                    <span>
                        matching actions
                    </span>

                </div>


                <div
                    class="ah-chart-scroll"
                    role="region"
                    aria-label="Activity trend chart"
                    tabindex="0"
                >
                    <svg
                        class="ah-trend-svg"
                        id="ah-trend-svg"
                        viewBox="0 0 640 250"
                        role="img"
                        aria-labelledby="ah-trend-title ah-trend-description"
                    >
                        <desc id="ah-trend-description">
                            Activity trend chart.
                        </desc>
                    </svg>
                </div>


                <p
                    class="ah-chart-hint"
                    id="ah-trend-hint"
                >
                    Hover over a point to see its count.
                </p>


                <p
                    class="ah-chart-note"
                    id="ah-peak-note"
                ></p>


                <details class="ah-chart-values">

                    <summary>
                        View trend values
                    </summary>

                    <table>

                        <thead>
                            <tr>
                                <th scope="col">
                                    Date
                                </th>

                                <th scope="col">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody id="ah-trend-values"></tbody>

                    </table>

                </details>

            </div>

        </section>


        <section
            class="ah-card"
            aria-labelledby="ah-breakdown-title"
        >

            <header class="ah-section-heading">

                <div class="ah-section-title">

                    <span class="ah-section-number">
                        03
                    </span>

                    <div>
                        <h2 id="ah-breakdown-title">
                            Activity by Module
                        </h2>

                        <p>
                            Share of matching history records.
                        </p>
                    </div>

                </div>

            </header>


            <div class="ah-chart-body">

                <div class="ah-module-bars">

                    @foreach ([
                        'inventory' => 'Inventory & Assets',
                        'requests' => 'Logistics Requests',
                        'borrow' => 'Borrow & Return',
                        'projects' => 'Projects',
                        'donations' => 'Donations',
                    ] as $moduleKey => $moduleLabel)

                        <button
                            class="ah-bar-button"
                            type="button"
                            data-filter-module="{{ $moduleKey }}"
                            aria-pressed="false"
                        >

                            <span class="ah-bar-top">

                                <span>
                                    {{ $moduleLabel }}
                                </span>

                                <strong data-bar-count>
                                    0 · 0%
                                </strong>

                            </span>


                            <span
                                class="ah-bar-track"
                                aria-hidden="true"
                            >
                                <span
                                    class="ah-bar-fill"
                                    data-bar-fill
                                    data-module="{{ $moduleKey }}"
                                ></span>
                            </span>

                        </button>

                    @endforeach

                </div>


                <p class="ah-chart-note ah-no-print">
                    Click a module to filter the history. Click it again
                    to return to all modules.
                </p>

            </div>

        </section>

    </div>


    {{-- =============================================================
         04 ACTIVITY HISTORY
         ============================================================= --}}

    <section
        class="ah-card"
        aria-labelledby="ah-history-title"
    >

        <header class="ah-section-heading">

            <div class="ah-section-title">

                <span class="ah-section-number pink">
                    04
                </span>

                <div>
                    <h2 id="ah-history-title">
                        Activity History
                    </h2>

                    <p>
                        Newest activity first. Each row represents one recorded action.
                    </p>
                </div>

            </div>


            <span
                class="ah-result-count"
                id="ah-result-count"
                role="status"
                aria-live="polite"
            >
                Loading activity...
            </span>

        </header>


        <div
            class="
                ah-table-wrap
                ah-no-print
                custom-scrollbar
            "
            role="region"
            aria-label="Activity history table"
            tabindex="0"
        >

            <table class="ah-table">

                <thead>
                    <tr>
                        <th scope="col">
                            Date &amp; Time
                        </th>

                        <th scope="col">
                            Module
                        </th>

                        <th scope="col">
                            Activity
                        </th>

                        <th scope="col">
                            Reference
                        </th>

                        <th scope="col">
                            Recorded By
                        </th>
                    </tr>
                </thead>


                <tbody id="ah-rows"></tbody>

            </table>

        </div>


        <div
            class="ah-empty"
            id="ah-empty"
            hidden
        >
            <strong>
                No matching activity
            </strong>

            <p>
                Try another search, module, or date range.
            </p>
        </div>


        <div class="ah-print-only">

            <table class="ah-table">

                <thead>
                    <tr>
                        <th scope="col">
                            Date &amp; Time
                        </th>

                        <th scope="col">
                            Module
                        </th>

                        <th scope="col">
                            Activity
                        </th>

                        <th scope="col">
                            Reference
                        </th>

                        <th scope="col">
                            Recorded By
                        </th>
                    </tr>
                </thead>


                <tbody id="ah-print-rows"></tbody>

            </table>

        </div>


        <footer
            class="
                ah-pagination
                ah-no-print
            "
        >

            <p id="ah-showing"></p>


            <div class="ah-pagination-actions">

                <button
                    class="ah-button"
                    id="ah-previous"
                    type="button"
                    disabled
                >
                    Previous
                </button>


                <span
                    class="ah-page-label"
                    id="ah-page-label"
                ></span>


                <button
                    class="ah-button"
                    id="ah-next"
                    type="button"
                    disabled
                >
                    Next
                </button>

            </div>

        </footer>

    </section>


    <p class="ah-footnote">
        This Activity History currently uses coordinated front-end sample
        records. During backend integration, the same interface can display
        actual audit events generated by inventory, requests, borrowing,
        projects, and donation transactions.
    </p>


    <p
        class="
            ah-feedback
            ah-no-print
        "
        id="ah-feedback"
        role="status"
        aria-live="polite"
    ></p>


    <noscript>
        <p class="ah-error">
            Enable JavaScript to load and filter the activity history.
        </p>
    </noscript>


    <template id="ah-row-template">

        <tr>

            <td>
                <time
                    class="ah-date"
                    data-cell="date"
                ></time>

                <span
                    class="ah-sub"
                    data-cell="time"
                ></span>
            </td>


            <td>
                <span
                    class="ah-module"
                    data-cell="module"
                ></span>
            </td>


            <td>
                <strong
                    class="ah-activity-title"
                    data-cell="action"
                ></strong>

                <span
                    class="
                        ah-sub
                        ah-activity-detail
                    "
                    data-cell="detail"
                ></span>
            </td>


            <td>
                <span
                    class="ah-reference"
                    data-cell="reference"
                ></span>

                <span
                    class="ah-sub"
                    data-cell="event"
                ></span>
            </td>


            <td>
                <span data-cell="actor"></span>

                <span
                    class="ah-sub"
                    data-cell="role"
                ></span>
            </td>

        </tr>

    </template>

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeActivityHistory = () => {
        const page =
            document.getElementById(
                'activity-history'
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
        | SAMPLE ACTIVITY
        |--------------------------------------------------------------------------
        */

        const sampleEvents = [
            {
                id: 'ACT-2026-0001',
                at: '2026-09-05T10:20:00+08:00',
                module: 'donations',
                action: 'Donation verified',
                detail: 'Portable Storage Boxes from Ramon Villanueva were inspected and accepted.',
                reference: 'DON-2026-0007',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0002',
                at: '2026-09-06T08:45:00+08:00',
                module: 'donations',
                action: 'Donation received',
                detail: 'Eight Extension Cords from Local Business Partners were recorded for inspection.',
                reference: 'DON-2026-0008',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0003',
                at: '2026-09-06T16:30:00+08:00',
                module: 'projects',
                action: 'Project logistics completed',
                detail: 'Student Assistance Orientation completed its logistics workflow.',
                reference: 'PRJ-2026-0014',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0004',
                at: '2026-09-07T10:10:00+08:00',
                module: 'donations',
                action: 'Donation added to inventory',
                detail: 'Six donated Folding Tables were integrated into reusable logistics inventory.',
                reference: 'DON-2026-0009',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0005',
                at: '2026-09-07T17:36:00+08:00',
                module: 'projects',
                action: 'Project logistics completed',
                detail: 'PULSO Volunteer Orientation was marked completed after resource accounting.',
                reference: 'PRJ-2026-0015',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0006',
                at: '2026-09-08T09:05:00+08:00',
                module: 'inventory',
                action: 'Asset inspected',
                detail: 'Portable Sound System was inspected before upcoming logistics preparation.',
                reference: 'PULSO-AUD-001',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0007',
                at: '2026-09-08T13:20:00+08:00',
                module: 'donations',
                action: 'Donation allocated',
                detail: 'Cleaning Tool Kits were allocated to the Coastal Clean-Up Drive.',
                reference: 'DON-2026-0010',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0008',
                at: '2026-09-08T14:15:00+08:00',
                module: 'requests',
                action: 'Request submitted',
                detail: 'Youth Sports Festival logistics request entered the request register.',
                reference: 'REQ-2026-0043',
                actor: 'Ramon Garcia',
                role: 'Sports Committee'
            },
            {
                id: 'ACT-2026-0009',
                at: '2026-09-09T09:00:00+08:00',
                module: 'requests',
                action: 'Request approved',
                detail: 'School Supply Distribution logistics request was approved.',
                reference: 'REQ-2026-0044',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0010',
                at: '2026-09-09T10:25:00+08:00',
                module: 'donations',
                action: 'Donation received',
                detail: 'Twenty Monoblock Chairs were received from Community Partners Association.',
                reference: 'DON-2026-0011',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0011',
                at: '2026-09-09T14:10:00+08:00',
                module: 'donations',
                action: 'Donation verified',
                detail: 'All twenty donated Monoblock Chairs were inspected and accepted.',
                reference: 'DON-2026-0011',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0012',
                at: '2026-09-10T08:00:00+08:00',
                module: 'projects',
                action: 'Project moved to ongoing',
                detail: 'Coastal Clean-Up Drive entered the Ongoing logistics stage.',
                reference: 'PRJ-2026-0016',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0013',
                at: '2026-09-10T08:30:00+08:00',
                module: 'borrow',
                action: 'Resources released',
                detail: 'Large Event Tents and Extension Cords were released to Angela Cruz.',
                reference: 'BRW-2026-0027',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0014',
                at: '2026-09-10T10:05:00+08:00',
                module: 'requests',
                action: 'Request submitted',
                detail: 'Youth Leadership Summit request was recorded with three requested resource types.',
                reference: 'REQ-2026-0047',
                actor: 'Maria Santos',
                role: 'Events Committee'
            },
            {
                id: 'ACT-2026-0015',
                at: '2026-09-10T10:40:00+08:00',
                module: 'requests',
                action: 'Request approved',
                detail: 'Medical Mission logistics request was approved for coordination.',
                reference: 'REQ-2026-0046',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0016',
                at: '2026-09-10T13:30:00+08:00',
                module: 'inventory',
                action: 'Resource availability checked',
                detail: 'Available Monoblock Chairs were checked against Youth Leadership Summit requirements.',
                reference: 'PULSO-FUR-001',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0017',
                at: '2026-09-11T09:10:00+08:00',
                module: 'borrow',
                action: 'Resources released',
                detail: 'Folding Tables and Power Strips were released for the Medical Mission.',
                reference: 'BRW-2026-0026',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0018',
                at: '2026-09-11T14:15:00+08:00',
                module: 'projects',
                action: 'Project marked ready',
                detail: 'Medical Mission resources passed preparation and readiness checks.',
                reference: 'PRJ-2026-0017',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0019',
                at: '2026-09-12T07:15:00+08:00',
                module: 'borrow',
                action: 'Resources released',
                detail: 'Sound System, Projector, and Monoblock Chairs were released to Maria Santos.',
                reference: 'BRW-2026-0028',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0020',
                at: '2026-09-12T09:40:00+08:00',
                module: 'requests',
                action: 'Request needs resolution',
                detail: 'Youth Leadership Summit was flagged because ten additional chairs were required.',
                reference: 'REQ-2026-0047',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0021',
                at: '2026-09-12T10:05:00+08:00',
                module: 'inventory',
                action: 'Maintenance status recorded',
                detail: 'Power Strip inventory remained under Maintenance after condition assessment.',
                reference: 'PULSO-ELE-002',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            },
            {
                id: 'ACT-2026-0022',
                at: '2026-09-12T11:10:00+08:00',
                module: 'borrow',
                action: 'Overdue borrowing flagged',
                detail: 'Coastal Clean-Up Drive borrowing remained outstanding beyond its due date.',
                reference: 'BRW-2026-0027',
                actor: 'Paul Roldan',
                role: 'Logistics Head'
            }
        ];


        /*
        |--------------------------------------------------------------------------
        | MODULES
        |--------------------------------------------------------------------------
        */

        const modules = {
            inventory: 'Inventory & Assets',
            requests: 'Logistics Requests',
            borrow: 'Borrow & Return',
            projects: 'Projects',
            donations: 'Donations'
        };


        const moduleKeys =
            Object.keys(
                modules
            );


        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const find = (id) =>
            page.querySelector(
                `#${id}`
            );


        const search =
            find(
                'ah-search'
            );


        const moduleFilter =
            find(
                'ah-module'
            );


        const from =
            find(
                'ah-from'
            );


        const to =
            find(
                'ah-to'
            );


        const error =
            find(
                'ah-filter-error'
            );


        const feedback =
            find(
                'ah-feedback'
            );


        const rows =
            find(
                'ah-rows'
            );


        const printRows =
            find(
                'ah-print-rows'
            );


        const template =
            find(
                'ah-row-template'
            );


        const empty =
            find(
                'ah-empty'
            );


        const resultCount =
            find(
                'ah-result-count'
            );


        const showing =
            find(
                'ah-showing'
            );


        const pageLabel =
            find(
                'ah-page-label'
            );


        const previous =
            find(
                'ah-previous'
            );


        const next =
            find(
                'ah-next'
            );


        const exportButton =
            find(
                'ah-export'
            );


        const printButton =
            find(
                'ah-print'
            );


        /*
        |--------------------------------------------------------------------------
        | STATE
        |--------------------------------------------------------------------------
        */

        const pageSize =
            8;


        let currentPage =
            1;


        let filtered =
            [];


        /*
        |--------------------------------------------------------------------------
        | FORMATTERS
        |--------------------------------------------------------------------------
        */

        const dateFormatter =
            new Intl.DateTimeFormat(
                'en-PH',
                {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    timeZone: 'Asia/Manila'
                }
            );


        const shortDateFormatter =
            new Intl.DateTimeFormat(
                'en-PH',
                {
                    month: 'short',
                    day: 'numeric',
                    timeZone: 'Asia/Manila'
                }
            );


        const timeFormatter =
            new Intl.DateTimeFormat(
                'en-PH',
                {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Manila'
                }
            );


        const generatedFormatter =
            new Intl.DateTimeFormat(
                'en-PH',
                {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Manila'
                }
            );


        /*
        |--------------------------------------------------------------------------
        | HELPERS
        |--------------------------------------------------------------------------
        */

        const setText = (
            id,
            value
        ) => {
            const element =
                find(
                    id
                );


            if (
                element
            ) {
                element.textContent =
                    value;
            }
        };


        const normalize = (
            value
        ) => {
            return String(
                value ?? ''
            )
                .trim()
                .toLowerCase();
        };


        const percentage = (
            value,
            total
        ) => {
            if (
                total <= 0
            ) {
                return 0;
            }


            return Number(
                (
                    (
                        value
                        /
                        total
                    )
                    *
                    100
                ).toFixed(
                    1
                )
            );
        };


        /*
        |--------------------------------------------------------------------------
        | TABLE ROW CREATION
        |--------------------------------------------------------------------------
        */

        const makeRows = (
            records
        ) => {
            const fragment =
                document.createDocumentFragment();


            records.forEach(
                (record) => {
                    const row =
                        template
                            .content
                            .firstElementChild
                            .cloneNode(
                                true
                            );


                    const cell = (
                        name
                    ) => {
                        return row.querySelector(
                            `[data-cell="${name}"]`
                        );
                    };


                    const timestamp =
                        new Date(
                            record.at
                        );


                    cell(
                        'date'
                    ).dateTime =
                        record.at;


                    cell(
                        'date'
                    ).textContent =
                        dateFormatter.format(
                            timestamp
                        );


                    cell(
                        'time'
                    ).textContent =
                        timeFormatter.format(
                            timestamp
                        );


                    cell(
                        'module'
                    ).textContent =
                        modules[
                            record.module
                        ];


                    cell(
                        'module'
                    ).dataset.module =
                        record.module;


                    cell(
                        'action'
                    ).textContent =
                        record.action;


                    cell(
                        'detail'
                    ).textContent =
                        record.detail;


                    cell(
                        'reference'
                    ).textContent =
                        record.reference;


                    cell(
                        'event'
                    ).textContent =
                        record.id;


                    cell(
                        'actor'
                    ).textContent =
                        record.actor;


                    cell(
                        'role'
                    ).textContent =
                        record.role;


                    fragment.appendChild(
                        row
                    );
                }
            );


            return fragment;
        };


        /*
        |--------------------------------------------------------------------------
        | KPI SUMMARY
        |--------------------------------------------------------------------------
        */

        const updateSummary = () => {
            const counts = {
                inventory: 0,
                requests: 0,
                borrow: 0,
                projects: 0,
                donations: 0
            };


            filtered.forEach(
                (record) => {
                    if (
                        counts[
                            record.module
                        ] !== undefined
                    ) {
                        counts[
                            record.module
                        ] += 1;
                    }
                }
            );


            setText(
                'ah-inventory-count',
                counts.inventory
            );


            setText(
                'ah-requests-count',
                counts.requests
            );


            setText(
                'ah-borrow-count',
                counts.borrow
            );


            setText(
                'ah-projects-count',
                counts.projects
            );


            setText(
                'ah-donations-count',
                counts.donations
            );


            return counts;
        };


        /*
        |--------------------------------------------------------------------------
        | MODULE BREAKDOWN
        |--------------------------------------------------------------------------
        */

        const updateModuleBars = (
            counts
        ) => {
            const total =
                filtered.length;


            page
                .querySelectorAll(
                    '[data-filter-module]'
                )
                .forEach(
                    (button) => {
                        const key =
                            button.dataset.filterModule;


                        const value =
                            counts[
                                key
                            ] || 0;


                        const share =
                            percentage(
                                value,
                                total
                            );


                        const label =
                            button.querySelector(
                                '[data-bar-count]'
                            );


                        const fill =
                            button.querySelector(
                                '[data-bar-fill]'
                            );


                        if (
                            label
                        ) {
                            label.textContent =
                                `${value} · ${share}%`;
                        }


                        if (
                            fill
                        ) {
                            fill.style.width =
                                `${share}%`;
                        }


                        button.setAttribute(
                            'aria-pressed',
                            moduleFilter.value ===
                                key
                                ? 'true'
                                : 'false'
                        );
                    }
                );
        };


        /*
        |--------------------------------------------------------------------------
        | TREND DATA
        |--------------------------------------------------------------------------
        */

        const getTrendData = () => {
            const map =
                new Map();


            filtered.forEach(
                (record) => {
                    const key =
                        record.at.slice(
                            0,
                            10
                        );


                    map.set(
                        key,
                        (
                            map.get(
                                key
                            ) || 0
                        ) + 1
                    );
                }
            );


            return Array.from(
                map.entries()
            )
                .sort(
                    (
                        first,
                        second
                    ) =>
                        first[0].localeCompare(
                            second[0]
                        )
                )
                .map(
                    (
                        [
                            date,
                            count
                        ]
                    ) => ({
                        date,
                        count
                    })
                );
        };


        /*
        |--------------------------------------------------------------------------
        | TREND CHART
        |--------------------------------------------------------------------------
        */

        const renderTrend = () => {
            const svg =
                find(
                    'ah-trend-svg'
                );


            const valuesBody =
                find(
                    'ah-trend-values'
                );


            if (
                !svg ||
                !valuesBody
            ) {
                return;
            }


            const data =
                getTrendData();


            setText(
                'ah-trend-total',
                filtered.length
            );


            valuesBody.innerHTML =
                '';


            data.forEach(
                (item) => {
                    const row =
                        document.createElement(
                            'tr'
                        );


                    const date =
                        document.createElement(
                            'td'
                        );


                    const count =
                        document.createElement(
                            'td'
                        );


                    date.textContent =
                        dateFormatter.format(
                            new Date(
                                `${item.date}T12:00:00+08:00`
                            )
                        );


                    count.textContent =
                        String(
                            item.count
                        );


                    row.append(
                        date,
                        count
                    );


                    valuesBody.appendChild(
                        row
                    );
                }
            );


            svg.innerHTML =
                '';


            const width =
                640;


            const height =
                250;


            const left =
                42;


            const right =
                18;


            const top =
                20;


            const bottom =
                42;


            const plotWidth =
                width
                - left
                - right;


            const plotHeight =
                height
                - top
                - bottom;


            const maximum =
                Math.max(
                    1,
                    ...data.map(
                        (item) =>
                            item.count
                    )
                );


            const namespace =
                'http://www.w3.org/2000/svg';


            const createSvgElement = (
                name,
                attributes = {}
            ) => {
                const element =
                    document.createElementNS(
                        namespace,
                        name
                    );


                Object.entries(
                    attributes
                ).forEach(
                    (
                        [
                            key,
                            value
                        ]
                    ) => {
                        element.setAttribute(
                            key,
                            value
                        );
                    }
                );


                return element;
            };


            for (
                let index = 0;
                index <= 4;
                index += 1
            ) {
                const ratio =
                    index / 4;


                const y =
                    top
                    +
                    (
                        plotHeight
                        * ratio
                    );


                const line =
                    createSvgElement(
                        'line',
                        {
                            x1: left,
                            y1: y,
                            x2:
                                width
                                - right,
                            y2: y,
                            stroke: '#d5e5ee',
                            'stroke-width': '1'
                        }
                    );


                svg.appendChild(
                    line
                );


                const label =
                    createSvgElement(
                        'text',
                        {
                            x:
                                left
                                - 8,
                            y:
                                y
                                + 3,
                            fill: '#71899c',
                            'font-size': '9',
                            'text-anchor': 'end'
                        }
                    );


                label.textContent =
                    String(
                        Math.round(
                            maximum
                            *
                            (
                                1
                                - ratio
                            )
                        )
                    );


                svg.appendChild(
                    label
                );
            }


            if (
                data.length ===
                0
            ) {
                const message =
                    createSvgElement(
                        'text',
                        {
                            x:
                                width / 2,
                            y:
                                height / 2,
                            fill: '#71899c',
                            'font-size': '12',
                            'text-anchor': 'middle'
                        }
                    );


                message.textContent =
                    'No matching activity';


                svg.appendChild(
                    message
                );


                setText(
                    'ah-peak-note',
                    'No activity is available for the current filters.'
                );


                return;
            }


            const points =
                data.map(
                    (
                        item,
                        index
                    ) => {
                        const x =
                            data.length ===
                                1
                                ? left
                                    +
                                    plotWidth / 2
                                : left
                                    +
                                    (
                                        index
                                        /
                                        (
                                            data.length
                                            - 1
                                        )
                                    )
                                    *
                                    plotWidth;


                        const y =
                            top
                            +
                            plotHeight
                            -
                            (
                                (
                                    item.count
                                    /
                                    maximum
                                )
                                *
                                plotHeight
                            );


                        return {
                            ...item,
                            x,
                            y
                        };
                    }
                );


            if (
                points.length >
                1
            ) {
                const polyline =
                    createSvgElement(
                        'polyline',
                        {
                            points:
                                points
                                    .map(
                                        (point) =>
                                            `${point.x},${point.y}`
                                    )
                                    .join(
                                        ' '
                                    ),
                            fill: 'none',
                            stroke: '#007780',
                            'stroke-width': '3',
                            'stroke-linecap': 'round',
                            'stroke-linejoin': 'round'
                        }
                    );


                svg.appendChild(
                    polyline
                );
            }


            points.forEach(
                (
                    point,
                    index
                ) => {
                    const circle =
                        createSvgElement(
                            'circle',
                            {
                                cx:
                                    point.x,
                                cy:
                                    point.y,
                                r: '5',
                                fill: '#ffffff',
                                stroke: '#007780',
                                'stroke-width': '3',
                                tabindex: '0'
                            }
                        );


                    const date =
                        dateFormatter.format(
                            new Date(
                                `${point.date}T12:00:00+08:00`
                            )
                        );


                    const showHint =
                        () => {
                            setText(
                                'ah-trend-hint',
                                `${date}: ${point.count} ${point.count === 1 ? 'action' : 'actions'}`
                            );
                        };


                    circle.addEventListener(
                        'mouseenter',
                        showHint
                    );


                    circle.addEventListener(
                        'focus',
                        showHint
                    );


                    svg.appendChild(
                        circle
                    );


                    const shouldLabel =
                        data.length <=
                            7
                        ||
                        index ===
                            0
                        ||
                        index ===
                            data.length
                            - 1
                        ||
                        index %
                            2 ===
                            0;


                    if (
                        shouldLabel
                    ) {
                        const label =
                            createSvgElement(
                                'text',
                                {
                                    x:
                                        point.x,
                                    y:
                                        height
                                        - 14,
                                    fill: '#71899c',
                                    'font-size': '9',
                                    'text-anchor': 'middle'
                                }
                            );


                        label.textContent =
                            shortDateFormatter.format(
                                new Date(
                                    `${point.date}T12:00:00+08:00`
                                )
                            );


                        svg.appendChild(
                            label
                        );
                    }
                }
            );


            const peak =
                data.reduce(
                    (
                        best,
                        item
                    ) =>
                        item.count >
                        best.count
                            ? item
                            : best,
                    data[0]
                );


            setText(
                'ah-peak-note',
                `Peak activity: ${dateFormatter.format(
                    new Date(
                        `${peak.date}T12:00:00+08:00`
                    )
                )} with ${peak.count} ${peak.count === 1 ? 'action' : 'actions'}.`
            );
        };


        /*
        |--------------------------------------------------------------------------
        | PRINT
        |--------------------------------------------------------------------------
        */

        const updatePrintContext = () => {
            const moduleName =
                moduleFilter.value
                    ? modules[
                        moduleFilter.value
                    ]
                    : 'All modules';


            setText(
                'ah-print-context',
                `Filters: ${moduleName} · ${from.value || 'Beginning'} to ${to.value || 'Latest'} · ${filtered.length} matching records · Generated ${generatedFormatter.format(new Date())}`
            );
        };


        /*
        |--------------------------------------------------------------------------
        | RENDER TABLE
        |--------------------------------------------------------------------------
        */

        const render = () => {
            rows.innerHTML =
                '';


            printRows.innerHTML =
                '';


            const totalPages =
                Math.max(
                    1,
                    Math.ceil(
                        filtered.length
                        /
                        pageSize
                    )
                );


            if (
                currentPage >
                totalPages
            ) {
                currentPage =
                    totalPages;
            }


            const start =
                (
                    currentPage
                    - 1
                )
                *
                pageSize;


            const end =
                Math.min(
                    start
                    +
                    pageSize,
                    filtered.length
                );


            const pageRecords =
                filtered.slice(
                    start,
                    end
                );


            rows.appendChild(
                makeRows(
                    pageRecords
                )
            );


            printRows.appendChild(
                makeRows(
                    filtered
                )
            );


            empty.hidden =
                filtered.length !==
                0;


            resultCount.textContent =
                `${filtered.length} ${filtered.length === 1 ? 'record' : 'records'}`;


            showing.textContent =
                filtered.length
                    ? `Showing ${start + 1}–${end} of ${filtered.length} records`
                    : 'Showing 0 records';


            pageLabel.textContent =
                `Page ${currentPage} of ${totalPages}`;


            previous.disabled =
                currentPage <=
                1;


            next.disabled =
                currentPage >=
                totalPages
                ||
                filtered.length ===
                    0;


            exportButton.disabled =
                filtered.length ===
                    0;


            printButton.disabled =
                filtered.length ===
                    0;


            const counts =
                updateSummary();


            updateModuleBars(
                counts
            );


            renderTrend();


            updatePrintContext();
        };


        /*
        |--------------------------------------------------------------------------
        | FILTERING
        |--------------------------------------------------------------------------
        */

        const applyFilters = () => {
            const query =
                normalize(
                    search.value
                );


            const selectedModule =
                moduleFilter.value;


            const fromValue =
                from.value;


            const toValue =
                to.value;


            error.hidden =
                true;


            error.textContent =
                '';


            if (
                fromValue
                &&
                toValue
                &&
                fromValue >
                    toValue
            ) {
                error.textContent =
                    'The From date cannot be later than the To date.';


                error.hidden =
                    false;


                filtered =
                    [];


                currentPage =
                    1;


                render();


                return;
            }


            filtered =
                sampleEvents
                    .filter(
                        (record) => {
                            const recordDate =
                                record.at.slice(
                                    0,
                                    10
                                );


                            const matchesModule =
                                !selectedModule
                                ||
                                record.module ===
                                    selectedModule;


                            const matchesFrom =
                                !fromValue
                                ||
                                recordDate >=
                                    fromValue;


                            const matchesTo =
                                !toValue
                                ||
                                recordDate <=
                                    toValue;


                            const haystack =
                                normalize(
                                    [
                                        record.id,
                                        record.action,
                                        record.detail,
                                        record.reference,
                                        record.actor,
                                        record.role,
                                        modules[
                                            record.module
                                        ]
                                    ].join(
                                        ' '
                                    )
                                );


                            const matchesSearch =
                                !query
                                ||
                                haystack.includes(
                                    query
                                );


                            return (
                                matchesModule
                                &&
                                matchesFrom
                                &&
                                matchesTo
                                &&
                                matchesSearch
                            );
                        }
                    )
                    .sort(
                        (
                            first,
                            second
                        ) =>
                            new Date(
                                second.at
                            )
                            -
                            new Date(
                                first.at
                            )
                    );


            currentPage =
                1;


            feedback.textContent =
                '';


            render();
        };


        /*
        |--------------------------------------------------------------------------
        | CSV EXPORT
        |--------------------------------------------------------------------------
        */

        const csvCell = (
            value
        ) => {
            const text =
                String(
                    value ?? ''
                );


            return `"${text.replace(
                /"/g,
                '""'
            )}"`;
        };


        const exportCsv = () => {
            if (
                filtered.length ===
                    0
                ||
                !error.hidden
            ) {
                return;
            }


            const headers = [
                'Event ID',
                'Date',
                'Time',
                'Module',
                'Activity',
                'Details',
                'Reference',
                'Recorded By',
                'Role'
            ];


            const data =
                filtered.map(
                    (record) => [
                        record.id,
                        record.at.slice(
                            0,
                            10
                        ),
                        record.at.slice(
                            11,
                            19
                        ),
                        modules[
                            record.module
                        ],
                        record.action,
                        record.detail,
                        record.reference,
                        record.actor,
                        record.role
                    ]
                );


            const csv =
                [
                    headers,
                    ...data
                ]
                    .map(
                        (row) =>
                            row
                                .map(
                                    csvCell
                                )
                                .join(
                                    ','
                                )
                    )
                    .join(
                        '\r\n'
                    );


            const blob =
                new Blob(
                    [
                        '\uFEFF',
                        csv
                    ],
                    {
                        type:
                            'text/csv;charset=utf-8;'
                    }
                );


            const url =
                URL.createObjectURL(
                    blob
                );


            const link =
                document.createElement(
                    'a'
                );


            link.href =
                url;


            link.download =
                `pulso-activity-history-${moduleFilter.value || 'all'}-${from.value || 'start'}-to-${to.value || 'end'}.csv`;


            document.body.appendChild(
                link
            );


            link.click();


            link.remove();


            window.setTimeout(
                () => {
                    URL.revokeObjectURL(
                        url
                    );
                },
                1000
            );


            feedback.textContent =
                `CSV prepared with ${filtered.length} matching ${filtered.length === 1 ? 'record' : 'records'}.`;
        };


        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        search.addEventListener(
            'input',
            applyFilters
        );


        moduleFilter.addEventListener(
            'change',
            applyFilters
        );


        from.addEventListener(
            'input',
            applyFilters
        );


        to.addEventListener(
            'input',
            applyFilters
        );


        find(
            'ah-filter-form'
        ).addEventListener(
            'submit',
            (event) => {
                event.preventDefault();

                applyFilters();
            }
        );


        find(
            'ah-reset'
        ).addEventListener(
            'click',
            () => {
                search.value =
                    '';


                moduleFilter.value =
                    '';


                from.value =
                    '2026-09-01';


                to.value =
                    '2026-09-30';


                applyFilters();


                search.focus();
            }
        );


        page
            .querySelectorAll(
                '[data-filter-module]'
            )
            .forEach(
                (button) => {
                    button.addEventListener(
                        'click',
                        () => {
                            const key =
                                button.dataset.filterModule;


                            moduleFilter.value =
                                moduleFilter.value ===
                                    key
                                    ? ''
                                    : key;


                            applyFilters();
                        }
                    );
                }
            );


        previous.addEventListener(
            'click',
            () => {
                if (
                    currentPage >
                    1
                ) {
                    currentPage -=
                        1;


                    render();
                }
            }
        );


        next.addEventListener(
            'click',
            () => {
                if (
                    currentPage
                    *
                    pageSize
                    <
                    filtered.length
                ) {
                    currentPage +=
                        1;


                    render();
                }
            }
        );


        exportButton.addEventListener(
            'click',
            exportCsv
        );


        printButton.addEventListener(
            'click',
            () => {
                if (
                    filtered.length ===
                        0
                    ||
                    !error.hidden
                ) {
                    return;
                }


                updatePrintContext();


                window.print();
            }
        );


        window.addEventListener(
            'beforeprint',
            updatePrintContext
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
            initializeActivityHistory,
            {
                once: true
            }
        );
    } else {
        initializeActivityHistory();
    }
})();
</script>
@endpush