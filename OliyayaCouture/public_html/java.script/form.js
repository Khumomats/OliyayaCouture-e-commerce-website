/*Contact Us Form Validation Using Javascript | Form Validation In Javascript.2019.YouTube video, added by Coding Market. [Online]. Available at:
 https://www.youtube.com/watch?v=WY4rvU4ImgE [Accessed 28 June 2020]*/



/* global __dirname */
 function validate() {
        var name = document.getElementById("Name").value;
        var number = document.getElementById("number").value;
        var emailAddress = document.getElementById("emailAddress").value;
        var message = document.getElementById("message").value;
        var error_message = document.getElementById("error_message");

        error_message.style.padding = "10px";

        var text;
        var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (name.length < 5) {
            text = "Please Enter valid Name";
            error_message.innerHTML = text;
            return false;
        }

        if (isNaN(number) || number.length !== 10) {
            text = "Please Enter valid Phone Number";
            error_message.innerHTML = text;
            return false;
        }
        if (emailAddress.indexOf("@") === -1 || emailAddress.length < 6) {
            text = "Please Enter valid Email";
            error_message.innerHTML = text;
            return false;
        }
        if (emailAddress.match(pattern)) {
            alert("Form Submitted Successfully!");
            return true;
        }
        if (message.length <= 140) {
            text = "Please Enter More Than 140 Characters";
            error_message.innerHTML = text;
            return false;
        }
        alert("Form Submitted Successfully!");
        return true;
    }

var express = require("express");
var fs = require("fs");
var http = require("http");
var path = require("path");
var bodyParser = require("body-parser");
var app = express();

app.listen(8080, () => console.info('App running at http://localhost:8080'));
/*function onRequest(request, response) {
    response.writeHead(200, {'Content-Type': 'text/html'});
    fs.readFile('index.html', null, function (error, data) {
        if (error) {
            response.writeHead(404);
            response.write('File not found');

        } else {
            response.write(data);
        }
        response.end();

    });
}*/
app.get('/public_html/index.html', (request, response) => response.sendFile(__dirname + 'Task1/public_html/index.html'));
/*http.createServer(onRequest).listen(8080);*/



app.use(bodyParser.urlencoded({ extended: false })); 

app.post('/process', (request, response) => {
    var name = request.body.Name;
    var number = request.body.number;
    var message = request.body.Message;
    var emailAddress = request.body.EmailAddress;
    console.log(name + " " + number);
    console.log(emailAddress);
    console.log(message);


   
}
);
app.post('/process', (request, response) => {
    var name = request.body.Name;
    var number = request.body.number;
    var message = request.body.Message;
    var emailAddress = request.body.EmailAddress;
    console.log(name);
    console.log(emailAddress);
    console.log(number);
    console.log(message);
    var emailMessage = "New message from " + name + " " + number + "(" + emailAddress + ") : " + message;
    mail(emailMessage);
});


function mail(emailMessage) {
    var nodemailer = require('nodemailer');
    var transporter = nodemailer.createTransport({

        service: 'SendPulse',
        auth: {
            user: 'OliyayaCouture',
            pass: 'LEAGOMAT'
        }
    });

    var mailOptions = {

        from: 'emailAddress',
        to: 'reamats@yahoo.com',
        subject: 'Message from Node.js app',
        html: '<p>' + emailMessage + '</p>'};



    transporter.sendMail(mailOptions, function (error, info) {
        if (error) {
            console.log(error);
        } else {
            console.log('Email sent: ' + info.response);

        }
    });
}



