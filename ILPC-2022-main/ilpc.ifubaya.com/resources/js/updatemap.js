require("./bootstrap");

window.Echo.channel("update-map").listen(".UpdateMapMessage", e => {
    console.log(e.message);
    let tableData = "";
    $.ajax({
        type: "POST",
        url: "/getMap",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content")
        },
        success: function(data) {
            let dibuka = "";
            $.each(data.territories, (key, territory) => {
                if (key == 0 || key % 20 == 0) {
                    dibuka = key;
                    tableData += `<tr>`;
                }

                if (territory.num_occupants == 1) {
                    if (territory.robot_id != null) {
                        let robot_percentage = (
                            (territory.current_health /
                                territory.robot.health) *
                            100
                        ).toFixed(2);
                        let robot_level = "";
                        if (territory.robot.health <= 150)
                            robot_level = "level1";
                        else if (
                            territory.robot.health > 150 &&
                            territory.robot.health <= 250
                        )
                            robot_level = "level2";
                        else if (
                            territory.robot.health > 250 &&
                            territory.robot.health <= 450
                        )
                            robot_level = "level3";
                        else if (
                            territory.robot.health > 450 &&
                            territory.robot.health <= 600
                        )
                            robot_level = "level4";
                        else if (territory.robot.health > 600)
                            robot_level = "level5";

                        tableData += `
                        <td id='${territory.id}' class='text-center territories robot' num_occupants='${territory.num_occupants}'>
                            <img style='height: 20px;' src="/ilpc2022/gambes/${robot_level}.svg" alt="Robot ${robot_level}">
                            <div class="progress progress-bar-danger">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: ${robot_percentage}%;" role="progressbar" aria-valuenow="${robot_percentage}" aria-valuemin="${robot_percentage}" aria-valuemax="100">${robot_percentage}%</div>
                            </div>
                        </td>
                        `;
                    } else {
                        let player_percentage = (
                            (territory.players[0].current_health /
                                territory.players[0].max_health) *
                            100
                        ).toFixed(2);
                        tableData += `
                        <td id='${territory.id}' class='text-center territories player' num_occupants='${territory.num_occupants}'>
                            ${territory.players[0].id}
                            <div class="progress progress-bar-danger">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: ${player_percentage}%;" role="progressbar" aria-valuenow="${player_percentage}" aria-valuemin="${player_percentage}" aria-valuemax="${player_percentage}">${player_percentage}%</div>
                            </div>
                        </td>
                        `;
                    }
                } else if (territory.num_occupants == 2) {
                    if (territory.robot_id != null) {
                        let first_player_percentage = (
                            (territory.players[0].current_health /
                                territory.players[0].max_health) *
                            100
                        ).toFixed(2);
                        let robot_percentage = (
                            (territory.current_health /
                                territory.robot.health) *
                            100
                        ).toFixed(2);
                        let robot_level = "";
                        if (territory.robot.health <= 150)
                            robot_level = "level1";
                        else if (
                            territory.robot.health > 150 &&
                            territory.robot.health <= 250
                        )
                            robot_level = "level2";
                        else if (
                            territory.robot.health > 250 &&
                            territory.robot.health <= 450
                        )
                            robot_level = "level3";
                        else if (
                            territory.robot.health > 450 &&
                            territory.robot.health <= 600
                        )
                            robot_level = "level4";
                        else if (territory.robot.health > 600)
                            robot_level = "level5";
                        tableData += `
                        <td id='${territory.id}' class='text-center territories robot' num_occupants='${territory.num_occupants}'>
                            <div class="progress progress-bar-info">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: ${first_player_percentage}%;" role="progressbar" aria-valuenow="${first_player_percentage}" aria-valuemin="${first_player_percentage}" aria-valuemax="${first_player_percentage}">${first_player_percentage}%</div>
                            </div>
                            <span class="text-info">${territory.players[0].id}</span> vs <img style='height: 20px;' src="/ilpc2022/gambes/${robot_level}.svg" alt="Robot ${robot_level}">
                            <div class="progress progress-bar-warning">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: ${robot_percentage}%;" role="progressbar" aria-valuenow="${robot_percentage}" aria-valuemin="${robot_percentage}" aria-valuemax="100">${robot_percentage}%</div>
                            </div>
                        </td>
                        `;
                    } else {
                        let first_player_percentage = (
                            (territory.players[0].current_health /
                                territory.players[0].max_health) *
                            100
                        ).toFixed(2);
                        let second_player_percentage = (
                            (territory.players[1].current_health /
                                territory.players[1].max_health) *
                            100
                        ).toFixed(2);
                        tableData += `
                        <td id='${territory.id}' class='text-center territories player' num_occupants='${territory.num_occupants}'>
                            <div class="progress progress-bar-info">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: ${first_player_percentage}%;" role="progressbar" aria-valuenow="${first_player_percentage}" aria-valuemin="${first_player_percentage}" aria-valuemax="${first_player_percentage}">${first_player_percentage}%</div>
                            </div>
                            <span class="text-info">${territory.players[0].id}</span> vs <span class="text-warning">${territory.players[1].id}</span>
                            <div class="progress progress-bar-warning">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: ${second_player_percentage}%;" role="progressbar" aria-valuenow="${second_player_percentage}" aria-valuemin="${second_player_percentage}" aria-valuemax="${second_player_percentage}">${second_player_percentage}%</div>
                            </div>
                        </td>
                        `;
                    }
                } else if (territory.is_spawnable == "yes")
                    tableData += `<td id='${territory.id}' class='territories spawnable' onclick="setSpawnPoint('${territory.id}')" num_occupants='${territory.num_occupants}'></td>`;
                else if (territory.is_wall == "yes")
                    tableData += `<td id='${territory.id}' class='territories wall' num_occupants='${territory.num_occupants}'></td>`;
                else {
                    tableData += `<td id='${territory.id}' class='text-center territories refresh' num_occupants='${territory.num_occupants}'></td>`;
                }
            });
            $("#mainTable").html(tableData);
            $(".btn-control-action").attr("disabled", false);
        }
    });
});
