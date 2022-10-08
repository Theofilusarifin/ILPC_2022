// $.ajax({
    //     type: 'POST',
    //     url: "{{ route('getScoreboard') }}",
    //     data: {
    //         '_token': $('meta[name="csrf-token"]').attr('content'),
    //         'contest_id': $('meta[name="contest-id"]').attr('content'),
    //     },
    //     success: function (data) {
    //         console.log(data);
    //         let th = ""
    //         $.each(data.questions, value => {
    //             th += '<th width="5%">' + value.nomor + '</th>';
    //         })

    //         let tr = ""
    //         $.each(data.scoreboards, _scoreboard => {
    //             let rank = 1
    //             tr += `
    //                 <tr class="text-center align-top">
    //                     <td>${rank}</td>
    //                     <td>${_scoreboard.team_name}</td>
    //                     <td>${_scoreboard.solved}</td>
    //                     <td>${_scoreboard.time}</td>
    //             `

    //             $.each(scoreboard.question, _question => {
    //                 let time = -1;
    //                 if (_question.time != -1) time = _question.time

    //                 if (_question.status == null) {
    //                     tr += `<td>
    //                                     <label>0/${time}</label>
    //                                 </td>`
    //                 }
    //                 else if (_question.status == "Accepted" || _question.status == "Solved") {
    //                     tr += `<td>
    //                                     <label class="badge badge-light-success">${_question.attempt}/+${time}</label>
    //                                 </td>`
    //                 }
    //                 else if (_question.status == "Pending" || _question.status == "Judging") {
    //                     tr += ` <td>
    //                                     <label class="badge badge-light-warning ">${_question.attempt}/${time}</label>
    //                                 </td>`

    //                 }
    //                 else {
    //                     tr += `<td>
    //                                     <label class="badge badge-light-danger">${_question.attempt}/${time}</label>
    //                                 </td>`
    //                 }
    //             })
    //             tr += `<td>${_scoreboard.total_attempt[0].total_attempt}/${_scoreboard.total_solved[0].total_solved}</td>`
    //             rank++;
    //             tr += `</tr>`;
    //         })

    //         let tf = ""
    //         $.each(data.total, _total => {
    //             tf += `<td>${_total.attempt}/${_total.solved}</td>`
    //         })
    //     }
    // })
    // const tempTable =
    //     `
    //     <thead>
    //         <tr class="text-center">
    //             <th width="5%">Rank</th>
    //             <th width="12%">Team</th>
    //             <th width="5%">Solved</th>
    //             <th width="5%">Time</th>
    //             ${th}
    //             <th width="8%">Attempt/Solved</th>
    //         </tr>
    //     </thead>
    //     <tbody>
    //     ${tr}
    //     </tbody>
    //     <tfoot>
    //     <tr class="text-center align-top">
    //         <td colspan="4"><b>TOTAL (ATTEMPT/SOLVED)</b></td>
    //         ${tf}
    //         <td></td>
    //     </tr>
    //     </tfoot>
    // `
    // if (e.message = 'pemainAndSoal') {
    //     $('#tablePeserta').html(tempTable);
    // }
    // $('#tableSoal').html(tempTable);