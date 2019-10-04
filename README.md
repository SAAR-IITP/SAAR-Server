# SAAR-Server
Server for the android and web client of SAAR.

#### Status Code Values

- 400 : Registration failed
- 401 : OTP verification failed
- 402 : Login failed
- 403 : Email change request failed to send
- 404 : Password request change request failed to send
- 405 : Profile update failed
- 406 : Profile Image failed to update
- 407 : Resetting password failed
- 200 : Registration Successfull
- 201 : OTP successfully verified
- 202 : Logged in successfully
- 203 : Email change request sent
- 204 : Password reset request sent
- 205 : Profile Succesfully updated
- 206 : Profile Image succesfully uploaded
- 207 : Resetted password succesfully
- 208 : Succesfully verified for changing password

#### Signup page response

##### Success message
{
-	"status" : 200,
-	"messages" : 
	{
	 ```"You have successfully registered. Please verify your email."```
	}
	
}

##### Failure message
{
-	"status" : 400,
-	"messages" : 
	{
	 ```Bunch of errors will be written in array format```
	}
	
}

#### Login page response

##### Success message
{
-	"status" : 202,
-	"messages" : 
   {	
	-					"rollno" : rollno,   				//Cannot be edited
	-					"first_name" : first_name,
	-					"last_name" : last_name,
	-					"email" : email,
	-					"phone" : phone,
	-					"fb_link" : fb_link,
	-					"linkedin_link" : linkedin_link,
	-					"dob" : dob,						//Cannot be edited
	-					"graduation_year" : graduation_year,   //Cannot be edited
	-					"degree" : degree,				//Cannnot be editted
	-					"department" : department,		//Cannot be edited
	-					"employment_type" : employment_type,
	-					"present_employer" : present_employer,
	-					"designation" : designaton,
	-					"address" : address,
	-					"country" : country,
	-					"state" : state,
	-					"city" : city,
	-					"achievements" : achievements

	}
	
}

##### Failure message
{
-	"status" : "402",
-	"messages" : 
     {
	 ```Reason of failure.```
     }
      
}

### Change email request parameters

	old_email, new_email, password

##### Response
{
-	"status" : 203,
-	"messages" : 
     {
	```"Success message"```
     }
     
}

#### Profile page Response

##### Normal Datas
{
	-	"status" : "205",
	-	"messages" : 
	     {
		 ```Succesfully updated profile.```
	     }
}


##### Profile Image
{
	-	"status" : "206",
	-	"messages" : 
	     {
	     	``` "img_url": $img_url ```
	     }
}

### Reset password

{
	-	"status": $status;
	-   "messages": $messages;
}
