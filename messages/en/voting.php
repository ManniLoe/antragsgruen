<?php
return [
    'bc' => 'Votings',
    'title_user_single' => 'Voting',

    'vote_yes' => 'Yes',
    'vote_no' => 'No',
    'vote_abstention' => 'Abstention',
    'vote_present' => 'Present',
    'vote_undo' => 'Undo vote',

    'status_accepted' => 'Accepted',
    'status_rejected' => 'Rejected',

    'activity_title' => 'Protocol',
    'activity_show_all' => 'Show complete protocol',
    'activity_opened' => 'Voting opened',
    'activity_closed' => 'Voting closed',
    'activity_reset' => 'Voting reset',
    'activity_reopened' => 'Voting re-opened',

    'results_title' => 'Voting results',
    'results_none' => 'No voting results have been published yet',
    'results_download' => 'Results as Spreadsheet',

    'admin_title' => 'Voting administration',
    'admin_bc' => 'Administration',
    'admin_intro' => '<strong>Hint:</strong> you can find a manual for the voting functionality on the <a href="https://sandbox.motion.tools/help#advanced">help page</a>.',
    'admin_aria_single' => 'Administrate voting',
    'admin_voting_use' => 'Online voting',
    'admin_voting_use_h' => 'The voting about the following motions and amendments shall take place online on Antragsgrün',
    'admin_votes_total' => 'Total',
    'admin_btn_open' => 'Open voting',
    'admin_btn_close' => 'Close voting',
    'admin_btn_cancel' => 'Cancel',
    'admin_btn_reset' => 'Reset',
    'admin_btn_reset_bb' => 'This will remove all votes and set the voting back to preparation mode, where you can add or remove motions and amendments. WARNING: All users will have to vote again.',
    'admin_btn_reopen' => 'Re-Open',
    'admin_btn_remove_item' => 'Remove from voting',
    'admin_status_opened' => 'The voting is <strong>open</strong>, users can now cast their votes',
    'admin_status_closed' => 'The voting is <strong>closed</strong>.',
    'admin_members_present' => 'Members present',
    'admin_no_items_yet' => 'No motion, amendment or question has been added to this voting yet.',
    'admin_add_amendments' => 'Add a motion or amendment',
    'admin_add_amendments_opt' => 'Please select a motion/amendment to add',
    'admin_add_question' => 'Add a question',
    'admin_add_question_title' => 'Question',
    'admin_add_btn' => 'Add selected motion or amendment',
    'admin_add_opt_motion' => 'Add the motion',
    'admin_add_opt_all_amend' => 'Add all following amendments',
    'admin_add_abort' => 'Abort adding',
    'admin_settings_open' => 'Show settings',
    'admin_settings_close' => 'Close settings',
    'admin_mvtoug_caller' => 'Assign voters to a user group',

    'settings_create' => 'Create a new voting',
    'settings_open' => 'Show settings',
    'settings_close' => 'Hide settings',
    'settings_votingtype' => 'What is voted?',
    'settings_votingtype_motion' => 'Motions and/or amendments',
    'settings_votingtype_question' => 'A specific question',
    'settings_title' => 'Title',
    'settings_question' => 'Question to vote on',
    'settings_answers' => 'Answer options',
    'settings_answers_yesnoabst' => 'Yes, No, Abstention',
    'settings_answers_yesno' => 'Yes, No',
    'settings_answers_present' => 'Present',
    'settings_answers_presenth' => 'For „votings” meant to ask which members are present, like roll calls.',
    'settings_majoritytype' => 'Majority type',
    'settings_quorumtype' => 'Quorum',
    'settings_votepolicy' => 'Who may vote',
    'settings_resultspublic' => 'Who may see the voting results?',
    'settings_resultspublic_admins' => 'Admins',
    'settings_resultspublic_all' => 'Everyone',
    'settings_votespublic' => 'Who may see who voted how?',
    'settings_votespublic_hint' => 'This setting can only be changed until the voting has been opened.',
    'settings_votespublic_nobody' => 'Nobody',
    'settings_votespublic_admins' => 'Admins',
    'settings_votespublic_all' => 'Everyone',
    'settings_motionassign' => 'Assigned to motion',
    'settings_motionassign_h' => 'If this voting is assigned to a motion, it will be shown on the motion page, not on the home page',
    'settings_motionassign_none' => 'None',
    'settings_save' => 'Save',
    'settings_delete' => 'Delete the voting',
    'settings_delete_bb' => 'Do you want to delete the voting including all cast votes? The motions and amendments will remain untouched.',

    'voting_current_aria' => 'Currently active voting',
    'voting_show_amend' => 'Show amendment',
    'voting_edit_amend' => 'Edit amendment',
    'voting_by' => 'By',
    'voting_admin_all' => 'Administrate votings',
    'voting_visibility' => 'Who can see how I voted?',
    'voting_visibility_none' => 'Nobody can see how you voted. <small>(Persons with access to the database could access this data, though)</small>',
    'voting_visibility_admin' => 'The votes are visible to the <strong>administrators</strong> of this page, but not for other participants.',
    'voting_visibility_all' => '<strong>All logged in users</strong> can see who voted how.',
    'voting_show_all' => 'Show all votings',
    'voting_votes_status' => 'Status',
    'voting_votes_0' => 'No vote has been cast yet',
    'voting_votes_1_1' => '1 vote has been cast by 1 user',
    'voting_votes_1_x' => '%VOTES% votes have been cast by 1 user',
    'voting_votes_x' => '%VOTES% votes have been cast by %USERS% users',
    'voting_show_votes' => 'Show vote list',
    'voting_hide_votes' => 'Hide vote list',

    'majority_simple' => 'Simple majority',
    'majority_simple_h' => 'A motion or amendment is adopted, if more yes- than no-votes are cast. Abstentions are not counted.',
    'majority_absolute' => 'Absolute majority',
    'majority_absolute_h' => 'A motion or amendment is adopted, if more yes- than no-votes and abstentions combined are cast.',
    'majority_twothirds' => '2/3 majority',
    'majority_twothirds_h' => 'A motion or amendment is adopted, if at least (including) twice as many yes- as no-votes are cast. Abstentions are not counted.',

    'quorum_none' => 'No quorum',
    'quorum_half' => 'Simple majority',
    'quorum_half_h' => 'At least half of all eligible members have to cast a vote',
    'quorum_two_third' => '2/3 majority',
    'quorum_two_third_h' => 'At least two out of three of all eligible members have to cast a vote',
];
