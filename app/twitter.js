/*
	Unfollow (stop following) those people who are not following you back on Twitter.
	
	This will work for new Twitter web site code structure (it was changed from July 2019, causing other unfollow-scripts to stop working).
	
	Instructions:
	1) The code may need to be modified depending on the language of your Twitter web site:
		* For English language web site, no modification needed.
		* For Spanish language web site, remember to set the variable 'LANGUAGE' to "ES".
		* For another language, remember to set the variable 'LANGUAGE' to that language and modify the 'WORDS' object to add the words in that language.
	2) Optionally, you can edit the 'SKIP_USERS' array to insert those users that you do not want to unfollow (even if they are not following you back).
	3) When the code is fine, on Twitter web site, go to the section where it shows all the people you are following (https://twitter.com/YOUR_USERNAME_HERE/following).
	4) Once there, open the JavaScript console (F12 key, normally), paste all the code there and press enter.
	5) Wait until you see it has finished. If something goes wrong, reload the page and repeat from the step 3 again.
	
	* Gist by Joan Alba Maldonado: https://gist.github.com/jalbam/d7678c32b6f029c602c0bfb2a72e0c26
*/
var UNFOLLOWED = 0;
var TO_UNFOLLOW = 100;
var TO_SKIP = 0;
var N_SKIPPED = 0;


var LANGUAGE = "EN"; //NOTE: change it to use your language!
var WORDS =
{
	//English language:
	EN:
	{
		followsYouText: "Follows you", //Text that informs that follows you.
		followingButtonText: "Following", //Text of the "Following" button.
		confirmationButtonText: "Unfollow" //Text of the confirmation button. I am not totally sure.
	},
	//Spanish language:
	ES:
	{
		followsYouText: "Te sigue", //Text that informs that follows you.
		followingButtonText: "Siguiendo", //Text of the "Following" button.
		confirmationButtonText: "Dejar de seguir" //Text of the confirmation button. I am not totally sure.
	}
	//NOTE: if needed, add your language here...
}
var SKIP_USERS = //Users that we do not want to unfollow (even if they are not following you back):
[
	//Place the user names that you want to skip here (they will not be unfollowed):
	"mahdiyehashour1"
];
SKIP_USERS.forEach(function(value, index) { SKIP_USERS[index] = value.toLowerCase(); }); //Transforms all the user names to lower case as it will be case insensitive.


//Function that unfollows non-followers on Twitter:
var usersFollowingMe = function(followsYouText, followingButtonText, confirmationButtonText)
{
	var nonFollowers = 0;
	followsYouText = followsYouText || WORDS.EN.followsYouText; //Text that informs that follows you.
	followingButtonText = followingButtonText || WORDS.EN.followingButtonText; //Text of the "Following" button.
	confirmationButtonText = confirmationButtonText || WORDS.EN.confirmationButtonText; //Text of the confirmation button.
	
	//Looks through all the containers of each user:
	var userContainers = document.querySelectorAll('[data-testid=UserCell]');
	Array.prototype.filter.call
	(
		userContainers,
		function(userContainer)
		{
			var username = userContainer.querySelectorAll("span")[0].innerText;
			//Checks whether the user is following you:
			var followsYou = false;
			Array.from(userContainer.querySelectorAll("*")).find
			(
				function(element)
				{
					if (element.textContent === followsYouText) { followsYou = true; }
				}
			);
			if (followsYou) {
				console.log("user: " + username + " does follows you not unfollowing");
				return;
			}

			//If the user is not following you:
			if (!followsYou)
			{
				//console.log("user: " + username + " does NOT follows you");
				//Finds the user name and checks whether we want to skip this user or not:
				var skipUser = false;
				Array.from(userContainer.querySelectorAll("[href^='/']")).find
				(
					function (element)
					{
						if (element.href.indexOf("search?q=") !== -1 || element.href.indexOf("/") === -1) { return; }
						var userName = element.href.substring(element.href.lastIndexOf("/") + 1).toLowerCase();
						Array.from(element.querySelectorAll("*")).find
						(
							function (subElement)
							{
								if (subElement.textContent.toLowerCase() === "@" + userName)
								{
									if (SKIP_USERS.indexOf(userName) !== -1)
									{
										console.log("We want to skip: " + userName);
										skipUser = true;
									}
								}
							}
						)
					}
				);
				
				//If we do not want to skip the user:
				if (!skipUser)
				{
					//Finds the unfollow button:
					Array.from(userContainer.querySelectorAll('[role=button]')).find
					(
						function(element)
						{
							//If the unfollow button is found, clicks it:
							if (element.textContent === followingButtonText)
							{
                                console.log("found user that does not follow ", element);
                                        if (N_SKIPPED < TO_SKIP) {
                                            console.log("skipping user as n skipped " + N_SKIPPED + " is less than " + TO_SKIP);
                                            N_SKIPPED ++;
                                            return;
                                        }
                                        if (UNFOLLOWED >= TO_UNFOLLOW) {
                                            console.log("skipping user as mount unfollowed is more than " + TO_UNFOLLOW);
                                            return;
                                        }
                                        console.log("unfollowing user " + username + " now");
								element.click();
                                            UNFOLLOWED ++;
								nonFollowers++;
							}
						}
					);
				}
			}
		}
	);
	
	//If there is a confirmation dialog, press it automatically:
	Array.from(document.querySelectorAll('[role=button]')).find //Finds the confirmation button.
	(
		function(element)
		{
			//If the confirmation button is found, clicks it:
			if (element.textContent === confirmationButtonText)
			{
				console.log("confirming unfollow..");
                                        if (N_SKIPPED < TO_SKIP) {
                                            console.log("skipping user as n skipped " + N_SKIPPED + " is less than " + TO_SKIP);
                                            //N_SKIPPED ++;
                                            return;
                                        }
                if (UNFOLLOWED >= TO_UNFOLLOW) {
                    return;
                }
				element.click();
			}
		}
	);
	
	return nonFollowers; //Returns the number of non-followers.
}


//Scrolls and unfollows non-followers, constantly:
var scrollAndUnfollow = function()
{
	window.scrollTo(0, document.body.scrollHeight);
	usersFollowingMe(WORDS[LANGUAGE].followsYouText, WORDS[LANGUAGE].followingButtonText, WORDS[LANGUAGE].confirmationButtonText); //For English, you can try to call it without parameters.
	setTimeout(scrollAndUnfollow, 10);
};
scrollAndUnfollow();
