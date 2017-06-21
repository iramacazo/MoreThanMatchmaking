<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class MainPageController extends Controller
{
    /**
     * Function to load all the comments
     * @param Request $req
     */
    public function loadComments(Request $req)
    {
        $postID = $req->postID;

        $query = DB::table("comments")
                    ->where("postID", '=', $postID)
                    ->orderBy('commentDate', 'asc')
                    ->get();

        foreach ($query as $comment)
        {
            $commentID = $comment->id;
            $content = $comment->commentContent;
            $username = $comment->commentOwner;
            $query1 = DB::table("user_default")
                        ->where('username','=', $username)
                        ->first();
            $profilePath = $query1->profilePath;

            echo ('<div class="commentBox">
			        <div class="imagecontainerComment"><img src="css/images/'.$profilePath.'" class="img-circleComment"></div>
                    <p class="usernameComment" id="usernameComment'.$commentID.'">'.$username.'</p>
                    <p class="commentContent">'.$content.'</p>
			    </div>
			    <script>
			        $("#usernameComment'.$commentID.'").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
                </script>');
        }
    }

    public function submitComment(Request $req)
    {
        $commentOwner = Auth::user()->username;
        $currentTime = Carbon::now(new \DateTimeZone('Asia/Manila'));
        $postID = $req->postID;
        $content = $req->body;
        $query = DB::table('user_default')
                    ->where('username', '=', $commentOwner)
                    ->first();
        $profilePath = $query->profilePath;

        DB::table('comments')
                ->insert(['commentOwner' => $commentOwner,
                          'commentDate' => $currentTime,
                          'commentContent' => $content,
                          'postID' => $postID]);
        $commentID = DB::getPdo()->lastInsertId();

        echo ('<div class="commentBox">
			        <div class="imagecontainerComment"><img src="css/images/'.$profilePath.'" class="img-circleComment"></div>
                    <p class="usernameComment" id="usernameComment'.$commentID.'">'.$commentOwner.'</p>
                    <p class="commentContent">'.$content.'</p>
			    </div>
			    <script>
			        $("#usernameComment'.$commentID.'").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
                </script>');
    }

    public function report(Request $req)
    {
        $username = $req->username;
        $query = DB::table("user_default")
                    ->where('username', '=', $username)
                    ->first();

        $reports = $query->reports + 1;

        DB::table("user_default")
            ->where('username', '=', $username)
            ->update(['reports' => $reports]);
    }

    /**
     * Update the rating of the post
     * @param Request $req
     */
    public function updateRating(Request $req)
    {
        $star = $req->star;
        $postId = $req->id;

        $query = DB::table('posts')
                    ->where('id', '=', $postId)
                    ->first();

        $updatedNum = $query->rating + $star;

        if($updatedNum < 6)
        {
            DB::table('posts')
                ->where('id', '=', $postId)
                ->update(['rating' => $updatedNum]);
            echo $updatedNum;
        }
        else
        {
            $updatedNum = $updatedNum / 2;
            DB::table('posts')
                ->where('id', '=', $postId)
                ->update(['rating' => $updatedNum]);
            echo $updatedNum;
        }
    }
    /**
     * Update the profile picture of the currently logged in user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->fit(225,225)->save(public_path('/css/images/' . $filename));
            $user = Auth::user();
            $user->profilePath = $filename;
            $user->save();
        }
        return view('/mainpage');
    }

    /**
     * Loads all friends of users for chat
     */
    public function loadChatUsers()
    {
        $query = DB::table('friends_list')
            ->join("user_default", "user_default.username", "friends_list.friendUsername")
            ->where("friends_list.username", '=', Auth::user()->username)
            ->where("friends_list.friendUsername", "!=", Auth::user()->username)
            ->get();
        foreach ($query as $friend)
        {
            $username = $friend->username;
            $profilePath = $friend->profilePath;
            echo ('<div class="searchResultSACHAT">
                    <div class="imagecontainerSACHAT"><img src="css/images/'.$profilePath.'" class="img-circleSACHAT"></div>
                    <p class="searchedUserSACHAT" id="chat'.$username.'">'.$username.'</p>
                </div>
                <script>
                    $("#chat'.$username.'").click(function()
                    {
                        $(".chatArea").empty();
                        $(".chat").fadeIn();
                        $(".chatUsername").html("'.$username.'");
                    });
                </script>');
        }
    }

    public function sendChat(Request $req)
    {
        $content = $req->body;
        $sendTo = $req->username;
        $sendFrom = Auth::user()->username;
        $currentTime = Carbon::now(new \DateTimeZone('Asia/Manila'));
        DB::table('chat')
            ->insert(['sender' => $sendFrom, 'receiver' => $sendTo, 'dateSent' => $currentTime, 'content' => $content]);
    }

    public function loadChatBox(Request $req)
    {
        $username = $req->username;
        $loggedInUser = Auth::user()->username;
        $query1 = DB::table('chat')
                    ->where('sender', '=', $username)
                    ->where('receiver', '=', $loggedInUser)
                    ->get();

        $query2 = DB::table('chat')
                    ->where('sender', '=', $loggedInUser)
                    ->where('receiver', '=', $username)
                    ->get();

        $query = $query1->merge($query2)->sortByDesc('dateSent');


        foreach ($query as $chat)
        {
            if($chat->receiver == $loggedInUser)
            {
                echo('<div class="receivedMessage">'.$chat->content.'</div>');
            }
            else if($chat->receiver == $username)
            {
                echo('<div class="sentMessage">'.$chat->content.'</div>');
            }
        }
    }

    /**
     * Function to load all the members in a team
     */
    public function loadTeamMembers(Request $req)
    {
        $query = DB::table('teammembers')
                    ->where('teamname', '=', $req->teamname)
                    ->join('user_default', 'user_default.username', 'teammembers.teammember')
                    ->get();
        foreach ($query as $user)
        {
            $dotaQuery = DB::table('dotadetails')
                    ->where('username', '=', $user->username)
                    ->first();

            $owQuery = DB::table('overwatchdetails')
                ->where('username', '=', $user->username)
                ->first();

            echo ('<div class="searchResult">
                    <div class="imagecontainer"><img src="css/images/'.$user->profilePath.'" class="img-circle"></div>
                    <p class="member" >'.$user->username.'</p>
                    <img src="css/images/owlogo.png" class="overwatchlogochuchu">
                    <p class="teamRole" id="owTeamRole">'.$owQuery->mainRole.'</p>
                    <img src="css/images/dota2logo.png" class="dota2logochuchu">
                    <p class="teamRole" id="dotaTeamRole">'.$dotaQuery->mainRole.'</p>
                </div>
                <script>
                    $(".member").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                $(".everything").css("-webkit-filter", "brightness(25%)");
                               if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".owdetailspace").show();
                                    $(".owlogo").css("-webkit-filter", "");
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".dotadetailspace").show();
                                    $(".dota2logo").css("-webkit-filter", "");
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".teampopup").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
                </script>');
        }
    }

    /**
     * Function to load all the teams that a user is currently in
     */
    public function loadTeams()
    {
        $query = DB::table('teammembers')
                    ->where('teammember', '=', Auth::user()->username)
                    ->get();

        foreach ($query as $team)
        {
            $query2 = DB::table('teams')
                    ->where('teamname', '=', $team->teamname)
                    ->get();

            echo ('<div class="teamName" id="team'.$team->teamname.'">
							<p>'.$team->teamname.'</p>
						</div>
					<script>
                        $("[id=\'team'.$team->teamname.'\']").click(function()
                            {
                                $(".teamMembers").empty();
                                $(".teampopup").fadeIn();
                                $(".everything").css("-webkit-filter", "brightness(25%)");
                                $("#teamName").html("'.$team->teamname.'");
                                $("#admin").html("'.$query2[0]->teamAdmin.'");
                                $.ajax(
                                    {
                                        type:"POST",
                                        url:"loadTeamMembers",
                                        data:{
                                            teamname: "'.$team->teamname.'"
                                        },
                                        success:function(data)
                                        {
                                            $(".teamMembers").append(data);
                                        }
                                    }
                                )
                            }	    
                        );
					</script>');
        }
    }

    /**
     * Function to load friends while creating a team
     */
    public function createTeamFriends()
    {
        $query = DB::table('friends_list')
                    ->where("username", '=', Auth::user()->username)
                    ->where("friendUsername", "!=", Auth::user()->username)
                    ->get();

        foreach ($query as $chankor)
        {
            echo ('<input type="checkbox" name="'.$chankor->friendUsername.'"><p>'.$chankor->friendUsername.'</p><br>');
        }
    }

    public function populateTeamInvites()
    {
        $admin = Auth::user()->username;
        $query = DB::table("teams")
                    ->where('teamAdmin', '=', $admin)
                    ->get();

        foreach ($query as $team)
        {
            echo('<input type="checkbox" name="'.$team->teamname.'"><p>'.$team->teamname.'</p><br>');
        }
    }

    /**
     * Checks whether a team name is taken
     * @param Request $req
     */
    public function checkTeamName(Request $req)
    {
        $teamNameCheck = $req->teamname;

        $count = DB::table('teams')
                    ->where('teamname', '=', $teamNameCheck)
                    ->count();

        if($count == 1)
        {
            echo "yes";
        }
        else
        {
            echo "no";
        }
    }


    public function inviteToTeam(Request $req)
    {
        $invitee = $req->username;
        $teams = $req->teams;

        if(is_array($teams))
        {
            foreach ($teams as $team)
            {
                $count2 = DB::table("teams")
                            ->join('teammembers', 'teams.teamname', 'teammembers.teamname')
                            ->where('teammembers.teammember', '=', $invitee)
                            ->count();
                $count = DB::table('teaminvite')
                    ->where('teamName', '=', $team)
                    ->where('invitee', '=', $invitee)
                    ->count();
                if($count < 1 && $count2 < 1)
                {
                    DB::table('teaminvite')
                        ->insert(['teamName' => $team, 'invitee' => $invitee]);
                }
            }
        }
    }

    /**
     * Creates a team and sends invites if there are any
     * @param Request $req
     */
    public function sendTeamInvites(Request $req)
    {
        $members = $req->toInvite;
        DB::table('teams')
                ->insert(['teamname' => $req->teamname, 'teamAdmin' => Auth::user()->username]);

        DB::table('teammembers')
                ->insert(['teamname' => $req->teamname, 'teammember' => Auth::user()->username]);

        if(is_array($members))
        {
            foreach ($req->toInvite as $member)
            {
                $count = DB::table('teaminvite')
                    ->where('teamName', '=', $req->teamname)
                    ->where('invitee', '=', $member)
                    ->count();
                if($count < 1)
                {
                    DB::table('teaminvite')
                        ->insert(['teamName' => $req->teamname, 'invitee' => $member]);
                }
            }
        }
        echo ('<div class="teamName" id="team'.$req->teamname.'">
							<p>'.$req->teamname.'</p>
						</div>');
    }

    /**
     * Function to add a friend
     * @param Request $request
     */
    public function addFriend(Request $request)
    {
        $username = Auth::user()->username;
        $query = DB::table('friendrequests')
                    ->where("receiver", '=', $request->tobeadded)
                    ->where("sender", '=', $username)
                    ->count();

        if($query > 0)
        {
            echo "You have already sent a request";
        }
        else
        {
            DB::table("friendrequests")
                ->insert(["sender" => $username, "receiver" => $request->tobeadded]);
            echo "Added!";
        }
    }

    public function searchButton(Request $request)
    {
        $loggedIn = Auth::user()->username;
        $search = $request->search;
        $item = $request->item;
        $query = "";

        if($search == "DotaRole")
        {
            $query = DB::table('user_default')
                        ->join('dotadetails', 'user_default.username', 'dotadetails.username')
                        ->where('mainRole', '=', $item)
                        ->where('user_default.username', '!=', $loggedIn)
                        ->get();
        }
        else if($search == "DotaMMR")
        {
            $query = DB::table('user_default')
                        ->join('dotadetails', 'user_default.username', 'dotadetails.username')
                        ->where('mmrBracket', '=', $item)
                        ->where('user_default.username', '!=', $loggedIn)
                        ->get();
        }
        else if($search == "OverwatchRole")
        {
            $query = DB::table('user_default')
                ->join('overwatchdetails', 'user_default.username', 'overwatchdetails.username')
                ->where('mainRole', '=', $item)
                ->where('user_default.username', '!=', $loggedIn)
                ->get();
        }
        else if($search == "OverwatchTier")
        {
            $query = DB::table('user_default')
                ->join('overwatchdetails', 'user_default.username', 'overwatchdetails.username')
                ->where('tier', '=', $item)
                ->where('user_default.username', '!=', $loggedIn)
                ->get();
        }

        if(count($query))
        {
            foreach($query as $item)
            {
                $picture = $item->profilePath;
                $username = $item->username;
                echo ('<div class="searchResult">
					<div class="imagecontainer"><img src="css/images/'.$picture.'" class="img-circle"></div>
					<p class="searchedUser" >'.$username.'</p>
				</div>
				<script>
				$(".searchedUser").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                $(".everything").css("-webkit-filter", "brightness(25%)");
                                if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".owdetailspace").show();
                                    $(".owlogo").css("-webkit-filter", "");
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".dotadetailspace").show();
                                    $(".dota2logo").css("-webkit-filter", "");
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
				</script>');
            }
        }
        else
        {
            echo ('<div class="searchResult">
					<div class="imagecontainer"><img src="" class="img-circle" style="opacity: 0;"></div>
					<p class="searchedUser" >No User Found!</p>
				</div>');
        }

    }

    public function searchUsername(Request $request)
    {
        $picture = DB::table('user_default')
                    ->where('username', '=', $request->username)
                    ->value('profilePath');
        $username = DB::table('user_default')
                    ->where('username', '=', $request->username)
                    ->value('username');

        if($username == null)
        {
            echo ('<div class="searchResult">
					<div class="imagecontainer"><img src="" class="img-circle" style="opacity: 0;"></div>
					<p class="searchedUser" >No User Found!</p>
				</div>');
        }
        else
        {
            echo ('<div class="searchResult">
					<div class="imagecontainer"><img src="css/images/'.$picture.'" class="img-circle"></div>
					<p class="searchedUser" >'.$username.'</p>
				</div>
				<script>
				$(".searchedUser").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                $(".everything").css("-webkit-filter", "brightness(25%)");
                               if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".owdetailspace").show();
                                    $(".owlogo").css("-webkit-filter", "");
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".dotadetailspace").show();
                                    $(".dota2logo").css("-webkit-filter", "");
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
				</script>');
        }

    }

    /**
     *  Function to decline team request
     *  @param Request $req
     */
    public function declineTeamRequest(Request $req)
    {
        $notifID = $req->notifID;
        DB::table('teaminvite')
            ->where('id', '=', $notifID)
            ->delete();
    }

    /**
     * Function to accept team request
     * @param Request $req
     */
    public function acceptTeamRequest(Request $req)
    {
        $receiver = Auth::user()->username;
        $teamname = $req->teamname;
        $notifID = $req->notifID;
        DB::table('teaminvite')
            ->where('id', '=', $notifID)
            ->delete();

        DB::table('teammembers')
            ->insert(['teammember' => $receiver, 'teamname' => $teamname]);
    }

    /**
     * Function to get all team requests
     * @param Request $req
     */
    public function getTeamRequests(Request $req)
    {
        $currentUser = Auth::user()->username;
        $teamInvite = DB::table('teams')
                        ->join('teaminvite', 'teams.teamName', 'teaminvite.teamname')
                        ->join('user_default', 'teams.teamAdmin', 'user_default.username')
                        ->where('invitee', '=', $currentUser)
                        ->get();

        foreach ($teamInvite as $invite)
        {
            $sender = $invite->username;
            $picture = $invite->profilePath;
            $notifNumber = $invite->id;
            $teamName = $invite->teamName;
            echo (
                '<div class="notif" id="notifNumber'. $notifNumber .'">
					<div class="imagecontainer"><img src="css/images/'. $picture .'" class="img-circle"></div>
						<p class="notifHeader" id="checkProfile'.$sender.'">'. $sender .'</p>
						<p class="notifBody" id="desc'.$notifNumber.'">Has invited you to '. $teamName .'</p>
						<input type="button" value="Accept" class="notifConf" id="accept'.$notifNumber.'">
						<input type="button" value="Decline" class="notifConf" id="decline'.$notifNumber.'">
				</div>
			<script>
			    $("#checkProfile'.$sender.'").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                $(".everything").css("-webkit-filter", "brightness(25%)");
                                if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".owdetailspace").show();
                                    $(".owlogo").css("-webkit-filter", "");
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".dotadetailspace").show();
                                    $(".dota2logo").css("-webkit-filter", "");
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
			
			    $("#accept'.$notifNumber.'").click(function()
			    {
			        var $notifID = "'.$notifNumber.'";
			        var $teamName = "'.$teamName.'";
			        $.ajax(
			        {
			            type: "POST",
			            url: "acceptTeamRequest",
			            data:{
			                notifID: $notifID,
			                teamname: $teamName
			            },
			            success: function()
			            {
			                $("#desc'.$notifNumber.'").html("Accepted!");
			                $("#accept'.$notifNumber.'").hide();
			                $("#decline'.$notifNumber.'").hide();
			            }
			        }
			        )
			    }
			    )
			
			    $("#decline'.$notifNumber.'").click(function()
			    {
			        var $notifID = "'. $notifNumber .'";
			        $.ajax(
			            {
			                type: "POST",
			                url: "declineTeamRequest",
			                data:{
			                    notifID: $notifID
			                },
			                success: function()
			                {
			                    $("#notifNumber' . $notifNumber . '").remove();
			                }
			            }
			        )
			    })
			</script>'
            );
        }
    }


    /**
     * Loads the friend requests into the notification bar
     * @param Request $req
     */
    public function echoFriendRequest(Request $req)
    {
        $currentUser = Auth::user()->username;
        $notifCount = $req->notifCount;
        $friendRequests = DB::table('friendrequests')
                            ->where('receiver', '=', $currentUser)
                            ->skip($notifCount)
                            ->first();

        $notifNumber = $friendRequests->id;
        $sender = $friendRequests->sender;
        $picture = DB::table('user_default')
                        ->where('username', '=', $sender)
                        ->value('profilePath');
        echo (
            '<div class="notif" id="notifNumber'. $notifNumber .'">
					<div class="imagecontainer"><img src="css/images/'. $picture .'" class="img-circle"></div>
						<p class="notifHeader" id="checkProfile'.$sender.'">'. $sender .'</p>
						<p class="notifBody" id="desc'.$notifNumber.'">Has sent you a friend request</p>
						<input type="button" value="Accept" class="notifConf" id="accept'.$notifNumber.'">
						<input type="button" value="Decline" class="notifConf" id="decline'.$notifNumber.'">
				</div>
			<script>
			    $("#checkProfile'.$sender.'").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                $(".everything").css("-webkit-filter", "brightness(25%)");
                                if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".owdetailspace").show();
                                    $(".owlogo").css("-webkit-filter", "");
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $(".dotadetailspace").show();
                                    $(".dota2logo").css("-webkit-filter", "");
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
			
			    $("#accept'.$notifNumber.'").click(function()
			    {
			        var $notifID = "'.$notifNumber.'";
			        var $from = "'.$sender.'";
			        $.ajax(
			        {
			            type: "POST",
			            url: "acceptRequest",
			            data:{
			                notifID: $notifID,
			                sender: $from
			            },
			            success: function()
			            {
			                $("#desc'.$notifNumber.'").html("Accepted!");
			                $("#accept'.$notifNumber.'").hide();
			                $("#decline'.$notifNumber.'").hide();
			            }
			        }
			        )
			    }
			    )
			
			    $("#decline'.$notifNumber.'").click(function()
			    {
			        var $notifID = "'. $notifNumber .'";
			        $.ajax(
			            {
			                type: "POST",
			                url: "deleteRequest",
			                data:{
			                    notifID: $notifID
			                },
			                success: function()
			                {
			                    $("#notifNumber' . $notifNumber . '").remove();
			                }
			            }
			        )
			    })
			</script>'
        );
    }

    /**
     * Adds a friend via friend request
     * @param Request $req
     */
    public function acceptRequest(Request $req)
    {
        $receiver = Auth::user()->username;
        $sender = $req->sender;
        $notifID = $req->notifID;
        DB::table('friendrequests')
            ->where('id', '=', $notifID)
            ->delete();

        DB::table('friends_list')
            ->insert([
                ['username' => $receiver, 'friendUsername' => $sender],
                ['username' => $sender, 'friendUsername' => $receiver]
            ]);
    }

    /**
     * Deletes a friend request
     * @param Request $req
     */
    public function deleteRequest(Request $req)
    {
        $notifID = $req->notifID;
        DB::table('friendrequests')
            ->where('id', '=', $notifID)
            ->delete();
    }

    /**
     * Get Count of Notifications for Looping Purposes.
     */
    public function getNotifCount()
    {
        $currentUser = Auth::user()->username;
        $notifications = DB::table('friendrequests')
                            ->where('receiver', '=', $currentUser)
                            ->count();
        echo $notifications;
    }

    /**
     * Loads all the information needed in viewing a profile
     * @param Request $req
     */
    public function stuffForProfile(Request $req)
    {
        $userDota = DB::table('user_default')
                    ->join('dotadetails', 'user_default.username', 'dotadetails.username')
                    ->where('dotadetails.username', '=', $req->username)
                    ->first();

        $userOW = DB::table('user_default')
                    ->join('overwatchdetails', 'user_default.username', 'overwatchdetails.username')
                    ->where('overwatchdetails.username', '=', $req->username)
                    ->first();

        $username = $userDota->username;
        $profilePath = $userDota->profilePath;
        $dotaHero1 = DB::table('herolink')
                        ->where('herolink.heroname' , '=', $userDota->hero1)
                        ->value("heroPath");
        $dotaHero2 = DB::table('herolink')
                        ->where('heroname' , '=', $userDota->hero2)
                        ->value("heroPath");
        $dotaHero3 = DB::table('herolink')
                        ->where('heroname' , '=', $userDota->hero3)
                        ->value("heroPath");
        $dotaRole = $userDota->mainRole;
        $dotaMMR = $userDota->mmrBracket;
        $owHero1 = DB::table('herolink')
                        ->where('heroname' , '=', $userOW->hero1)
                        ->value("heroPath");
        $owHero2 = DB::table('herolink')
                        ->where('heroname' , '=', $userOW->hero2)
                        ->value("heroPath");
        $owHero3 = DB::table('herolink')
                        ->where('heroname' , '=', $userOW->hero3)
                        ->value("heroPath");
        $owRole = $userOW->mainRole;
        $owTier = DB::table('herolink')
                        ->where('heroname' , '=', $userOW->tier)
                        ->value("heroPath");

        $loggedin = Auth::user()->username;
        $isFriend = DB::table('friends_list')
                        ->where('username',  '=', $loggedin)
                        ->where('friendUsername', '=', $req->username)
                        ->count();

        echo json_encode(array($username, $profilePath, $dotaHero1,
                                $dotaHero2, $dotaHero3, $dotaRole,
                                $dotaMMR, $owHero1, $owHero2, $owHero3,
                                $owRole, $owTier, $isFriend));
    }

    /**
     * Loads all the posts needed when viewing the mainpage
     * @param Request $req
     */
    public function loadAllPosts(Request $req)
    {
        $posts = DB::table('friends_list')
                    ->join('user_default', 'friendUsername', 'user_default.username')
                    ->join('posts', 'friendUsername', 'posts.username')
                    ->where('friends_list.username', '=', $req->username)
                    ->orderBy('posts.thedate', 'asc')
                    ->get();

        echo $posts;
    }

    /**
     * Loads an individual post
     * @param Request $req
     */
    public function echoPost(Request $req)
    {
        $postNum = $req->postCount;
        $posts = DB::table('friends_list')
                    ->join('user_default', 'friendUsername', 'user_default.username')
                    ->join('posts', 'friendUsername', 'posts.username')
                    ->where('friends_list.username', '=', $req->username)
                    ->orderBy('posts.thedate', 'desc')
                    ->skip($postNum)
                    ->first();

        $rating = $posts->rating;
        $postID = $posts->id;
        $postOwner = $posts->friendUsername;
        $content = $posts->content;
        $time = $posts->thedate;
        $picture = $posts->profilePath;
        $hidden = '';
        if($req->username != $postOwner)
        {
            $hidden = 'hidden';
        }
      echo ('<div class="post" id="post' .$postID . '">
			<div class="topPost">
			    <img class="img-circle" id="profilePic'.$postOwner.'" src="css/images/'.$picture.'">
				<p id="PostUserName" class="checkProfile'.$postOwner. $postID.'">' . $postOwner . '</p>
				<img id="deletePost'. $postID .'" src="css/images/trash.png" class="trash" '.$hidden.'>
				<p id="PostTime">'. $time . '</p>
			</div>
			    
			<div class="deleteconfirmation" id="deleteCon'. $postID .'">
			    <p class="midPost">Are you sure you want to delete this post?</p>
			    <input type="button" value="Yes" class="confButt" id="yes'.$postID.'">
			    <input type="button" value="No" class="confButt" id="no'.$postID.'">
			</div>
			
			<div class="midPost" id="postText">
				<p id="PostCaption">'. $content .'</p>
			</div>
				
			<div class="botPost">
				<ul class="botPostWha">
				<img value="1" class="star" id="star1' .$postID . '" src="css/images/star.png" >
	            <img value="2" class="star" id="star2' .$postID . '" src="css/images/star.png" >
	            <img value="3" class="star" id="star3' .$postID . '" src="css/images/star.png" >
	            <img value="4" class="star" id="star4' .$postID . '" src="css/images/star.png" >
	            <img value="5" class="star" id="star5' .$postID . '" src="css/images/star.png" >
	            <p class="rating" id="rating'.$postID.'">Rating: '. $rating .'</p>
				</ul>
			</div>
			<div class="commentDiv" id="post'.$postID.'comment">
			</div>
			<div class="commentAdd">
			    <input id="commentField'.$postID.'" type="text" class="commentInput" placeholder="Write a comment...">
            </div>
			<script>
			    function loadComments()
			    {
			        $.ajax({
			            type: "POST",
			            url: "loadComments",
			            data:
			            {
			                postID: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#post'.$postID.'comment").append(data);
			            }
			        })
			    }
			    
			    loadComments();
			    
			    $("#commentField'.$postID.'").keypress(function(e)
			    {
			        if(e.which === 13)
			        {
			            var comment = document.getElementById(\'commentField'.$postID.'\').value;
			            console.log(comment);
			            document.getElementById(\'commentField'.$postID.'\').value = "";
			            $.ajax(
			            {
			                type:"POST",
			                url: "submitComment",
			                data:
			                {
			                    body: comment,
			                    postID: "'.$postID.'"
			                },
			                success: function(data)
			                {
			                    $("#post'.$postID.'comment").append(data);
			                }
			            })
			        }
			    });
			    
			
			    $("#star5' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star5' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star5' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    $("#star4' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			
			    $("#star3' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    $("#star2' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    $("#star1' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    
			    $("#star1' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 1,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star2' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 2,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star3' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 3,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star4' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 4,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star5' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 5,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    
			    
			    $("#no'.$postID.'").click(function()
			    {
			        $("#deleteCon' . $postID . '").toggle();
			    });
			
			    $("#yes'.$postID.'").click(function()
			    {
			        var postID = "'.$postID.'";
			        $.ajax
			        (
			        {
			            type: "GET",
			            url: "/deletepost",
			            data:{
			                postID: postID
			            },
			            success: function()
			            {   
			                $("#post' . $postID . '").remove();
			            }
			        }
			        );
			    });
			    
			    $("#deletePost'. $postID .'").click(function()
	            {
                   $("#deleteCon'.$postID.'").toggle();
	            });
			    
			    
                $(".checkProfile'.$postOwner. $postID.'").click(function()
                {
                    console.log($(this).html());
                    $.ajax(
                        {
                            type: "POST",
                            url: "/stuffforprofile",
                            data:{
                                username: $(this).html()
                            },
                            success:function(data)
                            {
                                var result = $.parseJSON(data);
                                console.log(result);
                                if(result[11] === null)
                                {
                                    $(".owdetailspace").hide();
                                    $(".owlogo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $("#ow1").attr("src", "css/images/" + result[7]);
                                    $("#ow2").attr("src", "css/images/" + result[8]);
                                    $("#ow3").attr("src", "css/images/" + result[9]);
                                    $(".owrole").text(result[10]);
                                    $("#owtier").attr("src", "css/images/" + result[11]);
                                }
            
                                if(result[6] === null)
                                {
                                    $(".dotadetailspace").hide();
                                    $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                                }
                                else
                                {
                                    $("#dota1").attr(\'src\', "css/images/" + result[2]);
                                    $("#dota2").attr(\'src\', "css/images/" + result[3]);
                                    $("#dota3").attr(\'src\', "css/images/" + result[4]);
                                    $(".mmr").text(result[6] + " " + result[5]);
                                }
            
                                if(result[12] > 0)
                                {
                                    $(".addfriend").hide();
                                    $(".reportButton").hide();
                                }
                                else
                                {
                                    $(".reportButton").show();
                                    $(".addfriend").show();
                                }
                                
                                if(result[0] === $("#username").text())
                                {
                                    $(".teamInviteButton").hide();
                                }
                                else
                                {
                                    $(".teamInviteButton").show();
                                }
                                
                                $(".profileusername").text(result[0]);
                                $(".userprofileimg").attr(\'src\', "css/images/" + result[1]);
                                $(".userprofile").fadeIn();
                                $(".everything").css("-webkit-filter","brightness(25%)");
                            }
                        }
                    )
                });
			</script>');

    }


    /**
     * Gets the number of posts that can be seen by a user
     * @param Request $req
     */
    public function getPostCount(Request $req)
    {
        $posts = DB::table('friends_list')
            ->join('user_default', 'friendUsername', 'user_default.username')
            ->join('posts', 'friendUsername', 'posts.username')
            ->where('friends_list.username', '=', $req->username)
            ->orderBy('posts.thedate', 'asc')
            ->count();

        echo $posts;
    }


    /**
     * Deletes a post
     * @param Request $req
     */
    public function deletePost(Request $req)
    {
        $postID = $req->postID;
        $post = Post::find($postID);
        $post->delete();
    }


    /**
     * Creates a post and displays it
     * @param Request $req
     */
    public function createPost(Request $req)
    {
        $loggedinuser = Auth::user()->username;
        $content = $req->body;
        $currentTime = Carbon::now(new \DateTimeZone('Asia/Manila'));
        $user = User::find(Auth::user()->username);
        $picture = $user->profilePath;

        DB::table('posts')
            ->insert([
                ['username' => $loggedinuser, 'content' => $content, 'thedate' => $currentTime, 'rating' => 0]
            ]);

        $postID = DB::getPdo()->lastInsertId();
        echo ('<div class="post" id="post' .$postID . '">
			<div class="topPost">
			    <img class="img-circle" id="profilePic'.$loggedinuser.'" src="css/images/'.$picture.'">
				<p id="PostUserName" class="checkProfile">' . $loggedinuser . '</p>
				<img id="deletePost'. $postID .'" src="css/images/trash.png" class="trash">
				<p id="PostTime">'. $currentTime. '</p>
			</div>
			    
			<div class="deleteconfirmation" id="deleteCon'. $postID .'">
			    <p class="midPost">Are you sure you want to delete this post?</p>
			    <input type="button" value="Yes" class="confButt" id="yes'.$postID.'">
			    <input type="button" value="No" class="confButt" id="no'.$postID.'">
			</div>
			
			<div class="midPost" id="postText">
				<p id="PostCaption">'. $content .'</p>
			</div>
				
			<div class="botPost">
				<ul class="botPostWha">
				<img value="1" class="star" id="star1' .$postID . '" src="css/images/star.png" >
	            <img value="2" class="star" id="star2' .$postID . '" src="css/images/star.png" >
	            <img value="3" class="star" id="star3' .$postID . '" src="css/images/star.png" >
	            <img value="4" class="star" id="star4' .$postID . '" src="css/images/star.png" >
	            <img value="5" class="star" id="star5' .$postID . '" src="css/images/star.png" >
	            <p class="rating" id="rating'.$postID.'">Rating: 0</p>
				</ul>
			</div>
			
			<div class="commentDiv" id="post'.$postID.'comment">
			</div>
			<div class="commentAdd">
			    <input id="commentField'.$postID.'" type="text" class="commentInput" placeholder="Write a comment...">
            </div>
			
			<script>
			    $("#commentField'.$postID.'").keypress(function(e)
			    {
			        if(e.which === 13)
			        {
			            var comment = document.getElementById(\'commentField'.$postID.'\').value;
			            console.log(comment);
			            document.getElementById(\'commentField'.$postID.'\').value = "";
			            $.ajax(
			            {
			                type:"POST",
			                url: "submitComment",
			                data:
			                {
			                    body: comment,
			                    postID: "'.$postID.'"
			                },
			                success: function(data)
			                {
			                    $("#post'.$postID.'comment").append(data);
			                }
			            })
			        }
			    });
			
			    $("#star5' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star5' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star5' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    $("#star4' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star4' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			
			    $("#star3' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star3' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    $("#star2' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			        $("#star2' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    $("#star1' .$postID . '").hover(function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(100%)");
			    },
			    function()
			    {
			        $("#star1' .$postID . '").css("-webkit-filter", "invert(0%)");
			    });
			    
			    
			    $("#star1' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 1,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star2' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 2,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star3' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 3,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star4' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 4,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#star5' .$postID . '").click(function()
			    {
			        $.ajax
			        ({
			            type:"POST",
			            url:"updateRating",
			            data:
			            {   
			                star: 5,
			                id: "'.$postID.'"
			            },
			            success: function(data)
			            {
			                $("#rating'.$postID.'").text("Rating: " + data);
			            }
			        }
			        );
			    });
			    
			    $("#no'.$postID.'").click(function()
			    {
			        $("#deleteCon' . $postID . '").toggle();
			    });
			
			    $("#yes'.$postID.'").click(function()
			    {
			        var postID = "'.$postID.'";
			        $.ajax
			        (
			        {
			            type: "GET",
			            url: "/deletepost",
			            data:{
			                postID: postID
			            },
			            success: function()
			            {   
			                $("#post' . $postID . '").remove();
			            }
			        }
			        );
			    });
			    
			    $("#deletePost'. $postID .'").click(function()
	            {
                   $("#deleteCon'.$postID.'").toggle();
	            });
			    
			    $(".checkProfile").click(function()
                {
                    console.log($(this).html());
                });

			</script>');
    }


}
