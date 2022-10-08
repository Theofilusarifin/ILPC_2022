<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pemain;
use App\Http\Controllers\Penpos;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\Sekretariat;
use App\Http\Controllers\Soal;
use App\Http\Controllers\Acara;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ParticipantController;

Route::group(['as' => 'visitor.'], function () {
    Route::view('/', 'visitor.home')->name("index");
    Route::view('/home', 'visitor.home')->name("index");
    Route::view('acara/penilaian', 'visitor.penilaian')->name("penilaian");
    Route::view('acara/peraturan', 'visitor.peraturan')->name("peraturan");
    Route::view('acara/detail', 'visitor.detail')->name("detail");
    Route::view('/faq', 'visitor.faq')->name("faq");
    Route::view('/gallery', 'visitor.gallery')->name("gallery");
    Route::view('/event', 'visitor.event')->name("event");
    Route::view('/contact', 'visitor.contact')->name("contact");
});

Auth::routes();

Route::post('/register/getSchool', [RegisterController::class, "getSchool"])->name('register.getSchool');
Route::post('/register/getTeacher', [RegisterController::class, "getTeacher"])->name('register.getTeacher');
Route::post('/getScoreboard', [ScoreboardController::class, "getScoreboard"])->name('getScoreboard');
Route::post('/getMap', [Penpos\GambesController::class, "getMap"])->name('getMap');

// Sekretariat Route
Route::group(
    ['prefix' => 'sekretariat', 'as' => 'sekretariat.', 'middleware' => 'sekretariat'],
    function () {
        Route::get('/', [Sekretariat\SekretariatController::class, "index"])->name('index');

        // Registration Navigation{{  }}
        Route::post('/getRegistrationCount', [Sekretariat\SekretariatController::class, "getRegistrationCount"])->name('getRegistrationCount');
        // Team Pages
        Route::get('/teams/search', [Sekretariat\TeamController::class, "search"])->name('teams.search');
        Route::post('/teams/read-more', [Sekretariat\TeamController::class, "teamsReadMore"])->name('teams.readMore');
        Route::post('/teams/show-bukti-transfer', [Sekretariat\TeamController::class, "teamsShowBuktiTransfer"])->name('teams.showBuktiTransfer');
        Route::post('/teams/verifikasi-bukti-transfer', [Sekretariat\TeamController::class, "verifiedBuktiTransfer"])->name('teams.verifiedBuktiTransfer');
        Route::post('/teams/unverifikasi-bukti-transfer', [Sekretariat\TeamController::class, "unverifiedBuktiTransfer"])->name('teams.unverifiedBuktiTransfer');
        Route::post('/teams/show-kartu-pelajar', [Sekretariat\TeamController::class, "participantShowKartuPelajar"])->name('participant.showKartuPelajar');
        Route::post('/teams/deactivate/{team}', [Sekretariat\TeamController::class, "teamsDeactivate"])->name('teams.deactivate');
        Route::get('/teams', [Sekretariat\TeamController::class, "index"])->name('teams.index');


        // CRUD Navigation
        Route::get('/schools/search', [Sekretariat\SchoolController::class, "search"])->name('schools.search');
        Route::post('/getSchoolDataToEdit', [Sekretariat\SchoolController::class, "getSchoolDataToEdit"])->name('getSchoolDataToEdit');
        Route::resource('/schools', Sekretariat\SchoolController::class);

        Route::get('/teachers/search', [Sekretariat\TeacherController::class, "search"])->name('teachers.search');
        Route::post('/getTeacherDataToEdit', [Sekretariat\TeacherController::class, "getTeacherDataToEdit"])->name('getTeacherDataToEdit');
        Route::resource('/teachers', Sekretariat\TeacherController::class);

        Route::post('/getAdminDataToEdit', [Sekretariat\AdminController::class, "getAdminDataToEdit"])->name('getAdminDataToEdit');
        Route::resource('/admins', Sekretariat\AdminController::class);
    }
);

// Penpos Route
Route::group(
    ['prefix' => 'penpos', 'as' => 'penpos.', 'middleware' => 'soal'],
    function () {
        Route::get('/', [Soal\SoalController::class, "index"])->name('index');
        Route::get('/rally-games', [Penpos\RallyGameController::class, "index"])->name('rg.index');
        Route::post('/rally-games/get/data/team', [Penpos\RallyGameController::class, "getDataTeam"])->name('rg.data.team');
        Route::post('/rally-games/update/score', [Penpos\RallyGameController::class, "updateScore"])->name('rg.update.score');

        Route::get('/gambes', [Penpos\GambesController::class, 'index'])->name('gb.index');
        
        Route::post('/gambes/move/player', [Penpos\GambesController::class, 'move'])->name('gb.move');
        Route::post('/gambes/action/player', [Penpos\GambesController::class, 'action'])->name('gb.action');
        Route::post('/gambes/action/set-spawn-point', [Penpos\GambesController::class, 'setSpawnPoint'])->name('gb.set.spawn');


    }
);

// Acara Route
Route::group(
    ['prefix' => 'acara', 'as' => 'acara.', 'middleware' => 'soal'],
    function () {
        Route::get('/', [Soal\SoalController::class, "index"])->name('index');
        Route::get('/rally-games', [Acara\RallyGameController::class, "index"])->name('rg.index');
        Route::get('/rally-games/search', [Acara\RallyGameController::class, "search"])->name('rg.search');
        Route::post('/rally-games/store', [Acara\RallyGameController::class, "store"])->name('rg.store');
        Route::post('/rally-games/destroy/{rallyGame}', [Acara\RallyGameController::class, "destroy"])->name('rg.destroy');
        Route::get('/rally-games/scoreboard', [Acara\RallyGameController::class, "scoreboard"])->name('rg.scoreboard');

        //Wave
        Route::get('/game-besar/wave', [Acara\GambesController::class, "index_wave"])->name('gambes.wave.index');
        Route::post('/game-besar/wave/store', [Acara\GambesController::class, "store_wave"])->name('gambes.wave.store');
        Route::post('/game-besar/wave/update/{wave}', [Acara\GambesController::class, "update_wave"])->name('gambes.wave.update');
        Route::post('/game-besar/wave/destroy/{wave}', [Acara\GambesController::class, "destroy_wave"])->name('gambes.wave.destroy');

         //Item
         Route::get('/game-besar/item', [Acara\GambesController::class, "index_item"])->name('gambes.item.index');
         Route::post('/game-besar/item/store', [Acara\GambesController::class, "store_item"])->name('gambes.item.store');
         Route::post('/game-besar/item/update/{item}', [Acara\GambesController::class, "update_item"])->name('gambes.item.update');
         Route::post('/game-besar/item/destroy/{item}', [Acara\GambesController::class, "destroy_item"])->name('gambes.item.destroy');

    }
);

// Soal Route
Route::group(
    ['prefix' => 'soal', 'as' => 'soal.', 'middleware' => 'soal'],
    function () {
        Route::get('/', [Soal\SoalController::class, "index"])->name('index');

        // Programming Contest
        Route::get('/programming', [Soal\SoalController::class, "programming"])->name('prg.index');
        Route::get('/programming/search', [Soal\PrgController::class, "search_contest"])->name('prg.search');
        Route::post('/programming/store', [Soal\PrgController::class, "store_contest"])->name('prg.store');
        Route::post('/programming/update/{contest}', [Soal\PrgController::class, "update_contest"])->name('prg.update');
        Route::post('/programming/destroy/{contest}', [Soal\PrgController::class, "destroy_contest"])->name('prg.destroy');
        Route::get('/programming/{contest}', [Soal\PrgController::class, "show_contest"])->name('prg.show');

        // Programming Question
        Route::post('/programming/question/destroy', [Soal\PrgController::class, "destroy_question"])->name('prg.question.destroy');
        Route::get('/programming/{contest}/question/create', [Soal\PrgController::class, "create_question"])->name('prg.question.create');
        Route::post('/programming/{contest}/question/store', [Soal\PrgController::class, "store_question"])->name('prg.question.store');
        Route::get('/programming/{contest}/question/{question}/edit', [Soal\PrgController::class, "edit_question"])->name('prg.question.edit');
        Route::post('/programming/{contest}/question/{question}/update', [Soal\PrgController::class, "update_question"])->name('prg.question.update');
        Route::post('/programming/{contest}/question/{question}/rejudge', [Soal\PrgController::class, "rejudge_question"])->name('prg.question.rejudge');

        // Programming Submission
        Route::get('/programming/{contest}/submission', [Soal\PrgController::class, "show_submission"])->name('prg.submission');
        Route::post('/programming/{contest}/submission/{submission}/judge', [Soal\PrgController::class, "judge_submission"])->name('prg.submission.judge');

        // Programming Participants
        Route::get('/programming/{contest}/participant', [Soal\PrgController::class, "show_participant"])->name('prg.participant');
        Route::post('/programming/{contest}/participant/store', [Soal\PrgController::class, "store_participant"])->name('prg.participant.store');
        Route::post('/programming/{contest}/participant/destroy/{team}', [Soal\PrgController::class, "destroy_participant"])->name('prg.participant.destroy');

        // Programming Scoreboard
        Route::get('/programming/{contest}/{scoreboard_slug}', [Soal\PrgController::class, "show_scoreboard"])->name('prg.scoreboard');


        // Essay Contest
        Route::get('/essay', [Soal\SoalController::class, "essay"])->name('essay.index');
        Route::get('/essay/search', [Soal\EssayController::class, "search_contest"])->name('essay.search');
        Route::post('/essay/store', [Soal\EssayController::class, "store_contest"])->name('essay.store');
        Route::post('/essay/update/{contest}', [Soal\EssayController::class, "update_contest"])->name('essay.update');
        Route::post('/essay/updatescore/{contest}', [Soal\EssayController::class, "update_total_skor"])->name('essay.updatescore');
        Route::post('/essay/destroy/{contest}', [Soal\EssayController::class, "destroy_contest"])->name('essay.destroy');
        Route::get('/essay/{contest}', [Soal\EssayController::class, "show_contest"])->name('essay.show');

        // Essay Question
        Route::post('/essay/question/destroy', [Soal\EssayController::class, "destroy_question"])->name('essay.question.destroy');
        Route::get('/essay/{contest}/question/create', [Soal\EssayController::class, "create_question"])->name('essay.question.create');
        Route::post('/essay/{contest}/question/store', [Soal\EssayController::class, "store_question"])->name('essay.question.store');

        // Essay Submission
        Route::get('/essay/{contest}/submission', [Soal\EssayController::class, "show_submission"])->name('essay.submission');

        // Essay Participants
        Route::get('/essay/{contest}/participant', [Soal\EssayController::class, "show_participant"])->name('essay.participant');
        Route::post('/essay/{contest}/participant/store', [Soal\EssayController::class, "store_participant"])->name('essay.participant.store');
        Route::post('/essay/{contest}/participant/destroy/{team}', [Soal\EssayController::class, "destroy_participant"])->name('essay.participant.destroy');

        // Mc Contest
        Route::get('/multiple-choice', [Soal\SoalController::class, "multipleChoice"])->name('mc.index');
        Route::get('/multiple-choice/search', [Soal\McController::class, "search_contest"])->name('mc.search');
        Route::post('/multiple-choice/store', [Soal\McController::class, "store_contest"])->name('mc.store');
        Route::post('/multiple-choice/update/{contest}', [Soal\McController::class, "update_contest"])->name('mc.update');
        Route::post('/multiple-choice/destroy/{contest}', [Soal\McController::class, "destroy_contest"])->name('mc.destroy');
        Route::get('/multiple-choice/{contest}', [Soal\McController::class, "show_contest"])->name('mc.show');

        // Mc Question
        Route::post('/multiple-choice/question/destroy', [Soal\McController::class, "destroy_question"])->name('mc.question.destroy');
        Route::get('/multiple-choice/{contest}/question/create', [Soal\McController::class, "create_question"])->name('mc.question.create');
        Route::post('/multiple-choice/{contest}/question/store', [Soal\McController::class, "store_question"])->name('mc.question.store');
        Route::get('/multiple-choice/{contest}/question/{question}/edit', [Soal\McController::class, "edit_question"])->name('mc.question.edit');
        Route::post('/multiple-choice/{contest}/question/{question}/update', [Soal\McController::class, "update_question"])->name('mc.question.update');

        // MC Participants
        Route::get('/multiple-choice/{contest}/participant', [Soal\McController::class, "show_participant"])->name('mc.participant');
        Route::post('/multiple-choice/{contest}/participant/store', [Soal\McController::class, "store_participant"])->name('mc.participant.store');
        Route::post('/multiple-choice/{contest}/participant/destroy/{team}', [Soal\McController::class, "destroy_participant"])->name('mc.participant.destroy');

        // Soal Playground
        Route::get('/run-code', [Soal\SoalController::class, "runCode"])->name('run.code');
        Route::post('/run-code/execute', [Soal\SoalController::class, "executeCode"])->name('run.code.execute');
        Route::get('/summerize-score', [Soal\SoalController::class, "summerizeScore"])->name('summerize.score');
        Route::post('/summerize-score/jenis-contest', [Soal\SoalController::class, "getJenisContest"])->name('summerize.jenisContest');
        Route::post('/summerize-score/total-score', [Soal\SoalController::class, "getTotalScore"])->name('summerize.totalScore');

        Route::post('/set-mode', [ParticipantController::class, "setMode"])->name('set.mode');
    }
);

// Soal Route
// Route::group(
//     ['prefix' => 'acara', 'as' => 'acara.', 'middleware' => 'acara'],
//     function () {
//         Route::get('/', [Acara\AcaraController::class, "index"])->name('index');

//         // Rally Games
//         Route::get('/rally-games', [RallyGameController::class, "index"])->name('rally.index');
//     }
// );

// Pemain Route
Route::group(
    ['prefix' => 'pemain', 'as' => 'pemain.', 'middleware' => 'pemain'],
    function () {
        Route::get('/', [Pemain\PemainController::class, "index"])->name('index');
        // Route::get('/active-contest', [Pemain\PemainController::class, "activeContest"])->name('active.contest');
        Route::get('/contest', [Pemain\PemainController::class, "contest"])->name('contest');
        Route::post('/contest/join-contest', [Pemain\PemainController::class, "joinContest"])->name('join.contest');
        Route::post('/', [Pemain\PemainController::class, "upload"])->name('upload.payment');

        // Programming
        Route::get('/contest/programming/{contest:slug}', [Pemain\PrgController::class, "index"])->name('contest.prg');
        Route::post('/contest/programming/finish-attempt', [Pemain\PrgController::class, "finish_attempt"])->name('contest.prg.finishAttempt');
        Route::get('/contest/programming/{contest:slug}/scoreboard', [Pemain\PrgController::class, "scoreboard"])->name('contest.prg.scoreboard');
        Route::get('/contest/programming/{contest:slug}/submission-history', [Pemain\PrgController::class, "submission"])->name('contest.prg.submission');
        Route::get('/contest/programming/{contest:slug}/{question}', [Pemain\PrgController::class, "show"])->name('contest.prg.question');
        Route::post('/contest/programming/{contest:slug}/{question}', [Pemain\PrgController::class, "storeAnswer"])->name('contest.prg.question.submission');

        // Mc
        Route::get('/contest/multiple-choice/{contest:slug}/{nomor}', [Pemain\McController::class, "show"])->name('contest.mc');
        Route::post('/contest/multiple-choice/submit', [Pemain\McController::class, "store_submission"])->name('contest.mc.submit');

        // Essay
        Route::get('/contest/essay/{contest:slug}', [Pemain\EssayController::class, "show"])->name('contest.essay');
        Route::post('/contest/essay/{contest:slug}', [Pemain\EssayController::class, "uploadAnswer"])->name('contest.essay.upload');

        //Rally
        Route::get('/rally-games', [Pemain\RallyGameController::class, "index"])->name('rally');
        Route::get('/rally-games/shop', [Pemain\RallyGameController::class, "shop"])->name('shop');
        Route::post('/rally-games/shop/buy/{item:name}', [Pemain\RallyGameController::class, "buy"])->name('buy');
        Route::post('/rally-games/shop/change-equipment', [Pemain\RallyGameController::class, "change_equipment"])->name('changeEquipment');
    }
);
