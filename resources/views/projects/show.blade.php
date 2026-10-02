@extends('layouts.app')

@section('title', 'Project Logistics Details | PULSO Logistics Hub')

@php
    /*
    |--------------------------------------------------------------------------
    | PROJECT LOGISTICS RECORDS
    |--------------------------------------------------------------------------
    */

    $projectRecords = [

        /*
        |--------------------------------------------------------------------------
        | YOUTH LEADERSHIP SUMMIT
        |--------------------------------------------------------------------------
        */

        'PRJ-2026-0018' => [
            'project' => [
                'id' => 'PRJ-2026-0018',
                'request_id' => 'REQ-2026-0047',

                'name' => 'Youth Leadership Summit',
                'committee' => 'Events Committee',

                'coordinator' => 'Maria Santos',
                'coordinator_role' => 'Events Committee Head',

                'date' => 'September 12, 2026',
                'time' => '8:00 AM – 5:00 PM',
                'venue' => 'PULSO Activity Center',

                'priority' => 'High',
                'status' => 'Resource Allocation',
                'progress' => 58,

                'description' => 'Approved youth leadership activity currently undergoing logistics preparation and resource allocation.',

                'notes' => 'Complete equipment testing and resource preparation at least one day before the activity.',
            ],

            'request' => [
                'id' => 'REQ-2026-0047',
                'requested_by' => 'Events Committee',
                'requester' => 'Maria Santos',
                'submitted' => 'September 9, 2026',
                'approved' => 'September 10, 2026',
                'purpose' => 'Logistics support for the Youth Leadership Summit.',
                'status' => 'Approved',
            ],

            'resources' => [
                [
                    'name' => 'Portable Sound System',
                    'asset_id' => 'PULSO-AUD-001',
                    'requested' => 1,
                    'available' => 1,
                    'prepared' => 1,
                    'status' => 'Ready',
                    'tone' => 'green',
                    'issue' => null,
                ],
                [
                    'name' => 'Projector',
                    'asset_id' => 'PULSO-EQP-001',
                    'requested' => 1,
                    'available' => 1,
                    'prepared' => 1,
                    'status' => 'Ready',
                    'tone' => 'green',
                    'issue' => null,
                ],
                [
                    'name' => 'Monoblock Chairs',
                    'asset_id' => 'PULSO-FUR-001',
                    'requested' => 60,
                    'available' => 50,
                    'prepared' => 50,
                    'status' => 'Needs Resolution',
                    'tone' => 'amber',
                    'issue' => '10 additional chairs are still required.',
                ],
            ],

            'timeline' => [
                [
                    'title' => 'Logistics request approved',
                    'description' => 'REQ-2026-0047 was approved and qualified for project logistics coordination.',
                    'date' => 'Sep 10, 2026',
                    'time' => '9:20 AM',
                    'tone' => 'teal',
                    'icon' => 'request',
                ],
                [
                    'title' => 'Project logistics record created',
                    'description' => 'A logistics tracking record was created for the Youth Leadership Summit.',
                    'date' => 'Sep 10, 2026',
                    'time' => '9:45 AM',
                    'tone' => 'blue',
                    'icon' => 'project',
                ],
                [
                    'title' => 'Resource availability checked',
                    'description' => 'Requested resources were matched against current inventory availability.',
                    'date' => 'Sep 10, 2026',
                    'time' => '10:15 AM',
                    'tone' => 'teal',
                    'icon' => 'inventory',
                ],
                [
                    'title' => 'Resource shortage identified',
                    'description' => 'Only 50 of 60 requested monoblock chairs are currently available.',
                    'date' => 'Sep 10, 2026',
                    'time' => '10:40 AM',
                    'tone' => 'amber',
                    'icon' => 'alert',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | MEDICAL MISSION
        |--------------------------------------------------------------------------
        */

        'PRJ-2026-0017' => [
            'project' => [
                'id' => 'PRJ-2026-0017',
                'request_id' => 'REQ-2026-0046',

                'name' => 'Medical Mission',
                'committee' => 'Community Outreach',

                'coordinator' => 'Joshua Reyes',
                'coordinator_role' => 'Community Outreach Coordinator',

                'date' => 'September 13, 2026',
                'time' => '7:30 AM – 5:00 PM',
                'venue' => 'Barangay Covered Court',

                'priority' => 'High',
                'status' => 'Ready',
                'progress' => 86,

                'description' => 'Community medical mission with all assigned logistics resources prepared for deployment.',

                'notes' => 'Complete final equipment inspection before release to the activity team.',
            ],

            'request' => [
                'id' => 'REQ-2026-0046',
                'requested_by' => 'Community Outreach',
                'requester' => 'Joshua Reyes',
                'submitted' => 'September 10, 2026',
                'approved' => 'September 11, 2026',
                'purpose' => 'Provide logistics resources for the community medical mission.',
                'status' => 'Approved',
            ],

            'resources' => [
                [
                    'name' => 'Folding Tables',
                    'asset_id' => 'PULSO-FUR-002',
                    'requested' => 8,
                    'available' => 8,
                    'prepared' => 8,
                    'status' => 'Ready',
                    'tone' => 'green',
                    'issue' => null,
                ],
                [
                    'name' => 'Power Strip',
                    'asset_id' => 'PULSO-ELE-002',
                    'requested' => 4,
                    'available' => 4,
                    'prepared' => 4,
                    'status' => 'Ready',
                    'tone' => 'green',
                    'issue' => null,
                ],
                [
                    'name' => 'Large Event Tent',
                    'asset_id' => 'PULSO-EVT-001',
                    'requested' => 1,
                    'available' => 1,
                    'prepared' => 1,
                    'status' => 'Ready',
                    'tone' => 'green',
                    'issue' => null,
                ],
                [
                    'name' => 'Portable Sound System',
                    'asset_id' => 'PULSO-AUD-001',
                    'requested' => 1,
                    'available' => 1,
                    'prepared' => 1,
                    'status' => 'Ready',
                    'tone' => 'green',
                    'issue' => null,
                ],
            ],

            'timeline' => [
                [
                    'title' => 'Logistics request approved',
                    'description' => 'REQ-2026-0046 was approved for logistics preparation.',
                    'date' => 'Sep 11, 2026',
                    'time' => '8:10 AM',
                    'tone' => 'teal',
                    'icon' => 'request',
                ],
                [
                    'title' => 'Project logistics record created',
                    'description' => 'The Medical Mission was added to active logistics coordination.',
                    'date' => 'Sep 11, 2026',
                    'time' => '8:30 AM',
                    'tone' => 'blue',
                    'icon' => 'project',
                ],
                [
                    'title' => 'Resources allocated',
                    'description' => 'All requested logistics resources were successfully allocated.',
                    'date' => 'Sep 11, 2026',
                    'time' => '10:45 AM',
                    'tone' => 'teal',
                    'icon' => 'inventory',
                ],
                [
                    'title' => 'Project marked ready',
                    'description' => 'All assigned resources passed preparation and readiness checks.',
                    'date' => 'Sep 11, 2026',
                    'time' => '2:15 PM',
                    'tone' => 'green',
                    'icon' => 'check',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | COASTAL CLEAN-UP DRIVE
        |--------------------------------------------------------------------------
        */

        'PRJ-2026-0016' => [
            'project' => [
                'id' => 'PRJ-2026-0016',
                'request_id' => 'REQ-2026-0045',

                'name' => 'Coastal Clean-Up Drive',
                'committee' => 'Environment & Health',

                'coordinator' => 'Angela Cruz',
                'coordinator_role' => 'Environment & Health Coordinator',

                'date' => 'September 10, 2026',
                'time' => '6:00 AM – 4:00 PM',
                'venue' => 'Lakeside Community Area',

                'priority' => 'Normal',
                'status' => 'Ongoing',
                'progress' => 72,

                'description' => 'Environmental clean-up activity currently underway with assigned logistics resources deployed on site.',

                'notes' => 'Confirm all reusable equipment before pull-out and return after the activity.',
            ],

            'request' => [
                'id' => 'REQ-2026-0045',
                'requested_by' => 'Environment & Health',
                'requester' => 'Angela Cruz',
                'submitted' => 'September 9, 2026',
                'approved' => 'September 9, 2026',
                'purpose' => 'Logistics support for the Coastal Clean-Up Drive.',
                'status' => 'Approved',
            ],

            'resources' => [
                [
                    'name' => 'Large Event Tent',
                    'asset_id' => 'PULSO-EVT-001',
                    'requested' => 2,
                    'available' => 2,
                    'prepared' => 2,
                    'status' => 'Deployed',
                    'tone' => 'blue',
                    'issue' => null,
                ],
                [
                    'name' => 'Extension Cord 20m',
                    'asset_id' => 'PULSO-ELE-001',
                    'requested' => 3,
                    'available' => 3,
                    'prepared' => 3,
                    'status' => 'Deployed',
                    'tone' => 'blue',
                    'issue' => null,
                ],
                [
                    'name' => 'Cleaning Tool Kits',
                    'asset_id' => 'PULSO-CLN-001',
                    'requested' => 20,
                    'available' => 20,
                    'prepared' => 20,
                    'status' => 'Deployed',
                    'tone' => 'blue',
                    'issue' => null,
                ],
            ],

            'timeline' => [
                [
                    'title' => 'Logistics request approved',
                    'description' => 'REQ-2026-0045 was approved for project logistics coordination.',
                    'date' => 'Sep 9, 2026',
                    'time' => '9:15 AM',
                    'tone' => 'teal',
                    'icon' => 'request',
                ],
                [
                    'title' => 'Resources prepared',
                    'description' => 'All assigned resources were prepared for release.',
                    'date' => 'Sep 9, 2026',
                    'time' => '3:25 PM',
                    'tone' => 'teal',
                    'icon' => 'inventory',
                ],
                [
                    'title' => 'Resources released',
                    'description' => 'Logistics resources were released to the activity team.',
                    'date' => 'Sep 10, 2026',
                    'time' => '5:40 AM',
                    'tone' => 'blue',
                    'icon' => 'ongoing',
                ],
                [
                    'title' => 'Activity in progress',
                    'description' => 'The project is currently ongoing with deployed resources in use.',
                    'date' => 'Sep 10, 2026',
                    'time' => '8:00 AM',
                    'tone' => 'blue',
                    'icon' => 'project',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | VOLUNTEER ORIENTATION
        |--------------------------------------------------------------------------
        */

        'PRJ-2026-0015' => [
            'project' => [
                'id' => 'PRJ-2026-0015',
                'request_id' => 'REQ-2026-0041',

                'name' => 'Volunteer Orientation',
                'committee' => 'Volunteer Management',

                'coordinator' => 'Nicole Ramos',
                'coordinator_role' => 'Volunteer Management Coordinator',

                'date' => 'September 7, 2026',
                'time' => '8:00 AM – 5:00 PM',
                'venue' => 'PULSO Training Room',

                'priority' => 'Normal',
                'status' => 'Completed',
                'progress' => 100,

                'description' => 'Completed volunteer orientation with all deployed logistics resources already returned and accounted for.',

                'notes' => 'All released equipment was returned after the activity and checked by logistics.',
            ],

            'request' => [
                'id' => 'REQ-2026-0041',
                'requested_by' => 'Volunteer Management',
                'requester' => 'Nicole Ramos',
                'submitted' => 'September 6, 2026',
                'approved' => 'September 6, 2026',
                'purpose' => 'Provide equipment and event materials for volunteer orientation.',
                'status' => 'Approved',
            ],

            'resources' => [
                [
                    'name' => 'Wireless Microphone Set',
                    'asset_id' => 'PULSO-AUD-002',
                    'requested' => 1,
                    'available' => 1,
                    'prepared' => 1,
                    'status' => 'Returned',
                    'tone' => 'green',
                    'issue' => null,
                ],
                [
                    'name' => 'PULSO Event Banner',
                    'asset_id' => 'PULSO-EVT-002',
                    'requested' => 2,
                    'available' => 2,
                    'prepared' => 2,
                    'status' => 'Returned',
                    'tone' => 'green',
                    'issue' => null,
                ],
            ],

            'timeline' => [
                [
                    'title' => 'Logistics request approved',
                    'description' => 'REQ-2026-0041 was approved for the Volunteer Orientation.',
                    'date' => 'Sep 6, 2026',
                    'time' => '10:10 AM',
                    'tone' => 'teal',
                    'icon' => 'request',
                ],
                [
                    'title' => 'Resources prepared',
                    'description' => 'All assigned resources were prepared for the activity.',
                    'date' => 'Sep 6, 2026',
                    'time' => '3:20 PM',
                    'tone' => 'teal',
                    'icon' => 'inventory',
                ],
                [
                    'title' => 'Activity conducted',
                    'description' => 'Resources were deployed during the Volunteer Orientation.',
                    'date' => 'Sep 7, 2026',
                    'time' => '8:00 AM',
                    'tone' => 'blue',
                    'icon' => 'ongoing',
                ],
                [
                    'title' => 'Project completed',
                    'description' => 'All resources were returned and accounted for.',
                    'date' => 'Sep 7, 2026',
                    'time' => '5:36 PM',
                    'tone' => 'green',
                    'icon' => 'check',
                ],
            ],
        ],


        /*
        |--------------------------------------------------------------------------
        | STUDENT ASSISTANCE ORIENTATION
        |--------------------------------------------------------------------------
        */

        'PRJ-2026-0014' => [
            'project' => [
                'id' => 'PRJ-2026-0014',
                'request_id' => 'REQ-2026-0040',

                'name' => 'Student Assistance Orientation',
                'committee' => 'Education Committee',

                'coordinator' => 'Carlo Mendoza',
                'coordinator_role' => 'Education Committee Coordinator',

                'date' => 'September 6, 2026',
                'time' => '8:00 AM – 4:30 PM',
                'venue' => 'Community Learning Center',

                'priority' => 'Normal',
                'status' => 'Completed',
                'progress' => 100,

                'description' => 'Completed student orientation activity with the assigned projector returned after use.',

                'notes' => 'Projector was inspected after return and recorded in good condition.',
            ],

            'request' => [
                'id' => 'REQ-2026-0040',
                'requested_by' => 'Education Committee',
                'requester' => 'Carlo Mendoza',
                'submitted' => 'September 5, 2026',
                'approved' => 'September 5, 2026',
                'purpose' => 'Provide presentation equipment for the Student Assistance Orientation.',
                'status' => 'Approved',
            ],

            'resources' => [
                [
                    'name' => 'Projector',
                    'asset_id' => 'PULSO-EQP-001',
                    'requested' => 1,
                    'available' => 1,
                    'prepared' => 1,
                    'status' => 'Returned',
                    'tone' => 'green',
                    'issue' => null,
                ],
            ],

            'timeline' => [
                [
                    'title' => 'Logistics request approved',
                    'description' => 'REQ-2026-0040 was approved for logistics support.',
                    'date' => 'Sep 5, 2026',
                    'time' => '11:15 AM',
                    'tone' => 'teal',
                    'icon' => 'request',
                ],
                [
                    'title' => 'Projector prepared',
                    'description' => 'The assigned projector was inspected and prepared for release.',
                    'date' => 'Sep 5, 2026',
                    'time' => '2:30 PM',
                    'tone' => 'teal',
                    'icon' => 'inventory',
                ],
                [
                    'title' => 'Activity conducted',
                    'description' => 'The projector was deployed during the orientation.',
                    'date' => 'Sep 6, 2026',
                    'time' => '8:00 AM',
                    'tone' => 'blue',
                    'icon' => 'ongoing',
                ],
                [
                    'title' => 'Project completed',
                    'description' => 'The projector was returned and accounted for after the activity.',
                    'date' => 'Sep 6, 2026',
                    'time' => '5:15 PM',
                    'tone' => 'green',
                    'icon' => 'check',
                ],
            ],
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | SELECT CURRENT PROJECT
    |--------------------------------------------------------------------------
    */

    $requestedProjectId =
        request()->query(
            'id',
            'PRJ-2026-0018'
        );

    $selectedRecord =
        $projectRecords[$requestedProjectId]
        ?? $projectRecords['PRJ-2026-0018'];

    $project =
        $selectedRecord['project'];

    $sourceRequest =
        $selectedRecord['request'];

    $resources =
        $selectedRecord['resources'];

    $timeline =
        $selectedRecord['timeline'];


    /*
    |--------------------------------------------------------------------------
    | PROJECT WORKFLOW
    |--------------------------------------------------------------------------
    */

    $workflowStages = [
        [
            'label' => 'Approved Request',
            'description' => 'Logistics request approved',
            'icon' => 'request',
        ],
        [
            'label' => 'Resource Allocation',
            'description' => 'Resources being prepared',
            'icon' => 'inventory',
        ],
        [
            'label' => 'Ready',
            'description' => 'All resources prepared',
            'icon' => 'ready',
        ],
        [
            'label' => 'Ongoing',
            'description' => 'Resources deployed',
            'icon' => 'ongoing',
        ],
        [
            'label' => 'Completed',
            'description' => 'Resources accounted for',
            'icon' => 'complete',
        ],
    ];

    $currentStageIndex = match ($project['status']) {
        'Resource Allocation' => 1,
        'Ready' => 2,
        'Ongoing' => 3,
        'Completed' => 4,
        default => 1,
    };


    /*
    |--------------------------------------------------------------------------
    | RESOURCE ISSUE
    |--------------------------------------------------------------------------
    */

    $issueResourceIndex = null;

    foreach ($resources as $resourceIndex => $resource) {
        if (
            !empty($resource['issue'])
            || $resource['prepared'] < $resource['requested']
        ) {
            $issueResourceIndex =
                $resourceIndex;

            break;
        }
    }

    $hasResourceIssue =
        $issueResourceIndex !== null;

    $issueResource =
        $hasResourceIssue
            ? $resources[$issueResourceIndex]
            : null;

    $resourceShortage =
        $hasResourceIssue
            ? max(
                0,
                $issueResource['requested']
                - $issueResource['prepared']
            )
            : 0;


    /*
    |--------------------------------------------------------------------------
    | STATUS HELPERS
    |--------------------------------------------------------------------------
    */

    $statusTone = match ($project['status']) {
        'Resource Allocation' => 'pink',
        'Ready' => 'teal',
        'Ongoing' => 'blue',
        'Completed' => 'green',
        default => 'navy',
    };

    $stateTitle = match ($project['status']) {
        'Resource Allocation' => 'Resource preparation in progress',
        'Ready' => 'Resources ready',
        'Ongoing' => 'Project currently ongoing',
        'Completed' => 'Project completed',
        default => 'Project logistics',
    };

    $stateDescription = match ($project['status']) {
        'Resource Allocation' => 'The project is still in resource preparation and allocation.',
        'Ready' => 'All assigned logistics resources are prepared for deployment.',
        'Ongoing' => 'Assigned logistics resources are currently deployed for this activity.',
        'Completed' => 'The activity is complete and its reusable logistics resources have been accounted for.',
        default => '',
    };
@endphp


@push('styles')
<style>
    .project-detail-page {
        --pd-navy: #10263d;
        --pd-copy: #496580;
        --pd-muted: #71899c;
        --pd-line: #d5e5ee;

        --pd-teal: #007780;
        --pd-pink: #b90c61;
        --pd-blue: #365f8d;
        --pd-amber: #895408;
        --pd-green: #2b735d;
        --pd-red: #ad343d;

        display: grid;
        gap: 22px;

        width: 100%;
        min-width: 0;

        color: var(--pd-navy);

        container-name: project-detail;
        container-type: inline-size;
    }

    .project-detail-page *,
    .project-detail-page *::before,
    .project-detail-page *::after {
        box-sizing: border-box;
    }

    .project-detail-page [hidden] {
        display: none !important;
    }


    /* ================================================================
       ICONS
       ================================================================ */

    .pd-icon {
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

    .pd-icon-library {
        position: absolute;

        width: 0;
        height: 0;

        overflow: hidden;

        pointer-events: none;
    }


    /* ================================================================
       PAGE HEADING
       ================================================================ */

    .pd-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 24px;

        min-width: 0;
    }

    .pd-heading-copy {
        min-width: 0;
    }

    .pd-back {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 12px;

        color: #55758b;

        font-size: 10.5px;
        font-weight: 700;

        text-decoration: none;
    }

    .pd-back:hover {
        color: var(--pd-teal);
    }

    .pd-back .pd-icon {
        width: 14px;
        height: 14px;
    }

    .pd-eyebrow {
        margin: 0 0 7px;

        color: var(--pd-teal);

        font-size: 10px;
        font-weight: 850;

        letter-spacing: .14em;

        text-transform: uppercase;
    }

    .pd-heading h1 {
        margin: 0;

        color: var(--pd-navy);

        font-size: clamp(28px, 3vw, 40px);
        font-weight: 850;
        line-height: 1.08;

        letter-spacing: -.05em;
    }

    .pd-heading-description {
        max-width: 700px;

        margin: 8px 0 0;

        color: var(--pd-copy);

        font-size: 13px;
        line-height: 1.65;
    }

    .pd-heading-actions {
        display: flex;
        align-items: center;

        gap: 9px;

        flex-shrink: 0;
    }


    /* ================================================================
       BUTTONS
       ================================================================ */

    .pd-button {
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
                #f7fbfd,
                #e5eef3
            );

        color: #4d6a7f;

        box-shadow:
            4px 5px 10px rgba(75, 108, 129, .09),
            -3px -3px 7px rgba(255, 255, 255, .78);

        font: inherit;
        font-size: 10.5px;
        font-weight: 750;

        text-decoration: none;

        cursor: pointer;
    }

    .pd-button:hover {
        color: var(--pd-teal);
    }

    .pd-button .pd-icon {
        width: 15px;
        height: 15px;
    }

    .pd-button-primary {
        border-color: #c4f4f6;

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

    .pd-button-primary:hover {
        color: #ffffff;
    }


    /* ================================================================
       HERO
       ================================================================ */

    .pd-hero {
        display: grid;

        grid-template-columns:
            minmax(300px, .95fr)
            minmax(560px, 1.45fr);

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

    .pd-hero-main {
        display: flex;
        align-items: center;

        gap: 16px;

        min-width: 0;
    }

    .pd-project-symbol {
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
                #e2f7f8,
                #caeaed
            );

        color: var(--pd-teal);

        box-shadow:
            4px 5px 11px rgba(76, 110, 130, .09),
            -3px -3px 8px rgba(255, 255, 255, .76);
    }

    .pd-project-symbol .pd-icon {
        width: 25px;
        height: 25px;
    }

    .pd-hero-copy {
        min-width: 0;
    }

    .pd-project-id {
        display: block;

        color: #758c9d;

        font-size: 9.5px;
        font-weight: 700;
    }

    .pd-project-name {
        margin: 4px 0 0;

        color: #18344c;

        font-size: 20px;
        font-weight: 820;
        line-height: 1.2;

        letter-spacing: -.035em;
    }

    .pd-project-meta {
        display: block;

        margin-top: 5px;

        color: #59768a;

        font-size: 11px;
    }

    .pd-hero-stats {
        display: grid;

        grid-template-columns:
            repeat(
                4,
                minmax(0, 1fr)
            );

        gap: 8px;

        min-width: 0;
    }

    .pd-hero-stat {
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

    .pd-hero-stat span {
        display: block;

        overflow: hidden;

        color: #71899c;

        font-size: 8.5px;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .pd-hero-stat strong {
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

    .pd-status-text-pink {
        color: var(--pd-pink) !important;
    }

    .pd-status-text-teal {
        color: var(--pd-teal) !important;
    }

    .pd-status-text-blue {
        color: var(--pd-blue) !important;
    }

    .pd-status-text-green {
        color: var(--pd-green) !important;
    }


    /* ================================================================
       WORKFLOW
       ================================================================ */

    .pd-workflow {
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

    .pd-section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 15px;
    }

    .pd-section-heading h2 {
        margin: 0;

        color: #29475f;

        font-size: 13px;
        font-weight: 790;
    }

    .pd-section-heading span {
        color: #7c92a2;

        font-size: 9.5px;
    }

    .pd-workflow-scroll {
        overflow-x: auto;
    }

    .pd-workflow-steps {
        display: grid;

        grid-template-columns:
            repeat(
                5,
                minmax(150px, 1fr)
            );

        gap: 9px;

        min-width: 810px;
    }

    .pd-workflow-step {
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

    .pd-workflow-step.is-complete {
        background:
            linear-gradient(
                145deg,
                #e0f3eb,
                #edf8f3
            );

        color: var(--pd-green);
    }

    .pd-workflow-step.is-current {
        background:
            linear-gradient(
                145deg,
                #f8e4ee,
                #f3d6e4
            );

        color: var(--pd-pink);
    }

    .pd-workflow-step.is-current[data-stage="Ready"] {
        background:
            linear-gradient(
                145deg,
                #dff4f4,
                #d2ecee
            );

        color: var(--pd-teal);
    }

    .pd-workflow-step.is-current[data-stage="Ongoing"] {
        background:
            linear-gradient(
                145deg,
                #e5eef8,
                #d9e5f2
            );

        color: var(--pd-blue);
    }

    .pd-workflow-step.is-current[data-stage="Completed"] {
        background:
            linear-gradient(
                145deg,
                #e0f3eb,
                #d1e9df
            );

        color: var(--pd-green);
    }

    .pd-step-icon {
        display: grid;
        place-items: center;

        width: 31px;
        height: 31px;

        flex: 0 0 31px;

        border: 1px solid rgba(255, 255, 255, .92);
        border-radius: 10px;

        background: rgba(255, 255, 255, .42);
    }

    .pd-step-icon .pd-icon {
        width: 14px;
        height: 14px;
    }

    .pd-step-copy strong {
        display: block;

        font-size: 10px;
        font-weight: 780;
    }

    .pd-step-copy span {
        display: block;

        margin-top: 2px;

        color: #7b91a1;

        font-size: 8.3px;
        line-height: 1.35;
    }


    /* ================================================================
       CONTENT GRID
       ================================================================ */

    .pd-content-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.45fr)
            minmax(300px, .55fr);

        align-items: start;

        gap: 18px;
    }

    .pd-main-column,
    .pd-side-column {
        display: grid;

        gap: 18px;

        min-width: 0;
    }


    /* ================================================================
       CARDS
       ================================================================ */

    .pd-card {
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

    .pd-card-head {
        display: flex;
        align-items: center;

        gap: 11px;

        padding: 16px 18px;

        border-bottom: 1px solid rgba(207, 225, 234, .82);
    }

    .pd-card-head-icon {
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

        color: var(--pd-teal);
    }

    .pd-card-head-icon.is-pink {
        background:
            linear-gradient(
                145deg,
                #fae8f1,
                #efd5e1
            );

        color: var(--pd-pink);
    }

    .pd-card-head-icon .pd-icon {
        width: 16px;
        height: 16px;
    }

    .pd-card-head-copy h2 {
        margin: 0;

        color: #29475f;

        font-size: 12px;
        font-weight: 790;
    }

    .pd-card-head-copy p {
        margin: 3px 0 0;

        color: #7a91a1;

        font-size: 9px;
    }

    .pd-card-body {
        padding: 18px;
    }


    /* ================================================================
       DETAILS
       ================================================================ */

    .pd-detail-grid {
        display: grid;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap: 11px;
    }

    .pd-detail-item {
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

    .pd-detail-item span {
        display: block;

        color: #7c92a2;

        font-size: 8.8px;
    }

    .pd-detail-item strong {
        display: block;

        margin-top: 4px;

        color: #29475f;

        font-size: 10.8px;
        line-height: 1.45;
    }


    /* ================================================================
       RESOURCE TABLE
       ================================================================ */

    .pd-resource-table-wrap {
        overflow-x: auto;
    }

    .pd-resource-table {
        width: 100%;
        min-width: 670px;

        border-collapse: separate;
        border-spacing: 0;
    }

    .pd-resource-table th {
        padding: 10px 11px;

        border-bottom: 1px solid #d2e2ea;

        color: #617d91;

        font-size: 8.5px;
        font-weight: 800;

        text-align: left;

        text-transform: uppercase;
    }

    .pd-resource-table td {
        padding: 12px 11px;

        border-bottom: 1px solid rgba(214, 229, 237, .76);

        color: #456279;

        font-size: 10px;

        vertical-align: middle;
    }

    .pd-resource-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .pd-resource-name strong {
        display: block;

        color: #29475f;

        font-size: 10.8px;
    }

    .pd-resource-name span {
        display: block;

        margin-top: 3px;

        color: #8195a4;

        font-size: 8.5px;
    }

    .pd-resource-count {
        font-weight: 750;

        font-variant-numeric: tabular-nums;
    }

    .pd-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 27px;

        padding: 4px 9px;

        border: 1px solid rgba(255, 255, 255, .76);
        border-radius: 9px;

        font-size: 9px;
        font-weight: 750;

        white-space: nowrap;
    }

    .pd-badge-green {
        background:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );

        color: var(--pd-green);
    }

    .pd-badge-amber {
        background:
            linear-gradient(
                145deg,
                #fff3df,
                #f8e4bf
            );

        color: var(--pd-amber);
    }

    .pd-badge-blue {
        background:
            linear-gradient(
                145deg,
                #e7eef8,
                #d7e3f1
            );

        color: var(--pd-blue);
    }

    .pd-badge-teal {
        background:
            linear-gradient(
                145deg,
                #dff4f5,
                #ccebed
            );

        color: var(--pd-teal);
    }

    .pd-resource-issue {
        display: block;

        margin-top: 4px;

        color: var(--pd-amber) !important;

        font-size: 8.5px;
    }


    /* ================================================================
       SOURCE REQUEST
       ================================================================ */

    .pd-request-card {
        display: flex;
        align-items: flex-start;

        gap: 12px;

        padding: 13px;

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e4f4f6,
                #edf8f9
            );

        box-shadow:
            inset 2px 2px 5px rgba(74, 112, 131, .05),
            inset -2px -2px 5px rgba(255, 255, 255, .72);
    }

    .pd-request-symbol {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border: 1px solid rgba(255, 255, 255, .82);
        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #d9f1f3,
                #c8e8eb
            );

        color: var(--pd-teal);
    }

    .pd-request-symbol .pd-icon {
        width: 17px;
        height: 17px;
    }

    .pd-request-copy {
        min-width: 0;

        flex: 1;
    }

    .pd-request-copy strong {
        display: block;

        color: #29475f;

        font-size: 11px;
    }

    .pd-request-copy span {
        display: block;

        margin-top: 3px;

        color: #6e8798;

        font-size: 8.8px;
        line-height: 1.5;
    }

    .pd-request-link {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        margin-top: 10px;

        color: var(--pd-teal);

        font-size: 9px;
        font-weight: 750;

        text-decoration: none;
    }

    .pd-request-link .pd-icon {
        width: 13px;
        height: 13px;
    }


    /* ================================================================
       STATE / ATTENTION CARD
       ================================================================ */

    .pd-state-card {
        padding: 16px;

        border: 1px solid rgba(255, 255, 255, .96);
        border-radius: 19px;

        box-shadow:
            5px 7px 14px rgba(80, 114, 135, .09),
            -4px -4px 10px rgba(255, 255, 255, .7);
    }

    .pd-state-card.is-attention {
        background:
            linear-gradient(
                145deg,
                #fff3df,
                #f7e4c4
            );

        color: #775e39;
    }

    .pd-state-card.is-ready {
        background:
            linear-gradient(
                145deg,
                #e2f5f5,
                #d2ebec
            );

        color: #397277;
    }

    .pd-state-card.is-ongoing {
        background:
            linear-gradient(
                145deg,
                #e9f0f8,
                #dce8f3
            );

        color: #456889;
    }

    .pd-state-card.is-completed {
        background:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );

        color: #356c5a;
    }

    .pd-state-icon {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        margin-bottom: 11px;

        border-radius: 12px;

        background: rgba(255, 255, 255, .43);
    }

    .pd-state-icon .pd-icon {
        width: 18px;
        height: 18px;
    }

    .pd-state-card.is-attention .pd-state-icon {
        color: var(--pd-amber);
    }

    .pd-state-card.is-ready .pd-state-icon {
        color: var(--pd-teal);
    }

    .pd-state-card.is-ongoing .pd-state-icon {
        color: var(--pd-blue);
    }

    .pd-state-card.is-completed .pd-state-icon {
        color: var(--pd-green);
    }

    .pd-state-card h2 {
        margin: 0;

        color: currentColor;

        font-size: 13px;
        font-weight: 800;
    }

    .pd-state-card p {
        margin: 6px 0 0;

        color: currentColor;

        font-size: 9.8px;
        line-height: 1.55;
    }

    .pd-state-card .pd-button {
        width: 100%;

        margin-top: 14px;
    }


    /* ================================================================
       NOTES
       ================================================================ */

    .pd-note {
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
       TIMELINE
       ================================================================ */

    .pd-timeline {
        display: grid;
    }

    .pd-timeline-item {
        position: relative;

        display: grid;

        grid-template-columns:
            34px
            minmax(0, 1fr);

        gap: 11px;

        padding-bottom: 17px;
    }

    .pd-timeline-item:last-child {
        padding-bottom: 0;
    }

    .pd-timeline-item:not(:last-child)::before {
        position: absolute;

        top: 35px;
        bottom: 1px;
        left: 16px;

        width: 2px;

        background: #d7e6ed;

        content: "";
    }

    .pd-timeline-icon {
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

    .pd-timeline-icon.is-teal {
        background:
            linear-gradient(
                145deg,
                #dff4f5,
                #ccebed
            );

        color: var(--pd-teal);
    }

    .pd-timeline-icon.is-blue {
        background:
            linear-gradient(
                145deg,
                #e7eef8,
                #d7e3f1
            );

        color: var(--pd-blue);
    }

    .pd-timeline-icon.is-amber {
        background:
            linear-gradient(
                145deg,
                #fff2df,
                #f4e1c3
            );

        color: var(--pd-amber);
    }

    .pd-timeline-icon.is-green {
        background:
            linear-gradient(
                145deg,
                #e4f3ed,
                #d3e9e0
            );

        color: var(--pd-green);
    }

    .pd-timeline-icon .pd-icon {
        width: 15px;
        height: 15px;
    }

    .pd-timeline-copy strong {
        display: block;

        color: #29475f;

        font-size: 10.5px;
    }

    .pd-timeline-copy p {
        margin: 3px 0 0;

        color: #748b9b;

        font-size: 9px;
        line-height: 1.5;
    }

    .pd-timeline-date {
        display: block;

        margin-top: 5px;

        color: #98aab6;

        font-size: 8px;
    }


    /* ================================================================
       MODAL
       ================================================================ */

    .pd-modal {
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

    .pd-modal.is-open {
        display: flex;
    }

    .pd-modal-panel {
        width: min(100%, 580px);

        overflow: hidden;

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

    .pd-modal-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 15px;

        padding: 18px 19px;

        border-bottom: 1px solid var(--pd-line);
    }

    .pd-modal-head h2 {
        margin: 0;

        color: #29475f;

        font-size: 15px;
        font-weight: 800;
    }

    .pd-modal-head p {
        margin: 4px 0 0;

        color: #7b91a1;

        font-size: 9.5px;
    }

    .pd-modal-close {
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

    .pd-modal-close .pd-icon {
        width: 15px;
        height: 15px;
    }

    .pd-modal-body {
        padding: 18px 19px;
    }

    .pd-modal-message {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        margin-bottom: 15px;

        padding: 11px 12px;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #fff1df,
                #f8e6c7
            );

        color: #765b35;

        font-size: 9.5px;
        line-height: 1.55;
    }

    .pd-modal-message .pd-icon {
        width: 15px;
        height: 15px;

        flex: 0 0 15px;

        margin-top: 1px;

        color: var(--pd-amber);
    }

    .pd-field + .pd-field {
        margin-top: 13px;
    }

    .pd-field label {
        display: block;

        margin-bottom: 6px;

        color: #45647a;

        font-size: 9.5px;
        font-weight: 750;
    }

    .pd-control {
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

    textarea.pd-control {
        min-height: 78px;

        resize: vertical;
    }

    .pd-modal-error {
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

    .pd-modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 9px;

        padding: 15px 19px 18px;

        border-top: 1px solid var(--pd-line);
    }


    /* ================================================================
       RESPONSIVE
       ================================================================ */

    @container project-detail (max-width: 1080px) {
        .pd-hero {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .pd-hero-stats {
            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );
        }
    }

    @container project-detail (max-width: 900px) {
        .pd-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .pd-content-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }
    }

    @container project-detail (max-width: 700px) {
        .pd-hero-stats {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }
    }

    @container project-detail (max-width: 600px) {
        .pd-heading-actions {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);

            width: 100%;
        }

        .pd-heading-actions .pd-button {
            width: 100%;
        }

        .pd-detail-grid {
            grid-template-columns:
                minmax(0, 1fr);
        }

        .pd-modal-footer {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr);
        }

        .pd-modal-footer .pd-button {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')
<div
    id="project-detail-page"
    class="project-detail-page"
>

    <svg
        class="pd-icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <symbol id="pd-icon-back" viewBox="0 0 24 24">
            <path d="M19 12H5"/>
            <path d="m11 6-6 6 6 6"/>
        </symbol>

        <symbol id="pd-icon-project" viewBox="0 0 24 24">
            <path d="M4 5h6l2 2h8v12H4Z"/>
            <path d="M8 12h8"/>
            <path d="M12 9v6"/>
        </symbol>

        <symbol id="pd-icon-request" viewBox="0 0 24 24">
            <rect x="5" y="3" width="14" height="18" rx="2"/>
            <path d="M9 7h6"/>
            <path d="M9 11h6"/>
            <path d="M9 15h4"/>
        </symbol>

        <symbol id="pd-icon-inventory" viewBox="0 0 24 24">
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
        </symbol>

        <symbol id="pd-icon-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="pd-icon-alert" viewBox="0 0 24 24">
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

        <symbol id="pd-icon-ready" viewBox="0 0 24 24">
            <path d="M4 12.5 9 17l11-11"/>
        </symbol>

        <symbol id="pd-icon-ongoing" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7Z"/>
        </symbol>

        <symbol id="pd-icon-complete" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="pd-icon-user" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 21a8 8 0 0 1 16 0"/>
        </symbol>

        <symbol id="pd-icon-calendar" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="16" rx="2"/>
            <path d="M16 3v4"/>
            <path d="M8 3v4"/>
            <path d="M3 10h18"/>
        </symbol>

        <symbol id="pd-icon-note" viewBox="0 0 24 24">
            <path d="M5 4h14v16H5Z"/>
            <path d="M9 8h6"/>
            <path d="M9 12h6"/>
            <path d="M9 16h4"/>
        </symbol>

        <symbol id="pd-icon-arrow" viewBox="0 0 24 24">
            <path d="M5 12h14"/>
            <path d="m15 8 4 4-4 4"/>
        </symbol>

        <symbol id="pd-icon-x" viewBox="0 0 24 24">
            <path d="m6 6 12 12"/>
            <path d="m18 6-12 12"/>
        </symbol>
    </svg>


    <header class="pd-heading">

        <div class="pd-heading-copy">

            <a
                href="{{ route('projects.index') }}"
                class="pd-back"
            >
                <svg
                    class="pd-icon"
                    aria-hidden="true"
                >
                    <use href="#pd-icon-back"/>
                </svg>

                Back to projects
            </a>


            <p class="pd-eyebrow">
                Project logistics tracking
            </p>


            <h1>
                Project Logistics Details
            </h1>


            <p class="pd-heading-description">
                Monitor the approved activity's resource preparation,
                readiness, deployment, and logistics progress.
            </p>

        </div>


        <div class="pd-heading-actions">

            <a
                href="{{ route('requests.show', ['id' => $sourceRequest['id']]) }}"
                class="pd-button"
            >
                <svg
                    class="pd-icon"
                    aria-hidden="true"
                >
                    <use href="#pd-icon-request"/>
                </svg>

                View source request
            </a>


            <a
                href="{{ route('projects.index') }}"
                class="
                    pd-button
                    pd-button-primary
                "
            >
                Project register
            </a>

        </div>

    </header>


    <section class="pd-hero">

        <div class="pd-hero-main">

            <span
                class="pd-project-symbol"
                aria-hidden="true"
            >
                <svg class="pd-icon">
                    <use href="#pd-icon-project"/>
                </svg>
            </span>


            <div class="pd-hero-copy">

                <span class="pd-project-id">
                    {{ $project['id'] }}
                </span>

                <h2 class="pd-project-name">
                    {{ $project['name'] }}
                </h2>

                <span class="pd-project-meta">
                    {{ $project['committee'] }}
                    ·
                    {{ $project['coordinator'] }}
                </span>

            </div>

        </div>


        <div class="pd-hero-stats">

            <div class="pd-hero-stat">

                <span>
                    Logistics status
                </span>

                <strong
                    id="hero-project-status"
                    class="pd-status-text-{{ $statusTone }}"
                >
                    {{ $project['status'] }}
                </strong>

            </div>


            <div class="pd-hero-stat">

                <span>
                    Progress
                </span>

                <strong id="hero-project-progress">
                    {{ $project['progress'] }}%
                </strong>

            </div>


            <div class="pd-hero-stat">

                <span>
                    Priority
                </span>

                <strong>
                    {{ $project['priority'] }}
                </strong>

            </div>


            <div class="pd-hero-stat">

                <span>
                    Source request
                </span>

                <strong>
                    {{ $project['request_id'] }}
                </strong>

            </div>

        </div>

    </section>


    <section class="pd-workflow">

        <div class="pd-section-heading">

            <h2>
                Project logistics workflow
            </h2>

            <span id="workflow-current-stage">
                Current stage: {{ $project['status'] }}
            </span>

        </div>


        <div class="pd-workflow-scroll custom-scrollbar">

            <div class="pd-workflow-steps">

                @foreach ($workflowStages as $stageIndex => $stage)

                    @php
                        $stageClass = '';

                        if ($stageIndex < $currentStageIndex) {
                            $stageClass = 'is-complete';
                        }

                        if ($stageIndex === $currentStageIndex) {
                            $stageClass = 'is-current';
                        }
                    @endphp

                    <article
                        id="workflow-step-{{ $stageIndex }}"
                        class="
                            pd-workflow-step
                            {{ $stageClass }}
                        "
                        data-stage="{{ $stage['label'] }}"
                    >

                        <span class="pd-step-icon">

                            <svg class="pd-icon">
                                <use href="#pd-icon-{{ $stage['icon'] }}"/>
                            </svg>

                        </span>


                        <div class="pd-step-copy">

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


    <div class="pd-content-grid">

        <div class="pd-main-column">

            <section class="pd-card">

                <header class="pd-card-head">

                    <span
                        class="pd-card-head-icon"
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">
                            <use href="#pd-icon-project"/>
                        </svg>
                    </span>


                    <div class="pd-card-head-copy">

                        <h2>
                            Activity information
                        </h2>

                        <p>
                            Confirmed project and schedule details
                        </p>

                    </div>

                </header>


                <div class="pd-card-body">

                    <div class="pd-detail-grid">

                        <div class="pd-detail-item">
                            <span>
                                Project ID
                            </span>

                            <strong>
                                {{ $project['id'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Committee
                            </span>

                            <strong>
                                {{ $project['committee'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Coordinator
                            </span>

                            <strong>
                                {{ $project['coordinator'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Coordinator role
                            </span>

                            <strong>
                                {{ $project['coordinator_role'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Activity date
                            </span>

                            <strong>
                                {{ $project['date'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Schedule
                            </span>

                            <strong>
                                {{ $project['time'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Venue
                            </span>

                            <strong>
                                {{ $project['venue'] }}
                            </strong>
                        </div>


                        <div class="pd-detail-item">
                            <span>
                                Priority
                            </span>

                            <strong>
                                {{ $project['priority'] }}
                            </strong>
                        </div>

                    </div>

                </div>

            </section>


            <section class="pd-card">

                <header class="pd-card-head">

                    <span
                        class="
                            pd-card-head-icon
                            is-pink
                        "
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">
                            <use href="#pd-icon-inventory"/>
                        </svg>
                    </span>


                    <div class="pd-card-head-copy">

                        <h2>
                            Resource coordination
                        </h2>

                        <p>
                            Requested, available, and prepared resources
                        </p>

                    </div>

                </header>


                <div class="pd-card-body">

                    <div
                        class="
                            pd-resource-table-wrap
                            custom-scrollbar
                        "
                    >

                        <table class="pd-resource-table">

                            <thead>
                                <tr>

                                    <th>
                                        Resource
                                    </th>

                                    <th>
                                        Requested
                                    </th>

                                    <th>
                                        Available
                                    </th>

                                    <th>
                                        Prepared
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                </tr>
                            </thead>


                            <tbody>

                                @foreach ($resources as $index => $resource)

                                    <tr
                                        data-resource-row="{{ $index }}"
                                        data-resource-requested="{{ $resource['requested'] }}"
                                    >

                                        <td>

                                            <div class="pd-resource-name">

                                                <strong>
                                                    {{ $resource['name'] }}
                                                </strong>

                                                <span>
                                                    {{ $resource['asset_id'] }}
                                                </span>


                                                @if ($resource['issue'])

                                                    <span
                                                        class="pd-resource-issue"
                                                        data-resource-issue
                                                    >
                                                        {{ $resource['issue'] }}
                                                    </span>

                                                @endif

                                            </div>

                                        </td>


                                        <td>

                                            <span class="pd-resource-count">
                                                {{ $resource['requested'] }}
                                            </span>

                                        </td>


                                        <td>

                                            <span
                                                class="pd-resource-count"
                                                data-resource-available
                                            >
                                                {{ $resource['available'] }}
                                            </span>

                                        </td>


                                        <td>

                                            <span
                                                class="pd-resource-count"
                                                data-resource-prepared
                                            >
                                                {{ $resource['prepared'] }}
                                            </span>

                                        </td>


                                        <td>

                                            <span
                                                class="
                                                    pd-badge
                                                    pd-badge-{{ $resource['tone'] }}
                                                "
                                                data-resource-status
                                            >
                                                {{ $resource['status'] }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </section>


            <section class="pd-card">

                <header class="pd-card-head">

                    <span
                        class="
                            pd-card-head-icon
                            is-pink
                        "
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">
                            <use href="#pd-icon-note"/>
                        </svg>
                    </span>


                    <div class="pd-card-head-copy">

                        <h2>
                            Logistics notes
                        </h2>

                        <p>
                            Preparation instructions and remarks
                        </p>

                    </div>

                </header>


                <div class="pd-card-body">

                    <div class="pd-note">
                        {{ $project['notes'] }}
                    </div>

                </div>

            </section>

        </div>


        <aside class="pd-side-column">

            <section class="pd-card">

                <header class="pd-card-head">

                    <span
                        class="pd-card-head-icon"
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">
                            <use href="#pd-icon-request"/>
                        </svg>
                    </span>


                    <div class="pd-card-head-copy">

                        <h2>
                            Source request
                        </h2>

                        <p>
                            Approved logistics request
                        </p>

                    </div>

                </header>


                <div class="pd-card-body">

                    <div class="pd-request-card">

                        <span
                            class="pd-request-symbol"
                            aria-hidden="true"
                        >
                            <svg class="pd-icon">
                                <use href="#pd-icon-request"/>
                            </svg>
                        </span>


                        <div class="pd-request-copy">

                            <strong>
                                {{ $sourceRequest['id'] }}
                            </strong>

                            <span>
                                Requested by
                                {{ $sourceRequest['requested_by'] }}
                            </span>

                            <span>
                                Requester:
                                {{ $sourceRequest['requester'] }}
                            </span>

                            <span>
                                Approved
                                {{ $sourceRequest['approved'] }}
                            </span>


                            <a
                                href="{{ route('requests.show', ['id' => $sourceRequest['id']]) }}"
                                class="pd-request-link"
                            >
                                Open request details

                                <svg
                                    class="pd-icon"
                                    aria-hidden="true"
                                >
                                    <use href="#pd-icon-arrow"/>
                                </svg>
                            </a>

                        </div>

                    </div>

                </div>

            </section>


            @if ($hasResourceIssue)

                <section
                    id="project-state-card"
                    class="
                        pd-state-card
                        is-attention
                    "
                >

                    <span
                        class="pd-state-icon"
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">
                            <use href="#pd-icon-alert"/>
                        </svg>
                    </span>


                    <h2>
                        Resource issue needs attention
                    </h2>


                    <p>
                        {{ $issueResource['issue'] }}
                        Resolve the shortage before marking this
                        project as ready.
                    </p>


                    <button
                        id="open-resolution-modal"
                        type="button"
                        class="pd-button"
                    >
                        Resolve resource issue
                    </button>

                </section>

            @else

                <section
                    id="project-state-card"
                    class="
                        pd-state-card

                        @if ($project['status'] === 'Ready')
                            is-ready
                        @elseif ($project['status'] === 'Ongoing')
                            is-ongoing
                        @elseif ($project['status'] === 'Completed')
                            is-completed
                        @else
                            is-ready
                        @endif
                    "
                >

                    <span
                        class="pd-state-icon"
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">

                            @if ($project['status'] === 'Ongoing')
                                <use href="#pd-icon-ongoing"/>
                            @else
                                <use href="#pd-icon-check"/>
                            @endif

                        </svg>
                    </span>


                    <h2>
                        {{ $stateTitle }}
                    </h2>


                    <p>
                        {{ $stateDescription }}
                    </p>

                </section>

            @endif


            <section class="pd-card">

                <header class="pd-card-head">

                    <span
                        class="pd-card-head-icon"
                        aria-hidden="true"
                    >
                        <svg class="pd-icon">
                            <use href="#pd-icon-calendar"/>
                        </svg>
                    </span>


                    <div class="pd-card-head-copy">

                        <h2>
                            Logistics history
                        </h2>

                        <p>
                            Project coordination timeline
                        </p>

                    </div>

                </header>


                <div class="pd-card-body">

                    <div
                        id="project-timeline"
                        class="pd-timeline"
                    >

                        @foreach ($timeline as $item)

                            <article class="pd-timeline-item">

                                <span
                                    class="
                                        pd-timeline-icon
                                        is-{{ $item['tone'] }}
                                    "
                                    aria-hidden="true"
                                >
                                    <svg class="pd-icon">
                                        <use href="#pd-icon-{{ $item['icon'] }}"/>
                                    </svg>
                                </span>


                                <div class="pd-timeline-copy">

                                    <strong>
                                        {{ $item['title'] }}
                                    </strong>

                                    <p>
                                        {{ $item['description'] }}
                                    </p>

                                    <span class="pd-timeline-date">
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


    @if ($hasResourceIssue)

        <div
            id="resolution-modal"
            class="pd-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="resolution-modal-title"
            aria-hidden="true"
        >

            <div class="pd-modal-panel">

                <header class="pd-modal-head">

                    <div>

                        <h2 id="resolution-modal-title">
                            Resolve Resource Issue
                        </h2>

                        <p>
                            {{ $issueResource['name'] }}
                            ·
                            {{ $resourceShortage }}

                            {{ $resourceShortage === 1 ? 'unit' : 'units' }}
                            remaining
                        </p>

                    </div>


                    <button
                        id="close-resolution-modal"
                        type="button"
                        class="pd-modal-close"
                        aria-label="Close resource resolution modal"
                    >
                        <svg
                            class="pd-icon"
                            aria-hidden="true"
                        >
                            <use href="#pd-icon-x"/>
                        </svg>
                    </button>

                </header>


                <div class="pd-modal-body">

                    <div class="pd-modal-message">

                        <svg
                            class="pd-icon"
                            aria-hidden="true"
                        >
                            <use href="#pd-icon-alert"/>
                        </svg>

                        <span>
                            This project requires
                            {{ $issueResource['requested'] }}
                            {{ $issueResource['name'] }},
                            but only
                            {{ $issueResource['prepared'] }}
                            are currently prepared.
                            Record how the remaining requirement
                            will be resolved.
                        </span>

                    </div>


                    <div class="pd-field">

                        <label for="resolution-method">
                            Resolution method
                        </label>

                        <select
                            id="resolution-method"
                            class="pd-control"
                        >
                            <option value="reallocated">
                                Reallocate from another available stock
                            </option>

                            <option value="donation">
                                Use verified donated resources
                            </option>

                            <option value="alternative">
                                Use approved alternative resource
                            </option>
                        </select>

                    </div>


                    <div class="pd-field">

                        <label for="resolved-quantity">
                            Additional quantity secured
                        </label>

                        <input
                            id="resolved-quantity"
                            class="pd-control"
                            type="number"
                            min="1"
                            max="{{ $resourceShortage }}"
                            value="{{ $resourceShortage }}"
                        >

                    </div>


                    <div class="pd-field">

                        <label for="resolution-notes">
                            Resolution notes
                        </label>

                        <textarea
                            id="resolution-notes"
                            class="pd-control"
                            maxlength="1000"
                            placeholder="Add remarks about how the shortage was resolved..."
                        ></textarea>

                    </div>


                    <p
                        id="resolution-error"
                        class="pd-modal-error"
                        role="alert"
                        hidden
                    ></p>

                </div>


                <footer class="pd-modal-footer">

                    <button
                        id="cancel-resolution"
                        type="button"
                        class="pd-button"
                    >
                        Cancel
                    </button>


                    <button
                        id="confirm-resolution"
                        type="button"
                        class="
                            pd-button
                            pd-button-primary
                        "
                    >
                        <svg
                            class="pd-icon"
                            aria-hidden="true"
                        >
                            <use href="#pd-icon-check"/>
                        </svg>

                        Mark resource ready
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
    const initializeProjectDetails = () => {
        const page =
            document.getElementById(
                'project-detail-page'
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


        const issueResourceIndex =
            @json($issueResourceIndex);


        const shortageRequired =
            @json($resourceShortage);


        /*
        |--------------------------------------------------------------------------
        | NO RESOLUTION ACTION REQUIRED
        |--------------------------------------------------------------------------
        */

        if (
            issueResourceIndex === null ||
            shortageRequired <= 0
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const modal =
            page.querySelector(
                '#resolution-modal'
            );


        const openButton =
            page.querySelector(
                '#open-resolution-modal'
            );


        const closeButton =
            page.querySelector(
                '#close-resolution-modal'
            );


        const cancelButton =
            page.querySelector(
                '#cancel-resolution'
            );


        const confirmButton =
            page.querySelector(
                '#confirm-resolution'
            );


        const resolvedQuantity =
            page.querySelector(
                '#resolved-quantity'
            );


        const resolutionMethod =
            page.querySelector(
                '#resolution-method'
            );


        const resolutionNotes =
            page.querySelector(
                '#resolution-notes'
            );


        const resolutionError =
            page.querySelector(
                '#resolution-error'
            );


        const stateCard =
            page.querySelector(
                '#project-state-card'
            );


        const resourceRow =
            page.querySelector(
                `[data-resource-row="${issueResourceIndex}"]`
            );


        const workflowAllocation =
            page.querySelector(
                '#workflow-step-1'
            );


        const workflowReady =
            page.querySelector(
                '#workflow-step-2'
            );


        const workflowAllocationText =
            page.querySelector(
                '#workflow-description-1'
            );


        const workflowCurrentStage =
            page.querySelector(
                '#workflow-current-stage'
            );


        const heroStatus =
            page.querySelector(
                '#hero-project-status'
            );


        const heroProgress =
            page.querySelector(
                '#hero-project-progress'
            );


        const timeline =
            page.querySelector(
                '#project-timeline'
            );


        if (
            !modal ||
            !openButton ||
            !closeButton ||
            !cancelButton ||
            !confirmButton ||
            !resolvedQuantity ||
            !resolutionMethod ||
            !resolutionNotes ||
            !resolutionError ||
            !stateCard ||
            !resourceRow ||
            !workflowAllocation ||
            !workflowReady ||
            !workflowAllocationText ||
            !workflowCurrentStage ||
            !heroStatus ||
            !heroProgress ||
            !timeline
        ) {
            return;
        }


        let lastFocusedElement =
            null;


        let previousBodyOverflow =
            '';


        /*
        |--------------------------------------------------------------------------
        | OPEN
        |--------------------------------------------------------------------------
        */

        const openModal = () => {
            lastFocusedElement =
                document.activeElement;


            previousBodyOverflow =
                document.body.style.overflow;


            resolutionError.hidden =
                true;


            resolutionError.textContent =
                '';


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
                    closeButton.focus();
                }
            );
        };


        /*
        |--------------------------------------------------------------------------
        | CLOSE
        |--------------------------------------------------------------------------
        */

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


            if (
                lastFocusedElement instanceof
                HTMLElement
            ) {
                lastFocusedElement.focus();
            }
        };


        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        openButton.addEventListener(
            'click',
            openModal
        );


        closeButton.addEventListener(
            'click',
            closeModal
        );


        cancelButton.addEventListener(
            'click',
            closeModal
        );


        /*
        |--------------------------------------------------------------------------
        | CONFIRM RESOLUTION
        |--------------------------------------------------------------------------
        */

        confirmButton.addEventListener(
            'click',
            () => {
                resolutionError.hidden =
                    true;


                resolutionError.textContent =
                    '';


                const quantity =
                    Number(
                        resolvedQuantity.value
                    );


                if (
                    !Number.isSafeInteger(
                        quantity
                    ) ||
                    quantity <
                        shortageRequired
                ) {
                    resolutionError.textContent =
                        `Secure all ${shortageRequired} remaining ${
                            shortageRequired === 1
                                ? 'unit'
                                : 'units'
                        } before marking this resource ready.`;


                    resolutionError.hidden =
                        false;


                    resolvedQuantity.focus();


                    return;
                }


                const requested =
                    Number(
                        resourceRow
                            .dataset
                            .resourceRequested
                    );


                const available =
                    resourceRow.querySelector(
                        '[data-resource-available]'
                    );


                const prepared =
                    resourceRow.querySelector(
                        '[data-resource-prepared]'
                    );


                const status =
                    resourceRow.querySelector(
                        '[data-resource-status]'
                    );


                const issue =
                    resourceRow.querySelector(
                        '[data-resource-issue]'
                    );


                if (
                    available
                ) {
                    available.textContent =
                        String(
                            requested
                        );
                }


                if (
                    prepared
                ) {
                    prepared.textContent =
                        String(
                            requested
                        );
                }


                if (
                    status
                ) {
                    status.textContent =
                        'Ready';


                    status.className =
                        'pd-badge pd-badge-green';
                }


                if (
                    issue
                ) {
                    issue.remove();
                }


                /*
                |--------------------------------------------------------------------------
                | WORKFLOW
                |--------------------------------------------------------------------------
                */

                workflowAllocation.classList.remove(
                    'is-current'
                );


                workflowAllocation.classList.add(
                    'is-complete'
                );


                workflowAllocationText.textContent =
                    'All resources allocated';


                workflowReady.classList.add(
                    'is-current'
                );


                workflowCurrentStage.textContent =
                    'Current stage: Ready';


                /*
                |--------------------------------------------------------------------------
                | HERO
                |--------------------------------------------------------------------------
                */

                heroStatus.textContent =
                    'Ready';


                heroStatus.className =
                    'pd-status-text-teal';


                heroProgress.textContent =
                    '86%';


                /*
                |--------------------------------------------------------------------------
                | STATE CARD
                |--------------------------------------------------------------------------
                */

                stateCard.className =
                    'pd-state-card is-ready';


                stateCard.innerHTML = `
                    <span
                        class="pd-state-icon"
                        aria-hidden="true"
                    >
                        <svg
                            class="pd-icon"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <path
                                d="m8 12 3 3 5-6"
                            ></path>
                        </svg>
                    </span>

                    <h2>
                        Resources ready
                    </h2>

                    <p>
                        All required logistics resources have now
                        been prepared. This project can proceed
                        from Resource Allocation to the Ready stage.
                    </p>
                `;


                /*
                |--------------------------------------------------------------------------
                | TIMELINE
                |--------------------------------------------------------------------------
                */

                const methodLabels = {
                    reallocated:
                        'available inventory reallocation',

                    donation:
                        'verified donated resources',

                    alternative:
                        'an approved alternative resource'
                };


                const entry =
                    document.createElement(
                        'article'
                    );


                entry.className =
                    'pd-timeline-item';


                const entryDescription =
                    document.createElement(
                        'p'
                    );


                const notes =
                    resolutionNotes.value
                        .trim();


                entry.innerHTML = `
                    <span
                        class="
                            pd-timeline-icon
                            is-green
                        "
                        aria-hidden="true"
                    >
                        <svg
                            class="pd-icon"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <path
                                d="m8 12 3 3 5-6"
                            ></path>
                        </svg>
                    </span>

                    <div class="pd-timeline-copy">

                        <strong>
                            Resource shortage resolved
                        </strong>

                        <p data-resolution-description></p>

                        <span class="pd-timeline-date">
                            Just now
                        </span>

                    </div>
                `;


                const description =
                    entry.querySelector(
                        '[data-resolution-description]'
                    );


                const methodLabel =
                    methodLabels[
                        resolutionMethod.value
                    ] ??
                    'a recorded resolution method';


                description.textContent =
                    `The remaining ${shortageRequired} ${
                        shortageRequired === 1
                            ? 'unit was'
                            : 'units were'
                    } secured through ${methodLabel}.${
                        notes
                            ? ` ${notes}`
                            : ''
                    }`;


                timeline.appendChild(
                    entry
                );


                closeModal();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | BACKDROP
        |--------------------------------------------------------------------------
        */

        modal.addEventListener(
            'click',
            (event) => {
                if (
                    event.target ===
                    modal
                ) {
                    closeModal();
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            (event) => {
                if (
                    event.key ===
                        'Escape' &&
                    modal.classList.contains(
                        'is-open'
                    )
                ) {
                    closeModal();
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
            initializeProjectDetails,
            {
                once: true
            }
        );
    } else {
        initializeProjectDetails();
    }
})();
</script>
@endpush