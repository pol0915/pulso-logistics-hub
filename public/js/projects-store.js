(() => {
    'use strict';

    if (window.PulsoProjectsStore) {
        return;
    }

    const STORAGE_KEY = 'pulso-projects-preview-v1';
    const VERSION = 1;

    const committees = [
        'Education',
        'Environment & Health',
        'Community Outreach',
        'Events Committee',
        'Arts & Culture',
    ];

    const projectStatuses = [
        'Preparing',
        'In progress',
        'Completed',
    ];

    const initialData = {
        version: VERSION,

        projects: [
            {
                id: 'PRJ-2026-001',
                name: 'Youth Leadership Summit',
                committee: 'Events Committee',
                date: '2026-09-12',
                venue: 'PULSO Activity Center',
                status: 'In progress',
                resources: 'Audio system, projector, and chairs',
                description:
                    'Equipment and logistical support for the Youth Leadership Summit.',
            },
            {
                id: 'PRJ-2026-002',
                name: 'Medical Mission',
                committee: 'Community Outreach',
                date: '2026-09-15',
                venue: 'Brgy. San Isidro',
                status: 'Preparing',
                resources: 'Tents, tables, and hygiene kits',
                description:
                    'Prepare the venue, equipment, and donated supplies for the community medical mission.',
            },
            {
                id: 'PRJ-2026-003',
                name: 'Coastal Clean-Up Drive',
                committee: 'Environment & Health',
                date: '2026-09-18',
                venue: 'Pagsanjan Riverside',
                status: 'Preparing',
                resources:
                    'Gloves, drinking water, and cleaning materials',
                description:
                    'Coordinate supplies and logistical support for the scheduled clean-up activity.',
            },
        ],

        donations: [
            {
                id: 'DON-2026-001',
                project_id: 'PRJ-2026-001',
                donor: 'Community volunteers',
                item: 'Bottled water',
                quantity: 10,
                received: 10,
                unit: 'cases',
                date: '2026-09-10',
                notes:
                    'Allocated for participants and volunteers.',
            },
            {
                id: 'DON-2026-002',
                project_id: 'PRJ-2026-002',
                donor: 'Community donors',
                item: 'Hygiene kits',
                quantity: 50,
                received: 50,
                unit: 'kits',
                date: '2026-09-10',
                notes:
                    'For distribution during the medical mission.',
            },
            {
                id: 'DON-2026-003',
                project_id: 'PRJ-2026-002',
                donor: 'Local business partners',
                item: 'Food packs',
                quantity: 30,
                received: 0,
                unit: 'packs',
                date: '2026-09-11',
                notes:
                    'Awaiting delivery. Not yet included in received supplies.',
            },
            {
                id: 'DON-2026-004',
                project_id: 'PRJ-2026-003',
                donor: 'Environmental volunteers',
                item: 'Protective gloves',
                quantity: 40,
                received: 40,
                unit: 'pairs',
                date: '2026-09-11',
                notes:
                    'For volunteers assigned to the clean-up activity.',
            },
        ],
    };

    const clone = (value) => {
        return JSON.parse(JSON.stringify(value));
    };

    const isValidDate = (value) => {
        if (
            typeof value !== 'string' ||
            !/^\d{4}-\d{2}-\d{2}$/.test(value)
        ) {
            return false;
        }

        const date = new Date(`${value}T00:00:00.000Z`);

        return !Number.isNaN(date.getTime()) &&
            date.toISOString().slice(0, 10) === value;
    };

    const isText = (value, maximum, required = false) => {
        return typeof value === 'string' &&
            value.length <= maximum &&
            (!required || value.trim().length > 0);
    };

    const isValidProject = (project) => {
        return project !== null &&
            typeof project === 'object' &&
            isText(project.id, 100, true) &&
            isText(project.name, 150, true) &&
            committees.includes(project.committee) &&
            isValidDate(project.date) &&
            isText(project.venue, 200, true) &&
            projectStatuses.includes(project.status) &&
            isText(project.resources, 500) &&
            isText(project.description, 2000);
    };

    const isValidDonation = (donation, projectIds) => {
        return donation !== null &&
            typeof donation === 'object' &&
            isText(donation.id, 100, true) &&
            projectIds.has(donation.project_id) &&
            isText(donation.donor, 200, true) &&
            isText(donation.item, 200, true) &&
            Number.isSafeInteger(donation.quantity) &&
            donation.quantity > 0 &&
            Number.isSafeInteger(donation.received) &&
            donation.received >= 0 &&
            donation.received <= donation.quantity &&
            isText(donation.unit, 50, true) &&
            isValidDate(donation.date) &&
            isText(donation.notes, 2000);
    };

    const validateStoredData = (data) => {
        if (
            !data ||
            data.version !== VERSION ||
            !Array.isArray(data.projects) ||
            !Array.isArray(data.donations)
        ) {
            return false;
        }

        if (!data.projects.every(isValidProject)) {
            return false;
        }

        const projectIds = new Set(
            data.projects.map((project) => project.id)
        );

        const donationIds = new Set(
            data.donations.map((donation) => donation?.id)
        );

        if (
            projectIds.size !== data.projects.length ||
            donationIds.size !== data.donations.length
        ) {
            return false;
        }

        return data.donations.every(
            (donation) => isValidDonation(donation, projectIds)
        );
    };

    const readState = () => {
        let stored;

        try {
            stored = window.sessionStorage.getItem(STORAGE_KEY);
        } catch {
            throw new Error(
                'Browser storage is unavailable. Allow session storage to use the project preview across pages.'
            );
        }

        if (stored === null) {
            return clone(initialData);
        }

        let data;

        try {
            data = JSON.parse(stored);
        } catch {
            throw new Error(
                'The saved preview data could not be read. Use Reset preview to restore the sample records.'
            );
        }

        if (!validateStoredData(data)) {
            throw new Error(
                'The saved preview data is invalid or incompatible. Use Reset preview to restore the sample records.'
            );
        }

        return data;
    };

    const saveState = (state) => {
        if (!validateStoredData(state)) {
            throw new Error(
                'The preview could not be saved because a record is invalid.'
            );
        }

        try {
            window.sessionStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(state)
            );
        } catch {
            throw new Error(
                'The preview could not be saved in this browser tab. Your changes have not been applied.'
            );
        }

        window.dispatchEvent(
            new CustomEvent('pulso:projects-updated')
        );
    };

    const readText = (
        input,
        key,
        label,
        maximum,
        required = false
    ) => {
        const value = typeof input[key] === 'string'
            ? input[key].trim()
            : '';

        if (required && !value) {
            throw new Error(`${label} is required.`);
        }

        if (value.length > maximum) {
            throw new Error(
                `${label} must be ${maximum} characters or fewer.`
            );
        }

        return value;
    };

    const validateProjectInput = (input) => {
        if (!input || typeof input !== 'object') {
            throw new Error('Project details are required.');
        }

        const project = {
            name: readText(
                input,
                'name',
                'Project name',
                150,
                true
            ),

            committee: readText(
                input,
                'committee',
                'Committee',
                100,
                true
            ),

            date: readText(
                input,
                'date',
                'Activity date',
                10,
                true
            ),

            venue: readText(
                input,
                'venue',
                'Venue',
                200,
                true
            ),

            status: readText(
                input,
                'status',
                'Project status',
                50,
                true
            ),

            resources: readText(
                input,
                'resources',
                'Resources needed',
                500
            ),

            description: readText(
                input,
                'description',
                'Description',
                2000
            ),
        };

        if (!committees.includes(project.committee)) {
            throw new Error('Select a valid committee.');
        }

        if (!isValidDate(project.date)) {
            throw new Error('Enter a valid activity date.');
        }

        if (!projectStatuses.includes(project.status)) {
            throw new Error('Select a valid project status.');
        }

        return project;
    };

    const nextProjectId = (projects) => {
        const highestNumber = projects.reduce(
            (highest, project) => {
                const match = /^PRJ-DEMO-(\d+)$/.exec(project.id);

                if (!match) {
                    return highest;
                }

                return Math.max(highest, Number(match[1]));
            },
            0
        );

        return `PRJ-DEMO-${String(highestNumber + 1).padStart(3, '0')}`;
    };

    const donationStatus = (donation) => {
        if (donation.received === 0) {
            return 'Pledged';
        }

        if (donation.received < donation.quantity) {
            return 'Partially received';
        }

        return 'Received';
    };

    const decorateDonation = (donation, projects) => {
        const project = projects.find(
            (item) => item.id === donation.project_id
        );

        return {
            ...donation,
            project_name: project?.name ?? 'Unassigned',
            remaining: donation.quantity - donation.received,
            status: donationStatus(donation),
        };
    };

    const getProjects = () => {
        return clone(readState().projects);
    };

    const getProject = (id) => {
        const project = readState().projects.find(
            (item) => item.id === id
        );

        return project ? clone(project) : null;
    };

    const createProject = (input) => {
        const projectData = validateProjectInput(input);
        const state = readState();

        const project = {
            id: nextProjectId(state.projects),
            ...projectData,
        };

        state.projects.push(project);
        saveState(state);

        return clone(project);
    };

    const updateProject = (id, input) => {
        const state = readState();
        const index = state.projects.findIndex(
            (project) => project.id === id
        );

        if (index === -1) {
            throw new Error(
                'This project could not be found. Return to the project list and open it again.'
            );
        }

        const projectData = validateProjectInput(input);

        const updatedProject = {
            ...state.projects[index],
            ...projectData,
            id: state.projects[index].id,
        };

        state.projects[index] = updatedProject;
        saveState(state);

        return clone(updatedProject);
    };

    const getDonations = (projectId = null) => {
        const state = readState();

        const records = projectId === null
            ? state.donations
            : state.donations.filter(
                (donation) => donation.project_id === projectId
            );

        return records.map(
            (donation) => decorateDonation(
                clone(donation),
                state.projects
            )
        );
    };

    const getDonation = (id) => {
        const state = readState();

        const donation = state.donations.find(
            (item) => item.id === id
        );

        if (!donation) {
            return null;
        }

        return decorateDonation(
            clone(donation),
            state.projects
        );
    };

    const getSummary = () => {
        const state = readState();

        return {
            projects: state.projects.length,

            donationRecords: state.donations.length,

            receivedRecords: state.donations.filter(
                (donation) => donation.received === donation.quantity
            ).length,

            pendingRecords: state.donations.filter(
                (donation) => donation.received < donation.quantity
            ).length,
        };
    };

    const resetPreview = () => {
        saveState(clone(initialData));
    };

    window.PulsoProjectsStore = Object.freeze({
        getCommittees: () => [...committees],
        getProjectStatuses: () => [...projectStatuses],
        getProjects,
        getProject,
        createProject,
        updateProject,
        getDonations,
        getDonation,
        getSummary,
        resetPreview,
    });
})();