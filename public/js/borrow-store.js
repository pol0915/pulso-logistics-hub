(() => {
    'use strict';

    if (window.PulsoBorrowStore) {
        return;
    }

    const KEY = 'pulso-borrow-preview-v2';
    const VERSION = 2;

    /*
    |--------------------------------------------------------------------------
    | PREVIEW DATE
    |--------------------------------------------------------------------------
    |
    | Fixed sample date used by the front-end prototype.
    |
    */

    const SNAPSHOT_DATE = '2026-09-12';


    /*
    |--------------------------------------------------------------------------
    | VALID RETURN CONDITIONS
    |--------------------------------------------------------------------------
    */

    const CONDITIONS = [
        'Excellent',
        'Good',
        'Fair',
        'Poor',
        'Needs maintenance',
        'Damaged',
    ];


    /*
    |--------------------------------------------------------------------------
    | CURRENT BORROWING SAMPLE DATA
    |--------------------------------------------------------------------------
    |
    | These records are aligned with:
    |
    | resources/views/borrow/index.blade.php
    |
    | IDs:
    | BRW-2026-0024
    | BRW-2026-0025
    | BRW-2026-0026
    | BRW-2026-0027
    | BRW-2026-0028
    |
    */

    const seedLoans = [
        {
            id: 'BRW-2026-0028',

            request_id: 'REQ-2026-0047',

            borrower: 'Maria Santos',

            committee: 'Events Committee',

            project: 'Youth Leadership Summit',

            asset:
                'Portable Sound System, Projector & Monoblock Chairs',

            asset_id:
                '3 resource types',

            quantity: 62,

            released: '2026-09-12',

            due: '2026-09-12',

            openingReturned: 0,

            items: [
                {
                    asset_id: 'PULSO-AUD-001',
                    name: 'Portable Sound System',
                    quantity: 1,
                    condition_out: 'Good',
                },
                {
                    asset_id: 'PULSO-EQP-001',
                    name: 'Projector',
                    quantity: 1,
                    condition_out: 'Good',
                },
                {
                    asset_id: 'PULSO-FUR-001',
                    name: 'Monoblock Chairs',
                    quantity: 60,
                    condition_out: 'Good',
                },
            ],

            returns: [],
        },

        {
            id: 'BRW-2026-0027',

            request_id: 'REQ-2026-0045',

            borrower: 'Angela Cruz',

            committee: 'Environment & Health',

            project: 'Coastal Clean-Up Drive',

            asset:
                'Large Event Tent & Extension Cord 20m',

            asset_id:
                '2 resource types',

            quantity: 5,

            released: '2026-09-10',

            due: '2026-09-10',

            openingReturned: 0,

            items: [
                {
                    asset_id: 'PULSO-EVT-001',
                    name: 'Large Event Tent',
                    quantity: 2,
                    condition_out: 'Good',
                },
                {
                    asset_id: 'PULSO-ELE-001',
                    name: 'Extension Cord 20m',
                    quantity: 3,
                    condition_out: 'Good',
                },
            ],

            returns: [],
        },

        {
            id: 'BRW-2026-0026',

            request_id: 'REQ-2026-0046',

            borrower: 'Joshua Reyes',

            committee: 'Community Outreach',

            project: 'Medical Mission',

            asset:
                'Folding Tables & Power Strip',

            asset_id:
                '2 resource types',

            quantity: 12,

            released: '2026-09-11',

            due: '2026-09-13',

            openingReturned: 0,

            items: [
                {
                    asset_id: 'PULSO-FUR-002',
                    name: 'Folding Tables',
                    quantity: 8,
                    condition_out: 'Good',
                },
                {
                    asset_id: 'PULSO-ELE-002',
                    name: 'Power Strip',
                    quantity: 4,
                    condition_out: 'Excellent',
                },
            ],

            returns: [],
        },

        {
            id: 'BRW-2026-0025',

            request_id: 'REQ-2026-0041',

            borrower: 'Nicole Ramos',

            committee: 'Volunteer Management',

            project: 'PULSO Volunteer Orientation',

            asset:
                'Wireless Microphone Set & PULSO Event Banner',

            asset_id:
                '2 resource types',

            quantity: 3,

            released: '2026-09-07',

            due: '2026-09-07',

            openingReturned: 3,

            items: [
                {
                    asset_id: 'PULSO-AUD-002',
                    name: 'Wireless Microphone Set',
                    quantity: 1,
                    condition_out: 'Good',
                },
                {
                    asset_id: 'PULSO-EVT-002',
                    name: 'PULSO Event Banner',
                    quantity: 2,
                    condition_out: 'Good',
                },
            ],

            returns: [],
        },

        {
            id: 'BRW-2026-0024',

            request_id: 'REQ-2026-0040',

            borrower: 'Carlo Mendoza',

            committee: 'Education Committee',

            project: 'Student Assistance Orientation',

            asset:
                'Projector',

            asset_id:
                'PULSO-EQP-001',

            quantity: 1,

            released: '2026-09-06',

            due: '2026-09-06',

            openingReturned: 1,

            items: [
                {
                    asset_id: 'PULSO-EQP-001',
                    name: 'Projector',
                    quantity: 1,
                    condition_out: 'Good',
                },
            ],

            returns: [],
        },
    ];


    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    const copy = (value) => {
        return JSON.parse(
            JSON.stringify(
                value
            )
        );
    };


    const text = (
        value,
        max,
        required = true
    ) => {
        return (
            typeof value === 'string' &&
            value.length <= max &&
            (
                !required ||
                value.trim().length > 0
            )
        );
    };


    const validDate = (value) => {
        if (
            typeof value !== 'string' ||
            !/^\d{4}-\d{2}-\d{2}$/.test(
                value
            )
        ) {
            return false;
        }


        const date =
            new Date(
                `${value}T00:00:00Z`
            );


        return (
            Number.isFinite(
                date.getTime()
            ) &&
            date
                .toISOString()
                .slice(
                    0,
                    10
                ) === value
        );
    };


    const validItem = (item) => {
        if (
            !item ||
            typeof item !== 'object'
        ) {
            return false;
        }


        return (
            text(
                item.asset_id,
                200
            ) &&
            text(
                item.name,
                200
            ) &&
            Number.isSafeInteger(
                item.quantity
            ) &&
            item.quantity > 0 &&
            text(
                item.condition_out,
                100
            )
        );
    };


    const returnedFor = (loan) => {
        return (
            loan.openingReturned +
            loan.returns.reduce(
                (
                    total,
                    batch
                ) => {
                    return (
                        total +
                        batch.quantity
                    );
                },
                0
            )
        );
    };


    /*
    |--------------------------------------------------------------------------
    | VALIDATE LOAN
    |--------------------------------------------------------------------------
    */

    const validLoan = (loan) => {
        if (
            !loan ||
            typeof loan !== 'object'
        ) {
            return false;
        }


        const requiredTextFields = [
            'id',
            'request_id',
            'borrower',
            'committee',
            'asset',
            'asset_id',
            'project',
        ];


        if (
            !requiredTextFields.every(
                (key) => {
                    return text(
                        loan[key],
                        500
                    );
                }
            )
        ) {
            return false;
        }


        if (
            !Number.isSafeInteger(
                loan.quantity
            ) ||
            loan.quantity < 1 ||
            !Number.isSafeInteger(
                loan.openingReturned
            ) ||
            loan.openingReturned < 0 ||
            loan.openingReturned >
                loan.quantity ||
            !validDate(
                loan.released
            ) ||
            !validDate(
                loan.due
            ) ||
            loan.due <
                loan.released ||
            !Array.isArray(
                loan.items
            ) ||
            loan.items.length ===
                0 ||
            !loan.items.every(
                validItem
            ) ||
            !Array.isArray(
                loan.returns
            )
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | Make sure total item quantity matches the borrowing quantity.
        |--------------------------------------------------------------------------
        */

        const totalItemQuantity =
            loan.items.reduce(
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


        if (
            totalItemQuantity !==
            loan.quantity
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | Validate preview return batches.
        |--------------------------------------------------------------------------
        */

        const validBatches =
            loan.returns.every(
                (batch) => {
                    return (
                        batch &&
                        Number.isSafeInteger(
                            batch.quantity
                        ) &&
                        batch.quantity >
                            0 &&
                        CONDITIONS.includes(
                            batch.condition
                        ) &&
                        text(
                            batch.notes,
                            1000,
                            false
                        ) &&
                        typeof batch.at ===
                            'string' &&
                        Number.isFinite(
                            Date.parse(
                                batch.at
                            )
                        )
                    );
                }
            );


        if (!validBatches) {
            return false;
        }


        const returned =
            returnedFor(
                loan
            );


        return (
            Number.isSafeInteger(
                returned
            ) &&
            returned <=
                loan.quantity
        );
    };


    /*
    |--------------------------------------------------------------------------
    | VALIDATE STATE
    |--------------------------------------------------------------------------
    */

    const validState = (state) => {
        if (
            !state ||
            state.version !== VERSION ||
            !Array.isArray(
                state.loans
            ) ||
            !state.loans.every(
                validLoan
            )
        ) {
            return false;
        }


        const ids =
            state.loans.map(
                (loan) => {
                    return loan.id;
                }
            );


        return (
            new Set(
                ids
            ).size ===
            ids.length
        );
    };


    /*
    |--------------------------------------------------------------------------
    | LOAD
    |--------------------------------------------------------------------------
    */

    const load = () => {
        let raw;


        try {
            raw =
                window.sessionStorage.getItem(
                    KEY
                );
        } catch {
            throw new Error(
                'Browser storage is unavailable. Allow session storage to use the borrowing preview across pages.'
            );
        }


        if (
            raw === null
        ) {
            return {
                version:
                    VERSION,

                loans:
                    copy(
                        seedLoans
                    ),
            };
        }


        let state;


        try {
            state =
                JSON.parse(
                    raw
                );
        } catch {
            throw new Error(
                'The borrowing preview could not be read. Reset the preview to restore the sample borrowing records.'
            );
        }


        if (
            !validState(
                state
            )
        ) {
            throw new Error(
                'The borrowing preview data is invalid. Reset the preview to restore the sample borrowing records.'
            );
        }


        return state;
    };


    /*
    |--------------------------------------------------------------------------
    | SAVE
    |--------------------------------------------------------------------------
    */

    const save = (state) => {
        if (
            !validState(
                state
            )
        ) {
            throw new Error(
                'The return contains invalid borrowing data.'
            );
        }


        try {
            window.sessionStorage.setItem(
                KEY,
                JSON.stringify(
                    state
                )
            );
        } catch {
            throw new Error(
                'The return could not be saved in this browser tab. No changes were applied.'
            );
        }


        window.dispatchEvent(
            new CustomEvent(
                'pulso:borrowings-updated'
            )
        );
    };


    /*
    |--------------------------------------------------------------------------
    | DESCRIBE RECORD
    |--------------------------------------------------------------------------
    */

    const describe = (loan) => {
        const returned =
            returnedFor(
                loan
            );


        const remaining =
            loan.quantity -
            returned;


        const dueTime =
            Date.parse(
                `${loan.due}T00:00:00Z`
            );


        const snapshotTime =
            Date.parse(
                `${SNAPSHOT_DATE}T00:00:00Z`
            );


        const days =
            Math.round(
                (
                    dueTime -
                    snapshotTime
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
            /*
            |--------------------------------------------------------------------------
            | Matches the Borrow & Return index terminology.
            |--------------------------------------------------------------------------
            */

            status =
                'Due Soon';
        } else {
            status =
                'Borrowed';
        }


        const absoluteDays =
            Math.abs(
                days
            );


        const distance =
            `${absoluteDays} ${
                absoluteDays === 1
                    ? 'day'
                    : 'days'
            }`;


        let dueNote;


        if (
            remaining === 0
        ) {
            dueNote =
                'No outstanding quantity';
        } else if (
            days === 0
        ) {
            dueNote =
                'Return due today';
        } else if (
            days < 0
        ) {
            dueNote =
                `${distance} overdue`;
        } else if (
            days === 1
        ) {
            dueNote =
                'Due tomorrow';
        } else {
            dueNote =
                `Due in ${distance}`;
        }


        return {
            ...loan,

            returned,

            remaining,

            status,

            dueNote,

            isPartial:
                returned > 0 &&
                remaining > 0,
        };
    };


    /*
    |--------------------------------------------------------------------------
    | FIND LOAN
    |--------------------------------------------------------------------------
    */

    const findLoan = (
        state,
        id
    ) => {
        const normalizedId =
            String(
                id ?? ''
            ).trim();


        if (
            normalizedId === ''
        ) {
            return null;
        }


        return (
            state.loans.find(
                (loan) => {
                    return (
                        loan.id ===
                        normalizedId
                    );
                }
            ) ??
            null
        );
    };


    /*
    |--------------------------------------------------------------------------
    | PUBLIC STORE
    |--------------------------------------------------------------------------
    */

    window.PulsoBorrowStore =
        Object.freeze(
            {
                snapshotDate:
                    SNAPSHOT_DATE,


                /*
                |--------------------------------------------------------------------------
                | CONDITIONS
                |--------------------------------------------------------------------------
                */

                conditions:
                    Object.freeze(
                        [
                            ...CONDITIONS
                        ]
                    ),


                /*
                |--------------------------------------------------------------------------
                | GET ALL RECORDS
                |--------------------------------------------------------------------------
                */

                getRecords() {
                    return load()
                        .loans
                        .map(
                            describe
                        );
                },


                /*
                |--------------------------------------------------------------------------
                | GET ONE RECORD
                |--------------------------------------------------------------------------
                */

                getRecord(id) {
                    const state =
                        load();


                    const loan =
                        findLoan(
                            state,
                            id
                        );


                    return loan
                        ? describe(
                            loan
                        )
                        : null;
                },


                /*
                |--------------------------------------------------------------------------
                | RECORD RETURN
                |--------------------------------------------------------------------------
                |
                | This is still a browser-only preview.
                |
                | No database record and no inventory quantity are updated.
                |
                */

                recordReturn(
                    id,
                    input
                ) {
                    const state =
                        load();


                    const loan =
                        findLoan(
                            state,
                            id
                        );


                    if (!loan) {
                        throw new Error(
                            'This borrowing record could not be found.'
                        );
                    }


                    const remaining =
                        loan.quantity -
                        returnedFor(
                            loan
                        );


                    if (
                        remaining === 0
                    ) {
                        throw new Error(
                            'This borrowing is already fully returned.'
                        );
                    }


                    const amount =
                        input?.quantity;


                    if (
                        !Number.isSafeInteger(
                            amount
                        ) ||
                        amount < 1 ||
                        amount >
                            remaining
                    ) {
                        throw new Error(
                            `Enter a whole number between 1 and ${remaining}.`
                        );
                    }


                    const condition =
                        String(
                            input?.condition ??
                            ''
                        ).trim();


                    if (
                        !CONDITIONS.includes(
                            condition
                        )
                    ) {
                        throw new Error(
                            'Select a valid return condition.'
                        );
                    }


                    const returnNotes =
                        String(
                            input?.notes ??
                            ''
                        );


                    if (
                        !text(
                            returnNotes,
                            1000,
                            false
                        )
                    ) {
                        throw new Error(
                            'Return notes must be 1,000 characters or fewer.'
                        );
                    }


                    loan.returns.push(
                        {
                            quantity:
                                amount,

                            condition,

                            notes:
                                returnNotes.trim(),

                            at:
                                new Date()
                                    .toISOString(),
                        }
                    );


                    save(
                        state
                    );


                    return describe(
                        loan
                    );
                },


                /*
                |--------------------------------------------------------------------------
                | RESET PREVIEW
                |--------------------------------------------------------------------------
                */

                resetPreview() {
                    const state = {
                        version:
                            VERSION,

                        loans:
                            copy(
                                seedLoans
                            ),
                    };


                    save(
                        state
                    );


                    return state
                        .loans
                        .map(
                            describe
                        );
                },
            }
        );
})();