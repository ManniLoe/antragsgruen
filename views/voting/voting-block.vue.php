<?php
ob_start();
?>

<section class="voting" aria-label="Current Voting">
    <template v-if="mode === 'vote'">
        <ul class="voteList">
            <li v-for="(item, index) in voting.items">
                <div class="titleLink">
                    {{ item.title_with_prefix }}
                    <a :href="item.url_html"><span class="glyphicon glyphicon-new-window" aria-label="Änderungsantrag anzeigen"></span></a><br>
                    <span class="amendmentBy">By {{ item.initiators_html }}</span>
                </div>
                <div class="votingOptions">
                    <button type="button" class="btn btn-default btn-sm" @click="voteYes(item)">
                        Yes
                    </button>
                    <button type="button" class="btn btn-default btn-sm" @click="voteNo(item)">
                        No
                    </button>
                    <button type="button" class="btn btn-default btn-sm" @click="voteAbstention(item)">
                        Abstention
                    </button>
                </div>
            </li>
        </ul>
        <footer class="votingFooter">
            <div class="votedCounter">
                <strong>Status:</strong> 13 votes have been casted
            </div>
            <div class="showAll">
                <a href=""><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Show all votings</a>
            </div>
        </footer>
        <div class="votingExplanation">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <strong>Who can see how I voted?</strong>
            The votes are visible to the administrators of this page, but not for other participants using this page.
        </div>
    </template>
    <template v-if="mode === 'result'">
        <ul class="votingResultList">
            <li v-for="(item, index) in voting.items">
                <div class="titleLink">
                    {{ item.title_with_prefix }}
                    <a :href="item.url_html"><span class="glyphicon glyphicon-new-window" aria-label="Änderungsantrag anzeigen"></span></a><br>
                    <span class="amendmentBy">By {{ item.initiators_html }}</span>
                </div>
                <div class="votesDetailed">
                    <div class="yes">Yes: 15.3 <small>(10 NYO, 8 INGYO)</small></div>
                    <div class="no">No: 8.5 <small>(6 NYO, 4 INGYO)</small></div>
                    <div class="abstention">Abstention: 2.2 <small>(2 NYO, 1 INGYO)</small></div>
                </div>
                <div class="result">
                    <div class="accepted">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Accepted
                    </div>
                </div>
            </li>
        </ul>
        <footer class="votingFooter">
            <div class="votingDetails">
                <strong>Full Members present:</strong> 25 NYO, 16 INGYO<br>
                <strong>Quorum:</strong> 20 for NYO, 12 for INGYO
            </div>
            <div class="showAll">
                <a href=""><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Show all votings</a>
            </div>
        </footer>
    </template>
</section>


<?php
$html = ob_get_clean();
?>

<script>
    Vue.component('voting-block-widget', {
        template: <?= json_encode($html) ?>,
        props: ['voting'],
        data() {
            return {
                mode: 'vote'
            }
        },
        computed: {
        },
        methods: {
            voteYes: function (item) {
                console.log("Yes", item);
                this.mode = 'result';
            },
            voteNo: function (item) {
                console.log("No", item);
                this.mode = 'result';
            },
            voteAbstention: function (item) {
                console.log("Abstention", item);
                this.mode = 'result';
            }
        }
    });
</script>