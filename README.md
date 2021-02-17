# vf-test
Notes:
- I have never professionally coded a PHP API. I have always coded node.js APIs. But I come from this with 20 years of experience coding PHP. The code is strikingly similar, however, node.js is obviously not in PHP. Please note that I have never used slimPHP and you are seeing my first exposure to this framework with this test. My initial reaction is that it seems like a great framework!
- All CRUD operations work. Data is passed via json through the body. All tests done using postman, except for the standard GET which can be accessed via all browsers. The address is as follows:

http://ec2-3-83-228-26.compute-1.amazonaws.com/index.php

PLEASE NOTE: https is NOT supported in this instance. Also, http://ec2-3-83-228-26.compute-1.amazonaws.com/ by itself will not work. Please manually add index.php at the end of the URL.
- In regards to JWT authentication: I was introduced to JWTs at Caddle and was tasked with coding the authentication system in node.js. I have asked a former colleague to provide me with that code to show you what I know.
- I am aware that this is coded for Apache2 and not nginx which violates your requirements. I am distinctly more familiar with Apache2. Switching from nginx was a time saving strategy for me. I do understand the code changes involved in switching to nginx, mostly in noting that the routing in .htaccess moves to a different location with a different coding style. Given extra time I would have implmented this and tested thoroughly.
- In regards to unit testing: I do understand what is being requested. However, I have no professional experience in unit testing and I would just be following a tutorial. I have a good grasp on the concepts of unit testing but I've never implemented  it in practice. I've added a few files for this but they're essentially useless. Given a few examples I could implement this with ease.



FINAL NOTE: Please let me know when you've completed looking at my code on AWS so I may suspend the server and not encur any costs. 
