<?php

declare(strict_types=1);

return [
    'votings_bc' => 'Votacions',
    'results_bc' => 'Resultats',
    'admin_bc' => 'Administració',

    'sidebar_open' => 'Votacions obertes',
    'sidebar_results' => 'Resultats',
    'sidebar_admin' => 'Administració',

    'title_user_single' => 'Votació',

    'vote_yes' => 'Sí',
    'vote_no' => 'No',
    'vote_abstention' => 'Abstenció',
    'vote_present' => 'Present',
    'vote_undo' => 'Desfer vot',

    'status_accepted' => 'Acceptat',
    'status_rejected' => 'Rebutjat',
    'status_quorum_missed' => 'Quòrum no assolit',
    'status_quorum_reached' => 'Quòrum assolit',

    'activity_title' => 'Protocol',
    'activity_show_all' => 'Mostrar protocol complet',
    'activity_opened' => 'Votació oberta',
    'activity_closed' => 'Votació tancada',
    'activity_reset' => 'Votació reiniciada',
    'activity_reopened' => 'Votació reoberta',

    'page_title' => 'Votacions',
    'results_title' => 'Resultats de la votació',
    'results_none' => 'Encara no s\'han publicat resultats de la votació',
    'results_download' => 'Resultats en full de càlcul',
    'votings_none' => 'No hi ha votacions obertes',
    'remaining_time' => 'Temps de votació',

    'admin_title' => 'Administració de votacions',
    'admin_intro' => '<strong>Pista:</strong> pots trobar un manual per a la funcionalitat de votació a la <a href="https://sandbox.motion.tools/help#advanced">pàgina d\'ajuda</a>.',
    'admin_aria_single' => 'Administrar votació',
    'admin_voting_use' => 'Votació en línia',
    'admin_voting_use_h' => 'La votació sobre les següents resolucions i esmenes tindrà lloc en línia a Antragsgrün',
    'admin_votes_total' => 'Total',
    'admin_btn_open' => 'Obrir votació',
    'admin_btn_close' => 'Tancar votació',
    'admin_btn_close_op' => 'Tancar: mostrar més opcions',
    'admin_btn_close_pub' => 'Tancar i publicar (per defecte)',
    'admin_btn_close_nopub' => 'Tancar sense publicar resultats',
    'admin_btn_cancel' => 'Cancel·lar',
    'admin_btn_reset' => 'Reiniciar',
    'admin_btn_reset_bb' => 'Això eliminarà tots els vots i configurarà la votació de nou en mode de preparació, on podràs afegir o eliminar resolucions i esmenes. AVÍS: Tots els usuaris hauran de votar de nou.',
    'admin_btn_reopen' => 'Reobrir',
    'admin_btn_publish' => 'Publicar resultats',
    'admin_btn_remove_item' => 'Eliminar de la votació',
    'admin_status_opened' => 'La votació està <strong>oberta</strong>, els usuaris ja poden votar',
    'admin_status_closed' => 'La votació està <strong>tancada</strong>, els resultats <strong>publicats</strong>.',
    'admin_status_closed_unpublished' => 'Aquesta votació està <strong>tancada</strong>, però els resultats encara <strong>no s\'han publicat</strong>.',
    'admin_members_present' => 'Membres presents',
    'admin_no_items_yet' => 'Encara no s\'ha afegit cap resolució, esmena o ítem de votació a aquesta votació.',
    'admin_add_amendments' => 'Afegir una resolució o esmena',
    'admin_add_amendments_opt' => 'Si us plau, selecciona una resolució/esmena per afegir',
    'admin_add_question' => 'Afegir un ítem de votació',
    'admin_add_question_title' => 'Ítem de votació',
    'admin_add_btn' => 'Afegir resolució o esmena seleccionada',
    'admin_add_opt_motion' => 'Afegir la resolució',
    'admin_add_opt_all_amend' => 'Afegir totes les esmenes següents',
    'admin_add_abort' => 'Avortar afegint',
    'admin_settings_open' => 'Mostrar configuracions',
    'admin_settings_close' => 'Tancar configuracions',
    'admin_mvtoug_caller' => 'Assignar votants a un grup d\'usuaris',

    'settings_create' => 'Nova votació',
    'settings_sort' => 'Ordenar',
    'settings_open' => 'Mostrar configuracions',
    'settings_close' => 'Amagar configuracions',
    'settings_votingtype' => 'Què es vota?',
    'settings_votingtype_motion' => 'Resolucions i/o esmenes',
    'settings_votingtype_question' => 'Un ítem de votació específic',
    'settings_title' => 'Títol',
    'settings_question' => 'Primer ítem de votació',
    'settings_answers' => 'Opcions de resposta',
    'settings_answers_yesnoabst' => 'Sí, No, Abstenció',
    'settings_answers_yesno' => 'Sí, No',
    'settings_answers_yes' => 'Sí',
    'settings_answers_yesh' => 'Per a llistes. Després de la creació, es pot donar el "Nombre de vots per usuari" a les configuracions.',
    'settings_answers_present' => 'Present',
    'settings_answers_presenth' => 'Per a "votacions" destinades a preguntar quins membres estan presents, com ara les crides de llista.',
    'settings_majoritytype' => 'Tipus de majoria',
    'settings_quorumtype' => 'Quòrum',
    'settings_votepolicy' => 'Qui pot votar',
    'settings_resultspublic' => 'Qui pot veure els resultats de la votació',
    'settings_resultspublic_admins' => 'Administradors',
    'settings_resultspublic_all' => 'Tothom',
    'settings_votespublic' => 'Qui pot veure qui ha votat com',
    'settings_votespublic_hint' => 'Aquesta configuració només es pot canviar fins que la votació s\'obri.',
    'settings_votespublic_nobody' => 'Ningú',
    'settings_votespublic_admins' => 'Administradors',
    'settings_votespublic_all' => 'Tothom',
    'settings_maxvotes' => 'Nombre de vots per usuari',
    'settings_maxvotes_h' => 'Això es pot utilitzar, per exemple, per presentar 7 candidats i només permetre fins a 3 vots per cada usuari',
    'settings_maxvotes_none' => 'Il·limitat',
    'settings_maxvotes_limit' => 'Vots limitats',
    'settings_maxvotes_pergroup' => 'Depenent del grup d\'usuaris',
    'settings_maxvotes_votes' => 'Vots',
    'settings_motionassign' => 'Assignat a la resolució',
    'settings_motionassign_h' => 'Si aquesta votació s\'assigna a una resolució, es mostrarà a la pàgina de la resolució, no a la pàgina principal',
    'settings_motionassign_none' => 'Cap',
    'settings_timer' => 'Temps per votar',
    'settings_timer_h' => 'Si es configura un nombre de segons, apareix un compte enrere quan la votació està oberta. Tot i així, això és només informatiu: la votació encara ha de ser tancada explícitament de forma manual.',
    'settings_timer_sec' => 'Segons',
    'settings_save' => 'Desar',
    'settings_delete' => 'Eliminar la votació',
    'settings_delete_bb' => 'Vols eliminar la votació incloent tots els vots emesos? Les resolucions i esmenes romandran intactes.',
    'settings_sort_title' => 'Reordenar votacions',
    'settings_sort_save' => 'Desar nova ordre',

    'voting_current_aria' => 'Votació activa actual',
    'voting_show_amend' => 'Mostrar esmena',
    'voting_edit_amend' => 'Edita l\'esmena',
    'voting_by' => 'Per',
    'voting_admin_all' => 'Administra les votacions',
    'voting_visibility' => 'Qui pot veure com he votat?',
    'voting_visibility_none' => 'Ningú pot veure com has votat. <small>(Tot i això, les persones amb accés a la base de dades podrien accedir a aquestes dades)</small>',
    'voting_visibility_admin' => 'Els vots són visibles per als <strong>administradors</strong> d\'aquesta pàgina, però no per a altres participants.',
    'voting_visibility_all' => '<strong>Tots els usuaris registrats</strong> poden veure qui ha votat com.',
    'voting_show_all' => 'Mostra totes les votacions',
    'voting_votes_status' => 'Estat',
    'voting_votes_0' => 'Encara no s\'ha emès cap vot.',
    'voting_votes_1_1' => 'S\'ha emès 1 vot.',
    'voting_votes_1_x' => '%VOTES% vots han estat emesos per 1 usuari.',
    'voting_votes_x' => '%VOTES% vots han estat emesos per %USERS% usuaris.',
    'voting_votes_x_same' => 'S\'han emès %VOTES% vots.',
    'voting_remainig_0' => 'Has emès tots els teus vots.',
    'voting_remainig_1' => 'Et queda 1 vot per emetre.',
    'voting_remainig_x' => 'Et queden %VOTES% vots per emetre.',
    'voting_notvoted' => 'Sense vot',
    'voting_notvoted_yet' => 'Encara sense vot',
    'voting_notvoted_0' => 'Cap',
    'voting_presence_0' => 'Encara ningú ha marcat la seva presència',
    'voting_presence_1_1' => '1 usuari ha marcat la seva presència',
    'voting_presence_1_x' => '%VOTES% presències han estat marcades per 1 usuari',
    'voting_presence_x' => '%VOTES% presències han estat marcades per %USERS% usuaris',
    'voting_presence_x_same' => 'S\'han marcat %VOTES% presències',
    'voting_show_votes' => 'Mostra la llista de vots',
    'voting_hide_votes' => 'Amaga la llista de vots',

    'majority_simple' => 'Majoria simple',
    'majority_simple_h' => 'Una resolució o esmena s\'adopta, si es reben més vots a favor que en contra. Les abstencions no es compten.',
    'majority_absolute' => 'Majoria absoluta',
    'majority_absolute_h' => 'Una resolució o esmena s\'adopta, si es reben més vots a favor que la suma dels vots en contra i les abstencions.',
    'majority_twothirds' => 'Majoria de 2/3',
    'majority_twothirds_h' => 'Una resolució o esmena s\'adopta, si es reben almenys el doble de vots a favor que en contra. Les abstencions no es compten.',

    'quorum_none' => 'Sense quòrum',
    'quorum_half' => 'Majoria simple',
    'quorum_half_h' => 'Almenys la meitat de tots els usuaris elegibles han de votar',
    'quorum_two_third' => 'Majoria de 2/3',
    'quorum_two_third_h' => 'Almenys dos terços dels usuaris elegibles han de votar',
    'quorum_limit' => '%QUORUM% de %ALL% usuaris',
    'quorum_counter' => 'Quòrum: %CURRENT% de %QUORUM% vots necessaris',
];