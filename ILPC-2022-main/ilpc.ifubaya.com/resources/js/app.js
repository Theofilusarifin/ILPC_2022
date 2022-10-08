/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

window.Echo.channel("update-scoreboard").listen(".UpdateScoreboardMessage", e => {
    let th = ""
    let tr = ""
    let tf = ""
    $.ajax({
        type: 'POST',
        url: "/getScoreboard",
        data: {
            'contest_id': $('#contest_id').attr('content'),
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            console.log('Data.Questions : ' + data.questions)
            $.each(data.questions, (key, value) => {
                console.log('Value questions : ' + value);

                th += '<th width="5%">' + value.nomor + '</th>';
            })

            let rank = 1;
            $.each(data.teams, (key, _team) => {
                tr += `
                    <tr class="text-center align-top">
                        <td>${rank}</td>
                        <td>${_team.nama_tim}</td>
                        <td>${_team.JB}</td>
                        <td>${_team.total_penalti}</td>
                `;
                $.each(_team.question, (key, _question) => {
                    let total_penalti = "-";
                    if (_question.total_penalti != -1)
                        total_penalti = _question.total_penalti;

                    if (_question.status == null) {
                        tr += `<td>
                                        <label>0/${total_penalti}</label>
                                    </td>`;
                    } else if (
                        _question.status == "Accepted" ||
                        _question.status == "Solved"
                    ) {
                        tr += `<td>
                                        <label class="badge badge-light-success">${_question.attempt}/${total_penalti}</label>
                                    </td>`;
                    } else if (
                        _question.status == "Pending" ||
                        _question.status == "Judging"
                    ) {
                        tr += ` <td>
                                        <label class="badge badge-light-warning ">${_question.attempt}/${total_penalti}</label>
                                    </td>`;
                    } else {
                        tr += `<td>
                                        <label class="badge badge-light-danger">${_question.attempt}/${total_penalti}</label>
                                    </td>`;
                    }
                });
                tr += `<td>${_team.total_attempt[0].total_attempt}/${_team.total_JB[0].total_JB}</td>`;
                rank++;
                tr += `</tr>`;
            });

            $.each(data.total, (key, _total) => {
                tf += `<td>${_total.total_attempt}/${_total.total_JB}</td>`;
            })

            const tempTable =
                `
                <thead>
                    <tr class="text-center">
                        <th width="5%">Rank</th>
                        <th width="12%">Team</th>
                        <th width="5%">Solved</th>
                        <th width="5%">Time</th>
                        ${th}
                        <th width="8%">Attempt/Solved</th>
                    </tr>
                </thead>
                <tbody>
                ${tr}
                </tbody>
                <tfoot>
                <tr class="text-center align-top">
                    <td colspan="4"><b>TOTAL (ATTEMPT/SOLVED)</b></td>
                    ${tf}
                    <td></td>
                </tr>
                </tfoot>
            `
            console.log(tempTable);
            if (e.message == 'pemainAndSoal') {
                $('#tablePemain').html(tempTable);
            }
            $('#tableSoal').html(tempTable);
        }
    })
});