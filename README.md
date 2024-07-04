# RELAXTIME : A PHP Self Training ground Website

Relaxtime is a simple blog to display articles about soft drinks used during relax time.

Main purpose for me was to apply at first skills and knowledge I learnt during my training course. This application is going to grow with me and is now a training playground to build my skills, trying new features implementation and technics.

## Installation

- Clone this repository
- Create a local database (name = relaxtime).
- Launch the database SQL script stored in the project resources directory
- Launch the project and sign up to create an account / 
or use the actual one (Andre Langlois - an.langlois@outlook.com - mdp : 12345678)
- GO to Database and change your created account role to Admin.
- Please enjoy your visit !

### Stack Technic
- MySQL 5
- PHP 8
- PHPMyAdmin

## Features

### Already implemented
##### Authentication 
- Sign in
- Sign out
- Account creation
- Password Hash
- Toggle Password Visibility
- Role Managment (User/Administrator)

##### Data Managment
- Crud (Articles/Categories/Comments)
- Display Articles by category
- Adding Image to Article
- Display last 6 articles
- Database modelisation (with relations)

##### Security
- Https certificate
- Distinction between different roles and their administration rights
- Password Hash
- Form control
- Email compliance verification

### In Progress
- Mail service in case of forgotten password
- Pagination for articles
- Split PostController file into separate ones
- Unit Test
- Exceptions management

#### Bugs
- "Delete user" on administration side doesn't work properly.

## Usage


## Contributing

No Contribution accepted - IT IS JUST A SELF PRACTICE PLAYGROUND;
Fork is accepted;

## License

[MIT](https://choosealicense.com/licenses/mit/)
