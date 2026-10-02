@extends('layouts.app')

@section('title', 'Donation Details | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | DONATION RECORDS
    |--------------------------------------------------------------------------
    */

    $donationRecords = [

        /*
        |--------------------------------------------------------------------------
        | DON-2026-0011
        |--------------------------------------------------------------------------
        */

        'DON-2026-0011' => [
            'donation' => [
                'id' => 'DON-2026-0011',

                'donor' => 'Community Partners Association',
                'donor_type' => 'Organization',

                'contact_person' => 'Andrea Villanueva',
                'contact_number' => '0917 245 7812',
                'email' => 'communitypartners@example.com',

                'item' => 'Monoblock Chairs',
                'category' => 'Furniture',
                'quantity' => 20,
                'condition' => 'Good',

                'date_received' => 'September 9, 2026',
                'time_received' => '10:25 AM',
                'received_by' => 'Paul Roldan',

                'status' => 'Verified',
                'allocation' => 'Unallocated',

                'purpose' => 'For community events, outreach programs, and other PULSO-supported activities.',

                'notes' => 'Twenty monoblock chairs were received in good condition. Minor surface scratches were observed on three units but all items remain fully usable.',
            ],

            'verification' => [
                'available' => true,
                'verified_by' => 'Paul Roldan',
                'verified_date' => 'September 9, 2026',
                'verified_time' => '2:10 PM',
                'quantity' => 20,
                'condition' => 'Good',
                'result' => 'Accepted',
                'notes' => 'All 20 chairs were inspected and accepted for logistics use.',
            ],

            'timeline' => [
                [
                    'title' => 'Donation received',
                    'description' => 'Donation record was created and the chairs were received by the Logistics Head.',
                    'date' => 'Sep 9, 2026',
                    'time' => '10:25 AM',
                    'tone' => 'teal',
                    'icon' => 'receive',
                ],
                [
                    'title' => 'Resource inspected',
                    'description' => 'Quantity and physical condition of the donated chairs were checked.',
                    'date' => 'Sep 9, 2026',
                    'time' => '1:45 PM',
                    'tone' => 'amber',
                    'icon' => 'inspect',
                ],
                [
                    'title' => 'Donation verified',
                    'description' => 'The donated chairs were accepted and marked ready for allocation.',
                    'date' => 'Sep 9, 2026',
                    'time' => '2:10 PM',
                    'tone' => 'green',
                    'icon' => 'accepted',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | DON-2026-0010
        |--------------------------------------------------------------------------
        */

        'DON-2026-0010' => [
            'donation' => [
                'id' => 'DON-2026-0010',

                'donor' => 'Green Youth Volunteers',
                'donor_type' => 'Organization',

                'contact_person' => 'Samantha Reyes',
                'contact_number' => '0918 412 6630',
                'email' => 'greenyouth@example.com',

                'item' => 'Cleaning Tool Kits',
                'category' => 'Cleaning Supplies',
                'quantity' => 15,
                'condition' => 'Good',

                'date_received' => 'September 8, 2026',
                'time_received' => '9:40 AM',
                'received_by' => 'Paul Roldan',

                'status' => 'Allocated',
                'allocation' => 'Coastal Clean-Up Drive',

                'purpose' => 'For environmental activities and community clean-up operations.',

                'notes' => 'Fifteen complete cleaning tool kits were received. All kits were usable and contained the expected basic cleaning materials.',
            ],

            'verification' => [
                'available' => true,
                'verified_by' => 'Paul Roldan',
                'verified_date' => 'September 8, 2026',
                'verified_time' => '11:20 AM',
                'quantity' => 15,
                'condition' => 'Good',
                'result' => 'Accepted',
                'notes' => 'All donated cleaning kits passed inspection and were cleared for deployment.',
            ],

            'timeline' => [
                [
                    'title' => 'Donation received',
                    'description' => 'Fifteen cleaning tool kits were received from Green Youth Volunteers.',
                    'date' => 'Sep 8, 2026',
                    'time' => '9:40 AM',
                    'tone' => 'teal',
                    'icon' => 'receive',
                ],
                [
                    'title' => 'Resources inspected',
                    'description' => 'Each cleaning tool kit was checked for completeness and usability.',
                    'date' => 'Sep 8, 2026',
                    'time' => '10:55 AM',
                    'tone' => 'amber',
                    'icon' => 'inspect',
                ],
                [
                    'title' => 'Donation verified',
                    'description' => 'All 15 donated resource kits were accepted for logistics use.',
                    'date' => 'Sep 8, 2026',
                    'time' => '11:20 AM',
                    'tone' => 'green',
                    'icon' => 'accepted',
                ],
                [
                    'title' => 'Donation allocated',
                    'description' => 'The donated cleaning kits were assigned to the Coastal Clean-Up Drive.',
                    'date' => 'Sep 9, 2026',
                    'time' => '3:10 PM',
                    'tone' => 'blue',
                    'icon' => 'allocate',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | DON-2026-0009
        |--------------------------------------------------------------------------
        */

        'DON-2026-0009' => [
            'donation' => [
                'id' => 'DON-2026-0009',

                'donor' => 'PULSO Alumni Circle',
                'donor_type' => 'Organization',

                'contact_person' => 'Miguel Santos',
                'contact_number' => '0917 908 1442',
                'email' => 'pulsoalumni@example.com',

                'item' => 'Folding Tables',
                'category' => 'Furniture',
                'quantity' => 6,
                'condition' => 'Excellent',

                'date_received' => 'September 7, 2026',
                'time_received' => '1:15 PM',
                'received_by' => 'Paul Roldan',

                'status' => 'Added to Inventory',
                'allocation' => 'Inventory',

                'purpose' => 'Reusable logistics equipment for future PULSO programs and activities.',

                'notes' => 'Six folding tables were received in excellent condition with no structural defects observed.',
            ],

            'verification' => [
                'available' => true,
                'verified_by' => 'Paul Roldan',
                'verified_date' => 'September 7, 2026',
                'verified_time' => '2:30 PM',
                'quantity' => 6,
                'condition' => 'Excellent',
                'result' => 'Accepted',
                'notes' => 'All folding tables were inspected and approved for addition to general inventory.',
            ],

            'timeline' => [
                [
                    'title' => 'Donation received',
                    'description' => 'Six folding tables were received from the PULSO Alumni Circle.',
                    'date' => 'Sep 7, 2026',
                    'time' => '1:15 PM',
                    'tone' => 'teal',
                    'icon' => 'receive',
                ],
                [
                    'title' => 'Resources inspected',
                    'description' => 'The folding tables were checked for stability, damage, and overall condition.',
                    'date' => 'Sep 7, 2026',
                    'time' => '2:05 PM',
                    'tone' => 'amber',
                    'icon' => 'inspect',
                ],
                [
                    'title' => 'Donation verified',
                    'description' => 'All six tables were accepted as reusable logistics resources.',
                    'date' => 'Sep 7, 2026',
                    'time' => '2:30 PM',
                    'tone' => 'green',
                    'icon' => 'accepted',
                ],
                [
                    'title' => 'Added to inventory',
                    'description' => 'The donated folding tables were integrated into general logistics inventory.',
                    'date' => 'Sep 7, 2026',
                    'time' => '3:05 PM',
                    'tone' => 'green',
                    'icon' => 'inventory',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | DON-2026-0008
        |--------------------------------------------------------------------------
        */

        'DON-2026-0008' => [
            'donation' => [
                'id' => 'DON-2026-0008',

                'donor' => 'Local Business Partners',
                'donor_type' => 'Organization',

                'contact_person' => 'Daniel Lim',
                'contact_number' => '0919 330 7752',
                'email' => 'localpartners@example.com',

                'item' => 'Extension Cords',
                'category' => 'Electrical',
                'quantity' => 8,
                'condition' => 'For Inspection',

                'date_received' => 'September 6, 2026',
                'time_received' => '3:40 PM',
                'received_by' => 'Paul Roldan',

                'status' => 'Pending Verification',
                'allocation' => 'Unallocated',

                'purpose' => 'For temporary electrical setups during events and community activities.',

                'notes' => 'Eight extension cords were received. Electrical inspection is required before these resources may be accepted for logistics use.',
            ],

            'verification' => [
                'available' => false,
                'verified_by' => null,
                'verified_date' => null,
                'verified_time' => null,
                'quantity' => null,
                'condition' => null,
                'result' => null,
                'notes' => null,
            ],

            'timeline' => [
                [
                    'title' => 'Donation received',
                    'description' => 'Eight extension cords were received from Local Business Partners.',
                    'date' => 'Sep 6, 2026',
                    'time' => '3:40 PM',
                    'tone' => 'teal',
                    'icon' => 'receive',
                ],
                [
                    'title' => 'Verification pending',
                    'description' => 'Electrical inspection is required before the donated extension cords can be accepted.',
                    'date' => 'Sep 6, 2026',
                    'time' => '3:45 PM',
                    'tone' => 'amber',
                    'icon' => 'inspect',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | DON-2026-0007
        |--------------------------------------------------------------------------
        */

        'DON-2026-0007' => [
            'donation' => [
                'id' => 'DON-2026-0007',

                'donor' => 'Ramon Villanueva',
                'donor_type' => 'Individual',

                'contact_person' => 'Ramon Villanueva',
                'contact_number' => '0916 721 4055',
                'email' => 'ramon.villanueva@example.com',

                'item' => 'Portable Storage Boxes',
                'category' => 'Storage',
                'quantity' => 10,
                'condition' => 'Good',

                'date_received' => 'September 5, 2026',
                'time_received' => '11:15 AM',
                'received_by' => 'Paul Roldan',

                'status' => 'Verified',
                'allocation' => 'Unallocated',

                'purpose' => 'For storing and transporting reusable PULSO event materials.',

                'notes' => 'Ten portable storage boxes were received in good condition. All lids and locking handles were functional.',
            ],

            'verification' => [
                'available' => true,
                'verified_by' => 'Paul Roldan',
                'verified_date' => 'September 5, 2026',
                'verified_time' => '1:20 PM',
                'quantity' => 10,
                'condition' => 'Good',
                'result' => 'Accepted',
                'notes' => 'All storage boxes were inspected and accepted for logistics use.',
            ],

            'timeline' => [
                [
                    'title' => 'Donation received',
                    'description' => 'Ten portable storage boxes were received from Ramon Villanueva.',
                    'date' => 'Sep 5, 2026',
                    'time' => '11:15 AM',
                    'tone' => 'teal',
                    'icon' => 'receive',
                ],
                [
                    'title' => 'Resources inspected',
                    'description' => 'All boxes, covers, handles, and locking mechanisms were checked.',
                    'date' => 'Sep 5, 2026',
                    'time' => '12:50 PM',
                    'tone' => 'amber',
                    'icon' => 'inspect',
                ],
                [
                    'title' => 'Donation verified',
                    'description' => 'All storage boxes were accepted and made available for allocation.',
                    'date' => 'Sep 5, 2026',
                    'time' => '1:20 PM',
                    'tone' => 'green',
                    'icon' => 'accepted',
                ],
            ],
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | SELECT CURRENT RECORD
    |--------------------------------------------------------------------------
    */

    $requestedDonationId =
        request()->query(
            'id',
            'DON-2026-0011'
        );

    $selectedRecord =
        $donationRecords[$requestedDonationId]
        ?? $donationRecords['DON-2026-0011'];

    $donation =
        $selectedRecord['donation'];

    $verification =
        $selectedRecord['verification'];

    $timeline =
        $selectedRecord['timeline'];


    /*
    |--------------------------------------------------------------------------
    | WORKFLOW
    |--------------------------------------------------------------------------
    */

    $workflowStages = [
        [
            'label' => 'Received',
            'description' => 'Donation recorded',
            'icon' => 'receive',
        ],
        [
            'label' => 'Verified',
            'description' => 'Quantity and condition checked',
            'icon' => 'inspect',
        ],
        [
            'label' => 'Accepted',
            'description' => 'Resource cleared for use',
            'icon' => 'accepted',
        ],
        [
            'label' => 'Allocated',
            'description' => 'Assigned when required',
            'icon' => 'allocate',
        ],
        [
            'label' => 'Inventory',
            'description' => 'Added to reusable stock',
            'icon' => 'inventory',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | WORKFLOW STATE
    |--------------------------------------------------------------------------
    */

    $currentStageIndex = match ($donation['status']) {
        'Pending Verification' => 1,
        'Verified' => 3,
        'Allocated' => 3,
        'Added to Inventory' => 4,
        default => 0,
    };

    $isPendingVerification =
        $donation['status'] === 'Pending Verification';

    $isVerified =
        $donation['status'] === 'Verified';

    $isAllocated =
        $donation['status'] === 'Allocated';

    $isInInventory =
        $donation['status'] === 'Added to Inventory';


    /*
    |--------------------------------------------------------------------------
    | STATUS TONE
    |--------------------------------------------------------------------------
    */

    $statusTone = match ($donation['status']) {
        'Pending Verification' => 'amber',
        'Verified' => 'teal',
        'Allocated' => 'blue',
        'Added to Inventory' => 'green',
        default => 'navy',
    };
@endphp


@push('styles')
<style>
    .donation-detail-page {
        --dd-navy: #10263d;
        --dd-copy: #496580;
        --dd-muted: #71899c;
        --dd-line: #d5e5ee;

        --dd-teal: #007780;
        --dd-pink: #b90c61;
        --dd-blue: #365f8d;
        --dd-amber: #895408;
        --dd-green: #2b735d;
        --dd-red: #ad343d;

        display: grid;
        gap: 22px;

        width: 100%;
        min-width: 0;

        color: var(--dd-navy);

        container-name: donation-detail-page;
        container-type: inline-size;
    }

    .donation-detail-page *,
    .donation-detail-page *::before,
    .donation-detail-page *::after {
        box-sizing: border-box;
    }

    .donation-detail-page [hidden] {
        display: none !important;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .dd-icon {
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

    .dd-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       HEADER
       ================================================================ */

    .dd-page-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 22px;

        min-width: 0;
    }

    .dd-page-head-copy {
        min-width: 0;
    }

    .dd-back-link {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 12px;

        color: #55758b;

        font-size: 10.5px;
        font-weight: 700;

        text-decoration: none;
    }

    .dd-back-link:hover {
        color: var(--dd-teal);
    }

    .dd-back-link .dd-icon {
        width: 14px;
        height: 14px;
    }

    .dd-eyebrow {
        margin: 0 0 7px;

        color: var(--dd-pink);

        font-size: 10px;
        font-weight: 850;

        letter-spacing: .14em;

        text-transform: uppercase;
    }

    .dd-page-head h1 {
        margin: 0;

        color: var(--dd-navy);

        font-size: clamp(
            28px,
            3vw,
            40px
        );

        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.05em;
    }

    .dd-page-description {
        margin: 8px 0 0;

        color: var(--dd-copy);

        font-size: 13px;
        line-height: 1.65;
    }

    .dd-header-actions {
        display: flex;
        align-items: center;

        gap: 9px;

        flex-shrink: 0;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .dd-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 43px;

        padding: 9px 14px;

        border-radius: 13px;

        font: inherit;
        font-size: 10.5px;
        font-weight: 750;

        text-decoration: none;

        cursor: pointer;
    }

    .dd-button .dd-icon {
        width: 15px;
        height: 15px;
    }

    .dd-button-secondary {
        border: 1px solid rgba(255, 255, 255, .96);

        background:
            linear-gradient(
                145deg,
                #f7fbfd,
                #e5eef3
            );

        color: #4d6a7f;

        box-shadow:
            4px 5px 10px rgba(75, 108, 129, .09),
            -3px -3px 7px rgba(255, 255, 255, .78);
    }

    .dd-button-primary {
        border: 1px solid #c3f5f7;

        background:
            linear-gradient(
                145deg,
                #058991,
                #00747d
            );

        color: #ffffff;

        box-shadow:
            4px 6px 12px rgba(0, 119, 128, .2),
            inset 1px 1px 3px rgba(125, 234, 240, .35);
    }

    .dd-button-amber {
        border: 1px solid #f0d59e;

        background:
            linear-gradient(
                145deg,
                #f3c66f,
                #d99b34
            );

        color: #543400;

        box-shadow:
            4px 6px 12px rgba(153, 104, 28, .16),
            inset 1px 1px 3px rgba(255, 241, 199, .48);
    }


    /* ================================================================
       HERO
       ================================================================ */

    .dd-hero {
        display: grid;

        grid-template-columns:
            minmax(270px, .82fr)
            minmax(520px, 1.18fr);

        align-items: center;

        gap: 20px;

        padding: 18px 20px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 22px;

        background:
            linear-gradient(
                145deg,
                #f9fdff,
                #e8f3f7
            );

        box-shadow:
            7px 9px 19px rgba(77, 112, 134, .12),
            -5px -5px 13px rgba(255, 255, 255, .78);
    }

    .dd-hero-main {
        display: flex;
        align-items: center;

        gap: 16px;

        min-width: 0;
    }

    .dd-donation-symbol {
        display: grid;
        place-items: center;

        width: 62px;
        height: 62px;

        flex: 0 0 62px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 19px;

        background:
            linear-gradient(
                145deg,
                #fceaf3,
                #efd4e1
            );

        color: var(--dd-pink);

        box-shadow:
            4px 5px 11px rgba(106, 80, 94, .09),
            -3px -3px 8px rgba(255, 255, 255, .76);
    }

    .dd-donation-symbol .dd-icon {
        width: 25px;
        height: 25px;
    }

    .dd-hero-copy {
        min-width: 0;
    }

    .dd-record-id {
        display: block;

        color: #758c9d;

        font-size: 9.5px;
        font-weight: 700;
    }

    .dd-item-name {
        margin: 4px 0 0;

        color: #18344c;

        font-size: 20px;
        font-weight: 820;
        line-height: 1.2;

        letter-spacing: -.035em;
    }

    .dd-donor-name {
        display: block;

        margin-top: 5px;

        color: #59768a;

        font-size: 11px;
    }

    .dd-hero-statuses {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 8px;

        min-width: 0;
    }

    .dd-hero-stat {
        min-width: 0;
        min-height: 62px;

        padding: 10px 11px;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e6f0f4,
                #f0f7f9
            );

        box-shadow:
            inset 2px 2px 5px rgba(75, 110, 131, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .76);
    }

    .dd-hero-stat span {
        display: block;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .dd-hero-stat strong {
        display: block;

        margin-top: 5px;

        overflow: hidden;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 780;
        line-height: 1.35;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .dd-status-amber {
        color: var(--dd-amber) !important;
    }

    .dd-status-teal {
        color: var(--dd-teal) !important;
    }

    .dd-status-blue {
        color: var(--dd-blue) !important;
    }

    .dd-status-green {
        color: var(--dd-green) !important;
    }


    /* ================================================================
       WORKFLOW
       ================================================================ */

    .dd-workflow {
        padding: 18px 20px 20px;

        border: 1px solid rgba(255, 255, 255, .95);
        border-radius: 20px;

        background:
            linear-gradient(
                145deg,
                #f6fbfd,
                #e6f1f5
            );

        box-shadow:
            5px 7px 14px rgba(78, 112, 133, .09),
            -4px -4px 10px rgba(255, 255, 255, .72);
    }

    .dd-section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 15px;
    }

    .dd-section-heading h2 {
        margin: 0;

        color: #29475f;

        font-size: 13px;
        font-weight: 790;
    }

    .dd-section-heading span {
        color: #7c92a2;

        font-size: 9.5px;
    }

    .dd-workflow-scroll {
        overflow-x: auto;
    }

    .dd-workflow-steps {
        display: grid;

        grid-template-columns:
            repeat(
                5,
                minmax(145px, 1fr)
            );

        gap: 9px;

        min-width: 790px;
    }

    .dd-workflow-step {
        display: flex;
        align-items: center;

        gap: 10px;

        min-height: 61px;

        padding: 10px 11px;

        border: 1px solid rgba(255, 255, 255, .88);
        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e9f2f6,
                #eff7fa
            );

        color: #668093;

        box-shadow:
            inset 2px 2px 5px rgba(77, 112, 133, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .72);
    }

    .dd-workflow-step.is-complete {
        background:
            linear-gradient(
                145deg,
                #e0f3eb,
                #edf8f3
            );

        color: var(--dd-green);
    }

    .dd-workflow-step.is-current {
        background:
            linear-gradient(
                145deg,
                #fff0d9,
                #f5dfb4
            );

        color: var(--dd-amber);
    }

    .dd-workflow-step.is-current[data-stage="Allocated"] {
        background:
            linear-gradient(
                145deg,
                #e6eef8,
                #d8e5f2
            );

        color: var(--dd-blue);
    }

    .dd-workflow-step.is-current[data-stage="Inventory"] {
        background:
            linear-gradient(
                145deg,
                #e0f3eb,
                #d3e9e0
            );

        color: var(--dd-green);
    }

    .dd-step-icon {
        display: grid;
        place-items: center;

        width: 31px;
        height: 31px;

        flex: 0 0 31px;

        border: 1px solid rgba(255, 255, 255, .92);
        border-radius: 10px;

        background: rgba(255, 255, 255, .42);
    }

    .dd-step-icon .dd-icon {
        width: 14px;
        height: 14px;
    }

    .dd-step-copy strong {
        display: block;

        font-size: 10px;
        font-weight: 780;
    }

    .dd-step-copy span {
        display: block;

        margin-top: 2px;

        color: #7b91a1;

        font-size: 8.2px;
        line-height: 1.35;
    }


    /* ================================================================
       MAIN GRID
       ================================================================ */

    .dd-content-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.45fr)
            minmax(300px, .55fr);

        align-items: start;

        gap: 18px;
    }

    .dd-main-column,
    .dd-side-column {
        display: grid;

        gap: 18px;

        min-width: 0;
    }


    /* ================================================================
       CARD
       ================================================================ */

    .dd-card {
        min-width: 0;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 20px;

        background:
            linear-gradient(
                145deg,
                #f9fdff,
                #e8f3f7
            );

        box-shadow:
            5px 7px 15px rgba(80, 114, 135, .1),
            -4px -4px 10px rgba(255, 255, 255, .72);
    }

    .dd-card-head {
        display: flex;
        align-items: center;

        gap: 11px;

        padding: 16px 18px;

        border-bottom: 1px solid rgba(207, 225, 234, .82);
    }

    .dd-card-head-icon {
        display: grid;
        place-items: center;

        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e2f6f7,
                #d0eaed
            );

        color: var(--dd-teal);
    }

    .dd-card-head-icon.is-pink {
        background:
            linear-gradient(
                145deg,
                #fae8f1,
                #efd5e1
            );

        color: var(--dd-pink);
    }

    .dd-card-head-icon .dd-icon {
        width: 16px;
        height: 16px;
    }

    .dd-card-head-copy h2 {
        margin: 0;

        color: #29475f;

        font-size: 12px;
        font-weight: 790;
    }

    .dd-card-head-copy p {
        margin: 3px 0 0;

        color: #7a91a1;

        font-size: 9px;
    }

    .dd-card-body {
        padding: 18px;
    }


    /* ================================================================
       DETAIL GRID
       ================================================================ */

    .dd-detail-grid {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 11px;
    }

    .dd-detail-item {
        padding: 11px 12px;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #e8f1f5,
                #f0f7f9
            );

        box-shadow:
            inset 2px 2px 5px rgba(77, 111, 132, .07),
            inset -2px -2px 5px rgba(255, 255, 255, .74);
    }

    .dd-detail-item span {
        display: block;

        color: #7c92a2;

        font-size: 8.8px;
    }

    .dd-detail-item strong {
        display: block;

        margin-top: 4px;

        color: #29475f;

        font-size: 10.8px;
        line-height: 1.45;

        overflow-wrap: anywhere;
    }


    /* ================================================================
       NOTES
       ================================================================ */

    .dd-note {
        padding: 13px 14px;

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f5e9ef,
                #faf3f6
            );

        color: #68566a;

        box-shadow:
            inset 2px 2px 5px rgba(111, 77, 95, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .72);

        font-size: 10.3px;
        line-height: 1.65;
    }


    /* ================================================================
       VERIFICATION
       ================================================================ */

    .dd-verification-result {
        display: flex;
        align-items: center;

        gap: 12px;

        margin-bottom: 13px;

        padding: 12px 13px;

        border: 1px solid rgba(255, 255, 255, .68);
        border-radius: 13px;
    }

    .dd-verification-result.is-accepted {
        background:
            linear-gradient(
                145deg,
                #e0f3ea,
                #edf8f2
            );

        color: var(--dd-green);
    }

    .dd-verification-result.is-pending {
        background:
            linear-gradient(
                145deg,
                #fff2df,
                #f7e2bd
            );

        color: var(--dd-amber);
    }

    .dd-verification-result-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border: 1px solid rgba(255, 255, 255, .78);
        border-radius: 12px;

        background: rgba(255, 255, 255, .38);

        color: currentColor;
    }

    .dd-verification-result-icon .dd-icon {
        width: 18px;
        height: 18px;
    }

    .dd-verification-result strong {
        display: block;

        color: currentColor;

        font-size: 11px;
        font-weight: 800;
    }

    .dd-verification-result > div > span {
        display: block;

        margin-top: 3px;

        color: currentColor;

        font-size: 8.8px;

        opacity: .78;
    }


    /* ================================================================
       STATE CARD
       ================================================================ */

    .dd-state-card {
        padding: 16px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 19px;

        box-shadow:
            5px 7px 14px rgba(70, 111, 132, .1),
            -4px -4px 10px rgba(255, 255, 255, .72);
    }

    .dd-state-card.is-pending {
        background:
            linear-gradient(
                145deg,
                #fff2df,
                #f7e3c1
            );

        color: #77581f;
    }

    .dd-state-card.is-verified {
        background:
            linear-gradient(
                145deg,
                #e2f5f6,
                #d5ecef
            );

        color: #356f75;
    }

    .dd-state-card.is-allocated {
        background:
            linear-gradient(
                145deg,
                #e8eff8,
                #dbe7f2
            );

        color: #456789;
    }

    .dd-state-card.is-inventory {
        background:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );

        color: #356c5a;
    }

    .dd-state-card-icon {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        margin-bottom: 11px;

        border-radius: 12px;

        background: rgba(255, 255, 255, .44);

        color: currentColor;
    }

    .dd-state-card-icon .dd-icon {
        width: 18px;
        height: 18px;
    }

    .dd-state-card h2 {
        margin: 0;

        color: currentColor;

        font-size: 13px;
        font-weight: 800;
    }

    .dd-state-card p {
        margin: 6px 0 14px;

        color: currentColor;

        font-size: 9.8px;
        line-height: 1.55;
    }

    .dd-state-card .dd-button {
        width: 100%;
    }


    /* ================================================================
       TIMELINE
       ================================================================ */

    .dd-timeline {
        display: grid;
    }

    .dd-timeline-item {
        position: relative;

        display: grid;

        grid-template-columns:
            34px
            minmax(0, 1fr);

        gap: 11px;

        padding-bottom: 17px;
    }

    .dd-timeline-item:last-child {
        padding-bottom: 0;
    }

    .dd-timeline-item:not(:last-child)::before {
        position: absolute;

        top: 35px;
        bottom: 1px;
        left: 16px;

        width: 2px;

        background: #d7e6ed;

        content: "";
    }

    .dd-timeline-icon {
        position: relative;
        z-index: 1;

        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #e5f1f5,
                #f0f7fa
            );

        color: #55788c;
    }

    .dd-timeline-icon.is-teal {
        background:
            linear-gradient(
                145deg,
                #dff4f5,
                #ccebed
            );

        color: var(--dd-teal);
    }

    .dd-timeline-icon.is-amber {
        background:
            linear-gradient(
                145deg,
                #fff2df,
                #f4e1c3
            );

        color: var(--dd-amber);
    }

    .dd-timeline-icon.is-blue {
        background:
            linear-gradient(
                145deg,
                #e7eef8,
                #d7e3f1
            );

        color: var(--dd-blue);
    }

    .dd-timeline-icon.is-green {
        background:
            linear-gradient(
                145deg,
                #e1f2ea,
                #d0e7dc
            );

        color: var(--dd-green);
    }

    .dd-timeline-icon .dd-icon {
        width: 15px;
        height: 15px;
    }

    .dd-timeline-copy strong {
        display: block;

        color: #29475f;

        font-size: 10.5px;
    }

    .dd-timeline-copy p {
        margin: 3px 0 0;

        color: #748b9b;

        font-size: 9px;
        line-height: 1.5;
    }

    .dd-timeline-date {
        display: block;

        margin-top: 5px;

        color: #98aab6;

        font-size: 8px;
    }


    /* ================================================================
       MODAL
       ================================================================ */

    .dd-modal {
        position: fixed;
        inset: 0;
        z-index: 120;

        display: none;
        align-items: center;
        justify-content: center;

        padding: 20px;

        background: rgba(16, 38, 61, .54);

        backdrop-filter: blur(5px);
    }

    .dd-modal.is-open {
        display: flex;
    }

    .dd-modal-panel {
        width: min(100%, 600px);
        max-height: calc(100vh - 40px);

        overflow-y: auto;

        border: 1px solid rgba(255, 255, 255, .97);
        border-radius: 20px;

        background:
            linear-gradient(
                145deg,
                #f9fdff,
                #e7f1f5
            );

        box-shadow:
            12px 16px 36px rgba(37, 68, 86, .26),
            -5px -5px 14px rgba(255, 255, 255, .64);
    }

    .dd-modal-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 15px;

        padding: 18px 19px;

        border-bottom: 1px solid var(--dd-line);
    }

    .dd-modal-head h2 {
        margin: 0;

        color: #29475f;

        font-size: 15px;
        font-weight: 800;
    }

    .dd-modal-head p {
        margin: 4px 0 0;

        color: #7b91a1;

        font-size: 9.5px;
    }

    .dd-modal-close {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        padding: 0;

        border: 1px solid rgba(255, 255, 255, .92);
        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #f5fafc,
                #e2edf2
            );

        color: #5a7589;

        cursor: pointer;
    }

    .dd-modal-close .dd-icon {
        width: 15px;
        height: 15px;
    }

    .dd-modal-body {
        padding: 18px 19px;
    }

    .dd-modal-note {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        margin-bottom: 15px;

        padding: 11px 12px;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #e4f3f5,
                #eef8f9
            );

        color: #587589;

        font-size: 9.5px;
        line-height: 1.55;
    }

    .dd-modal-note .dd-icon {
        width: 15px;
        height: 15px;

        flex: 0 0 15px;

        margin-top: 1px;

        color: var(--dd-teal);
    }

    .dd-field + .dd-field {
        margin-top: 13px;
    }

    .dd-field label {
        display: block;

        margin-bottom: 6px;

        color: #45647a;

        font-size: 9.5px;
        font-weight: 750;
    }

    .dd-control {
        width: 100%;
        min-height: 42px;

        padding: 8px 10px;

        border: 1px solid #cfdee6;
        border-radius: 11px;

        outline: none;

        background:
            linear-gradient(
                145deg,
                #e6eff3,
                #eef6f8
            );

        color: #203e55;

        box-shadow:
            inset 3px 3px 6px rgba(80, 113, 134, .1),
            inset -3px -3px 6px rgba(255, 255, 255, .8);

        font: inherit;
        font-size: 10.5px;
    }

    textarea.dd-control {
        min-height: 78px;

        resize: vertical;
    }

    .dd-modal-error {
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

    .dd-modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 9px;

        padding: 15px 19px 18px;

        border-top: 1px solid var(--dd-line);
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container donation-detail-page (max-width: 1080px) {
        .dd-hero {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .dd-hero-statuses {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );
        }
    }

    @container donation-detail-page (max-width: 900px) {
        .dd-page-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .dd-content-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @container donation-detail-page (max-width: 700px) {
        .dd-hero-statuses {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }

    @container donation-detail-page (max-width: 600px) {
        .dd-header-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);

            width: 100%;
        }

        .dd-header-actions .dd-button {
            width: 100%;
        }

        .dd-hero-main {
            align-items: flex-start;
        }

        .dd-donation-symbol {
            width: 55px;
            height: 55px;

            flex-basis: 55px;
        }

        .dd-detail-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .dd-modal-footer {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);
        }

        .dd-modal-footer .dd-button {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')
<div
    id="donation-detail-page"
    class="donation-detail-page"
>

    {{-- =============================================================
         ICON LIBRARY
         ============================================================= --}}

    <svg
        class="dd-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="dd-icon-back" viewBox="0 0 24 24">
            <path d="M19 12H5"/>
            <path d="m11 6-6 6 6 6"/>
        </symbol>

        <symbol id="dd-icon-donation" viewBox="0 0 24 24">
            <path d="M4 10h16v10H4Z"/>
            <path d="M3 7h18v3H3Z"/>
            <path d="M12 7v13"/>
            <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>
            <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>
        </symbol>

        <symbol id="dd-icon-user" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 21a8 8 0 0 1 16 0"/>
        </symbol>

        <symbol id="dd-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="dd-icon-accepted" viewBox="0 0 24 24">
            <path d="M12 3 19 6v5c0 4.3-2.7 7.9-7 10-4.3-2.1-7-5.7-7-10V6l7-3Z"/>
            <path d="m8.8 12 2.1 2.1 4.5-5"/>
        </symbol>

        <symbol id="dd-icon-inspect" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 4 4"/>
            <path d="M8 10.5 10 12l3-4"/>
        </symbol>

        <symbol id="dd-icon-receive" viewBox="0 0 24 24">
            <path d="M12 3v12"/>
            <path d="m7 10 5 5 5-5"/>
            <path d="M4 20h16"/>
        </symbol>

        <symbol id="dd-icon-allocate" viewBox="0 0 24 24">
            <path d="M4 6h7"/>
            <path d="m8 3 3 3-3 3"/>
            <path d="M20 18h-7"/>
            <path d="m16 15-3 3 3 3"/>
            <path d="M4 12h16"/>
        </symbol>

        <symbol id="dd-icon-inventory" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="dd-icon-info" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 11v5"/>
            <path d="M12 8h.01"/>
        </symbol>

        <symbol id="dd-icon-timeline" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="dd-icon-x" viewBox="0 0 24 24">
            <path d="m6 6 12 12"/>
            <path d="m18 6-12 12"/>
        </symbol>
    </svg>


    {{-- =============================================================
         PAGE HEADER
         ============================================================= --}}

    <header class="dd-page-head">

        <div class="dd-page-head-copy">

            <a
                href="{{ route('donations.index') }}"
                class="dd-back-link"
            >
                <svg
                    class="dd-icon"
                    aria-hidden="true"
                >
                    <use href="#dd-icon-back"/>
                </svg>

                Back to donations
            </a>


            <p class="dd-eyebrow">
                Donation record
            </p>


            <h1>
                Donation Details
            </h1>


            <p class="dd-page-description">
                Review the donor, donated physical resources,
                verification result, and current allocation or
                inventory status.
            </p>

        </div>


        <div class="dd-header-actions">

            <a
                href="{{ route('donations.index') }}"
                class="
                    dd-button
                    dd-button-secondary
                "
            >
                Donation register
            </a>


            @if ($isPendingVerification)

                <button
                    id="open-verification-modal"
                    type="button"
                    class="
                        dd-button
                        dd-button-amber
                    "
                >
                    <svg
                        class="dd-icon"
                        aria-hidden="true"
                    >
                        <use href="#dd-icon-inspect"/>
                    </svg>

                    Verify donation
                </button>

            @elseif ($isVerified)

                <button
                    id="open-allocation-modal"
                    type="button"
                    class="
                        dd-button
                        dd-button-primary
                    "
                >
                    <svg
                        class="dd-icon"
                        aria-hidden="true"
                    >
                        <use href="#dd-icon-allocate"/>
                    </svg>

                    Allocate donation
                </button>

            @endif

        </div>

    </header>


    {{-- =============================================================
         HERO
         ============================================================= --}}

    <section class="dd-hero">

        <div class="dd-hero-main">

            <span
                class="dd-donation-symbol"
                aria-hidden="true"
            >
                <svg class="dd-icon">
                    <use href="#dd-icon-donation"/>
                </svg>
            </span>


            <div class="dd-hero-copy">

                <span class="dd-record-id">
                    {{ $donation['id'] }}
                </span>

                <h2 class="dd-item-name">
                    {{ $donation['item'] }}
                </h2>

                <span class="dd-donor-name">
                    Donated by {{ $donation['donor'] }}
                </span>

            </div>

        </div>


        <div class="dd-hero-statuses">

            <div class="dd-hero-stat">

                <span>
                    Quantity
                </span>

                <strong>
                    {{ $donation['quantity'] }}

                    {{ $donation['quantity'] === 1 ? 'unit' : 'units' }}
                </strong>

            </div>


            <div class="dd-hero-stat">

                <span>
                    Status
                </span>

                <strong
                    id="donation-current-status"
                    class="dd-status-{{ $statusTone }}"
                >
                    {{ $donation['status'] }}
                </strong>

            </div>


            <div class="dd-hero-stat">

                <span>
                    Condition
                </span>

                <strong id="donation-current-condition">
                    {{ $donation['condition'] }}
                </strong>

            </div>


            <div class="dd-hero-stat">

                <span>
                    Allocation
                </span>

                <strong id="donation-current-allocation">
                    {{ $donation['allocation'] }}
                </strong>

            </div>

        </div>

    </section>


    {{-- =============================================================
         WORKFLOW
         ============================================================= --}}

    <section class="dd-workflow">

        <div class="dd-section-heading">

            <h2>
                Donation intake workflow
            </h2>

            <span id="workflow-current-stage">
                Current stage: {{ $donation['status'] }}
            </span>

        </div>


        <div class="dd-workflow-scroll custom-scrollbar">

            <div class="dd-workflow-steps">

                @foreach ($workflowStages as $stageIndex => $stage)

                    @php
                        $stageClass = '';

                        if ($isPendingVerification) {
                            if ($stageIndex === 0) {
                                $stageClass = 'is-complete';
                            } elseif ($stageIndex === 1) {
                                $stageClass = 'is-current';
                            }
                        } elseif ($isVerified) {
                            if ($stageIndex <= 2) {
                                $stageClass = 'is-complete';
                            } elseif ($stageIndex === 3) {
                                $stageClass = 'is-current';
                            }
                        } elseif ($isAllocated) {
                            if ($stageIndex <= 2) {
                                $stageClass = 'is-complete';
                            } elseif ($stageIndex === 3) {
                                $stageClass = 'is-current';
                            }
                        } elseif ($isInInventory) {
                            if ($stageIndex < 4) {
                                $stageClass = 'is-complete';
                            } elseif ($stageIndex === 4) {
                                $stageClass = 'is-current';
                            }
                        }
                    @endphp

                    <article
                        id="workflow-step-{{ $stageIndex }}"
                        class="
                            dd-workflow-step
                            {{ $stageClass }}
                        "
                        data-stage="{{ $stage['label'] }}"
                    >

                        <span class="dd-step-icon">

                            <svg class="dd-icon">
                                <use href="#dd-icon-{{ $stage['icon'] }}"/>
                            </svg>

                        </span>


                        <div class="dd-step-copy">

                            <strong>
                                {{ $stage['label'] }}
                            </strong>

                            <span id="workflow-description-{{ $stageIndex }}">
                                {{ $stage['description'] }}
                            </span>

                        </div>

                    </article>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =============================================================
         CONTENT
         ============================================================= --}}

    <div class="dd-content-grid">

        <div class="dd-main-column">

            {{-- =====================================================
                 DONATION INFORMATION
                 ===================================================== --}}

            <section class="dd-card">

                <header class="dd-card-head">

                    <span
                        class="
                            dd-card-head-icon
                            is-pink
                        "
                        aria-hidden="true"
                    >
                        <svg class="dd-icon">
                            <use href="#dd-icon-donation"/>
                        </svg>
                    </span>


                    <div class="dd-card-head-copy">

                        <h2>
                            Donation information
                        </h2>

                        <p>
                            Physical resource and intake details
                        </p>

                    </div>

                </header>


                <div class="dd-card-body">

                    <div class="dd-detail-grid">

                        <div class="dd-detail-item">

                            <span>
                                Donation ID
                            </span>

                            <strong>
                                {{ $donation['id'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Category
                            </span>

                            <strong>
                                {{ $donation['category'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Donated resource
                            </span>

                            <strong>
                                {{ $donation['item'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Quantity received
                            </span>

                            <strong>
                                {{ $donation['quantity'] }}

                                {{ $donation['quantity'] === 1 ? 'unit' : 'units' }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Recorded condition
                            </span>

                            <strong id="detail-condition">
                                {{ $donation['condition'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Intake status
                            </span>

                            <strong id="detail-status">
                                {{ $donation['status'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Date received
                            </span>

                            <strong>
                                {{ $donation['date_received'] }}
                                ·
                                {{ $donation['time_received'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Received by
                            </span>

                            <strong>
                                {{ $donation['received_by'] }}
                            </strong>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                 DONOR INFORMATION
                 ===================================================== --}}

            <section class="dd-card">

                <header class="dd-card-head">

                    <span
                        class="dd-card-head-icon"
                        aria-hidden="true"
                    >
                        <svg class="dd-icon">
                            <use href="#dd-icon-user"/>
                        </svg>
                    </span>


                    <div class="dd-card-head-copy">

                        <h2>
                            Donor information
                        </h2>

                        <p>
                            Source and contact details
                        </p>

                    </div>

                </header>


                <div class="dd-card-body">

                    <div class="dd-detail-grid">

                        <div class="dd-detail-item">

                            <span>
                                Donor
                            </span>

                            <strong>
                                {{ $donation['donor'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Donor type
                            </span>

                            <strong>
                                {{ $donation['donor_type'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Contact person
                            </span>

                            <strong>
                                {{ $donation['contact_person'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Contact number
                            </span>

                            <strong>
                                {{ $donation['contact_number'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Email
                            </span>

                            <strong>
                                {{ $donation['email'] }}
                            </strong>

                        </div>


                        <div class="dd-detail-item">

                            <span>
                                Intended purpose
                            </span>

                            <strong>
                                {{ $donation['purpose'] }}
                            </strong>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                 NOTES
                 ===================================================== --}}

            <section class="dd-card">

                <header class="dd-card-head">

                    <span
                        class="
                            dd-card-head-icon
                            is-pink
                        "
                        aria-hidden="true"
                    >
                        <svg class="dd-icon">
                            <use href="#dd-icon-info"/>
                        </svg>
                    </span>


                    <div class="dd-card-head-copy">

                        <h2>
                            Intake notes
                        </h2>

                        <p>
                            Observations recorded during receipt
                        </p>

                    </div>

                </header>


                <div class="dd-card-body">

                    <div class="dd-note">
                        {{ $donation['notes'] }}
                    </div>

                </div>

            </section>

        </div>


        {{-- =========================================================
             SIDE COLUMN
             ========================================================= --}}

        <aside class="dd-side-column">

            {{-- =====================================================
                 VERIFICATION
                 ===================================================== --}}

            <section
                id="verification-card"
                class="dd-card"
            >

                <header class="dd-card-head">

                    <span
                        class="dd-card-head-icon"
                        aria-hidden="true"
                    >
                        <svg class="dd-icon">
                            <use href="#dd-icon-check"/>
                        </svg>
                    </span>


                    <div class="dd-card-head-copy">

                        <h2>
                            Verification
                        </h2>

                        <p>
                            Resource inspection result
                        </p>

                    </div>

                </header>


                <div
                    id="verification-card-body"
                    class="dd-card-body"
                >

                    @if ($verification['available'])

                        <div
                            class="
                                dd-verification-result
                                is-accepted
                            "
                        >

                            <span
                                class="dd-verification-result-icon"
                                aria-hidden="true"
                            >
                                <svg class="dd-icon">
                                    <use href="#dd-icon-accepted"/>
                                </svg>
                            </span>


                            <div>

                                <strong>
                                    {{ $verification['result'] }}
                                </strong>

                                <span>
                                    Donation verified for logistics use
                                </span>

                            </div>

                        </div>


                        <div class="dd-detail-grid">

                            <div class="dd-detail-item">

                                <span>
                                    Verified by
                                </span>

                                <strong>
                                    {{ $verification['verified_by'] }}
                                </strong>

                            </div>


                            <div class="dd-detail-item">

                                <span>
                                    Verified quantity
                                </span>

                                <strong>
                                    {{ $verification['quantity'] }}
                                </strong>

                            </div>


                            <div class="dd-detail-item">

                                <span>
                                    Condition
                                </span>

                                <strong>
                                    {{ $verification['condition'] }}
                                </strong>

                            </div>


                            <div class="dd-detail-item">

                                <span>
                                    Date verified
                                </span>

                                <strong>
                                    {{ $verification['verified_date'] }}
                                </strong>

                            </div>

                        </div>


                        <div
                            class="dd-note"
                            style="margin-top: 12px;"
                        >
                            {{ $verification['notes'] }}
                        </div>

                    @else

                        <div
                            class="
                                dd-verification-result
                                is-pending
                            "
                        >

                            <span
                                class="dd-verification-result-icon"
                                aria-hidden="true"
                            >
                                <svg class="dd-icon">
                                    <use href="#dd-icon-inspect"/>
                                </svg>
                            </span>


                            <div>

                                <strong>
                                    Pending Verification
                                </strong>

                                <span>
                                    Inspection has not yet been completed
                                </span>

                            </div>

                        </div>


                        <div class="dd-note">
                            This resource must be inspected for quantity,
                            usability, and physical condition before it
                            can be accepted for logistics use.
                        </div>

                    @endif

                </div>

            </section>


            {{-- =====================================================
                 CURRENT STATE / ACTION
                 ===================================================== --}}

            <section
                id="donation-state-card"
                class="
                    dd-state-card

                    @if ($isPendingVerification)
                        is-pending
                    @elseif ($isVerified)
                        is-verified
                    @elseif ($isAllocated)
                        is-allocated
                    @elseif ($isInInventory)
                        is-inventory
                    @endif
                "
            >

                <span
                    class="dd-state-card-icon"
                    aria-hidden="true"
                >
                    <svg class="dd-icon">

                        @if ($isPendingVerification)

                            <use href="#dd-icon-inspect"/>

                        @elseif ($isVerified)

                            <use href="#dd-icon-allocate"/>

                        @elseif ($isAllocated)

                            <use href="#dd-icon-allocate"/>

                        @else

                            <use href="#dd-icon-inventory"/>

                        @endif

                    </svg>
                </span>


                @if ($isPendingVerification)

                    <h2>
                        Verification required
                    </h2>

                    <p>
                        Inspect the received resource before accepting
                        it for allocation or inventory use.
                    </p>


                    <button
                        id="open-verification-card-button"
                        type="button"
                        class="
                            dd-button
                            dd-button-amber
                        "
                    >
                        Verify donation
                    </button>

                @elseif ($isVerified)

                    <h2>
                        Ready for allocation
                    </h2>

                    <p>
                        This donation has been verified and accepted.
                        Choose whether the resource should enter
                        general inventory or be assigned directly
                        to a project.
                    </p>


                    <button
                        id="open-allocation-card-button"
                        type="button"
                        class="
                            dd-button
                            dd-button-primary
                        "
                    >
                        Allocate donation
                    </button>

                @elseif ($isAllocated)

                    <h2>
                        Donation allocated
                    </h2>

                    <p>
                        These donated resources are currently assigned
                        to <strong>{{ $donation['allocation'] }}</strong>.
                    </p>

                @elseif ($isInInventory)

                    <h2>
                        Added to inventory
                    </h2>

                    <p>
                        These donated resources have been integrated
                        into the reusable logistics inventory.
                    </p>

                @endif

            </section>


            {{-- =====================================================
                 TIMELINE
                 ===================================================== --}}

            <section class="dd-card">

                <header class="dd-card-head">

                    <span
                        class="dd-card-head-icon"
                        aria-hidden="true"
                    >
                        <svg class="dd-icon">
                            <use href="#dd-icon-timeline"/>
                        </svg>
                    </span>


                    <div class="dd-card-head-copy">

                        <h2>
                            Donation history
                        </h2>

                        <p>
                            Intake activity timeline
                        </p>

                    </div>

                </header>


                <div class="dd-card-body">

                    <div
                        id="donation-timeline"
                        class="dd-timeline"
                    >

                        @foreach ($timeline as $item)

                            <article class="dd-timeline-item">

                                <span
                                    class="
                                        dd-timeline-icon
                                        is-{{ $item['tone'] }}
                                    "
                                    aria-hidden="true"
                                >
                                    <svg class="dd-icon">
                                        <use href="#dd-icon-{{ $item['icon'] }}"/>
                                    </svg>
                                </span>


                                <div class="dd-timeline-copy">

                                    <strong>
                                        {{ $item['title'] }}
                                    </strong>

                                    <p>
                                        {{ $item['description'] }}
                                    </p>

                                    <span class="dd-timeline-date">
                                        {{ $item['date'] }}
                                        ·
                                        {{ $item['time'] }}
                                    </span>

                                </div>

                            </article>

                        @endforeach

                    </div>

                </div>

            </section>

        </aside>

    </div>


    {{-- =============================================================
         VERIFICATION MODAL
         ============================================================= --}}

    @if ($isPendingVerification)

        <div
            id="verification-modal"
            class="dd-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="verification-modal-title"
            aria-hidden="true"
        >

            <div class="dd-modal-panel custom-scrollbar">

                <header class="dd-modal-head">

                    <div>

                        <h2 id="verification-modal-title">
                            Verify Donation
                        </h2>

                        <p>
                            {{ $donation['id'] }}
                            ·
                            {{ $donation['item'] }}
                        </p>

                    </div>


                    <button
                        id="close-verification-modal"
                        type="button"
                        class="dd-modal-close"
                        aria-label="Close verification modal"
                    >
                        <svg
                            class="dd-icon"
                            aria-hidden="true"
                        >
                            <use href="#dd-icon-x"/>
                        </svg>
                    </button>

                </header>


                <div class="dd-modal-body">

                    <div class="dd-modal-note">

                        <svg
                            class="dd-icon"
                            aria-hidden="true"
                        >
                            <use href="#dd-icon-inspect"/>
                        </svg>

                        <span>
                            Confirm the actual quantity and physical
                            condition of the donated resource before
                            accepting it for logistics use.
                        </span>

                    </div>


                    <div class="dd-field">

                        <label for="verification-quantity">
                            Verified quantity
                        </label>

                        <input
                            id="verification-quantity"
                            class="dd-control"
                            type="number"
                            min="1"
                            max="{{ $donation['quantity'] }}"
                            value="{{ $donation['quantity'] }}"
                        >

                    </div>


                    <div class="dd-field">

                        <label for="verification-condition">
                            Verified condition
                        </label>

                        <select
                            id="verification-condition"
                            class="dd-control"
                        >
                            <option value="Excellent">
                                Excellent
                            </option>

                            <option
                                value="Good"
                                selected
                            >
                                Good
                            </option>

                            <option value="Fair">
                                Fair
                            </option>

                            <option value="Needs maintenance">
                                Needs maintenance
                            </option>

                            <option value="Damaged">
                                Damaged
                            </option>
                        </select>

                    </div>


                    <div class="dd-field">

                        <label for="verification-notes">
                            Verification notes
                        </label>

                        <textarea
                            id="verification-notes"
                            class="dd-control"
                            maxlength="1000"
                            placeholder="Record inspection findings..."
                        ></textarea>

                    </div>


                    <p
                        id="verification-error"
                        class="dd-modal-error"
                        role="alert"
                        hidden
                    ></p>

                </div>


                <footer class="dd-modal-footer">

                    <button
                        id="cancel-verification"
                        type="button"
                        class="
                            dd-button
                            dd-button-secondary
                        "
                    >
                        Cancel
                    </button>


                    <button
                        id="confirm-verification"
                        type="button"
                        class="
                            dd-button
                            dd-button-primary
                        "
                    >
                        <svg
                            class="dd-icon"
                            aria-hidden="true"
                        >
                            <use href="#dd-icon-check"/>
                        </svg>

                        Accept donation
                    </button>

                </footer>

            </div>

        </div>

    @endif


    {{-- =============================================================
         ALLOCATION MODAL
         ============================================================= --}}

    @if ($isVerified)

        <div
            id="allocation-modal"
            class="dd-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="allocation-modal-title"
            aria-hidden="true"
        >

            <div class="dd-modal-panel custom-scrollbar">

                <header class="dd-modal-head">

                    <div>

                        <h2 id="allocation-modal-title">
                            Allocate Donation
                        </h2>

                        <p>
                            {{ $donation['id'] }}
                            ·
                            {{ $donation['item'] }}
                        </p>

                    </div>


                    <button
                        id="close-allocation-modal"
                        type="button"
                        class="dd-modal-close"
                        aria-label="Close allocation modal"
                    >
                        <svg
                            class="dd-icon"
                            aria-hidden="true"
                        >
                            <use href="#dd-icon-x"/>
                        </svg>
                    </button>

                </header>


                <div class="dd-modal-body">

                    <div class="dd-modal-note">

                        <svg
                            class="dd-icon"
                            aria-hidden="true"
                        >
                            <use href="#dd-icon-info"/>
                        </svg>

                        <span>
                            Send reusable donated resources to general
                            inventory or assign them directly to an
                            active PULSO project.
                        </span>

                    </div>


                    <div class="dd-field">

                        <label for="allocation-destination">
                            Allocation destination
                        </label>

                        <select
                            id="allocation-destination"
                            class="dd-control"
                        >
                            <option value="inventory">
                                General Inventory
                            </option>

                            <option value="project">
                                Specific Project
                            </option>
                        </select>

                    </div>


                    <div
                        id="allocation-project-field"
                        class="dd-field"
                        hidden
                    >

                        <label for="allocation-project">
                            Select project
                        </label>

                        <select
                            id="allocation-project"
                            class="dd-control"
                        >
                            <option value="Youth Leadership Summit">
                                Youth Leadership Summit
                            </option>

                            <option value="Medical Mission">
                                Medical Mission
                            </option>

                            <option value="Coastal Clean-Up Drive">
                                Coastal Clean-Up Drive
                            </option>
                        </select>

                    </div>


                    <div class="dd-field">

                        <label for="allocation-notes">
                            Allocation notes
                        </label>

                        <textarea
                            id="allocation-notes"
                            class="dd-control"
                            maxlength="1000"
                            placeholder="Optional remarks about this allocation..."
                        ></textarea>

                    </div>

                </div>


                <footer class="dd-modal-footer">

                    <button
                        id="cancel-allocation"
                        type="button"
                        class="
                            dd-button
                            dd-button-secondary
                        "
                    >
                        Cancel
                    </button>


                    <button
                        id="confirm-allocation"
                        type="button"
                        class="
                            dd-button
                            dd-button-primary
                        "
                    >
                        <svg
                            class="dd-icon"
                            aria-hidden="true"
                        >
                            <use href="#dd-icon-allocate"/>
                        </svg>

                        Confirm allocation
                    </button>

                </footer>

            </div>

        </div>

    @endif

</div>
@endsection


@push('scripts')
<script>
(() => {
    const initializeDonationDetails = () => {
        const page =
            document.getElementById(
                'donation-detail-page'
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


        const statusText =
            page.querySelector(
                '#donation-current-status'
            );


        const allocationText =
            page.querySelector(
                '#donation-current-allocation'
            );


        const conditionText =
            page.querySelector(
                '#donation-current-condition'
            );


        const detailCondition =
            page.querySelector(
                '#detail-condition'
            );


        const detailStatus =
            page.querySelector(
                '#detail-status'
            );


        const workflowCurrentStage =
            page.querySelector(
                '#workflow-current-stage'
            );


        const stateCard =
            page.querySelector(
                '#donation-state-card'
            );


        const timeline =
            page.querySelector(
                '#donation-timeline'
            );


        const verificationCardBody =
            page.querySelector(
                '#verification-card-body'
            );


        let lastFocusedElement =
            null;


        let previousBodyOverflow =
            '';


        /*
        |--------------------------------------------------------------------------
        | MODAL HELPERS
        |--------------------------------------------------------------------------
        */

        const openModal = (
            modal,
            focusTarget
        ) => {
            if (!modal) {
                return;
            }


            lastFocusedElement =
                document.activeElement;


            previousBodyOverflow =
                document.body.style.overflow;


            modal.classList.add(
                'is-open'
            );


            modal.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.style.overflow =
                'hidden';


            window.requestAnimationFrame(
                () => {
                    focusTarget?.focus();
                }
            );
        };


        const closeModal = (
            modal
        ) => {
            if (!modal) {
                return;
            }


            modal.classList.remove(
                'is-open'
            );


            modal.setAttribute(
                'aria-hidden',
                'true'
            );


            document.body.style.overflow =
                previousBodyOverflow;


            if (
                lastFocusedElement instanceof
                HTMLElement
            ) {
                lastFocusedElement.focus();
            }
        };


        /*
        |--------------------------------------------------------------------------
        | VERIFICATION
        |--------------------------------------------------------------------------
        */

        const verificationModal =
            page.querySelector(
                '#verification-modal'
            );


        if (
            verificationModal
        ) {
            const openHeader =
                page.querySelector(
                    '#open-verification-modal'
                );


            const openCard =
                page.querySelector(
                    '#open-verification-card-button'
                );


            const closeButton =
                page.querySelector(
                    '#close-verification-modal'
                );


            const cancelButton =
                page.querySelector(
                    '#cancel-verification'
                );


            const confirmButton =
                page.querySelector(
                    '#confirm-verification'
                );


            const quantity =
                page.querySelector(
                    '#verification-quantity'
                );


            const condition =
                page.querySelector(
                    '#verification-condition'
                );


            const notes =
                page.querySelector(
                    '#verification-notes'
                );


            const error =
                page.querySelector(
                    '#verification-error'
                );


            const openVerification =
                () => {
                    error.hidden =
                        true;


                    error.textContent =
                        '';


                    openModal(
                        verificationModal,
                        closeButton
                    );
                };


            openHeader?.addEventListener(
                'click',
                openVerification
            );


            openCard?.addEventListener(
                'click',
                openVerification
            );


            closeButton?.addEventListener(
                'click',
                () => {
                    closeModal(
                        verificationModal
                    );
                }
            );


            cancelButton?.addEventListener(
                'click',
                () => {
                    closeModal(
                        verificationModal
                    );
                }
            );


            verificationModal.addEventListener(
                'click',
                (event) => {
                    if (
                        event.target ===
                        verificationModal
                    ) {
                        closeModal(
                            verificationModal
                        );
                    }
                }
            );


            confirmButton?.addEventListener(
                'click',
                () => {
                    error.hidden =
                        true;


                    const amount =
                        Number(
                            quantity.value
                        );


                    const maximum =
                        Number(
                            quantity.max
                        );


                    if (
                        !Number.isSafeInteger(
                            amount
                        ) ||
                        amount < 1 ||
                        amount > maximum
                    ) {
                        error.textContent =
                            `Enter a verified quantity between 1 and ${maximum}.`;


                        error.hidden =
                            false;


                        quantity.focus();


                        return;
                    }


                    const conditionValue =
                        condition.value;


                    statusText.textContent =
                        'Verified';


                    statusText.className =
                        'dd-status-teal';


                    detailStatus.textContent =
                        'Verified';


                    conditionText.textContent =
                        conditionValue;


                    detailCondition.textContent =
                        conditionValue;


                    workflowCurrentStage.textContent =
                        'Current stage: Verified';


                    const verificationStep =
                        page.querySelector(
                            '#workflow-step-1'
                        );


                    const acceptedStep =
                        page.querySelector(
                            '#workflow-step-2'
                        );


                    const allocationStep =
                        page.querySelector(
                            '#workflow-step-3'
                        );


                    verificationStep?.classList.remove(
                        'is-current'
                    );


                    verificationStep?.classList.add(
                        'is-complete'
                    );


                    acceptedStep?.classList.add(
                        'is-complete'
                    );


                    allocationStep?.classList.add(
                        'is-current'
                    );


                    if (
                        verificationCardBody
                    ) {
                        verificationCardBody.innerHTML = `
                            <div
                                class="
                                    dd-verification-result
                                    is-accepted
                                "
                            >
                                <span
                                    class="dd-verification-result-icon"
                                    aria-hidden="true"
                                >
                                    <svg
                                        class="dd-icon"
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M12 3 19 6v5c0 4.3-2.7 7.9-7 10-4.3-2.1-7-5.7-7-10V6l7-3Z"></path>
                                        <path d="m8.8 12 2.1 2.1 4.5-5"></path>
                                    </svg>
                                </span>

                                <div>
                                    <strong>
                                        Accepted
                                    </strong>

                                    <span>
                                        Donation verified for logistics use
                                    </span>
                                </div>
                            </div>

                            <div class="dd-detail-grid">

                                <div class="dd-detail-item">
                                    <span>
                                        Verified by
                                    </span>

                                    <strong>
                                        Paul Roldan
                                    </strong>
                                </div>

                                <div class="dd-detail-item">
                                    <span>
                                        Verified quantity
                                    </span>

                                    <strong>
                                        ${amount}
                                    </strong>
                                </div>

                                <div class="dd-detail-item">
                                    <span>
                                        Condition
                                    </span>

                                    <strong>
                                        ${conditionValue}
                                    </strong>
                                </div>

                                <div class="dd-detail-item">
                                    <span>
                                        Date verified
                                    </span>

                                    <strong>
                                        September 14, 2026
                                    </strong>
                                </div>

                            </div>

                            <div
                                class="dd-note"
                                style="margin-top: 12px;"
                            >
                                ${
                                    notes.value.trim()
                                    ||
                                    'The donated resource was inspected and accepted for logistics use.'
                                }
                            </div>
                        `;
                    }


                    if (
                        stateCard
                    ) {
                        stateCard.className =
                            'dd-state-card is-verified';


                        stateCard.innerHTML = `
                            <span
                                class="dd-state-card-icon"
                                aria-hidden="true"
                            >
                                <svg
                                    class="dd-icon"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M4 6h7"></path>
                                    <path d="m8 3 3 3-3 3"></path>
                                    <path d="M20 18h-7"></path>
                                    <path d="m16 15-3 3 3 3"></path>
                                    <path d="M4 12h16"></path>
                                </svg>
                            </span>

                            <h2>
                                Ready for allocation
                            </h2>

                            <p>
                                This donation has been verified and accepted.
                                It can now be assigned to inventory or an
                                active project.
                            </p>
                        `;
                    }


                    const entry =
                        document.createElement(
                            'article'
                        );


                    entry.className =
                        'dd-timeline-item';


                    entry.innerHTML = `
                        <span
                            class="
                                dd-timeline-icon
                                is-green
                            "
                            aria-hidden="true"
                        >
                            <svg
                                class="dd-icon"
                                viewBox="0 0 24 24"
                            >
                                <path d="M12 3 19 6v5c0 4.3-2.7 7.9-7 10-4.3-2.1-7-5.7-7-10V6l7-3Z"></path>
                                <path d="m8.8 12 2.1 2.1 4.5-5"></path>
                            </svg>
                        </span>

                        <div class="dd-timeline-copy">

                            <strong>
                                Donation verified
                            </strong>

                            <p>
                                ${amount} ${
                                    amount === 1
                                        ? 'unit was'
                                        : 'units were'
                                } inspected and accepted in
                                ${conditionValue.toLowerCase()}
                                condition.
                            </p>

                            <span class="dd-timeline-date">
                                Just now
                            </span>

                        </div>
                    `;


                    timeline?.appendChild(
                        entry
                    );


                    openHeader?.remove();


                    closeModal(
                        verificationModal
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ALLOCATION
        |--------------------------------------------------------------------------
        */

        const allocationModal =
            page.querySelector(
                '#allocation-modal'
            );


        if (
            allocationModal
        ) {
            const openHeader =
                page.querySelector(
                    '#open-allocation-modal'
                );


            const openCard =
                page.querySelector(
                    '#open-allocation-card-button'
                );


            const closeButton =
                page.querySelector(
                    '#close-allocation-modal'
                );


            const cancelButton =
                page.querySelector(
                    '#cancel-allocation'
                );


            const confirmButton =
                page.querySelector(
                    '#confirm-allocation'
                );


            const destination =
                page.querySelector(
                    '#allocation-destination'
                );


            const projectField =
                page.querySelector(
                    '#allocation-project-field'
                );


            const projectSelect =
                page.querySelector(
                    '#allocation-project'
                );


            const allocationNotes =
                page.querySelector(
                    '#allocation-notes'
                );


            const openAllocation =
                () => {
                    openModal(
                        allocationModal,
                        closeButton
                    );
                };


            openHeader?.addEventListener(
                'click',
                openAllocation
            );


            openCard?.addEventListener(
                'click',
                openAllocation
            );


            closeButton?.addEventListener(
                'click',
                () => {
                    closeModal(
                        allocationModal
                    );
                }
            );


            cancelButton?.addEventListener(
                'click',
                () => {
                    closeModal(
                        allocationModal
                    );
                }
            );


            destination?.addEventListener(
                'change',
                () => {
                    projectField.hidden =
                        destination.value !==
                        'project';
                }
            );


            allocationModal.addEventListener(
                'click',
                (event) => {
                    if (
                        event.target ===
                        allocationModal
                    ) {
                        closeModal(
                            allocationModal
                        );
                    }
                }
            );


            confirmButton?.addEventListener(
                'click',
                () => {
                    const toInventory =
                        destination.value ===
                        'inventory';


                    const allocationLabel =
                        toInventory
                            ? 'Inventory'
                            : projectSelect.value;


                    const statusLabel =
                        toInventory
                            ? 'Added to Inventory'
                            : 'Allocated';


                    statusText.textContent =
                        statusLabel;


                    statusText.className =
                        toInventory
                            ? 'dd-status-green'
                            : 'dd-status-blue';


                    detailStatus.textContent =
                        statusLabel;


                    allocationText.textContent =
                        allocationLabel;


                    workflowCurrentStage.textContent =
                        `Current stage: ${statusLabel}`;


                    const allocationStep =
                        page.querySelector(
                            '#workflow-step-3'
                        );


                    const inventoryStep =
                        page.querySelector(
                            '#workflow-step-4'
                        );


                    if (
                        toInventory
                    ) {
                        allocationStep?.classList.remove(
                            'is-current'
                        );


                        allocationStep?.classList.add(
                            'is-complete'
                        );


                        inventoryStep?.classList.add(
                            'is-current'
                        );
                    } else {
                        allocationStep?.classList.add(
                            'is-current'
                        );


                        allocationStep?.setAttribute(
                            'data-stage',
                            'Allocated'
                        );
                    }


                    if (
                        stateCard
                    ) {
                        stateCard.className =
                            toInventory
                                ? 'dd-state-card is-inventory'
                                : 'dd-state-card is-allocated';


                        stateCard.innerHTML =
                            toInventory
                                ? `
                                    <span
                                        class="dd-state-card-icon"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            class="dd-icon"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="m12 3 9 5-9 5-9-5 9-5Z"></path>
                                            <path d="M3 8v9l9 5 9-5V8"></path>
                                            <path d="M12 13v9"></path>
                                        </svg>
                                    </span>

                                    <h2>
                                        Added to inventory
                                    </h2>

                                    <p>
                                        These donated resources have been
                                        integrated into the reusable logistics
                                        inventory.
                                    </p>
                                `
                                : `
                                    <span
                                        class="dd-state-card-icon"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            class="dd-icon"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="M4 6h7"></path>
                                            <path d="m8 3 3 3-3 3"></path>
                                            <path d="M20 18h-7"></path>
                                            <path d="m16 15-3 3 3 3"></path>
                                            <path d="M4 12h16"></path>
                                        </svg>
                                    </span>

                                    <h2>
                                        Donation allocated
                                    </h2>

                                    <p>
                                        These donated resources are now assigned
                                        to <strong>${projectSelect.value}</strong>.
                                    </p>
                                `;
                    }


                    const timelineDescription =
                        toInventory
                            ? 'Verified donated resources were added to the general logistics inventory.'
                            : `Verified donated resources were allocated to ${projectSelect.value}.`;


                    const entry =
                        document.createElement(
                            'article'
                        );


                    entry.className =
                        'dd-timeline-item';


                    entry.innerHTML = `
                        <span
                            class="
                                dd-timeline-icon
                                ${toInventory ? 'is-green' : 'is-blue'}
                            "
                            aria-hidden="true"
                        >
                            <svg
                                class="dd-icon"
                                viewBox="0 0 24 24"
                            >
                                ${
                                    toInventory
                                        ? `
                                            <path d="m12 3 9 5-9 5-9-5 9-5Z"></path>
                                            <path d="M3 8v9l9 5 9-5V8"></path>
                                            <path d="M12 13v9"></path>
                                        `
                                        : `
                                            <path d="M4 6h7"></path>
                                            <path d="m8 3 3 3-3 3"></path>
                                            <path d="M20 18h-7"></path>
                                            <path d="m16 15-3 3 3 3"></path>
                                            <path d="M4 12h16"></path>
                                        `
                                }
                            </svg>
                        </span>

                        <div class="dd-timeline-copy">

                            <strong>
                                ${
                                    toInventory
                                        ? 'Added to inventory'
                                        : 'Donation allocated'
                                }
                            </strong>

                            <p>
                                ${timelineDescription}
                                ${
                                    allocationNotes.value.trim()
                                        ? ` ${allocationNotes.value.trim()}`
                                        : ''
                                }
                            </p>

                            <span class="dd-timeline-date">
                                Just now
                            </span>

                        </div>
                    `;


                    timeline?.appendChild(
                        entry
                    );


                    openHeader?.remove();


                    closeModal(
                        allocationModal
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            (event) => {
                if (
                    event.key !==
                    'Escape'
                ) {
                    return;
                }


                const openModalElement =
                    page.querySelector(
                        '.dd-modal.is-open'
                    );


                if (
                    openModalElement
                ) {
                    closeModal(
                        openModalElement
                    );
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
            initializeDonationDetails,
            {
                once: true
            }
        );
    } else {
        initializeDonationDetails();
    }
})();
</script>
@endpush