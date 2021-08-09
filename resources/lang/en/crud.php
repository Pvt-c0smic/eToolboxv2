<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'all_bos' => [
        'name' => 'All Bos',
        'index_title' => 'AllBos List',
        'new_title' => 'New Bos',
        'create_title' => 'Create Bos',
        'edit_title' => 'Edit Bos',
        'show_title' => 'Show Bos',
        'inputs' => [
            'code' => 'Code',
            'description' => 'Description',
        ],
    ],

    'personnel_types' => [
        'name' => 'Personnel Types',
        'index_title' => 'PersonnelTypes List',
        'new_title' => 'New Personnel type',
        'create_title' => 'Create PersonnelType',
        'edit_title' => 'Edit PersonnelType',
        'show_title' => 'Show PersonnelType',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'offices' => [
        'name' => 'Offices',
        'index_title' => 'Offices List',
        'new_title' => 'New Office',
        'create_title' => 'Create Office',
        'edit_title' => 'Edit Office',
        'show_title' => 'Show Office',
        'inputs' => [
            'code' => 'Code',
            'description' => 'Description',
        ],
    ],

    'statuses' => [
        'name' => 'Statuses',
        'index_title' => 'Statuses List',
        'new_title' => 'New Status',
        'create_title' => 'Create Status',
        'edit_title' => 'Edit Status',
        'show_title' => 'Show Status',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'ranks' => [
        'name' => 'Ranks',
        'index_title' => 'Ranks List',
        'new_title' => 'New Rank',
        'create_title' => 'Create Rank',
        'edit_title' => 'Edit Rank',
        'show_title' => 'Show Rank',
        'inputs' => [
            'code' => 'Code',
            'description' => 'Description',
            'personnel_type_id' => 'Personnel Types',
        ],
    ],

    'all_personnel' => [
        'name' => 'All Personnel',
        'index_title' => 'AllPersonnel List',
        'new_title' => 'New Personnel',
        'create_title' => 'Create Personnel',
        'edit_title' => 'Edit Personnel',
        'show_title' => 'Show Personnel',
        'inputs' => [
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'afpsn' => 'Afpsn',
            'address' => 'Address',
            'rank_id' => 'Rank',
            'bos_id' => 'Bos',
            'office_id' => 'Office',
            'designation' => 'Designation',
        ],
    ],

    'compliances' => [
        'name' => 'Compliances',
        'index_title' => 'Compliances List',
        'new_title' => 'New Compliance',
        'create_title' => 'Create Compliance',
        'edit_title' => 'Edit Compliance',
        'show_title' => 'Show Compliance',
        'inputs' => [
            'office_id' => 'Office',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'project_name' => 'Project Name',
            'status_id' => 'Status',
        ],
    ],

    'compliance_actions' => [
        'name' => 'Compliance Actions',
        'index_title' => 'ComplianceActions List',
        'new_title' => 'New Compliance action',
        'create_title' => 'Create ComplianceAction',
        'edit_title' => 'Edit ComplianceAction',
        'show_title' => 'Show ComplianceAction',
        'inputs' => [
            'compliance_id' => 'Compliance',
            'action_taken' => 'Action Taken',
            'commander_comment' => 'Commander Comment',
            'percentage' => 'Percentage',
            'updated_date' => 'Updated Date',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
