<?php

return [
    'amendment'              => 'Amendment',
    'amendments'             => 'Amendments',
    'motion'                 => 'Motion',
    'initiator'              => 'Proposer',
    'initiators_title'       => 'Proposers',
    'supporter'              => 'Supporter',
    'supporters'             => 'Supporters',
    'supporters_title'       => 'Supporters',
    'supporter_you'          => 'You!',
    'supporter_none'         => 'None',
    'status'                 => 'Status',
    'resoluted_on'           => 'Decided on',
    'submitted_on'           => 'Submitted',
    'comments_title'         => 'Comments',
    'comment_screen_queue_1' => '1 comment waiting for screening',
    'comment_screen_queue_x' => '%NUM% comments waiting for screening',
    'comment_login_hint'     => 'Please log in to comment.',
    'prefix'                 => 'Signature',
    'none_yet'               => 'No amendment yet',
    'amendment_for'          => 'Amendment for',
    'amendment_for_prefix'   => 'Amendment for %PREFIX%',
    'ajax_diff_title'        => 'Changes',
    'confirmed_visible'      => 'You submitted the amendment. It is visible immediately.',
    'confirmed_screening'    => 'You submitted the amendment. It will be screened now.',

    'screened_hint'             => 'Screened',
    'amend_for'                 => ' to ',
    'create_explanation'        => 'Please amend the motion as you like. Explain in the  &quot;Reason&quot; section below.<br>' . "\n" .
        'Please note, you can request &quot;Editorial changes&quot;.',
    'editorial_hint'            => 'Editorial hint',
    'merge_init_title'          => 'Refactor "%NAME%"',
    'merge_status_unchanged'    => 'unchanged',
    'merge_amend_stati'         => 'Status of the amendments',
    'merge_bread'               => 'Revise',
    'merge_title'               => 'Revise %TITLE%',
    'merge_new_text'            => 'New motion text',
    'merge_confirm_title'       => 'Confirm new version',
    'merge_submitted'           => 'New version confirmed',
    'merge_submitted_title'     => '%TITLE% revised',
    'merge_submitted_str'       => 'The new version of this motion has been saved',
    'merge_submitted_to_motion' => 'Go to the motion',
    'merge_colliding'           => 'Colliding amendment',
    'merge_accept_all'          => 'Accept all changes',
    'merge_reject_all'          => 'Reject all changes',

    'unsaved_drafts'                    => 'There are unsaved drafts that can be restored:',
    'confirm_amendment'                 => 'Confirm amendment',
    'amendment_submitted'               => 'Amendment submitted',
    'amendment_create'                  => 'Create an amendment',
    'amendment_edit'                    => 'Edit this amendment',
    'amendment_create_x'                => 'Create an amendment to %prefix%',
    'amendment_edit_x'                  => 'Edit the amendment to %prefix%',
    'amendment_withdraw'                => 'Withdraw this amendment',
    'edit_done'                         => 'Edit amendment',
    'edit_done_msg'                     => 'The changes have been saved.',
    'edit_bread'                        => 'Edit',
    'reason'                            => 'Reason',
    'amendment_requirement'             => 'Requirements for an amendment',
    'submitted_create'                  => 'Created amendment',
    'submitted_submit'                  => 'Submitted amendment',
    'submitted_publish'                 => 'Published amendment',
    'created_bread_create'              => 'Created',
    'created_bread_submit'              => 'Submitted',
    'created_bread_publish'             => 'Published',
    'button_submit_create'              => 'Create',
    'button_submit_submit'              => 'Submit',
    'button_submit_publish'             => 'Publish',
    'button_correct'                    => 'Correct',
    'confirm'                           => 'Confirm',
    'go_on'                             => 'Go on',
    'published_email_body'              => "Hi,\n\nyour amendment to %MOTION% has just been published on Antragsgrün. " .
        "You can see it here: %LINK%\n\n" .
        "Greetings,\n" .
        "  The Antragsgrün-Team",
    'published_email_title'             => 'Your amendment has been published',
    'sidebar_adminedit'                 => 'Admin: edit',
    'sidebar_back'                      => 'Back to the motion',
    'sidebar_mergeintomotion'           => 'Adopt changes into motion',
    'back_to_amend'                     => 'Back to the amendment',
    'initiated_by'                      => 'Submitted by',
    'confirm_bread'                     => 'Confirm',
    'affects_x_paragraphs'              => 'Affects %num% paragraphs',
    'singlepara_revert'                 => 'Revert changes',
    'err_create_permission'             => 'No permission to create amendments.',
    'err_create'                        => 'An error occurred while creating it',
    'err_save'                          => 'An error occurred while saving it',
    'err_type_missing'                  => 'You have to enter a type.',
    'err_not_found'                     => 'The amendment was not found',
    'err_withdraw_forbidden'            => 'No permission to withdraw this amendment.',
    'err_edit_forbidden'                => 'Not allowed to edit this amendment.',
    'err_not_visible_yet_title'         => 'Not visible yet',
    'err_not_visible_yet'               => 'This amendment is not yet visible.',
    'withdraw_done'                     => 'The amendment has been withdrawn.',
    'withdraw_bread'                    => 'Withdraw',
    'withdraw'                          => 'Withdraw',
    'withdraw_confirm'                  => 'Do you really want to withdraw this amendment?',
    'withdraw_no'                       => 'No',
    'withdraw_yes'                      => 'Yes, withdraw',
    'widthdraw_done'                    => 'The amendment has been withdrawn.',
    'withdrawn_adminnoti_title'         => 'Amendment withdrawn',
    'withdrawn_adminnoti_body'          => "An amendment was withdrawn.\nMotion: %TITLE%\nProposer: %INITIATOR%\nLink: %LINK%",
    'title_amend_to'                    => 'Change to',
    'title_new'                         => 'New title',
    'like_done'                         => 'You liked this amendment.',
    'dislike_done'                      => 'You disliked this amendment.',
    'neutral_done'                      => 'You withdrew your like or dislike.',
    'comments_screening_queue_1'        => '1 comment is waiting for screening',
    'comments_screening_queue_x'        => '%NUM% comments are waiting for screening',
    'comments_please_log_in'            => 'Please log in to post a comment',
    'confirmed_support_phase'           => "You created the amendment.<br>\nTo officially submit it, it needs at least <strong>%MIN% supporters</strong>.<br>\nSend the following link to gain support for your amendment:",
    'submitted_adminnoti_title'         => 'New amendment',
    'submitted_adminnoti_body'          => "A new amendment was submitted.\nMotion: %TITLE%\nProposer: %INITIATOR%\nLink: %LINK%",
    'submitted_screening_email'         => "Hi,\n\nYou just submitted an amendment. It will now be screened and then published. You will be notified separately, once this happens.\n\nYou can see the amendment here: %LINK%",
    'submitted_screening_email_subject' => 'Amendment submitted',
    'support_collect_explanation_title' => 'Find supporters',
    'support_collect_explanation'       => 'Amendment submissions by individuals require at least %MIN% supporters to proceed. Please follow this procedure:<br><ol>
        <li><strong>Create a draft:</strong> Enter the amendment and your contact data on this page. Please confirm on the following page that you want to create it.</li>
        <li><strong>Finding supporters:</strong> You will find a link that you can send to interested persons. Everyone can access this page given this link. Everyone having the necessary privileges can support this amendment here.</li>
        <li><strong>Submit the motion:</strong> Once %MIN% people support the amendment, you will receive a notification by e-mail. Now you can officially submit it. Once submitted, the amendment can still receive support from people.</li>
        </ol>',
    'merge_explanation'                 => '',
    // 'The text, including all amendments within the text, is shown here. For each amendment, you can specify whether you <strong>accept or reject</strong> it - simply click the right mouse button on amendment and then chose either "Accept" or “Reject".<br><br>In addition, you can <strong>freely edit</strong> the text to make editorial changes.<br>###COLLIDINGHINT###<br><br>Then you can select the new amendment status and click “Continue”. A <strong>new amendment "###NEWPREFIX###"</strong> is generated. The original motion, including the amendments, remain as a reference, but are marked as “old”.'
    'merge_explanation_colliding'       => '',
    // '<br><span class="glyphicon glyphicon-warning-sign" style="float: left; font-size: 2em; margin: 10px;"></span> As there are multiple amendments to this motion which refer to the same text passage - <strong>colliding amendments</strong> - it is necessary to insert the amendments manually. Then, please delete the colliding amendment by first hitting the Delete/Del key and then accepting the amendment using the right mouse button.'
    'merge_amend_by'                    => '%TITLE%, by %INITIATOR%',
    'merge_amend_editorials'            => 'Editorial amendment',
    'support'                           => 'Support',
    // 'Unterstützen'
    'support_question'                  => 'Do you really want to support this amendment?',
    'support_orga'                      => 'Organization',
    'support_name'                      => 'Name',
    'support_done'                      => 'You are now supporting this amendment',
    'support_already'                   => 'You are already supporting this amendment',
    'support_collection_hint'           => 'This amendment is not yet officially submitted. <strong>At least %MIN% supporters (currently: %CURR%)</strong> need to support it. You can support this amendment on this page.',
    'support_collection_reached_hint'   => 'This amendment has the necessary number of supporters, but is not yet officially submitted. This is up to the amendment proposer.',
    'support_reached_email_subject'     => 'Your amendment has enough supporters',
    'support_reached_email_body'        => "Hi,<br><br>your amendment to \"%TITLE%\" has the necessary number of supporters. You can officially submit it here:<br><br><strong>%LINK%</strong><br><br>Please note that this step is mandatory to submit the amendment.",
    'support_finish_btn'                => 'Officially submit the amendment',
    'support_finish_err'                => 'This is not (yet) possible.',
    'support_finish_done'               => 'The amendment is now officially submitted',

    'merge1_title'               => 'Adopt the amendment',
    'merge1_step1_title'         => 'Set status',
    'merge1_step2_title'         => 'Specify changes',
    'merge1_step3_title'         => 'Handle collisions',
    'merge1_intro_user'          => 'Once the changes of this amendment are adopted, a new version of the motion including these changes is created. The original version and this amendment will be kept for reference.',
    'merge1_introduction'        => 'Once the changes of this amendment are adopted, a new version of the motion including these changes is created. The original version and this amendment will be kept for reference.<br><br>If adopting this amendment makes other amendments redundant, please mark them as such.<br><br><strong>Hint:</strong> if this changes parts of the motion that are affected by other amendments, a collision will occur. In this case, you need to manual edit the colliding amendments.',
    'merge1_introduction_user'   => 'Once the changes of this amendment are adopted, a new version of the motion including these changes is created. The original version and this amendment will be kept for reference.<br><br><strong>Hint:</strong> if this changes parts of the motion that are affected by other amendments, a collision will occur. In this case, you need to manual edit the colliding amendments.',
    'merge1_status_intro'        => 'If other amendments are made redundant by this change (e.g. if they were covered by this amendment or rejected in favour of this one), you can mark them as such.<br>Amendments marked as rejected or adopted (modified) here do not lead to collisions.',
    'merge1_collission_intro'    => '<strong>There is a collision with an amendment</strong><br><br>The changes made are in conflict with an amendment. You need to edit the affected text passage of the amendment manually. Please rewrite the following text passages of the amendment to include the above changes, but <strong>preserve the meaning of the amendment</strong>.',
    'merge1_changein_x'          => 'Change from %LINEFROM% to %LINETO%',
    'merge1_changein_1'          => 'Change in line %LINEFROM%',
    'merge1_use_unchanged'       => 'Adopt as it is',
    'merge1_use_modified'        => 'Modified adoption',
    'merge1_modify_title'        => 'Modify the amendment',
    'merge1_check_collissions'   => 'Next / check for collisions',
    'merge1_other_status'        => 'New statuses of the other amendments',
    'merge1_status_unchanged'    => 'unchanged',
    'merge1_amend_by'            => 'by',
    'merge1_goon'                => 'Next',
    'merge1_loading'             => 'Checking...',
    'merge1_motion_prefix'       => 'New signature of the motion',
    'merge1_amend_status'        => 'New status of this amendment',
    'merge1_done_title'          => 'The motion has been changed.',
    'merge1_done_str'            => 'The amendment has been adopted',
    'merge1_done_goto'           => 'New version of the motion',
    'merge1_submitted_by'        => 'Submitted by',
    'merge1_submitted_on'        => 'on',
    'merge1_no_collissions'      => 'No conflict with other amendments',
    'merge1_manual_changes'      => 'Your current changes',
    'merge1_manual_amend'        => 'Changes made by the colliding amendment',
    'merge1_manual_new'          => 'New version of the colliding amendment %AMEND%',
    'merge1_err_collission'      => 'Cannot be merged automatically',
    'merge1_err_collission_desc' => 'This amendment cannot be merged into the motion automatically, as there are conflicts between the changes of this amendment and changes proposed by other amendments¥. The conflicting amendments have to be withdrawn or modified first by the proposers or admins. Please contact the admins of this consultation to resolve this issue.<br><br>The following amendments have colliding changes:',
];
