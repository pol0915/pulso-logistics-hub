@props([
    'mode' => 'create',
    'asset' => [],
])

@php
    $isEdit = $mode === 'edit';

    $value = function ($key, $default = '') use ($asset) {
        return $asset[$key] ?? $default;
    };

    $categories = [
        'Audio',
        'Electrical',
        'Equipment',
        'Event Materials',
        'Furniture',
        'Storage',
        'Tools',
    ];

    $locations = [
        'Main Storage',
        'Equipment Cabinet',
        'Equipment Shelf A',
        'Equipment Shelf B',
        'Electrical Cabinet',
        'Tool Cabinet',
        'Banner Storage',
    ];

    $conditions = [
        'Excellent',
        'Good',
        'Fair',
        'Poor',
        'Damaged',
    ];

    $statuses = [
        'Available',
        'Borrowed',
        'Deployed',
        'Maintenance',
        'Damaged',
    ];

    $cancelUrl = $isEdit
        ? route('inventory.show')
        : route('inventory.index');

    $existingPhoto = $value('photo');
@endphp


@once
<style>
    /* ================================================================
       ASSET FORM COMPONENT
       ================================================================ */

    .asset-editor {
        --ae-navy: #10263d;
        --ae-copy: #496580;
        --ae-muted: #71899c;
        --ae-teal: #007780;
        --ae-pink: #b90c61;
        --ae-blue: #365f8d;
        --ae-green: #2b735d;
        --ae-line: #d5e5ee;

        width: 100%;
        min-width: 0;

        color: var(--ae-navy);

        container-name: asset-editor;
        container-type: inline-size;
    }


    .asset-editor *,
    .asset-editor *::before,
    .asset-editor *::after {
        box-sizing: border-box;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .asset-editor .ae-icon {
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
       CONTENT
       ================================================================ */

    .asset-editor .ae-content {
        display: grid;

        gap: 20px;

        min-width: 0;
    }


    /* ================================================================
       EDIT MODE
       ================================================================ */

    .asset-editor .ae-mode-strip {
        display: flex;
        align-items: center;

        gap: 13px;

        min-width: 0;

        padding:
            13px
            15px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 16px;

        background:
            linear-gradient(
                145deg,
                #e5f8f9,
                #d2edf0
            );

        color: #31546d;

        box-shadow:
            4px 5px 11px rgba(72, 111, 132, .08),
            -3px -3px 8px rgba(255, 255, 255, .74),
            inset 1px 1px 2px rgba(255, 255, 255, .88);
    }


    .asset-editor .ae-mode-strip-icon {
        display: grid;
        place-items: center;

        width: 42px;
        height: 42px;

        flex: 0 0 42px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e3f8f9,
                #ccecef
            );

        color: #007780;

        box-shadow:
            3px 4px 9px rgba(64, 103, 124, .10),
            -2px -2px 7px rgba(255, 255, 255, .76),
            inset 1px 1px 2px rgba(255, 255, 255, .88);
    }


    .asset-editor .ae-mode-strip-icon .ae-icon {
        width: 19px;
        height: 19px;
    }


    .asset-editor .ae-mode-strip-copy {
        min-width: 0;
    }


    .asset-editor .ae-mode-strip-copy strong {
        display: block;

        overflow: hidden;

        color: #20475e;

        font-size: 12px;
        font-weight: 780;
        line-height: 1.45;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .asset-editor .ae-mode-strip-copy span {
        display: block;

        margin-top: 2px;

        color: #607c90;

        font-size: 10.5px;
        line-height: 1.45;
    }


    /* ================================================================
       CARD
       ================================================================ */

    .asset-editor .ae-card {
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


    .asset-editor .ae-card::after {
        position: absolute;

        top: 0;
        right: 24px;

        width: 42px;
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

        opacity: .56;

        content: "";

        pointer-events: none;
    }


    /* ================================================================
       CARD HEADING
       ================================================================ */

    .asset-editor .ae-card-heading {
        display: flex;
        align-items: flex-start;

        gap: 13px;

        min-width: 0;

        padding:
            19px
            21px
            17px;

        border-bottom:
            1px
            solid
            var(--ae-line);

        background:
            linear-gradient(
                180deg,
                rgba(244, 251, 253, .55),
                rgba(233, 243, 248, .18)
            );
    }


    .asset-editor .ae-card-heading-copy {
        min-width: 0;
    }


    .asset-editor .ae-step {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e1f8f9,
                #c9ebee
            );

        color: var(--ae-teal);

        box-shadow:
            3px 4px 8px rgba(74, 116, 136, .11),
            -2px -2px 6px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .9);

        font-size: 11px;
        font-weight: 850;
        line-height: 1;
    }


    .asset-editor .ae-step-pink {
        background:
            linear-gradient(
                145deg,
                #fff0f7,
                #f4d2e3
            );

        color: var(--ae-pink);
    }


    .asset-editor .ae-step-blue {
        background:
            linear-gradient(
                145deg,
                #eff6fc,
                #d7e6f3
            );

        color: var(--ae-blue);
    }


    .asset-editor .ae-card-heading h2 {
        margin: 0;

        color: #18344c;

        font-size: 16px;
        font-weight: 800;
        line-height: 1.4;

        letter-spacing: -.025em;
    }


    .asset-editor .ae-card-heading p {
        margin:
            4px
            0
            0;

        color: var(--ae-copy);

        font-size: 11px;
        line-height: 1.55;
    }


    /* ================================================================
       BASIC INFORMATION LAYOUT
       ================================================================ */

    .asset-editor .ae-basic-layout {
        display: grid;

        grid-template-columns:
            minmax(0, 1.55fr)
            minmax(250px, .8fr);

        align-items: stretch;

        gap: 22px;

        padding: 21px;
    }


    /* ================================================================
       FIELDS
       ================================================================ */

    .asset-editor .ae-fields {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        align-content: start;

        gap:
            17px
            15px;

        min-width: 0;
    }


    .asset-editor .ae-field {
        min-width: 0;
    }


    .asset-editor .ae-full {
        grid-column:
            1
            / -1;
    }


    .asset-editor .ae-section-body {
        padding: 21px;
    }


    /* ================================================================
       LABELS
       ================================================================ */

    .asset-editor .ae-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 7px;
    }


    .asset-editor .ae-label {
        display: block;

        margin-bottom: 7px;

        color: #294960;

        font-size: 11px;
        font-weight: 750;
        line-height: 1.45;
    }


    .asset-editor .ae-label-row .ae-label {
        margin-bottom: 0;
    }


    .asset-editor .ae-required {
        margin-left: 2px;

        color: var(--ae-pink);

        font-weight: 800;
    }


    .asset-editor .ae-optional {
        margin-left: 5px;

        color: #71899c;

        font-size: 9px;
        font-weight: 550;
    }


    .asset-editor .ae-field-badge {
        display: inline-flex;
        align-items: center;

        min-height: 22px;

        padding:
            3px
            7px;

        border:
            1px
            solid
            rgba(255, 255, 255, .74);

        border-radius: 7px;

        background:
            linear-gradient(
                145deg,
                #e8f7f8,
                #d7eef0
            );

        color: #007780;

        font-size: 8.5px;
        font-weight: 750;
        line-height: 1.3;

        white-space: nowrap;
    }


    /* ================================================================
       INPUTS
       ================================================================ */

    .asset-editor .ae-input {
        display: block;

        width: 100%;
        min-width: 0;
        min-height: 44px;

        padding:
            9px
            12px;

        border:
            1px
            solid
            #cfdfe8;

        border-radius: 13px;

        outline: 0;

        background:
            linear-gradient(
                145deg,
                #e8f1f6,
                #edf5f9
            );

        color: var(--ae-navy);

        box-shadow:
            inset 3px 3px 7px rgba(93, 126, 148, .15),
            inset -3px -3px 7px rgba(255, 255, 255, .92);

        font: inherit;
        font-size: 11.5px;
        line-height: 1.5;

        transition:
            border-color 160ms ease,
            background 160ms ease,
            box-shadow 160ms ease;
    }


    .asset-editor select.ae-input {
        padding-right: 36px;

        cursor: pointer;
    }


    .asset-editor textarea.ae-input {
        min-height: 100px;

        resize: vertical;
    }


    .asset-editor .ae-input::placeholder {
        color: #7a91a2;

        opacity: 1;
    }


    .asset-editor .ae-input:hover:not(:disabled):not([readonly]) {
        border-color: #bfd7e2;
    }


    .asset-editor .ae-input:focus {
        border-color:
            rgba(
                0,
                126,
                137,
                .5
            );

        background: #edf7fa;

        box-shadow:
            inset 3px 3px 7px rgba(93, 126, 148, .13),
            inset -3px -3px 7px rgba(255, 255, 255, .92),
            0 0 0 3px rgba(5, 173, 182, .1);
    }


    .asset-editor .ae-input[readonly] {
        border-style: dashed;
        border-color: #c8dbe5;

        background:
            linear-gradient(
                145deg,
                #e4edf2,
                #e9f2f6
            );

        color: #627b8e;

        box-shadow:
            inset 2px 2px 5px rgba(91, 122, 142, .1),
            inset -2px -2px 5px rgba(255, 255, 255, .64);

        cursor: default;
    }


    .asset-editor .ae-input[aria-invalid="true"] {
        border-color:
            rgba(
                185,
                12,
                97,
                .5
            );

        box-shadow:
            inset 3px 3px 7px rgba(93, 126, 148, .13),
            inset -3px -3px 7px rgba(255, 255, 255, .92),
            0 0 0 3px rgba(185, 12, 97, .08);
    }


    /* ================================================================
       HELP TEXT
       ================================================================ */

    .asset-editor .ae-help {
        margin:
            7px
            0
            0;

        color: #70889a;

        font-size: 9.5px;
        line-height: 1.55;
    }


    .asset-editor .ae-help strong {
        color: #415f75;

        font-weight: 700;
    }


    /* ================================================================
       PHOTO AREA
       ================================================================ */

    .asset-editor .ae-photo {
        min-width: 0;

        padding-left: 21px;

        border-left:
            1px
            solid
            var(--ae-line);
    }


    .asset-editor .ae-photo-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 9px;
    }


    .asset-editor .ae-photo-heading .ae-label {
        margin: 0;
    }


    .asset-editor .ae-photo-stage {
        position: relative;

        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        min-height: 220px;

        overflow: hidden;

        border:
            1px
            dashed
            #9bbdc9;

        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                #e3edf3,
                #f0f7fa
            );

        box-shadow:
            inset 4px 4px 10px rgba(86, 119, 140, .14),
            inset -4px -4px 10px rgba(255, 255, 255, .92);
    }


    .asset-editor .ae-photo-stage::after {
        position: absolute;

        inset: 9px;

        border:
            1px
            solid
            rgba(255, 255, 255, .48);

        border-radius: 12px;

        content: "";

        pointer-events: none;
    }


    .asset-editor .ae-photo-preview {
        position: relative;
        z-index: 2;

        display: block;

        width: 100%;
        height: 220px;

        object-fit: contain;

        background:
            rgba(
                244,
                250,
                252,
                .9
            );
    }


    .asset-editor .ae-photo-preview.hidden {
        display: none !important;
    }


    /* ================================================================
       PHOTO PLACEHOLDER
       ================================================================ */

    .asset-editor .ae-photo-placeholder {
        position: relative;
        z-index: 1;

        width: 100%;

        padding:
            24px
            18px;

        color: #607b90;

        text-align: center;
    }


    .asset-editor .ae-photo-placeholder.hidden {
        display: none !important;
    }


    .asset-editor .ae-photo-icon {
        display: grid;
        place-items: center;

        width: 54px;
        height: 54px;

        margin:
            0
            auto
            13px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 17px;

        background:
            linear-gradient(
                145deg,
                #e5fbfc,
                #c9edef
            );

        color: #007d86;

        box-shadow:
            4px 5px 10px rgba(78, 116, 136, .12),
            -3px -3px 8px rgba(255, 255, 255, .78),
            inset 1px 1px 2px rgba(255, 255, 255, .88);
    }


    .asset-editor .ae-photo-icon .ae-icon {
        width: 23px;
        height: 23px;
    }


    .asset-editor .ae-photo-placeholder strong {
        display: block;

        color: #31546d;

        font-size: 12px;
        font-weight: 750;
        line-height: 1.45;
    }


    .asset-editor .ae-photo-placeholder p {
        max-width: 190px;

        margin:
            4px
            auto
            0;

        color: #71899c;

        font-size: 10px;
        line-height: 1.5;
    }


    /* ================================================================
       FILE INPUT
       ================================================================ */

    .asset-editor .ae-file-wrap {
        margin-top: 13px;
    }


    .asset-editor .ae-file {
        display: block;

        width: 100%;
        min-width: 0;

        margin: 0;

        color: #60798d;

        font: inherit;
        font-size: 10px;
        line-height: 1.5;
    }


    .asset-editor .ae-file::file-selector-button {
        min-height: 38px;

        margin-right: 9px;

        padding:
            8px
            12px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #f4fbfd,
                #dfedf3
            );

        color: #007780;

        box-shadow:
            3px 4px 8px rgba(81, 115, 136, .1),
            -2px -2px 6px rgba(255, 255, 255, .74);

        font: inherit;
        font-size: 10px;
        font-weight: 750;

        cursor: pointer;

        transition:
            background 150ms ease,
            transform 150ms ease;
    }


    .asset-editor .ae-file::file-selector-button:hover {
        background:
            linear-gradient(
                145deg,
                #e8f8f9,
                #d1eaee
            );

        transform: translateY(-1px);
    }


    /* ================================================================
       PAIRED SECTIONS
       ================================================================ */

    .asset-editor .ae-paired-sections {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        align-items: stretch;

        gap: 20px;
    }


    .asset-editor .ae-paired-sections > .ae-card {
        height: 100%;
    }


    /* ================================================================
       MONEY
       ================================================================ */

    .asset-editor .ae-money {
        position: relative;
    }


    .asset-editor .ae-money > span {
        position: absolute;

        top: 50%;
        left: 13px;
        z-index: 1;

        color: #587389;

        font-size: 12px;
        font-weight: 700;

        pointer-events: none;

        transform: translateY(-50%);
    }


    .asset-editor .ae-money .ae-input {
        padding-left: 31px;
    }


    /* ================================================================
       INFO NOTE
       ================================================================ */

    .asset-editor .ae-info-note {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        margin-top: 13px;

        padding:
            10px
            11px;

        border:
            1px
            solid
            rgba(255, 255, 255, .86);

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e7f5f7,
                #dbeef1
            );

        color: #547286;

        box-shadow:
            inset 2px 2px 5px rgba(75, 112, 133, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .67);

        font-size: 9.5px;
        line-height: 1.55;
    }


    .asset-editor .ae-info-note .ae-icon {
        width: 15px;
        height: 15px;

        flex: 0 0 15px;

        margin-top: 1px;

        color: #007780;
    }


    /* ================================================================
       NOTES
       ================================================================ */

    .asset-editor .ae-notes-body {
        padding: 21px;
    }


    .asset-editor .ae-notes-body textarea {
        min-height: 110px;
    }


    /* ================================================================
       FOOTER
       ================================================================ */

    .asset-editor .ae-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        min-width: 0;

        padding:
            16px
            18px;

        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                rgba(246, 252, 254, .96),
                rgba(228, 240, 246, .95)
            );

        box-shadow:
            5px 6px 14px rgba(90, 125, 147, .12),
            -4px -4px 10px rgba(255, 255, 255, .8),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }


    .asset-editor .ae-footer-copy {
        min-width: 0;
    }


    .asset-editor .ae-footer-copy p {
        margin: 0;

        color: var(--ae-copy);

        font-size: 10px;
        line-height: 1.55;
    }


    .asset-editor .ae-footer-copy p + p {
        margin-top: 3px;

        color: #748b9d;

        font-size: 9.5px;
    }


    /* ================================================================
       ACTIONS
       ================================================================ */

    .asset-editor .ae-actions {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-shrink: 0;
    }


    .asset-editor .ae-cancel,
    .asset-editor .ae-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding:
            9px
            16px;

        border-radius: 13px;

        font: inherit;
        font-size: 11px;
        font-weight: 750;
        line-height: 1.4;

        text-align: center;
        text-decoration: none;

        cursor: pointer;

        transition:
            color 160ms ease,
            background 160ms ease,
            box-shadow 160ms ease,
            transform 160ms ease;
    }


    .asset-editor .ae-cancel {
        border:
            1px
            solid
            rgba(255, 255, 255, .96);

        background:
            linear-gradient(
                145deg,
                #f5fafc,
                #e4eef3
            );

        color: #31546d;

        box-shadow:
            4px 5px 10px rgba(81, 115, 137, .11),
            -3px -3px 8px rgba(255, 255, 255, .8),
            inset 1px 1px 2px rgba(255, 255, 255, .9);
    }


    .asset-editor .ae-cancel:hover {
        background:
            linear-gradient(
                145deg,
                #fbfdff,
                #dcebf1
            );

        color: #007780;

        transform: translateY(-1px);
    }


    .asset-editor .ae-submit {
        border:
            1px
            solid
            #bff8fa;

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


    .asset-editor .ae-submit:hover {
        background:
            linear-gradient(
                145deg,
                #007b85,
                #006a74
            );

        transform: translateY(-1px);
    }


    .asset-editor .ae-submit .ae-icon {
        width: 17px;
        height: 17px;
    }


    /* ================================================================
       FEEDBACK
       ================================================================ */

    .asset-editor .ae-feedback {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        padding:
            11px
            13px;

        border:
            1px
            solid
            #b9ddd2;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e8f6f0,
                #d9eee6
            );

        color: #2b735d;

        font-size: 10px;
        font-weight: 700;
        line-height: 1.55;
    }


    .asset-editor .ae-feedback[hidden] {
        display: none !important;
    }


    .asset-editor .ae-feedback .ae-icon {
        width: 16px;
        height: 16px;

        margin-top: 1px;

        flex: 0 0 16px;
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container asset-editor (max-width: 840px) {
        .asset-editor .ae-basic-layout {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .asset-editor .ae-photo {
            padding:
                20px
                0
                0;

            border-top:
                1px
                solid
                var(--ae-line);

            border-left: 0;
        }


        .asset-editor .ae-photo-stage {
            max-width: 440px;
        }
    }


    @container asset-editor (max-width: 720px) {
        .asset-editor .ae-paired-sections {
            grid-template-columns:
                minmax(0, 1fr);
        }


        .asset-editor .ae-footer {
            align-items: flex-start;
            flex-direction: column;

            gap: 15px;
        }


        .asset-editor .ae-actions {
            align-self: flex-end;
        }
    }


    @container asset-editor (max-width: 520px) {
        .asset-editor .ae-content,
        .asset-editor .ae-paired-sections {
            gap: 17px;
        }


        .asset-editor .ae-card {
            border-radius: 19px;
        }


        .asset-editor .ae-card-heading {
            padding:
                17px
                16px
                15px;
        }


        .asset-editor .ae-step {
            width: 35px;
            height: 35px;

            flex-basis: 35px;
        }


        .asset-editor .ae-basic-layout,
        .asset-editor .ae-section-body,
        .asset-editor .ae-notes-body {
            padding:
                17px
                16px;
        }


        .asset-editor .ae-fields {
            grid-template-columns:
                minmax(0, 1fr);

            gap: 15px;
        }


        .asset-editor .ae-full {
            grid-column: auto;
        }


        .asset-editor .ae-photo-stage {
            min-height: 190px;
        }


        .asset-editor .ae-photo-preview {
            height: 190px;
        }


        .asset-editor .ae-footer {
            padding: 16px;
        }


        .asset-editor .ae-actions {
            display: grid;

            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            width: 100%;
        }


        .asset-editor .ae-cancel,
        .asset-editor .ae-submit {
            width: 100%;
        }
    }


    @container asset-editor (max-width: 360px) {
        .asset-editor .ae-actions {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .asset-editor .ae-file::file-selector-button,
        .asset-editor .ae-cancel,
        .asset-editor .ae-submit {
            transition: none;
        }


        .asset-editor .ae-file::file-selector-button:hover,
        .asset-editor .ae-cancel:hover,
        .asset-editor .ae-submit:hover {
            transform: none;
        }
    }
</style>
@endonce


<form
    id="asset-form"
    class="asset-editor"
    data-form-mode="{{ $mode }}"
>
    <div class="ae-content">

        {{-- =========================================================
             EDIT MODE
             ========================================================= --}}

        @if ($isEdit)
            <div
                class="ae-mode-strip"
                role="status"
            >
                <span
                    class="ae-mode-strip-icon"
                    aria-hidden="true"
                >
                    <svg
                        class="ae-icon"
                        viewBox="0 0 24 24"
                    >
                        <path d="M13.5 6.5 17.5 10.5"/>

                        <path d="M4 20l3.8-.9L19 7.9a2.8 2.8 0 0 0-4-4L3.9 15 3 19.1A.8.8 0 0 0 4 20Z"/>
                    </svg>
                </span>


                <div class="ae-mode-strip-copy">
                    <strong>
                        Editing {{ $value('name', 'asset') }}
                    </strong>

                    <span>
                        Asset ID:
                        {{ $value('id', 'Not assigned') }}
                    </span>
                </div>
            </div>
        @endif


        {{-- =========================================================
             01 ASSET INFORMATION
             ========================================================= --}}

        <section
            class="ae-card"
            aria-labelledby="ae-basic-title"
        >
            <div class="ae-card-heading">

                <span
                    class="ae-step"
                    aria-hidden="true"
                >
                    01
                </span>


                <div class="ae-card-heading-copy">

                    <h2 id="ae-basic-title">
                        Asset information
                    </h2>

                    <p>
                        Add the main identification details and a clear
                        reference photo.
                    </p>

                </div>

            </div>


            <div class="ae-basic-layout">

                <div class="ae-fields">

                    {{-- ASSET NAME --}}
                    <div class="ae-field ae-full">

                        <label
                            for="asset-name"
                            class="ae-label"
                        >
                            Asset name

                            <span
                                class="ae-required"
                                aria-hidden="true"
                            >
                                *
                            </span>
                        </label>


                        <input
                            id="asset-name"
                            name="asset_name"
                            class="ae-input"
                            type="text"
                            value="{{ $value('name') }}"
                            placeholder="e.g. Portable Sound System"
                            autocomplete="off"
                            required
                        >


                        <p class="ae-help">
                            Use the common name logistics staff will
                            recognize quickly.
                        </p>

                    </div>


                    {{-- CATEGORY --}}
                    <div class="ae-field">

                        <label
                            for="asset-category"
                            class="ae-label"
                        >
                            Category

                            <span
                                class="ae-required"
                                aria-hidden="true"
                            >
                                *
                            </span>
                        </label>


                        <select
                            id="asset-category"
                            name="asset_category"
                            class="ae-input"
                            required
                        >
                            <option value="">
                                Select category
                            </option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category }}"
                                    @selected(
                                        $value('category')
                                        ===
                                        $category
                                    )
                                >
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>

                    </div>


                    {{-- QUANTITY --}}
                    <div class="ae-field">

                        <label
                            for="asset-quantity"
                            class="ae-label"
                        >
                            Total quantity

                            <span
                                class="ae-required"
                                aria-hidden="true"
                            >
                                *
                            </span>
                        </label>


                        <input
                            id="asset-quantity"
                            name="asset_quantity"
                            class="ae-input"
                            type="number"
                            min="1"
                            step="1"
                            value="{{ $value('quantity', 1) }}"
                            required
                        >

                    </div>


                    {{-- ASSET ID --}}
                    <div class="ae-field ae-full">

                        <div class="ae-label-row">

                            <label
                                for="asset-id"
                                class="ae-label"
                            >
                                Asset ID
                            </label>


                            <span class="ae-field-badge">
                                System-managed
                            </span>

                        </div>


                        <input
                            id="asset-id"
                            name="asset_id"
                            class="ae-input"
                            type="text"
                            value="{{ $value('id') }}"
                            placeholder="Assigned when the asset is registered"
                            readonly
                        >


                        @if (!$isEdit)
                            <div class="ae-info-note">

                                <svg
                                    class="ae-icon"
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
                                    The asset ID will be assigned when
                                    the record is registered.
                                </span>

                            </div>
                        @endif

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="ae-field ae-full">

                        <label
                            for="asset-description"
                            class="ae-label"
                        >
                            Description

                            <span class="ae-optional">
                                Optional
                            </span>
                        </label>


                        <textarea
                            id="asset-description"
                            name="asset_description"
                            class="ae-input"
                            rows="3"
                            placeholder="Include brand, model, color, size, or other identifying details."
                        >{{ $value('description') }}</textarea>

                    </div>

                </div>


                {{-- =================================================
                     PHOTO
                     ================================================= --}}

                <div class="ae-photo">

                    <div class="ae-photo-heading">

                        <label
                            for="asset-photo"
                            class="ae-label"
                        >
                            Asset photo

                            <span class="ae-optional">
                                Optional
                            </span>
                        </label>


                        <span class="ae-field-badge">
                            Reference
                        </span>

                    </div>


                    <div class="ae-photo-stage">

                        <img
                            id="asset-photo-preview"
                            class="ae-photo-preview {{ $existingPhoto ? '' : 'hidden' }}"
                            src="{{ $existingPhoto }}"
                            alt="{{ $existingPhoto ? 'Current photo of ' . $value('name', 'asset') : '' }}"
                        >


                        <div
                            id="asset-photo-placeholder"
                            class="ae-photo-placeholder {{ $existingPhoto ? 'hidden' : '' }}"
                        >
                            <span
                                class="ae-photo-icon"
                                aria-hidden="true"
                            >
                                <svg
                                    class="ae-icon"
                                    viewBox="0 0 24 24"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="15"
                                        rx="3"
                                    />

                                    <circle
                                        cx="8"
                                        cy="10"
                                        r="1.5"
                                    />

                                    <path d="m4 18 5-5 4 4 3-3 5 5"/>
                                </svg>
                            </span>


                            <strong>
                                No photo selected
                            </strong>


                            <p>
                                Choose a clear image of the actual asset
                                for easier identification.
                            </p>

                        </div>

                    </div>


                    <div class="ae-file-wrap">

                        <input
                            id="asset-photo"
                            name="asset_photo"
                            class="ae-file"
                            type="file"
                            accept="image/png,image/jpeg,image/webp"
                            aria-describedby="ae-photo-help"
                        >

                    </div>


                    <p
                        id="ae-photo-help"
                        class="ae-help"
                    >
                        JPG, PNG, or WEBP. A clear front or angled
                        photo is recommended.
                    </p>

                </div>

            </div>

        </section>


        {{-- =========================================================
             02 + 03
             ========================================================= --}}

        <div class="ae-paired-sections">

            {{-- STORAGE & CONDITION --}}
            <section
                class="ae-card"
                aria-labelledby="ae-storage-title"
            >
                <div class="ae-card-heading">

                    <span
                        class="ae-step ae-step-pink"
                        aria-hidden="true"
                    >
                        02
                    </span>


                    <div class="ae-card-heading-copy">

                        <h2 id="ae-storage-title">
                            Storage &amp; condition
                        </h2>

                        <p>
                            Record where the asset is kept and its
                            current operational state.
                        </p>

                    </div>

                </div>


                <div class="ae-fields ae-section-body">

                    {{-- STORAGE LOCATION --}}
                    <div class="ae-field ae-full">

                        <label
                            for="asset-location"
                            class="ae-label"
                        >
                            Storage location

                            <span
                                class="ae-required"
                                aria-hidden="true"
                            >
                                *
                            </span>
                        </label>


                        <select
                            id="asset-location"
                            name="asset_location"
                            class="ae-input"
                            required
                        >
                            <option value="">
                                Select location
                            </option>

                            @foreach ($locations as $location)
                                <option
                                    value="{{ $location }}"
                                    @selected(
                                        $value('location')
                                        ===
                                        $location
                                    )
                                >
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>


                        <p class="ae-help">
                            Choose the usual storage area when the
                            asset is not deployed.
                        </p>

                    </div>


                    {{-- CONDITION --}}
                    <div class="ae-field">

                        <label
                            for="asset-condition"
                            class="ae-label"
                        >
                            Condition

                            <span
                                class="ae-required"
                                aria-hidden="true"
                            >
                                *
                            </span>
                        </label>


                        <select
                            id="asset-condition"
                            name="asset_condition"
                            class="ae-input"
                            required
                        >
                            @foreach ($conditions as $condition)
                                <option
                                    value="{{ $condition }}"
                                    @selected(
                                        $value(
                                            'condition',
                                            'Good'
                                        )
                                        ===
                                        $condition
                                    )
                                >
                                    {{ $condition }}
                                </option>
                            @endforeach
                        </select>

                    </div>


                    {{-- STATUS --}}
                    <div class="ae-field">

                        <label
                            for="asset-status"
                            class="ae-label"
                        >
                            Status
                        </label>


                        <select
                            id="asset-status"
                            name="asset_status"
                            class="ae-input"
                        >
                            @foreach ($statuses as $status)
                                <option
                                    value="{{ $status }}"
                                    @selected(
                                        $value(
                                            'status',
                                            'Available'
                                        )
                                        ===
                                        $status
                                    )
                                >
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>

                    </div>


                    <div class="ae-field ae-full">

                        <div class="ae-info-note">

                            <svg
                                class="ae-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M14.7 6.3a4 4 0 0 0-5-5L7 4l3 3-6.7 6.7a2.1 2.1 0 0 0 3 3L13 10a4 4 0 0 0 5-5Z"/>

                                <path d="m13 13 6 6"/>
                            </svg>


                            <span>
                                Update condition and status whenever the
                                asset is returned, damaged, repaired, or
                                redeployed.
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ACQUISITION --}}
            <section
                class="ae-card"
                aria-labelledby="ae-acquisition-title"
            >
                <div class="ae-card-heading">

                    <span
                        class="ae-step ae-step-blue"
                        aria-hidden="true"
                    >
                        03
                    </span>


                    <div class="ae-card-heading-copy">

                        <h2 id="ae-acquisition-title">
                            Acquisition details
                        </h2>

                        <p>
                            Optional record of when, where, and how the
                            asset was obtained.
                        </p>

                    </div>

                </div>


                <div class="ae-fields ae-section-body">

                    {{-- SOURCE --}}
                    <div class="ae-field ae-full">

                        <label
                            for="acquisition-source"
                            class="ae-label"
                        >
                            Acquisition source

                            <span class="ae-optional">
                                Optional
                            </span>
                        </label>


                        <input
                            id="acquisition-source"
                            name="acquisition_source"
                            class="ae-input"
                            type="text"
                            value="{{ $value('source') }}"
                            placeholder="e.g. Purchased, Donation, Sponsorship"
                            autocomplete="off"
                        >

                    </div>


                    {{-- DATE --}}
                    <div class="ae-field">

                        <label
                            for="asset-date-acquired"
                            class="ae-label"
                        >
                            Date acquired
                        </label>


                        <input
                            id="asset-date-acquired"
                            name="asset_date_acquired"
                            class="ae-input"
                            type="date"
                            value="{{ $value('date_acquired') }}"
                        >

                    </div>


                    {{-- VALUE --}}
                    <div class="ae-field">

                        <label
                            for="estimated-value"
                            class="ae-label"
                        >
                            Estimated value
                        </label>


                        <div class="ae-money">

                            <span aria-hidden="true">
                                ₱
                            </span>


                            <input
                                id="estimated-value"
                                name="estimated_value"
                                class="ae-input"
                                type="number"
                                min="0"
                                step="0.01"
                                value="{{ $value('estimated_value') }}"
                                placeholder="0.00"
                                inputmode="decimal"
                            >

                        </div>

                    </div>


                    <div class="ae-field ae-full">

                        <div class="ae-info-note">

                            <svg
                                class="ae-icon"
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
                                Estimated value is kept only as an
                                internal inventory reference in this
                                front-end preview.
                            </span>

                        </div>

                    </div>

                </div>

            </section>

        </div>


        {{-- =========================================================
             04 NOTES
             ========================================================= --}}

        <section
            class="ae-card"
            aria-labelledby="ae-notes-title"
        >
            <div class="ae-card-heading">

                <span
                    class="ae-step ae-step-pink"
                    aria-hidden="true"
                >
                    04
                </span>


                <div class="ae-card-heading-copy">

                    <h2 id="ae-notes-title">
                        Internal notes
                    </h2>

                    <p>
                        Add handling instructions or reminders that may
                        help the logistics team.
                    </p>

                </div>

            </div>


            <div class="ae-notes-body">

                <label
                    for="asset-notes"
                    class="ae-label"
                >
                    Notes

                    <span class="ae-optional">
                        Optional
                    </span>
                </label>


                <textarea
                    id="asset-notes"
                    name="asset_notes"
                    class="ae-input"
                    rows="4"
                    placeholder="e.g. Keep the charger and carrying case with the unit. Inspect cables before deployment."
                >{{ $value('notes') }}</textarea>


                <p class="ae-help">
                    Keep notes concise and focused on storage,
                    handling, maintenance, or deployment reminders.
                </p>

            </div>

        </section>


        {{-- =========================================================
             FOOTER
             ========================================================= --}}

        <footer class="ae-footer">

            <div class="ae-footer-copy">

                <p>
                    Fields marked

                    <span
                        class="ae-required"
                        aria-hidden="true"
                    >
                        *
                    </span>

                    are required.
                </p>


                <p>
                    Preview only. Changes are not saved to a database yet.
                </p>

            </div>


            <div class="ae-actions">

                <a
                    href="{{ $cancelUrl }}"
                    class="ae-cancel"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="ae-submit"
                >
                    @if ($isEdit)

                        <svg
                            class="ae-icon"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path d="M5 3h11l3 3v15H5V3Z"/>
                            <path d="M8 3v6h8V3"/>
                            <path d="M8 21v-7h8v7"/>
                        </svg>


                        <span>
                            Save changes
                        </span>

                    @else

                        <svg
                            class="ae-icon"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>


                        <span>
                            Add asset
                        </span>

                    @endif
                </button>

            </div>

        </footer>


        <div
            class="ae-feedback"
            id="asset-form-feedback"
            role="status"
            aria-live="polite"
            hidden
        >
            <svg
                class="ae-icon"
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


            <span id="asset-form-feedback-text"></span>
        </div>

    </div>
</form>


@once
@push('scripts')
<script>
(() => {
    const initializeAssetForm = () => {
        const form =
            document.getElementById(
                'asset-form'
            );


        if (
            !form ||
            form.dataset.initialized ===
                'true'
        ) {
            return;
        }


        form.dataset.initialized =
            'true';


        const photoInput =
            form.querySelector(
                '#asset-photo'
            );


        const photoPreview =
            form.querySelector(
                '#asset-photo-preview'
            );


        const photoPlaceholder =
            form.querySelector(
                '#asset-photo-placeholder'
            );


        const feedback =
            form.querySelector(
                '#asset-form-feedback'
            );


        const feedbackText =
            form.querySelector(
                '#asset-form-feedback-text'
            );


        /*
        |--------------------------------------------------------------------------
        | PHOTO PREVIEW
        |--------------------------------------------------------------------------
        */

        photoInput?.addEventListener(
            'change',
            () => {
                const file =
                    photoInput.files?.[0];


                if (!file) {
                    return;
                }


                if (
                    ![
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ].includes(
                        file.type
                    )
                ) {
                    photoInput.value =
                        '';


                    return;
                }


                const reader =
                    new FileReader();


                reader.addEventListener(
                    'load',
                    () => {
                        if (
                            !photoPreview ||
                            !photoPlaceholder
                        ) {
                            return;
                        }


                        photoPreview.src =
                            String(
                                reader.result
                            );


                        photoPreview.alt =
                            'Selected asset photo preview';


                        photoPreview.classList.remove(
                            'hidden'
                        );


                        photoPlaceholder.classList.add(
                            'hidden'
                        );
                    },
                    {
                        once: true
                    }
                );


                reader.readAsDataURL(
                    file
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | FRONT-END PREVIEW SUBMISSION
        |--------------------------------------------------------------------------
        */

        form.addEventListener(
            'submit',
            (event) => {
                event.preventDefault();


                if (
                    !form.checkValidity()
                ) {
                    form.reportValidity();

                    return;
                }


                const mode =
                    form.dataset.formMode;


                if (
                    feedback &&
                    feedbackText
                ) {
                    feedbackText.textContent =
                        mode === 'edit'
                            ? 'Changes passed the form checks. This is still a front-end preview, so the record was not saved to the database.'
                            : 'Asset details passed the form checks. This is still a front-end preview, so no new asset was saved to the database.';


                    feedback.hidden =
                        false;


                    feedback.scrollIntoView({
                        behavior:
                            window.matchMedia(
                                '(prefers-reduced-motion: reduce)'
                            ).matches
                                ? 'auto'
                                : 'smooth',
                        block: 'nearest'
                    });
                }
            }
        );
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeAssetForm,
            {
                once: true
            }
        );
    } else {
        initializeAssetForm();
    }
})();
</script>
@endpush
@endonce