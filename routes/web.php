<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/getstarted', function()
{
    return view('getstarted');
})->name('/getstarted');

Route::post('inviteToTeam', '\App\Http\Controllers\MainpageController@inviteToTeam');

Route::post('populateTeamInvites', '\App\Http\Controllers\MainpageController@populateTeamInvites');

Route::post('loadComments', '\App\Http\Controllers\MainpageController@loadComments');

Route::post('submitComment', '\App\Http\Controllers\MainpageController@submitComment');

Route::post('report', '\App\Http\Controllers\MainpageController@report');

Route::post('updateRating', '\App\Http\Controllers\MainpageController@updateRating');

Route::post('loadChatBox', '\App\Http\Controllers\MainpageController@loadChatBox');

Route::post('sendChat', '\App\Http\Controllers\MainpageController@sendChat');

Route::post('loadChatUsers', '\App\Http\Controllers\MainpageController@loadChatUsers');

Route::post('loadTeamMembers', '\App\Http\Controllers\MainpageController@loadTeamMembers');

Route::post('declineTeamRequest', '\App\Http\Controllers\MainpageController@declineTeamRequest');

Route::post('acceptTeamRequest', '\App\Http\Controllers\MainpageController@acceptTeamRequest');

Route::post('loadTeamInvites', '\App\Http\Controllers\MainpageController@getTeamRequests');

Route::post('loadTeams', '\App\Http\Controllers\MainpageController@loadTeams')->name('loadTeams');

Route::post('checkTeamName', '\App\Http\Controllers\MainpageController@checkTeamName');

Route::post('sendTeamInvites', '\App\Http\Controllers\MainpageController@sendTeamInvites');

Route::post('friends', '\App\Http\Controllers\MainpageController@createTeamFriends');

Route::post('addFriend', '\App\Http\Controllers\MainpageController@addFriend');

Route::post('searchButton', '\App\Http\Controllers\MainpageController@searchButton');

Route::post('searchUsername', '\App\Http\Controllers\MainpageController@searchUsername');

Route::post('acceptRequest', '\App\Http\Controllers\MainpageController@acceptRequest');

Route::post('deleteRequest', '\App\Http\Controllers\MainpageController@deleteRequest');

Route::post('echoFriendRequest', '\App\Http\Controllers\MainpageController@echoFriendRequest');

Route::post('getNotifCount', '\App\Http\Controllers\MainpageController@getNotifCount');

Route::post('/stuffforprofile', '\App\Http\Controllers\MainpageController@stuffForProfile');

Route::post('updatepic', 'MainPageController@update_avatar');

Route::post('/echopost','\App\Http\Controllers\MainPageController@echopost');

Route::post('/getpostcount','\App\Http\Controllers\MainPageController@getPostCount');

Route::post('/numberofposts', '\App\Http\Controllers\MainPageController@loadAllPosts');

Route::get('/deletepost', '\App\Http\Controllers\MainPageController@deletePost');

Route::post('/createpost', '\App\Http\Controllers\MainPageController@createPost');

Route::get('/mainpage', 'HomeController@mainpage')->name('/mainpage');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/updategetstartedDota', '\App\Http\Controllers\DotaDetailController@updatePosition');

Route::post('/updategetstartedOverwatch', '\App\Http\Controllers\OverwatchDetailController@updatePosition');

