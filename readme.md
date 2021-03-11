# Register / Login / Leave feedback 

Simple webpage with possibility to register an account, login and leave a feedback. This task was 
a final PHP task for Full Stack Junior WEB Developer studies (T43061303). PS design was given in documentation... :)

Technical tasks which were accomplished in this project

- Advanced MVC structure.
- Composer and PSR-4 autoloading.
- Consistent Git commits with creation of multiple branches.
- MySQL database.
- PhpDoc format documentation for project.
- Where possible prevented page refresh by using JavaScript.
- Main view HTML layout which includes head, body, navbar, footer, to prevent HTML duplication.
- PHP Heredoc syntax for creating repeating HTML elements dynamically, for example in register and login forms.
  
Functional tasks

- Registration and login with validation.
- Google Maps map implementattion.
- Feedback page where registered user can leave his feedback.

## How to set it up

1. run command `composer install`
1. create mysql database
1. Create table 'users' in database

CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(60) NOT NULL,
`surname` varchar(60) NOT NULL,
`email` varchar(60) NOT NULL,
`password` varchar(60) NOT NULL,
`phone` varchar(60) DEFAULT NULL,
`address` varchar(60) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8

1. Create table 'comments' in database

CREATE TABLE `comments` (
`comment_id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`body` text NOT NULL,
`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`comment_id`),
KEY `comment to user constraint` (`user_id`),
CONSTRAINT `comment to user constraint` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8

1. copy .env_example to .env
    1. change db name
    1. change db user
    1. change gb password

