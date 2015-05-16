<?php

/**
 * @var \Codeception\Scenario $scenario
 */

use tests\codeception\_pages\ConsultationHomePage;

$I = new AntragsgruenAcceptenceTester($scenario);
$I->populateDBData1();

$I->wantTo('go to the consultation page');

$page = ConsultationHomePage::openBy(
    $I,
    [
        'subdomain'        => 'parteitag',
        'consultationPath' => 'parteitag',
    ]
);

$I->see('Parteitag', 'h1');
$I->dontSeeElement('.moveHandle');
$I->see('Tagesordnung', '.motionListAgenda');


$I->wantTo('edit the agenda a bit');

$I->loginAsStdAdmin();
$I->see('Parteitag', 'h1');
$I->seeElement('.moveHandle');
$I->see('Tagesordnung', '.motionListAgenda');
$I->dontSeeElement('.agendaItemEditForm');
$I->dontSeeElement('#agendaEditSavingHolder');

$I->executeJS('$(".agendaListEditing").find("> li").eq(1).find("> ol").children().last().find("a").click();');
$I->seeElement('.agendaItemEditForm');
$I->seeElement('#agendaitem_-1 .agendaItemEditForm .code');
$I->fillField('#agendaitem_-1 .agendaItemEditForm .code', '3.');
$I->fillField('#agendaitem_-1 .agendaItemEditForm .title', 'More motions');
$I->selectOption('#agendaitem_-1 .agendaItemEditForm .motionType', '5');
$I->executeJS('$(".agendaListEditing").find("> li.agendaItem").last().prependTo(".agendaListEditing")');
$I->seeElement('#agendaEditSavingHolder');
$I->submitForm('#agendaEditSavingHolder', [], ['saveAgenda']);



$I->wantTo('check if my chenges are saved');
$I->dontSeeElement('.agendaItemEditForm');
$I->dontSeeElement('#agendaEditSavingHolder');
$I->see('More Motions');
// @TODO
