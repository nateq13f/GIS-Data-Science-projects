<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RottenPotatoes</title>
    <link rel="stylesheet" href="main.css" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!---Start of CSS style for contact form-->
    <style>
      input[type="text"],
      select,
      textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
      }

      label {
        padding: 12px 12px 12px 0;
        display: inline-block;
      }

      input[type="submit"] {
        background-color: #4caf50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      .Contact_container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 40px;
        height: 550px;
        width: 450px;
        text-align: center;
        margin-left: 30%;
        margin-right: 50%;
        margin-top: 5%;
        margin-bottom: 10%;
      }

      /* Responsive layout - when the screen is less than 600px wide, 
      make the two columns stack on top of each other instead of next 
      to each other */
      @media screen and (max-width: 600px) {
        .col-25,
        .col-75,
        input[type="submit"] {
          width: 100%;
          margin-top: 0;
        }
      }
    </style>
    <!---End of CSS style for contact form-->
  </head>

  <body>
    <!----start of  Navigation Bar with search bar, member login, sign up-->
    <?php
	include 'fullnavbar.php';
    ?>
    <!----end of Navigation Bar-->

    <!---footer fix by Sean-->
    <div id="page-container">
    <div id="content-wrap">
    <!---footer fix-->

    <!----Start of Contact us box-->
    <div class="Contact_container">
      <h1>Contact Us!</h1>
      <p>Please fill in this form to send us your feedback!</p>
	<?php
	if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	if($msg == 'suc'){
		echo '<b><font style="color:#28DF06;">Message sent!</font></b>';}
	else echo "<b>Message failed. Try again!</b>";}
	?>
      <form class="contact-form" method="POST" action="contactform.php">
        <input type="text" name="name" placeholder="Full name" />
        <input type="text" name="email" placeholder="Your email address" />
        <input type="text" name="subject" placeholder="Subject" />
        <textarea name="message" placeholder="Message"></textarea>
        <button type="submit" name="submit" style="width: 300px">
          SEND MESSAGE
        </button>
      </form>
    </div>
    <!---DONT DELETE THIS BLOCK OF COMMENT CODE!!!!!
      <form id="contact-form" method="POST" action="contactform.php">
        <h1>Contact Us!</h1>
        <p>Please fill in this form to send us your feedback!.</p>
        <div class="row">
          <div class="col-25">
            <label for="fname">Your Name:</label>
          </div>
          <div class="col-75">
            <input
              type="text"
              id="fname"
              name="firstname"
              placeholder="Your name"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Email Address:</label>
          </div>
          <div class="col-75">
            <input
              type="text"
              id="email"
              name="email"
              placeholder="Your email address"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="subject">Subject:</label>
          </div>
          <div class="col-75">
            <input
              type="text"
              id="subject"
              name="subject"
              placeholder="Subject"
            />
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="msg">Message:</label>
          </div>
          <div class="col-75">
            <textarea
              id="msg"
              name="msg"
              placeholder="Write your message here!"
              style="height: 200px"
            ></textarea>
          </div>
        </div>
        <div class="row">
          <input type="submit" value="Submit" />
        </div>
      </form>   -->
    <!---</div>--->
    <!----end of Contact us box-->
    <!---START OF FOOTER-->
    </div>
    </br>
    <footer id="footer">
      <p>
        Video games, pictures, all trademarks, and registered trademarks are the
        property of their respective owners.
      </p>
      <p>© 2020 RottenPotatoes</p>
    </footer>
    <!---END OF FOOTER-->
  </body>
</html>
