# AWS website for my senior design class

I was the backend manager and hosted the website on AWS.<br/>
This was a video game version of Rotten Tomatoes.

The final architecture was a simple ec2 with RDS.<br/>
We did not go with the HA design because we wanted to stay within the free-tier costs.<br/>
We also did not go with the serverless design becasue the front end team would have had to redesign the code to integrate with the API gateway.

I created entire AWS architecture with possiblity of HA version and serverless version.<br/>
I ensured the php connection files had the correct credentials for the DB connection.<br/>
I also helped create the database and uplaoded it from the ec2 isntance into the RDS instance.
